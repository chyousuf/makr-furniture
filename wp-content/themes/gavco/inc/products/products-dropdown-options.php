<div class="product-option">
    <?php
        $options1 = array('hide_empty' => false);
        $attr_add_pedestal = get_terms( 'pa_add-pedestal', $options1);
        $attr_door_pulls_type = get_terms( 'pa_door-pulls-type', $options1 );
        $attr_fabric = get_terms( 'pa_fabric', $options1 );
        $attr_finish = get_terms( 'pa_finish', $options1 );
        $attr_grommet_color = get_terms( 'pa_grommet-color', $options1 );
        $attr_grommet_orientation = get_terms( 'pa_grommet-orientation', $options1 );
        $attr_orientation = get_terms( 'pa_orientation', $options1 );
        $attr_pedestal_orientation = get_terms( 'pa_pedestal-orientation', $options1 );
        $attr_specify_shelves = get_terms( 'pa_shelves-orientation', $options1 );
        $attr_pedestal_pulls_type = get_terms( 'pa_pedestal-pulls-type', $options1 );
        $attr_pedestal_type = get_terms( 'pa_pedestal-type', $options1 );
        $attr_bases = get_terms( 'pa_bases', $options1 );
        //print_r($attr_bases);

        global $wpdb;
        $attribute_taxonomies = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies WHERE attribute_name != '' ORDER BY attribute_name ASC;" );
        set_transient( 'wc_attribute_taxonomies', $attribute_taxonomies );
        $attribute_taxonomies = array_filter( $attribute_taxonomies  ) ;
        //print("<pre>");print_r($attribute_taxonomies);print("</pre>");
        $product_attributes = get_field('product_attributes');
        if( $product_attributes ):
            foreach( $product_attributes as $pattributes ):
                if($pattributes == 'Add Pedestal'){
                    $attr_add_pedestal_label = $attribute_taxonomies[0]->attribute_label;
                }
                if($pattributes == 'Conference Table Bases'){
                    $attr_bases_label = $attribute_taxonomies[1]->attribute_label;
                }
                if($pattributes == 'Door Pulls Type'){
                    $attr_door_pulls_type_label = $attribute_taxonomies[2]->attribute_label;
                }
                if($pattributes == 'Fabric'){
                    $attr_fabric_label = $attribute_taxonomies[3]->attribute_label;
                }
                if($pattributes == 'Finish'){
                    $attr_finish_label = $attribute_taxonomies[4]->attribute_label;
                }
                if($pattributes == 'Grommet Color'){
                    $attr_grommet_color_label = $attribute_taxonomies[5]->attribute_label;
                }
                if($pattributes == 'Grommet Orientation'){
                    $attr_grommet_orientation_label = $attribute_taxonomies[6]->attribute_label;
                }
                if($pattributes == 'Orientation'){
                    $attr_orientation_label = $attribute_taxonomies[7]->attribute_label;
                }
                if($pattributes == 'Pedestal Orientation'){
                    $attr_pedestal_orientation_label = $attribute_taxonomies[8]->attribute_label;
                }
                if($pattributes == 'Pedestal Pulls Type'){
                    $attr_pedestal_pulls_type_label = $attribute_taxonomies[9]->attribute_label;
                }
                if($pattributes == 'Pedestal Type'){
                    $attr_pedestal_type_label = $attribute_taxonomies[10]->attribute_label;
                }
                if($pattributes == 'Shelves Orientation'){
                    $attr_shelves_label = $attribute_taxonomies[11]->attribute_label;
                }
            endforeach;
        endif;
    ?>

    <form  name="productoptions" id="productoptionsform" method="post">
        <div class="field-froup">
            <div class="row">
                <!-- DROPDOWN OPTION FOR DIMENSION -->
                <div class="col-lg-6 col-12">
                    <span class="ctm-select">
                        <select class="form-control" name="dimension" id="dimension" onchange="SubmitFormData();">
                            <option class="d-none">Dimension</option>
                            <?php if( have_rows('basic') ):
                                while ( have_rows('basic') ) : the_row();
                                    //Dimension Value
                                    if(!empty(get_sub_field('dimension'))){
                                        $_dimension = get_sub_field('dimension');
                                    } else {$_dimension = 'Dimension';}
                                    //SKU Value
                                    if(!empty(get_sub_field('general_sku'))){
                                        $_sku = get_sub_field('general_sku');
                                    } else {$_sku = 'sku';}
                                    //Price Value
                                    if(!empty(get_sub_field('price'))){
                                        $_price = get_sub_field('price');
                                    } else {$_price = '0';}
                                    //no of pulls Value
                                    if(!empty(get_sub_field('no_of_pulls'))){
                                        $_numpulls = get_sub_field('no_of_pulls');
                                    } else {$_numpulls = '0';}
                                    //No of pulls Value if pedestal selected
                                    if(!empty(get_sub_field('no_of_pulls_if_pedestal_added'))){
                                        $_pullpedestal = get_sub_field('no_of_pulls_if_pedestal_added');
                                    } else {$_pullpedestal = '0';}
                                    //No of Lock Value
                                    if(!empty(get_sub_field('no_of_locks'))){
                                        $_numlock = get_sub_field('no_of_locks');
                                    } else {$_numlock = '0';}
                                    //No of Lock value if pedestal selected
                                    if(!empty(get_sub_field('no_of_locks_if_pedestal_added'))){
                                        $_lockpedestal = get_sub_field('no_of_locks_if_pedestal_added');
                                    } else {$_lockpedestal = '0';}
                                    if(!empty(get_sub_field('no_of_coat_hook'))){
                                        $coat_hooks = get_sub_field('no_of_coat_hook');
                                    } else {$coat_hooks = '0';}
                                    //No of Closet Rod
                                    if(!empty(get_sub_field('no_of_closet_rod'))){
                                        $coat_rod = get_sub_field('no_of_closet_rod');
                                    } else {$coat_rod = '0';}
                                    ?>
                                   <!--  <option value="<?php //the_sub_field('dimension'); ?>_<?php //the_sub_field('general_sku'); ?>_<?php //the_sub_field('price'); ?>"><?php //the_sub_field('dimension'); ?></option> -->
                                   <option value="<?php echo $_dimension.'__'.$_sku.'__'.$_price.'__'.$_numpulls.'__'.$_pullpedestal.'__'.$_numlock.'__'.$_lockpedestal.'__'.$coat_hooks.'__'.$coat_rod; ?>"><?php the_sub_field('dimension'); ?></option>
                                <?php endwhile;
                            endif; ?>
                        </select>
                    </span>
                    <input type="hidden" name="dimensionvalue" value="abc" id="changevalue">
                </div>
                <?php
                    // CHECKBOXES OPTIONS FOR PRODUCTS ATTRIBUTES
                    $product_attributes = get_field('product_attributes');
                    if( $product_attributes ):
                        foreach( $product_attributes as $pattributes ):
                            if($pattributes == 'Add Pedestal'){ ?>
                                <!-- DROPDOWN OPTION FOR Add Pedestal -->
                                <div class="col-lg-6 col-12">
                                    <span class="ctm-select">
                                        <select class="form-control" name="add_pedestal" id="add_pedestal" onchange="SubmitFormData();">
                                            <option><?php echo $attr_add_pedestal_label; ?></option>
                                            <?php foreach($attr_add_pedestal as $add_pedestal){ ?>
                                                <option value="<?php echo $add_pedestal->name; ?>">
                                                    <?php echo $add_pedestal->name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </span>
                                </div>
                            <?php } if($pattributes == 'Pedestal Type'){ ?>
                                <!-- DROPDOWN OPTION FOR Pedestal Type -->
                                <div class="col-lg-6 col-12">
                                    <span class="ctm-select">
                                        <select class="form-control" name="pedestal_type" id="pedestal_type" onchange="SubmitFormData();">
                                            <option value="Pedestal Type"><?php echo $attr_pedestal_type_label; ?></option>
                                            <?php foreach($attr_pedestal_type as $pedestal_type){ ?>
                                                <option value="<?php echo $pedestal_type->name; ?>">
                                                    <?php echo $pedestal_type->name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </span>
                                    <input class="form-control pedestal-quantity mb-2" id="pedestal_quantity" type="number" placeholder="Number Of Pulls" name="pedestal_quantity" value="1" onchange="SubmitFormData();" min="1">
                                </div>
                            <?php } if($pattributes == 'Door Pulls Type'){ ?>
                                <!-- DROPDOWN OPTION FOR Door Pulls Type -->
                                <div class="col-lg-6 col-12">
                                    <span class="ctm-select">
                                        <select class="form-control" name="door_pulls_type" id="door_pulls_type" onchange="SubmitFormData();">
                                            <option value="Door Pulls Type"><?php echo $attr_door_pulls_type_label; ?></option>
                                            <?php foreach($attr_door_pulls_type as $door_pulls_type){
                                                $door_name = $door_pulls_type->name;
                                                $door_name_new = strtok($door_name, '*');
                                                if ( strstr($door_name , '*' ) ) {
                                                    $door_label = ' (Premium)';
                                                } else {
                                                    $door_label = '';
                                                } ?>
                                                <option value="<?php echo $door_pulls_type->name; ?>">
                                                    <?php echo $door_name_new.$door_label; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </span>
                                    <input class="form-control door-pull-quantity mb-2" id="door_pull_quantity" type="number" placeholder="Number Of Pulls" name="door_pull_quantity" value="1" onchange="SubmitFormData();" min="1">
                                </div>
                            <?php } if($pattributes == 'Fabric'){ ?>
                                <!-- DROPDOWN OPTION FOR Fabric -->
                                <div class="col-lg-6 col-12">
                                    <span class="ctm-select">
                                        <select class="form-control" name="fabric" id="fabric" onchange="SubmitFormData();">
                                            <option><?php echo $attr_fabric_label; ?></option>
                                            <?php foreach($attr_fabric as $fabric){ ?>
                                                <option value="<?php echo $fabric->name; ?>">
                                                    <?php echo $fabric->name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </span>
                                </div>
                            <?php } if($pattributes == 'Finish'){ ?>
                                <!-- DROPDOWN OPTION FOR Finish -->
                                <div class="col-lg-6 col-12">
                                    <span class="ctm-select">
                                        <select class="form-control" name="finish" id="finish" onchange="SubmitFormData();">
                                            <option><?php echo $attr_finish_label; ?></option>
                                            <?php foreach($attr_finish as $finish){
                                                $finish_name = $finish->name;
                                                $finish_name_new = strtok($finish_name, '*');
                                                if ( strstr($finish_name , '*' ) ) {
                                                    $finish_label = ' (Premium)';
                                                } else {
                                                    $finish_label = '';
                                                } ?>
                                                <option value="<?php echo $finish->name; ?>">
                                                    <?php echo $finish_name_new.$finish_label; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </span>
                                </div>
                            <?php } if($pattributes == 'Grommet Color'){ ?>
                                <!-- DROPDOWN OPTION FOR Grommet Color -->
                                <div class="col-lg-6 col-12">
                                    <span class="ctm-select">
                                        <select class="form-control" name="grommet_color" id="grommet_color" onchange="SubmitFormData();">
                                            <option value="Grommet Color"><?php echo $attr_grommet_color_label; ?></option>
                                            <?php foreach($attr_grommet_color as $grommet_color){ ?>
                                                <option value="<?php echo $grommet_color->name; ?>">
                                                    <?php echo $grommet_color->name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </span>
                                </div>
                            <?php } if($pattributes == 'Grommet Orientation'){ ?>
                                <!-- DROPDOWN OPTION FOR Grommet Orientation -->
                                <div class="col-lg-6 col-12">
                                    <span class="ctm-select">
                                        <select class="form-control" name="grommet_orientation" id="grommet_orientation" onchange="SubmitFormData();">
                                            <option><?php echo $attr_grommet_orientation_label; ?></option>
                                            <?php foreach($attr_grommet_orientation as $grommet_orientation){ ?>
                                                <option value="<?php echo $grommet_orientation->name; ?>">
                                                    <?php echo $grommet_orientation->name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </span>
                                </div>
                            <?php } if($pattributes == 'Orientation'){ ?>
                                <!-- DROPDOWN OPTION FOR Orientation -->
                                <div class="col-lg-6 col-12">
                                    <span class="ctm-select">
                                        <select class="form-control" name="orientation" id="orientation" onchange="SubmitFormData();">
                                            <option><?php echo $attr_orientation_label; ?></option>
                                            <?php foreach($attr_orientation as $orientation){ ?>
                                                <option value="<?php echo $orientation->name; ?>">
                                                    <?php echo $orientation->name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </span>
                                </div>
                            <?php } if($pattributes == 'Pedestal Orientation'){ ?>
                                <!-- DROPDOWN OPTION FOR Pedestal Orientation -->
                                <div class="col-lg-6 col-12">
                                    <span class="ctm-select">
                                        <select class="form-control" name="pedestal_orientation" id="pedestal_orientation" onchange="SubmitFormData();">
                                            <option><?php echo $attr_pedestal_orientation_label; ?></option>
                                            <?php foreach($attr_pedestal_orientation as $pedestal_orientation){ ?>
                                                <option value="<?php echo $pedestal_orientation->name; ?>">
                                                    <?php echo $pedestal_orientation->name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </span>
                                </div>
                            <?php } if($pattributes == 'Shelves Orientation'){ ?>
                                <!-- DROPDOWN OPTION FOR Pedestal Orientation -->
                                <div class="col-lg-6 col-12">
                                    <span class="ctm-select">
                                        <select class="form-control" name="specify_shelves" id="specify_shelves" onchange="SubmitFormData();">
                                            <option><?php echo $attr_shelves_label; ?></option>
                                            <?php foreach($attr_specify_shelves as $attr_specify_shelves1){ ?>
                                                <option value="<?php echo $attr_specify_shelves1->name; ?>">
                                                    <?php echo $attr_specify_shelves1->name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </span>
                                </div>
                            <?php } if($pattributes == 'Pedestal Pulls Type'){ ?>
                                <!-- DROPDOWN OPTION FOR Pedestal Pulls Type -->
                                <div class="col-lg-6 col-12">
                                    <span class="ctm-select">
                                        <select class="form-control" name="pedestal_pulls_type" id="pedestal_pulls_type" onchange="SubmitFormData();">
                                            <option value="Pedestal Pulls Type"><?php echo $attr_pedestal_pulls_type_label; ?></option>
                                            <?php foreach($attr_pedestal_pulls_type as $pedestal_pulls_type){
                                                $p_pull_name = $pedestal_pulls_type->name;
                                                $p_pull_name_new = strtok($p_pull_name, '*');
                                                if ( strstr($p_pull_name , '*' ) ) {
                                                    $p_pull_name_label = ' (Premium)';
                                                } else {
                                                    $p_pull_name_label = '';
                                                } ?>
                                                <option value="<?php echo $pedestal_pulls_type->name; ?>">
                                                    <?php echo $p_pull_name_new.$p_pull_name_label; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </span>
                                    <input class="form-control pulls-quantity" id="pulls_quantity" type="number" placeholder="Number Of Pulls" name="pulls_quantity" value="1" onchange="SubmitFormData();" min="1">
                                </div>
                            <?php } if($pattributes == 'Conference Table Bases'){ ?>
                                <!-- DROPDOWN OPTION FOR Pedestal Orientation -->
                                <div class="col-lg-6 col-12">
                                    <span class="ctm-select">
                                        <select class="form-control" name="bases" id="bases" onchange="SubmitFormData();">
                                            <option><?php echo $attr_bases_label; ?></option>
                                            <?php foreach($attr_bases as $attr_bases1){ ?>
                                                <option value='<?php echo $attr_bases1->name.'__'.$attr_bases1->term_id; ?>'>
                                                    <?php echo $attr_bases1->name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </span>
                                </div>
                        <?php }
                        endforeach;
                    endif; ?>
            </div>
        </div>
        <?php $product_id = get_the_ID();
        $OPTIONS_args = array(
            'post_type' => 'productsoptions',
            'post_status' => 'publish',
            'posts_per_page' => '-1',
            'order'=>'ASC',
        );
        $OPTIONS_data = new WP_Query($OPTIONS_args);
        if($OPTIONS_data->have_posts()): ?>
            <div class="field-froup">
                <h5>Options:</h5>
                <ul class="check-list">
                    <?php
                    $count = 0;
                    $current_user = wp_get_current_user();
                    $current_user_id = $current_user->ID;
                    $user = get_userdata($current_user_id);
                    $user_roles = $user->roles;
                    if(empty($user_roles)){
                        $user_roles = array(
                          '0' => 'customer',
                        );
                    }
                    while($OPTIONS_data->have_posts()): $OPTIONS_data->the_post();
                        $addons_product_list = get_field('select_products');
                        $list_count = count($addons_product_list);
                        if(!empty($addons_product_list)){
                            foreach($addons_product_list as $list){
                                if($product_id == $list){
                                    if($count == '0'){echo '<h5>Options:</h5>';}
                                    $count++;
                                    $addon_title = get_the_title();
                                    $addon_slug = basename(get_permalink());
                                    $addon_subheading = get_field('sub_heading');
                                    $addon_price = get_field('option_price');
                                    $addon_price_type = get_field('price_type');
                                    if(!empty($addon_price_type)){
                                        if ( $addon_price_type == 'percentage') {
                                            $addon_price_type_option = '%';
                                        } else{
                                            $addon_price_type_option = '';
                                        }
                                    }
                                    $quantity_option = get_field('set_quantity');
                                    if(!empty($quantity_option)){
                                        if ( in_array( 'Yes', $quantity_option, true )) {
                                            $quantity_limit = get_field('quantity_limit');
                                        }
                                    } ?>
                                    <li>
                                        <label id="<?php echo $addon_slug.'1'; ?>">
                                            <input type="checkbox" name="addon" id="addon" value="<?php echo $addon_title.'__'.$addon_price.$addon_price_type_option.'__'.$addon_slug; ?>" onchange="SubmitFormData();">
                                            <span class="custom-checkbox"></span>
                                            <span><?php echo $addon_title.' '.$addon_subheading; ?>
                                            <?php
                                            if($addon_slug != '1-7-8-inch-tops'){
                                            if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) { ?>
                                                <em>.................</em><b>$<?php echo $addon_price; ?></b></span>
                                            <?php } } ?>
                                            <?php
                                            if(!empty($quantity_option)){
                                                if ( in_array( 'Yes', $quantity_option, true )) { ?>
                                                    <!-- <input class="form-control <?php echo $addon_slug; ?> mb-2 d-none" id="<?php echo $addon_slug; ?>" type="number" placeholder="Number Of <?php echo $addon_title; ?>" name="<?php echo $addon_slug; ?>" value="1" min="1" max="<?php echo $quantity_limit; ?>" onchange="SubmitFormData();" onkeypress="restrictMinus(event);">
                                                    <span class="validity d-none">Quantity Must between 1 - <?php echo $quantity_limit; ?></span>
                                                    <script type="text/javascript">
                                                        function restrictMinus(e) {
                                                            var inputKeyCode = e.keyCode ? e.keyCode : e.which;
                                                            if (inputKeyCode != null) {
                                                                if (inputKeyCode == 45) e.preventDefault();
                                                            }
                                                        }
                                                    </script> -->
                                                    <span class="ctm-select ctm-select-number <?php echo $addon_slug; ?> mb-2 d-none">
                                                    <select class="form-control" name="<?php echo $addon_slug; ?>" id="<?php echo $addon_slug; ?>"  onchange="SubmitFormData();">
                                                    <?php
                                                    $qx = 1;
                                                    while($qx <= $quantity_limit){ ?>
                                                        <option value="<?php echo $qx; ?>">
                                                            <?php echo $qx; ?>
                                                        </option>
                                                    <?php $qx++;
                                                    } ?>
                                                    </select>
                                                    </span>
                                            <?php }
                                            } ?>
                                        </label>
                                    </li>
                                <?php }
                                $count++;
                            }
                        }
                    endwhile; ?>
                </ul>
            </div>
        <?php endif;
        wp_reset_postdata();
        if(isset($_POST['productoptions'])){echo 'submit';} ?>
        <input type="button" id="submitFormData" class="d-none" onclick="SubmitFormData();" value="Submit" name="submitFormData" />
    </form>
    <?php
        $dir_path = get_home_url().'/wp-content/themes/gavco/inc/products/product-dropdown-option-submit.php';
    ?>
    <script type="text/javascript">
        // jQuery(document).ready(function(){
        //     var hidden = jQuery("input[name='hidden_num']");
        //     jQuery('input[type="checkbox"]').click(function(){
        //         if(jQuery(this).is(":checked")){
        //             jQuery(this).addClass('checked');
        //             jQuery(".checked + .custom-checkbox + span + #hidden_num").removeClass("d-none");
        //         }
        //         else if(jQuery(this).is(":not(:checked)")){
        //             jQuery(".checked + .custom-checkbox + span + #hidden_num").addClass("d-none");
        //             jQuery(this).removeClass('checked');
        //         }
        //     });
        // });
        function SubmitFormData() {
            submit_form();
            // alert($("#addon").val());
            //alert($("#hidden_num").val());
            jQuery('#2-plug-in-power-2-data-points1 input[type="checkbox"]').click(function(){
                jQuery("#data-av-cutouts1 input[type='number']").removeClass("none");
                jQuery("#data-av-cutouts1 .validity").removeClass("none");
                jQuery("#data-av-cutouts1 .ctm-select-number").removeClass("none");
                if(jQuery(this).is(":checked")){
                    jQuery("#data-av-cutouts1 input[type='number']").addClass("none");
                    jQuery("#data-av-cutouts1 .validity").addClass("none");
                    jQuery("#data-av-cutouts1 .ctm-select-number").addClass("none");
                }
            });
            jQuery('#2-plug-in-power-points1 input[type="checkbox"]').click(function(){
                jQuery("#data-av-cutouts1 input[type='number']").removeClass("nones");
                jQuery("#data-av-cutouts1 .validity").removeClass("nones");
                jQuery("#data-av-cutouts1 .ctm-select-number").removeClass("nones");
                if(jQuery(this).is(":checked")){
                    jQuery("#data-av-cutouts1 input[type='number']").addClass("nones");
                    jQuery("#data-av-cutouts1 .validity").addClass("nones");
                    jQuery("#data-av-cutouts1 .ctm-select-number").addClass("nones");
                }
            });
            jQuery('#flip-up-doors1 input[type="checkbox"]').click(function(){
                jQuery("#technology-trough1 input[type='number']").removeClass("none");
                jQuery("#technology-trough1 .validity").removeClass("none");
                jQuery("#technology-trough1 .ctm-select-number").removeClass("none");
                if(jQuery(this).is(":checked")){
                    jQuery("#technology-trough1 input[type='number']").addClass("none");
                    jQuery("#technology-trough1 .validity").addClass("none");
                    jQuery("#technology-trough1 .ctm-select-number").addClass("none");
                }
            });
            var addons = [];
            $("input[type='number']").addClass("d-none");
            $(".validity").addClass("d-none");
            $.each($("input[name='addon']:checked"), function(){
                var data = $(this).val();
                var arr = data.split('__');
                var quantity = $("#"+arr[2]).val();
                jQuery(this).addClass('checked');
                jQuery(".checked + .custom-checkbox + span + ."+arr[2]).removeClass("d-none");
                jQuery(".checked + .custom-checkbox + span ."+arr[2]).removeClass("d-none");
                jQuery(".checked + .custom-checkbox + span + ."+arr[2]+"+ .validity").removeClass("d-none");
                jQuery(".checked + .custom-checkbox + span ."+arr[2]+"+ .validity").removeClass("d-none")
                var final_addon = $(this).val()+'__'+quantity;
                addons.push(final_addon);
            });
            if(addons.length === 0){
                addons[0]= 'empty';
            }
            if(jQuery.type($("#dimension").val()) != 'undefined'){
                var dimension = $("#dimension").val();
            } else {
                var dimension = 'Dimension';
            }
            if(jQuery.type($("#add_pedestal").val()) != 'undefined'){
                var add_pedestal = $("#add_pedestal").val();
            } else {var add_pedestal = 'Add Pedestal';}
            if(jQuery.type($("#door_pulls_type").val()) != 'undefined'){
                var door_pulls_type = $("#door_pulls_type").val();
            } else {var door_pulls_type = 'Door Pulls Type';}
            if(jQuery.type($("#door_pull_quantity").val()) != 'undefined'){
                var door_pulls_quantity = $("#door_pull_quantity").val();
            } else {var door_pulls_quantity = '1';}
            if(jQuery.type($("#fabric").val()) != 'undefined'){
                var fabric = $("#fabric").val();
            } else {var fabric = 'Fabric';}
            if(jQuery.type($("#finish").val()) != 'undefined'){
                var finish = $("#finish").val();
            } else {var finish = 'Finish';}
            if(jQuery.type($("#grommet_color").val()) != 'undefined'){
                var grommet_color = $("#grommet_color").val();
            } else {var grommet_color = 'Grommet Color';}
            if(jQuery.type($("#grommet_orientation").val()) != 'undefined'){
                var grommet_orientation = $("#grommet_orientation").val();
            } else {var grommet_orientation = 'Grommet Orientation';}
            if(jQuery.type($("#orientation").val()) != 'undefined'){
                var orientation = $("#orientation").val();
            } else {var orientation = 'Orientation';}
            if(jQuery.type($("#pedestal_orientation").val()) != 'undefined'){
                var pedestal_orientation = $("#pedestal_orientation").val();
            } else {var pedestal_orientation = 'Pedestal Orientation';}
            if(jQuery.type($("#specify_shelves").val()) != 'undefined'){
                var specify_shelves = $("#specify_shelves").val();
            } else {var specify_shelves = 'Specify Shelves Orientation';}
            if(jQuery.type($("#pedestal_pulls_type").val()) != 'undefined'){
                var pedestal_pulls_type = $("#pedestal_pulls_type").val();
            } else {var pedestal_pulls_type = 'Pedestal Pulls Type';}
            if(jQuery.type($("#pulls_quantity").val()) != 'undefined'){
                var pulls_quantity = $("#pulls_quantity").val();
            } else {var pulls_quantity = '1';}
            if(jQuery.type($("#pedestal_quantity").val()) != 'undefined'){
                var pedestal_quantity = $("#pedestal_quantity").val();
            } else {var pedestal_quantity = '1';}
            if(jQuery.type($("#pedestal_type").val()) != 'undefined' && jQuery.type($("#pedestal_type").val()) != 'null'){
                var pedestal_type = $("#pedestal_type").val();
            } else {var pedestal_type = 'Pedestal Type';}
            if(jQuery.type($("#bases").val()) != 'undefined' && jQuery.type($("#bases").val()) != 'null'){
                var bases = $("#bases").val();
            } else {var bases = 'Bases';}
            $.post("<?php echo $dir_path; ?>",{
                data: {
                    'action': 'cortez_get_terms',
                },
                dimension: dimension,
                add_pedestal: add_pedestal,
                door_pulls_type: door_pulls_type,
                door_pulls_quantity: door_pulls_quantity,
                fabric: fabric,
                finish: finish,
                grommet_color: grommet_color,
                grommet_orientation: grommet_orientation,
                orientation: orientation,
                pedestal_orientation: pedestal_orientation,
                specify_shelves: specify_shelves,
                pedestal_pulls_type: pedestal_pulls_type,
                pulls_quantity: pulls_quantity,
                pedestal_type: pedestal_type,
                pedestal_quantity: pedestal_quantity,
                bases: bases,
                addons: addons
            },
                function(data) {
                    $('#results').html(data);
                },
            );
        }
    </script>
</div>
<!-- <div id="results"></div> -->
<?php
    session_start();
    $final_dimension = $_SESSION['dimension'];
    if( have_rows('basic') ):
        while ( have_rows('basic') ) : the_row();
            $product_dimenision = get_sub_field('dimension');
            if($product_dimenision == $final_dimension){
                $_SESSION['sku'] = get_sub_field('general_sku');
                $_SESSION['product_price'] = get_sub_field('price'); ?>
                <!-- <p class="price mb-0"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span><?php //echo $_SESSION['product_price']; ?></span></p>
                <span class="sku_wrapper"> <span class="sku code"><?php //echo $_SESSION['sku']; ?></span></span> -->
            <?php }
        endwhile;
    endif;
?>
