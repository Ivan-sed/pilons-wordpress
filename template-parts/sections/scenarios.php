<?php
/**
 * Section: scenarios
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!-- SCENARIOS -->
<section class="scenarios" id="scenarios" aria-labelledby="scenarios-title" data-scenarios>
    <div class="scenarios__pin" data-scenarios-pin>
        <header class="scenarios__label-wrap" data-scenarios-label>
            <h2 class="scenarios__label" id="scenarios-title">Сценарии применения</h2>
        </header>

        <div class="scenarios__stack" data-scenarios-stack>
            <article class="scenarios__card scenarios__card--blue" data-scenarios-card>
                <div class="scenarios__card-layout">
                    <div class="scenarios__card-copy">
                        <div class="scenarios__card-heading">
                            <h3 class="scenarios__card-title">Навигация и инфо-зоны</h3>
                            <button class="scenarios__card-cta" type="button" data-modal-open>Получить расчет</button>
                        </div>

                        <ul class="scenarios__card-pills">
                            <li class="scenarios__card-pill">Навигационные стенды и указатели на мероприятия</li>
                            <li class="scenarios__card-pill">Использование в стендах и инсталляциях</li>
                            <li class="scenarios__card-pill">Визуальная коммуникация в залах и павильонах</li>
                            <li class="scenarios__card-pill">Пилоны для программы дня, расписание или live-инфографики</li>
                        </ul>
                    </div>

                    <div class="scenarios__media scenarios__media--marquee" aria-hidden="true">
                        <div class="scenarios__gallery">
                            <div class="scenarios__gallery-col scenarios__gallery-col--left">
                                <div class="scenarios__gallery-marquee" data-scenarios-marquee>
                                    <div class="scenarios__gallery-item">
                                        <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-01.png'); ?>">
                                        <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-02.png'); ?>">
                                    </div>
                                    <div class="scenarios__gallery-item">
                                        <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-03.png'); ?>">
                                        <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-04.png'); ?>">
                                    </div>
                                    <div class="scenarios__gallery-item">
                                        <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-05.png'); ?>">
                                        <span class="scenarios__gallery-clip">
                                            <img class="scenarios__gallery-clip-img scenarios__gallery-clip-img--a" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-01.png'); ?>">
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="scenarios__gallery-col scenarios__gallery-col--right">
                                <div class="scenarios__gallery-marquee" data-scenarios-marquee>
                                    <div class="scenarios__gallery-item">
                                        <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-06.png'); ?>">
                                        <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-07.png'); ?>">
                                    </div>
                                    <div class="scenarios__gallery-item">
                                        <span class="scenarios__gallery-clip">
                                            <img class="scenarios__gallery-clip-img scenarios__gallery-clip-img--b" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-clip-overlay-b.png'); ?>">
                                        </span>
                                        <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-08.png'); ?>">
                                    </div>
                                    <div class="scenarios__gallery-item">
                                        <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-09.png'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <article class="scenarios__card scenarios__card--dark" data-scenarios-card>
                <div class="scenarios__card-layout">
                    <div class="scenarios__card-copy">
                        <div class="scenarios__card-heading">
                            <h3 class="scenarios__card-title">Бизнес и брендинг</h3>
                            <button class="scenarios__card-cta" type="button" data-modal-open>Получить расчет</button>
                        </div>

                        <ul class="scenarios__card-pills">
                            <li class="scenarios__card-pill">Конференции, выставки, форумы, product launches</li>
                            <li class="scenarios__card-pill">Презентации брендов, pop-up зоны, корпоративные ивенты</li>
                            <li class="scenarios__card-pill">Digital signage и бренд-зоны внутри торговых пространств</li>
                            <li class="scenarios__card-pill">Фоны для фото и Reels-зон (формат 200х120 см)</li>
                        </ul>
                    </div>

                    <div class="scenarios__media scenarios__media--brand" aria-hidden="true">
                        <img class="scenarios__brand-bg" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/card-decor-background.png'); ?>">
                        <img class="scenarios__brand-circle" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/card-decor-circle.png'); ?>">
                        <svg class="scenarios__brand-mask" fill="none" preserveAspectRatio="none" viewBox="0 0 312.5 625">
                            <path d="M312.5 625C139.911 625 0 485.089 0 312.5C0 139.911 139.911 0 312.5 0V625Z" fill="#060B20"/>
                        </svg>
                    </div>
                </div>
            </article>

            <article class="scenarios__card scenarios__card--white" data-scenarios-card>
                <div class="scenarios__card-layout">
                    <div class="scenarios__card-copy">
                        <div class="scenarios__card-heading">
                            <h3 class="scenarios__card-title scenarios__card-title--blue">Спортивные мероприятия</h3>
                            <button class="scenarios__card-cta scenarios__card-cta--blue" type="button" data-modal-open>Получить расчет</button>
                        </div>

                        <ul class="scenarios__card-pills">
                            <li class="scenarios__card-pill scenarios__card-pill--gray">Трансляции матчей, соревнований и турниров</li>
                            <li class="scenarios__card-pill scenarios__card-pill--gray">Интерактивные зоны для болельщиков</li>
                            <li class="scenarios__card-pill scenarios__card-pill--gray">Фан-пространства</li>
                        </ul>
                    </div>

                    <div class="scenarios__media scenarios__media--sport" aria-hidden="true">
                        <img class="scenarios__sport-img scenarios__sport-img--front" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/card-sport-front.png'); ?>">
                        <img class="scenarios__sport-img scenarios__sport-img--back" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/card-sport-back.png'); ?>">
                    </div>
                </div>
            </article>

            <article class="scenarios__card scenarios__card--gray" data-scenarios-card>
                <div class="scenarios__card-layout">
                    <div class="scenarios__card-copy">
                        <div class="scenarios__card-heading">
                            <h3 class="scenarios__card-title">Продакшн и съемки</h3>
                            <button class="scenarios__card-cta scenarios__card-cta--gray" type="button" data-modal-open>Получить расчет</button>
                        </div>

                        <ul class="scenarios__card-pills">
                            <li class="scenarios__card-pill">Бэкстедж и live-мониторинг съемок</li>
                            <li class="scenarios__card-pill">Декорации и фоны для музыкальных видео</li>
                            <li class="scenarios__card-pill">Пилон для синхронизации контента в реальном времени</li>
                        </ul>
                    </div>

                    <div class="scenarios__media scenarios__media--shots" aria-hidden="true">
                        <div class="scenarios__shot">
                            <img class="scenarios__shot-img scenarios__shot-img--one" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/card-photo-shot-01.png'); ?>">
                        </div>
                        <div class="scenarios__shot">
                            <img class="scenarios__shot-img scenarios__shot-img--two" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/card-photo-shot-02.png'); ?>">
                        </div>
                        <div class="scenarios__shot">
                            <img class="scenarios__shot-img scenarios__shot-img--three" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/card-photo-shot-03.png'); ?>">
                        </div>
                    </div>
                </div>
            </article>

            <article class="scenarios__card scenarios__card--photo" data-scenarios-card>
                <div class="scenarios__card-layout">
                    <div class="scenarios__card-copy">
                        <div class="scenarios__card-heading">
                            <h3 class="scenarios__card-title scenarios__card-title--wide">Приватные и креативные события</h3>
                            <button class="scenarios__card-cta" type="button" data-modal-open>Получить расчет</button>
                        </div>

                        <ul class="scenarios__card-pills">
                            <li class="scenarios__card-pill"><span>Свадьбы </span><span>— велком-зоны, схема рассадки, фотозоны</span></li>
                            <li class="scenarios__card-pill"><span>Вечеринки</span><span> — афиши, оформление DJ-зоны, бренд-зоны</span></li>
                            <li class="scenarios__card-pill"><span>Арт-показы</span><span> — digital-инсталляции, медиа-арт, сопровождение экспозиций</span></li>
                            <li class="scenarios__card-pill"><span>Интерьерные</span><span> — digital-арт, навигация, оформление лобби</span></li>
                        </ul>
                    </div>

                    <div class="scenarios__media scenarios__media--photo-marquee" aria-hidden="true">
                        <div class="scenarios__gallery">
                            <div class="scenarios__gallery-col scenarios__gallery-col--photo-left">
                                <div class="scenarios__gallery-item">
                                    <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-01.png'); ?>">
                                    <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-02.png'); ?>">
                                    <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-10.png'); ?>">
                                </div>
                                <div class="scenarios__gallery-item">
                                    <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-03.png'); ?>">
                                    <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-04.png'); ?>">
                                    <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-11.png'); ?>">
                                </div>
                                <div class="scenarios__gallery-item">
                                    <span class="scenarios__gallery-clip">
                                        <img class="scenarios__gallery-clip-img scenarios__gallery-clip-img--b" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-clip-overlay-b.png'); ?>">
                                    </span>
                                    <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-08.png'); ?>">
                                    <span class="scenarios__gallery-clip">
                                        <img class="scenarios__gallery-clip-img scenarios__gallery-clip-img--c" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-clip-overlay-c.png'); ?>">
                                    </span>
                                </div>
                            </div>

                            <div class="scenarios__gallery-col scenarios__gallery-col--photo-right">
                                <div class="scenarios__gallery-item">
                                    <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-06.png'); ?>">
                                    <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-07.png'); ?>">
                                </div>
                                <div class="scenarios__gallery-item">
                                    <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-12.png'); ?>">
                                </div>
                                <div class="scenarios__gallery-item">
                                    <img class="scenarios__gallery-img" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-photo-09.png'); ?>">
                                    <span class="scenarios__gallery-clip">
                                        <img class="scenarios__gallery-clip-img scenarios__gallery-clip-img--d" alt="" decoding="async" src="<?php echo screenl_asset('scenarios/gallery-clip-overlay-d.png'); ?>">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
