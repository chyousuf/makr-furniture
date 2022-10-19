<?php

get_header();
//get_template_part( 'inc/page-banner' );
$current_term = get_queried_object();
$current_term_id = $current_term->term_id;
$current_term_slug = $current_term->slug;
$parent_term = get_term( $current_term->parent, 'product_cat' );
$parent_term_id = $parent_term->term_id;
if(!empty($parent_term_id)){
    $current_term = $parent_term;
    //session_start();
    $_SESSION['parentcatid'] = $parent_term_id;
} else {
    $current_term = get_queried_object();
}
if(empty($parent_term_id)){
    $_SESSION['parentcatid'] = $current_term_id;
}
if($current_term_id == '508'){
    $_SESSION['parentcatid'] = '508';
}
if($current_term_id == '505'){
    $_SESSION['parentcatid'] = '505';
}
$current_term_name = $current_term->name;
$term = get_queried_object();
$term_id = $term->term_id;
$term_name = $term->name;
$image_link = get_field('category_banner',$term->taxonomy.'_'.$term_id);
if(empty($image_link)){
    $parent_term_id = $term->parent;
    $image_link = get_field('category_banner',$term->taxonomy.'_'.$parent_term_id);
}
$parent_cat_description = get_field('category_description',$current_term);
$child_cat_description = get_field('category_description',$term);
if(!empty($child_cat_description)){
    $cat_description = $child_cat_description;
} else {
    $cat_description = $parent_cat_description;
} ?>
<div class="banner product-banner">
    <img src="<?php echo $image_link; ?>" alt="Banner IMage Here">
    <div class="caption container">
        <!-- <strong class="subtitle"><?php echo $current_term_name; ?></strong> -->
        <!-- <h1>Our Products</h1> -->
        <h1><?php echo $current_term_name; ?></h1>
    </div>
</div>
<main id="main">
    <div class="block pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3 order-2 order-md-1">
                    <?php get_template_part( 'inc/product-sidebar' ); ?>
                </div>
                <div class="col-12 col-md-8 col-lg-9 order-1 order-md-2">
                    <h3><?php echo $term_name; ?></h3>
                    <p><?php //echo category_description( $current_term_id ); ?></p>
                    <?php echo $cat_description; ?>
                    <?php
                        $children = get_terms( 'product_cat', array(
                            'parent'    => $current_term_id,
                            'hide_empty' => false,
                            // 'exclude' => array(509)
                        ) );
                        if(!empty($children)){ //Showing Child Categories ?>
                            <div class="row products products-columns mb-3">
                                <?php foreach($children as $child){
                                    $child_id = $child->term_id;
                                    $child_name = $child->name;
                                    $child_slug = $child->slug;
                                    $child_link = get_term_link($child);
                                    $thumbnail_id = get_term_meta( $child->term_id, 'thumbnail_id', true );
                                    $thumbnail_url = wp_get_attachment_url( $thumbnail_id );
                                    if(empty($thumbnail_url)){$thumbnail_url = get_template_directory_uri().'/images/thumbnail.png';} ?>
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <div class="product">
                                            <img src="<?php echo $thumbnail_url; ?>" class="img-fluid border" alt="">
                                        </div>
                                        <div class="text">
                                            <span class="title txt"><?php echo $child_name; ?></span>
                                            <a href="<?php echo $child_link; ?>" class="btn btn-sm btn-primary">View Details</a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } else { //Showing Products ?>
                            <div class="row products mb-3">
                                <?php global $wp_query;
                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                $args = array(
                                    'posts_per_page' => 12,
                                    'tax_query' => array(
                                        'relation' => 'AND',
                                        array(
                                            'taxonomy' => 'product_cat',
                                            'field' => 'slug',
                                            'terms' => $current_term_slug
                                        )
                                    ),
                                    'post_type' => 'product',
                                    'paged' => $paged
                                );
                                $products = new WP_Query( $args );
                                if ( $products->have_posts() ) :
                                    while($products->have_posts()) : $products->the_post();
                                        global $product;
                                        $Product_id = $product->get_id();
                                        $product_thumb = get_the_post_thumbnail_url();
                                        if(empty($product_thumb)){$product_thumb = get_template_directory_uri().'/images/pthumbnail.png';}
                                        $product_name = get_the_title(); ?>
                                        <div class="col-lg-4 col-sm-6 col-12">
                                            <div class="product">
                                                <img src="<?php echo $product_thumb; ?>" class="img-fluid pro-image border" alt="">
                                            </div>
                                            <div class="text">
                                                <span class="title"><?php echo $product_name; ?></span>
                                                <span class="txt"></span>
                                                <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary">View Details</a>
                                            </div>
                                        </div>
                                    <?php endwhile; wp_reset_query();
                                    $big = 999999999;
                                    echo '<div class="col-md-12 plist-pagination">';
                                    echo paginate_links( array(
                                        'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                                        'format' => '?paged=%#%',
                                        'current' => max( 1, get_query_var('paged') ),
                                        'total' => $products->max_num_pages
                                    ) );
                                    echo '</div>';
                                else:
                                    echo '<div class="col-lg-12"><strong>no product found in this category!</strong></div>';

                                endif; ?>
                            </div>
                        <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
