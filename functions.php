<?php
/**
 * SCREENL theme bootstrap.
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}

define('SCREENL_VERSION', '1.0.43');
define('SCREENL_DIR', get_template_directory());
define('SCREENL_URI', get_template_directory_uri());

require_once SCREENL_DIR . '/inc/setup.php';
require_once SCREENL_DIR . '/inc/legal-pages.php';
require_once SCREENL_DIR . '/inc/enqueue.php';
require_once SCREENL_DIR . '/inc/lead-handler.php';
require_once SCREENL_DIR . '/inc/template-tags.php';

/**
 * Theme asset URL (images under /assets).
 *
 * @param string $path Path relative to assets/, e.g. "hero/background-gradient.png".
 */
function screenl_asset(string $path = ''): string
{
    $path = ltrim(str_replace('./assets/', '', $path), '/');
    $supports_webp = isset($_SERVER['HTTP_ACCEPT']) && false !== strpos((string) $_SERVER['HTTP_ACCEPT'], 'image/webp');

    if ($supports_webp && preg_match('/\.(png|jpe?g)$/i', $path)) {
        $webp_path = preg_replace('/\.(png|jpe?g)$/i', '.webp', $path);

        if (is_string($webp_path) && file_exists(SCREENL_DIR . '/assets/' . $webp_path)) {
            $path = $webp_path;
        }
    }

    return esc_url(SCREENL_URI . '/assets/' . $path);
}
