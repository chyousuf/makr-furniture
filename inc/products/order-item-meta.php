<?php

add_action( 'woocommerce_email_before_order_table', 'bbloomer_add_content_specific_email', 20, 4 );

function bbloomer_add_content_specific_email( $order, $sent_to_admin, $plain_text, $email ) {
    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
    $user = get_userdata($current_user_id);
    $user_roles = $user->roles;
    if(empty($user_roles)){
        $user_roles = array(
            '0' => 'customer',
        );
    }
    if ( in_array( 'customer', $user_roles, true )) {
        if ( $email->id == 'customer_processing_order' ) {

            add_filter( 'woocommerce_order_item_display_meta_key', 'change_order_item_meta_title', 20, 3 );
            function change_order_item_meta_title( $key, $meta, $item ) {
                if ( 'Product Base Price' === $meta->key ) { $key = ''; }
                if ( 'Pulls Cost' === $meta->key ) { $key = ''; }
                if ( 'Grommet Color Cost' === $meta->key ) { $key = ''; }
                if ( 'Pedestal Pulls Cost' === $meta->key ) { $key = ''; }
                if ( 'Pedestal Cost' === $meta->key ) { $key = ''; }
                if ( 'Base Cost' === $meta->key ) { $key = ''; }
                if ( 'Per Pedestal Pull' === $meta->key ) { $key = ''; }
                if ( 'Per Pull' === $meta->key ) { $key = ''; }
                return $key;
            }
            add_filter( 'woocommerce_order_item_display_meta_value', 'change_order_item_meta_value', 20, 3 );
            function change_order_item_meta_value( $value, $meta, $item ) {
                if ( 'Product Base Price' === $meta->key ) { $value = ''; }
                if ( 'Pulls Cost' === $meta->key ) { $value = ''; }
                if ( 'Grommet Color Cost' === $meta->key ) { $value = ''; }
                if ( 'Pedestal Pulls Cost' === $meta->key ) { $value = ''; }
                if ( 'Pedestal Cost' === $meta->key ) { $value = ''; }
                if ( 'Base Cost' === $meta->key ) { $value = ''; }
                if ( 'Per Pedestal Pull' === $meta->key ) { $value = ''; }
                if ( 'Per Pull' === $meta->key ) { $value = ''; }
                $query = new WP_Query( array( 'post_type' => 'productsoptions','posts_per_page' => '-1') );
                if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
                    // $meta_title = 'Double Pedestal';
                    $meta_title = get_the_title();
                    if ( $meta_title === $meta->key ) { $value = 'Yes'; }
                endwhile;
            endif;
            return $value;
            }
        }
    }
}


