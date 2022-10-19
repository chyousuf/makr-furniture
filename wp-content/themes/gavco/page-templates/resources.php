<?php
/*
    * Template Name: Resources
    */
get_header();
    $id = get_the_ID();
    get_template_part( 'inc/page-banner' );
    $current_user = wp_get_current_user();
    $current_user_email = $current_user->user_email;
    $current_user_username = $current_user->display_name;
    $current_user_id = $current_user->ID;
    $user = get_userdata($current_user_id);
    // Get all the user roles as an array.
    // if(!empty($user)){
    // $user_roles = $user->roles;
    //     if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) {
    //         $grid_class = 'col-md-6 col-xl-3';
    //         $grid_padding = '0';
    //     } else {
    //         $grid_class = 'col-lg-4 col-md-6';
    //         $grid_padding = 'pl-auto pl-md-5';
    //     }
    // } else {
    //     $grid_class = 'col-lg-4 col-md-6';
    // } 
    $grid_class = 'col-md-3 col-xl-3'; ?>
    <main id="main">
        <div class="block resources">
            <div class="container">
                <div class="row">
                    <?php
                    //if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) { ?>
                        <div class="<?php echo $grid_class; ?> col-12 pl-auto product-sheet mb-5">
                            <h3 class="text-left">Education Brochures</h3>
                            <ul>
                                <?php if( have_rows('marketing') ):
                                    while ( have_rows('marketing') ) : the_row();
                                        $file_name = get_sub_field('file_name');
                                        $attachment_id = get_sub_field('file');
                                        $attachment_url = wp_get_attachment_url($attachment_id);
                                        $pathinfo = pathinfo( get_attached_file($attachment_id));
                                        $filetype = $pathinfo['extension']; ?>
                                        <li><a href="<?php if(!empty($attachment_url)){echo $attachment_url;} else {echo '#';} ?>" target="_blank"><?php echo $file_name.'.pdf'; ?></a></li>
                                    <?php endwhile;
                                endif; ?>
                            </ul>
                        </div>
                        <div class="<?php echo $grid_class; ?> col-12 pl-auto product-sheet mb-5">
                            <h3 class="text-left">Price Lists</h3>
                            <ul>
                                <?php if( have_rows('product_sheet') ):
                                    while ( have_rows('product_sheet') ) : the_row();
                                        $file_name = get_sub_field('file_name');
                                        $attachment_id = get_sub_field('file');
                                        $attachment_url = wp_get_attachment_url($attachment_id);
                                        $pathinfo = pathinfo( get_attached_file($attachment_id));
                                        $filetype = $pathinfo['extension']; ?>
                                        <li><a href="<?php if(!empty($attachment_url)){echo $attachment_url;} else {echo '#';} ?>" target="_blank"><?php echo $file_name.'.pdf'; ?></a></li>
                                    <?php endwhile;
                                endif; ?>
                            </ul>
                        </div>
                    <?php //} ?>
                    <div class="<?php echo $grid_class; ?> col-12 product-sheet mb-5">
                        <h3 class="text-left">Finishes & Options</h3>
                        <ul>
                            <?php if( have_rows('material_information') ):
                                while ( have_rows('material_information') ) : the_row();
                                    $file_name = get_sub_field('file_name');
                                    $attachment_id = get_sub_field('file');
                                    $attachment_url = wp_get_attachment_url($attachment_id);
                                    $pathinfo = pathinfo( get_attached_file($attachment_id));
                                    $filetype = $pathinfo['extension']; ?>
                                    <li><a href="<?php if(!empty($attachment_url)){echo $attachment_url;} else {echo '#';} ?>" target="_blank"><?php echo $file_name.'.pdf'; ?></a></li>
                                <?php endwhile;
                            endif; ?>
                        </ul>
                    </div>
                    <div class="<?php echo $grid_class; ?> col-12 downloads mb-5">
                        <h3 class="text-left">The Fine Print</h3>
                        <ul>
                            <?php if( have_rows('downloads') ):
                                while ( have_rows('downloads') ) : the_row();
                                    $file_name = get_sub_field('file_name');
                                    $attachment_id = get_sub_field('file');
                                    $attachment_url = wp_get_attachment_url($attachment_id);
                                    $pathinfo = pathinfo( get_attached_file($attachment_id));
                                    $filetype = $pathinfo['extension']; ?>
                                    <li><a href="<?php if(!empty($attachment_url)){echo $attachment_url;} else {echo '#';} ?>" target="_blank"><?php echo $file_name.'.pdf'; ?></a></li>
                                <?php endwhile;
                            endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php get_footer(); ?>