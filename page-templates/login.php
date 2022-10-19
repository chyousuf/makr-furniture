<?php
/*
    * Template Name: Login
    */
get_header();
    $id = get_the_ID(); ?>
    <?php echo do_shortcode('[woocommerce_my_account]'); ?>

<?php get_footer(); ?>
