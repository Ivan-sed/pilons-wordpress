(function () {
  var root = document.documentElement;
  var startedAt = Date.now();
  var minVisible = 620;
  var maxVisible = 4200;
  var hidden = false;

  root.classList.add('has-site-preloader');

  function markReady() {
    var loader = document.getElementById('sitePreloader');

    if (!loader || hidden) {
      return;
    }

    hidden = true;
    root.classList.remove('has-site-preloader');
    root.classList.add('site-preloader-ready');
    loader.classList.add('site-preloader--hidden');

    window.setTimeout(function () {
      if (loader && loader.parentNode) {
        loader.parentNode.removeChild(loader);
      }
    }, 650);
  }

  function hideWhenSmooth() {
    var elapsed = Date.now() - startedAt;
    var delay = Math.max(0, minVisible - elapsed);

    window.setTimeout(markReady, delay);
  }

  if (document.readyState === 'complete') {
    hideWhenSmooth();
  } else {
    window.addEventListener('load', hideWhenSmooth, { once: true });
  }

  window.addEventListener('pageshow', function (event) {
    if (event.persisted) {
      markReady();
    }
  });

  window.setTimeout(markReady, maxVisible);
})();
