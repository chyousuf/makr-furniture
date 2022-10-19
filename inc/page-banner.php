<?php if(is_shop() || is_page(40692) || is_page(184) || is_page(63292)){
    if(is_shop()){$id = '119';}
    if(is_page(40692)){$id = '40692';}
    if(is_page(184)){$id = '184';}
    if(is_page(184) || is_page(40692)){$overlay = 'overlay';}
    else {$overlay = '';}
    $title = get_field('page_heading',$id);
    if(empty($title)){$title = get_the_title();}
    $image = get_field('banner_image',$id); ?>
    <div class="banner product-banner <?php echo $overlay; ?>">
        <img src="<?php echo $image; ?>" alt="Banner IMage Here">
        <div class="caption container">
            <h1><?php echo $title; ?></h1>
        </div>
    </div>
<?php } ?>
<?php
if(!is_shop()){
if(is_product_category() || is_product() || !is_page() && !is_page(27) && !is_page(21) && !is_page(119) && !is_page(47512)){
    if(is_product_category() || is_product()){
        $id = '119';
    } else{
        $id = get_the_ID();
    }
    $image = get_field('banner_image',$id);
    if(is_product_category() || is_product()){
        $title = get_field('page_heading',$id);
    } else{
        $title = get_the_title($id);
    } ?>
    <div class="banner product-banner">
        <img src="<?php echo $image; ?>" alt="Banner IMage Here">
        <div class="caption container">
            <h1><?php echo $title; ?></h1>
        </div>
    </div>
<?php } }
if(is_page(27)){ ?>
    <div class="banner">
        <img src="<?php the_field('banner_image'); ?>" class="img-fluid" alt="">
    </div>
<?php } ?>
<?php if(is_page(21)){ ?>
    <div class="banner">
        <img src="<?php the_field('banner_image'); ?>" class="img-fluid" alt="">
    </div>
<?php } ?>
<?php if(is_page(47512)){ ?>
    <div class="banner">
        <img src="<?php the_field('banner_image'); ?>" class="img-fluid" alt="">
    </div>
<?php } ?>
<?php if(is_page() && !is_page(119) && !is_page(21) && !is_page(27) && !is_page(40692) && !is_page(184) && !is_page(47512) && !is_page(63292)){
    $id = get_the_ID();
    $title = get_the_title($id);
    $image = get_field('banner_image',$id); ?>
    <div class="banner">
        <div class="container p-0">
            <div class="row m-0">
                <div class="col-lg-8 offset-lg-4 p-0">
                    <img src="<?php echo $image; ?>" class="float-left" alt="Banner IMage Here">
                </div>
            </div>
        </div>
        <div class="caption container">
            <h1><?php echo $title; ?></h1>
        </div>
    </div>
<?php } ?>
