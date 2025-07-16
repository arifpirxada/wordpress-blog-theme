<?php
/**
 * Template Name: Single template.
 *
 * @package Elemental
 */

get_header(); ?>

<div class="container-single">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-article'); ?>>
                
                <!-- Post Header -->
                <header class="post-header">
                    <div class="post-meta-top">
                        <span class="post-category">
                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)) {
                                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
                            }
                            ?>
                        </span>
                        <span class="post-date">
                            <time datetime="<?php echo get_the_date('c'); ?>">
                                <?php echo get_the_date(); ?>
                            </time>
                        </span>
                    </div>
                    
                    <h1 class="post-title"><?php the_title(); ?></h1>
                    
                    <div class="post-meta-bottom">
                        <div class="author-info">
                            <?php echo get_avatar(get_the_author_meta('ID'), 40); ?>
                            <span class="author-name">
                                By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                    <?php the_author(); ?>
                                </a>
                            </span>
                        </div>
                        <div class="post-stats">
                            <span class="reading-time">
                                <?php
                                $content = get_post_field('post_content', get_the_ID());
                                $word_count = str_word_count(strip_tags($content));
                                $reading_time = ceil($word_count / 200);
                                echo $reading_time . ' min read';
                                ?>
                            </span>
                            <?php if (comments_open() || get_comments_number()) : ?>
                                <span class="comments-count">
                                    <a href="#comments"><?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></a>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </header>

                <!-- Featured Image -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-featured-image">
                        <?php the_post_thumbnail('large', array('class' => 'featured-img')); ?>
                    </div>
                <?php endif; ?>

                <!-- Post Content -->
                <div class="post-content">
                    <?php the_content(); ?>
                    
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links">',
                        'after' => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after' => '</span>',
                    ));
                    ?>
                </div>

                <!-- Post Tags -->
                <?php if (has_tag()) : ?>
                    <div class="post-tags">
                        <h3>Tags:</h3>
                        <div class="tag-list">
                            <?php
                            $tags = get_the_tags();
                            foreach ($tags as $tag) {
                                echo '<a href="' . get_tag_link($tag->term_id) . '" class="tag-link">' . $tag->name . '</a>';
                            }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Author Bio -->
                <div class="author-bio">
                    <div class="author-avatar">
                        <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                    </div>
                    <div class="author-details">
                        <h3 class="author-name"><?php the_author(); ?></h3>
                        <p class="author-description"><?php the_author_meta('description'); ?></p>
                        <div class="author-links">
                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="author-posts-link">
                                View all posts by <?php the_author(); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Post Navigation -->
                <nav class="post-navigation">
                    <div class="nav-previous">
                        <?php
                        $prev_post = get_previous_post();
                        if (!empty($prev_post)) :
                        ?>
                            <a href="<?php echo get_permalink($prev_post->ID); ?>" class="nav-link">
                                <span class="nav-direction">← Previous</span>
                                <span class="nav-title"><?php echo get_the_title($prev_post->ID); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="nav-next">
                        <?php
                        $next_post = get_next_post();
                        if (!empty($next_post)) :
                        ?>
                            <a href="<?php echo get_permalink($next_post->ID); ?>" class="nav-link">
                                <span class="nav-direction">Next →</span>
                                <span class="nav-title"><?php echo get_the_title($next_post->ID); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </nav>

                <!-- Related Posts -->
                <?php
                $related_posts = get_posts(array(
                    'category__in' => wp_get_post_categories($post->ID),
                    'numberposts' => 3,
                    'post__not_in' => array($post->ID)
                ));
                
                if ($related_posts) :
                ?>
                    <section class="related-posts">
                        <h3>Related Posts</h3>
                        <div class="related-posts-grid">
                            <?php foreach ($related_posts as $related_post) : ?>
                                <div class="related-post-item">
                                    <a href="<?php echo get_permalink($related_post->ID); ?>">
                                        <?php if (has_post_thumbnail($related_post->ID)) : ?>
                                            <div class="related-post-thumbnail">
                                                <?php echo get_the_post_thumbnail($related_post->ID, 'medium'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="related-post-content">
                                            <h4><?php echo get_the_title($related_post->ID); ?></h4>
                                            <span class="related-post-date"><?php echo get_the_date('', $related_post->ID); ?></span>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <!-- Comments -->
                <?php if (comments_open() || get_comments_number()) : ?>
                    <div class="comments-section">
                        <?php
                        // Custom comments template
                        if (have_comments()) : ?>
                            <h2 class="comments-title">
                                <?php
                                $comments_number = get_comments_number();
                                if ($comments_number == 1) {
                                    echo '1 Comment';
                                } else {
                                    echo $comments_number . ' Comments';
                                }
                                ?>
                            </h2>
                            
                            <ol class="comment-list">
                                <?php
                                wp_list_comments(array(
                                    'style' => 'ol',
                                    'short_ping' => true,
                                    'avatar_size' => 40,
                                    'callback' => function($comment, $args, $depth) {
                                        $tag = ($args['style'] == 'div') ? 'div' : 'li';
                                        ?>
                                        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
                                            <div class="comment-meta">
                                                <div class="comment-author">
                                                    <?php echo get_avatar($comment, 40); ?>
                                                    <cite class="fn"><?php comment_author_link(); ?></cite>
                                                </div>
                                                <div class="comment-metadata">
                                                    <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
                                                        <time datetime="<?php comment_time('c'); ?>">
                                                            <?php comment_date(); ?> at <?php comment_time(); ?>
                                                        </time>
                                                    </a>
                                                </div>
                                            </div>
                                            
                                            <?php if ($comment->comment_approved == '0') : ?>
                                                <div class="comment-awaiting-moderation">
                                                    Your comment is awaiting moderation.
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div class="comment-content">
                                                <?php comment_text(); ?>
                                            </div>
                                            
                                            <div class="reply">
                                                <?php
                                                comment_reply_link(array_merge($args, array(
                                                    'add_below' => 'comment',
                                                    'depth' => $depth,
                                                    'max_depth' => $args['max_depth']
                                                )));
                                                ?>
                                            </div>
                                        <?php
                                    }
                                ));
                                ?>
                            </ol>
                            
                            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                                <nav class="comment-navigation">
                                    <div class="nav-previous">
                                        <?php previous_comments_link('&larr; Older Comments'); ?>
                                    </div>
                                    <div class="nav-next">
                                        <?php next_comments_link('Newer Comments &rarr;'); ?>
                                    </div>
                                </nav>
                            <?php endif; ?>
                            
                        <?php else : ?>
                            <div class="no-comments">
                                <h3>No comments yet</h3>
                                <p>Be the first to share your thoughts!</p>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (comments_open()) : ?>
                            <div class="comment-form-wrapper">
                                <?php
                                // Get commenter data
                                $commenter = wp_get_current_commenter();
                                
                                comment_form(array(
                                    'title_reply' => 'Leave a Comment',
                                    'title_reply_to' => 'Leave a Reply to %s',
                                    'label_submit' => 'Post Comment',
                                    'comment_field' => '<p class="comment-form-comment"><label for="comment">Comment *</label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>',
                                    'fields' => array(
                                        'author' => '<div class="comment-form-fields"><p class="comment-form-author"><label for="author">Name *</label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" required /></p>',
                                        'email' => '<p class="comment-form-email"><label for="email">Email *</label><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" required /></p></div>',
                                        'url' => '<p class="comment-form-url"><label for="url">Website</label><input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>'
                                    )
                                ));
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <div class="no-posts">
            <h2>Post not found</h2>
            <p>Sorry, the post you're looking for doesn't exist.</p>
            <a href="<?php echo home_url(); ?>" class="back-home">← Back to Home</a>
        </div>
    <?php endif; ?>
</div>

<style>
.container-single {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.6;
    color: #333;
}

.single-post-article {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 2rem;
}

/* Post Header */
.post-header {
    padding: 2rem 2rem 1rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.post-meta-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

.post-category a {
    background: rgba(255, 255, 255, 0.2);
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    color: white;
    text-decoration: none;
    transition: background 0.3s;
}

.post-category a:hover {
    background: rgba(255, 255, 255, 0.3);
}

.post-title {
    font-size: 2.5rem;
    margin: 0 0 1.5rem;
    font-weight: 700;
    line-height: 1.2;
}

.post-meta-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
}

.author-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.author-info img {
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.author-name a {
    color: white;
    text-decoration: none;
    font-weight: 500;
}

.post-stats {
    display: flex;
    gap: 1rem;
    font-size: 0.9rem;
}

.post-stats a {
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
}

/* Featured Image */
.post-featured-image {
    width: 100%;
    height: 400px;
    overflow: hidden;
}

.featured-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.featured-img:hover {
    transform: scale(1.05);
}

/* Post Content */
.post-content {
    padding: 2rem;
    font-size: 1.1rem;
    line-height: 1.8;
}

.post-content h2, .post-content h3 {
    color: #2c3e50;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.post-content p {
    margin-bottom: 1.5rem;
}

.post-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1rem 0;
}

/* Tags */
.post-tags {
    padding: 0 2rem 1rem;
    border-bottom: 1px solid #eee;
}

.post-tags h3 {
    margin-bottom: 0.5rem;
    color: #666;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.tag-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.tag-link {
    background: #f8f9fa;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    color: #495057;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s;
}

.tag-link:hover {
    background: #667eea;
    color: white;
}

/* Author Bio */
.author-bio {
    display: flex;
    gap: 1rem;
    padding: 2rem;
    background: #f8f9fa;
    border-top: 1px solid #eee;
}

.author-avatar img {
    border-radius: 50%;
    width: 80px;
    height: 80px;
}

.author-details {
    flex: 1;
}

.author-details h3 {
    margin: 0 0 0.5rem;
    color: #2c3e50;
}

.author-description {
    color: #666;
    margin-bottom: 1rem;
}

.author-posts-link {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
}

/* Post Navigation */
.post-navigation {
    display: flex;
    justify-content: space-between;
    padding: 2rem;
    border-top: 1px solid #eee;
    gap: 2rem;
}

.nav-previous, .nav-next {
    flex: 1;
}

.nav-next {
    text-align: right;
}

.nav-link {
    display: block;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    text-decoration: none;
    color: #333;
    transition: all 0.3s;
}

.nav-link:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
}

