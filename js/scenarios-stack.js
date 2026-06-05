(function () {
  var root = document.querySelector('[data-scenarios]');
  if (!root) return;

  var pin = root.querySelector('[data-scenarios-pin]');
  var label = root.querySelector('[data-scenarios-label]');
  var stack = root.querySelector('[data-scenarios-stack]');
  if (!pin || !label || !stack || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

  var desktopQuery = window.matchMedia('(min-width: 1024px) and (pointer: fine)');
  var reducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
  var cards = gsap.utils.toArray('[data-scenarios-card]', stack);
  if (cards.length < 2) return;

  gsap.registerPlugin(ScrollTrigger);

  var timeline = null;
  var refreshFrame = null;

  function canPin() {
    return desktopQuery.matches && !reducedMotionQuery.matches;
  }

  function numberOr(value, fallback) {
    var parsed = parseFloat(value);
    return Number.isFinite(parsed) ? parsed : fallback;
  }

  function getCardHeight() {
    return cards[0] ? cards[0].offsetHeight : 830;
  }

  function getGap() {
    var styles = window.getComputedStyle(stack);
    return numberOr(styles.rowGap || styles.gap, 30);
  }

  function getStep() {
    var first = cards[0];
    var second = cards[1];
    if (!first || !second) return getCardHeight() + getGap();

    var measuredGap = second.offsetTop - first.offsetTop - first.offsetHeight;
    return first.offsetHeight + Math.max(measuredGap, getGap(), 0);
  }

  function getStackDistance() {
    return (cards.length - 1) * getStep();
  }

  function getPinnedHeight() {
    return label.offsetHeight + getGap() + getCardHeight();
  }

  function setStacking(active) {
    root.classList.toggle('scenarios--stacking', active);
    pin.classList.toggle('scenarios__pin--stacking', active);
  }

  function setPinning(active) {
    root.classList.toggle('scenarios--pinning', active);
    pin.classList.toggle('scenarios__pin--pinning', active);
    pin.style.zIndex = active ? '20' : '';
  }

  function syncFlowHeight() {
    if (!canPin()) return;
    root.style.height = (getPinnedHeight() + getStackDistance()) + 'px';
  }

  function resetPinState() {
    setStacking(false);
    setPinning(false);
  }

  function syncPinState(self) {
    var active = self ? self.isActive : false;
    var after = self ? self.progress >= 1 : false;

    setStacking(active || after);
    setPinning(active);
  }

  function syncState(self) {
    syncPinState(self);
  }

  function requestRefresh() {
    if (!timeline || refreshFrame) return;
    refreshFrame = requestAnimationFrame(function () {
      refreshFrame = null;
      if (!timeline || !canPin()) return;
      syncFlowHeight();
      ScrollTrigger.refresh();
    });
  }

  function clearInlineState() {
    root.style.removeProperty('height');
    pin.style.removeProperty('z-index');
    root.classList.remove('scenarios--ready', 'scenarios--stacking', 'scenarios--pinning');
    pin.classList.remove('scenarios__pin--stacking', 'scenarios__pin--pinning');

    gsap.set(stack, { clearProps: 'transform' });
    gsap.set(cards, { clearProps: 'transform' });
  }

  function destroyStack() {
    if (refreshFrame) {
      cancelAnimationFrame(refreshFrame);
      refreshFrame = null;
    }

    if (timeline) {
      if (timeline.scrollTrigger) {
        timeline.scrollTrigger.kill();
      }
      timeline.kill();
      timeline = null;
    }

    clearInlineState();
    ScrollTrigger.refresh();
  }

  function createStack() {
    if (timeline || !canPin()) return;

    cards.forEach(function (card, index) {
      card.style.setProperty('--stack-index', index + 1);
    });
    root.classList.add('scenarios--ready');
    syncFlowHeight();

    timeline = gsap.timeline({
      scrollTrigger: {
        trigger: root,
        start: 'top top',
        end: function () {
          return '+=' + getStackDistance();
        },
        pin: pin,
        pinSpacing: false,
        anticipatePin: 1,
        scrub: true,
        invalidateOnRefresh: true,
        onRefreshInit: function () {
          resetPinState();
          root.style.removeProperty('height');
        },
        onRefresh: function (self) {
          syncFlowHeight();
          syncState(self);
        },
        onUpdate: syncState,
        onEnter: syncState,
        onLeave: syncState,
        onEnterBack: syncState,
        onLeaveBack: syncState,
      },
    });

    cards.slice(1).forEach(function (card, index) {
      timeline.to(card, {
        y: function () {
          return -((index + 1) * getStep());
        },
        ease: 'none',
        duration: 1,
        force3D: true,
      }, index);
    });
  }

  function syncMode() {
    if (canPin()) {
      createStack();
      requestRefresh();
    } else {
      destroyStack();
    }
  }

  function bindQuery(query) {
    if (query.addEventListener) {
      query.addEventListener('change', syncMode);
    } else if (query.addListener) {
      query.addListener(syncMode);
    }
  }

  ScrollTrigger.addEventListener('refresh', function () {
    if (timeline && canPin()) {
      syncFlowHeight();
    }
  });

  bindQuery(desktopQuery);
  bindQuery(reducedMotionQuery);
  window.addEventListener('load', requestRefresh);
  window.addEventListener('resize', function () {
    requestAnimationFrame(syncMode);
  });

  syncMode();
})();
