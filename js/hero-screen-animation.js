(function () {
  'use strict';

  var DATA = window.HERO_SCREEN_DATA;
  if (!DATA || typeof gsap === 'undefined') return;

  // The panels live in #screenGroup (below the text); the bezels + shadow live
  // in #screenChrome (above the text). Both boxes are placed onto the exact
  // same "unit" rect every frame, so their inner percentage coords line up.
  var animRoot = document.querySelector('.hero__screen-anim');
  var screenGroup = document.getElementById('screenGroup');
  var screenChrome = document.getElementById('screenChrome');
  var reflection = document.getElementById('reflection');
  var panels = document.getElementById('panels');
  var bezels = document.getElementById('bezels');
  var shadows = document.getElementById('shadows');

  if (!animRoot || !screenGroup || !screenChrome || !reflection ||
      !panels || !bezels || !shadows) return;

  var SPREAD = DATA.spread;
  var JOINED = DATA.joined;
  var TEX = DATA.texture;
  var BEZEL = DATA.bezel;
  var SHADOW_ART = DATA.shadowArtboard;
  var SHADOW_RENDER_H = SHADOW_ART.renderHeight || SHADOW_ART.height;
  var SHADOW_HEIGHT_SCALE = SPREAD.unit.width / SHADOW_ART.contentWidth;
  var shadowSrcSpread = DATA.assets.shadowPanels;
  var shadowSrcJoined = DATA.assets.shadowPanelsJoined || shadowSrcSpread;
  var UNIT_SHADOW = DATA.panelUnitShadow || 'none';
  var OUTER_BORDER = 2;
  var JOIN_SNAP = 0.98;
  var JOIN_OVERLAP = 1;
  var SPREAD_MAX_GAPS = SPREAD.items.slice(0, -1).map(function (_, i) {
    return SPREAD.items[i + 1].left - (SPREAD.items[i].left + SPREAD.items[i].width);
  });
  var TIMING = DATA.timing;
  var frameW = DATA.frame.width;
  var frameH = DATA.frame.height;

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var state = { t: reduceMotion ? 1 : 0 };

  /* ----------------------------- math helpers ---------------------------- */

  function lerp(a, b, t) {
    return a + (b - a) * t;
  }

  function lerpRect(a, b, t) {
    return {
      left: lerp(a.left, b.left, t),
      top: lerp(a.top, b.top, t),
      width: lerp(a.width, b.width, t),
      height: lerp(a.height, b.height, t),
    };
  }

  function lerpItems(from, to, t) {
    return from.map(function (item, i) {
      return {
        left: lerp(item.left, to[i].left, t),
        width: lerp(item.width, to[i].width, t),
        role: item.role || to[i].role,
      };
    });
  }

  function pct(value, base) {
    return (value / base * 100) + '%';
  }

  /* ------------------------------- assets -------------------------------- */

  function bindAssets(scope) {
    scope.querySelectorAll('[data-asset]').forEach(function (node) {
      var key = node.getAttribute('data-asset');
      var primary = DATA.assets[key];
      var fallback = DATA.assets[key + 'Fallback'];
      if (!primary) return;
      node.src = primary;
      if (fallback && fallback !== primary) {
        node.addEventListener('error', function onError() {
          node.removeEventListener('error', onError);
          node.src = fallback;
        });
      }
    });
  }

  /* --------------------- layout primitives (per frame) -------------------- */

  // A "panel surface" is one panels wrapper + its masks + slice images. Both
  // the main screen and the reflection mirror are described by this shape.
  function makePanelSurface(scope) {
    var masks = Array.prototype.slice.call(scope.querySelectorAll('.panel-mask'));
    return {
      wrap: scope.querySelector('.panels'),
      masks: masks,
      imgs: masks.map(function (m) { return m.querySelector('.panel-mask__img'); }),
    };
  }

  function placeBox(el, rect) {
    el.style.left = pct(rect.left, frameW);
    el.style.top = pct(rect.top, frameH);
    el.style.width = pct(rect.width, frameW);
    el.style.height = pct(rect.height, frameH);
  }

  function computeJoinT(items) {
    if (items.length < 2) return 1;
    var worst = 0;
    for (var i = 0; i < items.length - 1; i++) {
      var gap = items[i + 1].left - (items[i].left + items[i].width);
      worst = Math.max(worst, gap / SPREAD_MAX_GAPS[i]);
    }
    return 1 - Math.min(1, Math.max(0, worst));
  }

  function layoutUnifiedChrome(wrap, unified) {
    if (unified) {
      wrap.style.outline = OUTER_BORDER + 'px solid #29292b';
      wrap.style.borderRadius = OUTER_BORDER + 'px';
      wrap.style.boxShadow = UNIT_SHADOW;
    } else {
      wrap.style.outline = '';
      wrap.style.borderRadius = '';
      wrap.style.boxShadow = '';
    }
  }

  function innerBorderPx(gap, maxGap) {
    if (gap <= 0.25) return 0;
    return Math.min(OUTER_BORDER, (gap / maxGap) * OUTER_BORDER);
  }

  function layoutPanelBorder(mask, i, count, items, unified) {
    if (unified) {
      mask.style.border = 'none';
      mask.style.boxShadow = 'none';
      mask.style.borderRadius = '0';
      return;
    }

    var leftGap = i > 0
      ? items[i].left - (items[i - 1].left + items[i - 1].width)
      : null;
    var rightGap = i < count - 1
      ? items[i + 1].left - (items[i].left + items[i].width)
      : null;

    var leftW = i === 0 ? OUTER_BORDER : innerBorderPx(leftGap, SPREAD_MAX_GAPS[i - 1]);
    var rightW = i === count - 1 ? OUTER_BORDER : innerBorderPx(rightGap, SPREAD_MAX_GAPS[i]);

    mask.style.borderStyle = 'solid';
    mask.style.borderColor = '#29292b';
    mask.style.borderTopWidth = OUTER_BORDER + 'px';
    mask.style.borderBottomWidth = OUTER_BORDER + 'px';
    mask.style.borderLeftWidth = leftW + 'px';
    mask.style.borderRightWidth = rightW + 'px';
    mask.style.borderTopLeftRadius = (i === 0 ? OUTER_BORDER : leftW) + 'px';
    mask.style.borderBottomLeftRadius = (i === 0 ? OUTER_BORDER : leftW) + 'px';
    mask.style.borderTopRightRadius = (i === count - 1 ? OUTER_BORDER : rightW) + 'px';
    mask.style.borderBottomRightRadius = (i === count - 1 ? OUTER_BORDER : rightW) + 'px';
    mask.style.boxShadow = (i === 0 || (leftGap != null && leftGap > 0.25)) ? UNIT_SHADOW : 'none';
  }

  function layoutPanels(surface, unit, panelsRect, items) {
    var wrap = surface.wrap;
    wrap.style.left = pct(panelsRect.left, unit.width);
    wrap.style.top = pct(panelsRect.top, unit.height);
    wrap.style.width = pct(panelsRect.width, unit.width);
    wrap.style.height = pct(panelsRect.height, unit.height);

    var unified = computeJoinT(items) >= JOIN_SNAP;
    layoutUnifiedChrome(wrap, unified);

    // The continuous screen texture is sliced across the masks; each slice is
    // offset so the panels read as one unbroken image.
    var fullW = panelsRect.width * TEX.widthRatio;
    var fullLeft = panelsRect.width * TEX.leftRatio;

    surface.masks.forEach(function (mask, i) {
      var item = items[i];
      var left = item.left;
      var width = item.width;

      if (unified && i > 0) {
        left -= JOIN_OVERLAP;
        width += JOIN_OVERLAP;
      }

      mask.style.left = pct(left, panelsRect.width);
      mask.style.width = pct(width, panelsRect.width);
      layoutPanelBorder(mask, i, surface.masks.length, items, unified);

      var img = surface.imgs[i];
      if (!img) return;
      img.style.width = (fullW / width * 100) + '%';
      img.style.height = (TEX.heightRatio * 100) + '%';
      img.style.top = (TEX.topRatio * 100) + '%';
      img.style.left = ((fullLeft - left) / width * 100) + '%';
    });
  }

  function layoutBezels(wrap, bezelEls, unit, items) {
    wrap.style.height = pct(BEZEL.height, unit.height);
    bezelEls.forEach(function (el, i) {
      var item = items[i];
      el.style.left = pct(item.left, unit.width);
      el.style.width = pct(item.width, unit.width);

      var img = el.querySelector('.bezel__img');
      if (!img) return;
      var role = item.role || el.getAttribute('data-role');
      var sprite = role === 'center' ? BEZEL.centerImg : BEZEL.sideImg;
      img.style.left = sprite.leftPct + '%';
      img.style.width = sprite.widthPct + '%';
      img.style.top = sprite.topPct + '%';
      img.style.height = sprite.heightPct + '%';
    });
  }

  // --- Main bezels: composite-only join -----------------------------------
  // The bezels carry an expensive SVG drop-shadow filter. Re-laying them out
  // every frame (left/width) forces that filter to re-rasterize → the jank.
  // Instead we pin #screenChrome to the spread unit, place the bezels ONCE,
  // and animate the join purely with GSAP `x` (translateX). Their width is
  // identical spread↔joined, so a pure horizontal translate reproduces the
  // motion exactly while the filter rasterizes only once (GPU-composited via
  // will-change:transform). bezelDeltaPx[i] is the settled translate in px.
  var bezelDeltaPx = [];
  var shadowDeltaPx = [];

  function setupMainBezels() {
    bezels.style.height = pct(BEZEL.height, SPREAD.unit.height);
    bezelEls.forEach(function (el, i) {
      var item = SPREAD.bezels[i];
      el.style.left = pct(item.left, SPREAD.unit.width);
      el.style.width = pct(item.width, SPREAD.unit.width);

      var img = el.querySelector('.bezel__img');
      if (!img) return;
      var role = item.role || el.getAttribute('data-role');
      var sprite = role === 'center' ? BEZEL.centerImg : BEZEL.sideImg;
      img.style.left = sprite.leftPct + '%';
      img.style.width = sprite.widthPct + '%';
      img.style.top = sprite.topPct + '%';
      img.style.height = sprite.heightPct + '%';
    });
  }

  function measureChrome() {
    var hw = (animRoot.getBoundingClientRect().width) || frameW;
    var scale = hw / frameW;
    bezelDeltaPx = SPREAD.bezels.map(function (sb, i) {
      var jb = JOINED.bezels[i];
      return ((JOINED.unit.left + jb.left) - (SPREAD.unit.left + sb.left)) * scale;
    });
    shadowDeltaPx = SPREAD.shadows.map(function (ss, i) {
      var js = JOINED.shadows[i];
      return ((JOINED.unit.left + js.left) - (SPREAD.unit.left + ss.left)) * scale;
    });
  }

  function shadowSrcFor(t) {
    return t >= 0.5 ? shadowSrcJoined : shadowSrcSpread;
  }

  // One shadow-group per panel; sprite is the full artboard sliced horizontally.
  // #shadows needs explicit height — %-height on children collapses otherwise.
  //
  // Like the bezels, the shadow carries a heavy blur(200px) that re-rasterizes
  // whenever it's re-sliced — so we do the SAME composite-only trick: pin each
  // group at its spread position, slice the *joined* artboard once (the settled
  // look), and let the join translate the group with GSAP `x`. At t=1 this is
  // pixel-identical to the old per-frame path; the brief join transient differs
  // only by sub-blur amounts (the shadow is faint and 200px-blurred).
  function setupShadows() {
    var panelsRect = JOINED.panels; // top/height are constant spread↔joined
    var top = panelsRect.top + panelsRect.height - SHADOW_ART.padTop;
    var shadowH = SHADOW_RENDER_H * SHADOW_HEIGHT_SCALE;
    var src = shadowSrcJoined;

    shadows.style.left = '4px';
    shadows.style.width = '100%';
    shadows.style.top = pct(top, SPREAD.unit.height);
    shadows.style.height = pct(shadowH, SPREAD.unit.height);

    shadowEls.forEach(function (el, i) {
      var spreadItem = SPREAD.shadows[i];
      var joinedItem = JOINED.shadows[i];

      el.style.left = pct(spreadItem.left, SPREAD.unit.width);
      el.style.width = pct(joinedItem.width, SPREAD.unit.width);
      el.style.top = '0';
      el.style.height = '100%';

      var img = el.querySelector('.shadow-group__svg');
      if (!img) return;
      if (img.dataset.shadowSrc !== src) {
        img.dataset.shadowSrc = src;
        img.src = src;
      }
      img.style.width = (SHADOW_ART.width / joinedItem.width * 100) + '%';
      img.style.left = (-(SHADOW_ART.padLeft + joinedItem.left) / joinedItem.width * 100) + '%';
    });
  }

  /* ------------------------------- wiring -------------------------------- */

  var mainPanels = makePanelSurface(screenGroup);
  var bezelEls = Array.prototype.slice.call(bezels.querySelectorAll('.bezel'));
  var shadowEls = Array.prototype.slice.call(shadows.querySelectorAll('.shadow-group'));

  bindAssets(screenGroup);
  bindAssets(screenChrome);

  // Reflection: a mirrored clone of the panels group with its own bezels (no
  // shadow). CSS flips it vertically and fades it out.
  var mirrorGroup = screenGroup.cloneNode(true);
  mirrorGroup.removeAttribute('id');
  var mirrorBezels = bezels.cloneNode(true);
  mirrorBezels.removeAttribute('id');
  mirrorGroup.appendChild(mirrorBezels);
  reflection.appendChild(mirrorGroup);
  bindAssets(mirrorGroup);

  var mirrorPanels = makePanelSurface(mirrorGroup);
  var mirrorBezelEls = Array.prototype.slice.call(mirrorBezels.querySelectorAll('.bezel'));

  // The reflection is rendered at ~5% opacity, so the bezels' soft drop-shadow
  // is imperceptible there. Drop the SVG filter on the mirror to avoid a second
  // per-frame filter re-rasterization (the mirror still re-lays-out each frame).
  mirrorBezels.querySelectorAll('.bezel__svg').forEach(function (svg) {
    svg.style.display = 'none';
  });

  if (DATA.reflectionOpacity != null) {
    mirrorGroup.style.opacity = String(DATA.reflectionOpacity);
  }

  /* ------------------------------- render -------------------------------- */

  function render(t) {
    var unit = lerpRect(SPREAD.unit, JOINED.unit, t);
    var panelsRect = lerpRect(SPREAD.panels, JOINED.panels, t);
    var items = lerpItems(SPREAD.items, JOINED.items, t);
    var bezelItems = lerpItems(SPREAD.bezels, JOINED.bezels, t);
    var reflectionRect = lerpRect(SPREAD.reflection, JOINED.reflection, t);

    placeBox(screenGroup, unit);
    layoutPanels(mainPanels, unit, panelsRect, items);
    // Main bezels + shadows are pinned (setup) and GSAP-translated (join) — the
    // only per-frame work left here is the panels (cheap; no blur) + reflection.

    placeBox(reflection, reflectionRect);
    mirrorGroup.style.width = '100%';
    mirrorGroup.style.height = pct(unit.height, reflectionRect.height);
    layoutPanels(mirrorPanels, unit, panelsRect, items);
    layoutBezels(mirrorBezels, mirrorBezelEls, unit, bezelItems);
  }

  // Pin the chrome to the spread unit and place the bezels once; from here the
  // join only translates them (cheap composite) instead of re-laying-them-out.
  placeBox(screenChrome, SPREAD.unit);
  setupMainBezels();
  setupShadows();
  measureChrome();

  render(state.t);

  // Re-render once panel textures decode, in case they weren't cached.
  mainPanels.imgs.forEach(function (img) {
    if (img && !img.complete) {
      img.addEventListener('load', function () { render(state.t); }, { once: true });
    }
  });

  var hero = document.querySelector('.hero');
  var product = document.querySelector('.hero__product');

  function markIntroDone() {
    if (hero) hero.classList.add('hero--intro-done');
  }

  function buildProductReveal() {
    if (!product) return null;

    var titleLines = product.querySelectorAll('.hero__title-line');
    var subtitle = product.querySelector('.hero__subtitle');
    var ctaRow = product.querySelector('.hero__cta-row');
    var screenl = product.querySelector('.hero__screenl');
    var features = product.querySelectorAll('.hero__feature');

    var blocks = [
      product.querySelector('.hero__title-block'),
      ctaRow,
      screenl,
      product.querySelector('.hero__features'),
    ].filter(Boolean);

    gsap.set(blocks, { visibility: 'visible', opacity: 1 });
    gsap.set([titleLines, subtitle, ctaRow, screenl, features], { opacity: 0 });

    var tl = gsap.timeline({ defaults: { ease: 'power2.out' } });

    tl.fromTo(titleLines,
        { opacity: 0, y: 36 },
        { opacity: 1, y: 0, duration: 0.9, stagger: 0.13, ease: 'power3.out' })
      .fromTo(subtitle,
        { opacity: 0, y: 20 },
        { opacity: 1, y: 0, duration: 0.7 },
        '-=0.48')
      .fromTo(ctaRow,
        { opacity: 0, y: 24, x: 18 },
        { opacity: 1, y: 0, x: 0, duration: 0.75 },
        '-=0.38')
      .fromTo(screenl,
        { opacity: 0, y: 30, scale: 0.98 },
        { opacity: 1, y: 0, scale: 1, duration: 0.85, ease: 'power2.out' },
        '-=0.5')
      .fromTo(features,
        { opacity: 0, x: -22 },
        { opacity: 1, x: 0, duration: 0.6, stagger: 0.1 },
        '-=0.58');

    return tl;
  }

  // The pylons reveal: every column (panel + bezel + shadow, main and mirror)
  // fades in, staggered by its horizontal centre so the screen lights up
  // strictly left → right. Layout is untouched — this only drives opacity (and
  // a small rise on the solid front pieces), so the join can run afterwards.
  var REVEAL_SWEEP = TIMING.revealSweep != null ? TIMING.revealSweep : 0.75;
  var REVEAL_STEP = TIMING.revealStep != null ? TIMING.revealStep : 0.5;

  function buildPylonReveal() {
    function collect(list, rise) {
      return (list || []).map(function (el) {
        var r = el.getBoundingClientRect();
        return { el: el, cx: r.left + r.width / 2, rise: rise };
      });
    }

    var items = collect(mainPanels.masks, true)
      .concat(collect(bezelEls, true))
      .concat(collect(shadowEls, false))
      .concat(collect(mirrorPanels.masks, false))
      .concat(collect(mirrorBezelEls, false));
    if (!items.length) return null;

    var minX = Infinity;
    var maxX = -Infinity;
    items.forEach(function (it) {
      if (it.cx < minX) minX = it.cx;
      if (it.cx > maxX) maxX = it.cx;
    });
    var span = (maxX - minX) || 1;

    var tl = gsap.timeline();
    items.forEach(function (it) {
      var at = (it.cx - minX) / span * REVEAL_SWEEP;
      var from = it.rise ? { opacity: 0, yPercent: 8 } : { opacity: 0 };
      var to = it.rise
        ? { opacity: 1, yPercent: 0, duration: REVEAL_STEP, ease: 'power2.out' }
        : { opacity: 1, duration: REVEAL_STEP, ease: 'power2.out' };
      tl.fromTo(it.el, from, to, at);
    });
    return tl;
  }

  if (reduceMotion) {
    state.t = 1;
    render(1);
    gsap.set(bezelEls, { x: function (i) { return bezelDeltaPx[i]; } });
    gsap.set(shadowEls, { x: function (i) { return shadowDeltaPx[i]; } });
    markIntroDone();
    return;
  }

  /* ----------------------------- intro timeline -------------------------- */

  var introTl = gsap.timeline({ onComplete: markIntroDone });

  // 1) Pylons appear one-by-one from left to right.
  var pylonReveal = buildPylonReveal();
  if (pylonReveal) introTl.add(pylonReveal, TIMING.delay);

  // 2) Only then do they slide together into the unified screen.
  introTl.to(state, {
      t: 1,
      duration: TIMING.duration,
      ease: TIMING.ease,
      onUpdate: function () { render(state.t); },
    }, pylonReveal ? '+=' + (TIMING.joinGap != null ? TIMING.joinGap : 0.15) : TIMING.delay);

  // Translate the pinned bezels + shadows into the joined layout in lockstep
  // with the panels above (same start/duration/ease) — composite-only.
  introTl.to(bezelEls, {
      x: function (i) { return bezelDeltaPx[i]; },
      duration: TIMING.duration,
      ease: TIMING.ease,
    }, '<');
  introTl.to(shadowEls, {
      x: function (i) { return shadowDeltaPx[i]; },
      duration: TIMING.duration,
      ease: TIMING.ease,
    }, '<');

  var productReveal = buildProductReveal();
  if (productReveal) {
    introTl.add(productReveal, '+=' + (TIMING.productGap || 0.2));
  } else {
    introTl.call(markIntroDone);
  }

  introTl.play(0);

  var resizeRaf;
  window.addEventListener('resize', function () {
    cancelAnimationFrame(resizeRaf);
    resizeRaf = requestAnimationFrame(function () {
      measureChrome();
      gsap.set(bezelEls, { x: function (i) { return bezelDeltaPx[i] * state.t; } });
      gsap.set(shadowEls, { x: function (i) { return shadowDeltaPx[i] * state.t; } });
      render(state.t);
    });
  });
})();
