<?php
function register_theme_assets()
{
  // Register Google Fonts
  wp_register_style(
    'inter-font',
    'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap',
    array(),
    null
  );

  // Register main CSS (depends on Google Font)
  wp_register_style(
    'main-css',
    get_template_directory_uri() . '/assets/css/theme.css',
    array('inter-font'),
    filemtime(get_template_directory() . '/assets/css/theme.css')
  );

  if (is_front_page()) {
    // Enqueue front page CSS
    wp_enqueue_style(
      'front-page-css',
      get_template_directory_uri() . '/assets/css/front-page.css',
      array(),
      filemtime(get_template_directory() . '/assets/css/front-page.css')
    );
  }

  // Register main JS
  wp_register_script(
    'main-js',
    get_template_directory_uri() . '/assets/js/theme.js',
    array(),
    filemtime(get_template_directory() . '/assets/js/theme.js'),
    true
  );

  // Enqueue styles
  wp_enqueue_style('inter-font');
  wp_enqueue_style('main-css');

  // Enqueue scripts
  wp_enqueue_script('main-js');
}

add_action('wp_enqueue_scripts', 'register_theme_assets');


// Add menu support

function register_my_menus()
{
  register_nav_menus(
    array(
      'header-menu' => __('Header Menu'),
      'extra-menu' => __('Extra Menu')
    )
  );
}
add_action('init', 'register_my_menus');
