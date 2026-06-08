(function () {
  var finePointer = window.matchMedia('(pointer: fine)');
  if (!finePointer.matches) return;

  var cursor = document.createElement('div');
  cursor.className = 'custom-cursor';
  cursor.setAttribute('aria-hidden', 'true');
  cursor.innerHTML = '<span class="custom-cursor__ring"></span><span class="custom-cursor__dot"></span>';
  document.body.appendChild(cursor);
  document.documentElement.classList.add('has-custom-cursor');

  var x = window.innerWidth / 2;
  var y = window.innerHeight / 2;
  var tx = x;
  var ty = y;
  var visible = false;
  var rafId = null;
  var hoverSelector = [
    'a',
    'button',
    'input',
    'textarea',
    'select',
    '[role="button"]',
    '[data-modal-open]',
    '[data-video-open]',
    '.configs__arrow',
    '.trust__marquee',
    '.content__visual'
  ].join(',');

  function render() {
    rafId = null;

    x += (tx - x) * 0.22;
    y += (ty - y) * 0.22;
    cursor.style.transform = 'translate3d(' + x + 'px, ' + y + 'px, 0)';

    if (visible && (Math.abs(tx - x) > 0.1 || Math.abs(ty - y) > 0.1)) {
      rafId = window.requestAnimationFrame(render);
    }
  }

  function requestRender() {
    if (!rafId) {
      rafId = window.requestAnimationFrame(render);
    }
  }

  function cancelRender() {
    if (!rafId) return;
    window.cancelAnimationFrame(rafId);
    rafId = null;
  }

  function setVisible(nextVisible) {
    if (visible === nextVisible) return;
    visible = nextVisible;
    cursor.classList.toggle('custom-cursor--visible', visible);

    if (visible) {
      requestRender();
    } else {
      cancelRender();
    }
  }

  document.addEventListener('pointermove', function (event) {
    if (event.pointerType && event.pointerType !== 'mouse') return;
    tx = event.clientX;
    ty = event.clientY;
    setVisible(true);
    requestRender();
  }, { passive: true });

  document.addEventListener('pointerover', function (event) {
    if (event.target.closest(hoverSelector)) {
      cursor.classList.add('custom-cursor--hover');
    }
  });

  document.addEventListener('pointerout', function (event) {
    if (event.target.closest(hoverSelector)) {
      cursor.classList.remove('custom-cursor--hover');
    }
  });

  document.addEventListener('pointerdown', function () {
    cursor.classList.add('custom-cursor--down');
  });

  document.addEventListener('pointerup', function () {
    cursor.classList.remove('custom-cursor--down');
  });

  document.addEventListener('mouseleave', function () {
    setVisible(false);
  });

  document.addEventListener('visibilitychange', function () {
    if (document.hidden) {
      setVisible(false);
    }
  });
})();