.nav-direction {
    font-size: 0.9rem;
    color: #666;
    display: block;
    margin-bottom: 0.25rem;
}

.nav-link:hover .nav-direction {
    color: rgba(255, 255, 255, 0.8);
}

.nav-title {
    font-weight: 600;
    line-height: 1.3;
}

/* Related Posts */
.related-posts {
    padding: 2rem;
    border-top: 1px solid #eee;
}

.related-posts h3 {
    margin-bottom: 1.5rem;
    color: #2c3e50;
}

.related-posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.related-post-item {
    background: #f8f9fa;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s;
}

.related-post-item:hover {
    transform: translateY(-5px);
}

.related-post-item a {
    display: block;
    text-decoration: none;
    color: #333;
}

.related-post-thumbnail {
    height: 150px;
    overflow: hidden;
}

.related-post-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.related-post-content {
    padding: 1rem;
}

.related-post-content h4 {
    margin: 0 0 0.5rem;
    font-size: 1.1rem;
    line-height: 1.3;
}

.related-post-date {
    color: #666;
    font-size: 0.9rem;
}

/* Comments */
.comments-section {
    padding: 2rem;
    border-top: 1px solid #eee;
    background: #f8f9fa;
}

/* Comments Form Styling */
.comment-respond {
    margin-bottom: 2rem;
}

