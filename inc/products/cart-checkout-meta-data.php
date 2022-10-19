<?php
/******************************************************************************
            Display custom item data in the cart and Checkout Pages
*******************************************************************************/
add_filter('woocommerce_get_item_data', 'display_custom_cart_item_data', 10, 2 );
function display_custom_cart_item_data( $cart_item_data, $cart_item ) {
  //print("<pre>");print_r($cart_item);print("</pre>");
  global $wpdb;
  $attribute_taxonomies = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies WHERE attribute_name != '' ORDER BY attribute_name ASC;" );
  set_transient( 'wc_attribute_taxonomies', $attribute_taxonomies );
  $attribute_taxonomies = array_filter( $attribute_taxonomies  ) ;
  $product_attributes = get_field('product_attributes');
  if( $product_attributes ):
    foreach( $product_attributes as $pattributes ):
      if($pattributes == 'Add Pedestal'){
        //$attr_add_pedestal_label = $attribute_taxonomies[0]->attribute_label;
      }
      if($pattributes == 'Conference Table Bases'){
        $attr_bases_label = $attribute_taxonomies[1]->attribute_label;
      }
      if($pattributes == 'Door Pulls Type'){
        //$attr_door_pulls_type_label = $attribute_taxonomies[2]->attribute_label;
      }
      if($pattributes == 'Fabric'){
        //$attr_fabric_label = $attribute_taxonomies[3]->attribute_label;
      }
      if($pattributes == 'Finish'){
        //$attr_finish_label = $attribute_taxonomies[4]->attribute_label;
      }
      if($pattributes == 'Grommet Color'){
        //$attr_grommet_color_label = $attribute_taxonomies[5]->attribute_label;
      }
      if($pattributes == 'Grommet Orientation'){
        //$attr_grommet_orientation_label = $attribute_taxonomies[6]->attribute_label;
      }
      if($pattributes == 'Orientation'){
        //$attr_orientation_label = $attribute_taxonomies[7]->attribute_label;
      }
      if($pattributes == 'Pedestal Orientation'){
        //$attr_pedestal_orientation_label = $attribute_taxonomies[8]->attribute_label;
      }
      if($pattributes == 'Pedestal Pulls Type'){
        //$attr_pedestal_pulls_type_label = $attribute_taxonomies[9]->attribute_label;
      }
      if($pattributes == 'Pedestal Type'){
        //$attr_pedestal_type_label = $attribute_taxonomies[10]->attribute_label;
      }
      if($pattributes == 'Shelves Orientation'){
        //$attr_shelves_label = $attribute_taxonomies[11]->attribute_label;
      }
    endforeach;
  endif;
  $current_user = wp_get_current_user();
  $current_user_id = $current_user->ID;
  $user = get_userdata($current_user_id);
  $user_roles = $user->roles;
  if(empty($user_roles)){
    $user_roles = array(
      '0' => 'customer',
    );
  }
  /**************************************
            LOCK ADDON VALUE
  **************************************/
  $wccpf_lock = $cart_item['wccpf_pricing_applied_per_lock']['amount'];
  $wccpf_lock_option = $cart_item['wccpf_lock_option']['fname'];
  /**************************************
        DOUBLE PEDESTAL ADDON VALUE
  **************************************/
  $wccpf_pedestal = $cart_item['wccpf_pricing_applied_double_pedestal']['amount'];
  $wccpf_double_pedestal_option = $cart_item['wccpf_double_pedestal_option']['fname'];
  /**************************************
            COAT HOOKS VALUE
  **************************************/
  $wccpf_coat_hooks = $cart_item['wccpf_pricing_applied_per_coat_hook']['amount'];
  $wccpf_coat_hooks_option = $cart_item['wccpf_coat_hooks']['fname'];
  /**************************************
              COAT ROD VALUE
  **************************************/
  $wccpf_coat_rod = $cart_item['wccpf_pricing_applied_per_closet_rod']['amount'];
  $wccpf_coat_rod_option = $cart_item['wccpf_closet_rod']['fname'];
  /************************************************
      CART ITEM PRICE VALUE OF PEDESTAL AND LOCKS
  ************************************************/
  if(!empty($wccpf_pedestal) && !empty($wccpf_lock)){
    $c_value1 = $cart_item['no_of_pulls_pedestal']['value'] * 22;
    $c_value2 = ($cart_item['no_of_lock_pedestal']['value'] * $wccpf_lock) - $wccpf_lock;
  } else if(empty($wccpf_pedestal) && !empty($wccpf_lock)){
    $c_value1 = $cart_item['no_of_pulls']['value'] * 22;
    $c_value2 = ($cart_item['no_of_lock']['value'] * $wccpf_lock) - $wccpf_lock;
  } else if(!empty($wccpf_pedestal) && empty($wccpf_lock)){
    $c_value1 = $cart_item['no_of_pulls_pedestal']['value'] * 22;
    $c_value2 = '0';
  } else if(empty($wccpf_pedestal) && empty($wccpf_lock)){
    $c_value1 = $cart_item['no_of_pulls']['value'] * 22;
    $c_value2 = '0';
  }
  /************************************************
    CART ITEM PRICE VALUE COAT HOOKS AND COAT ROD
  ************************************************/
  if(!empty($wccpf_coat_hooks)){
    $coat_hooks_price = $cart_item['no_of_coat_hooks']['value'] * $wccpf_coat_hooks;
  } else {$coat_hooks_price = '0';}
  if(!empty($wccpf_coat_rod)){
    $coat_rod_price = $cart_item['no_of_coat_rod']['value'] * $wccpf_coat_rod;
  } else {$coat_rod_price = '0';}
  /************************************************
                    BASES COST
  ************************************************/
  // $bases_cost = '500';
  if($cart_item['bases_id']['value'] == '458'){
    $option_bases_value = 'full_cylinder_bases';
    $option_bases_quantity = 'full_cylinder_bases_table_width';
  } else if($cart_item['bases_id']['value'] == '457'){
    $option_bases_value = 'half_cylinder_bases';
    $option_bases_quantity = 'half_cylinder_bases_table_width';
  } else if($cart_item['bases_id']['value'] == '456'){
    $option_bases_value = 'rectangular_bases';
    $option_bases_quantity = 'rectangular_bases_table_width';
  }
  $dimension_split1 = explode('x', $cart_item['dimension']['value'], 2)[1];
  // echo $dimension_split = strtok($dimension_split1, 'x');
  $dimension_split = strtok($cart_item['dimension']['value'], 'x');
  $dimension_split2 = strtok($dimension_split1, 'x');
  $base_count = 1;
  //BASE PRICE
  if( have_rows($option_bases_value,'options') ):
    while ( have_rows($option_bases_value,'options') ) : the_row();
      //echo strtok($cart_item['dimension']['value'], 'x');
      $table_depth = get_sub_field('table_depth','options');
      if ( strstr( $table_depth, '-' ) ) {
        $min = strtok($table_depth, '-');
        $max = explode('-', $table_depth, 2)[1];
        if($base_count == 1 && $dimension_split < $min){
          $table_depth_price = get_sub_field('price','options');
        } else {
          if($dimension_split >= $min && $dimension_split <= $max){
            $table_depth_price = get_sub_field('price','options');
          }
        }
      } else {
        if($dimension_split >= $table_depth){
          $table_depth_price = get_sub_field('price','options');
        }
      }
      $base_count++;
    endwhile;
  endif;
  //echo $table_depth_price;
  //BASE QUANTITY
  $base_count2 = 1;
  if( have_rows($option_bases_quantity,'options') ):
    while ( have_rows($option_bases_quantity,'options') ) : the_row();
      $table_width = get_sub_field('table_width','options');
      if ( strstr( $table_width, '-' ) ) {
        $min2 = strtok($table_width, '-');
        $max2 = explode('-', $table_width, 2)[1];
        if($base_count2 == 1 && $dimension_split2 < $min2){
          $table_width_quantity = get_sub_field('no_of_bases','options');
        } else {
          if($dimension_split2 >= $min2 && $dimension_split2 <= $max2){
            $table_width_quantity = get_sub_field('no_of_bases','options');
          }
        }
      } else {
        if($dimension_split2 >= $table_width){
          $table_width_quantity = get_sub_field('no_of_bases','options');
        }
      }
      $base_count2++;
    endwhile;
  endif;
  /************************************************
                  DIMENSION VALUE
  ************************************************/
  if (isset($cart_item['dimension']['value']) && !empty($cart_item['dimension']['value'])){
    $cart_item_data[] = array(
      'name' => __( 'Dimension', 'woocommerce' ),
      'value' => $cart_item['dimension']['value'],
    );
  }
  /************************************************
                PRODUCT BASE PRICE
  ************************************************/
  if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
    if (isset($cart_item['product_price']['value'] ) && !empty($cart_item['product_price']['value'])){
      $cart_item_data[] = array(
        'name' => __( 'Product Base Price', 'woocommerce' ),
        'value' => '$'.$cart_item['product_price']['value'],
      );
    }
  }
  /************************************************
                      SKU VALUE
  ************************************************/
  if (isset($cart_item['sku']['value']) && !empty($cart_item['sku']['value'])){
    $cart_item_data[] = array(
      'name' => __( 'SKU', 'woocommerce' ),
      'value' => $cart_item['sku']['value'],
    );
  }
  /************************************************
                DOOR PULL TYPE VALUE
  ************************************************/
  if (isset($cart_item['door_pulls_type']['value']) && !empty($cart_item['door_pulls_type']['value'])){
    if(strstr( $cart_item['door_pulls_type']['value'], '*' )){
      $_SESSION['premium_door_label'] = ' (Premium)';
    } else {
      $_SESSION['premium_door_label'] = '';
    }
    $cart_item_door_pulls_type = strtok($cart_item['door_pulls_type']['value'], '*');
    $cart_item_data[] = array(
      'name' => __( $attribute_taxonomies[2]->attribute_label, 'woocommerce' ),
      'value' => $cart_item_door_pulls_type.$_SESSION['premium_door_label'],
    );
  }
  /************************************************
            DOOR PULL TYPE QUANTITY & VALUE
  ************************************************/
  // if ((isset($cart_item['door_pulls_type']['value'] ) && !empty($cart_item['door_pulls_type']['value']))){
  //   if(strstr( $cart_item['door_pulls_type']['value'], '*' )){
  //     if(!empty($wccpf_pedestal) || !empty($wccpf_double_pedestal_option)){
  //       $cart_item_data[] = array(
  //         'name' => __( '# of Pulls', 'woocommerce' ),
  //         'value' => $cart_item['no_of_pulls_pedestal']['value'],
  //       );
  //     }
  //     if(empty($wccpf_pedestal) && empty($wccpf_double_pedestal_option) && $c_value1 != '0'){
  //       $cart_item_data[] = array(
  //         'name' => __( '# of Pulls', 'woocommerce' ),
  //         'value' => $cart_item['no_of_pulls']['value'],
  //       );
  //     }
  //     if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
  //       if($c_value1 != '0'){
  //         $cart_item_data[] = array(
  //           'name' => __( 'Pulls Cost', 'woocommerce' ),
  //           'value' => '$'.$c_value1,
  //         );
  //       }
  //     }
  //   }
  // }
  /***DOOR PULLS TYPE CART & CHECKOUT PAGE VALUE***/
  // if (isset($cart_item['door_pulls_quantity']['value']) && !empty($cart_item['door_pulls_quantity']['value'])){
  //   $cart_item_data[] = array(
  //     'name' => __( $attribute_taxonomies[1]->attribute_label.' Quantity', 'woocommerce' ),
  //     'value' => $cart_item['door_pulls_quantity']['value'],
  //   );
  // }
  /***DOOR PULLS TYPE CART & CHECKOUT PAGE VALUE***/
  // if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
  //   if (isset($cart_item['door_pulls_premium_price']['value']) && !empty($cart_item['door_pulls_premium_price']['value'])){
  //     $cart_item_data[] = array(
  //       'name' => __( $attribute_taxonomies[1]->attribute_label.' Cost', 'woocommerce' ),
  //       'value' => '$'.$cart_item['door_pulls_premium_price']['value'],
  //     );
  //   }
  // }
  /************************************************
                      FABRIC VALUE
  ************************************************/
  if (isset($cart_item['fabric']['value']) && !empty($cart_item['fabric']['value'])){
    $cart_item_data[] = array(
      'name' => __( $attribute_taxonomies[3]->attribute_label, 'woocommerce' ),
      'value' => $cart_item['fabric']['value'],
    );
  }
  /************************************************
                      FINISH VALUE
  ************************************************/
  if (isset($cart_item['finish']['value']) && !empty($cart_item['finish']['value'])){
    if(strstr( $cart_item['finish']['value'], '*' )){
      $_SESSION['premium_label'] = ' (Premium)';
    } else {
      $_SESSION['premium_label'] = '';
    }
    $cart_item_finish = strtok($cart_item['finish']['value'], '*');
    $cart_item_data[] = array(
      'name' => __( $attribute_taxonomies[4]->attribute_label, 'woocommerce' ),
      'value' => $cart_item_finish.$_SESSION['premium_label'],
    );
  }
  /************************************************
                PREMIUM FINISH VALUE
  ************************************************/
  if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
    if (isset($cart_item['finish_premium_price']['value']) && !empty($cart_item['finish_premium_price']['value'])){
      $cart_item_data[] = array(
        'name' => __( 'Premium Finish', 'woocommerce' ),
        'value' => $cart_item['finish_premium_price']['value'].'% increase for premium finish included in price',
      );
    }
  }
  /************************************************
                    Bases VALUE
  ************************************************/
  if (isset($cart_item['bases']['value']) && !empty($cart_item['bases']['value'])){
    $cart_item_data[] = array(
      'name' => __( $attribute_taxonomies[1]->attribute_label, 'woocommerce' ),
      'value' => $cart_item['bases']['value'],
    );
  }
  if (!empty($table_width_quantity) && $table_width_quantity != '0'){
    $cart_item_data[] = array(
      'name' => __( '# of '.$attribute_taxonomies[1]->attribute_label, 'woocommerce' ),
      'value' => $table_width_quantity,
    );
  }
  if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
    if(!empty($table_depth_price) && $table_depth_price != '0'){
      $cart_item_data[] = array(
        'name' => __( $attribute_taxonomies[1]->attribute_label.' Cost', 'woocommerce' ),
        'value' => '$'.$table_depth_price,
      );
    }
  }
  /************************************************
                  GROMMET COLOR VALUE
  ************************************************/
  if (isset($cart_item['grommet_color']['value']) && !empty($cart_item['grommet_color']['value'])){
    $cart_item_data[] = array(
      'name' => __( $attribute_taxonomies[5]->attribute_label, 'woocommerce' ),
      'value' => $cart_item['grommet_color']['value'],
    );
  }
  /************************************************
                  GROMMET COLOR PRICE VALUE
  ************************************************/
  if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
    if (isset($cart_item['grommet_color_price']['value']) && !empty($cart_item['grommet_color_price']['value'])){
      $cart_item_data[] = array(
        'name' => __( 'Grommet Color Cost', 'woocommerce' ),
        'value' => '$'.$cart_item['grommet_color_price']['value'],
      );
    }
  }
  /************************************************
              GROMMET ORIENTATION VALUE
  ************************************************/
  if (isset($cart_item['grommet_orientation']['value'] ) && !empty($cart_item['grommet_orientation']['value'])){
    $cart_item_data[] = array(
      'name' => __( $attribute_taxonomies[6]->attribute_label, 'woocommerce' ),
      'value' => $cart_item['grommet_orientation']['value'],
    );
  }
  /************************************************
                  ORIENTATION VALUE
  ************************************************/
  if (isset($cart_item['orientation']['value'] ) && !empty($cart_item['orientation']['value'])){
    $cart_item_data[] = array(
      'name' => __( $attribute_taxonomies[7]->attribute_label, 'woocommerce' ),
      'value' => $cart_item['orientation']['value'],
    );
  }
  /************************************************
              PEDESTAL ORIENTATION  VALUE
  ************************************************/
  if (isset($cart_item['pedestal_orientation']['value'] ) && !empty($cart_item['pedestal_orientation']['value'])){
    $cart_item_data[] = array(
      'name' => __( $attribute_taxonomies[8]->attribute_label, 'woocommerce' ),
      'value' => $cart_item['pedestal_orientation']['value'],
    );
  }
  /************************************************
              PEDESTAL PULLS TYPE  VALUE
  ************************************************/
  if (isset($cart_item['pedestal_pulls_type']['value'] ) && !empty($cart_item['pedestal_pulls_type']['value'])){
    if(strstr( $cart_item['pedestal_pulls_type']['value'], '*' )){
      $_SESSION['premium_pulls_label'] = ' (Premium)';
    } else {
      $_SESSION['premium_pulls_label'] = '';
    }
    $cart_pedestal_pulls_type = strtok($cart_item['pedestal_pulls_type']['value'], '*');
    $cart_item_data[] = array(
      'name' => __( $attribute_taxonomies[9]->attribute_label, 'woocommerce' ),
      'value' => $cart_pedestal_pulls_type.$_SESSION['premium_pulls_label'],
    );
  }
  if ((isset($cart_item['pedestal_pulls_type']['value'] ) && !empty($cart_item['pedestal_pulls_type']['value']))){
    if(strstr( $cart_item['pedestal_pulls_type']['value'], '*' )){
      if(!empty($wccpf_pedestal) || !empty($wccpf_double_pedestal_option)){
        $cart_item_data[] = array(
          'name' => __( '# of Pedestal Pulls', 'woocommerce' ),
          'value' => $cart_item['no_of_pulls_pedestal']['value'],
        );
      }
      // if(empty($wccpf_pedestal) && empty($wccpf_double_pedestal_option) && $c_value1 != '0'){
      //   $cart_item_data[] = array(
      //     'name' => __( '# of Pedestal Pulls', 'woocommerce' ),
      //     'value' => $cart_item['no_of_pulls']['value'],
      //   );
      // }
      // if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
      //   if($c_value1 != '0'){
      //     $cart_item_data[] = array(
      //       'name' => __( 'Pedestal Pulls Cost', 'woocommerce' ),
      //       'value' => '$'.$c_value1,
      //     );
      //   }
      // }
    }
  }
  /***PEDESTAL PULLS TYPE Quantity CART & CHECKOUT PAGE VALUE***/
  // if (isset($cart_item['pulls_quantity']['value'] ) && !empty($cart_item['pulls_quantity']['value'])){
  //   $cart_item_data[] = array(
  //     'name' => __( 'Premium Pulls Quantity', 'woocommerce' ),
  //     'value' => $cart_item['pulls_quantity']['value'],
  //   );
  // }
  /***PEDESTAL PULLS TYPE PRICE CART & CHECKOUT PAGE VALUE***/
  // if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
  //   if (isset($cart_item['pulls_premium_price']['value'] ) && !empty($cart_item['pulls_premium_price']['value'])){
  //     $cart_item_data[] = array(
  //       'name' => __( 'Premium Pulls Cost', 'woocommerce' ),
  //       'value' => '$'.$cart_item['pulls_premium_price']['value'],
  //     );
  //   }
  // }
  /************************************************
                  ADD PEDESTAL VALUE
  ************************************************/
  if (isset($cart_item['add_pedestal']['value']) && !empty($cart_item['add_pedestal']['value'])){
    $cart_item_data[] = array(
      'name' => __( $attribute_taxonomies[0]->attribute_label, 'woocommerce' ),
      'value' => $cart_item['add_pedestal']['value'],
    );
  }
  /************************************************
                PEDESTAL TYPE  VALUE
  ************************************************/
  if (isset($cart_item['pedestal_type']['value'] ) && !empty($cart_item['pedestal_type']['value'])){
    $cart_item_data[] = array(
      'name' => __( $attribute_taxonomies[10]->attribute_label, 'woocommerce' ),
      'value' => $cart_item['pedestal_type']['value'],
    );
  }
  /************************************************
          PEDESTAL TYPE Quantity VALUE
  ************************************************/
  if (isset($cart_item['pedestal_quantity']['value'] ) && !empty($cart_item['pedestal_quantity']['value'])){
    $cart_item_data[] = array(
      'name' => __( 'Pedestal Quantity', 'woocommerce' ),
      'value' => $cart_item['pedestal_quantity']['value'],
    );
  }
  /************************************************
          PEDESTAL PULLS TYPE PRICE VALUE
  ************************************************/
  if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
    if (isset($cart_item['pedestal_premium_price']['value'] ) && !empty($cart_item['pedestal_premium_price']['value'])){
      $cart_item_data[] = array(
        'name' => __( 'Pedestal Cost', 'woocommerce' ),
        'value' => '$'.$cart_item['pedestal_premium_price']['value'],
      );
    }
  }
  /************************************************
                SPECIFY SHELVES VALUE
  ************************************************/
  if (isset($cart_item['specify_shelves']['value'] ) && !empty($cart_item['specify_shelves']['value'])){
    $cart_item_data[] = array(
      'name' => __( $attribute_taxonomies[11]->attribute_label, 'woocommerce' ),
      'value' => $cart_item['specify_shelves']['value'],
    );
  }
  /************************************************
          PDESTAL PULLS LOCKS QUANTITY VALUE
  ************************************************/
  if((!empty($wccpf_pedestal) && !empty($wccpf_lock)) || (!empty($wccpf_double_pedestal_option) && !empty($wccpf_lock_option))){
    if(!empty($cart_item['no_of_lock_pedestal']['value'])){
      $cart_item_data[] = array(
        'name' => __( '# of Locks', 'woocommerce' ),
        'value' => $cart_item['no_of_lock_pedestal']['value'],
      );
    } else {
      $cart_item_data[] = array(
        'name' => __( '# of Locks', 'woocommerce' ),
        'value' => '1',
      );
    }
  }
  /************************************************
          PULLS TYPE LOCKS QUANTITY VALUE
  ************************************************/
  //if(empty($wccpf_pedestal) && !empty($wccpf_lock)){
  if((empty($wccpf_pedestal) && !empty($wccpf_lock)) || (empty($wccpf_double_pedestal_option) && !empty($wccpf_lock_option))){
    if(!empty($cart_item['no_of_lock']['value'])){
      $cart_item_data[] = array(
        'name' => __( '# of Locks', 'woocommerce' ),
        'value' => $cart_item['no_of_lock']['value'],
      );
    } else {
      $cart_item_data[] = array(
        'name' => __( '# of Locks', 'woocommerce' ),
        'value' => '1',
      );
    }
  }
  /************************************************
            COAT HOOKS QUANTITY VALUE
  ************************************************/
  if(!empty($wccpf_coat_hooks)){
    if(!empty($cart_item['no_of_coat_hooks']['value'])){
      $cart_item_data[] = array(
        'name' => __( '# of Coat Hooks', 'woocommerce' ),
        'value' => $cart_item['no_of_coat_hooks']['value'],
      );
    } else {
      $cart_item_data[] = array(
        'name' => __( '# of Coat Hooks', 'woocommerce' ),
        'value' => '1',
      );
    }
  }
  /************************************************
          COAT CLOSET ROD QUANTITY VALUE
  ************************************************/
  if(!empty($wccpf_coat_rod)){
    if(!empty($cart_item['no_of_coat_rod']['value'])){
      $cart_item_data[] = array(
        'name' => __( '# of Closet Rod', 'woocommerce' ),
        'value' => $cart_item['no_of_coat_rod']['value'],
      );
    } else {
      $cart_item_data[] = array(
        'name' => __( '# of Closet Rod', 'woocommerce' ),
        'value' => '1',
      );
    }
  }
  /************************************************
         CUSTOM ADDONS OPTIONS META VALUES
  ************************************************/
  $count1 = 0;
  $double_pedestal1_quantity = 0;
  $double_pedestal1_price = 0;
  $lock1_quantity = 0;
  $lock1_price = 0;
  while($count1 < $cart_item['addon_count']['value']){
    if($cart_item['addonslug-'.$count1]['value'] == 'double-pedestal'){
      $double_pedestal1 = $cart_item['addontitle-'.$count1]['value'];
      $double_pedestal1_quantity = $cart_item['addonquantity-'.$count1]['value'];
      $double_pedestal1_price = $cart_item['addonprice-'.$count1]['value'];
    }
    if($cart_item['addonslug-'.$count1]['value'] == 'lock'){
      $lock1 = $cart_item['addontitle-'.$count1]['value'];
      $lock1_quantity = $cart_item['addonquantity-'.$count1]['value'];
      $lock1_price = $cart_item['addonprice-'.$count1]['value'];
    }
    if($cart_item['addonslug-'.$count1]['value'] == 'data-av-cutouts'){
      $data_av = $cart_item['addontitle-'.$count1]['value'];
      $data_av_quantity = $cart_item['addonquantity-'.$count1]['value'];
    }
    if($cart_item['addonslug-'.$count1]['value'] == '2-plug-in-power-2-data-points'){
      $plugin_power_dp = $cart_item['addontitle-'.$count1]['value'];
      $plugin_power_dp_quantity = $cart_item['addonquantity-'.$count1]['value'];
    }
    if($cart_item['addonslug-'.$count1]['value'] == '2-plug-in-power-points'){
      $plugin_power = $cart_item['addontitle-'.$count1]['value'];
      $plugin_power_quantity = $cart_item['addonquantity-'.$count1]['value'];
    }
    if($cart_item['addonslug-'.$count1]['value'] == 'flip-up-doors'){
      $flip_door = $cart_item['addontitle-'.$count1]['value'];
      $flip_door_quantity = $cart_item['addonquantity-'.$count1]['value'];
    }
    if($cart_item['addonslug-'.$count1]['value'] == 'technology-trough'){
      $technology_trough = $cart_item['addontitle-'.$count1]['value'];
      $technology_trough_quantity = $cart_item['addonquantity-'.$count1]['value'];
    }
    if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
      if($cart_item['addonslug-'.$count1]['value'] != 'data-av-cutouts' && $cart_item['addonslug-'.$count1]['value'] != 'technology-trough'){
        if(strstr( $cart_item['addonprice-'.$count1]['value'], '%' )){
          $cart_item_data[] = array(
            'name' => __( $cart_item['addontitle-'.$count1]['value'], 'woocommerce' ),
            'value' => $cart_item['addonprice-'.$count1]['value'].' of Product Base Price',
          );
        } else {
          $cart_item_data[] = array(
            'name' => __( $cart_item['addontitle-'.$count1]['value'], 'woocommerce' ),
            'value' => '$'.$cart_item['addonprice-'.$count1]['value'],
          );
        }
      }
    } else {
      if($cart_item['addonslug-'.$count1]['value'] != 'data-av-cutouts' && $cart_item['addonslug-'.$count1]['value'] != 'technology-trough'){
        $cart_item_data[] = array(
          'name' => __( $cart_item['addontitle-'.$count1]['value'], 'woocommerce' ),
          'value' => 'Yes',
        );
      }
    }
    if($cart_item['addonslug-'.$count1]['value'] != 'lock' && $cart_item['addonslug-'.$count1]['value'] != 'data-av-cutouts' && $cart_item['addonslug-'.$count1]['value'] != 'technology-trough'){
      if($cart_item['addonquantity-'.$count1]['value'] != 'undefined'){
        $cart_item_data[] = array(
          'name' => __( '# of '.$cart_item['addontitle-'.$count1]['value'], 'woocommerce' ),
          'value' => $cart_item['addonquantity-'.$count1]['value'],
        );
      }
    }
    $count1++;
  }
  if(!empty($lock1) && !empty($double_pedestal1)){
    if(!empty($cart_item['no_of_lock_pedestal']['value'])){
      $cart_item_data[] = array(
        'name' => __( '# of '.$lock1, 'woocommerce' ),
        'value' => $cart_item['no_of_lock_pedestal']['value'],
      );
    } else {
      $cart_item_data[] = array(
        'name' => __( '# of '.$lock1, 'woocommerce' ),
        'value' => '1',
      );
    }
  }
  else if(!empty($lock1)){
    if(!empty($cart_item['no_of_lock']['value'])){
      $cart_item_data[] = array(
        'name' => __( '# of '.$lock1, 'woocommerce' ),
        'value' => $cart_item['no_of_lock']['value'],
      );
    } else {
      $cart_item_data[] = array(
        'name' => __( '# of '.$lock1, 'woocommerce' ),
        'value' => '1',
      );
    }
  }
  if(!empty($cart_item['pedestal_pulls_type']['value'])){
    if(strstr( $cart_item['pedestal_pulls_type']['value'], '*' )){
      if(!empty($double_pedestal1)){
        if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
          $cart_item_data[] = array(
            'name' => __( 'Per Pedestal Pull', 'woocommerce' ),
            'value' => '$22',
          );
        }
        $cart_item_data[] = array(
          'name' => __( '# of Pedestal Pulls', 'woocommerce' ),
          'value' => $cart_item['no_of_pulls_pedestal']['value'],
        );
      } else {
         if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
          $cart_item_data[] = array(
            'name' => __( 'Per Pedestal Pull', 'woocommerce' ),
            'value' => '$22',
          );
        }
        $cart_item_data[] = array(
          'name' => __( '# of Pedestal Pulls', 'woocommerce' ),
          'value' => $cart_item['no_of_pulls']['value'],
        );
      }
    }
  }
  if(!empty($cart_item['door_pulls_type']['value'])){
    if(strstr( $cart_item['door_pulls_type']['value'], '*' )){
      if(!empty($double_pedestal1)){
        if(!empty($cart_item['no_of_pulls_pedestal']['value'])){
          if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
            $cart_item_data[] = array(
              'name' => __( 'Per Pull', 'woocommerce' ),
              'value' => '$22',
            );
          }
          $cart_item_data[] = array(
            'name' => __( '# of Pulls', 'woocommerce' ),
            'value' => $cart_item['no_of_pulls_pedestal']['value'],
          );
        }
      } else {
        if(!empty($cart_item['no_of_pulls']['value'])){
          if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
            $cart_item_data[] = array(
              'name' => __( 'Per Pull', 'woocommerce' ),
              'value' => '$22',
            );
          }
          $cart_item_data[] = array(
            'name' => __( '# of Pulls', 'woocommerce' ),
            'value' => $cart_item['no_of_pulls']['value'],
          );
        }
      }
    }
  }
  /************************************************
        SET CONDITION FOR DATA AVA CUTOUTS
  ************************************************/
  if(!empty($data_av) || !empty($plugin_power_dp) || !empty($plugin_power)){
    //echo $plugin_power_dp_quantity;
    $posts = get_posts(
      array(
        'include'   => '42192',
        'post_type' => 'productsoptions',
        'orderby'   => 'post__in',
      )
    );
    foreach($posts as $post){
      $data_av_price = get_field('option_price',$post->ID);
      $data_av_title = $post->post_title;
      if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
        $cart_item_data[] = array(
          'name' => __( $data_av_title, 'woocommerce' ),
          'value' => '$'.$data_av_price,
        );
      } else {
        $cart_item_data[] = array(
          'name' => __( $data_av_title, 'woocommerce' ),
          'value' => 'Yes',
        );
      }
      if(!empty($plugin_power_dp) || !empty($plugin_power)){
        $cart_item_data[] = array(
          'name' => __( '# of '.$data_av_title, 'woocommerce' ),
          'value' => $plugin_power_dp_quantity + $plugin_power_quantity,
        );
      } else {
        $cart_item_data[] = array(
          'name' => __( '# of '.$data_av_title, 'woocommerce' ),
          'value' => $data_av_quantity,
        );
      }
    }
  }
  /************************************************
        SET CONDITION FOR TECHNNOLOGY TROUGH
  ************************************************/
  if(!empty($flip_door) || !empty($technology_trough)){
    $posts = get_posts(
      array(
        'include'   => '42197',
        'post_type' => 'productsoptions',
        'orderby'   => 'post__in',
      )
    );
    foreach($posts as $post){
      $technology_trough_price = get_field('option_price',$post->ID);
      $technology_trough_title = $post->post_title;
      if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
        $cart_item_data[] = array(
          'name' => __( $technology_trough_title, 'woocommerce' ),
          'value' => '$'.$technology_trough_price,
        );
      } else {
        $cart_item_data[] = array(
          'name' => __( $technology_trough_title, 'woocommerce' ),
          'value' => 'Yes',
        );
      }
      if(!empty($flip_door)){
        $cart_item_data[] = array(
          'name' => __( '# of '.$technology_trough_title, 'woocommerce' ),
          'value' => $flip_door_quantity,
        );
      } else {
        $cart_item_data[] = array(
          'name' => __( '# of '.$technology_trough_title, 'woocommerce' ),
          'value' => $technology_trough_quantity,
        );
      }
    }
  }
  return $cart_item_data;
}
?>
