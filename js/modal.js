(function () {
  var modal = document.getElementById('leadModal');
  if (!modal) return;

  // Remember the element that opened the modal so focus can return to it.
  var lastTrigger = null;

  function setOpen(open) {
    modal.classList.toggle('modal--closed', !open);
    modal.setAttribute('aria-hidden', open ? 'false' : 'true');
    document.body.style.overflow = open ? 'hidden' : '';
  }

  function resetForm() {
    var form = modal.querySelector('.js-lead-form');
    if (!form) return;
    form.classList.remove('is-sent');
    form.reset();
    form.querySelectorAll('.is-error, .is-checked').forEach(function (el) {
      el.classList.remove('is-error', 'is-checked');
    });
    var errBox = form.querySelector('.js-form-error');
    if (errBox) {
      errBox.hidden = true;
      errBox.textContent = '';
    }
    var success = form.querySelector('.js-form-success');
    if (success) success.hidden = true;
  }

  function openModal(trigger) {
    lastTrigger = trigger || null;
    setOpen(true);
    var nameInput = modal.querySelector('[name="name"]');
    if (nameInput) nameInput.focus();
  }

  function closeModal() {
    setOpen(false);
    resetForm();
    if (lastTrigger && typeof lastTrigger.focus === 'function') {
      lastTrigger.focus();
    }
    lastTrigger = null;
  }

  // Any CTA marked data-modal-open launches the popup.
  document.querySelectorAll('[data-modal-open]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      openModal(btn);
    });
  });

  // Backdrop and close button both carry data-modal-close.
  modal.addEventListener('click', function (e) {
    if (e.target.closest('[data-modal-close]')) {
      closeModal();
    }
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !modal.classList.contains('modal--closed')) {
      closeModal();
    }
  });
})();
