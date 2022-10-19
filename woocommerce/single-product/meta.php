<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>
    <?php do_action( 'woocommerce_product_meta_start' ); ?>

    <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
        <!-- sku coming from price.php file -->
        <!-- <span class="sku_wrapper"> <span class="sku code"> -->
            <?php //echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' );
                //echo $product->get_sku();
            ?>
            <!-- </span></span> -->
        <?php
            // $args = array(
            //     'post_type'  => 'product_variation',
            //     'meta_query' => array(
            //         array(
            //             'key'   => '_sku',
            //             'value' => 'CP-DS2430',
            //         )
            //     )
            // );
            // // Get the posts for the sku
            // $posts = get_posts( $args);
            // print_r($posts);
        ?>

    <?php endif; ?>
	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
