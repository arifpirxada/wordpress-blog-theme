<?php

class ELEMENTAL_CUSTOM_POST_TYPES
{

    private static $instance = null;

    public static function get_instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->setup_hooks();
    }

    private function setup_hooks()
    {
        add_action('init', [$this, 'register_custom_post_types']);
    }

    public function register_custom_post_types()
    {
        $this->register_homepage_banners();
    }

    private function register_homepage_banners()
    {
        register_post_type(
            'homepage_banners',
            array(
                'label' => 'Homepage Banners',
                'labels' => array(
                    'name' => 'Homepage Banners',
                    'singular_name' => 'Homepage Banner',
                    'add_new' => 'Add New Banner',
                    'add_new_item' => 'Add New Homepage Banner',
                    'edit_item' => 'Edit Homepage Banner',
                    'new_item' => 'New Homepage Banner',
                    'view_item' => 'View Homepage Banner',
                    'search_items' => 'Search Homepage Banners',
                    'not_found' => 'No homepage banners found',
                    'not_found_in_trash' => 'No homepage banners found in Trash',
                    'all_items' => 'All Homepage Banners',
                    'menu_name' => 'Homepage Banners'
                ),
                'description' => 'Custom post type for homepage banner content',
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'show_in_admin_bar' => true,
                'show_in_nav_menus' => false,
                'can_export' => true,
                'has_archive' => false,
                'exclude_from_search' => true,
                'capability_type' => 'post',
                'show_in_rest' => true,
                'supports' => array(
                    'title',
                    'editor',
                    'thumbnail',
                    'excerpt',
                    'custom-fields'
                ),
                'menu_icon' => 'dashicons-images-alt2',
                'menu_position' => 20,
                'hierarchical' => false,
                'rewrite' => array(
                    'slug' => 'homepage-banners',
                    'with_front' => false
                )
            )
        );
    }

    public function get_posts_by_type($post_type, $args = array())
    {
        $default_args = array(
            'post_type' => $post_type,
            'posts_per_page' => -1,
            'post_status' => 'publish'
        );

        $args = wp_parse_args($args, $default_args);
        return get_posts($args);
    }

    public function post_type_exists($post_type)
    {
        return post_type_exists($post_type);
    }
}