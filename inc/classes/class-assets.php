<?php

class ELEMENTAL_ASSETS
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
        add_action('wp_enqueue_scripts', [$this, 'register_theme_assets']);
    }

    public function register_theme_assets()
    {
        wp_register_style(
            'inter-font',
            'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap',
            array(),
            null
        );

        wp_register_style(
            'main-css',
            get_template_directory_uri() . '/assets/css/theme.css',
            array('inter-font'),
            filemtime(get_template_directory() . '/assets/css/theme.css')
        );

        if (is_front_page()) {
            wp_enqueue_style(
                'front-page-css',
                get_template_directory_uri() . '/assets/css/front-page.css',
                array('main-css'),
                filemtime(get_template_directory() . '/assets/css/front-page.css')
            );
        }

        wp_register_script(
            'main-js',
            get_template_directory_uri() . '/assets/js/theme.js',
            array(),
            filemtime(get_template_directory() . '/assets/js/theme.js'),
            true
        );

        wp_enqueue_style('inter-font');
        wp_enqueue_style('main-css');
        wp_enqueue_script('main-js');
    }

    public function enqueue_conditional_asset($handle, $condition = true)
    {
        if ($condition) {
            wp_enqueue_style($handle);
        }
    }

    public function add_inline_styles($handle, $css)
    {
        wp_add_inline_style($handle, $css);
    }
}