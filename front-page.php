<?php
/*
 * The front page template file
 * If the user has selected a static page for their homepage, this is what will appear.
 * Template Name: Front Page
 */
get_header();

get_template_part( 'inc/slider' ); ?>
<main id="main">
    <div class="block intro-block new-block py-5">
        <div class="container">
            <?php the_field('page_content'); ?>
        </div>
    </div>
    <div class="section-block mt-5">
        <div class="container">
            <div class="row block-inner align-items-center text-center">
                <div class="col-md-6">
                    <?php the_field('section_block1_content'); ?>
                </div>
                <div class="col-md-6">
                    <img src="<?php the_field('section_block1_image'); ?>" width="361" height="441" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="section-block mt-5 mb-5">
        <div class="container">
            <div class="row block-inner align-items-center text-center">
                <div class="col-md-6">
                    <img src="<?php the_field('section_block2_image'); ?>" width="487" height="559" class="img-fluid" alt="">
                </div>
                <div class="col-md-6">
                    <?php the_field('section_block2_content'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="wrap section1 mb-5">
        <?php if( have_rows('section2_categories') ):
            while ( have_rows('section2_categories') ) : the_row();
                $link = get_sub_field('link');
                $banner_image = get_sub_field('background_image');
                $heading = get_sub_field('heading');
                $subheading = get_sub_field('sub_heading');
                $tagline = get_sub_field('tagline');
                if(empty($link)){$link = '#';}
                if(empty($banner_image)){$banner_image = '../images/image5.jpg';} ?>
                <div class="block text-center d-inline-block">
                    <img src="<?php echo $banner_image; ?>" width="1903" height="546" class="img-fluid" alt="Image">
                    <div class="head-outer">
                        <?php if(!empty($heading)){ ?>
                            <strong class="subtitle"><?php echo $heading; ?></strong>
                        <?php } ?>
                        <div class="head">
                            <?php if(!empty($subheading)){ ?>
                                <h2><?php echo $subheading; ?></h2>
                            <?php } if(!empty($tagline)){ ?>
                                <span class="subtext"><?php echo $tagline; ?></span>
                            <?php } ?>
                            <a href="<?php the_sub_field('link'); ?>"><?php the_sub_field('button_title'); ?></a>
                        </div>
                    </div>
                </div>
            <?php endwhile;
        endif; ?>
    </div>
    <div class="section2 text-center pt-3 mb-5">
        <div class="container">
            <?php the_field('section3_content'); ?>
            <img src="<?php the_field('section3_image'); ?>" width="1110" height="540" class="img-fluid mt-2" alt="">
        </div>
    </div>
    <div class="section3 mb-5 pb-5 pt-5">
        <div class="container">
            <div class="row pt-4">
                <?php if( have_rows('page_categories') ):
                    while ( have_rows('page_categories') ) : the_row(); ?>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <a href="<?php the_sub_field('category_link'); ?>" class="cat-block">
                                <img src="<?php the_sub_field('category_image'); ?>" width="494" height="494" class="img-fluid" alt="">
                                <div class="caption">
                                    <h3><?php the_sub_field('category_name'); ?></h3>
                                </div>
                            </a>
                        </div> 
                <?php endwhile;
                endif; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
