(function () {
  var header = document.querySelector('.hero__header');
  if (!header) return;

  var menu = document.getElementById('menu');
  var hero = document.querySelector('.hero');
  var legalHero = document.querySelector('.legal-page__hero');
  var legalLayout = document.querySelector('.legal-page__layout');
  var ticking = false;
  var isScrolled = header.classList.contains('hero__header--scrolled');

  // With slide-by-slide scrolling the header should always stay visible.
  header.classList.remove('hero__header--hidden');

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
    if (hero) {
      var heroBottom = hero.getBoundingClientRect().bottom + getScrollY();
      return Math.max(heroBottom - header.offsetHeight - 48, 40);
    }

    if (legalLayout) {
      var layoutTop = legalLayout.getBoundingClientRect().top + getScrollY();
      return Math.max(layoutTop - header.offsetHeight - 48, 40);
    }

    if (!legalHero) return 40;

    var legalHeroBottom = legalHero.getBoundingClientRect().bottom + getScrollY();
    return Math.max(legalHeroBottom - header.offsetHeight - 48, 40);
  }

  function setClass(name, active, current) {
    if (active !== current) {
      header.classList.toggle(name, active);
    }
    return active;
  }

  function applyState() {
    ticking = false;

    var y = getScrollY();
    var nextScrolled = y > getScrolledAfter();

    isScrolled = setClass('hero__header--scrolled', nextScrolled, isScrolled);
  }

  function requestState() {
    if (!ticking) {
      ticking = true;
      window.requestAnimationFrame(applyState);
    }
  }

  window.addEventListener('scroll', requestState, { passive: true });
  window.addEventListener('resize', requestState);

  requestState();
})();
