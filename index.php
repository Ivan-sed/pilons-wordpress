<?php
/**
 * Fallback template — redirects to front page layout when possible.
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}

if (is_front_page()) {
    locate_template('front-page.php', true, false);
    return;
}

get_header();
?>
<main class="page">
    <div class="page__canvas" style="padding: 4rem 2rem;">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_content();
            }
        }
        ?>
    </div>
</main>
<?php
get_footer();
