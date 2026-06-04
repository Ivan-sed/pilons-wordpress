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
            </header>

            <div class="trust__marquee" aria-label="Логотипы клиентов">
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
