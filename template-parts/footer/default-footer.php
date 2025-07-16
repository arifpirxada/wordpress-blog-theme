<?php
include_once get_template_directory() . '/inc/helpers/menu-helper.php';

$footer_menu_id = ELEMENTAL_MENU_HELPER::get_menu_id('footer-menu');
$footer_menus = wp_get_nav_menu_items($footer_menu_id);

?>

<div class="footer">
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>Our mission is to deliver insightful and compelling blog content that resonates with readers and fosters meaningful connections worldwide.</p>
                <div class="social-links">
                    <a href="#" aria-label="Facebook">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>

                    <a href="#" aria-label="Twitter">
                        <svg width="20" height="20" viewBox="0 0 512 512" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                            <path d="M459.4 151.7c.3 4.5.3 9 .3 13.6 0 138.72-105.58 298.56-298.56 298.56-59.45 0-114.68-17.14-161.24-47.106 8.447.974 16.568 1.297 25.34 1.297 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 13.645 1.624 20.792 1.624 10.128 0 19.822-1.297 29.005-3.896-48.081-9.747-84.143-51.98-84.143-103.001v-1.298c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.195 5.197-37.036 14.294-52.457C132.68 153.74 228.27 217.85 336.1 225.89c-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.935-104.934 30.214 0 57.502 12.67 76.67 33.137 23.715-4.548 46.132-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.792-32.161 39.308-52.628 54.253z" />
                        </svg>
                    </a>


                    <a href="#" aria-label="Instagram">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke="#fff" stroke-width="2" />
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" stroke="#fff" stroke-width="2" fill="none" />
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke="#fff" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </a>


                    <a href="#" aria-label="LinkedIn">
                        <svg width="20" height="20" viewBox="0 0 448 512" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100.28 448H7.4V148.9h92.88zm-46.44-341C24.13 107 0 82.87 0 53.5S24.13 0 53.84 0s53.84 24.13 53.84 53.5-24.13 53.5-53.84 53.5zM447.9 448h-92.4V302.4c0-34.7-.7-79.3-48.3-79.3-48.3 0-55.7 37.7-55.7 76.6V448h-92.4V148.9h88.7v40.8h1.3c12.4-23.6 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z" />
                        </svg>
                    </a>

                </div>
            </div>

            <?php if (! empty($footer_menus) && is_array($footer_menus)) { ?>

                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">

                        <?php foreach ($footer_menus as $menu_item) {
                            if (! $menu_item->menu_item_parent) {
                        ?>

                                <li><a href="<?php echo esc_url($menu_item->url); ?>" title="<?php echo esc_attr($menu_item->title); ?>"><?php echo esc_html($menu_item->title); ?></a></li>

                        <?php
                            }
                        } ?>
                    </ul>
                </div>

            <?php } ?>

            <div class="footer-section">
                <h3>Contact Info</h3>
                <div class="contact-info">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>123 Business Street, City, Country</span>
                </div>
                <div class="contact-info">
                    <i class="fas fa-phone"></i>
                    <span>+1 (555) 123-4567</span>
                </div>
                <div class="contact-info">
                    <i class="fas fa-envelope"></i>
                    <span>hello@company.com</span>
                </div>
            </div>

            <div class="footer-section">
                <div class="newsletter">
                    <h3>Stay Updated</h3>
                    <p>Subscribe to our newsletter for the latest updates and offers.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Enter your email" required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Elemental. All rights reserved. | Developed by arifpirxada</p>
            <p>
                <a href="#">Privacy Policy</a> |
                <a href="#">Terms of Service</a> |
                <a href="#">Cookie Policy</a>
            </p>
        </div>
    </div>
</div>