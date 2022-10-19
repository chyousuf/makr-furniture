<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div class="woocommerce-message d-none" id="quote-message" role="alert"><a href="https://www.makr-furniture.com/cart" tabindex="1" class="button wc-forward">View Quote</a> “test product” has been added to your cart. </div>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

	<div class="entry-summary">
		<h2><?php the_title(); ?></h2>
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="tab1-tab" data-toggle="pill" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Details</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="tab2-tab" data-toggle="pill" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Materials</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="tab3-tab" data-toggle="pill" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Documents</a>
			</li>
		</ul>
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
				<?php
				$product_content = get_the_content();
				if (!empty($product_content)) {
					echo '<p>' . $product_content . '</p>';
				} else {
					echo 'No details found!';
				}
				$terms = get_the_terms(get_the_ID(), 'product_cat');
				//print("<pre>");print_r($terms);print("</pre>");
				foreach ($terms as $term) {
					$product_cat_id = $term->term_id;
					$parent_term = get_term($term->parent, 'product_cat');
					$parent_term_id = $parent_term->term_id;
					if ($product_cat_id == '508') {
						$parent_term_id = '508';
					}
					if ($product_cat_id == '505') {
						$parent_term_id = '505';
					}
					if (empty($parent_term_id)) {
						$parent_term_id = $product_cat_id;
					}
					if (!empty($parent_term_id)) {

						if (have_rows('product_sheet', 27)) :

							while (have_rows('product_sheet', 27)) : the_row();
								$assign_category = get_sub_field('assign_category');
								$file_name = get_sub_field('file_name');
								$attachment_id = get_sub_field('file');
								$attachment_url = wp_get_attachment_url($attachment_id);
								$pathinfo = pathinfo(get_attached_file($attachment_id));
								$filetype = $pathinfo['extension'];

								if ($assign_category == $parent_term_id) {
									$attachment_url2 = $attachment_url;
									//echo '<input class="aaaa" type="hidden" value="' . $file_name . '"/>';
									$pdffile_name = $file_name;
								} ?>

						<?php endwhile;
						endif; ?>


				<?php	} else {
						//echo $product_cat_id;
					}
				}
				?>
				<p class="list-price-pdf">For full pricing details see
					<a href="<?php if (!empty($attachment_url2)) {
									echo $attachment_url2;
								} else {
									echo '#';
								} ?>" target="_blank" rel="noopener"><?php echo '<span>' . $pdffile_name . '</span>.PDF'; ?></a>
				</p>
			</div>
			<div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
				<?php if (have_rows('material_information', 27)) :  ?>
					<ul>
						<?php while (have_rows('material_information', 27)) : the_row();
							$file_name = get_sub_field('file_name', 27);
							$attachment_id = get_sub_field('file', 27);
							$attachment_url = wp_get_attachment_url($attachment_id);
							$pathinfo = pathinfo(get_attached_file($attachment_id));
							$filetype = $pathinfo['extension'];
							if ($product_cat_id != 448 && $file_name == 'MTM Base Assembly Instructions') {
								//  echo $file_name;
							} else { ?>
								<li><a href="<?php if (!empty($attachment_url)) {
													echo $attachment_url;
												} else {
													echo '#';
												} ?>" target="_blank"><?php echo $file_name . '.pdf'; ?></a></li>
						<?php }
						endwhile; ?>
					</ul>
				<?php endif; ?>
			</div>
			<div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
				<?php if (have_rows('downloads', 27)) : ?>
					<ul>
						<?php while (have_rows('downloads', 27)) : the_row();
							$attachment_id = get_sub_field('file', 27);
							$attachment_url = wp_get_attachment_url($attachment_id);
							$pathinfo = pathinfo(get_attached_file($attachment_id));
							$filetype = $pathinfo['extension'];
						?>
							<li><a href="<?php echo $attachment_url; ?>" target="_blank"><?php echo get_sub_field('file_name', 27) . '.' . $filetype; ?></a></li>
						<?php endwhile; ?>
					</ul>
				<?php else :
					echo 'No materials found!';
				endif; ?>
			</div>
		</div>
		<?php
		//echo $product_content = get_the_content();
		// if(!empty($product_content)){
		// 	echo '<p>'.$product_content.'</p>';
		// } else {
		// 	$terms = get_the_terms( get_the_ID(), 'product_cat' );
		// 	foreach ( $terms as $term ) {
		//    		$product_cat_id = $term->term_id;
		//    		$parent_term = get_term( $term->parent, 'product_cat' );
		// 		$parent_term_id = $parent_term->term_id;
		// 		if(!empty($parent_term_id)){
		//    			the_field('category_description',$parent_term);
		//    		} else {
		//    			the_field('category_description',$term);
		//    		}
		//    		if(!empty($product_cat_id)){break;}
		// 	}
		// }
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 **/
		do_action('woocommerce_single_product_summary');
		?>
	</div>
</div>

<?php do_action('woocommerce_after_single_product'); ?>