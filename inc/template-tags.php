<?php
/**
 * Front-page template helpers.
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return a section URL that works both from the landing and from inner pages.
 */
function screenl_section_url(string $section_id): string
{
    $section_id = ltrim($section_id, '#');

    if (is_front_page()) {
        return '#' . $section_id;
    }

    return home_url('/#' . $section_id);
}

/**
 * Render one of the lead forms used across the landing.
 *
 * @param string $variant contacts|menu|modal.
 * @param bool   $with_head Whether to render the form title/subtitle inside the form.
 */
function screenl_render_lead_form(string $variant, bool $with_head = false): void
{
    $classes = [
        'contacts' => [
            'form'            => 'contacts__form-area',
            'head'            => 'contacts__head',
            'title'           => 'contacts__form-title',
            'subtitle'        => 'contacts__form-sub',
            'fields'          => 'contacts__fields',
            'field'           => 'contacts__field',
            'input'           => 'contacts__input',
            'messengers'      => 'contacts__messengers',
            'messenger_label' => 'contacts__messenger-label',
            'options'         => 'contacts__messenger-options',
            'option'          => 'contacts__messenger-option',
            'radio_input'     => 'contacts__messenger-input',
            'radio'           => 'contacts__messenger-radio',
            'option_text'     => 'contacts__messenger-option-text',
            'error'           => 'contacts__error',
            'submit'          => 'contacts__submit',
            'success'         => 'contacts__success',
            'success_title'   => 'contacts__success-title',
            'success_text'    => 'contacts__success-text',
        ],
        'menu'     => [
            'form'            => 'menu__form',
            'head'            => 'menu__form-head',
            'title'           => 'menu__form-title',
            'subtitle'        => 'menu__form-sub',
            'fields'          => 'menu__fields',
            'field'           => 'menu__field',
            'input'           => 'menu__input',
            'messengers'      => 'menu__messengers',
            'messenger_label' => 'menu__messenger-label',
            'options'         => 'menu__messenger-options',
            'option'          => 'menu__chip',
            'radio_input'     => 'menu__chip-input',
            'radio'           => 'menu__chip-radio',
            'option_text'     => 'menu__chip-text',
            'error'           => 'menu__error',
            'submit'          => 'menu__submit',
            'success'         => 'menu__success',
            'success_title'   => 'menu__success-title',
            'success_text'    => 'menu__success-text',
        ],
        'modal'    => [
            'form'            => 'modal__form',
            'fields'          => 'modal__fields',
            'field'           => 'modal__field',
            'input'           => 'modal__input',
            'messengers'      => 'modal__messengers',
            'messenger_label' => 'modal__messenger-label',
            'options'         => 'modal__messenger-options',
            'option'          => 'modal__messenger-option',
            'radio_input'     => 'modal__messenger-input',
            'radio'           => 'modal__messenger-radio',
            'option_text'     => 'modal__messenger-option-text',
            'error'           => 'modal__error',
            'submit'          => 'modal__submit',
            'success'         => 'modal__success',
            'success_title'   => 'modal__success-title',
            'success_text'    => 'modal__success-text',
        ],
    ];

    if (empty($classes[$variant])) {
        return;
    }

    $c          = $classes[$variant];
    $consent_url = function_exists('screenl_legal_url') ? screenl_legal_url('personal-data-consent') : home_url('/personal-data-consent/');
    $privacy_url = function_exists('screenl_legal_url') ? screenl_legal_url('privacy-policy') : home_url('/privacy-policy/');
    $messengers = [
        'Telegram' => 'Telegram',
        'MAX'      => 'МАХ',
        'Телефон'  => 'Телефон',
        'Почта'    => 'Почта',
    ];
    ?>
    <form class="<?php echo esc_attr($c['form']); ?> js-lead-form" novalidate>
        <?php if ($with_head && !empty($c['head'])) : ?>
            <div class="<?php echo esc_attr($c['head']); ?>">
                <h2 class="<?php echo esc_attr($c['title']); ?>">Обсудить проект</h2>
                <p class="<?php echo esc_attr($c['subtitle']); ?>"><span>Подберём конфигурацию под ваше событие </span><span>и рассчитаем стоимость</span></p>
            </div>
        <?php endif; ?>

        <div class="<?php echo esc_attr($c['fields']); ?>">
            <div class="<?php echo esc_attr($c['field']); ?>">
                <input class="<?php echo esc_attr($c['input']); ?>" type="text" name="name" placeholder="Имя" autocomplete="name" required>
            </div>
            <div class="<?php echo esc_attr($c['field']); ?>">
                <input class="<?php echo esc_attr($c['input']); ?>" type="text" name="contact" placeholder="Телефон / E-mail" autocomplete="tel" required>
            </div>
        </div>

        <div class="<?php echo esc_attr($c['messengers']); ?>">
            <p class="<?php echo esc_attr($c['messenger_label']); ?>">Где удобно связаться?</p>
            <div class="<?php echo esc_attr($c['options']); ?>">
                <?php foreach ($messengers as $value => $label) : ?>
                    <label class="<?php echo esc_attr($c['option']); ?>">
                        <input class="<?php echo esc_attr($c['radio_input']); ?>" type="radio" name="messenger" value="<?php echo esc_attr($value); ?>">
                        <span class="<?php echo esc_attr($c['radio']); ?>" aria-hidden="true"></span>
                        <span class="<?php echo esc_attr($c['option_text']); ?>"><?php echo esc_html($label); ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <p class="<?php echo esc_attr($c['error']); ?> js-form-error" role="alert" aria-live="polite" hidden></p>
        <button class="<?php echo esc_attr($c['submit']); ?>" type="submit">Получить расчёт</button>
        <p class="lead-consent lead-consent--<?php echo esc_attr($variant); ?>">
            Нажимая кнопку «Получить расчёт», вы соглашаетесь с <a href="<?php echo esc_url($consent_url); ?>" target="_blank" rel="noopener">согласием на обработку персональных данных</a> и <a href="<?php echo esc_url($privacy_url); ?>" target="_blank" rel="noopener">политикой конфиденциальности</a>.
        </p>
        <div class="<?php echo esc_attr($c['success']); ?> js-form-success" hidden>
            <p class="<?php echo esc_attr($c['success_title']); ?>">Спасибо! Заявка отправлена</p>
            <p class="<?php echo esc_attr($c['success_text']); ?>">Свяжемся с вами в течение 10 минут</p>
        </div>
    </form>
    <?php
}
