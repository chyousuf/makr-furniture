<?php
/*
    * Template Name: Coming Soon
    */
get_header();
    $id = get_the_ID(); ?>
    <div class="banner">
        <img src="<?php bloginfo('template_url'); ?>/images/resources.jpg" alt="">
    </div>
    <main id="main">
        <div class="block pb-5 text-center">
            <div class="container">
                <h3>Coming Soon....</h3>
            </div>
        </div>
    </main>

<?php get_footer(); ?>
