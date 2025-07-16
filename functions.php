<?php
function elemental_theme_autoload()
{
    $classes = [
        'inc/classes/class-theme.php',
        'inc/classes/class-assets.php',
        'inc/classes/class-menus.php',
        'inc/classes/class-custom-post-types.php',
        'inc/classes/class-homepage-banners.php',
        'inc/classes/class-category-images.php'
    ];

    foreach ($classes as $class) {
        $file = get_template_directory() . '/' . $class;
        if (file_exists($file)) {
            require_once $file;
        }
    }
}

function elemental_theme_load_helpers()
{
    $helper_file = get_template_directory() . '/inc/helpers/helper-functions.php';
    if (file_exists($helper_file)) {
        require_once $helper_file;
    }
}

function elemental_theme_init()
{
    elemental_theme_autoload();
    elemental_theme_load_helpers();

    ELEMENTAL_THEME::get_instance();
    ELEMENTAL_ASSETS::get_instance();
    ELEMENTAL_MENUS::get_instance();
    ELEMENTAL_CUSTOM_POST_TYPES::get_instance();
    ELEMENTAL_HOMEPAGE_BANNERS::get_instance();
}

elemental_theme_init();
