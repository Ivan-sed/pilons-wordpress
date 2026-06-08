(function () {
  var modal = document.getElementById('videoModal');
  if (!modal) return;

  var player = modal.querySelector('.video-modal__player');
  if (!player) return;

  var lastTrigger = null;
  var lockKey = 'video';
  var overlayLock = window.screenlOverlayLock;

  function playThumbs() {
    document.querySelectorAll('.scenarios__video-thumb').forEach(function (video) {
      var promise = video.play();
      if (promise && typeof promise.catch === 'function') {
        promise.catch(function () {});
      }
    });
  }

  function setOpen(open) {
    modal.classList.toggle('video-modal--closed', !open);
    modal.setAttribute('aria-hidden', open ? 'false' : 'true');

    if (open) {
      if (overlayLock) overlayLock.lock(lockKey);
    } else if (overlayLock) {
      overlayLock.unlock(lockKey);
    }
  }

  function openVideo(trigger) {
    var src = trigger.getAttribute('data-video-src');
    if (!src) return;

    lastTrigger = trigger;
    modal.querySelector('.video-modal__dialog').style.removeProperty('--video-ratio');
    player.src = src;
    setOpen(true);
    player.focus();

    var playPromise = player.play();
    if (playPromise && typeof playPromise.catch === 'function') {
      playPromise.catch(function () {});
    }
  }

  player.addEventListener('loadedmetadata', function () {
    if (!player.videoWidth || !player.videoHeight) return;
    modal.querySelector('.video-modal__dialog').style.setProperty('--video-ratio', player.videoWidth + ' / ' + player.videoHeight);
  });

  function closeVideo() {
    player.pause();
    player.removeAttribute('src');
    player.load();
    setOpen(false);

    if (lastTrigger && typeof lastTrigger.focus === 'function') {
      lastTrigger.focus();
    }
    lastTrigger = null;
  }

  document.addEventListener('click', function (e) {
    var trigger = e.target.closest('[data-video-open]');
    if (!trigger) return;
    openVideo(trigger);
  });

  modal.addEventListener('click', function (e) {
    if (e.target.closest('[data-video-close]')) {
      closeVideo();
    }
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !modal.classList.contains('video-modal--closed')) {
      closeVideo();
    }
  });

  playThumbs();
  window.addEventListener('load', playThumbs);
})();
