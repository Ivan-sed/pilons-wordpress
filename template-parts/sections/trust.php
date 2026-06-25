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
$trust_logo_has_hover = static function (int $index): bool {
    $base_path  = SCREENL_DIR . '/assets/trust/' . $index . '.png';
    $hover_path = SCREENL_DIR . '/assets/trust/hover/' . $index . '.png';

    if (!is_readable($base_path) || !is_readable($hover_path)) {
        return false;
    }

    $base_size  = filesize($base_path);
    $hover_size = filesize($hover_path);

    if (false !== $base_size && false !== $hover_size && $base_size !== $hover_size) {
        return true;
    }

    $base_hash  = hash_file('sha256', $base_path);
    $hover_hash = hash_file('sha256', $hover_path);

    if (!is_string($base_hash) || !is_string($hover_hash)) {
        return true;
    }

    return !hash_equals($base_hash, $hover_hash);
};
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
                            <?php
                            $has_hover = $trust_logo_has_hover($index);
                            $classes   = [
                                'trust__logo',
                                'trust__logo--' . $index,
                                $has_hover ? 'trust__logo--has-hover' : 'trust__logo--static',
                            ];
                            ?>
                            <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
                                <img class="trust__logo-img trust__logo-img--base" alt="<?php echo esc_attr__('Логотип клиента', 'screenl'); ?>" width="230" height="230" loading="eager" fetchpriority="low" decoding="async" src="<?php echo screenl_asset('trust/' . $index . '.png'); ?>">
                                <?php if ($has_hover) : ?>
                                    <img class="trust__logo-img trust__logo-img--hover" alt="" aria-hidden="true" width="230" height="230" loading="eager" fetchpriority="low" decoding="async" src="<?php echo screenl_asset('trust/hover/' . $index . '.png'); ?>">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
