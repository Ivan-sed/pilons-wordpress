<?php
/**
 * Enqueue styles and scripts.
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_enqueue_scripts', 'screenl_enqueue_assets');

function screenl_enqueue_assets(): void
{
    $is_legal_page = function_exists('screenl_is_legal_page_request') && screenl_is_legal_page_request();

    if (!is_front_page() && !$is_legal_page) {
        return;
    }

    wp_enqueue_style(
        'screenl-fonts',
        SCREENL_URI . '/fonts.css',
        [],
        SCREENL_VERSION
    );

    wp_enqueue_style(
        'screenl-styles',
        SCREENL_URI . '/styles.css',
        ['screenl-fonts'],
        SCREENL_VERSION
    );

    if ($is_legal_page) {
        $legal_scripts = [
            'screenl-overlay-lock'  => ['overlay-lock.js', []],
            'screenl-menu'          => ['menu.js', ['screenl-overlay-lock']],
            'screenl-sticky-header' => ['sticky-header.js', ['screenl-menu']],
            'screenl-lead-form'     => ['lead-form.js', []],
        ];

        foreach ($legal_scripts as $handle => $config) {
            wp_enqueue_script(
                $handle,
                SCREENL_URI . '/js/' . $config[0],
                $config[1],
                SCREENL_VERSION,
                true
            );
        }

        wp_localize_script(
            'screenl-lead-form',
            'screenlTheme',
            [
                'assetsUri' => SCREENL_URI . '/assets',
                'ajaxUrl'   => admin_url('admin-ajax.php'),
                'nonce'     => wp_create_nonce('screenl_lead'),
            ]
        );

        return;
    }

    wp_enqueue_script(
        'gsap',
        'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js',
        [],
        '3.12.5',
        false
    );

    wp_enqueue_script(
        'gsap-scroll-trigger',
        'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js',
        ['gsap'],
        '3.12.5',
        false
    );

    wp_enqueue_script(
        'lenis',
        'https://cdn.jsdelivr.net/npm/lenis@1.3.23/dist/lenis.min.js',
        [],
        '1.3.23',
        false
    );

    $footer_scripts = [
        'screenl-hero-screen-data'     => ['hero-screen-data.js', ['gsap']],
        'screenl-hero-screen-animation' => ['hero-screen-animation.js', ['screenl-hero-screen-data']],
        'screenl-scenarios-stack'      => ['scenarios-stack.js', ['gsap-scroll-trigger']],
        'screenl-smooth-scroll'        => ['smooth-scroll.js', ['lenis', 'gsap-scroll-trigger']],
        'screenl-section-reveal'       => ['section-reveal.js', ['gsap-scroll-trigger', 'screenl-smooth-scroll']],
        'screenl-configs-slider'       => ['configs-slider.js', []],
        'screenl-content-cubes'        => ['content-cubes.js', ['gsap']],
        'screenl-faq-accordion'        => ['faq-accordion.js', []],
        'screenl-trust-marquee'        => ['trust-marquee.js', []],
        'screenl-scenarios-gallery'    => ['scenarios-gallery-marquee.js', []],
        'screenl-overlay-lock'         => ['overlay-lock.js', []],
        'screenl-menu'                 => ['menu.js', ['screenl-overlay-lock']],
        'screenl-sticky-header'        => ['sticky-header.js', ['screenl-menu']],
        'screenl-lead-form'            => ['lead-form.js', ['screenl-hero-screen-data']],
        'screenl-modal'                => ['modal.js', ['screenl-overlay-lock']],
    ];

    foreach ($footer_scripts as $handle => $config) {
        wp_enqueue_script(
            $handle,
            SCREENL_URI . '/js/' . $config[0],
            $config[1],
            SCREENL_VERSION,
            true
        );
    }

    wp_localize_script(
        'screenl-hero-screen-data',
        'screenlTheme',
        [
            'assetsUri' => SCREENL_URI . '/assets',
            'ajaxUrl'   => admin_url('admin-ajax.php'),
            'nonce'     => wp_create_nonce('screenl_lead'),
        ]
    );
}
