<?php
/**
 * Front page — one-page landing.
 *
 * @package Screenl
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<div class="page">
    <div class="page__canvas">
        <?php
        get_template_part('template-parts/sections/hero');
        get_template_part('template-parts/sections/benefits');
        get_template_part('template-parts/sections/scenarios');
        get_template_part('template-parts/sections/configs');
        get_template_part('template-parts/sections/content');
        get_template_part('template-parts/sections/faq');
        get_template_part('template-parts/sections/trust');
        get_template_part('template-parts/sections/contacts');
        ?>
    </div>
</div>
<?php
get_template_part('template-parts/overlays/menu');
get_template_part('template-parts/overlays/modal');
get_template_part('template-parts/overlays/video-player');
get_footer();
