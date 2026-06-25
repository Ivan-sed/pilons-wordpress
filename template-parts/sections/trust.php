<?php
/**
 * Section: trust
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}

$trust_logos = range(1, 33);
?>
        <!-- TRUST -->
        <section class="trust" id="trust" aria-labelledby="trust-title">
            <header class="trust__header">
                <h2 class="trust__title" id="trust-title">Нам доверяют</h2>
                <div class="trust__controls" aria-label="Управление логотипами">
                    <button class="trust__control trust__control--prev" type="button" data-trust-prev aria-label="Прокрутить логотипы назад">
                        <svg class="trust__control-icon" fill="none" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5L5 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </button>
                    <button class="trust__control trust__control--next" type="button" data-trust-next aria-label="Прокрутить логотипы вперёд">
                        <svg class="trust__control-icon" fill="none" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5L19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M19 12H5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </button>
                </div>
            </header>

            <div class="trust__marquee" aria-label="Логотипы клиентов" data-trust-marquee>
                <div class="trust__track">
                    <div class="trust__logos">
                        <?php foreach ($trust_logos as $index) : ?>
                            <div class="trust__logo trust__logo--<?php echo esc_attr((string) $index); ?>">
                                <img class="trust__logo-img trust__logo-img--base" alt="<?php echo esc_attr__('Логотип клиента', 'screenl'); ?>" width="230" height="230" loading="lazy" decoding="async" src="<?php echo screenl_asset('trust/' . $index . '.png'); ?>">
                                <img class="trust__logo-img trust__logo-img--hover" alt="" aria-hidden="true" width="230" height="230" loading="lazy" decoding="async" src="<?php echo screenl_asset('trust/hover/' . $index . '.png'); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
