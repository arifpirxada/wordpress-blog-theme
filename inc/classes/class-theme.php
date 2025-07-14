<?php
class ELEMENTAL_THEME
{

	private static $instance = null;

	public static function get_instance()
	{
		if (self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct()
	{
		$this->setup_hooks();
	}

	private function setup_hooks()
	{
		add_action('after_setup_theme', [$this, 'setup_theme']);
	}

	public function setup_theme()
	{

		add_theme_support('title-tag');

		add_theme_support('custom-logo');

		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(150, 150, true);

		add_image_size('custom-thumb', 300, 200, true);
	}
}