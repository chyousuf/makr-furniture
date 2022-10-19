<?php
/**
 * Cart item data (when outputting non-flat)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-item-data.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version 	2.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<dl class="variation">
	<?php
    //print_r($item_data);
    foreach ( $item_data as $data ) :
        //if (in_array("Special Requests", $item_data)){
        //    echo 'true';
        //}
        //$item_data = strtolower($item_data);
        $string1 = strtolower($data['key']);
        $string2 = strtolower($data['display']);
        $key = str_replace(" ", "-", $string1);
        $display = str_replace(" ", "-", $string2);
        if($key != $display){ ?>
            <dt class="<?php echo sanitize_html_class( 'variation-' . $data['key'] ); ?>"><?php echo wp_kses_post( $data['key'] ); ?>:</dt>
            <dd class="<?php echo sanitize_html_class( 'variation-' . $data['key'] ); ?>"><?php echo wp_kses_post( wpautop( $data['display'] ) ); ?></dd>
        <?php }
    endforeach; ?>
</dl>
