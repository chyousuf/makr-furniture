<?php
    session_start();
    //$finish_price = '10'; //add 10 percent of product price when select premium finish
    $finish_price = $_SESSION['attribute_finish_price1'];
    $pulls_price = '0'; //add $22 per pull
    //$pedestal_price = '225'; //add $225 per pedestal
    $pedestal_price = $_SESSION['attribute_pedestal_price1'];
    $door_pulls_price = '0'; //add $22 per pull
    //$grommet_color_price = '32'; //add $32 per grommet
    $grommet_color_price = $_SESSION['attribute_grommet_color_price1'];

    /************************************
        Dimension fields value Start
    ************************************/
    // $string1 = $_POST['dimension'];
    // $sku_string = explode('__', $string1, 2)[1];
    // $price_string = explode('__', $sku_string, 2)[1];
    // $pulls_string1 = explode('__', $price_string, 2)[1];
    // $pulls_pedestal_string1 = explode('__', $pulls_string1, 2)[1];
    // $lock_string1 = explode('__', $pulls_pedestal_string1, 2)[1];
    // $lock_pedestal_string = explode('__', $lock_string1, 2)[1];
    // $dimension = strtok($string1, '__');
    // $sku = strtok($sku_string, '__');
    // $price = strtok($price_string, '__');
    // $pulls_string = strtok($pulls_string1, '__');
    // $pulls_pedestal_string = strtok($pulls_pedestal_string1, '__');
    // $lock_string = strtok($lock_string1, '__');
    // $lock_pedestal_string = explode('__', $lock_string1, 2)[1];
    $string1 = $_POST['dimension'];
    if($string1 != 'Dimension'){
        $sku_string = explode('__', $string1, 2)[1];
        $price_string = explode('__', $sku_string, 2)[1];
        $pulls_string1 = explode('__', $price_string, 2)[1];
        $pulls_pedestal_string1 = explode('__', $pulls_string1, 2)[1];
        $lock_string1 = explode('__', $pulls_pedestal_string1, 2)[1];
        $lock_pedestal_string = explode('__', $lock_string1, 2)[1];
        $coat_hooks1 = explode('__', $lock_pedestal_string, 2)[1];
        $coat_rod1 = explode('__', $coat_hooks1, 2)[1];
        $dimension = strtok($string1, '__');
        $sku = strtok($sku_string, '__');
        $price = strtok($price_string, '__');
        $pulls_string = strtok($pulls_string1, '__');
        $pulls_pedestal_string = strtok($pulls_pedestal_string1, '__');
        $lock_string = strtok($lock_string1, '__');
        $lock_pedestal_string = strtok($lock_pedestal_string, '__');
        $coat_hooks = strtok($coat_hooks1, '__');
        $coat_rod = explode('__', $coat_hooks1, 2)[1];
    }
    /***********************************
        Dimension Fields Value End
    ***********************************/
    $add_pedestal = $_POST['add_pedestal'];
    $door_pulls_type = $_POST['door_pulls_type'];
    $door_pulls_quantity = $_POST['door_pulls_quantity'];
    $fabric = $_POST['fabric'];
    $finish = $_POST['finish'];
    $grommet_color = $_POST['grommet_color'];
    $grommet_orientation = $_POST['grommet_orientation'];
    $orientation = $_POST['orientation'];
    $pedestal_orientation = $_POST['pedestal_orientation'];
    $specify_shelves = $_POST['specify_shelves'];
    $pedestal_pulls_type = $_POST['pedestal_pulls_type'];
    $pulls_quantity = $_POST['pulls_quantity'];
    $pedestal_type = $_POST['pedestal_type'];
    $pedestal_quantity = $_POST['pedestal_quantity'];
    $bases1 = $_POST['bases'];
    $addons = $_POST['addons'];
    if($bases1 != 'Bases' && $bases1 != 'null'){
        $bases_id = explode('__', $bases1, 2)[1];
        $bases = strtok($bases1, '__');
    }
    //$product_id = $_SESSION['product_id'];
    if($string1 != 'Dimension'){
        if($dimension != 'Dimension'){
            // echo $_SESSION['dimension'] = $_POST['dimension'];
            $_SESSION['dimension'] = $dimension;
            $_SESSION['sku'] = $sku;
            $_SESSION['product_price'] = $price;
            $_SESSION['no_of_pulls'] = $pulls_string;
            $_SESSION['no_of_pulls_pedestal'] = $pulls_pedestal_string;
            $_SESSION['no_of_lock'] = $lock_string;
            $_SESSION['no_of_lock_pedestal'] = $lock_pedestal_string;
            $_SESSION['no_of_coat_hooks'] = $coat_hooks;
            $_SESSION['no_of_coat_rod'] = $coat_rod;
            echo '<p class="price mb-0"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>'.$_SESSION['product_price'].'</span></p>';
            echo '<span class="sku_wrapper"> <span class="sku code">'.$_SESSION['sku'].'</span></span>';
            // echo '<br>';
        }
    } if($add_pedestal != 'Add Pedestal'){
         $_SESSION['add_pedestal'] = $_POST['add_pedestal'];
         // echo '<br>';
    } if($door_pulls_type != 'Door Pulls Type'){
        $_SESSION['door_pulls_type'] = $_POST['door_pulls_type'];
        // echo '<br>';
        $_SESSION['door_pulls_quantity'] = $door_pulls_quantity;
        if($door_pulls_quantity != '0'){
            if ( strstr( $_SESSION['door_pulls_type'], '*' ) ) {
                $door_pulls_premium_price = $door_pulls_quantity * $door_pulls_price;
                $_SESSION['door_pulls_premium_price'] = $door_pulls_premium_price;
            } else {
                $_SESSION['door_pulls_premium_price'] = '0';
            }
        }
    } if($fabric != 'Fabric'){
        $_SESSION['fabric'] = $_POST['fabric'];
        // echo '<br>';
    } if($finish != 'Finish'){
        $_SESSION['finish'] = $_POST['finish'];
        // echo '<br>';
        if ( strstr( $_SESSION['finish'], '*' ) ) {
            'finish is premium';
            $_SESSION['finish_premium_price'] = $finish_price;
        } else {
            $_SESSION['finish_premium_price'] = '0';
        }
        // echo '<br>';
    } if($grommet_color != 'Grommet Color'){
        $_SESSION['grommet_color'] = $_POST['grommet_color'];
        // echo '<br>';
        $_SESSION['grommet_color_price'] = $grommet_color_price;
    }  else {$_SESSION['grommet_color_price'] = '0';}
    if($grommet_orientation != 'Grommet Orientation'){
        $_SESSION['grommet_orientation'] = $_POST['grommet_orientation'];
        // echo '<br>';
    } if($orientation != 'Orientation'){
        $_SESSION['orientation'] = $_POST['orientation'];
        // echo '<br>';
    } if($pedestal_orientation != 'Pedestal Orientation'){
        $_SESSION['pedestal_orientation'] = $_POST['pedestal_orientation'];
        // echo '<br>';
    }
    if($specify_shelves != 'Specify Shelves Orientation' && $specify_shelves != 'Shelves Orientation'){
        $_SESSION['specify_shelves'] = $_POST['specify_shelves'];
    } if($pedestal_pulls_type != 'Pedestal Pulls Type'){
        $_SESSION['pedestal_pulls_type'] = $_POST['pedestal_pulls_type'];
        // echo '<br>';
        if ( strstr( $_SESSION['pedestal_pulls_type'], '*' ) ) {
            'pedestal is premium';
            $_SESSION['pulls_quantity'] = $pulls_quantity;
            if($pulls_quantity != '0'){
                if ( strstr( $_SESSION['pedestal_pulls_type'], '*' ) ) {
                    $pulls_price = $pulls_quantity * $pulls_price;
                    $_SESSION['pulls_premium_price'] = $pulls_price;
                } else {
                    $_SESSION['pulls_premium_price'] = '0';
                }
            }
        } else {
            $_SESSION['pedestal_premium_price'] = '0';
        }
        // echo '<br>';
    } if($pedestal_type != 'Pedestal Type' && $pedestal_type != 'null'){
        $_SESSION['pedestal_type'] = $_POST['pedestal_type'];
        // echo '<br>';
        $_SESSION['pedestal_quantity'] = $pedestal_quantity;
        if($pedestal_quantity != '0'){
            $pedestal_price = $pedestal_quantity * $pedestal_price;
            $_SESSION['pedestal_premium_price'] = $pedestal_price;
        }
    } if($bases1 != 'Bases' && $bases1 != 'null'){
        $_SESSION['bases'] = $bases;
        $_SESSION['bases_id'] = $bases_id;
    }
    // $addons_count = count($addons);
    // $addons_count = 0;
    // foreach($addons as $add){
    //     if($add != 'empty'){
    //         echo $_SESSION['addontitle-'.$addons_count] = strtok($add, '__');
    //         echo $addons_count;
    //         $addons_count++;
    //     }
    // }
    // echo $_SESSION['addons_count'] = $addons_count;
    $_SESSION['addons'] = $addons;
    //print_r($_SESSION['addons']);
    // foreach($_SESSION['addons'] as $add){
    //     $add1 = explode('__', $add, 2)[1];
    //     $add2 = explode('__', $add1, 2)[1];
    //     $add3 = explode('__', $add2, 2)[1];
    //     strtok($add, '__').'<br>';
    //     strtok($add1, '__').'<br>';
    //     strtok($add3, '__').'<br>';
    // }
?>