/*********************************************************************************
              Display custom item data in the Order as meta data
**********************************************************************************/
function plugin_republic_checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {
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
        //$attr_bases_label = $attribute_taxonomies[1]->attribute_label;
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
  /*****************************
        LOCK ADDON VALUES
  *****************************/
  $wccpf_lock_cm = $values['wccpf_pricing_applied_per_lock']['amount'];
  $wccpf_lock_option_cm = $values['wccpf_lock_option']['fname'];
  /*****************************
  DOUBLE PEDESTAL ADDON VALUES
  *****************************/
  $wccpf_pedestal_cm = $values['wccpf_pricing_applied_double_pedestal']['amount'];
  $wccpf_double_pedestal_option_cm = $values['wccpf_double_pedestal_option']['fname'];
  /*****************************
      HOOKS AND ROD VALUES
  *****************************/
  $wccpf_coat_hooks_cm = $values['wccpf_pricing_applied_per_coat_hook']['amount'];
  $wccpf_coat_rod_cm = $values['wccpf_pricing_applied_per_coat_hook']['amount'];
  /**************************************
    LOCK & DOUBLE PEDESTAL PRICE VALUES
  **************************************/
  if(!empty($wccpf_pedestal_cm) && !empty($wccpf_lock_cm)){
    $cm_value1 = $values['no_of_pulls_pedestal']['value'] * 22;
    $cm_value2 = ($values['no_of_lock_pedestal']['value'] * $wccpf_lock_cm) - 72;
  } else if(empty($wccpf_pedestal_cm) && !empty($wccpf_lock_cm)){
    $cm_value1 = $values['no_of_pulls']['value'] * 22;
    $cm_value2 = ($values['no_of_lock']['value'] * $wccpf_lock_cm) - 72;
  } else if(!empty($wccpf_pedestal_cm) && empty($$wccpf_lock_cm)){
    $cm_value1 = $values['no_of_pulls_pedestal']['value'] * 22;
    $cm_value2 = '0';
  } else if(empty($wccpf_pedestal_cm) && empty($wccpf_lock_cm)){
    $cm_value1 = $values['no_of_pulls']['value'] * 22;
    $cm_value2 = '0';
  }
  /*****************************
    HOOKS AND ROD PRICE VALUES
  *****************************/
  if(!empty($wccpf_coat_hooks_cm)){
    $coat_hooks_price_cm1 = ($values['no_of_coat_hooks']['value'] * $wccpf_coat_hooks_cm) - $wccpf_coat_hooks_cm;
  } else {$coat_hooks_price_cm1 = '0';}
  if(!empty($wccpf_coat_rod_cm1)){
    $coat_rod_price_cm1 = ($values['no_of_coat_rod']['value'] * $wccpf_coat_rod_cm) - $wccpf_coat_rod_cm;
  } else {$coat_rod_price_cm1 = '0';}
  /************************************************
                    BASES COST
  ************************************************/
  // $bases_cost = '500';
  if($values['bases_id']['value'] == '458'){
    $option_bases_value = 'full_cylinder_bases';
    $option_bases_quantity = 'full_cylinder_bases_table_width';
  } else if($values['bases_id']['value'] == '457'){
    $option_bases_value = 'half_cylinder_bases';
    $option_bases_quantity = 'half_cylinder_bases_table_width';
  } else if($values['bases_id']['value'] == '456'){
    $option_bases_value = 'rectangular_bases';
    $option_bases_quantity = 'rectangular_bases_table_width';
  }
  $dimension_split1 = explode('x', $values['dimension']['value'], 2)[1];
  // echo $dimension_split = strtok($dimension_split1, 'x');
  $dimension_split = strtok($values['dimension']['value'], 'x');
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
  /*****************************
          DIMENSION VALUE
  *****************************/
  if(isset( $values['dimension']['value'])) {
    $item->add_meta_data(
      __( 'Dimension', 'plugin-republic' ),
      $values['dimension']['value'],
      true
    );
  }
  /*****************************
        PRODUCT BASE PRICE
  *****************************/
//if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
    if(isset( $values['product_price']['value'])) {
      $item->add_meta_data(
        //'<div class="meta-price">'.
        __( 'Product Base Price', 'plugin-republic' ),
        '$'.$values['product_price']['value'],
        true
        //.'</div>'
      );
    }
  //}
  /*****************************
            SKU VALUE
  *****************************/
  if(isset( $values['sku']['value'])) {
    $item->add_meta_data(
      __( 'SKU', 'plugin-republic' ),
      $values['sku']['value'],
      true
    );
  }
  /*****************************
      DOOR PULLS TYPE VALUE
  /*****************************/
  if(isset( $values['door_pulls_type']['value'])) {
    if(strstr( $values['door_pulls_type']['value'], '*' )){
      $_SESSION['premium2_door_label'] = ' (Premium)';
    } else {
      $_SESSION['premium2_door_label'] = '';
    }
    $values_door_pulls_type = strtok($values['door_pulls_type']['value'], '*');
    $item->add_meta_data(
      __( $attribute_taxonomies[2]->attribute_label, 'plugin-republic' ),
      $values_door_pulls_type.$_SESSION['premium2_door_label'],
      true
    );
  }
  if(isset( $values['door_pulls_type']['value'])) {
    if(strstr( $values['door_pulls_type']['value'], '*' )){
      if(!empty($wccpf_pedestal_cm) || !empty($wccpf_double_pedestal_option_cm)){
        $item->add_meta_data(
            __( '# of Pulls', 'plugin-republic' ),
          $values['no_of_pulls_pedestal']['value'],
          true
        );
      }
      if(empty($wccpf_pedestal_cm) && empty($wccpf_double_pedestal_option_cm)){
        $item->add_meta_data(
            __( '# of Pulls', 'plugin-republic' ),
          $values['no_of_pulls']['value'],
          true
        );
      }
    }
  }
  /*****************************
        FABRIC ORDER VALUE
  *****************************/
  if(isset( $values['fabric']['value'])) {
    $item->add_meta_data(
      __( $attribute_taxonomies[3]->attribute_label, 'plugin-republic' ),
      $values['fabric']['value'],
      true
    );
  }
  /*****************************
        FINISH ORDER VALUE
  ******************************/
  if(isset( $values['finish']['value'])) {
    if(strstr( $values['finish']['value'], '*' )){
      $_SESSION['premium2_finish_label'] = ' (Premium)';
    } else {
      $_SESSION['premium2_finish_label'] = '';
    }
    $values_finish = strtok($values['finish']['value'], '*');
    $item->add_meta_data(
      __( $attribute_taxonomies[4]->attribute_label, 'plugin-republic' ),
      $values_finish.$_SESSION['premium2_finish_label'],
      true
    );
  }
  /*****************************
        BASES VALUE
  ******************************/
  if(!empty($table_width_quantity) && $table_width_quantity != '0') {
    $item->add_meta_data(
      __( $attribute_taxonomies[1]->attribute_label, 'plugin-republic' ),
      $values['bases']['value'],
      true
    );
  }
  /*****************************
        BASES QUANTITY
  ******************************/
  if(!empty($table_width_quantity) && $table_width_quantity != '0') {
    $item->add_meta_data(
      __( '# of '.$attribute_taxonomies[1]->attribute_label, 'plugin-republic' ),
      $table_width_quantity,
      true
    );
  }
  /*****************************
        BASES COST VALUE
  ******************************/
  //if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
    if(!empty($table_width_quantity) && $table_width_quantity != '0') {
      $item->add_meta_data(
        __( $attribute_taxonomies[1]->attribute_label.' Cost', 'plugin-republic' ),
        '$'.$table_depth_price,
        true
      );
    }
  //}
  /*****************************
        GROMMET COLOR VALUE
  ******************************/
  if(isset( $values['grommet_color']['value'])) {
    $item->add_meta_data(
      __( $attribute_taxonomies[5]->attribute_label, 'plugin-republic' ),
      $values['grommet_color']['value'],
      true
    );
  }
  /*****************************
    GROMMET COLOR PRICE VALUE
  *****************************/
  //if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
    if(isset( $values['grommet_color_price']['value'])) {
      $item->add_meta_data(
        __( 'Grommet Color Cost', 'plugin-republic' ),
        '$'.$values['grommet_color_price']['value'],
        true
      );
    }
  //}
  /*****************************
    GROMMET ORIENTATION VALUE
  *****************************/
  if(isset( $values['grommet_orientation']['value'])) {
    $item->add_meta_data(
      __( $attribute_taxonomies[6]->attribute_label, 'plugin-republic' ),
      $values['grommet_orientation']['value'],
      true
    );
  }
  /*****************************
        ORIENTATION VALUE
  *****************************/
  if(isset( $values['orientation']['value'])) {
    $item->add_meta_data(
      __( $attribute_taxonomies[7]->attribute_label, 'plugin-republic' ),
      $values['orientation']['value'],
      true
    );
  }
  /*****************************
    PEDESTAL ORIENTATION VALUE
  *****************************/
  if(isset( $values['pedestal_orientation']['value'])) {
    $item->add_meta_data(
      __( $attribute_taxonomies[8]->attribute_label, 'plugin-republic' ),
      $values['pedestal_orientation']['value'],
      true
    );
  }
  /*****************************
    PEDESTAL PULLS TYPE VALUE
  *****************************/
  if(isset( $values['pedestal_pulls_type']['value'])) {
    if(strstr( $values['pedestal_pulls_type']['value'], '*' )){
      $_SESSION['premium2_pulls_label'] = ' (Premium)';
    } else {
      $_SESSION['premium2_pulls_label'] = '';
    }
    $values_pedestal_pulls_type = strtok($values['pedestal_pulls_type']['value'], '*');
    $item->add_meta_data(
      __( $attribute_taxonomies[9]->attribute_label, 'plugin-republic' ),
      $values_pedestal_pulls_type.$_SESSION['premium2_pulls_label'],
      true
    );
  }
  /*****************************
        ADD PEDESTAL VALUE
  *****************************/
  if(isset( $values['add_pedestal']['value'])) {
    $item->add_meta_data(
      __( $attribute_taxonomies[0]->attribute_label, 'plugin-republic' ),
      $values['add_pedestal']['value'],
      true
    );
  }
  /*****************************
    PEDESTAL TYPE ORDER VALUE
  *****************************/
  if(isset( $values['pedestal_type']['value'])) {
    if(strstr( $values['pedestal_type']['value'], '*' )){
      $_SESSION['premium2_pedestal_label'] = ' (Premium)';
    } else {
      $_SESSION['premium2_pedestal_label'] = '';
    }
    $item->add_meta_data(
      __( $attribute_taxonomies[10]->attribute_label, 'plugin-republic' ),
      $values['pedestal_type']['value'].$_SESSION['premium2_pedestal_label'],
      true
    );
  }
  /*****************************
    PEDESTAL PULLS TYPE VALUE
  *****************************/
  if(isset( $values['pedestal_quantity']['value'])) {
    $item->add_meta_data(
      __( 'Pedestal Quantity', 'plugin-republic' ),
      $values['pedestal_quantity']['value'],
      true
    );
  }
  /*****************************
    PEDESTAL PULLS TYPE VALUE
  *****************************/
  //if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
    if(isset( $values['pedestal_premium_price']['value'])) {
      $item->add_meta_data(
        __( 'Pedestal Cost', 'plugin-republic' ),
        '$'.$values['pedestal_premium_price']['value'],
        true
      );
    }
  //}
  /*****************************
      SPECIFY SHELVES VALUE
  *****************************/
  if(isset( $values['specify_shelves']['value'])) {
    $item->add_meta_data(
      __( $attribute_taxonomies[11]->attribute_label, 'plugin-republic' ),
      $values['specify_shelves']['value'],
      true
    );
  }
  /*****************************
  NO OF LOCKS FOR DOOR PULLS TYPE
  *****************************/
  if((!empty($wccpf_pedestal_cm) && !empty($wccpf_lock_cm)) || (!empty($wccpf_double_pedestal_option_cm) && !empty($wccpf_lock_option_cm))){
    if(!empty($values['no_of_lock_pedestal']['value'])){
      $item->add_meta_data(
          __( '# of Locks', 'plugin-republic' ),
        $values['no_of_lock_pedestal']['value'],
        true
      );
    } else {
      $item->add_meta_data(
          __( '# of Locks', 'plugin-republic' ),
        '1',
        true
      );
    }
  }
  /*****************************
  NO OF LOCKS FOR PEDESTAL PULLS
  *****************************/
  //if(empty($wccpf_pedestal_cm) && !empty($wccpf_lock_cm)){
  if((empty($wccpf_pedestal_cm) && !empty($wccpf_lock_cm)) || (empty($wccpf_double_pedestal_option_cm) && !empty($wccpf_lock_option_cm))){
    if(!empty($values['no_of_lock']['value'])){
      $item->add_meta_data(
          __( '# Of Locks', 'plugin-republic' ),
        $values['no_of_lock']['value'],
        true
      );
    } else {
      $item->add_meta_data(
          __( '# Of Locks', 'plugin-republic' ),
        '1',
        true
      );
    }
  }
  /*****************************
      COAT HOOKS VALUE
  *****************************/
  if(!empty($wccpf_coat_hooks_cm)){
    if(!empty($values['no_of_coat_hooks']['value'])) {
      $item->add_meta_data(
         __( '# Of Coat Hooks', 'plugin-republic' ),
        $values['no_of_coat_hooks']['value'],
        true
      );
    }
  }
  /*****************************
      CLOSET ROD VALUE
  *****************************/
  if(!empty($wccpf_coat_rod_cm)){
    if(!empty( $values['no_of_coat_rod']['value'])) {
      $item->add_meta_data(
         __( '# Of Closet Rod', 'plugin-republic' ),
        $values['no_of_coat_rod']['value'],
        true
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
  while($count1 < $values['addon_count']['value']){
    if($values['addonslug-'.$count1]['value'] == 'double-pedestal'){
      $double_pedestal1 = $values['addontitle-'.$count1]['value'];
      $double_pedestal1_quantity = $values['addonquantity-'.$count1]['value'];
      $double_pedestal1_price = $values['addonprice-'.$count1]['value'];
    }
    if($values['addonslug-'.$count1]['value'] == 'lock'){
      $lock1 = $values['addontitle-'.$count1]['value'];
      $lock1_quantity = $values['addonquantity-'.$count1]['value'];
      $lock1_price = $values['addonprice-'.$count1]['value'];
    }
    if($values['addonslug-'.$count1]['value'] == 'data-av-cutouts'){
      $data_av = $values['addontitle-'.$count1]['value'];
      $data_av_quantity = $values['addonquantity-'.$count1]['value'];
    }
    if($values['addonslug-'.$count1]['value'] == '2-plug-in-power-2-data-points'){
      $plugin_power_dp = $values['addontitle-'.$count1]['value'];
      $plugin_power_dp_quantity = $values['addonquantity-'.$count1]['value'];
    }
    if($values['addonslug-'.$count1]['value'] == '2-plug-in-power-points'){
      $plugin_power = $values['addontitle-'.$count1]['value'];
      $plugin_power_quantity = $values['addonquantity-'.$count1]['value'];
    }
    if($values['addonslug-'.$count1]['value'] == 'flip-up-doors'){
      $flip_door = $values['addontitle-'.$count1]['value'];
      $flip_door_quantity = $values['addonquantity-'.$count1]['value'];
    }
    if($values['addonslug-'.$count1]['value'] == 'technology-trough'){
      $technology_trough = $values['addontitle-'.$count1]['value'];
      $technology_trough_quantity = $values['addonquantity-'.$count1]['value'];
    }
    if($values['addonslug-'.$count1]['value'] != 'data-av-cutouts' && $values['addonslug-'.$count1]['value'] != 'technology-trough'){
      if(strstr( $values['addonprice-'.$count1]['value'], '%' )){
        $item->add_meta_data(
           __( $values['addontitle-'.$count1]['value'], 'plugin-republic' ),
          $values['addonprice-'.$count1]['value'].' of Product Base Price',
          true
        );
      } else {
        if($values['addonslug-'.$count1]['value'] != 'data-av-cutouts' && $values['addonslug-'.$count1]['value'] != 'technology-trough'){
              $item->add_meta_data(
                 __( $values['addontitle-'.$count1]['value'], 'plugin-republic' ),
                '$'.$values['addonprice-'.$count1]['value'],
                true
              );
          }
      }
    }
    if($values['addonslug-'.$count1]['value'] != 'lock' && $values['addonslug-'.$count1]['value'] != 'data-av-cutouts' && $values['addonslug-'.$count1]['value'] != 'technology-trough'){
      if($values['addonquantity-'.$count1]['value'] != 'undefined'){
        $item->add_meta_data(
          __( '# of '.$values['addontitle-'.$count1]['value'], 'plugin-republic' ),
          $values['addonquantity-'.$count1]['value'],
          true
        );
      }
    }
    $count1++;
  }
  if(!empty($lock1) && !empty($double_pedestal1)){
    $item->add_meta_data(
      __( '# of '.$lock1, 'plugin-republic' ),
      $values['no_of_lock_pedestal']['value'],
      true
    );
  }
  else if(!empty($lock1)){
    $item->add_meta_data(
      __( '# of '.$lock1, 'plugin-republic' ),
      $values['no_of_lock']['value'],
      true
    );
  }
  if(!empty($values['pedestal_pulls_type']['value'])){
    if(strstr( $values['pedestal_pulls_type']['value'], '*' )){
      if(!empty($double_pedestal1)){
        $item->add_meta_data(
          __( 'Per Pedestal Pull', 'plugin-republic' ),
          '$22',
          true
        );
        $item->add_meta_data(
          __( '# of Pedestal Pulls', 'plugin-republic' ),
          $values['no_of_pulls_pedestal']['value'],
          true
        );
      } else {
        $item->add_meta_data(
          __( 'Per Pedestal Pull', 'plugin-republic' ),
          '$22',
          true
        );
        $item->add_meta_data(
          __( '# of Pedestal Pulls', 'plugin-republic' ),
          $values['no_of_pulls']['value'],
          true
        );
      }
    }
  }
  if(!empty($values['door_pulls_type']['value'])){
    if(strstr( $values['door_pulls_type']['value'], '*' )){
      if(!empty($double_pedestal1)){
        if(!empty($values['no_of_pulls_pedestal']['value'])){
          $item->add_meta_data(
            __( 'Per Pull', 'plugin-republic' ),
            '$22',
            true
          );
          $item->add_meta_data(
            __( '# of Pulls', 'plugin-republic' ),
            $values['no_of_pulls_pedestal']['value'],
            true
          );
        }
      } else {
        if(!empty($values['no_of_pulls']['value'])){
          $item->add_meta_data(
            __( 'Per Pull', 'plugin-republic' ),
            '$22',
            true
          );
          $item->add_meta_data(
            __( '# of Pulls', 'plugin-republic' ),
            $values['no_of_pulls']['value'],
            true
          );
        }
      }
    }
  }
  /************************************************
        SET CONDITION FOR DATA AVA CUTOUTS
  ************************************************/
  if(!empty($data_av) || !empty($plugin_power_dp) || !empty($plugin_power)){
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
      $item->add_meta_data(
        __( $data_av_title, 'plugin-republic' ),
        '$'.$data_av_price,
        true
      );
      if(!empty($plugin_power_dp) || !empty($plugin_power)){
        $item->add_meta_data(
          __( '# of '.$data_av_title, 'plugin-republic' ),
          $plugin_power_dp_quantity + $plugin_power_quantity,
          true
        );
      } else {
        $item->add_meta_data(
          __( '# of '.$data_av_title, 'plugin-republic' ),
          $data_av_quantity,
          true
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
      $item->add_meta_data(
        __( $technology_trough_title, 'plugin-republic' ),
        '$'.$technology_trough_price,
        true
      );
      if(!empty($flip_door)){
        $item->add_meta_data(
          __( '# of '.$technology_trough_title, 'plugin-republic' ),
          $flip_door_quantity,
          true
        );
      } else {
        $item->add_meta_data(
          __( '# of '.$technology_trough_title, 'plugin-republic' ),
          $technology_trough_quantity,
          true
        );
      }
    }
  }
}
add_action( 'woocommerce_checkout_create_order_line_item', 'plugin_republic_checkout_create_order_line_item', 10, 4 );
/**************************************
        Add Custom Price in cart
***************************************/
add_action( 'woocommerce_before_calculate_totals', 'add_custom_price', 20, 1);
function add_custom_price( $cart) {
    //print("<pre>");print_r($cart);print("</pre>");
    foreach ( $cart->get_cart() as $item ) {
        /**************************************
                INCH TO 16% VALUE
        **************************************/
        $_1_78_inch_tops = $item['wccpf__1_78_inch_tops']['fname'];
        $inch_top_val1 = $item['wccpf__1_78_inch_tops']['user_val'];
        $inch_top_val = $inch_top_val1[0];
        $inch_top_final_val = str_replace('% of Product Base Price', '', $inch_top_val);
        /**************************************
                LOCK PRICING VALUE
        **************************************/
        $lock_pricing1 = $item['wccpf_pricing_applied_per_lock']['amount'];
        $lock_pricing = preg_replace('/&#36;/', '', $lock_pricing1);
        /**************************************
                PEDESTAL PRICING VALUE
        **************************************/
        $pedestal_pricing1 = $item['wccpf_pricing_applied_double_pedestal']['amount'];
        $pedestal_pricing = preg_replace('/&#36;/', '', $pedestal_pricing1);
        /**************************************
            COAT HOOKS & ROD PRICING VALUE
        **************************************/
        $coat_hooks_pricing1 = $item['wccpf_pricing_applied_per_coat_hook']['amount'];
        $coat_hooks_pricing = preg_replace('/&#36;/', '', $coat_hooks_pricing1);
        $coat_rod_pricing1 = $item['wccpf_pricing_applied_per_closet_rod']['amount'];
        $coat_rod_pricing = preg_replace('/&#36;/', '', $coat_rod_pricing1);
        /************************************************
                        BASES COST
        ************************************************/
        if($item['bases_id']['value'] == '458'){
            $option_bases_value = 'full_cylinder_bases';
            $option_bases_quantity = 'full_cylinder_bases_table_width';
        } else if($item['bases_id']['value'] == '457'){
            $option_bases_value = 'half_cylinder_bases';
            $option_bases_quantity = 'half_cylinder_bases_table_width';
        } else if($item['bases_id']['value'] == '456'){
            $option_bases_value = 'rectangular_bases';
            $option_bases_quantity = 'rectangular_bases_table_width';
        }
        if(!empty($item['bases_id']['value'])){
            $dimension_split1 = explode('x', $item['dimension']['value'], 2)[1];
            // echo $dimension_split = strtok($dimension_split1, 'x');
            $dimension_split = strtok($item['dimension']['value'], 'x');
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
        } else {
            $table_depth_price = '0';
            $table_width_quantity = '0';
        }
        $table_depth_final_price = $table_depth_price * $table_width_quantity;
        /**************************************
                    CART ITEM PRICE
        **************************************/
        $cart_item_price1 = $item['data']->price; //cart item price
        /**************************************
                CART ITEM REGULAR PRICE
        **************************************/
        $cart_item_price2 = $item['data']->regular_price; //get regular price
        /**************************************
                ECLUDE REGULAR PRICE
        **************************************/
        $cart_item_price3 = $cart_item_price1 - $cart_item_price2; //exclude regular price
        /**************************************
                PRODUCT BASE PRICE
        **************************************/
        $product_base_price = $item['product_price']['value'];
        if(!empty($_1_78_inch_tops) && !empty($inch_top_final_val)){
            $cart_item_price_final = $cart_item_price3;
            $per_product_base_price =  $product_base_price * ($inch_top_final_val / 100);
            $cart_item_price = $cart_item_price_final + $per_product_base_price;
        } else {
            $cart_item_price = $cart_item_price1 - $cart_item_price2;
        }
        if(!empty($item['finish_premium_price']['value'])){
            $finish_premium_price = $item['finish_premium_price']['value'];
        } else {$finish_premium_price = '0';}
        if(!empty($item['pulls_premium_price']['value'])){
            $pulls_premium_price = $item['pulls_premium_price']['value'];
        } else {$pulls_premium_price = '0';}
        if(!empty($item['pedestal_premium_price']['value'])){
            $pedestal_premium_price = $item['pedestal_premium_price']['value'];
        } else {$pedestal_premium_price = '0';}
        if(!empty($item['door_pulls_premium_price']['value'])){
            $door_pulls_premium_price = $item['door_pulls_premium_price']['value'];
        } else {$door_pulls_premium_price = '0';}
        if(!empty($item['grommet_color_price']['value'])){
            $grommet_color_price = $item['grommet_color_price']['value'];
        } else {$grommet_color_price = '0';}
        /**************************************
                PREMIUM FINISH COST
        **************************************/
        if($finish_premium_price != 0){
            // $product_item_price = $item['data']->regular_price;
            $finish_price = ($product_base_price * $finish_premium_price)/100;
        } else {$finish_price = '0';}
        /**************************************
                PREMIUM PULLS COST
        **************************************/
        if($pulls_premium_price != 0){
            $pulls_price = $pulls_premium_price;
        } else {$pulls_price = '0';}
        /**************************************
                PREMIUM PEDESTAL COST
        **************************************/
        if($pedestal_premium_price != 0){
            $pedestal_price = $pedestal_premium_price;
        } else {$pedestal_price = '0';}
        /**************************************
                PREMIUM DOOR PULLS COST
        **************************************/
        if($door_pulls_premium_price != 0){
            $door_pulls_price = $door_pulls_premium_price;
        } else {$door_pulls_price = '0';}
        /**************************************
                GROMMET COLOR COST
        **************************************/
        if($grommet_color_price != 0){
            $grommet_color_cost = $grommet_color_price;
        } else {$grommet_color_cost = '0';}
        /**************************************
                CART ITEM ADDONS PRICE
        **************************************/
        $item_count = 0;
        $item_addon_price = 0;
        while($item_count < $item['addon_count']['value']){
          //$item['addonslug-'.$item_count]['value'];
          if($item['addonquantity-'.$item_count]['value'] != 'undefined'){
            $addon_quantity1 = $item['addonquantity-'.$item_count]['value'];
          } else {
            $addon_quantity1 = 1;
          }
          if($item['addonslug-'.$item_count]['value'] != 'data-av-cutouts' && $item['addonslug-'.$item_count]['value'] != 'technology-trough' && $item['addonslug-'.$item_count]['value'] != 'lock'){
            if(strstr( $item['addonprice-'.$item_count]['value'], '%' )){
              $addon_price1 = ($item['addonprice-'.$item_count]['value'] * $product_base_price) /100;
            } else {
              $addon_price1 = $item['addonprice-'.$item_count]['value'] * $addon_quantity1;
            }
            $item_addon_price = $item_addon_price + $addon_price1;
          }
          $item_count++;
        }
        // echo $item_addon_price;
        /************************************************
              CUSTOM ADDONS OPTIONS DEPENDENT PRICE
        ************************************************/
        $count1_item = 0;
        $double_pedestal2 = '';
        $double_pedestal2_quantity = 0;
        $double_pedestal2_price = 0;
        $lock2 = '';
        $lock2_quantity = 0;
        $lock2_price = 0;
        $data_av2 = '';
        $data_av_quantity2 = 0;
        $plugin_power_dp2 = '';
        $plugin_power_dp_quantity2 = 0;
        $plugin_power2 = '';
        $plugin_power_quantity2 = 0;
        $flip_door = '';
        $flip_door_quantity = 0;
        $technology_trough = '';
        $technology_trough_quantity = 0;
        $lock2_final_quantity = 0;
        $pulls_final = 0;
        while($count1_item < $item['addon_count']['value']){
          if($item['addonslug-'.$count1_item]['value'] == 'double-pedestal'){
            $double_pedestal2 = $item['addontitle-'.$count1_item]['value'];
            $double_pedestal2_quantity = $item['addonquantity-'.$count1_item]['value'];
            $double_pedestal2_price = $item['addonprice-'.$count1_item]['value'];
          }
          if($item['addonslug-'.$count1_item]['value'] == 'lock'){
            $lock2 = $item['addontitle-'.$count1_item]['value'];
            $lock2_quantity = $item['addonquantity-'.$count1_item]['value'];
            $lock2_price = $item['addonprice-'.$count1_item]['value'];
          }
          if($item['addonslug-'.$count1_item]['value'] == 'data-av-cutouts'){
            $data_av2 = $item['addontitle-'.$count1_item]['value'];
            $data_av_quantity2 = $item['addonquantity-'.$count1_item]['value'];
          }
          if($item['addonslug-'.$count1_item]['value'] == '2-plug-in-power-2-data-points'){
            $plugin_power_dp2 = $item['addontitle-'.$count1_item]['value'];
            $plugin_power_dp_quantity2 = $item['addonquantity-'.$count1_item]['value'];
          }
          if($item['addonslug-'.$count1_item]['value'] == '2-plug-in-power-points'){
            $plugin_power2 = $item['addontitle-'.$count1_item]['value'];
            $plugin_power_quantity2 = $item['addonquantity-'.$count1_item]['value'];
          }
          if($item['addonslug-'.$count1_item]['value'] == 'flip-up-doors'){
            $flip_door = $item['addontitle-'.$count1_item]['value'];
            $flip_door_quantity = $item['addonquantity-'.$count1_item]['value'];
          }
          if($item['addonslug-'.$count1_item]['value'] == 'technology-trough'){
            $technology_trough = $item['addontitle-'.$count1_item]['value'];
            $technology_trough_quantity = $item['addonquantity-'.$count1_item]['value'];
          }
          $count1_item++;
        }
        /************************************************
              SET CONDITION FOR DATA AVA CUTOUTS
        ************************************************/
        $data_av_final = 0;
        $data_av_final_quantity = 0;
        if(!empty($data_av2) || !empty($plugin_power_dp2) || !empty($plugin_power2)){
          $posts = get_posts(
            array(
              'include'   => '42192',
              'post_type' => 'productsoptions',
              'orderby'   => 'post__in',
            )
          );
          foreach($posts as $post){
            $data_av_price2 = get_field('option_price',$post->ID);
            $data_av_title2 = $post->post_title;
            if(!empty($plugin_power_dp2) || !empty($plugin_power2)){
              $data_av_final_quantity = $plugin_power_dp_quantity2 + $plugin_power_quantity2;
            } else if(empty($plugin_power_dp2) && empty($plugin_power2)){
              $data_av_final_quantity = $data_av_quantity2;
            }
          }
          $data_av_final = $data_av_final_quantity * $data_av_price2;
          // echo '<br>';
        }
        /************************************************
              SET CONDITION FOR TECHNOLOGY TROUGH
        ************************************************/
        $technology_trough_final = 0;
        $technology_trough_final_quantity = 0;
        if(!empty($flip_door) || !empty($technology_trough)){
          $posts = get_posts(
            array(
              'include'   => '42197',
              'post_type' => 'productsoptions',
              'orderby'   => 'post__in',
            )
          );
          foreach($posts as $post){
            $technology_trough_price2 = get_field('option_price',$post->ID);
            $technology_trough_title2 = $post->post_title;
            if(!empty($flip_door)){
              $technology_trough_final_quantity = $flip_door_quantity;
            } else if(empty($flip_door)){
              $technology_trough_final_quantity = $technology_trough_quantity;
            }
          }
          $technology_trough_final = $technology_trough_final_quantity * $technology_trough_price2;
        }
        /************************************************
                  SET CONDITION FOR LOCKS
        ************************************************/
        if(!empty($lock2) && !empty($double_pedestal2)){
          if(!empty($item['no_of_lock_pedestal']['value'])){
            $lock2_final_quantity = $item['no_of_lock_pedestal']['value'];
          } else {
            $lock2_final_quantity = 1;
          }
        }
        else if(!empty($lock2)){
          if(!empty($item['no_of_lock']['value'])){
            $lock2_final_quantity = $item['no_of_lock']['value'];
          } else {
            $lock2_final_quantity = 1;
          }
        }
        $lock2_final = $lock2_final_quantity * $lock2_price;
        /************************************************
                  SET CONDITION FOR PEDESTAL PULLS
        ************************************************/
        if(!empty($item['pedestal_pulls_type']['value'])){
          if(strstr( $item['pedestal_pulls_type']['value'], '*' )){
            if(!empty($double_pedestal2)){
              $pulls_final = $item['no_of_pulls_pedestal']['value'] * 22;
            } else {
              $pulls_final = $item['no_of_pulls']['value'] * 22;
            }
          }
        }
        /************************************************
                  SET CONDITION FOR DOOR PULLS
        ************************************************/
        if(!empty($item['door_pulls_type']['value'])){
          if(strstr( $item['door_pulls_type']['value'], '*' )){
            if(!empty($double_pedestal2)){
              $pulls_final = $item['no_of_pulls_pedestal']['value'] * 22;
            } else {
              $pulls_final = $item['no_of_pulls']['value'] * 22;
            }
          }
        }
        /**************************************
            CART ITEM FINAL PRICE
        **************************************/
        // $cart_item_price;
        // $product_base_price;
        // $finish_price;
        // $pulls_price;
        // $pedestal_price;
        //$door_pulls_price;
        // $grommet_color_cost;
        //echo $value1;
        //echo $value2;
        //echo $dvalue1;
        //echo $dvalue2;
        //echo $coat_hooks_price_value;
        // $coat_rod_price_value;
        //echo '<br>';
        $price1 = $cart_item_price + $product_base_price + $finish_price + $pulls_price + $pedestal_price + $door_pulls_price + $grommet_color_cost + $value1 + $value2 + $dvalue1 + $dvalue2 + $coat_hooks_price_value + $coat_rod_price_value + $table_depth_final_price + $item_addon_price + $data_av_final + $technology_trough_final + $lock2_final + $pulls_final;
        $item['data']->set_price( $price1 );
    }
}
?>
