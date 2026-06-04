<?php
/**
 * Theme setup and front-end cleanup.
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('after_setup_theme', 'screenl_setup');

function screenl_setup(): void
{
    add_theme_support('title-tag');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
}

add_action('wp_enqueue_scripts', 'screenl_dequeue_block_styles', 100);

function screenl_dequeue_block_styles(): void
{
    $is_legal_page = function_exists('screenl_is_legal_page_request') && screenl_is_legal_page_request();

    if (!is_front_page() && !$is_legal_page) {
        return;
    }

    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
}

add_filter('show_admin_bar', 'screenl_hide_admin_bar_on_landing');

function screenl_hide_admin_bar_on_landing(bool $show): bool
{
    if (is_front_page()) {
        return false;
    }
    return $show;
}

add_filter('document_title_parts', 'screenl_document_title');

function screenl_document_title(array $title): array
{
    if (is_front_page()) {
        $title['title'] = 'Аренда LED-пилонов | SCREENL';
    }
    return $title;
}

add_action('wp_head', 'screenl_meta_description', 1);

function screenl_meta_description(): void
{
    if (!is_front_page()) {
        return;
    }
    echo '<meta name="description" content="Аренда LED-пилонов для мероприятий, шоу, выставок и презентаций.">' . "\n";
}
