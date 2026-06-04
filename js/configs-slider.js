(function () {
  var slider = document.querySelector('.configs__slider');
  if (!slider) return;

  var cards = Array.prototype.slice.call(slider.querySelectorAll('[data-config-card]'));
  var prevBtn = slider.querySelector('.configs__arrow--prev');
  var nextBtn = slider.querySelector('.configs__arrow--next');

  if (cards.length < 2 || !prevBtn || !nextBtn) return;

  var stateClasses = ['is-prev', 'is-current', 'is-next', 'is-hidden'];
  var activeIndex = readInitialIndex();

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

  setActive(activeIndex, false);
})();
