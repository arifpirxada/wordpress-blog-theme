<?php

/**
 * Template Name: 404 template.
 *
 * @package Elemental
 */
?>

<style>
    .container-404 {
        padding: 70px 20px;
    }

    .container-404 p,
    .container-404 h1 {
        text-align: center;
    }
</style>

<?php get_header() ?>

<div class="container-404">
    <h1>Not found 404</h1>
    <p>The page you are looking for does not exist!</p>
</div>

<?php get_footer() ?>