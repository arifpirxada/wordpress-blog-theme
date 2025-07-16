<?php

function estimated_reading_time($content)
{
    $word_count = str_word_count(strip_tags($content));
    $words_per_minute = 200;

    $reading_time = ceil($word_count / $words_per_minute);

    return $reading_time;
}


$categories = get_categories(array(
    'orderby' => 'id',
    'order' => 'DESC',
    'number' => 8,
    'exclude' => array(1), // Exclude 'Uncategorized' category
    // 'hide_empty' => true
));

$latest_posts = get_posts(array(
    'numberposts' => 4,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC'
));

?>


<style>
    .blog-category-section {
        background: white;
        padding: 40px 30px;
        border-radius: 12px;
    }

    .blog-category-section .blog-head {
        margin-bottom: 40px;
    }

    .blog-category-section .blog-head h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .blog-category-section .blog-head p {
        font-size: 1.1rem;
        color: #6c757d;
        line-height: 1.6;
    }

    .blog-category-section .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .blog-category-section .category-card {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
        cursor: pointer;
        height: 280px;
    }

    .blog-category-section .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .blog-category-section .category-card .category-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .blog-category-section .category-card:hover .category-image {
        transform: scale(1.1);
    }

    .blog-category-section .category-card .category-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(44, 62, 80, 0.8), rgba(52, 152, 219, 0.6));
        display: flex;
        align-items: flex-end;
        padding: 25px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .blog-category-section .category-card:hover .category-overlay {
        opacity: 1;
    }

    .blog-category-section .category-card .category-content {
        color: white;
        transform: translateY(20px);
        transition: transform 0.3s ease;
    }

    .blog-category-section .category-card:hover .category-content {
        transform: translateY(0);
    }

    .blog-category-section .category-card .category-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .blog-category-section .category-card .category-description {
        font-size: 1rem;
        opacity: 0.9;
        line-height: 1.5;
    }

    .blog-category-section .category-card .category-arrow {
        font-size: 1.2rem;
        transition: transform 0.3s ease;
    }

    .blog-category-section .category-card:hover .category-arrow {
        transform: translateX(5px);
    }

    .blog-category-section .category-card .category-label {
        position: absolute;
        top: 20px;
        left: 20px;
        background: rgba(255, 255, 255, 0.9);
        color: #2c3e50;
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
        z-index: 2;
    }

    .blog-category-section .featured-section {
        margin-top: 50px;
        text-align: center;
    }

    .blog-category-section .featured-section .featured-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 40px;
        border-radius: 15px;
        position: relative;
        overflow: hidden;
    }

    .blog-category-section .featured-section .featured-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .blog-category-section .featured-section .featured-content {
        position: relative;
        z-index: 1;
    }

    .blog-category-section .featured-section .featured-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .blog-category-section .featured-section .featured-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
    }

    .blog-category-section .posts-preview {
        margin-top: 40px;
        padding: 30px;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .blog-category-section .posts-preview h3 {
        font-size: 1.5rem;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    .blog-category-section .posts-preview .post-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #dee2e6;
    }

    .blog-category-section .posts-preview .post-item:last-child {
        border-bottom: none;
    }

    .blog-category-section .posts-preview .post-item .post-image {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .blog-category-section .posts-preview .post-item .post-info {
        flex: 1;
    }

    .blog-category-section .posts-preview .post-item .post-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
        line-height: 1.3;
    }

    .blog-category-section .posts-preview .post-item .post-meta {
        font-size: 0.9rem;
        color: #6c757d;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .blog-category-section {
            padding: 20px 15px;
        }

        .blog-category-section .blog-head h1 {
            font-size: 2rem;
        }

        .blog-category-section .blog-head p {
            font-size: 1rem;
        }

        .blog-category-section .categories-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .blog-category-section .category-card {
            height: 200px;
        }

        .blog-category-section .category-card .category-title {
            font-size: 1.5rem;
        }

        .blog-category-section .category-card .category-description {
            font-size: 0.9rem;
        }

        .blog-category-section .featured-section .featured-card {
            padding: 30px 20px;
        }

        .blog-category-section .featured-section .featured-title {
            font-size: 1.8rem;
        }

        .blog-category-section .featured-section .featured-subtitle {
            font-size: 1rem;
        }

        .blog-category-section .posts-preview .post-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .blog-category-section .posts-preview .post-item .post-image {
            width: 100%;
            height: 150px;
        }
    }

    @media (max-width: 480px) {
        .blog-category-section .category-card {
            height: 180px;
        }

        .blog-category-section .category-card .category-title {
            font-size: 1.3rem;
        }

        .blog-category-section .category-card .category-overlay {
            padding: 20px;
        }

        .blog-category-section .category-card .category-label {
            top: 15px;
            left: 15px;
            padding: 6px 12px;
            font-size: 0.8rem;
        }
    }
</style>

<div class="blog-category-section">
    <div class="blog-head">
        <h1>Popular Categories</h1>
        <p>Explore our most popular blog categories and discover amazing content</p>
    </div>

    <?php if (!empty($categories)) : ?>
        <div class="categories-grid">

            <?php foreach ($categories as $category) :
                $category_image = get_term_meta($category->term_id, 'category_image', true);;

                if (!$category_image) {
                    $category_image = "https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80";
                }

                $category_link = get_category_link($category->term_id);
            ?>

                <a class="category-card" href="<?php echo esc_url($category_link); ?>">
                    <div class="category-label"><?php echo esc_html($category->name); ?></div>
                    <img src="<?php echo $category_image ?>" alt="<?php echo esc_attr(get_the_title($post->ID)); ?>" class="category-image">
                    <div class="category-overlay">
                        <div class="category-content">
                            <h3 class="category-title">
                                <?php echo esc_html($category->name); ?>
                                <span class="category-arrow">→</span>
                            </h3>
                            <p class="category-description">
                                <?php
                                $description = $category->description;
                                if (empty($description)) {
                                    $description = sprintf(__('Discover amazing content in %s', 'textdomain'), $category->name);
                                }
                                echo esc_html($description);
                                ?>
                            </p>
                        </div>
                    </div>
                </a>


            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($latest_posts)) : ?>
        <div class="posts-preview">
            <h3>Latest Posts</h3>

            <?php foreach ($latest_posts as $post) :
                setup_postdata($post);
                $post_categories = get_the_category($post->ID);
                $primary_category = !empty($post_categories) ? $post_categories[0] : null;
                $reading_time = estimated_reading_time($post->post_content);
            ?>
                <div class="post-item">
                    <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'thumbnail') ?: 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80'; ?>" alt="<?php echo esc_attr(get_the_title($post->ID)); ?>" class="post-image">
                    <div class="post-info">
                        <div class="post-title"><?php echo esc_html(get_the_title($post->ID)); ?></div>
                        <div class="post-meta">
                            <?php if ($primary_category) : ?>
                                <?php echo esc_html($primary_category->name); ?> •
                            <?php endif; ?>
                            <?php echo human_time_diff(get_the_time('U', $post->ID), current_time('timestamp')); ?> <?php _e('ago', 'textdomain'); ?>
                            <?php if ($reading_time) : ?>
                                • <?php echo $reading_time; ?> <?php _e('min read', 'textdomain'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>


        </div>
    <?php endif; ?>

    <div class="featured-section">
        <div class="featured-card">
            <div class="featured-content">
                <h2 class="featured-title">Subscribe to Our Newsletter</h2>
                <p class="featured-subtitle">Get the latest articles and updates delivered straight to your inbox</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Add smooth hover effects
    document.querySelectorAll('.blog-category-section .category-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
</script>