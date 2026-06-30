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

    $sent = screenl_send_lead_notification(
        [
            'name'      => $name,
            'contact'   => $contact,
            'messenger' => $messenger,
            'date'      => current_time('mysql'),
            'ip'        => isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : '—',
            'url'       => isset($_SERVER['HTTP_REFERER']) ? esc_url_raw(wp_unslash($_SERVER['HTTP_REFERER'])) : '—',
        ]
    );

    if (!$sent) {
        wp_send_json_error(['message' => 'Не удалось отправить заявку'], 500);
    }

    wp_send_json_success(['message' => 'OK']);
}

function screenl_send_lead_notification(array $data): bool
{
    $token  = defined('SCREENL_TELEGRAM_BOT_TOKEN') ? SCREENL_TELEGRAM_BOT_TOKEN : '';
    $chatId = defined('SCREENL_TELEGRAM_CHAT_ID') ? SCREENL_TELEGRAM_CHAT_ID : '';

    if ($token === '' || $chatId === '') {
        return false;
    }

    $text = sprintf(
        "<b>Новая заявка SCREENL</b>\n\n" .
        "Имя: %s\n" .
        "Контакт: %s\n" .
        "Мессенджер: %s\n" .
        "Дата: %s\n" .
        "IP: %s\n" .
        "URL: %s",
        esc_html($data['name']),
        esc_html($data['contact']),
        esc_html($data['messenger'] !== '' ? $data['messenger'] : '—'),
        esc_html($data['date']),
        esc_html($data['ip']),
        esc_url($data['url'])
    );

    $response = wp_remote_post(
        "https://api.telegram.org/bot{$token}/sendMessage",
        [
            'timeout' => 30,
            'headers' => ['Content-Type' => 'application/json'],
            'body'    => wp_json_encode(
                [
                    'chat_id'    => $chatId,
                    'text'       => $text,
                    'parse_mode' => 'HTML',
                ]
            ),
        ]
    );

    if (is_wp_error($response)) {
        return false;
    }

    $status = wp_remote_retrieve_response_code($response);

    return $status >= 200 && $status < 300;
}
