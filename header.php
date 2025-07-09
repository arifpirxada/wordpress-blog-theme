<?php

/**
 * Header template.
 *
 * @package Elemental
 */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header id="masthead" class="site-header">
        <?php get_template_part('template-parts/header/nav'); ?>
    </header>

    <div class="page">