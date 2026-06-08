<?php
/**
 * Video player overlay.
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="video-modal video-modal--closed" id="videoModal" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Видео">
    <div class="video-modal__backdrop" data-video-close></div>
    <div class="video-modal__dialog" role="document">
        <button class="video-modal__close" type="button" data-video-close aria-label="Закрыть видео">
            <svg class="video-modal__close-svg" fill="none" viewBox="0 0 10 10" aria-hidden="true">
                <path d="M1 1L9 9M9 1L1 9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
        <video class="video-modal__player" controls playsinline preload="metadata" tabindex="-1"></video>
    </div>
</div>
