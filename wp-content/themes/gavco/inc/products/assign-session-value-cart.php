<?php

/*****************************************************************************
                Add Form selected value as custom cart item data
******************************************************************************/
add_filter( 'woocommerce_add_cart_item_data', 'add_custom_cart_item_data', 20, 2 );
function add_custom_cart_item_data( $cart_item_data, $product_id ){
    session_start();
    /********************************************************************
                        DIMENSION DROPDOWN VALUE
    ********************************************************************/
    if(isset($_SESSION['dimension']) && !empty($_SESSION['dimension'])) {
        $cart_item_data['dimension'] = array(
            'value' => esc_attr($_SESSION['dimension']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['dimension']);
    }
    /********************************************************************
                      ADD PEDESTAL DROPDOWN VALUE
    ********************************************************************/
    if(isset($_SESSION['add_pedestal']) && !empty($_SESSION['add_pedestal'])) {
        $cart_item_data['add_pedestal']= array(
            'value' => esc_attr($_SESSION['add_pedestal']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['add_pedestal']);
    }
    /********************************************************************
                          GENERAL SKU VALUE
    ********************************************************************/
    if(isset($_SESSION['sku']) && !empty($_SESSION['sku'])) {
        $cart_item_data['sku']= array(
            'value' => esc_attr($_SESSION['sku']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['sku']);
    }
    /********************************************************************
                      DOOR PULLS TYPE DROPDOWN VALUE
    ********************************************************************/
    if(isset($_SESSION['door_pulls_type']) && !empty($_SESSION['door_pulls_type'])) {
        $cart_item_data['door_pulls_type']= array(
            'value' => esc_attr($_SESSION['door_pulls_type']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['door_pulls_type']);
    }
    /********************************************************************
                      DOOR PULLS TYPE QUANTITY VALUE
    ********************************************************************/
    if(isset($_SESSION['door_pulls_quantity']) && !empty($_SESSION['door_pulls_quantity'])) {
        $cart_item_data['door_pulls_quantity']= array(
            'value' => esc_attr($_SESSION['door_pulls_quantity']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['door_pulls_quantity']);
    }
    /********************************************************************
                DOOR PULLS TYPE DROPDOWN PREMIUM PRICE VALUE
    ********************************************************************/
    if(isset($_SESSION['door_pulls_premium_price']) && !empty($_SESSION['door_pulls_premium_price'])) {
        $cart_item_data['door_pulls_premium_price']= array(
            'value' => esc_attr($_SESSION['door_pulls_premium_price']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['door_pulls_premium_price']);
    }
    /********************************************************************
                        FABRIC DROPDOWN VALUE
    ********************************************************************/
    if(isset($_SESSION['fabric']) && !empty($_SESSION['fabric'])) {
        $cart_item_data['fabric']= array(
            'value' => esc_attr($_SESSION['fabric']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['fabric']);
    }
    /********************************************************************
                        FINISH DROPDOWN VALUE
    ********************************************************************/
    if(isset($_SESSION['finish']) && !empty($_SESSION['finish'])) {
        $cart_item_data['finish']= array(
            'value' => esc_attr($_SESSION['finish']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['finish']);
    }
    /********************************************************************
                    FINISH PREMIUM PRICE DROPDOWN VALUE
    ********************************************************************/
    if(isset($_SESSION['finish_premium_price']) && !empty($_SESSION['finish_premium_price'])) {
        $cart_item_data['finish_premium_price'] = array(
            'value' => esc_attr($_SESSION['finish_premium_price']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['finish_premium_price']);
    }
    /********************************************************************
                      GROMMET COLOR DROPDOWN VALUE
    ********************************************************************/
    if(isset($_SESSION['grommet_color']) && !empty($_SESSION['grommet_color'])) {
        $cart_item_data['grommet_color'] = array(
            'value' => esc_attr($_SESSION['grommet_color']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['grommet_color']);
    }
    /********************************************************************
                      GROMMET COLOR DROPDOWN VALUE
    ********************************************************************/
    if(isset($_SESSION['grommet_color_price']) && !empty($_SESSION['grommet_color_price'])) {
        $cart_item_data['grommet_color_price'] = array(
            'value' => esc_attr($_SESSION['grommet_color_price']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['grommet_color_price']);
    }
    /********************************************************************
                    GROMMET ORIENTATION DROPDOWN VALUE
    ********************************************************************/
    if(isset($_SESSION['grommet_orientation']) && !empty($_SESSION['grommet_orientation'])) {
        $cart_item_data['grommet_orientation'] = array(
            'value' => esc_attr($_SESSION['grommet_orientation']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['grommet_orientation']);
    }
    /********************************************************************
                        ORIENTATION DROPDOWN VALUE
    ********************************************************************/
    if(isset($_SESSION['orientation']) && !empty($_SESSION['orientation'])) {
        $cart_item_data['orientation'] = array(
            'value' => esc_attr($_SESSION['orientation']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['orientation']);
    }
    /********************************************************************
                    PEDESTAL ORIENTATION DROPDOWN VALUE
    ********************************************************************/
    if(isset($_SESSION['pedestal_orientation']) && !empty($_SESSION['pedestal_orientation'])) {
        $cart_item_data['pedestal_orientation'] = array(
            'value' => esc_attr($_SESSION['pedestal_orientation']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['pedestal_orientation']);
    }
    /********************************************************************
                      SPECIFY SHELVES DROPDOWN VALUE
    ********************************************************************/
    if(isset($_SESSION['specify_shelves']) && !empty($_SESSION['specify_shelves'])) {
        $cart_item_data['specify_shelves'] = array(
            'value' => esc_attr($_SESSION['specify_shelves']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['specify_shelves']);
    }
    /********************************************************************
                    PEDESTAL PULLS TYPE DROPDOWN VALUE
    ********************************************************************/
    if(isset($_SESSION['pedestal_pulls_type']) && !empty($_SESSION['pedestal_pulls_type'])) {
        $cart_item_data['pedestal_pulls_type'] = array(
            'value' => esc_attr($_SESSION['pedestal_pulls_type']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['pedestal_pulls_type']);
    }
    /********************************************************************
                  PEDESTAL PULLS TYPE PREMIUM PRICE VALUE
    ********************************************************************/
    if(isset($_SESSION['pulls_premium_price']) && !empty($_SESSION['pulls_premium_price'])) {
        $cart_item_data['pulls_premium_price'] = array(
            'value' => esc_attr($_SESSION['pulls_premium_price']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['pulls_premium_price']);
    }
    /********************************************************************
                    PEDESTAL PULLS TYPE Quantity VALUE
    ********************************************************************/
    if(isset($_SESSION['pulls_quantity']) && !empty($_SESSION['pulls_quantity'])) {
        $cart_item_data['pulls_quantity'] = array(
            'value' => esc_attr($_SESSION['pulls_quantity']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['pulls_quantity']);
    }
    /********************************************************************
                      PEDESTAL TYPE DROPDOWN VALUE
    ********************************************************************/
    if(isset($_SESSION['pedestal_type']) && !empty($_SESSION['pedestal_type'])) {
        $cart_item_data['pedestal_type'] = array(
            'value' => esc_attr($_SESSION['pedestal_type']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['pedestal_type']);
    }
    /********************************************************************
                /***PEDESTAL PULLS TYPE PREMIUM PRICE VALUE***
    ********************************************************************/
    if(isset($_SESSION['pedestal_premium_price']) && !empty($_SESSION['pedestal_premium_price'])) {
        $cart_item_data['pedestal_premium_price'] = array(
            'value' => esc_attr($_SESSION['pedestal_premium_price']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['pedestal_premium_price']);
    }
    /********************************************************************
                /***PEDESTAL PULLS TYPE Quantity VALUE***
    ********************************************************************/
    if(isset($_SESSION['pedestal_quantity']) && !empty($_SESSION['pedestal_quantity'])) {
        $cart_item_data['pedestal_quantity'] = array(
            'value' => esc_attr($_SESSION['pedestal_quantity']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['pedestal_quantity']);
    }
    /********************************************************************
                            PRODUT BASE PRICE VALUE
    ********************************************************************/
    if(isset($_SESSION['product_price']) && !empty($_SESSION['product_price'])) {
        $cart_item_data['product_price'] = array(
            'value' => esc_attr($_SESSION['product_price']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['product_price']);
    }
    /********************************************************************
                        NO OF PULLS QUANTITY VALUE
    ********************************************************************/
    if(isset($_SESSION['no_of_pulls']) && !empty($_SESSION['no_of_pulls'])) {
        $cart_item_data['no_of_pulls'] = array(
            'value' => esc_attr($_SESSION['no_of_pulls']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['no_of_pulls']);
    }
    /********************************************************************
              NO OF PULLS QUANTITY VALUE IF PEDESTAL ADDED
    ********************************************************************/
    if(isset($_SESSION['no_of_pulls_pedestal']) && !empty($_SESSION['no_of_pulls_pedestal'])) {
        $cart_item_data['no_of_pulls_pedestal'] = array(
            'value' => esc_attr($_SESSION['no_of_pulls_pedestal']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['no_of_pulls_pedestal']);
    }
    /********************************************************************
                        NO OF LOCKS QUANITY VALUE
    ********************************************************************/
    if(isset($_SESSION['no_of_lock']) && !empty($_SESSION['no_of_lock'])) {
        $cart_item_data['no_of_lock'] = array(
            'value' => esc_attr($_SESSION['no_of_lock']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['no_of_lock']);
    }
    /********************************************************************
                NO OF LOCAKS QUANTITY VALUE IF PEDESTAL ADDED
    ********************************************************************/
    if(isset($_SESSION['no_of_lock_pedestal']) && !empty($_SESSION['no_of_lock_pedestal'])) {
        $cart_item_data['no_of_lock_pedestal'] = array(
            'value' => esc_attr($_SESSION['no_of_lock_pedestal']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['no_of_lock_pedestal']);
    }
    /********************************************************************
                          NO OF COAT HOOKS VALUE
    ********************************************************************/
    if(isset($_SESSION['no_of_coat_hooks']) && !empty($_SESSION['no_of_coat_hooks'])) {
        $cart_item_data['no_of_coat_hooks'] = array(
            'value' => esc_attr($_SESSION['no_of_coat_hooks']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['no_of_coat_hooks']);
    }
    /********************************************************************
                          NO OF COAT ROD VALUE
    ********************************************************************/
    if(isset($_SESSION['no_of_coat_rod']) && !empty($_SESSION['no_of_coat_rod'])) {
        $cart_item_data['no_of_coat_rod'] = array(
            'value' => esc_attr($_SESSION['no_of_coat_rod']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['no_of_coat_rod']);
    }
    /********************************************************************
                              Bases Value
    ********************************************************************/
    if(isset($_SESSION['bases']) && !empty($_SESSION['bases'])) {
        $cart_item_data['bases'] = array(
            'value' => esc_attr($_SESSION['bases']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['bases']);
    }
    if(isset($_SESSION['bases_id']) && !empty($_SESSION['bases_id'])) {
        $cart_item_data['bases_id'] = array(
            'value' => esc_attr($_SESSION['bases_id']),
            'unique_key' => md5( microtime() . rand() ),
        );
        unset($_SESSION['bases_id']);
    }
    if ( !in_array( 'empty', $_SESSION['addons'], true )){
        $addons_count = 0;
        $addons = $_SESSION['addons'];
        foreach($addons as $add){
            if($add != 'empty'){
                $add1 = explode('__', $add, 2)[1];
                $add2 = explode('__', $add1, 2)[1];
                $add3 = explode('__', $add2, 2)[1];
                $addon_title = strtok($add, '__');
                $addon_price = strtok($add1, '__');
                $addon_slug = strtok($add2, '__');
                $addon_quantity = strtok($add3, '__');
                $cart_item_data['addontitle-'.$addons_count] = array(
                    'value' => esc_attr($addon_title),
                    'unique_key' => md5( microtime() . rand() ),
                );
                $cart_item_data['addonslug-'.$addons_count] = array(
                    'value' => esc_attr($addon_slug),
                    'unique_key' => md5( microtime() . rand() ),
                );
                $cart_item_data['addonprice-'.$addons_count] = array(
                    'value' => esc_attr($addon_price),
                    'unique_key' => md5( microtime() . rand() ),
                );
                $cart_item_data['addonquantity-'.$addons_count] = array(
                    'value' => esc_attr($addon_quantity),
                    'unique_key' => md5( microtime() . rand() ),
                );
                $addons_count++;
                $cart_item_data['addon_count'] = array(
                    'value' => esc_attr($addons_count),
                    'unique_key' => md5( microtime() . rand() ),
                );
            }
        }
    }
    unset($_SESSION['addons']);
    return $cart_item_data;
}
//print_r($_SESSION['addons']);
//echo 'test';

?>
