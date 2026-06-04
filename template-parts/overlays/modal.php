<?php
/** Lead modal */
if (!defined('ABSPATH')) exit;
?>
<!-- LEAD POPUP -->
<div class="modal modal--closed" id="leadModal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="leadModalTitle">
    <div class="modal__backdrop" data-modal-close></div>
    <div class="modal__dialog" role="document">
        <button class="modal__close" type="button" data-modal-close aria-label="Закрыть">
            <svg class="modal__close-svg" fill="none" preserveAspectRatio="none" viewBox="0 0 10 10"><path d="M1 1L9 9M9 1L1 9" stroke="#060B20" stroke-width="2" stroke-linecap="round"></path></svg>
        </button>
        <div class="modal__head">
            <h2 class="modal__title" id="leadModalTitle">Обсудить проект</h2>
            <p class="modal__sub">Подберём конфигурацию под ваше событие и рассчитаем стоимость</p>
        </div>
        <form class="modal__form js-lead-form" novalidate>
            <div class="modal__fields">
                <div class="modal__field"><input class="modal__input" type="text" name="name" placeholder="Имя" autocomplete="name" required></div>
                <div class="modal__field"><input class="modal__input" type="text" name="contact" placeholder="Телефон / E-mail" autocomplete="tel" required></div>
            </div>
            <div class="modal__messengers">
                <p class="modal__messenger-label">Где удобно связаться?</p>
                <div class="modal__messenger-options">
                    <label class="modal__messenger-option"><input class="modal__messenger-input" type="radio" name="messenger" value="Telegram"><span class="modal__messenger-radio" aria-hidden="true"></span><span class="modal__messenger-option-text">Telegram</span></label>
                    <label class="modal__messenger-option"><input class="modal__messenger-input" type="radio" name="messenger" value="MAX"><span class="modal__messenger-radio" aria-hidden="true"></span><span class="modal__messenger-option-text">МАХ</span></label>
                    <label class="modal__messenger-option"><input class="modal__messenger-input" type="radio" name="messenger" value="Телефон"><span class="modal__messenger-radio" aria-hidden="true"></span><span class="modal__messenger-option-text">Телефон</span></label>
                    <label class="modal__messenger-option"><input class="modal__messenger-input" type="radio" name="messenger" value="Почта"><span class="modal__messenger-radio" aria-hidden="true"></span><span class="modal__messenger-option-text">Почта</span></label>
                </div>
            </div>
            <p class="modal__error js-form-error" role="alert" aria-live="polite" hidden></p>
            <button class="modal__submit" type="submit">Получить расчёт</button>
            <div class="modal__success js-form-success" hidden>
                <p class="modal__success-title">Спасибо! Заявка отправлена</p>
                <p class="modal__success-text">Свяжемся с вами в течение 10 минут</p>
            </div>
        </form>
    </div>
</div>