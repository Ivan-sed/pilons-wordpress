(function () {
  var slider = document.querySelector('.configs__slider');
  if (!slider) return;

  var cards = Array.prototype.slice.call(slider.querySelectorAll('[data-config-card]'));
  var prevBtn = slider.querySelector('.configs__arrow--prev');
  var nextBtn = slider.querySelector('.configs__arrow--next');

  if (cards.length < 2 || !prevBtn || !nextBtn) return;

  var stateClasses = ['is-prev', 'is-current', 'is-next', 'is-hidden'];
  var activeIndex = readInitialIndex();
  var swipe = {
    pointerId: null,
    startX: 0,
    startY: 0,
    moved: false,
  };

  function readInitialIndex() {
    var index = parseInt(slider.getAttribute('data-active') || '1', 10);
    return Number.isFinite(index) && index >= 0 && index < cards.length ? index : 1;
  }

  function wrap(index) {
    return (index % cards.length + cards.length) % cards.length;
  }

  function getRole(index) {
    if (index === activeIndex) return 'is-current';
    if (index === wrap(activeIndex - 1)) return 'is-prev';
    if (index === wrap(activeIndex + 1)) return 'is-next';
    return 'is-hidden';
  }

  function syncCard(card, role, index) {
    var button = card.querySelector('.configs__card-button');
    var hidden = role === 'is-hidden';
    var current = role === 'is-current';

    stateClasses.forEach(function (className) {
      card.classList.toggle(className, className === role);
    });

    if (hidden) {
      card.setAttribute('aria-hidden', 'true');
    } else {
      card.removeAttribute('aria-hidden');
    }

    if (!button) return;

    button.tabIndex = hidden ? -1 : 0;
    if (current) {
      button.setAttribute('aria-current', 'true');
    } else {
      button.removeAttribute('aria-current');
    }
    button.dataset.slideTarget = String(index);
  }

  function setActive(index, moveFocus) {
    activeIndex = wrap(index);
    slider.setAttribute('data-active', String(activeIndex));

    cards.forEach(function (card, cardIndex) {
      syncCard(card, getRole(cardIndex), cardIndex);
    });

    if (moveFocus) {
      var activeButton = cards[activeIndex].querySelector('.configs__card-button');
      if (activeButton) activeButton.focus();
    }
  }

  prevBtn.addEventListener('click', function () {
    setActive(activeIndex - 1, false);
  });

  nextBtn.addEventListener('click', function () {
    setActive(activeIndex + 1, false);
  });

  cards.forEach(function (card, index) {
    var button = card.querySelector('.configs__card-button');
    if (!button) return;

    button.addEventListener('click', function () {
      if (index !== activeIndex) {
        setActive(index, false);
      }
    });
  });

  slider.addEventListener('keydown', function (event) {
    if (event.key === 'ArrowLeft') {
      event.preventDefault();
      setActive(activeIndex - 1, true);
    } else if (event.key === 'ArrowRight') {
      event.preventDefault();
      setActive(activeIndex + 1, true);
    } else if (event.key === 'Home') {
      event.preventDefault();
      setActive(0, true);
    } else if (event.key === 'End') {
      event.preventDefault();
      setActive(cards.length - 1, true);
    }
  });

  function resetSwipe() {
    swipe.pointerId = null;
    swipe.startX = 0;
    swipe.startY = 0;
    swipe.moved = false;
  }

  function onPointerDown(event) {
    if (!event.isPrimary && event.pointerType !== 'mouse') return;
    if (event.target.closest && event.target.closest('.configs__arrow')) return;

    swipe.pointerId = event.pointerId;
    swipe.startX = event.clientX;
    swipe.startY = event.clientY;
    swipe.moved = false;

    if (slider.setPointerCapture) {
      try {
        slider.setPointerCapture(event.pointerId);
      } catch (error) {
        // Pointer capture is a progressive enhancement here.
      }
    }
  }

  function onPointerMove(event) {
    if (swipe.pointerId == null || event.pointerId !== swipe.pointerId) return;

    var dx = event.clientX - swipe.startX;
    var dy = event.clientY - swipe.startY;
    if (Math.abs(dx) > 12 || Math.abs(dy) > 12) {
      swipe.moved = true;
    }
  }

  function onPointerEnd(event) {
    if (swipe.pointerId == null || event.pointerId !== swipe.pointerId) return;

    var dx = event.clientX - swipe.startX;
    var dy = event.clientY - swipe.startY;
    var absX = Math.abs(dx);
    var absY = Math.abs(dy);

    if (swipe.moved && absX >= 46 && absX > absY * 1.25) {
      setActive(activeIndex + (dx < 0 ? 1 : -1), false);
    }

    resetSwipe();
  }

  if (window.PointerEvent) {
    slider.addEventListener('pointerdown', onPointerDown);
    slider.addEventListener('pointermove', onPointerMove, { passive: true });
    slider.addEventListener('pointerup', onPointerEnd);
    slider.addEventListener('pointercancel', resetSwipe);
    slider.addEventListener('lostpointercapture', resetSwipe);
  }

  setActive(activeIndex, false);
})();
