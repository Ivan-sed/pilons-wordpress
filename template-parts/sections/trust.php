<?php
/**
 * Section: trust
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}

$trust_items = [
    ['name' => '1C', 'base' => '1.jpg', 'hover' => 'hover/1.jpg'],
    ['name' => 'BALAGAN', 'base' => '2.jpg', 'hover' => 'hover/2.jpg'],
    ['name' => 'bema!', 'base' => '3.jpg', 'hover' => 'hover/3.jpg'],
    ['name' => 'СУББОТИН КОНФА', 'base' => '4.jpg', 'hover' => 'hover/4.jpg'],
    ['name' => 'FABRIKA', 'base' => '5.jpg', 'hover' => 'hover/5.jpg'],
    ['name' => 'FONBET', 'base' => '6.jpg', 'hover' => 'hover/6.jpg'],
    ['name' => 'GEF', 'base' => '7.jpg', 'hover' => 'hover/7.jpg'],
    ['name' => 'IMARUSSIA', 'base' => '8.jpg', 'hover' => 'hover/8.jpg'],
    ['name' => 'INNOPROM', 'base' => '9.jpg', 'hover' => 'hover/9.jpg'],
    ['name' => 'IT\'S ON', 'base' => '10.png', 'hover' => 'hover/10.jpg'],
    ['name' => 'JOURNEY', 'base' => '11.jpg', 'hover' => 'hover/11.jpg'],
    ['name' => 'LAMODA', 'base' => '12.png', 'hover' => 'hover/12.jpg'],
    ['name' => 'LARNILANE', 'base' => '13.jpg', 'hover' => 'hover/13.jpg'],
    ['name' => 'LUMISFERA', 'base' => '14.webp', 'hover' => 'hover/14.jpg'],
    ['name' => 'MMCO', 'base' => '15.jpg', 'hover' => 'hover/15.jpg'],
    ['name' => 'MOSCOW STARTUP SUMMIT', 'base' => '16.png', 'hover' => 'hover/16.jpg'],
    ['name' => 'MUSIC MAX GROUP', 'base' => '17.jpg', 'hover' => 'hover/17.jpg'],
    ['name' => 'OVICUP', 'base' => '18.jpg', 'hover' => 'hover/18.jpg'],
    ['name' => 'OZON', 'base' => '19.png', 'hover' => 'hover/19.jpg'],
    ['name' => 'TANK', 'base' => '20.webp', 'hover' => 'hover/20.jpg'],
    ['name' => 'TCL', 'base' => '21.jpg', 'hover' => 'hover/21.jpg'],
    ['name' => 'TRAILCONF', 'base' => '22.jpg', 'hover' => 'hover/22.jpg'],
    ['name' => 'VK', 'base' => '23.png', 'hover' => 'hover/23.jpg'],
    ['name' => 'АНО', 'base' => '24.png', 'hover' => 'hover/24.png'],
    ['name' => 'ВШЭ', 'base' => '25.png', 'hover' => 'hover/25.jpg'],
    ['name' => 'МОСКОВСКИЙ ТРАНСПОРТ', 'base' => '26.webp', 'hover' => 'hover/26.jpg'],
    ['name' => 'МОСОБЛСПОРТ', 'base' => '27.jpg', 'hover' => 'hover/27.jpg'],
    ['name' => 'РБК', 'base' => '28.webp', 'hover' => 'hover/28.jpg'],
    ['name' => 'СБЕРБАНК', 'base' => '29.png', 'hover' => 'hover/29.jpg'],
    ['name' => 'СТОЛОТО', 'base' => '30.jpg', 'hover' => 'hover/30.jpg'],
    ['name' => 'ТАВРИДААРТ', 'base' => '31.jpg', 'hover' => 'hover/31.jpg'],
    ['name' => 'ТБАНК', 'base' => '32.webp', 'hover' => 'hover/32.jpg'],
    ['name' => 'ФК РОДИНА', 'base' => '33.png', 'hover' => 'hover/33.jpg'],
    ['name' => 'ФНЛ', 'base' => '34.jpg', 'hover' => 'hover/34.jpg'],
    ['name' => 'ЯНДЕКС', 'base' => '35.png', 'hover' => 'hover/35.jpg'],
];
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
                        <?php foreach ($trust_items as $item_index => $trust_item) : ?>
                            <?php $index = (string) ($item_index + 1); ?>
                            <div class="trust__logo trust__logo--<?php echo esc_attr($index); ?>">
                                <img class="trust__logo-img trust__logo-img--base" alt="<?php echo esc_attr($trust_item['name']); ?>" width="230" height="230" loading="lazy" decoding="async" src="<?php echo screenl_asset('trust/' . $trust_item['base']); ?>">
                                <img class="trust__logo-img trust__logo-img--hover" alt="" aria-hidden="true" width="230" height="230" loading="lazy" decoding="async" src="<?php echo screenl_asset('trust/' . $trust_item['hover']); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
