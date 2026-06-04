(function () {
  'use strict';

  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var selectors = ['.benefits', '.configs', '.content', '.faq', '.trust', '.contacts'];
  var sections = selectors
    .map(function (selector) {
      return document.querySelector(selector);
    })
    .filter(Boolean);

  if (!sections.length) return;

  gsap.registerPlugin(ScrollTrigger);

  if (reduceMotion) {
    gsap.set(sections, { clearProps: 'all' });
    return;
  }

  sections.forEach(function (section) {
    gsap.fromTo(section, {
      autoAlpha: 0,
      y: '3rem',
      scale: 0.985,
      transformOrigin: '50% 0%',
    }, {
      autoAlpha: 1,
      y: 0,
      scale: 1,
      duration: 0.9,
      ease: 'power3.out',
      clearProps: 'transform,opacity,visibility',
      scrollTrigger: {
        trigger: section,
        start: 'top 82%',
        once: true,
      },
    });
  });

  window.addEventListener('load', function () {
    ScrollTrigger.refresh();
  });
})();
