<?php
/*
    * Template Name: Top Programs
    */
get_header();
    $id = get_the_ID();
    get_template_part( 'inc/page-banner' ); ?>
    <main id="main">
        <div class="block pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-3 order-2 order-md-1">
                        <?php get_template_part( 'inc/product-sidebar' ); ?>
                    </div>
                    <div class="col-12 col-md-8 col-lg-9 order-1 order-md-2">
                        <?php the_field('page_content'); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php get_footer(); ?>
