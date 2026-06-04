<?php
/**
 * Section: trust
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}

$trust_logos = [
    1  => 'Логотип клиента',
    2  => 'Логотип клиента',
    3  => 'Логотип клиента',
    4  => 'Московский Транспорт',
    5  => 'Логотип клиента',
    6  => 'Яндекс',
    7  => 'Larnilane',
    8  => 'Логотип клиента',
    9  => 'Логотип клиента',
    10 => 'Логотип клиента',
    11 => 'Логотип клиента',
    12 => 'Логотип клиента',
    13 => 'Логотип клиента',
    14 => 'Логотип клиента',
];
?>
        <!-- TRUST -->
        <section class="trust" id="trust" aria-labelledby="trust-title">
            <header class="trust__header">
                <h2 class="trust__title" id="trust-title">Нам доверяют</h2>
                <div class="trust__controls" aria-label="Управление логотипами">
                    <button class="trust__control trust__control--prev" type="button" data-trust-prev aria-label="Прокрутить логотипы назад">
                        <svg class="trust__control-icon" fill="none" viewBox="0 0 18 18" aria-hidden="true"><path d="M11.5 4L6.5 9L11.5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </button>
                    <button class="trust__control trust__control--next" type="button" data-trust-next aria-label="Прокрутить логотипы вперёд">
                        <svg class="trust__control-icon" fill="none" viewBox="0 0 18 18" aria-hidden="true"><path d="M6.5 4L11.5 9L6.5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </button>
                </div>
            </header>

            <div class="trust__marquee" aria-label="Логотипы клиентов" data-trust-marquee>
                <div class="trust__track">
                    <div class="trust__logos">
                        <?php foreach ($trust_logos as $index => $alt) : ?>
                            <div class="trust__logo trust__logo--<?php echo esc_attr((string) $index); ?>">
                                <img class="trust__logo-img trust__logo-img--base" alt="<?php echo esc_attr($alt); ?>" width="230" height="230" loading="lazy" decoding="async" src="<?php echo screenl_asset('trust/' . $index . '.png'); ?>">
                                <img class="trust__logo-img trust__logo-img--hover" alt="" aria-hidden="true" width="230" height="230" loading="lazy" decoding="async" src="<?php echo screenl_asset('trust/hover/' . $index . '.png'); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
