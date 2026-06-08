<?php
/**
 * Section: configs
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}

$configs = [
    [
        'size'           => '1 пилон - 200х60 см',
        'inactive_asset' => 'configs/1-pillar-inactive.png',
        'active_asset'   => 'configs/1-pillar.png',
        'description'    => ['Компактное решение для навигации, расписания и брендинга'],
    ],
    [
        'size'           => '2 пилона - 200х120 см',
        'badge'          => 'Формат Reels',
        'badge_class'    => ' configs__card-badge--reels',
        'inactive_asset' => 'configs/2-pillars-inactive.png',
        'active_asset'   => 'configs/2-pillars.png',
        'description'    => [
            'Возможность транслировать ',
            ['text' => 'готовый контент из соцсетей ', 'accent' => true],
            'без адаптации',
        ],
    ],
    [
        'size'           => '3 пилона - 200х180 см',
        'inactive_asset' => 'configs/3-pillars-inactive.png',
        'active_asset'   => 'configs/3-pillars.png',
        'description'    => ['Заметный digital-акцент для бренд-зон и фотозон'],
    ],
    [
        'size'           => '4 пилона - 200х240 см',
        'inactive_asset' => 'configs/4-pillars-inactive.png',
        'active_asset'   => 'configs/4-pillars.png',
        'description'    => ['Широкий формат для презентаций и брендинга в больших залах'],
    ],
    [
        'size'           => '5 пилонов - 200х300 см',
        'inactive_asset' => 'configs/5-pillars-inactive.png',
        'active_asset'   => 'configs/5-pillars.png',
        'description'    => ['Панорамный экран для масштабных инсталляций и сцен'],
    ],
    [
        'size'           => '6 пилонов - 200х360 см',
        'badge'          => 'Формат 16:9',
        'inactive_asset' => 'configs/6-pillars-inactive.png',
        'active_asset'   => 'configs/6-pillars.png',
        'description'    => ['Кинематографичный формат 16:9 для видео, трансляций и шоу'],
    ],
];
?>
<!-- CONFIGS -->
<section class="configs" id="configs" aria-labelledby="configs-title">
    <div class="configs__bg" aria-hidden="true">
        <img class="configs__bg-img" alt="" loading="lazy" decoding="async" src="<?php echo screenl_asset('shared/section-bg-blur.png'); ?>">
    </div>

    <div class="configs__header">
        <div class="configs__title-block">
            <h2 class="configs__title" id="configs-title">Конфигурации</h2>
            <p class="configs__subtitle-gradient">Пилонов</p>
        </div>
        <button type="button" class="configs__cta" data-modal-open>Получить расчет</button>
    </div>

    <div class="configs__slider" data-active="1" tabindex="0" role="region" aria-label="Слайдер конфигураций пилонов">
        <div class="configs__viewport">
            <div class="configs__stage">
                <?php foreach ($configs as $index => $config) : ?>
                    <?php
                    $is_current = 1 === $index;
                    $state      = $is_current ? 'is-current' : (0 === $index ? 'is-prev' : (2 === $index ? 'is-next' : 'is-hidden'));
                    $loading    = $is_current ? 'eager' : 'lazy';
                    $priority   = $is_current ? ' fetchpriority="high"' : '';
                    ?>
                    <article class="configs__card <?php echo esc_attr($state); ?>" data-config-card data-slide="<?php echo esc_attr((string) $index); ?>" <?php echo 'is-hidden' === $state ? 'aria-hidden="true"' : ''; ?>>
                        <button
                            class="configs__card-button"
                            type="button"
                            aria-label="<?php echo esc_attr('Показать конфигурацию: ' . $config['size']); ?>"
                            <?php echo $is_current ? 'aria-current="true"' : ''; ?>
                            tabindex="<?php echo 'is-hidden' === $state ? '-1' : '0'; ?>"
                        >
                            <span class="configs__card-header">
                                <span class="configs__card-size"><?php echo esc_html($config['size']); ?></span>
                                <?php if (!empty($config['badge'])) : ?>
                                    <span class="configs__card-badge<?php echo esc_attr($config['badge_class'] ?? ''); ?>"><?php echo esc_html($config['badge']); ?></span>
                                <?php endif; ?>
                            </span>

                            <span class="configs__card-media" aria-hidden="true">
                                <img class="configs__card-photo configs__card-photo--inactive" alt="" loading="<?php echo esc_attr($loading); ?>" decoding="async"<?php echo $priority; ?> src="<?php echo screenl_asset($config['inactive_asset']); ?>">
                                <img class="configs__card-photo configs__card-photo--active" alt="" loading="<?php echo esc_attr($loading); ?>" decoding="async"<?php echo $priority; ?> src="<?php echo screenl_asset($config['active_asset']); ?>">
                            </span>

                            <span class="configs__card-desc">
                                <?php foreach ($config['description'] as $part) : ?>
                                    <?php if (is_array($part) && !empty($part['accent'])) : ?>
                                        <span class="configs__card-desc-accent"><?php echo esc_html($part['text']); ?></span>
                                    <?php else : ?>
                                        <span><?php echo esc_html(is_array($part) ? $part['text'] : $part); ?></span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </span>
                        </button>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="configs__arrows">
            <button type="button" class="configs__arrow configs__arrow--prev" aria-label="Предыдущая конфигурация">
                <svg class="configs__arrow-svg" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 5L5 12L12 19" />
                    <path d="M5 12H19" />
                </svg>
            </button>
            <button type="button" class="configs__arrow configs__arrow--next" aria-label="Следующая конфигурация">
                <svg class="configs__arrow-svg" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 5L19 12L12 19" />
                    <path d="M19 12H5" />
                </svg>
            </button>
        </div>
    </div>
</section>
