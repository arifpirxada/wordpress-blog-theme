<?php

/**
 * Template Name: Search Template
 *
 * @package Elemental
 */
?>

<?php get_header(); ?>

<div class="search-container container-category blog-category-container">
    <div class="container">
        <?php
        // Get the search query
        $search_query = get_search_query();
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        
        // Custom query to search only blog posts
        $blog_search_query = new WP_Query(array(
            'post_type' => 'post',
            'post_status' => 'publish',
            's' => $search_query,
            'posts_per_page' => 10, // Adjust as needed
            'paged' => $paged,
            'orderby' => 'relevance',
            'order' => 'DESC'
        ));
        
        $total_posts = $blog_search_query->found_posts;
        ?>

        <div class="category-header">
            <h2 class="category-title">
                <?php if (!empty($search_query)) : ?>
                    Search Results for: "<?php echo esc_html($search_query); ?>"
                <?php else : ?>
                    Blog Search
                <?php endif; ?>
            </h2>
            <div class="category-count">
                <?php echo esc_html($total_posts); ?> blog <?php echo ($total_posts === 1) ? 'post' : 'posts'; ?> found
            </div>
            <?php if (!empty($search_query)) : ?>
                <div class="category-description">
                    <p>Showing blog posts that match your search for "<?php echo esc_html($search_query); ?>"</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($blog_search_query->have_posts()) : ?>
            <div class="posts-grid">
                <?php while ($blog_search_query->have_posts()) : $blog_search_query->the_post(); ?>
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
                                    <?php 
                                    // Highlight search terms in title
                                    $title = get_the_title();
                                    if (!empty($search_query)) {
                                        $title = preg_replace('/(' . preg_quote($search_query, '/') . ')/i', '<mark>$1</mark>', $title);
                                    }
                                    echo wp_kses($title, array('mark' => array()));
                                    ?>
                                </a>
                            </h3>

                            <p class="post-excerpt">
                                <?php
                                $excerpt = get_the_excerpt();
                                // Highlight search terms in excerpt
                                if (!empty($search_query)) {
                                    $excerpt = preg_replace('/(' . preg_quote($search_query, '/') . ')/i', '<mark>$1</mark>', $excerpt);
                                }
                                echo wp_kses(wp_trim_words($excerpt, 30, '...'), array('mark' => array()));
                                ?>
                            </p>

                            <div class="post-meta">
                                <time class="post-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                    <?php echo esc_html(get_the_date('M j, Y')); ?>
                                </time>
                                <span class="post-author">
                                    by <?php echo esc_html(get_the_author()); ?>
                                </span>
                                
                                <!-- Display post categories -->
                                <?php 
                                $categories = get_the_category();
                                if (!empty($categories)) : ?>
                                    <span class="post-categories">
                                        in 
                                        <?php 
                                        $category_links = array();
                                        foreach ($categories as $category) {
                                            $category_links[] = '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="category-link">' . esc_html($category->name) . '</a>';
                                        }
                                        echo implode(', ', $category_links);
                                        ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            // Search pagination
            $pagination_args = array(
                'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $blog_search_query->max_num_pages,
                'mid_size' => 2,
                'prev_text' => '&laquo; Previous',
                'next_text' => 'Next &raquo;',
                'screen_reader_text' => 'Search results navigation',
                'class' => 'pagination'
            );
            ?>

            <div class="pagination">
                <?php echo paginate_links($pagination_args); ?>
            </div>

        <?php else : ?>
            <div class="empty-state">
                <h3>No blog posts found</h3>
                <?php if (!empty($search_query)) : ?>
                    <p>Sorry, no blog posts were found matching "<?php echo esc_html($search_query); ?>".</p>
                    <p>Try searching with different keywords or browse our <a href="<?php echo esc_url(home_url('/blog')); ?>">latest blog posts</a>.</p>
                <?php else : ?>
                    <p>Please enter a search term to find blog posts.</p>
                <?php endif; ?>
                
                <!-- Search form for trying again -->
                <div class="search-form-wrapper">
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="search" class="search-field" placeholder="Search blog posts..." value="<?php echo esc_attr($search_query); ?>" name="s" />
                        <button type="submit" class="search-submit">Search</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
        
        <?php 
        // Reset post data after custom query
        wp_reset_postdata(); 
        ?>
    </div>
</div>

<style>
/* Additional styles for search highlighting */
.post-title mark,
.post-excerpt mark {
    background-color: #ffeb3b;
    padding: 0 2px;
    font-weight: bold;
}

.category-link {
    color: #666;
    text-decoration: none;
    font-size: 0.9em;
}

.category-link:hover {
    color: #333;
    text-decoration: underline;
}

.search-form-wrapper {
    margin-top: 20px;
}

.search-form {
    display: flex;
    gap: 10px;
    max-width: 400px;
}

.search-field {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.search-submit {
    padding: 10px 20px;
    background-color: #333;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.search-submit:hover {
    background-color: #555;
}
</style>

<?php get_footer(); ?>