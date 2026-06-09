(function () {
  var root = document.documentElement;
  var startedAt = Date.now();
  var minVisible = 620;
  var maxVisible = 4200;
  var hidden = false;
  var progress = 0;
  var targetProgress = 0;
  var loader = null;
  var rafId = 0;

  root.classList.add('has-site-preloader');

  function setProgress(value) {
    progress = Math.max(0, Math.min(100, value));

    if (loader) {
      loader.style.setProperty('--preloader-progress', progress.toFixed(2) + '%');
      loader.style.setProperty('--preloader-ratio', (progress / 100).toFixed(4));
    }
  }

  function tickProgress() {
    if (!loader || hidden) return;

    progress += (targetProgress - progress) * 0.08;

    if (targetProgress < 100 && progress > 91.5) {
      progress = 91.5;
    }

    setProgress(progress);
    rafId = window.requestAnimationFrame(tickProgress);
  }

  function startProgress() {
    var startedProgressAt = Date.now();

    function raiseTarget() {
      if (hidden) return;

      var elapsed = Date.now() - startedProgressAt;
      targetProgress = Math.min(92, 18 + elapsed / 34);

      if (targetProgress < 92) {
        window.setTimeout(raiseTarget, 120);
      }
    }

    raiseTarget();
    tickProgress();
  }

  function mountScreenlSvg() {
    var mark = document.querySelector('[data-preloader-screenl]');
    var heroSvg = document.querySelector('.hero__screenl-svg');
    var baseLayer = mark ? mark.querySelector('.site-preloader__screenl-layer--base') : null;
    var glowLayer = mark ? mark.querySelector('.site-preloader__screenl-layer--glow') : null;

    if (!heroSvg || !baseLayer || !glowLayer) {
      return;
    }

    baseLayer.appendChild(heroSvg.cloneNode(true));
    glowLayer.appendChild(heroSvg.cloneNode(true));

    window.requestAnimationFrame(function () {
      var mountedSvg = baseLayer.querySelector('svg');
      var box = mountedSvg ? mountedSvg.getBoundingClientRect() : null;

      if (box && box.width > 0 && box.height > 0) {
        mark.classList.add('site-preloader__screenl--ready');
      }
    });
  }

  function markReady() {
    loader = loader || document.getElementById('sitePreloader');

    if (!loader || hidden) {
      return;
    }

    hidden = true;
    targetProgress = 100;
    setProgress(100);

    if (rafId) {
      window.cancelAnimationFrame(rafId);
    }

    window.setTimeout(function () {
      root.classList.remove('has-site-preloader');
      root.classList.add('site-preloader-ready');
      loader.classList.add('site-preloader--hidden');
    }, 180);

    window.setTimeout(function () {
      if (loader && loader.parentNode) {
        loader.parentNode.removeChild(loader);
      }
    }, 830);
  }

  function hideWhenSmooth() {
    var elapsed = Date.now() - startedAt;
    var delay = Math.max(0, minVisible - elapsed);

    window.setTimeout(markReady, delay);
  }

  function initLoader() {
    loader = document.getElementById('sitePreloader');
    setProgress(0);
    mountScreenlSvg();
    startProgress();

    if (document.readyState === 'complete') {
      hideWhenSmooth();
    } else {
      window.addEventListener('load', hideWhenSmooth, { once: true });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initLoader, { once: true });
  } else {
    initLoader();
  }

  window.addEventListener('pageshow', function (event) {
    if (event.persisted) {
      markReady();
    }
  });

  window.setTimeout(markReady, maxVisible);
})();
