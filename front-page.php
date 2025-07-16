<?php
/**
 * Front page template.
 *
 * @package Elemental
 */
?>

<?php get_header()?>

<div class="front-container">
    <?php get_template_part( 'template-parts/front-page/banner-slider' )?>
    <?php get_template_part( 'template-parts/front-page/front-blogs' )?>
    <?php get_template_part( 'template-parts/front-page/blog-category-section' )?>
</div>

<?php get_footer()?>