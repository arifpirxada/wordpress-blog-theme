<?php

class ELEMENTAL_HOMEPAGE_BANNERS
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
        add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
        add_action('save_post', [$this, 'save_meta_box']);
    }

    public function add_meta_boxes()
    {
        add_meta_box(
            'homepage_banner_details',
            'Banner Details',
            [$this, 'meta_box_callback'],
            'homepage_banners',
            'normal',
            'high'
        );
    }

    public function meta_box_callback($post)
    {
        wp_nonce_field('homepage_banner_meta_box', 'homepage_banner_meta_box_nonce');

        $heading = get_post_meta($post->ID, '_banner_heading', true);
        $description = get_post_meta($post->ID, '_banner_description', true);
        $button_text = get_post_meta($post->ID, '_banner_button_text', true);
        $button_url = get_post_meta($post->ID, '_banner_button_url', true);
        $display_order = get_post_meta($post->ID, '_banner_display_order', true);

?>
        <table class="form-table">
            <tr>
                <th><label for="banner_heading">Banner Heading</label></th>
                <td><input type="text" id="banner_heading" name="banner_heading" value="<?php echo esc_attr($heading); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="banner_description">Description</label></th>
                <td><textarea id="banner_description" name="banner_description" rows="4" class="large-text"><?php echo esc_textarea($description); ?></textarea></td>
            </tr>
            <tr>
                <th><label for="banner_button_text">Button Text</label></th>
                <td><input type="text" id="banner_button_text" name="banner_button_text" value="<?php echo esc_attr($button_text); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="banner_button_url">Button URL</label></th>
                <td><input type="url" id="banner_button_url" name="banner_button_url" value="<?php echo esc_attr($button_url); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="banner_display_order">Display Order</label></th>
                <td><input type="number" id="banner_display_order" name="banner_display_order" value="<?php echo esc_attr($display_order); ?>" class="small-text" min="0" /></td>
            </tr>
        </table>
<?php
    }

    public function save_meta_box($post_id)
    {
        if (
            !isset($_POST['homepage_banner_meta_box_nonce']) ||
            !wp_verify_nonce($_POST['homepage_banner_meta_box_nonce'], 'homepage_banner_meta_box')
        ) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        $fields = [
            'banner_heading' => '_banner_heading',
            'banner_description' => '_banner_description',
            'banner_button_text' => '_banner_button_text',
            'banner_button_url' => '_banner_button_url',
            'banner_display_order' => '_banner_display_order'
        ];

        foreach ($fields as $field => $meta_key) {
            if (isset($_POST[$field])) {
                $value = $_POST[$field];

                switch ($field) {
                    case 'banner_button_url':
                        $value = esc_url_raw($value);
                        break;
                    case 'banner_description':
                        $value = sanitize_textarea_field($value);
                        break;
                    case 'banner_display_order':
                        $value = absint($value);
                        break;
                    default:
                        $value = sanitize_text_field($value);
                }

                update_post_meta($post_id, $meta_key, $value);
            }
        }
    }

    public function get_banner_data($post_id)
    {
        return array(
            'heading' => get_post_meta($post_id, '_banner_heading', true),
            'description' => get_post_meta($post_id, '_banner_description', true),
            'button_text' => get_post_meta($post_id, '_banner_button_text', true),
            'button_url' => get_post_meta($post_id, '_banner_button_url', true),
            'display_order' => get_post_meta($post_id, '_banner_display_order', true),
            'image' => get_the_post_thumbnail_url($post_id, 'full'),
            'thumbnail' => get_the_post_thumbnail_url($post_id, 'thumbnail')
        );
    }

    public function get_all_banners($args = array())
    {
        $default_args = array(
            'post_type' => 'homepage_banners',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'meta_key' => '_banner_display_order',
            'orderby' => 'meta_value_num',
            'order' => 'ASC'
        );

        $args = wp_parse_args($args, $default_args);
        $banners = get_posts($args);

        $banner_data = array();
        foreach ($banners as $banner) {
            $banner_data[] = $this->get_banner_data($banner->ID);
        }

        return $banner_data;
    }

    public function get_active_banners()
    {
        return $this->get_all_banners();
    }
}