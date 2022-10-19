<?php
/*
    * Template Name: Reception
    */
get_header();
    $id = get_the_ID();
    get_template_part( 'inc/page-banner' ); ?>
    <main id="main">
        <div class="block pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <?php the_field('page_content'); ?>
                    </div>
                </div>
            </div>
            <div class="row products products-columns mb-3">
                <?php if( have_rows('reception_images') ):
                    while ( have_rows('reception_images') ) : the_row(); ?>
                        <div class="col-12">
                            <div class="product"><img src="<?php the_sub_field('image'); ?>" alt="" class="alignnone size-full wp-image-203 img-fluid" /></div>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <?php the_field('shapes_content'); ?>
                        <div class="row products products-columns mb-3 shaped-image">
                            <?php if( have_rows('shapes') ):
                                while ( have_rows('shapes') ) : the_row(); ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                        <div class="product">
                                            <img src="<?php the_sub_field('diagram'); ?>" class="img-fluid" alt="">
                                            <div class="text">
                                                <span class="txt"><?php the_sub_field('heading'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile;
                            endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php get_footer(); ?>
