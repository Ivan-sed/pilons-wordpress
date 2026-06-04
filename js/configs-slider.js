(function () {
  var slider = document.querySelector('.configs__slider');
  if (!slider) return;

  var track = slider.querySelector('.configs__track');
  var viewport = slider.querySelector('.configs__viewport');
  var cards = Array.prototype.slice.call(slider.querySelectorAll('.configs__card'));
  var prevBtn = slider.querySelector('.configs__arrow--prev');
  var nextBtn = slider.querySelector('.configs__arrow--next');

  if (!track || !viewport || cards.length < 2 || !prevBtn || !nextBtn) return;

  var INACTIVE_W = 539;
  var ACTIVE_W = 672;
  var ACTIVE_M = -113;

  var activeIndex = parseInt(slider.getAttribute('data-active') || '1', 10);
  if (isNaN(activeIndex) || activeIndex < 0 || activeIndex >= cards.length) {
    activeIndex = 1;
  }

  function computeLayout(activeIdx) {
    var cursor = 0;
    var centers = [];

    for (var i = 0; i < cards.length; i++) {
      var isActive = i === activeIdx;
      var ml = isActive ? ACTIVE_M : 0;
      var w = isActive ? ACTIVE_W : INACTIVE_W;
      var mr = isActive ? ACTIVE_M : 0;
      var left = cursor + ml;

      centers[i] = left + w / 2;
      cursor = left + w + mr;
    }

    return { trackWidth: cursor, centers: centers };
  }

  function alignTrack() {
    var layout = computeLayout(activeIndex);
    var offset = viewport.clientWidth / 2 - layout.centers[activeIndex];
    track.style.transform = 'translate3d(' + offset + 'px, 0, 0)';
  }

  function setActive(index) {
    activeIndex = (index + cards.length) % cards.length;
    slider.setAttribute('data-active', String(activeIndex));

    cards.forEach(function (card, i) {
      var isActive = i === activeIndex;
      card.classList.toggle('configs__card--active', isActive);
      card.classList.toggle('configs__card--inactive', !isActive);

      var media = card.querySelector('.configs__card-media');
      if (media) {
        media.classList.toggle('configs__card-media--inactive', !isActive);
      }

      // Only the active card and one neighbour on each side stay visible
      var rawDist = Math.abs(i - activeIndex);
      var dist = Math.min(rawDist, cards.length - rawDist);
      card.classList.toggle('configs__card--hidden', dist > 1);

      var desc = card.querySelector('.configs__card-desc');
      if (desc) {
        desc.classList.toggle('configs__card-desc--active', isActive);
      }
    });

    alignTrack();
  }

  prevBtn.addEventListener('click', function () {
    setActive(activeIndex - 1);
  });

  nextBtn.addEventListener('click', function () {
    setActive(activeIndex + 1);
  });

  cards.forEach(function (card, i) {
    card.addEventListener('click', function () {
      if (i !== activeIndex) setActive(i);
    });
  });

  slider.addEventListener('keydown', function (event) {
    if (event.key === 'ArrowLeft') {
      event.preventDefault();
      setActive(activeIndex - 1);
    } else if (event.key === 'ArrowRight') {
      event.preventDefault();
      setActive(activeIndex + 1);
    }
  });

  window.addEventListener('resize', alignTrack);

  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(alignTrack);
  }

  setActive(activeIndex);
})();
