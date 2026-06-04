(function () {
  var marquee = document.querySelector('[data-trust-marquee]');
  if (!marquee) return;

  var track = marquee.querySelector('.trust__track');
  var row = marquee.querySelector('.trust__logos');
  if (!track || !row) return;
  if (track.getAttribute('data-marquee-ready') === 'true') return;

  var reduceMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
  var prevButton = document.querySelector('[data-trust-prev]');
  var nextButton = document.querySelector('[data-trust-next]');
  var clone = row.cloneNode(true);
  var offset = 0;
  var segmentWidth = 0;
  var step = 0;
  var lastTime = 0;
  var pausedUntil = 0;
  var isHovering = false;
  var isDragging = false;
  var dragStartX = 0;
  var dragStartOffset = 0;
  var activePointerId = null;
  var nudge = null;

  clone.setAttribute('aria-hidden', 'true');
  clone.querySelectorAll('img').forEach(function (img) {
    img.alt = '';
    img.draggable = false;
  });
  row.querySelectorAll('img').forEach(function (img) {
    img.draggable = false;
  });
  track.appendChild(clone);
  track.setAttribute('data-marquee-ready', 'true');

  function normalize(value) {
    if (!segmentWidth) return 0;

    var normalized = value % segmentWidth;
    return normalized < 0 ? normalized + segmentWidth : normalized;
  }

  function render() {
    track.style.transform = 'translate3d(' + (-normalize(offset)) + 'px, 0, 0)';
  }

  function measure() {
    var logo = row.querySelector('.trust__logo');
    var styles = window.getComputedStyle(row);
    var gap = parseFloat(styles.columnGap || styles.gap || '0') || 0;

    segmentWidth = row.getBoundingClientRect().width;
    step = logo ? logo.getBoundingClientRect().width + gap : segmentWidth / 6;
    offset = normalize(offset);
    render();
  }

  function easeOutCubic(t) {
    return 1 - Math.pow(1 - t, 3);
  }

  function pauseFor(ms) {
    pausedUntil = Math.max(pausedUntil, performance.now() + ms);
  }

  function startNudge(direction) {
    if (!segmentWidth || !step) return;

    nudge = {
      from: offset,
      distance: direction * step,
      start: performance.now(),
      duration: 360,
    };
    pauseFor(520);
  }

  function tick(time) {
    if (!lastTime) lastTime = time;

    var dt = (time - lastTime) / 1000;
    lastTime = time;

    if (segmentWidth) {
      if (nudge) {
        var progress = Math.min((time - nudge.start) / nudge.duration, 1);
        offset = nudge.from + nudge.distance * easeOutCubic(progress);

        if (progress >= 1) {
          offset = normalize(offset);
          nudge = null;
        }
      } else if (!isDragging && !isHovering && !reduceMotionQuery.matches && time > pausedUntil) {
        offset += (segmentWidth / 36) * dt;
      }

      render();
    }

    window.requestAnimationFrame(tick);
  }

  function getClientX(event) {
    return typeof event.clientX === 'number' ? event.clientX : 0;
  }

  function onPointerDown(event) {
    if (event.button != null && event.button !== 0) return;

    isDragging = true;
    activePointerId = event.pointerId;
    dragStartX = getClientX(event);
    dragStartOffset = offset;
    nudge = null;
    marquee.classList.add('is-dragging');
    pauseFor(1200);

    if (marquee.setPointerCapture && activePointerId != null) {
      marquee.setPointerCapture(activePointerId);
    }
  }

  function onPointerMove(event) {
    if (!isDragging) return;
    if (activePointerId != null && event.pointerId !== activePointerId) return;

    offset = dragStartOffset - (getClientX(event) - dragStartX);
    render();
    event.preventDefault();
  }

  function stopDragging(event) {
    if (!isDragging) return;
    if (activePointerId != null && event && event.pointerId !== activePointerId) return;

    isDragging = false;
    activePointerId = null;
    offset = normalize(offset);
    marquee.classList.remove('is-dragging');
    pauseFor(900);
  }

  marquee.addEventListener('pointerdown', onPointerDown);
  marquee.addEventListener('pointermove', onPointerMove);
  marquee.addEventListener('pointerup', stopDragging);
  marquee.addEventListener('pointercancel', stopDragging);
  marquee.addEventListener('lostpointercapture', stopDragging);
  marquee.addEventListener('mouseenter', function () {
    isHovering = true;
  });
  marquee.addEventListener('mouseleave', function () {
    isHovering = false;
    stopDragging();
  });
  marquee.addEventListener('dragstart', function (event) {
    event.preventDefault();
  });

  if (prevButton) {
    prevButton.addEventListener('click', function () {
      startNudge(-1);
    });
  }

  if (nextButton) {
    nextButton.addEventListener('click', function () {
      startNudge(1);
    });
  }

  window.addEventListener('resize', function () {
    window.requestAnimationFrame(measure);
  });
  window.addEventListener('load', measure);

  if (typeof ResizeObserver !== 'undefined') {
    new ResizeObserver(measure).observe(row);
  }

  measure();
  window.requestAnimationFrame(tick);
})();
