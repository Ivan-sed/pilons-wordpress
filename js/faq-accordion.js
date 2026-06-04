(function () {
  var root = document.querySelector('.faq');
  if (!root) return;

  var items = Array.prototype.slice.call(root.querySelectorAll('.faq__item'));
  if (!items.length) return;

  var allowMultiple = root.getAttribute('data-allow-multiple') === 'true';

  function hasContent(panel) {
    var inner = panel.querySelector('.faq__panel-inner');
    var answer = inner && inner.querySelector('.faq__answer');
    return !!(answer && answer.textContent.trim());
  }

  // Cancel any pending "hide after close animation" work on a panel.
  function cancelPendingHide(panel) {
    if (panel._faqHideHandler) {
      panel.removeEventListener('transitionend', panel._faqHideHandler);
      panel._faqHideHandler = null;
    }
    if (panel._faqHideTimer) {
      clearTimeout(panel._faqHideTimer);
      panel._faqHideTimer = null;
    }
  }

  function openItem(item, animate) {
    var trigger = item.querySelector('.faq__trigger');
    var panel = item.querySelector('.faq__panel');
    if (!trigger || !panel) return;

    cancelPendingHide(panel);

    panel.hidden = false;
    trigger.setAttribute('aria-expanded', 'true');
    if (hasContent(panel)) panel.setAttribute('role', 'region');

    if (animate) {
      // Force a reflow so the grid 0fr -> 1fr (and content fade) actually transition.
      void panel.offsetHeight;
    }
    item.classList.add('faq__item--open');
  }

  function closeItem(item) {
    var trigger = item.querySelector('.faq__trigger');
    var panel = item.querySelector('.faq__panel');
    if (!trigger || !panel || !item.classList.contains('faq__item--open')) return;

    // Removing the class lets the panel animate 1fr -> 0fr (instead of being
    // hidden instantly). We only set [hidden] once the collapse has finished.
    item.classList.remove('faq__item--open');
    trigger.setAttribute('aria-expanded', 'false');

    cancelPendingHide(panel);

    var finish = function (e) {
      if (e) {
        if (e.target !== panel) return;
        if (e.propertyName && e.propertyName !== 'grid-template-rows') return;
      }
      // Guard against a re-open that happened mid-animation.
      if (item.classList.contains('faq__item--open')) {
        cancelPendingHide(panel);
        return;
      }
      panel.hidden = true;
      panel.removeAttribute('role');
      cancelPendingHide(panel);
    };

    panel._faqHideHandler = finish;
    panel.addEventListener('transitionend', finish);
    // Fallback in case transitionend doesn't fire (e.g. reduced motion).
    panel._faqHideTimer = setTimeout(finish, 600);
  }

  function closeOthers(except) {
    items.forEach(function (item) {
      if (item !== except && item.classList.contains('faq__item--open')) {
        closeItem(item);
      }
    });
  }

  items.forEach(function (item) {
    var trigger = item.querySelector('.faq__trigger');
    var panel = item.querySelector('.faq__panel');
    if (!trigger || !panel) return;

    trigger.addEventListener('click', function () {
      var willOpen = !item.classList.contains('faq__item--open');

      if (willOpen) {
        if (!hasContent(panel)) return;
        if (!allowMultiple) closeOthers(item);
        openItem(item, true);
      } else {
        closeItem(item);
      }
    });
  });

  // Initialise: sync aria/state for pre-opened items without animating.
  items.forEach(function (item) {
    var trigger = item.querySelector('.faq__trigger');
    var panel = item.querySelector('.faq__panel');
    if (!trigger || !panel) return;

    if (item.classList.contains('faq__item--open')) {
      openItem(item, false);
    } else {
      trigger.setAttribute('aria-expanded', 'false');
    }
  });
})();
