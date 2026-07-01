<?php
/**
 * Theme footer.
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="cookie-notice" id="cookieNotice" role="dialog" aria-label="<?php echo esc_attr('Уведомление о cookies'); ?>">
    <div class="cookie-notice__inner">
        <p class="cookie-notice__text">Мы используем cookies, чтобы сайт работал быстрее и удобнее.</p>
        <button class="cookie-notice__btn" id="cookieAccept" type="button">Принять</button>
    </div>
</div>
<script>
(function () {
    var notice = document.getElementById('cookieNotice');
    var accept = document.getElementById('cookieAccept');
    if (!notice || !accept) return;
    if (localStorage.getItem('screenl_cookies_accepted') === '1') return;

    requestAnimationFrame(function () {
        notice.classList.add('is-visible');
    });

    accept.addEventListener('click', function () {
        localStorage.setItem('screenl_cookies_accepted', '1');
        notice.classList.remove('is-visible');
    });
})();
</script>
<?php wp_footer(); ?>
</body>
</html>
