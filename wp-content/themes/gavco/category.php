<?php
/**
 * The template for displaying category pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Gavco
 */

get_header();
    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $taxonomy_name = 'category';
    $taxonomy_id = get_queried_object()->term_id;
    $taxonomy = get_term($taxonomy_id, $taxonomy_name);
    $term1 = get_term_by( 'id', $taxonomy_id, $taxonomy_name );
    $term_name = $term1->name;
    $term_slug = $term1->slug;
    get_template_part( 'inc/page-banner' ); ?>
    <main id="main">
        <section class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <?php the_field('page_content',31);
                        $product_categories = get_terms( 'category',array( 'hide_empty' => false,'exclude'      => array(1)) );
                        foreach($product_categories as $category){
                            $cat_id = $category->term_id;
                            $link = get_term_link($cat_id);
                            if($cat_id == $taxonomy_id || ($cat_id == '5' && $id == '31')){
                                $class = 'btn btn-primary btn-lg mb-3 mb-md-0 mx-md-2 d-block d-md-inline-block';
                            } else {
                                $class = 'btn btn-outline-dark btn-lg mx-md-2 d-block d-md-inline-block';
                            } ?>
                            <a href="<?php echo $link; ?>" class="<?php echo $class; ?>"><?php echo $category->name; ?></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="row services-block">
                    <?php $args = array(
                        'post_type' => 'services',
                        'order' => 'ASC',
                        'posts_per_page'=>-1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'slug',
                                'terms' => $term_slug
                            )
                        )
                    );
                    $the_query = new WP_Query( $args );
                    if ( $the_query->have_posts() ):
                        while ( $the_query->have_posts() ):
                            $the_query->the_post(); ?>
                            <div class="col-md-6 col-lg-4 post">
                                <div class="inner">
                                    <?php $image_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
                                    <img src="<?php echo $image_url; ?>" class="img-fluid" alt="Image Description">
                                    <div class="text">
                                        <h3><?php the_title(); ?></h3>
                                        <p><?php echo wp_trim_words( get_the_content(), 13, '...' ); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="readmore btn btn-primary">Read More</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        else:
                            echo '<h3 class="w-100 text-center">No Service Found!</h3>';
                    endif; ?>
                </div>
            </div>
        </section>
    </main>

<?php get_footer(); ?>
