(function () {
  'use strict';

  var lenis = null;
  var tickerAdded = false;
  var reduceMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
  var desktopQuery = window.matchMedia('(min-width: 1025px) and (pointer: fine)');
  var overlayLocked = document.body.classList.contains('is-overlay-locked');

  function canUseLenis() {
    return Boolean(window.Lenis) && desktopQuery.matches && !reduceMotionQuery.matches;
  }

  function getHeaderOffset() {
    var header = document.querySelector('.hero__header');
    if (!header) return -104;

    return -(Math.ceil(header.getBoundingClientRect().height) + 48);
  }

  function updateScrollTrigger() {
    if (window.ScrollTrigger) {
      window.ScrollTrigger.update();
    }
  }

  function raf(time) {
    if (lenis) {
      lenis.raf(time * 1000);
    }
  }

  function addTicker() {
    if (tickerAdded || !window.gsap) return;

    window.gsap.ticker.add(raf);
    window.gsap.ticker.lagSmoothing(0);
    tickerAdded = true;
  }

  function removeTicker() {
    if (!tickerAdded || !window.gsap) return;

    window.gsap.ticker.remove(raf);
    tickerAdded = false;
  }

  function stop() {
    if (lenis) {
      lenis.stop();
    }
  }

  function start() {
    if (lenis && !overlayLocked) {
      lenis.start();
    }
  }

  function destroyLenis() {
    if (!lenis) return;

    lenis.destroy();
    lenis = null;
    removeTicker();

    if (window.ScrollTrigger) {
      window.ScrollTrigger.refresh();
    }
  }

  function createLenis() {
    if (lenis || !canUseLenis()) return;

    lenis = new window.Lenis({
      lerp: 0.085,
      wheelMultiplier: 0.92,
      smoothWheel: true,
      syncTouch: false,
      anchors: false,
      prevent: function (node) {
        return Boolean(node.closest && node.closest('.menu, .modal, [data-lenis-prevent]'));
      },
    });

    lenis.on('scroll', updateScrollTrigger);
    addTicker();

    if (overlayLocked) {
      lenis.stop();
    }

    if (window.ScrollTrigger) {
      window.ScrollTrigger.refresh();
    }
  }

  function refresh() {
    if (canUseLenis()) {
      createLenis();
      return;
    }

    destroyLenis();
  }

  function getTarget(target) {
    if (typeof target === 'number') return target;
    if (target instanceof Element) return target;
    if (typeof target === 'string') return document.querySelector(target);
    return null;
  }

  function scrollTo(target, options) {
    var resolved = getTarget(target);
    if (resolved == null) return false;

    var opts = Object.assign({
      offset: typeof resolved === 'number' ? 0 : getHeaderOffset(),
      duration: 1.15,
      easing: function (t) {
        return Math.min(1, 1.001 - Math.pow(2, -10 * t));
      },
    }, options || {});

    if (lenis) {
      lenis.scrollTo(resolved, opts);
      return true;
    }

    if (typeof resolved === 'number') {
      window.scrollTo({ top: resolved, behavior: reduceMotionQuery.matches ? 'auto' : 'smooth' });
      return true;
    }

    var top = resolved.getBoundingClientRect().top + window.pageYOffset + (opts.offset || 0);
    window.scrollTo({ top: top, behavior: reduceMotionQuery.matches ? 'auto' : 'smooth' });
    return true;
  }

  function shouldHandleAnchor(link) {
    var href = link.getAttribute('href');
    if (!href || href.charAt(0) !== '#' || href === '#') return false;

    try {
      return Boolean(document.querySelector(href));
    } catch (error) {
      return false;
    }
  }

  function onAnchorClick(event) {
    var link = event.target.closest('a[href^="#"]');
    if (!link || !shouldHandleAnchor(link)) return;

    event.preventDefault();

    var href = link.getAttribute('href');
    window.setTimeout(function () {
      scrollTo(href);
      if (history.pushState) {
        history.pushState(null, '', href);
      }
    }, 0);
  }

  function syncOverlayLock() {
    overlayLocked = document.body.classList.contains('is-overlay-locked');
    if (overlayLocked) {
      stop();
    } else {
      start();
    }
  }

  function bindQuery(query) {
    if (query.addEventListener) {
      query.addEventListener('change', refresh);
    } else if (query.addListener) {
      query.addListener(refresh);
    }
  }

  document.addEventListener('click', onAnchorClick);
  bindQuery(desktopQuery);
  bindQuery(reduceMotionQuery);

  new MutationObserver(syncOverlayLock).observe(document.body, {
    attributes: true,
    attributeFilter: ['class'],
  });

  window.addEventListener('load', refresh);
  window.addEventListener('resize', function () {
    window.requestAnimationFrame(refresh);
  });

  window.screenlSmoothScroll = {
    scrollTo: scrollTo,
    start: start,
    stop: stop,
    get instance() {
      return lenis;
    },
  };

  refresh();
})();
