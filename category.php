<?php

/**
 * Template Name: Category Template.
 *
 * @package Elemental
 */
?>

<?php get_header(); ?>

<div class="container-category blog-category-container">
    <div class="container">
        <?php
        $current_category = get_queried_object();
        $category_name = $current_category->name;
        $category_description = $current_category->description;
        $category_count = $current_category->count;
        ?>

        <div class="category-header">
            <h2 class="category-title"><?php echo esc_html($category_name); ?></h2>
            <div class="category-count">
                <?php echo esc_html($category_count); ?> <?php echo ($category_count === 1) ? 'post' : 'posts'; ?> found
            </div>
            <?php if (!empty($category_description)) : ?>
                <div class="category-description">
                    <?php echo wp_kses_post($category_description); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if (have_posts()) : ?>
            <div class="posts-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="post-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>"
                                alt="<?php echo esc_attr(get_the_title()); ?>"
                                class="post-image">
                        <?php else : ?>
                            <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=400&h=200&fit=crop&crop=faces"
                                alt="<?php echo esc_attr(get_the_title()); ?>"
                                class="post-image">
                        <?php endif; ?>

                        <div class="post-body">
                            <h3 class="post-title">
                                <a href="<?php echo esc_url(get_permalink()); ?>">
                                    <?php echo esc_html(get_the_title()); ?>
                                </a>
                            </h3>

                            <p class="post-excerpt">
                                <?php
                                $excerpt = get_the_excerpt();
                                echo esc_html(wp_trim_words($excerpt, 30, '...'));
                                ?>
                            </p>

                            <div class="post-meta">
                                <time class="post-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                    <?php echo esc_html(get_the_date('M j, Y')); ?>
                                </time>
                                <span class="post-author">
                                    <?php echo esc_html(get_the_author()); ?>
                                </span>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            // WordPress pagination
            $pagination_args = array(
                'mid_size' => 2,
                'prev_text' => '&laquo; Previous',
                'next_text' => 'Next &raquo;',
                'screen_reader_text' => 'Posts navigation',
                'class' => 'pagination'
            );
            ?>

            <div class="pagination">
                <?php echo paginate_links($pagination_args); ?>
            </div>

        <?php else : ?>
            <div class="empty-state">
                <h3>No posts found</h3>
                <p>There are no posts available in this category at the moment.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>