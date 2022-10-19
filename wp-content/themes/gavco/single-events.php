<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Gavco
 */

get_header(); ?>

    <?php while ( have_posts() ) : the_post();
        $id1 = get_the_ID();
        $image_url = get_the_post_thumbnail_url(get_the_ID(),'full');
        get_template_part( 'inc/page-banner' ); ?>
        <main>
            <div class="container">
                <section class="page-content">
                    <div class="row">
                        <div class="col-lg-8">
                            <h2><?php the_title(); ?></h2>
                            <div class="d-xl-flex justify-content-xl-between mt-3 mt-lg-4">
                                <div class="flex-content pr-xl-4">
                                    <?php the_content(); ?>
                                </div>
                                <div class="flex-image">
                                    <?php $post_thumbnail_url = get_the_post_thumbnail_url($id1,'full'); ?>
                                    <img src="<?php echo $post_thumbnail_url; ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-sidebar events-detail">
                                <h3>Related Events</h3>
                                <ul class="mt-4">
                                    <?php $EVENTS_args = array(
                                        'post_type' => 'events',
                                        'post_status' => 'publish',
                                        'posts_per_page' => '-1',
                                        'order'=>'ASC',
                                    );
                                    $EVENTS_data = new WP_Query($EVENTS_args);
                                    if($EVENTS_data->have_posts()):
                                        while($EVENTS_data->have_posts()): $EVENTS_data->the_post();    $rid = get_the_ID(); ?>
                                            <li class="<?php if($id1 == $rid){echo 'active';} ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                        <?php endwhile;
                                    endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    <?php endwhile;

get_footer(); ?>
