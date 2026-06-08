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
            <span class="site-preloader__beam site-preloader__beam--top"></span>
            <span class="site-preloader__beam site-preloader__beam--bottom"></span>
            <span class="site-preloader__panel site-preloader__panel--left">
                <span></span>
                <span></span>
                <span></span>
            </span>
            <span class="site-preloader__panel site-preloader__panel--center">
                <span></span>
                <span></span>
                <span></span>
            </span>
            <span class="site-preloader__panel site-preloader__panel--right">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </div>
        <p class="site-preloader__brand">SCREENL</p>
        <span class="site-preloader__progress"><span></span></span>
    </div>
</div>
<?php endif; ?>
