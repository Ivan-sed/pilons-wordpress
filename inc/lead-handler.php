<?php
/**
 * Lead form AJAX handler.
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_ajax_screenl_lead', 'screenl_handle_lead');
add_action('wp_ajax_nopriv_screenl_lead', 'screenl_handle_lead');

function screenl_handle_lead(): void
{
    check_ajax_referer('screenl_lead', 'nonce');

    $name      = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
    $contact   = isset($_POST['contact']) ? sanitize_text_field(wp_unslash($_POST['contact'])) : '';
    $messenger = isset($_POST['messenger']) ? sanitize_text_field(wp_unslash($_POST['messenger'])) : '';

    if ($name === '' || $contact === '') {
        wp_send_json_error(['message' => 'Заполните обязательные поля'], 400);
    }

    $to = defined('SCREENL_LEAD_EMAIL') ? SCREENL_LEAD_EMAIL : get_option('admin_email');
    if (!$to) {
        wp_send_json_error(['message' => 'Не настроен email получателя'], 500);
    }

    $subject = 'Заявка SCREENL — ' . $name;
    $body    = implode(
        "\n",
        [
            'Имя: ' . $name,
            'Контакт: ' . $contact,
            'Мессенджер: ' . ($messenger !== '' ? $messenger : '—'),
            'Согласие: подтверждено отправкой формы',
            'Дата: ' . current_time('mysql'),
            'IP: ' . (isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : '—'),
            'URL: ' . (isset($_SERVER['HTTP_REFERER']) ? esc_url_raw(wp_unslash($_SERVER['HTTP_REFERER'])) : '—'),
        ]
    );

    $headers = ['Content-Type: text/plain; charset=UTF-8'];

    $sent = wp_mail($to, $subject, $body, $headers);

    if (!$sent) {
        wp_send_json_error(['message' => 'Не удалось отправить заявку'], 500);
    }

    wp_send_json_success(['message' => 'OK']);
}
