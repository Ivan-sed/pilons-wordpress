(function () {
  var root = document.querySelector('[data-scenarios]');
  if (!root) return;

  var pin = root.querySelector('[data-scenarios-pin]');
  var label = root.querySelector('[data-scenarios-label]');
  var stack = root.querySelector('[data-scenarios-stack]');
  if (!pin || !label || !stack || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

  var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reducedMotion) return;

  gsap.registerPlugin(ScrollTrigger);

  var cards = gsap.utils.toArray('[data-scenarios-card]', stack);
  if (cards.length < 2) return;

  cards.forEach(function (card, index) {
    card.style.setProperty('--stack-index', index + 1);
  });

  var refreshFrame = null;
  var pinFrame = null;
  var pendingTrigger = null;
  var lastPinY = null;
  var setPinY = gsap.quickSetter(pin, 'y', 'px');

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
    root.style.height = (getPinnedHeight() + getStackDistance()) + 'px';
  }

  function snapPinY(value) {
    var ratio = window.devicePixelRatio || 1;
    return Math.round(value * ratio) / ratio;
  }

  function applyPin(self) {
    var active = self ? self.isActive : false;
    var after = self ? self.progress >= 1 : false;
    var pinY = 0;

    if (active) {
      pinY = window.scrollY - self.start;
    } else if (after) {
      pinY = self.end - self.start;
    }
    pinY = snapPinY(pinY);

    setStacking(active || after);
    setPinning(active);
    if (lastPinY !== pinY) {
      setPinY(pinY);
      lastPinY = pinY;
    }
  }

  function syncState(self) {
    pendingTrigger = self;
    if (pinFrame) return;
    pinFrame = requestAnimationFrame(function () {
      pinFrame = null;
      applyPin(pendingTrigger);
    });
  }

  function requestRefresh() {
    if (refreshFrame) return;
    refreshFrame = requestAnimationFrame(function () {
      refreshFrame = null;
      syncFlowHeight();
      ScrollTrigger.refresh();
    });
  }

  syncFlowHeight();

  var timeline = gsap.timeline({
    scrollTrigger: {
      trigger: label,
      start: 'top top',
      end: function () {
        return '+=' + getStackDistance();
      },
      scrub: true,
      invalidateOnRefresh: true,
      onRefreshInit: function () {
        setPinY(0);
        lastPinY = null;
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

  ScrollTrigger.addEventListener('refresh', function () {
    syncFlowHeight();
  });

  window.addEventListener('load', requestRefresh);
  window.addEventListener('resize', requestRefresh);
})();
