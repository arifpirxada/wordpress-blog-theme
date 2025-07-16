<?php
include get_template_directory() . '/inc/helpers/menu-helper.php';

$header_menu_id = ELEMENTAL_MENU_HELPER::get_menu_id('header-menu');
$header_menus = wp_get_nav_menu_items($header_menu_id);

?>

<nav class="navbar">
    <div class="navbar-container">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand"><?php bloginfo('name'); ?></a>

        <?php if (! empty($header_menus) && is_array($header_menus)) { ?>

            <ul class="navbar-nav">

                <?php
                foreach ($header_menus as $menu_item) {
                    if (! $menu_item->menu_item_parent) {

                        $child_menu_items   = ELEMENTAL_MENU_HELPER::get_child_menu_items($header_menus, $menu_item->ID);
                        $has_children       = ! empty($child_menu_items) && is_array($child_menu_items);
                        $has_sub_menu_class = ! empty($has_children) ? 'has-submenu' : '';
                        $link_target        = ! empty($menu_item->target) && '_blank' === $menu_item->target ? '_blank' : '_self';

                        if (! $has_children) {
                ?>
                            <li class="nav-item">
                                <a href="<?php echo esc_url($menu_item->url); ?>"
                                    target="<?php echo esc_attr($link_target); ?>"
                                    title="<?php echo esc_attr($menu_item->title); ?>"

                                    class="active"><?php echo esc_html($menu_item->title); ?></a>
                            </li>
                        <?php
                        } else {
                        ?>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="<?php echo esc_url($menu_item->url); ?>"
                                    id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" target="<?php echo esc_attr($link_target); ?>"
                                    title="<?php echo esc_attr($menu_item->title); ?>">
                                    <?php echo esc_html($menu_item->title); ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php
                                    foreach ($child_menu_items as $child_menu_item) {
                                        $link_target = ! empty($child_menu_item->target) && '_blank' === $child_menu_item->target ? '_blank' : '_self';
                                    ?>
                                        <a class="dropdown-item"
                                            href="<?php echo esc_url($child_menu_item->url); ?>"
                                            target="<?php echo esc_attr($link_target); ?>"
                                            title="<?php echo esc_attr($child_menu_item->title); ?>">>
                                            <?php echo esc_html($child_menu_item->title); ?>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </li>


                        <?php } ?>

                <?php
                    }
                }
                ?>
            </ul>

        <?php
        }
        ?>

        <div class="navbar-search">
            <form method="get" action="<?php echo home_url('/'); ?>">
                <input type="text" name="s" placeholder="Search...">
            </form>
        </div>

        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>

    </div>
</nav>
<div class="navbar-space"></div>