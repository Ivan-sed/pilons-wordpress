(function () {
  var menu = document.getElementById('menu');
  var openBtn = document.getElementById('menuOpen');
  if (!menu || !openBtn) return;

  var closeBtn = menu.querySelector('.menu__close');
  var lockKey = 'menu';
  var overlayLock = window.screenlOverlayLock;

  function setOpen(open) {
    menu.classList.toggle('menu--closed', !open);
    menu.setAttribute('aria-hidden', open ? 'false' : 'true');
    openBtn.setAttribute('aria-expanded', open ? 'true' : 'false');

    if (open) {
      if (overlayLock) overlayLock.lock(lockKey);
    } else if (overlayLock) {
      overlayLock.unlock(lockKey);
    }
  }

  openBtn.addEventListener('click', function () {
    setOpen(true);
  });

  if (closeBtn) {
    closeBtn.addEventListener('click', function () {
      setOpen(false);
    });
  }

  // Click on the dimmed backdrop closes the menu.
  menu.addEventListener('click', function (e) {
    if (e.target.classList.contains('menu__backdrop')) {
      setOpen(false);
    }
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !menu.classList.contains('menu--closed')) {
      setOpen(false);
    }
  });

  // In-menu navigation links close the overlay before scrolling to the target.
  menu.querySelectorAll('.menu__link').forEach(function (link) {
    link.addEventListener('click', function () {
      setOpen(false);
    });
  });
})();
