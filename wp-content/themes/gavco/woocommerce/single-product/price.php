<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) );?> mb-0"><?php
    //echo $product->get_price_html();
    if( have_rows('basic') ):
        while ( have_rows('basic') ) : the_row();
            $price_array[] = get_sub_field('price');
        endwhile;
    endif;
    $min = min($price_array);
    $max = max($price_array);
    //echo '$'.$min.' - $'.$max;
?></p>
<?php //echo $_SESSION['finish_premium_price']; ?>
<span class="sku_wrapper"> <span class="sku code">
    <?php //echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' );
        //echo $product->get_sku();
    ?>
    <!-- <div id="results"></div> -->
</span></span>
