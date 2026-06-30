<?php
/**
 * Section: benefits
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
        <!-- BENEFITS -->
        <section class="benefits" id="benefits" aria-labelledby="benefits-title">
            <div class="benefits__bg" aria-hidden="true">
                <picture>
                    <source srcset="<?php echo esc_url(SCREENL_URI . '/assets/shared/section-bg-gradient-primary.webp'); ?>" type="image/webp">
                    <img alt="" class="benefits__bg-img benefits__bg-img--primary" src="<?php echo esc_url(SCREENL_URI . '/assets/shared/section-bg-gradient-primary.png'); ?>" decoding="async" loading="eager">
                </picture>
                <picture>
                    <source srcset="<?php echo esc_url(SCREENL_URI . '/assets/shared/section-bg-gradient-secondary.webp'); ?>" type="image/webp">
                    <img alt="" class="benefits__bg-img benefits__bg-img--secondary" src="<?php echo esc_url(SCREENL_URI . '/assets/shared/section-bg-gradient-secondary.png'); ?>" decoding="async" loading="eager">
                </picture>
            </div>

            <div class="benefits__content">
                <h2 class="benefits__title" id="benefits-title">Ключевые преимущества</h2>

                <ul class="benefits__list">
                    <li class="benefits__row benefits__row--split">
                        <span class="benefits__item benefits__item--reels">
                            <span class="benefits__badge">Формат Reels</span>
                            <span class="benefits__item-text">2 пилона - 200х120 см</span>
                        </span>
                        <span class="benefits__item">Шаг - 1.86 мм</span>
                    </li>
                    <li class="benefits__row">
                        <span class="benefits__item">Разрешение одного пилона - 320х1080</span>
                    </li>
                    <li class="benefits__row benefits__row--split benefits__row--wide-left">
                        <span class="benefits__item">Бесшовное соединение пилонов</span>
                        <span class="benefits__item">Толщина 4 см</span>
                    </li>
                    <li class="benefits__row benefits__row--split">
                        <span class="benefits__item">Загрузка контента с планшета</span>
                        <span class="benefits__item benefits__item--hd">
                            <span class="benefits__badge">Full HD</span>
                            <span class="benefits__item-text">6 Пилонов - 16:9</span>
                        </span>
                    </li>
                    <li class="benefits__row benefits__row--tight">
                        <span class="benefits__item">Аккуратная конструкция без технических элементов на виду</span>
                    </li>
                    <li class="benefits__row benefits__row--split benefits__row--tight">
                        <span class="benefits__item">Загрузка контента с планшета</span>
                        <span class="benefits__item">Нужна только розетка 220 Вт</span>
                    </li>
                </ul>

                <button class="benefits__cta" type="button" data-modal-open>Получить расчёт</button>
            </div>

            <figure class="benefits__visual" aria-hidden="true">
                <img class="benefits__product" alt="" loading="lazy" decoding="async" src="<?php echo screenl_asset('benefits/pillar-product.png'); ?>">
                <span class="benefits__reflection">
                    <img class="benefits__reflection-img" alt="" loading="lazy" decoding="async" src="<?php echo screenl_asset('benefits/pillar-reflection.png'); ?>">
                </span>
            </figure>
        </section>
