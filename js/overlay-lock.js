(function () {
  if (window.screenlOverlayLock) return;

  var locks = {};

  function sync() {
    var locked = Object.keys(locks).some(function (key) {
      return locks[key];
    });

    document.body.classList.toggle('is-overlay-locked', locked);
  }

  window.screenlOverlayLock = {
    lock: function (key) {
      locks[key] = true;
      sync();
    },
    unlock: function (key) {
      delete locks[key];
      sync();
    }
  };
})();
