<?php
/**
 * Theme header.
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php if (is_front_page() || (function_exists('screenl_is_legal_page_request') && screenl_is_legal_page_request())) : ?>
<div class="site-preloader" id="sitePreloader" aria-hidden="true">
    <div class="site-preloader__inner">
        <div class="site-preloader__mark">
            <div class="site-preloader__screenl" data-preloader-screenl>
                <div class="site-preloader__screenl-layer site-preloader__screenl-layer--base"></div>
                <div class="site-preloader__screenl-layer site-preloader__screenl-layer--glow"></div>
            </div>
        </div>
        <span class="site-preloader__progress"><span></span></span>
    </div>
</div>
<?php endif; ?>
