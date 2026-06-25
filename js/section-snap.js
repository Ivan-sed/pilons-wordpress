(function () {
  'use strict';

  /**
   * Section snap controller.
   *
   * Desktop-only full-page scroll snapping. One wheel/touchpad/keyboard
   * gesture moves exactly one logical slide. Animations are locked so the
   * user cannot advance another slide until the current transition finishes.
   *
   * The Scenarios section has its own ScrollTrigger pin-stack; inside that
   * range normal scrolling is preserved until the stack is fully consumed.
   *
   * Works both with Lenis (Chrome/Edge/Firefox) and with a GSAP fallback
   * for Safari, where Lenis is intentionally disabled in smooth-scroll.js.
   */

  var reducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
  var desktopQuery = window.matchMedia('(min-width: 1025px) and (pointer: fine)');

  // Safari is the only browser where Lenis is disabled, so the native GSAP
  // fallback path is used. Keep the snap fast and lightweight there.
  var isSafari = /Apple Computer/.test(navigator.vendor || '') &&
    !/CriOS|FxiOS/.test(navigator.userAgent || '');

  var SCENARIOS_ID = 'scenarios';
  var OVERLAY_LOCKED_CLASS = 'is-overlay-locked';

  // Duration of the slide transition. Long enough to feel smooth, short
  // enough to avoid a sluggish/delayed response. Safari uses a shorter
  // duration because the native GSAP fallback feels slower there.
  var SNAP_DURATION = isSafari ? 0.7 : 1.05;
  // A gentle power3.out curve: fast start with a long, soft deceleration.
  // This avoids the harsh “snap” of an exponential ease.
  var SNAP_EASE = function (t) {
    return 1 - Math.pow(1 - t, 3);
  };
  // Fallback GSAP easing for Safari where Lenis is not available.
  // A lighter ease reduces the time the compositor is under pressure.
  var GSAP_EASE = isSafari ? 'power2.out' : 'power3.out';

  // Wheel impulses are accumulated for this duration before deciding.
  var WHEEL_DEBOUNCE_MS = 30;
  // Minimum accumulated delta to trigger a slide change.
  var WHEEL_THRESHOLD = 30;

  var slideConfigs = [
    { id: 'hero', selector: '#hero' },
    { id: 'benefits', selector: '#benefits' },
    { id: 'scenarios', selector: '#scenarios' },
    { id: 'configs', selector: '#configs' },
    { id: 'content', selector: '#content' },
    { id: 'faq', selector: '#faq' },
    // Trust and Contacts are treated as one logical slide.
    { id: 'trust-contacts', selector: '#trust' },
  ];

  var slides = [];
  var isAnimating = false;
  var snapDisabled = false;
  var wheelAccumulator = 0;
  var wheelTimer = null;
  var scenariosTrigger = null;
  var idleSnapTimer = null;
  var exitScenariosTimer = null;
  var EXIT_SCENARIOS_DELAY = 120;
  var lastKnownDirection = 0;
  var lastScrollY = 0;
  var snapTween = null;
  var wasInsideScenarios = false;
  var exitedScenariosDirection = 0;
  var isExitingScenarios = false;
  var skipPostSnapCorrection = false;

  function canSnap() {
    return Boolean(
      desktopQuery.matches &&
      !reducedMotionQuery.matches &&
      typeof window.gsap !== 'undefined' &&
      typeof window.ScrollTrigger !== 'undefined'
    );
  }

  function getLenis() {
    return window.screenlSmoothScroll && window.screenlSmoothScroll.instance;
  }

  function isOverlayLocked() {
    return document.body.classList.contains(OVERLAY_LOCKED_CLASS);
  }

  function getHeaderOffset() {
    var header = document.querySelector('.hero__header');
    if (!header) return 0;
    return -(Math.ceil(header.getBoundingClientRect().height) + 48);
  }

  function getScenariosTrigger() {
    if (scenariosTrigger && scenariosTrigger.trigger) return scenariosTrigger;

    scenariosTrigger = window.ScrollTrigger.getAll().find(function (st) {
      return st.trigger && st.trigger.id === SCENARIOS_ID;
    });

    return scenariosTrigger;
  }

  /**
   * Returns true when the page is currently inside the Scenarios pin-stack.
   * In that range we let the existing ScrollTrigger scrub animation handle
   * the wheel naturally; snapping is bypassed.
   */
  function isInsideScenarios() {
    var st = getScenariosTrigger();
    if (!st) return false;

    var scrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
    // The lower bound is inclusive so that the very first wheel after
    // snapping to the Scenarios slide is handled by the pin-stack.
    // Extend the upper bound slightly to protect against accidental
    // overscroll leaving the pin-stack before the snap should take over.
    return scrollY >= st.start - 2 && scrollY <= st.end + 60;
  }

  function buildSlides() {
    slides = [];

    slideConfigs.forEach(function (cfg) {
      var el = document.querySelector(cfg.selector);
      if (!el) return;

      slides.push({
        id: cfg.id,
        element: el,
        targetTop: null,
      });
    });

    updateSlideTargets();
  }

  function updateSlideTargets() {
    var headerOffset = getHeaderOffset();
    var st = getScenariosTrigger();

    slides.forEach(function (slide) {
      // The Scenarios pin-stack has two snap targets:
      // - entering from above (scrolling down) lands at the start/first card;
      // - entering from below (scrolling up) lands at the end/last card,
      //   so the cards unstack in reverse order instead of jumping to the top.
      if (slide.id === 'scenarios' && st) {
        slide.targetTop = Math.max(0, st.start);
        slide.targetBottom = Math.max(0, st.end);
        return;
      }

      var rect = slide.element.getBoundingClientRect();
      slide.targetTop = Math.max(0, window.pageYOffset + rect.top + headerOffset);
    });
  }

  function getCurrentIndex() {
    var scrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
    var closest = 0;
    var minDist = Infinity;

    slides.forEach(function (slide, index) {
      var dist = Math.abs(slide.targetTop - scrollY);
      if (dist < minDist) {
        minDist = dist;
        closest = index;
      }
    });

    return closest;
  }

  function clampIndex(index) {
    return Math.max(0, Math.min(index, slides.length - 1));
  }

  function getMaxScrollY() {
    var doc = document.documentElement;
    var body = document.body;
    var scrollHeight = Math.max(
      body ? body.scrollHeight : 0,
      body ? body.offsetHeight : 0,
      doc ? doc.clientHeight : 0,
      doc ? doc.scrollHeight : 0,
      doc ? doc.offsetHeight : 0
    );

    return Math.max(0, scrollHeight - window.innerHeight);
  }

  function getLastSlide() {
    return slides.length ? slides[slides.length - 1] : null;
  }

  function shouldLetLastSlideScroll(direction) {
    var lastSlide = getLastSlide();
    if (!lastSlide || direction === 0 || lastSlide.targetTop == null) return false;

    var scrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
    var maxScrollY = getMaxScrollY();

    if (maxScrollY <= lastSlide.targetTop + 2) return false;
    if (scrollY < lastSlide.targetTop - 2) return false;

    if (direction > 0) return true;

    return scrollY > lastSlide.targetTop + 2;
  }

  function isInsideLastSlideFreeScroll() {
    var lastSlide = getLastSlide();
    if (!lastSlide || lastSlide.targetTop == null) return false;

    var scrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
    return scrollY > lastSlide.targetTop + 2 && getMaxScrollY() > lastSlide.targetTop + 2;
  }

  function setAnimating(value) {
    isAnimating = value;
    document.body.classList.toggle('is-section-snapping', value);
  }

  function killSnapTween() {
    if (snapTween) {
      snapTween.kill();
      snapTween = null;
    }
  }

  /**
   * Gently snaps to the nearest slide if the page has settled off-target.
   * Used both after a snap animation and after free scrolling (e.g. leaving
   * the Scenarios pin range where inertia may overshoot).
   */
  function correctPosition(source) {
    if (!canSnap() || isAnimating || snapDisabled || isOverlayLocked() || isInsideScenarios()) return;
    if (isInsideLastSlideFreeScroll()) return;

    var scrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
    var current = getCurrentIndex();
    var next = current;

    // When we leave the Scenarios pin-stack, snap exactly one slide away from
    // Scenarios in the direction we were scrolling. Without this, the stored
    // direction gets applied to the nearest slide and can skip Configs/Content.
    if (exitedScenariosDirection !== 0) {
      var scenariosIndex = -1;
      slides.forEach(function (slide, index) {
        if (slide.id === 'scenarios') scenariosIndex = index;
      });
      if (scenariosIndex >= 0) {
        next = clampIndex(scenariosIndex + exitedScenariosDirection);
      }
      skipPostSnapCorrection = true;
      isExitingScenarios = false;
      exitedScenariosDirection = 0;
      lastKnownDirection = 0;
    } else if (source === 'idle' && Math.abs(lastKnownDirection) === 1) {
      // After free scrolling through the Scenarios pin range we may land closer
      // to the previous slide while the user's intent was to keep going forward.
      // In that case use the last known scroll direction to pick the next slide.
      next = clampIndex(current + lastKnownDirection);
    }

    var target = slides[next].targetTop;
    var dist = Math.abs(target - scrollY);

    // Allow a larger tolerance after a snap animation finishes so tiny
    // rounding/scroll differences do not trigger another snap.
    var threshold = source === 'idle' ? 3 : 20;

    if (dist > threshold) {
      snapTo(next, target > scrollY ? 1 : -1);
    }
  }

  function snapTo(index, direction) {
    if (isAnimating || snapDisabled || !canSnap()) return;

    index = clampIndex(index);
    var slide = slides[index];
    if (!slide) return;

    setAnimating(true);
    killSnapTween();

    // When re-entering the Scenarios stack from below, land on its last card
    // (end of the pin range) so scrolling up unstack the cards in reverse.
    var target = slide.targetTop;
    if (slide.id === 'scenarios' && direction < 0 && typeof slide.targetBottom === 'number') {
      target = slide.targetBottom;
    }
    var fallbackTimer = null;
    var lenis = getLenis();

    function finishSnap() {
      killSnapTween();
      if (fallbackTimer) {
        window.clearTimeout(fallbackTimer);
        fallbackTimer = null;
      }
      setAnimating(false);
      var shouldSkip = skipPostSnapCorrection;
      skipPostSnapCorrection = false;
      if (!shouldSkip) {
        correctPosition('complete');
      }
    }

    fallbackTimer = window.setTimeout(function () {
      fallbackTimer = null;
      setAnimating(false);
      correctPosition('fallback');
    }, SNAP_DURATION * 1000 + 250);

    if (lenis) {
      // lock: true prevents the user from interrupting the snap mid-transition.
      lenis.scrollTo(target, {
        duration: SNAP_DURATION,
        easing: SNAP_EASE,
        lock: true,
        onComplete: finishSnap,
      });
    } else {
      // Safari fallback: animate window.scrollY with a GSAP tween so the
      // easing/duration are identical to the Lenis path.
      var scrollProxy = { y: window.pageYOffset || document.documentElement.scrollTop || 0 };
      snapTween = gsap.to(scrollProxy, {
        y: target,
        duration: SNAP_DURATION,
        ease: GSAP_EASE,
        force3D: true,
        onUpdate: function () {
          window.scrollTo(0, scrollProxy.y);
        },
        onComplete: finishSnap,
      });
    }
  }

  /**
   * Lenis scroll callback. Once motion has stopped, snap to the nearest slide.
   */
  function onLenisScroll(event) {
    if (!canSnap() || isAnimating || snapDisabled || isOverlayLocked()) return;

    var inside = isInsideScenarios();
    if (inside) {
      lastKnownDirection = event && event.direction ? event.direction : lastKnownDirection;
      wasInsideScenarios = true;
      return;
    }

    if (wasInsideScenarios) {
      wasInsideScenarios = false;
      exitedScenariosDirection = lastKnownDirection;
      isExitingScenarios = true;
    }

    var velocity = event && typeof event.velocity === 'number' ? event.velocity : 0;
    if (Math.abs(velocity) > 0.08) return;

    if (idleSnapTimer) window.clearTimeout(idleSnapTimer);
    if (exitScenariosTimer) window.clearTimeout(exitScenariosTimer);

    // Wait a short moment after leaving the Scenarios pin-stack before snapping.
    // This prevents accidental overscroll from skipping the next slide.
    exitScenariosTimer = window.setTimeout(function () {
      exitScenariosTimer = null;
      if (isAnimating || snapDisabled || isOverlayLocked() || isInsideScenarios()) return;
      correctPosition('idle');
    }, EXIT_SCENARIOS_DELAY);
  }

  /**
   * Native scroll callback for Safari where Lenis is not running.
   */
  function onNativeScroll() {
    if (!canSnap() || isAnimating || snapDisabled || isOverlayLocked()) return;

    var scrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
    var inside = isInsideScenarios();
    if (inside) {
      lastKnownDirection = scrollY > lastScrollY ? 1 : -1;
      lastScrollY = scrollY;
      wasInsideScenarios = true;
      return;
    }

    if (wasInsideScenarios) {
      wasInsideScenarios = false;
      exitedScenariosDirection = lastKnownDirection;
      isExitingScenarios = true;
    }

    if (idleSnapTimer) window.clearTimeout(idleSnapTimer);
    if (exitScenariosTimer) window.clearTimeout(exitScenariosTimer);

    // Wait a short moment after leaving the Scenarios pin-stack before snapping.
    // This prevents accidental overscroll from skipping the next slide.
    exitScenariosTimer = window.setTimeout(function () {
      exitScenariosTimer = null;
      if (isAnimating || snapDisabled || isOverlayLocked() || isInsideScenarios()) return;
      correctPosition('idle');
    }, EXIT_SCENARIOS_DELAY);

    lastScrollY = scrollY;
  }

  /**
   * Aggregates wheel/touchpad impulses. A single long gesture is collapsed
   * into one slide change; a cooldown prevents a second change until the
   * current transition finishes.
   */
  function onWheel(event) {
    if (!canSnap()) return;
    if (isAnimating || snapDisabled || isOverlayLocked()) return;
    if (isInsideScenarios()) return;

    // While the page is settling after leaving the Scenarios pin-stack,
    // ignore wheel impulses so they don't fight the scheduled snap.
    if (isExitingScenarios) {
      event.preventDefault();
      event.stopImmediatePropagation();
      return;
    }

    var deltaY = event.deltaY;
    var deltaX = event.deltaX;

    // Ignore mostly-horizontal gestures (trackpad swipes inside sliders, etc.).
    if (Math.abs(deltaX) > Math.abs(deltaY) * 1.2) return;

    var direction = deltaY > 0 ? 1 : -1;
    if (shouldLetLastSlideScroll(direction)) {
      lastKnownDirection = direction;
      return;
    }

    wheelAccumulator += deltaY;

    if (wheelTimer) {
      window.clearTimeout(wheelTimer);
    }

    wheelTimer = window.setTimeout(function () {
      if (Math.abs(wheelAccumulator) >= WHEEL_THRESHOLD) {
        var direction = wheelAccumulator > 0 ? 1 : -1;
        lastKnownDirection = direction;
        var current = getCurrentIndex();
        snapTo(current + direction, direction);
      }
      wheelAccumulator = 0;
    }, WHEEL_DEBOUNCE_MS);

    event.preventDefault();
    event.stopImmediatePropagation();
  }

  function onKeyDown(event) {
    if (!canSnap()) return;
    if (isAnimating || snapDisabled || isOverlayLocked()) return;

    var key = event.key;
    var handledKeys = ['ArrowDown', 'ArrowUp', 'PageDown', 'PageUp', 'Home', 'End', ' '];
    if (handledKeys.indexOf(key) === -1) return;

    var target = event.target;
    var isElement = target && target.nodeType === 1;
    var targetTag = (isElement && target.tagName || '').toLowerCase();
    if (
      targetTag === 'input' ||
      targetTag === 'textarea' ||
      targetTag === 'select' ||
      (isElement && target.isContentEditable)
    ) {
      return;
    }

    // Let the config slider and trust marquee keep their own keyboard handling.
    if (
      isElement &&
      typeof target.closest === 'function' &&
      target.closest('.configs__slider, .trust__marquee')
    ) {
      return;
    }

    var keyDirection = 0;
    if (key === 'ArrowDown' || key === 'PageDown' || (key === ' ' && !event.shiftKey)) keyDirection = 1;
    else if (key === 'ArrowUp' || key === 'PageUp' || (key === ' ' && event.shiftKey)) keyDirection = -1;
    else if (key === 'End') keyDirection = 1;

    if (shouldLetLastSlideScroll(keyDirection)) {
      lastKnownDirection = keyDirection;
      return;
    }

    event.preventDefault();

    var current = getCurrentIndex();
    var next = current;

    if (key === 'ArrowDown' || key === 'PageDown' || key === ' ') next = current + 1;
    else if (key === 'ArrowUp' || key === 'PageUp') next = current - 1;
    else if (key === 'Home') next = 0;
    else if (key === 'End') next = slides.length - 1;

    lastKnownDirection = next > current ? 1 : (next < current ? -1 : 0);
    snapTo(next, next - current);
  }

  /**
   * Temporarily disables snapping when the user clicks an anchor link.
   * This prevents the snap controller from fighting smooth-scroll.js.
   */
  function onAnchorClick(event) {
    var target = event.target;
    var link = target && target.nodeType === 1 && typeof target.closest === 'function'
      ? target.closest('a[href^="#"]')
      : null;
    if (!link) return;

    var href = link.getAttribute('href');
    if (!href || href === '#') return;

    try {
      if (document.querySelector(href)) {
        snapDisabled = true;
        window.setTimeout(function () {
          snapDisabled = false;
        }, 1500);
      }
    } catch (error) {
      // Invalid selector, ignore.
    }
  }

  function refresh() {
    if (!canSnap()) return;
    buildSlides();
    getScenariosTrigger();
  }

  function onResize() {
    window.requestAnimationFrame(refresh);
  }

  function bindQueries() {
    function onChange() {
      if (!canSnap()) {
        window.removeEventListener('wheel', onWheel, { capture: true });
        document.removeEventListener('keydown', onKeyDown);
        document.removeEventListener('click', onAnchorClick, true);
        return;
      }
      refresh();
    }

    if (desktopQuery.addEventListener) {
      desktopQuery.addEventListener('change', onChange);
    } else if (desktopQuery.addListener) {
      desktopQuery.addListener(onChange);
    }

    if (reducedMotionQuery.addEventListener) {
      reducedMotionQuery.addEventListener('change', onChange);
    } else if (reducedMotionQuery.addListener) {
      reducedMotionQuery.addListener(onChange);
    }
  }

  function init() {
    if (!canSnap()) return;

    buildSlides();
    lastScrollY = window.pageYOffset || document.documentElement.scrollTop || 0;

    window.addEventListener('wheel', onWheel, { passive: false, capture: true });
    document.addEventListener('keydown', onKeyDown);
    document.addEventListener('click', onAnchorClick, true);

    var lenis = getLenis();
    if (lenis) {
      lenis.on('scroll', onLenisScroll);
    } else {
      window.addEventListener('scroll', onNativeScroll, { passive: true });
    }

    window.addEventListener('resize', onResize);
    window.addEventListener('load', refresh);

    if (window.ScrollTrigger) {
      window.ScrollTrigger.addEventListener('refresh', refresh);
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  bindQueries();
})();
