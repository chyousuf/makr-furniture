<?php
if(is_shop() && !is_product_category()){ //For Shop Page (product page)
	get_header();
	get_template_part( 'inc/page-banner' );
	$pageid = '119'; ?>
	<main id="main">
		<div class="block pb-5">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-4 col-lg-3 order-2 order-md-1">
						<?php get_template_part( 'inc/product-sidebar' ); ?>
					</div>
					<div class="col-12 col-md-8 col-lg-9 order-1 order-md-2">
						<h3><?php echo get_the_title($pageid); ?></h3>
						<p><?php the_field('page_content',$pageid); ?></p>
						<div class="row products products-columns mb-3">
							<?php
					            $orderby = 'name';
					            $order = 'ASC';
					            $hide_empty = false;
					            $cat_args = array(
					                // 'orderby'    => $orderby,
					                // 'order'      => $order,
					                'hide_empty' => $hide_empty,
					                'parent' => 0,
					                'exclude'    => array(17)
					            );
					            $product_categories = get_terms( 'product_cat', $cat_args );
					            if( !empty($product_categories) ){
					                foreach ($product_categories as $key => $category) {
					                	$category_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
                                    	$category_url = wp_get_attachment_url( $category_id );
					              		if(empty($category_url)){$category_url = get_template_directory_uri().'/images/thumbnail.png';} ?>
										<div class="col-lg-4 col-sm-6 col-12">
											<div class="product">
												<img src="<?php echo $category_url; ?>" class="img-fluid cat-image" alt="">
												<div class="caption">
													<span class="name"><?php echo $category->name; ?></span>
													<a href="<?php echo get_term_link($category); ?>">View Details</a>
												</div>
											</div>
										</div>
					                <?php }
					            }
					        ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
<?php get_footer();
} else if(is_product_category()){ //For Category Page
	wc_get_template( 'taxonomy-product_cat.php' );
} ?>
