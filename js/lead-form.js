(function () {
  var forms = document.querySelectorAll('.js-lead-form');
  if (!forms.length) return;

  var EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // The text input lives inside a *__field wrapper that carries the error ring.
  function fieldOf(input) {
    return input ? input.closest('.contacts__field, .menu__field, .modal__field') : null;
  }

  function clearErrors(form) {
    form.querySelectorAll('.is-error').forEach(function (el) {
      el.classList.remove('is-error');
    });
    var errBox = form.querySelector('.js-form-error');
    if (errBox) {
      errBox.hidden = true;
      errBox.textContent = '';
    }
  }

  function showError(form, message, input) {
    var errBox = form.querySelector('.js-form-error');
    if (errBox) {
      errBox.textContent = message;
      errBox.hidden = false;
    }
    var field = fieldOf(input);
    if (field) field.classList.add('is-error');
    if (input) input.focus();
  }

  function validate(form) {
    var nameInput = form.querySelector('[name="name"]');
    var contactInput = form.querySelector('[name="contact"]');
    var name = nameInput ? nameInput.value.trim() : '';
    var contact = contactInput ? contactInput.value.trim() : '';

    if (!name) {
      return { ok: false, message: 'Пожалуйста, укажите имя', input: nameInput };
    }
    if (!contact) {
      return { ok: false, message: 'Укажите телефон или e-mail для связи', input: contactInput };
    }

    // Light check: looks like an email if it has "@", otherwise expect a real phone.
    var looksValid = contact.indexOf('@') !== -1
      ? EMAIL_RE.test(contact)
      : contact.replace(/\D/g, '').length >= 10;
    if (!looksValid) {
      return { ok: false, message: 'Проверьте телефон или e-mail', input: contactInput };
    }

    var messenger = form.querySelector('[name="messenger"]:checked');
    return {
      ok: true,
      data: {
        name: name,
        contact: contact,
        messenger: messenger ? messenger.value : ''
      }
    };
  }

  forms.forEach(function (form) {
    // Radio visual state: mirror the native :checked onto the label via .is-checked
    // (deliberately avoiding CSS :has() for broader browser support).
    form.addEventListener('change', function (e) {
      var radio = e.target;
      if (!radio.matches || !radio.matches('input[type="radio"]')) return;
      form.querySelectorAll('input[type="radio"][name="' + radio.name + '"]').forEach(function (r) {
        var label = r.closest('label');
        if (label) label.classList.toggle('is-checked', r.checked);
      });
    });

    // Drop a field's error ring as soon as the user starts fixing it.
    form.addEventListener('input', function (e) {
      var field = fieldOf(e.target);
      if (field) field.classList.remove('is-error');
    });

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      clearErrors(form);

      var result = validate(form);
      if (!result.ok) {
        showError(form, result.message, result.input);
        return;
      }

      var submitBtn = form.querySelector('[type="submit"]');
      if (submitBtn) submitBtn.disabled = true;

      var ajaxUrl = (typeof screenlTheme !== 'undefined' && screenlTheme.ajaxUrl)
        ? screenlTheme.ajaxUrl
        : '';
      var nonce = (typeof screenlTheme !== 'undefined' && screenlTheme.nonce)
        ? screenlTheme.nonce
        : '';

      if (!ajaxUrl) {
        showError(form, 'Форма недоступна. Обновите страницу.', null);
        if (submitBtn) submitBtn.disabled = false;
        return;
      }

      var params = new URLSearchParams({
        action: 'screenl_lead',
        nonce: nonce,
        name: result.data.name,
        contact: result.data.contact,
        messenger: result.data.messenger
      });

      fetch(ajaxUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: params.toString(),
        credentials: 'same-origin'
      })
        .then(function (res) { return res.json(); })
        .then(function (json) {
          if (!json || !json.success) {
            var msg = (json && json.data && json.data.message)
              ? json.data.message
              : 'Не удалось отправить заявку';
            throw new Error(msg);
          }
          var success = form.querySelector('.js-form-success');
          if (success) success.hidden = false;
          form.classList.add('is-sent');
        })
        .catch(function (err) {
          showError(form, err.message || 'Не удалось отправить заявку', null);
          if (submitBtn) submitBtn.disabled = false;
        });
    });
  });
})();
