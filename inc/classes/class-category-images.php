<?php

/**
 * Category Images Class
 * Handles category image upload functionality
 */

class CATEGORY_IMAGES
{

    public function __construct()
    {
        add_action('init', array($this, 'init'));
    }

    /**
     * Initialize category images functionality
     */
    public function init()
    {
        // Register term meta for category image
        add_action('category_add_form_fields', array($this, 'add_category_image_field'));
        add_action('category_edit_form_fields', array($this, 'edit_category_image_field'), 10, 2);
        add_action('created_category', array($this, 'save_category_image'));
        add_action('edited_category', array($this, 'save_category_image'));

        // Enqueue scripts for admin
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

    /**
     * Add category image field to new category form
     */
    public function add_category_image_field($taxonomy)
    {
?>
        <div class="form-field term-group">
            <label for="category_image"><?php _e('Category Image', 'textdomain'); ?></label>
            <input type="hidden" name="category_image" id="category_image" value="" />
            <div id="category_image_preview" style="margin-bottom: 10px;"></div>
            <input type="button" class="button" value="<?php _e('Upload Image', 'textdomain'); ?>" id="upload_category_image" />
            <input type="button" class="button" value="<?php _e('Remove Image', 'textdomain'); ?>" id="remove_category_image" style="display: none;" />
            <p class="description"><?php _e('Upload an image for this category.', 'textdomain'); ?></p>
        </div>
    <?php
    }

    /**
     * Add category image field to edit category form
     */
    public function edit_category_image_field($term, $taxonomy)
    {
        $category_image = get_term_meta($term->term_id, 'category_image', true);
    ?>
        <tr class="form-field term-group-wrap">
            <th scope="row">
                <label for="category_image"><?php _e('Category Image', 'textdomain'); ?></label>
            </th>
            <td>
                <input type="hidden" name="category_image" id="category_image" value="<?php echo esc_url($category_image); ?>" />
                <div id="category_image_preview" style="margin-bottom: 10px;">
                    <?php if ($category_image): ?>
                        <img src="<?php echo esc_url($category_image); ?>" style="max-width: 150px; height: auto;" />
                    <?php endif; ?>
                </div>
                <input type="button" class="button" value="<?php _e('Upload Image', 'textdomain'); ?>" id="upload_category_image" />
                <input type="button" class="button" value="<?php _e('Remove Image', 'textdomain'); ?>" id="remove_category_image" <?php echo $category_image ? '' : 'style="display: none;"'; ?> />
                <p class="description"><?php _e('Upload an image for this category.', 'textdomain'); ?></p>
            </td>
        </tr>
<?php
    }

    /**
     * Save category image
     */
    public function save_category_image($term_id)
    {
        if (isset($_POST['category_image'])) {
            update_term_meta($term_id, 'category_image', esc_url_raw($_POST['category_image']));
        }
    }

    /**
     * Enqueue admin scripts
     */
    public function enqueue_admin_scripts($hook)
    {
        if ($hook == 'edit-tags.php' || $hook == 'term.php') {
            wp_enqueue_media();
            wp_enqueue_script(
                'category-images-admin',
                get_template_directory_uri() . '/assets/js/category-images-admin.js',
                array(''),
                '1.0.0',
                true
            );
        }
    }

    /**
     * Get category image URL
     */
    public static function get_category_image($term_id)
    {
        return get_term_meta($term_id, 'category_image', true);
    }

    /**
     * Display category image
     */
    public static function display_category_image($term_id, $size = 'thumbnail', $attr = array())
    {
        $image_url = self::get_category_image($term_id);

        if ($image_url) {
            $default_attr = array(
                'src' => $image_url,
                'alt' => get_term($term_id)->name,
                'class' => 'category-image'
            );

            $attr = wp_parse_args($attr, $default_attr);
            $attr_string = '';

            foreach ($attr as $key => $value) {
                $attr_string .= $key . '="' . esc_attr($value) . '" ';
            }

            return '<img ' . trim($attr_string) . ' />';
        }

        return '';
    }
}

new CATEGORY_IMAGES();