.comment-respond .comment-reply-title {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: #2c3e50;
    font-weight: 600;
}

.comment-form {
    background: white;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.comment-form-comment {
    margin-bottom: 1.5rem;
}

.comment-form-comment label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #333;
}

.comment-form-comment textarea {
    width: 100%;
    min-height: 120px;
    padding: 1rem;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-family: inherit;
    font-size: 1rem;
    resize: vertical;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.comment-form-comment textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.comment-form-author,
.comment-form-email,
.comment-form-url {
    display: flex;
    flex-direction: column;
    margin-bottom: 1rem;
}

.comment-form-author input,
.comment-form-email input,
.comment-form-url input {
    padding: 0.75rem;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-family: inherit;
    font-size: 1rem;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.comment-form-author input:focus,
.comment-form-email input:focus,
.comment-form-url input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.comment-form-author label,
.comment-form-email label,
.comment-form-url label {
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #333;
}

.form-submit {
    margin-top: 1rem;
}

.form-submit #submit {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 2px 10px rgba(102, 126, 234, 0.3);
}

.form-submit #submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
}

/* Comments List */
.comments-title {
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    color: #2c3e50;
    font-weight: 600;
}

.comment-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.comment-list .comment {
    margin-bottom: 2rem;
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    position: relative;
}

