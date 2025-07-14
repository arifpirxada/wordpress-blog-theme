<?php

class ELEMENTAL_HELPER_FUNCTIONS
{

    private static $instance = null;

    public static function get_instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {}

    public function get_theme_option($option_name, $default = '')
    {
        return get_theme_mod($option_name, $default);
    }

    public function format_phone($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($phone) == 10) {
            return '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . '-' . substr($phone, 6);
        }
        return $phone;
    }

    public function get_custom_excerpt($post_id = null, $length = 55, $more = '...')
    {
        $post = $post_id ? get_post($post_id) : get_post();

        if (!$post) return '';

        if ($post->post_excerpt) {
            return wp_trim_words($post->post_excerpt, $length, $more);
        }

        return wp_trim_words($post->post_content, $length, $more);
    }

    public function is_blog_page()
    {
        return (is_home() || is_single() || is_category() || is_tag() || is_archive());
    }

    public function get_social_links()
    {
        $social_links = array(
            'facebook' => $this->get_theme_option('facebook_url'),
            'twitter' => $this->get_theme_option('twitter_url'),
            'instagram' => $this->get_theme_option('instagram_url'),
            'linkedin' => $this->get_theme_option('linkedin_url'),
            'youtube' => $this->get_theme_option('youtube_url')
        );

        return array_filter($social_links);
    }

    public function generate_breadcrumbs($separator = ' > ')
    {
        $breadcrumbs = array();

        $breadcrumbs[] = '<a href="' . home_url() . '">Home</a>';

        if (is_category()) {
            $breadcrumbs[] = '<a href="' . get_permalink(get_option('page_for_posts')) . '">Blog</a>';
            $breadcrumbs[] = single_cat_title('', false);
        } elseif (is_single()) {
            $breadcrumbs[] = '<a href="' . get_permalink(get_option('page_for_posts')) . '">Blog</a>';
            $breadcrumbs[] = get_the_title();
        } elseif (is_page()) {
            $breadcrumbs[] = get_the_title();
        }

        return implode($separator, $breadcrumbs);
    }

    public function get_reading_time($post_id = null)
    {
        $post = $post_id ? get_post($post_id) : get_post();
        if (!$post) return 0;

        $word_count = str_word_count(strip_tags($post->post_content));
        $reading_time = ceil($word_count / 200);

        return $reading_time;
    }

    public function generate_article_schema($post_id = null)
    {
        $post = $post_id ? get_post($post_id) : get_post();
        if (!$post) return '';

        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => get_the_title($post),
            'description' => $this->get_custom_excerpt($post->ID, 25),
            'datePublished' => get_the_date('c', $post),
            'dateModified' => get_the_modified_date('c', $post),
            'author' => array(
                '@type' => 'Person',
                'name' => get_the_author_meta('display_name', $post->post_author)
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name' => get_bloginfo('name')
            )
        );

        if (has_post_thumbnail($post)) {
            $schema['image'] = get_the_post_thumbnail_url($post, 'full');
        }

        return '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }
}

function elemental_helper()
{
    return ELEMENTAL_HELPER_FUNCTIONS::get_instance();
}