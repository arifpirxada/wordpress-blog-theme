<?php
/**
 * Template Name: Custom Page Template
 *
 * A custom page template for displaying page content.
 *
 * @package Elemental
 */

get_header(); ?>

<style>
    .page-wrapper {
        padding: 20px;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
                            
                            <header class="page-header">
                                <h1 class="page-title"><?php the_title(); ?></h1>
                                
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="page-featured-image">
                                        <?php the_post_thumbnail('large', array('class' => 'img-responsive')); ?>
                                    </div>
                                <?php endif; ?>
                            </header>
                            
                            <div class="page-content-wrapper">
                                <div class="entry-content">
                                    <?php
                                    the_content();
                                    
                                    wp_link_pages(array(
                                        'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'elemental') . '</span>',
                                        'after'  => '</div>',
                                        'link_before' => '<span>',
                                        'link_after'  => '</span>',
                                    ));
                                    ?>
                                </div>
                                
                                <!-- Page Meta -->
                                <?php if (is_user_logged_in()) : ?>
                                    <div class="page-meta">
                                        <p class="page-edit-link">
                                            <?php edit_post_link(__('Edit Page', 'elemental'), '<span class="edit-link">', '</span>'); ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                        </article>
                        
                        <!-- Comments Section -->
                        <?php
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                        ?>
                        
                    <?php endwhile; ?>
                    
                <?php else : ?>
                    
                    <!-- No Content Found -->
                    <div class="no-content">
                        <h2><?php _e('Page Not Found', 'elemental'); ?></h2>
                        <p><?php _e('Sorry, but the page you are looking for does not exist.', 'elemental'); ?></p>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                            <?php _e('Return to Homepage', 'elemental'); ?>
                        </a>
                    </div>
                    
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>