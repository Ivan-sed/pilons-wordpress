<?php
/**
 * Section: hero
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}

$hero_features = [
    'Один формат для всего',
    'Расписание, навигация и брендинг',
    'Без печати',
    'Без лишней застройки',
];

$hero_bezels = [
    ['class' => 'bezel--left', 'role' => 'side-left'],
    ['class' => 'bezel--center', 'role' => 'center'],
    ['class' => 'bezel--center', 'role' => 'center'],
    ['class' => 'bezel--center', 'role' => 'center'],
    ['class' => 'bezel--center', 'role' => 'center'],
    ['class' => 'bezel--right', 'role' => 'side-right'],
];
?>
        <!-- HERO BACKGROUND -->
        <section class="hero__bg" aria-hidden="true">
            <div class="hero__bg-wrap">
                <img alt="" class="hero__bg-img" src="<?php echo screenl_asset('hero/background-gradient.png'); ?>">
            </div>
            <div class="hero__bg-fade"></div>
        </section>

        <!-- HERO OVERLAY -->
        <section class="hero">
            <header class="hero__header">
                <div class="hero__socials">
                    <a class="hero__social-icon hero__social-icon--email" href="mailto:rent@screenl.ru" aria-label="Email"><svg class="hero__social-icon-svg" fill="none" preserveAspectRatio="none" viewBox="0 0 30 30"><path d="M15 0C23.2843 0 30 6.71573 30 15C30 23.2843 23.2843 30 15 30C6.71573 30 0 23.2843 0 15C0 6.71573 6.71573 0 15 0ZM9.75 9.5C9.28602 9.5005 8.84078 9.68461 8.5127 10.0127C8.18461 10.3408 8.0005 10.786 8 11.25V18.75C8.0005 19.214 8.18461 19.6592 8.5127 19.9873C8.84078 20.3154 9.28602 20.4995 9.75 20.5H20.25C20.714 20.4995 21.1592 20.3154 21.4873 19.9873C21.8154 19.6592 21.9995 19.214 22 18.75V11.25C21.9995 10.786 21.8154 10.3408 21.4873 10.0127C21.1592 9.68461 20.714 9.5005 20.25 9.5H9.75ZM10.6318 11.5146C10.6955 11.5329 10.7549 11.5641 10.8066 11.6055L15 14.8662L19.1934 11.6055C19.2981 11.5264 19.4295 11.4917 19.5596 11.5088C19.6898 11.526 19.809 11.5935 19.8896 11.6973C19.9701 11.8009 20.0065 11.9322 19.9912 12.0625C19.9758 12.193 19.9092 12.3124 19.8066 12.3945L15.3066 15.8945C15.2189 15.9627 15.1111 16 15 16C14.8889 16 14.7811 15.9627 14.6934 15.8945L10.1934 12.3945C10.1405 12.3546 10.0959 12.3043 10.0625 12.2471C10.0293 12.19 10.0077 12.127 9.99902 12.0615C9.99035 11.996 9.99447 11.9291 10.0117 11.8652C10.029 11.8013 10.0589 11.7408 10.0996 11.6885C10.1403 11.6362 10.1914 11.5931 10.249 11.5605C10.3066 11.5281 10.3699 11.5068 10.4355 11.499C10.5013 11.4913 10.5682 11.4965 10.6318 11.5146Z" fill="white"></path></svg></a>
                    <span class="hero__social-icon hero__social-icon--max" role="img" aria-label="MAX"><svg class="hero__social-icon-svg" fill="none" preserveAspectRatio="none" viewBox="0 0 30 30"><g clip-path="url(#hmc)"><path clip-rule="evenodd" d="M0 15.1059C0 6.75882 6.75882 0 15.1059 0C23.4441 0 30 6.75882 30 15.1059C30 23.4441 23.4441 30 15.1059 30C13.0588 30 9.92647 28.9147 8.62941 27.6176C7.54412 28.5441 7.34118 28.9147 6.46765 29.3471C5.17941 30 3.01765 30 2.58529 29.5676C1.72059 28.7029 2.58529 27.1941 1.50882 23.9559C0.767647 22.1735 0 17.1529 0 15.1059ZM14.8853 7.33235C10.7206 7.33235 7.33235 10.7118 7.33235 14.8853C7.33235 17.2588 7.55294 19.6324 8.19706 22.0059C8.57647 23.4088 9.86471 22.2794 11.0029 21.15C12.0794 22.2265 14.0824 22.4382 15.1059 22.4382C19.2794 22.4382 22.6588 19.0588 22.6588 14.8853C22.6588 10.7118 19.0588 7.33235 14.8853 7.33235Z" fill="white" fill-rule="evenodd"></path></g><defs><clipPath id="hmc"><rect fill="white" height="30" width="30"></rect></clipPath></defs></svg></span>
                    <span class="hero__social-icon hero__social-icon--tg" role="img" aria-label="Telegram"><svg class="hero__social-icon-svg" fill="none" preserveAspectRatio="none" viewBox="0 0 30.001 30.001"><path d="M15.001 0C18.9781 0.0001289 22.796 1.58131 25.6064 4.39355L25.8662 4.66016C28.5161 7.44451 30.001 11.1483 30.001 15.001C30.0009 18.8535 28.516 22.5566 25.8662 25.3408L25.6064 25.6074C22.796 28.4197 18.9781 30.0008 15.001 30.001C11.1479 30.001 7.44408 28.5168 4.66113 25.8672L4.39453 25.6074C1.58214 22.7954 0.000128979 18.9777 0 15.001V15C0.000857262 11.0218 1.58156 7.20666 4.39453 4.39355L4.66113 4.13379C7.44408 1.48416 11.1479 1.68366e-05 15.001 0ZM20.9541 9.81543C20.4147 9.82404 19.588 10.0788 15.6084 11.543C14.2161 12.0558 11.4319 13.117 7.25586 14.7266C6.57772 14.9652 6.22181 15.1986 6.19043 15.4268C6.12776 15.865 6.842 16.0017 7.7373 16.2598C8.46915 16.4701 9.45365 16.7159 9.96387 16.7256C10.4294 16.7345 10.9468 16.5652 11.5176 16.2178C15.4201 13.8879 17.4322 12.7104 17.5605 12.6846C17.6501 12.6667 17.7736 12.644 17.8564 12.71C17.941 12.7758 17.9318 12.9001 17.9229 12.9336C17.8535 13.201 14.1926 16.1471 13.9775 16.3447C13.1718 17.0854 12.2534 17.5396 13.668 18.3643C14.8922 19.0778 15.6043 19.5324 16.8643 20.2637C17.6699 20.7308 18.3013 21.2854 19.1338 21.2178C19.5165 21.1867 19.9131 20.8678 20.1123 19.918C20.5868 17.6731 21.5204 12.8101 21.7354 10.8057C21.7555 10.6304 21.7308 10.4054 21.7129 10.3066C21.6927 10.2079 21.652 10.0669 21.5088 9.96289C21.3366 9.83979 21.0729 9.8138 20.9541 9.81543Z" fill="white"></path></svg></span>
                </div>
                <button class="hero__menu" id="menuOpen" type="button" aria-label="Открыть меню" aria-controls="menu" aria-expanded="false">
                    <div class="hero__menu-chevron"><svg class="hero__menu-chevron-svg" fill="none" preserveAspectRatio="none" viewBox="0 0 18.1485 40"><path d="M15.5559 21.2265L0 37.3181L2.59265 40L18.1485 23.9084L15.5559 21.2265Z" fill="white" fill-opacity="0.2"></path><path d="M15.5559 15.8769L0 31.9685L2.59265 34.6504L18.1485 18.5588L15.5559 15.8769Z" fill="white" fill-opacity="0.4"></path><path d="M15.5559 10.5845L0 26.6761L2.59265 29.3581L18.1485 13.2665L15.5559 10.5845Z" fill="white" fill-opacity="0.6"></path><path d="M15.5559 5.29229L0 21.3839L2.59265 24.0658L18.1485 7.97422L15.5559 5.29229Z" fill="white" fill-opacity="0.8"></path><path d="M15.5559 0L0 16.0916L2.59265 18.7735L18.1485 2.68193L15.5559 0Z" fill="white"></path></svg></div>
                    <span class="hero__menu-text">меню</span>
                </button>
            </header>
            <div class="hero__screen-anim" aria-hidden="true">
                <div class="screen-group" id="screenGroup">
                    <div class="panels" id="panels">
                        <?php for ($panel = 1; $panel <= 5; ++$panel) : ?>
                            <div class="panel-mask" data-panel="<?php echo esc_attr((string) $panel); ?>"><div class="panel-mask__clip"><img class="panel-mask__img" data-asset="screen" src="<?php echo screenl_asset('hero/screen-panel.png'); ?>" alt=""></div></div>
                        <?php endfor; ?>
                    </div>
                </div>
                <div class="hero__screen-reflection" id="reflection"></div>
            </div>
            <div class="hero__product">
                <div class="hero__title-block">
                    <h1 class="hero__title"><span class="hero__title-line">Аренда </span><span class="hero__title-line">LED-пилонов</span></h1>
                    <p class="hero__subtitle">для мероприятий, шоу, выставок и презентаций</p>
                </div>
                <div class="hero__cta-row">
                    <button class="hero__btn" type="button" data-modal-open>Получить расчёт</button>
                    <p class="hero__response-note">Ответим в течение 10 минут</p>
                </div>
                <div class="hero__screenl" aria-hidden="true"><svg class="hero__screenl-svg" fill="none" preserveAspectRatio="none" viewBox="0 0 1288 77.2676"><path d="M177.364 17.9678H47.3203C45.4928 17.9678 43.8181 18.3867 42.3125 19.2627C40.8085 20.119 40.0479 21.6433 40.0479 23.7949C40.048 26.27 40.9792 27.927 42.8643 28.7275C44.7496 29.5263 46.56 29.9453 48.2744 29.9453H161.026C164.892 29.9453 167.938 30.9369 170.147 32.9355C172.356 34.9359 173.994 37.2387 175.08 39.8867C176.165 42.515 176.794 45.1038 177.022 47.6367C177.231 50.1693 177.345 51.9771 177.345 53.0439C177.345 55.9583 177.174 58.8336 176.851 61.6904C176.527 64.5472 175.803 67.136 174.681 69.4404C173.556 71.7629 171.9 73.6305 169.748 75.0967C167.596 76.5431 164.682 77.2676 161.026 77.2676H0V59.3281H130.024C131.852 59.3281 133.528 58.9093 135.032 58.0352C136.536 57.177 137.299 55.6526 137.299 53.501C137.299 51.0258 136.346 49.3691 134.48 48.5703C132.595 47.7698 130.787 47.3701 129.072 47.3701H16.3203C12.4544 47.3701 9.40737 46.3785 7.19824 44.3799C4.98908 42.3794 3.3514 40.0768 2.2666 37.4287C1.18011 34.8023 0.55268 32.2116 0.324219 29.6787C0.115564 27.1461 0 25.3383 0 24.2715V24.251C0 21.3386 0.153334 18.4622 0.495117 15.6074C0.818931 12.7687 1.54167 10.16 2.66602 7.85547C3.78855 5.53305 5.44536 3.64754 7.59863 2.20117C9.7502 0.753004 12.6451 0.030297 16.3203 0.0302734H177.364V17.9678ZM737.071 17.9639H599.45V29.9238H696.7V47.3467H599.45V59.3066H737.071V77.2441H558.584V0.0263672H737.071V17.9639ZM923.462 17.9639H785.839V29.9238H883.091V47.3467H785.839V59.3066H923.462V77.2441H744.973V0.0263672H923.462V17.9639ZM1097.01 0.0263672C1100.66 0.0264021 1103.58 0.882837 1105.73 2.61523C1107.88 4.32962 1109.52 6.53849 1110.66 9.24219C1111.78 11.9461 1112.53 14.8408 1112.85 17.9639C1113.17 21.0869 1113.33 24.0972 1113.33 27.0098V77.2441H1073.26V37.6738C1073.26 36.2652 1073.13 34.4748 1072.86 32.2656C1072.59 30.0567 1072.08 27.9052 1071.34 25.8096C1070.57 23.7156 1069.55 21.8679 1068.27 20.3262C1066.98 18.7646 1065.3 17.9834 1063.26 17.9834H967.953V77.2266H927.886V0.0263672H1097.01ZM1166.05 59.3066H1288V77.2441H1125.98V0.0263672H1166.05V59.3066ZM364.324 17.9395H235.899C233.863 17.9395 232.186 18.7198 230.891 20.2812C229.597 21.8427 228.568 23.6707 227.825 25.7646C227.064 27.8784 226.57 30.0124 226.284 32.2197C226.018 34.4287 225.885 36.2383 225.885 37.6289V39.6104C225.885 41.0189 226.018 42.8086 226.284 45.0176C226.55 47.2267 227.064 49.3786 227.825 51.4727C228.588 53.5685 229.597 55.4145 230.891 56.958C232.186 58.5195 233.863 59.2998 235.899 59.2998H364.324V77.2383H202.138C198.48 77.2383 195.568 76.3817 193.416 74.6475C191.264 72.9348 189.626 70.7056 188.483 68.0215C187.361 65.3356 186.617 62.4228 186.312 59.2998C185.988 56.1769 185.837 53.1673 185.837 50.2549V26.9844C185.837 24.0702 185.988 21.0623 186.312 17.9395C186.635 14.8164 187.361 11.9017 188.483 9.21582C189.608 6.53181 191.264 4.32224 193.416 2.58984C195.568 0.875494 198.48 0 202.138 0H364.324V17.9395ZM533.942 0.0263672C537.598 0.0264159 540.511 0.864657 542.664 2.52148C544.815 4.19629 546.472 6.3298 547.595 8.90039C548.719 11.489 549.442 14.3459 549.766 17.4688C550.089 20.5918 550.261 23.6201 550.261 26.5146H550.299C550.299 28.0186 549.994 29.7329 549.404 31.6758C548.814 33.6168 547.976 35.5024 546.892 37.3301C545.805 39.1597 544.605 40.7773 543.254 42.168C541.901 43.5764 540.53 44.4339 539.14 44.7578C540.435 45.0816 541.692 45.7102 542.93 46.624C544.167 47.5379 545.272 48.5848 546.243 49.7666C547.215 50.9467 548.052 52.1843 548.757 53.4795C549.462 54.7728 549.956 55.9548 550.28 57.0215V77.207H510.213V58.9629C510.213 58.2199 509.909 57.4012 509.319 56.5449C508.729 55.6886 507.967 54.8879 507.053 54.127C506.139 53.384 505.129 52.7545 504.062 52.2598C502.978 51.7849 501.949 51.5371 500.997 51.5371H412.638V77.2266H372.572V0.0263672H533.942ZM412.828 33.79H501.835C503.871 33.79 505.815 33.1225 507.643 31.7715C509.472 30.4384 510.386 28.6281 510.386 26.3613C510.386 23.8862 509.605 21.8681 508.044 20.3066C506.482 18.7451 504.672 17.9639 502.634 17.9639H412.828V33.79Z" fill="url(#screenl_grad)"></path><defs><radialGradient cx="0" cy="0" gradientTransform="translate(106.5 114.595) rotate(-6.51403) scale(2675.27 1826.47)" gradientUnits="userSpaceOnUse" id="screenl_grad" r="1"><stop stop-color="white"></stop><stop offset="1" stop-color="#184CDB" stop-opacity="0"></stop></radialGradient></defs></svg></div>
                <div class="hero__features">
                    <?php foreach ($hero_features as $feature) : ?>
                        <div class="hero__feature">
                            <div class="hero__feature-icon"><div class="hero__feature-arrow"><svg class="hero__feature-arrow-svg" fill="none" preserveAspectRatio="none" viewBox="0 0 24.9008 4.15014"><path d="M22.5336 0.274827L0 0L2.20731 3.61342L24.9008 4.15014L22.5336 0.274827Z" fill="white"></path></svg></div></div>
                            <p class="hero__feature-text"><?php echo esc_html($feature); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="hero__screen-chrome" id="screenChrome" aria-hidden="true">
                <svg class="hero__bezel-defs" width="0" height="0" aria-hidden="true" focusable="false">
                    <defs>
                        <filter id="bezelShadow" x="-354.627" y="-235.709" width="592.627" height="313.5" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                            <feFlood flood-opacity="0" result="bg"></feFlood>
                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
                            <feOffset dx="-9.38994" dy="-4.18727"></feOffset>
                            <feGaussianBlur stdDeviation="4.04688"></feGaussianBlur>
                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.242812 0"></feColorMatrix>
                            <feBlend mode="normal" in2="bg" result="e1"></feBlend>
                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
                            <feOffset dx="-22.6365" dy="-10.0943"></feOffset>
                            <feGaussianBlur stdDeviation="6.76758"></feGaussianBlur>
                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.2025 0"></feColorMatrix>
                            <feBlend mode="normal" in2="e1" result="e2"></feBlend>
                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
                            <feOffset dx="-42.9254" dy="-19.1418"></feOffset>
                            <feGaussianBlur stdDeviation="11.375"></feGaussianBlur>
                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.173438 0"></feColorMatrix>
                            <feBlend mode="normal" in2="e2" result="e3"></feBlend>
                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
                            <feOffset dx="-71.2629" dy="-31.7784"></feOffset>
                            <feGaussianBlur stdDeviation="18.9355"></feGaussianBlur>
                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"></feColorMatrix>
                            <feBlend mode="normal" in2="e3" result="e4"></feBlend>
                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
                            <feOffset dx="-108.655" dy="-48.4526"></feOffset>
                            <feGaussianBlur stdDeviation="30.5156"></feGaussianBlur>
                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.126563 0"></feColorMatrix>
                            <feBlend mode="normal" in2="e4" result="e5"></feBlend>
                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
                            <feOffset dx="-156.108" dy="-69.6133"></feOffset>
                            <feGaussianBlur stdDeviation="47.1816"></feGaussianBlur>
                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.0975 0"></feColorMatrix>
                            <feBlend mode="normal" in2="e5" result="e6"></feBlend>
                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
                            <feOffset dx="-214.627" dy="-95.7089"></feOffset>
                            <feGaussianBlur stdDeviation="70"></feGaussianBlur>
                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.0571875 0"></feColorMatrix>
                            <feBlend mode="normal" in2="e6" result="e7"></feBlend>
                            <feBlend mode="normal" in="SourceGraphic" in2="e7" result="shape"></feBlend>
                            <feGaussianBlur stdDeviation="5"></feGaussianBlur>
                        </filter>
                    </defs>
                </svg>
                <div class="shadows" id="shadows">
                    <?php for ($shadow = 0; $shadow < 6; ++$shadow) : ?>
                        <div class="shadow-group" data-shadow="<?php echo esc_attr((string) $shadow); ?>"><img class="shadow-group__svg" data-asset="shadowPanels" src="<?php echo screenl_asset('hero/shadow-panels-joined.png'); ?>" alt=""></div>
                    <?php endfor; ?>
                </div>
                <div class="bezels" id="bezels">
                    <?php foreach ($hero_bezels as $index => $bezel) : ?>
                        <div class="bezel <?php echo esc_attr($bezel['class']); ?>" data-bezel="<?php echo esc_attr((string) $index); ?>" data-role="<?php echo esc_attr($bezel['role']); ?>"><svg class="bezel__svg" viewBox="0 0 228 41" preserveAspectRatio="none" fill="none" aria-hidden="true"><path d="M0 0H228V41H0V0Z" fill="black" filter="url(#bezelShadow)"></path></svg><div class="bezel__clip"><img class="bezel__img" data-asset="bezel" src="<?php echo screenl_asset('hero/bezel-texture.png'); ?>" alt=""></div></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
