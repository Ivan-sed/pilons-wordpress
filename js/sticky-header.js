(function () {
  var header = document.querySelector('.hero__header');
  if (!header) return;

  var menu = document.getElementById('menu');
  var hero = document.querySelector('.hero');
  var hideAfter = 120;
  var topOffset = 24;
  var deltaThreshold = 8;
  var lastY = getScrollY();
  var knownY = lastY;
  var ticking = false;
  var isHidden = header.classList.contains('hero__header--hidden');
  var isScrolled = header.classList.contains('hero__header--scrolled');

  function getScrollY() {
    return Math.max(window.pageYOffset || document.documentElement.scrollTop || 0, 0);
  }

  function isMenuOpen() {
    return menu && !menu.classList.contains('menu--closed');
  }

  function hasHeaderFocus() {
    return header.contains(document.activeElement);
  }

  function getScrolledAfter() {
    if (!hero) return 40;

    var heroBottom = hero.getBoundingClientRect().bottom + getScrollY();
    return Math.max(heroBottom - header.offsetHeight - 48, 40);
  }

  function setClass(name, active, current) {
    if (active !== current) {
      header.classList.toggle(name, active);
    }
    return active;
  }

  function applyState() {
    ticking = false;

    var y = knownY;
    var delta = y - lastY;
    var forceVisible = y <= topOffset || hasHeaderFocus() || isMenuOpen();
    var nextHidden = isHidden;
    var nextScrolled = y > getScrolledAfter();

    if (forceVisible || y <= hideAfter) {
      nextHidden = false;
    } else if (delta > deltaThreshold) {
      nextHidden = true;
    } else if (delta < -deltaThreshold) {
      nextHidden = false;
    }

    isScrolled = setClass('hero__header--scrolled', nextScrolled, isScrolled);
    isHidden = setClass('hero__header--hidden', nextHidden, isHidden);

    if (forceVisible || y <= hideAfter || Math.abs(delta) > deltaThreshold) {
      lastY = y;
    }
  }

  function requestState() {
    knownY = getScrollY();
    if (!ticking) {
      ticking = true;
      window.requestAnimationFrame(applyState);
    }
  }

  window.addEventListener('scroll', requestState, { passive: true });
  window.addEventListener('resize', requestState);
  header.addEventListener('focusin', requestState);
  header.addEventListener('focusout', requestState);

  if (menu && 'MutationObserver' in window) {
    new MutationObserver(requestState).observe(menu, {
      attributes: true,
      attributeFilter: ['class', 'aria-hidden']
    });
  }

  requestState();
})();
