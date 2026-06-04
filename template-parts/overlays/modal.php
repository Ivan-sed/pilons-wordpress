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
        <?php screenl_render_lead_form('modal'); ?>
    </div>
</div>
