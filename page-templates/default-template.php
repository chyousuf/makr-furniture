<?php
/*
    * Template Name: Default Template New
    */
get_header();
    $id = get_the_ID();
    get_template_part( 'inc/page-banner' ); ?>
    <main>
        <div class="container">
            <section class="page-content">
                <div class="row">
                    <div class="col-lg-8">
                        <h2><?php the_title(); ?></h2>
                        <?php the_field('page_content',$id); ?>
                    </div>
                    <div class="col-lg-4">
                        <div class="page-sidebar">
                            <?php get_template_part( 'inc/sidebar-menu' ); ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

<?php get_footer(); ?>
