<?php
/**
 * Section: configs
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
        <!-- CONFIGS -->
        <section class="configs" id="configs" aria-labelledby="configs-title">
            <div class="configs__bg" aria-hidden="true">
                <div class="configs__bg-blur">
                    <img alt="" class="configs__bg-img" src="<?php echo screenl_asset('shared/section-bg-blur.png'); ?>">
                </div>
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
                    <div class="configs__track">
                        <article class="configs__card configs__card--inactive" data-slide="0">
                            <div class="configs__card-header">
                                <span class="configs__card-size">1 пилон - 200х60 см</span>
                            </div>
                            <div class="configs__card-media configs__card-media--inactive">
                                <img class="configs__card-photo configs__card-photo--1 configs__card-photo--inactive-img" src="<?php echo screenl_asset('configs/1-pillar-inactive.png'); ?>" alt="" aria-hidden="true">
                                <img class="configs__card-photo configs__card-photo--1 configs__card-photo--active-img" src="<?php echo screenl_asset('configs/1-pillar.png'); ?>" alt="1 пилон - 200х60 см">
                            </div>
                            <p class="configs__card-desc">Компактное решение для навигации, расписания и брендинга</p>
                        </article>
                        <article class="configs__card configs__card--active" data-slide="1">
                            <div class="configs__card-header">
                                <span class="configs__card-size">2 пилона - 200х120 см</span>
                                <span class="configs__card-badge configs__card-badge--reels">Формат Reels</span>
                            </div>
                            <div class="configs__card-media">
                                <img class="configs__card-photo configs__card-photo--2 configs__card-photo--inactive-img" src="<?php echo screenl_asset('configs/2-pillars-inactive.png'); ?>" alt="" aria-hidden="true">
                                <img class="configs__card-photo configs__card-photo--2 configs__card-photo--active-img" src="<?php echo screenl_asset('configs/2-pillars.png'); ?>" alt="2 пилона - 200х120 см">
                            </div>
                            <p class="configs__card-desc configs__card-desc--active"><span>Возможность транслировать </span><span class="configs__card-desc-accent">готовый контент из соцсетей </span><span>без адаптации</span></p>
                        </article>
                        <article class="configs__card configs__card--inactive" data-slide="2">
                            <div class="configs__card-header">
                                <span class="configs__card-size">3 пилона - 200х180 см</span>
                            </div>
                            <div class="configs__card-media configs__card-media--inactive">
                                <img class="configs__card-photo configs__card-photo--3 configs__card-photo--inactive-img" src="<?php echo screenl_asset('configs/3-pillars-inactive.png'); ?>" alt="" aria-hidden="true">
                                <img class="configs__card-photo configs__card-photo--3 configs__card-photo--active-img" src="<?php echo screenl_asset('configs/3-pillars.png'); ?>" alt="3 пилона - 200х180 см">
                            </div>
                            <p class="configs__card-desc">Заметный digital-акцент для бренд-зон и фотозон</p>
                        </article>
                        <article class="configs__card configs__card--inactive" data-slide="3">
                            <div class="configs__card-header">
                                <span class="configs__card-size">4 пилона - 200х240 см</span>
                            </div>
                            <div class="configs__card-media configs__card-media--inactive">
                                <img class="configs__card-photo configs__card-photo--4 configs__card-photo--inactive-img" src="<?php echo screenl_asset('configs/4-pillars-inactive.png'); ?>" alt="" aria-hidden="true">
                                <img class="configs__card-photo configs__card-photo--4 configs__card-photo--active-img" src="<?php echo screenl_asset('configs/4-pillars.png'); ?>" alt="4 пилона - 200х240 см">
                            </div>
                            <p class="configs__card-desc">Широкий формат для презентаций и брендинга в больших залах</p>
                        </article>
                        <article class="configs__card configs__card--inactive" data-slide="4">
                            <div class="configs__card-header">
                                <span class="configs__card-size">5 пилонов - 200х300 см</span>
                            </div>
                            <div class="configs__card-media configs__card-media--inactive">
                                <img class="configs__card-photo configs__card-photo--5 configs__card-photo--inactive-img" src="<?php echo screenl_asset('configs/5-pillars-inactive.png'); ?>" alt="" aria-hidden="true">
                                <img class="configs__card-photo configs__card-photo--5 configs__card-photo--active-img" src="<?php echo screenl_asset('configs/5-pillars.png'); ?>" alt="5 пилонов - 200х300 см">
                            </div>
                            <p class="configs__card-desc">Панорамный экран для масштабных инсталляций и сцен</p>
                        </article>
                        <article class="configs__card configs__card--inactive" data-slide="5">
                            <div class="configs__card-header">
                                <span class="configs__card-size">6 пилонов - 200х360 см</span>
                                <span class="configs__card-badge">Формат 16:9</span>
                            </div>
                            <div class="configs__card-media configs__card-media--inactive">
                                <img class="configs__card-photo configs__card-photo--6 configs__card-photo--inactive-img" src="<?php echo screenl_asset('configs/6-pillars-inactive.png'); ?>" alt="" aria-hidden="true">
                                <img class="configs__card-photo configs__card-photo--6 configs__card-photo--active-img" src="<?php echo screenl_asset('configs/6-pillars.png'); ?>" alt="6 пилонов - 200х360 см">
                            </div>
                            <p class="configs__card-desc">Кинематографичный формат 16:9 для видео, трансляций и шоу</p>
                        </article>
                    </div>
                </div>
                <div class="configs__arrows">
                    <button type="button" class="configs__arrow configs__arrow--prev" aria-label="Предыдущая конфигурация">
                        <svg class="configs__arrow-svg" fill="none" preserveAspectRatio="none" viewBox="0 0 114 114" aria-hidden="true"><g filter="url(#caf_l)"><rect fill="white" fill-opacity="0" height="50" rx="25" width="50" x="32" y="28"></rect><path d="M57.5681 42.9387L65.5886 50.8567C65.7392 51.0054 65.8238 51.207 65.8238 51.4173C65.8238 51.6275 65.7392 51.8292 65.5886 51.9779C65.438 52.1266 65.2337 52.2101 65.0208 52.2101C64.8078 52.2101 64.6035 52.1266 64.4529 51.9779L57.8023 45.4107V62.5025C57.8023 62.7125 57.7178 62.9139 57.5674 63.0624C57.417 63.2109 57.213 63.2943 57.0003 63.2943C56.7876 63.2943 56.5836 63.2109 56.4332 63.0624C56.2827 62.9139 56.1982 62.7125 56.1982 62.5025V45.4107L49.5477 51.9779C49.3971 52.1266 49.1928 52.2101 48.9798 52.2101C48.7668 52.2101 48.5626 52.1266 48.412 51.9779C48.2614 51.8292 48.1768 51.6275 48.1768 51.4173C48.1768 51.207 48.2614 51.0054 48.412 50.8567L56.4324 42.9387C56.5069 42.8649 56.5955 42.8064 56.6929 42.7665C56.7903 42.7266 56.8948 42.7061 57.0003 42.7061C57.1058 42.7061 57.2102 42.7266 57.3077 42.7665C57.4051 42.8064 57.4936 42.8649 57.5681 42.9387Z" fill="white"></path></g><defs><filter color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse" height="114" id="caf_l" width="114" x="0" y="0"><feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood><feColorMatrix in="SourceAlpha" result="hardAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"></feColorMatrix><feOffset dy="4"></feOffset><feGaussianBlur stdDeviation="16"></feGaussianBlur><feComposite in2="hardAlpha" operator="out"></feComposite><feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"></feColorMatrix><feBlend in2="BackgroundImageFix" mode="normal" result="eff1"></feBlend><feBlend in="SourceGraphic" in2="eff1" mode="normal" result="shape"></feBlend></filter></defs></svg>
                    </button>
                    <button type="button" class="configs__arrow configs__arrow--next" aria-label="Следующая конфигурация">
                        <svg class="configs__arrow-svg" fill="none" preserveAspectRatio="none" viewBox="0 0 114 114" aria-hidden="true"><g filter="url(#caf_r)"><rect fill="white" fill-opacity="0" height="50" rx="25" width="50" x="32" y="28"></rect><path d="M57.5681 42.9387L65.5886 50.8567C65.7392 51.0054 65.8238 51.207 65.8238 51.4173C65.8238 51.6275 65.7392 51.8292 65.5886 51.9779C65.438 52.1266 65.2337 52.2101 65.0208 52.2101C64.8078 52.2101 64.6035 52.1266 64.4529 51.9779L57.8023 45.4107V62.5025C57.8023 62.7125 57.7178 62.9139 57.5674 63.0624C57.417 63.2109 57.213 63.2943 57.0003 63.2943C56.7876 63.2943 56.5836 63.2109 56.4332 63.0624C56.2827 62.9139 56.1982 62.7125 56.1982 62.5025V45.4107L49.5477 51.9779C49.3971 52.1266 49.1928 52.2101 48.9798 52.2101C48.7668 52.2101 48.5626 52.1266 48.412 51.9779C48.2614 51.8292 48.1768 51.6275 48.1768 51.4173C48.1768 51.207 48.2614 51.0054 48.412 50.8567L56.4324 42.9387C56.5069 42.8649 56.5955 42.8064 56.6929 42.7665C56.7903 42.7266 56.8948 42.7061 57.0003 42.7061C57.1058 42.7061 57.2102 42.7266 57.3077 42.7665C57.4051 42.8064 57.4936 42.8649 57.5681 42.9387Z" fill="white"></path></g><defs><filter color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse" height="114" id="caf_r" width="114" x="0" y="0"><feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood><feColorMatrix in="SourceAlpha" result="hardAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"></feColorMatrix><feOffset dy="4"></feOffset><feGaussianBlur stdDeviation="16"></feGaussianBlur><feComposite in2="hardAlpha" operator="out"></feComposite><feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"></feColorMatrix><feBlend in2="BackgroundImageFix" mode="normal" result="eff1"></feBlend><feBlend in="SourceGraphic" in2="eff1" mode="normal" result="shape"></feBlend></filter></defs></svg>
                    </button>
                </div>
            </div>
        </section>
