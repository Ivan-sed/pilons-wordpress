<?php
/**
 * Section: contacts
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}

$contacts_nav = [
    [
        ['label' => 'Преимущества', 'href' => '#benefits'],
        ['label' => 'Сценарии применения', 'href' => '#scenarios'],
        ['label' => 'Конфигурации', 'href' => '#configs'],
    ],
    [
        ['label' => 'Кейсы'],
        ['label' => 'FAQ', 'href' => '#faq'],
        ['label' => 'Политика конфиденциальности', 'href' => function_exists('screenl_legal_url') ? screenl_legal_url('privacy-policy') : home_url('/privacy-policy/')],
    ],
];
?>
        <!-- CONTACTS -->
        <footer class="contacts" id="contacts">
            <div class="contacts__bg" aria-hidden="true">
                <div class="contacts__bg-blur">
                    <div class="contacts__bg-blurred">
                        <img alt="" class="contacts__bg-img" src="<?php echo screenl_asset('shared/section-bg-blur.png'); ?>">
                    </div>
                </div>
            </div>

            <h2 class="contacts__headline">Контакты</h2>

            <div class="contacts__panel">
                <div class="contacts__head">
                    <h3 class="contacts__form-title">Обсудить проект</h3>
                    <p class="contacts__form-sub"><span>Подберём конфигурацию под ваше событие </span><span>и рассчитаем стоимость</span></p>
                </div>

                <div class="contacts__body">
                    <?php screenl_render_lead_form('contacts'); ?>

                    <div class="contacts__info">
                        <div class="contacts__contact-details">
                            <div class="contacts__phone">
                                <p class="contacts__contact-label">Телефон</p>
                                <a class="contacts__contact-value" href="tel:+79999628999">+7 999 962 89 99</a>
                            </div>
                            <div class="contacts__email">
                                <p class="contacts__contact-label">Электронная почта</p>
                                <a class="contacts__contact-value" href="mailto:rent@screenl.ru">rent@screenl.ru</a>
                            </div>
                        </div>

                        <nav class="contacts__nav">
                            <?php foreach ($contacts_nav as $column) : ?>
                                <div class="contacts__nav-col">
                                    <?php foreach ($column as $link) : ?>
                                        <?php if (!empty($link['href'])) : ?>
                                            <a class="contacts__nav-link" href="<?php echo esc_url($link['href']); ?>"><?php echo esc_html($link['label']); ?></a>
                                        <?php else : ?>
                                            <span class="contacts__nav-link contacts__nav-link--disabled" aria-disabled="true"><?php echo esc_html($link['label']); ?></span>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </nav>

                        <div class="contacts__socials-block">
                            <p class="contacts__socials-label">Соцсети</p>
                            <div class="contacts__socials">
                                <a class="contacts__social-icon contacts__social-icon--email" href="mailto:rent@screenl.ru" aria-label="Email"><svg class="contacts__social-icon-svg" fill="none" preserveAspectRatio="none" viewBox="0 0 40 40"><path d="M20 0C31.0457 0 40 8.95431 40 20C40 31.0457 31.0457 40 20 40C8.95431 40 0 31.0457 0 20C0 8.95431 8.95431 0 20 0ZM13 12.667C12.3814 12.6677 11.788 12.9131 11.3506 13.3506C10.9131 13.788 10.6677 14.3814 10.667 15V25C10.6677 25.6186 10.9131 26.212 11.3506 26.6494C11.788 27.0869 12.3814 27.3323 13 27.333H27C27.6186 27.3323 28.212 27.0869 28.6494 26.6494C29.0869 26.212 29.3323 25.6186 29.333 25V15C29.3323 14.3814 29.0869 13.788 28.6494 13.3506C28.212 12.9131 27.6186 12.6677 27 12.667H13ZM14.1758 15.3535C14.2607 15.3778 14.3402 15.4185 14.4092 15.4736L20 19.8223L25.5908 15.4736C25.7306 15.3681 25.9064 15.3217 26.0801 15.3447C26.2537 15.3677 26.411 15.4584 26.5186 15.5967C26.6261 15.735 26.6748 15.91 26.6543 16.084C26.6337 16.2579 26.5459 16.4169 26.4092 16.5264L20.4092 21.1934C20.2922 21.2842 20.1481 21.333 20 21.333C19.8519 21.333 19.7078 21.2842 19.5908 21.1934L13.5908 16.5264C13.5204 16.4732 13.4615 16.4063 13.417 16.3301C13.3726 16.2539 13.3437 16.1695 13.332 16.082C13.3205 15.9946 13.3266 15.9055 13.3496 15.8203C13.3727 15.7351 13.4117 15.6547 13.4658 15.585C13.52 15.5153 13.5882 15.4575 13.665 15.4141C13.7419 15.3707 13.8265 15.3424 13.9141 15.332C14.0017 15.3217 14.0909 15.3292 14.1758 15.3535Z" fill="#1A56DB"></path></svg></a>
                                <span class="contacts__social-icon contacts__social-icon--max" role="img" aria-label="MAX"><svg class="contacts__social-icon-svg" fill="none" preserveAspectRatio="none" viewBox="0 0 40 40"><g clip-path="url(#cmc)"><path clip-rule="evenodd" d="M0 20.1412C0 9.01177 9.01177 0 20.1412 0C31.2588 0 40 9.01177 40 20.1412C40 31.2588 31.2588 40 20.1412 40C17.4118 40 13.2353 38.5529 11.5059 36.8235C10.0588 38.0588 9.78824 38.5529 8.62353 39.1294C6.90588 40 4.02353 40 3.44706 39.4235C2.29412 38.2706 3.44706 36.2588 2.01176 31.9412C1.02353 29.5647 0 22.8706 0 20.1412ZM19.8471 9.77647C14.2941 9.77647 9.77647 14.2824 9.77647 19.8471C9.77647 23.0118 10.0706 26.1765 10.9294 29.3412C11.4353 31.2118 13.1529 29.7059 14.6706 28.2C16.1059 29.6353 18.7765 29.9176 20.1412 29.9176C25.7059 29.9176 30.2118 25.4118 30.2118 19.8471C30.2118 14.2824 25.4118 9.77647 19.8471 9.77647Z" fill="#1A56DB" fill-rule="evenodd"></path></g><defs><clipPath id="cmc"><rect fill="white" height="40" width="40"></rect></clipPath></defs></svg></span>
                                <span class="contacts__social-icon contacts__social-icon--tg" role="img" aria-label="Telegram"><svg class="contacts__social-icon-svg" fill="none" preserveAspectRatio="none" viewBox="0 0 39.333 39.333"><path d="M19.667 0C24.8813 7.43071e-05 29.8866 2.07303 33.5713 5.75977C37.2588 9.44667 39.333 14.4529 39.333 19.667C39.3329 24.8807 37.2585 29.8855 33.5713 33.5723C29.8866 37.2593 24.8815 39.3329 19.667 39.333C14.6153 39.3329 9.75888 37.3879 6.11035 33.9141L5.76172 33.5732C2.07435 29.8865 0.000129015 24.8808 0 19.667C0.000989766 14.614 1.94616 9.76093 5.4209 6.10938L5.76172 5.75977C9.44641 2.07288 14.4526 7.47768e-05 19.667 0ZM27.6045 12.7529C26.8853 12.7645 25.7838 13.1037 20.4785 15.0557C18.6223 15.7393 14.9094 17.1545 9.34082 19.3008C8.43664 19.619 7.96268 19.9312 7.9209 20.2354C7.83786 20.8194 8.78905 21.0017 9.98242 21.3457C10.9583 21.6261 12.2717 21.9539 12.9521 21.9668C13.5728 21.9786 14.2625 21.7532 15.0234 21.29C20.2236 18.1854 22.906 16.6144 23.0801 16.5781C23.1994 16.5544 23.3642 16.5244 23.4746 16.6123C23.5879 16.7 23.5764 16.8665 23.5645 16.9111C23.471 17.2685 18.5849 21.1992 18.3027 21.459C17.2285 22.4465 16.0052 23.051 17.8906 24.1504C19.523 25.1018 20.4722 25.7094 22.1523 26.6846C23.2266 27.3075 24.0686 28.0464 25.1787 27.9561C25.6889 27.9145 26.2168 27.4895 26.4824 26.2236C27.1151 23.2306 28.36 16.7456 28.6465 14.0732C28.6733 13.8395 28.6401 13.5399 28.6162 13.4082C28.5894 13.2766 28.5357 13.0888 28.3447 12.9502C28.1149 12.7858 27.7627 12.7507 27.6045 12.7529Z" fill="#1A56DB"></path></svg></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
