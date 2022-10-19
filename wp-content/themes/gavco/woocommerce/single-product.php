<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$product_id = get_the_ID();
$_SESSION['product_id'] = $product_id;
get_header();
//get_template_part( 'inc/page-banner' );
global $post;
$terms = get_the_terms( $post->ID, 'product_cat' );
foreach ($terms as $term) {
    $cat_id = $term->term_id;
    $cat_name = $term->name;
    $parentcats = get_ancestors($cat_id, 'product_cat');
    if(empty($parentcats)){
        $cat_name1 = $cat_name; //get parent cat name
    }
}
$image_link = get_field('banner_image');
$image_title = get_field('title');
if(empty($image_link)){
    foreach ($terms as $term) {
        $cat_id = $term->term_id;
        $cat_name = $term->name;
        $image_link = get_field('category_banner',$term->taxonomy.'_'.$cat_id);
        if(!empty($image_link)){break;}
    }
    if(empty($image_link)){
        $image_link = home_url().'/wp-content/themes/gavco/images/banner2new.jpg';
    }
} 
$banner_video_link1 = get_field('banner_video_link');
preg_match('/src="(.+?)"/', $banner_video_link1, $matches);
$banner_video_link = $matches[1];
?>
<div class="banner product-banner product-banner-video">
    <?php if(!empty($banner_video_link)){ ?>
        <style type="text/css">
            .product-banner-video iframe{
                width: 100%;
                /*height: 546px;*/
                border:none;
            }
            .iframe-outer{
                /*height: 600px;*/
                overflow: hidden;
            }
			/*@media only screen and (min-width:1399px){
                .iframe-outer{
                    height: 750px;
                }
            }
            @media only screen and (min-width:768px) and (max-width:1199px){
                .iframe-outer{
                    height: 380px;
                }
            }*/
             /*@media only screen and (max-width:767px){
               .iframe-outer{
                    height: 250px;
                } 
            } */
        </style>
        <div class="iframe-outer">
            <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="<?php echo $banner_video_link; ?>&autoplay=1&loop=1&autopause=0&muted=1&controls=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
        </div>

        <!-- <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="<?php //echo $banner_video_link; ?>&autoplay=1&loop=1&autopause=0&muted=1&controls=0" frameborder="0" allow="autoplay"></iframe></div> -->
    <?php } else { ?>
        <img src="<?php echo $image_link; ?>" alt="Banner IMage Here">
        <div class="caption container">
            <h1><?php echo $cat_name1; ?></h1>
        </div>
    <?php } ?>
</div>
<!-- <script type="text/javascript">
    jQuery(window).load(function() {
        jQuery(".product-banner-video iframe").trigger("click");
    });
</script> -->
<?php while ( have_posts() ) : the_post(); ?>
    <main id="main">
        <div class="block pb-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-12">
                        <div class="pickachose-slider">
                            <div class="large-images mask">
                                <div class="slideset">
                                    <?php
                                        global $product;
                                        $attachment_ids = $product->get_gallery_attachment_ids();
                                        $attachment_count = count($attachment_ids);
                                        if(empty($attachment_ids)){
                                            $Product_id = $product->get_id();
                                            $product_thumb = get_the_post_thumbnail_url();
                                            if(!empty($product_thumb)){ ?>
                                                <div class="slide"><img src="<?php echo $product_thumb; ?>" alt=""></div>
                                            <?php } else { ?>
                                                <div class="slide"><img src="<?php echo get_template_directory_uri(); ?>'/images/detailthumbnail.png ?>" alt=""></div>
                                            <?php }
                                        } else { 
                                            $Product_id = $product->get_id();
                                            $product_thumb = get_the_post_thumbnail_url(); ?>
                                            <div class="slide"><img src="<?php echo $product_thumb; ?>" alt=""></div>
                                            <?php foreach( $attachment_ids as $attachment_id ) {
                                                $image_link = wp_get_attachment_url( $attachment_id ); ?>
                                                <div class="slide"><img src="<?php echo $image_link; ?>" alt=""></div>
                                            <?php }
                                        }
                                    ?>
                                </div>
                            </div>
                            <?php if($attachment_count > 0){ ?>
                                <div class="thumbnails"></div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                    $current_user = wp_get_current_user();
                    $current_user_id = $current_user->ID;
                    $user = get_userdata($current_user_id);
                    $user_roles = $user->roles;
                    if(empty($user_roles)){
                        $user_roles = array(
                            '0' => 'customer',
                        );
                    }
                    if ( in_array( 'dealer', $user_roles, true ) || in_array( 'administrator', $user_roles, true )) { $user_class = 'admin-dealer'; }
                    else {$user_class = '';} ?>
                    <div class="col-md-7 col-12 product-detail <?php echo $user_class; ?>">
                        <?php wc_get_template_part( 'content', 'single-product' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php endwhile;

get_footer();
