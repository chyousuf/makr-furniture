<?php


add_filter( 'woocommerce_get_price_html', function( $price ) {
  $user = wp_get_current_user();
  $hide_for_roles = array( 'dealer','administrator' );
  if ( is_admin() || in_array( 'dealer', $hide_for_roles, true )) return $price;
  if ( !in_array( 'dealer', $hide_for_roles, true ) && !in_array( 'administrator', $hide_for_roles, true )) {
    // If one of the user roles is in the list of roles to hide for.
    if ( array_intersect( $user->roles, 'customer' ) ) {
      return ''; // Return empty string to hide.
    }
  }
  return $price; // Return original price
} );

add_filter( 'woocommerce_cart_item_price', '__return_false' );


add_filter( 'woocommerce_get_price_html', function( $price ) {
  if ( ! is_user_logged_in() ) return '';
  $user = wp_get_current_user();
  $hide_for_roles = array( 'customer' );
  // If one of the user roles is in the list of roles to hide for.
  if ( array_intersect( $user->roles, $hide_for_roles ) ) {
    return ''; // Return empty string to hide.
  }
  return $price; // Return original price
} );
add_filter( 'woocommerce_cart_item_price', '__return_false' );


// add_action( 'woocommerce_proceed_to_checkout', 'insert_empty_cart_button' );
// function insert_empty_cart_button() {
//     // Echo our Empty Cart button
//     echo '<input type="submit" class="btn btn-primary" name="empty_cart" value="Empty Quote" />';
// }


/*****************************************************************************
                        Add Custom Style to admin Order
******************************************************************************/
add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts() {
  echo '<style>
    #woocommerce-order-items .woocommerce_order_items_wrapper table.woocommerce_order_items table.display_meta{width:100%;margin-top:20px;}
    #woocommerce-order-items .woocommerce_order_items_wrapper table.woocommerce_order_items table.display_meta tr th,#woocommerce-order-items .woocommerce_order_items_wrapper table.woocommerce_order_items table.display_meta tr td{
        width: 50%;
        border: solid 1px #ccc;
        border-top:none !important;
        padding: 5px !important;
    }
    #woocommerce-order-items .woocommerce_order_items_wrapper table.woocommerce_order_items table.display_meta tr:first-child th,#woocommerce-order-items .woocommerce_order_items_wrapper table.woocommerce_order_items table.display_meta tr:first-child td{
        border-top:solid 1px #ccc !important;
  }
  .term-description-wrap{display:none;}
  </style>';
}

add_action( 'wp_enqueue_scripts', 'cortez_enqueue_script' );
function cortez_enqueue_script() {
    wp_enqueue_script( 'cortez_custom_js', get_stylesheet_directory_uri() . '/custom.js', array( 'jQuery' ), '1.0', true );
    wp_localize_script( 'cortez_custom_js', 'clocal', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
    ) );
}


add_action( 'wp_ajax_cortez_get_terms', 'cortez_get_terms' );
add_action( 'wp_ajax_nopriv_cortez_get_terms', 'cortez_get_terms' );
function cortez_get_terms() {
  $data = esc_sql( $_POST );
  if ( ! wp_verify_nonce( $data['nonce'], 'cortez_nonce_security_key' ) ) {
      wp_die( 'Security check' );
  }
  if ( ! isset( $data['term_chosen'] ) || empty( $data['term_chosen'] ) ) {
      wp_die( 'No Term Chosen' );
  }
  $tipos_bicicletas       = 'tipos_bicicletas';
  $modelos_bicicletas     = 'modelos_bicicletas';
  $marcas_bicicletas      = 'marcas_bicicletas';
  $tax_tipos_bicicletas   = get_terms( $tipos_bicicletas, array( 'hide_empty' => false ) );
  $tax_modelos_bicicletas = get_terms( $modelos_bicicletas, array( 'hide_empty' => false ) );
  $tax_marcas_bicicletas  = get_terms( $marcas_bicicletas, array( 'hide_empty' => false ) );

  $json = json_encode( $tax_tipos_bicicletas );
  if ( $data['term_chosen'] == 'bicicleta' ) {
      echo $json;
  }
  wp_die(); //stop function once you've echoed (returned) what you need.
}


get_template_part( 'inc/products/assign-session-value-cart' );

get_template_part( 'inc/products/cart-checkout-meta-data' );

get_template_part( 'inc/products/order-item-meta' );



// add_action( 'woocommerce_email_order_details', 'action_email_order_details', 10, 4 );
//     function action_email_order_details( $order, $sent_to_admin, $plain_text, $email ) {
//      if( $sent_to_admin ): // For admin emails notification
//       $count1 = 0;
//       while($count1 < $values['addon_count']['value']){
//         $item->add_meta_data(
//           __( $values['addontitle-'.$count1]['value'], 'plugin-republic' ),
//           '$'.$values['addonprice-'.$count1]['value'],
//           true
//         );
//         $count1++;
//       }
//      endif;
// }


// add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

// function my_custom_checkout_field_display_admin_order_meta($order){
//     $count1 = 0;
//     while($count1 < $values['addon_count']['value']){
//       $item->add_meta_data(
//         __( $values['addontitle-'.$count1]['value'], 'plugin-republic' ),
//         '$'.$values['addonprice-'.$count1]['value'],
//         true
//       );
//       $count1++;
//     }
//     echo 'testing';
// }

?>
