<style>
    .collection-container {
        margin: 60px 0;
    }

    .collection-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .collection-container .collection-header h2 {
        font-size: 2.5rem;
        color: #2c3e50;
        margin-bottom: 10px;
        font-weight: 300;
    }

    .collection-container .collection-header p {
        color: #7f8c8d;
        font-size: 1.1rem;
    }

    .collection-container .collection-card .product-image img {
        object-fit: cover;
        object-position: center;
        width: 100%;
    }

    .collection-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .collection-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
    }

    .collection-grid .collection-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
    }

    .collection-card .bestseller-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: #e74c3c;
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 2;
    }

    .collection-card .fragrance-notes {
        position: absolute;
        top: 20px;
        right: 20px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        z-index: 2;
    }

    .collection-card .fragrance-notes .note-icon {
        background: rgba(255, 255, 255, 0.9);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        color: #7f8c8d;
        backdrop-filter: blur(10px);
    }

    .collection-card .product-image {
        height: 300px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .collection-card .product-image::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1.5" fill="rgba(255,255,255,0.1)"/></svg>');
    }

    .collection-card .product-image .bottle {
        width: 120px;
        height: 180px;
        background: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.1));
        border-radius: 10px 10px 30px 30px;
        position: relative;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .collection-card .product-image .bottle::before {
        content: '';
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 25px;
        background: rgba(0, 0, 0, 0.8);
        border-radius: 5px 5px 0 0;
    }

    .collection-card .product-image .bottle::after {
        content: '';
        position: absolute;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .collection-card .product-info {
        padding: 30px;
    }

    .collection-card .product-info .product-title {
        font-size: 1.3rem;
        color: #2c3e50;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .collection-card .product-info .product-title a {
        color: #2c3e50;
        text-decoration: none;
    }

    .collection-card .product-info .product-subtitle {
        color: #7f8c8d;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }

    .collection-card .product-info .rating {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .collection-card .product-info .rating .stars {
        color: #f39c12;
        font-size: 1.1rem;
    }

    .collection-card .product-info .rating .rating-info {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #7f8c8d;
        font-size: 0.9rem;
    }

    .collection-card .product-info .rating .rating-info .rating-score {
        font-weight: 600;
        color: #2c3e50;
    }

    .collection-card .product-info .price {
        font-size: 1.2rem;
        font-weight: 600;
        color: #e74c3c;
    }

    .collection-card .product-info .scent-indicators {
        display: flex;
        gap: 15px;
        margin-top: 15px;
    }

    .collection-card .product-info .scent-indicators .scent-tag {
        background: #ecf0f1;
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        color: #7f8c8d;
    }

    .collection-container .collection-card.card-1 .product-image {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .collection-container .collection-card.card-2 .product-image {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .collection-container .collection-card.card-3 .product-image {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .collection-container .collection-card.card-4 .product-image {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    @media (max-width: 768px) {
        .collection-container .collection-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .collection-container .collection-header h2 {
            font-size: 2rem;
        }
    }
</style>

<div class="collection-container">
    <div class="collection-container">
        <div class="collection-header">
            <h2>Editor's Picks</h2>
            <p>Curated blog posts from our writers — trending topics, timeless reads, and hidden gems.</p>
        </div>

        <div class="collection-grid">

            <?php
            // Custom query to limit posts to 3
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post_status' => 'publish'
            );

            $blog_posts = new WP_Query($args);

            if ($blog_posts->have_posts()) :
                $post_count = 0;
                while ($blog_posts->have_posts()) :
                    $blog_posts->the_post();
                    $post_count++;

                    // Get post data
                    $post_id = get_the_ID();
                    $post_title = get_the_title();
                    $post_excerpt = get_the_excerpt();
                    $post_permalink = get_permalink();
                    $post_date = get_the_date();
                    $reading_time = ceil(str_word_count(get_the_content()) / 200); // Estimate reading time
                    $comment_count = get_comments_number();

                    // Get categories for tags
                    $categories = get_the_category();
                    $category_names = array();
                    if (!empty($categories)) {
                        foreach ($categories as $category) {
                            $category_names[] = $category->name;
                        }
                    }

                    // Get featured image
                    $featured_image = get_the_post_thumbnail_url($post_id, 'medium');
            ?>

                    <div class="collection-card card-<?php echo $post_count; ?>">
                        <div class="bestseller-badge">FEATURED</div>
                        <div class="fragrance-notes">
                            <div class="note-icon">🧠</div>
                            <div class="note-icon">📖</div>
                            <div class="note-icon">🌿</div>
                        </div>
                        <div class="product-image">
                            <?php if ($featured_image) : ?>
                                <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr($post_title); ?>" class="post-thumbnail">
                            <?php else : ?>
                                <div class="bottle"></div>
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">
                                <a href="<?php echo esc_url($post_permalink); ?>">
                                    <?php echo esc_html($post_title); ?>
                                </a>
                            </h3>
                            <p class="product-subtitle">
                                <?php echo esc_html($post_excerpt ? wp_trim_words($post_excerpt, 10) : wp_trim_words(get_the_content(), 15)); ?>
                            </p>
                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <div class="rating-info">
                                    <span class="rating-score">4.4</span>
                                    <span>|</span>
                                    <span>📝 (<?php echo $comment_count; ?> comments)</span>
                                </div>
                            </div>
                            <div class="price"><?php echo $reading_time; ?> min read</div>
                            <div class="scent-indicators">
                                <?php if (!empty($category_names)) : ?>
                                    <?php foreach (array_slice($category_names, 0, 3) as $category_name) : ?>
                                        <div class="scent-tag"><?php echo esc_html($category_name); ?></div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div class="scent-tag">Blog</div>
                                    <div class="scent-tag">Article</div>
                                <?php endif; ?>
                            </div>
                            <div class="post-meta">
                                <span class="post-date"><?php echo esc_html($post_date); ?></span>
                            </div>
                        </div>
                    </div>

                <?php
                endwhile;

                // Reset post data
                wp_reset_postdata();

            else :
                ?>
                <div class="no-posts-message">
                    <p><?php _e('Sorry, no posts found'); ?></p>
                </div>
            <?php
            endif;
            ?>

        </div>
    </div>