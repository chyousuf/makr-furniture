<?php
/*
 * The front page template file
 * If the user has selected a static page for their homepage, this is what will appear.
 * Template Name: Front Page
 */
get_header();

get_template_part( 'inc/slider' ); ?>
<main id="main">
    <div class="block intro-block new-block">
        <div class="container">
            <?php the_field('page_content'); ?>
        </div>
    </div>
    <div class="wrap">
        <?php if( have_rows('section2_categories') ):
            while ( have_rows('section2_categories') ) : the_row();
                $link = get_sub_field('link');
                $banner_image = get_sub_field('background_image');
                $heading = get_sub_field('heading');
                $subheading = get_sub_field('sub_heading');
                $tagline = get_sub_field('tagline');
                if(empty($link)){$link = '#';}
                if(empty($banner_image)){$banner_image = '../images/image5.jpg';} ?>
                <a href="<?php echo $link; ?>" class="block text-center d-inline-block">
                    <img src="<?php echo $banner_image; ?>" class="img-fluid" alt="Image">
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
                        </div>
                    </div>
                </a>
            <?php endwhile;
        endif; ?>
    </div>
</main>

<?php get_footer(); ?>
