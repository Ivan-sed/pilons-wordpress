(function () {
  var root = document.querySelector('[data-scenarios]');
  if (!root) return;

  var pin = root.querySelector('[data-scenarios-pin]');
  var label = root.querySelector('[data-scenarios-label]');
  var stack = root.querySelector('[data-scenarios-stack]');
  if (!pin || !label || !stack || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

  var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reducedMotion) {
    return;
  }

  gsap.registerPlugin(ScrollTrigger);

  var cards = gsap.utils.toArray('[data-scenarios-card]', stack);
  if (cards.length < 2) return;

  cards.forEach(function (card, index) {
    card.style.setProperty('--stack-index', index + 1);
  });

  var releaseOffsetActive = false;
  var spacerCompensated = false;
  var fixedPinCompensated = false;
  var compensateFrame = null;
  var refreshFrame = null;

  function getZoom() {
    if (typeof window.__designScale === 'number' && window.__designScale > 0) {
      return window.__designScale;
    }
    var z = parseFloat(document.documentElement.style.zoom);
    return z > 0 ? z : 1;
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

  function setStacking(active) {
    root.classList.toggle('scenarios--stacking', active);
  }

  function clearReleaseOffset() {
    if (!releaseOffsetActive) return;
    gsap.set([label, stack], { clearProps: 'y' });
    releaseOffsetActive = false;
  }

  function setReleaseOffset(trigger, active) {
    var z = getZoom();
    if (!active || z >= 1 || !trigger) {
      clearReleaseOffset();
      return;
    }

    var distance = Math.max(0, trigger.end - trigger.start);
    gsap.set([label, stack], {
      y: distance * (1 - z) / z,
      force3D: true,
    });
    releaseOffsetActive = true;
  }

  function getPinSpacer(trigger) {
    if (!trigger) return null;
    if (trigger.spacer) return trigger.spacer;

    var node = trigger.pin;
    while (node && node.parentNode) {
      node = node.parentNode;
      if (node.classList && node.classList.contains('pin-spacer')) return node;
    }
    return null;
  }

  function clearSpacerCompensation() {
    if (!spacerCompensated || !timeline || !timeline.scrollTrigger) return;

    var spacer = getPinSpacer(timeline.scrollTrigger);
    if (!spacer) return;

    spacer.style.removeProperty('padding-bottom');
    spacer.style.removeProperty('height');
    spacer.style.removeProperty('box-sizing');
    spacerCompensated = false;
  }

  function clearFixedPinCompensation() {
    if (!fixedPinCompensated) return;

    pin.style.removeProperty('left');
    pin.style.removeProperty('width');
    pin.style.removeProperty('max-width');
    fixedPinCompensated = false;
  }

  function compensateFixedPin() {
    if (!timeline || !timeline.scrollTrigger) return;

    var z = getZoom();
    if (z >= 1 || window.getComputedStyle(pin).position !== 'fixed') return;

    var rootRect = root.getBoundingClientRect();
    var rootWidth = root.offsetWidth;
    if (!(rootWidth > 0)) return;

    pin.style.left = (rootRect.left / z) + 'px';
    pin.style.width = rootWidth + 'px';
    pin.style.maxWidth = rootWidth + 'px';
    fixedPinCompensated = true;
  }

  function compensatePinSpacer() {
    var trigger = timeline.scrollTrigger;
    if (!trigger || !trigger.pin) return;

    var spacer = getPinSpacer(trigger);
    if (!spacer) return;

    var z = getZoom();
    if (z >= 1) return;

    var scrollDistance = trigger.end - trigger.start;
    if (!(scrollDistance > 0)) return;

    var cardHeight = getCardHeight();
    var naturalHeight = label.offsetHeight + getGap() + cardHeight;
    var targetPadding = scrollDistance / z;

    spacer.style.boxSizing = 'border-box';
    spacer.style.paddingBottom = targetPadding + 'px';
    spacer.style.height = naturalHeight + targetPadding + 'px';
    spacerCompensated = true;
  }

  function scheduleCompensate() {
    if (compensateFrame) return;
    compensateFrame = requestAnimationFrame(function () {
      compensateFrame = null;
      compensatePinSpacer();
      compensateFixedPin();
      requestAnimationFrame(function () {
        compensatePinSpacer();
        compensateFixedPin();
      });
    });
  }

  function requestRefresh() {
    if (refreshFrame) return;
    refreshFrame = requestAnimationFrame(function () {
      refreshFrame = null;
      ScrollTrigger.refresh();
      scheduleCompensate();
    });
  }

  var timeline = gsap.timeline({
    scrollTrigger: {
      trigger: label,
      start: 'top top',
      end: function () {
        return '+=' + getStackDistance();
      },
      pin: pin,
      pinType: 'fixed',
      scrub: true,
      anticipatePin: 1,
      invalidateOnRefresh: true,
      onRefreshInit: function () {
        clearReleaseOffset();
        clearSpacerCompensation();
        clearFixedPinCompensation();
      },
      onRefresh: function (self) {
        setStacking(self.progress > 0);
        setReleaseOffset(self, self.progress >= 1);
        scheduleCompensate();
      },
      onUpdate: scheduleCompensate,
      onEnter: function () {
        setStacking(true);
        clearReleaseOffset();
        scheduleCompensate();
      },
      onLeave: function (self) {
        setStacking(true);
        setReleaseOffset(self, true);
        scheduleCompensate();
      },
      onEnterBack: function () {
        setStacking(true);
        clearReleaseOffset();
      },
      onLeaveBack: function () {
        setStacking(false);
        clearReleaseOffset();
      },
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

  ScrollTrigger.addEventListener('refresh', scheduleCompensate);
  scheduleCompensate();

  window.addEventListener('load', requestRefresh);
  window.addEventListener('resize', requestRefresh);
})();
