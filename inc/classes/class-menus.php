<?php

class ELEMENTAL_MENUS
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
        add_action('init', [$this, 'register_menus']);
    }

    public function register_menus()
    {
        register_nav_menus(
            array(
                'header-menu' => __('Header Menu'),
                'extra-menu' => __('Extra Menu'),
                'footer-menu' => __('Footer Menu')
            )
        );
    }

    public function get_menu_items($location)
    {
        $locations = get_nav_menu_locations();
        if (!isset($locations[$location])) {
            return false;
        }

        $menu = wp_get_nav_menu_object($locations[$location]);
        if (!$menu) {
            return false;
        }

        return wp_get_nav_menu_items($menu);
    }

    public function display_menu($location, $args = array())
    {
        $default_args = array(
            'theme_location' => $location,
            'container' => false,
            'echo' => false
        );

        $args = wp_parse_args($args, $default_args);
        return wp_nav_menu($args);
    }
}