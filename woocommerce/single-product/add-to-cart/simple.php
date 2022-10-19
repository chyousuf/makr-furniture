<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) :
	do_action( 'woocommerce_before_add_to_cart_form' );
    //get_template_part( 'inc/products/products-dropdown-options' ); ?>

    <div class="field-froup">
    	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
            <!-- <h5>Options:</h5> -->
            <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
    		<a href="" class="btn btn-primary d-none" id="cart-load-btn">Add to Quote</a>
            <script type="text/javascript">
                // function SubmitFormData() {
                //     var dimensionvalue = $("#dimension").val();
                //     if(jQuery.type($("#dimension").val()) != 'undefined' && dimensionvalue != 'Dimension'){
                //         $('#add_to_cart_button').removeClass('d-none');
                //     } else {
                //         $('#add_to_cart_button').addClass('d-none');
                //     }
                // }
            </script>
            <button type="submit" id="add_to_cart_button" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="btn btn-primary mt-2 d-none"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
    		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
    	</form>
    </div>

	<?php do_action( 'woocommerce_after_add_to_cart_form' );
endif; ?>