.comment-list .comment:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 4px 0 0 4px;
}

.comment-list .children {
    margin-left: 2rem;
    margin-top: 1rem;
    padding-left: 1rem;
    border-left: 2px solid #e9ecef;
}

.comment-meta {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    gap: 1rem;
}

.comment-author {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.comment-author img {
    border-radius: 50%;
    width: 40px;
    height: 40px;
}

.comment-author .fn {
    font-weight: 600;
    color: #2c3e50;
    text-decoration: none;
}

.comment-author .fn:hover {
    color: #667eea;
}

.comment-metadata {
    color: #666;
    font-size: 0.9rem;
}

.comment-metadata a {
    color: #666;
    text-decoration: none;
}

.comment-metadata a:hover {
    color: #667eea;
}

.comment-content {
    margin-bottom: 1rem;
    line-height: 1.6;
}

.comment-content p {
    margin-bottom: 1rem;
}

.comment-content p:last-child {
    margin-bottom: 0;
}

.reply {
    text-align: right;
}

.reply a {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: #f8f9fa;
    color: #667eea;
    text-decoration: none;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s;
}

.reply a:hover {
    background: #667eea;
    color: white;
    transform: translateY(-1px);
}

/* Comment Awaiting Moderation */
.comment-awaiting-moderation {
    color: #856404;
    background: #fff3cd;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    border: 1px solid #ffeaa7;
}

/* No Comments */
.no-comments {
    text-align: center;
    padding: 2rem;
    color: #666;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.no-comments h3 {
    margin-bottom: 0.5rem;
    color: #2c3e50;
}

/* Comments Navigation */
.comment-navigation {
    margin: 2rem 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.nav-previous a,
.nav-next a {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: #667eea;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    transition: background 0.3s;
}

.nav-previous a:hover,
.nav-next a:hover {
    background: #5a67d8;
}

/* Comments Form Fields Layout */
.comment-form-fields {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.comment-form-url {
    grid-column: 1 / -1;
}

/* No Posts */
.no-posts {
    text-align: center;
    padding: 3rem;
    color: #666;
}

.no-posts h2 {
    color: #2c3e50;
    margin-bottom: 1rem;
}

.back-home {
    display: inline-block;
    margin-top: 1rem;
    padding: 0.75rem 1.5rem;
    background: #667eea;
    color: white;
    text-decoration: none;
    border-radius: 25px;
    transition: background 0.3s;
}

.back-home:hover {
    background: #5a67d8;
}

/* Page Links */
.page-links {
    margin: 2rem 0;
    text-align: center;
}

.page-links .page-number {
    display: inline-block;
    margin: 0 0.25rem;
    padding: 0.5rem 1rem;
    background: #f8f9fa;
    border-radius: 4px;
    text-decoration: none;
    color: #333;
    transition: background 0.3s;
}

.page-links .page-number:hover {
    background: #667eea;
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container-single {
        padding: 1rem;
    }
    
    .post-header {
        padding: 1.5rem 1.5rem 1rem;
    }
    
    .post-title {
        font-size: 2rem;
    }
    
    .post-meta-bottom {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .post-content {
        padding: 1.5rem;
    }
    
    .author-bio {
        flex-direction: column;
        text-align: center;
    }
    
    .post-navigation {
        flex-direction: column;
        gap: 1rem;
    }
    
    .nav-next {
        text-align: left;
    }
    
    .related-posts-grid {
        grid-template-columns: 1fr;
    }
    
    .comment-form-fields {
        grid-template-columns: 1fr;
    }
    
    .comment-list .children {
        margin-left: 1rem;
    }
}

@media (max-width: 480px) {
    .post-title {
        font-size: 1.75rem;
    }
    
    .post-meta-top {
        flex-direction: column;
        gap: 0.5rem;
        align-items: flex-start;
    }
    
    .post-stats {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>

<?php get_footer(); ?>