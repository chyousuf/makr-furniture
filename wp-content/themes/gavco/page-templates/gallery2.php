<?php
/*
    * Template Name: Gallery2
    */
get_header();
    $id = get_the_ID();
    get_template_part( 'inc/page-banner' ); 
    $is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');
    if($is_page_refreshed ) {
        session_start();
        session_unset($_SESSION['search-results-ids-array']);
        $_SESSION['search-results-ids-array'] = '';
        session_destroy($_SESSION['search-results-ids-array']);
    } ?>
    <main id="main">
        <div class="gallery-spinner">
            <div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
        <div class="block pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form role="search" method="get" class="search-gallery" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <div class="field">
                                <input placeholder="Search Gallery" name="s" class="input" type="search">
                                <input type="hidden" name="post_type" value="galleryimages" />
                                <button type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                        <div class="sidebar">
                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                <?php
                                $fields = get_fields(61265);
                                //print("<pre>");print_r($fields);print("</pre>");
                                //echo $fields['image_type'];
                                $gallery_cat = get_terms( 
                                    array(
                                        'taxonomy' => 'gallery-category',
                                        'hide_empty' => false,
                                        'parent' => 0,
                                    )
                                );
                                $gallery_tag = get_terms( 
                                    array(
                                        'taxonomy' => 'gallery_tags',
                                        'hide_empty' => false,
                                    )
                                ); 
                                //print("<pre>");print_r($gallery_cat);print("</pre>");
                                ?>
                                <form method="post" action="<?php echo get_page_link(11); ?>" class="w-100">
                                    <h2 id="clearfilter" class="d-none"><a href="javascript:void(0)">Clear Filters</a></h2>
                                    <h2>Products</h2>
                                    <div class="mt-3 mb-3">
                                        <?php foreach($gallery_cat as $gc){ 
                                            //$parent_term = get_term( $gc->parent, 'gallery-category' );
                                            //$parent_term_id = $parent_term->term_id;  
                                            $children = get_terms( 'gallery-category', array(
                                                'parent'    => $gc->term_id,
                                                'hide_empty' => false
                                            ) ); ?>
                                            <label class="d-block <?php if(!empty($children)){echo 'has-children';} ?>">
                                                <input type="checkbox" id="gallery-cat" name="gallery-cat" value="<?php echo $gc->term_id; ?>" onchange="gallerycategoryfunction(this)">
                                                <span class="custom-checkbox"></span>
                                                <span class="txt"><?php echo $gc->name; ?></span>
                                            </label>
                                            <?php 
                                            if(!empty($children)){ ?>
                                                <div class="child1"> 
                                                    <?php foreach($children as $ch){ 
                                                        $sub_children = get_terms( 'gallery-category', array(
                                                            'parent'    => $ch->term_id,
                                                            'hide_empty' => false
                                                        ) ); ?>
                                                        <label class="child <?php if(!empty($sub_children)){echo 'has-children';} ?>">
                                                            <input type="checkbox" id="gallery-cat" name="gallery-cat" value="<?php echo $ch->term_id; ?>" onchange="gallerycategoryfunction(this)">
                                                            <span class="custom-checkbox"></span>
                                                            <span class="txt"><?php echo $ch->name; ?></span>
                                                        </label>
                                                        <?php 
                                                        if(!empty($sub_children)){ ?>
                                                            <div class="child2"> 
                                                                <?php foreach($sub_children as $sc){ ?>
                                                                    <label class="child">
                                                                        <input type="checkbox" id="gallery-cat" name="gallery-cat" value="<?php echo $sc->term_id; ?>" onchange="gallerycategoryfunction(this)">
                                                                        <span class="custom-checkbox"></span>
                                                                        <span class="txt"><?php echo $sc->name; ?></span>
                                                                    </label>
                                                                <?php } ?>
                                                            </div>
                                                        <?php }
                                                    } ?>
                                                </div>
                                            <?php }
                                        } ?>
                                    </div>
                                    <h2>Applications</h2>
                                    <div class="mt-3 mb-3">
                                        <?php foreach($gallery_tag as $gt){ ?>
                                            <label class="d-block">
                                                <input type="checkbox" name="gallery-tag" value="<?php echo $gt->term_id; ?>" onchange="gallerycategoryfunction(this)">
                                                <span class="custom-checkbox"></span>
                                                <span class="txt"><?php echo $gt->name; ?></span>
                                            </label>
                                        <?php } ?>
                                    </div>
                                    <h2>Type</h2>
                                    <?php echo get_field('image_type'); ?>
                                    <div class="mt-3 mb-3">
                                        <label class="d-block">
                                            <input type="checkbox" name="gallery-type" value="white background" onchange="gallerycategoryfunction(this)">
                                            <span class="custom-checkbox"></span>
                                            <span class="txt">White Background</span>
                                        </label>
                                        <label class="d-block">
                                            <input type="checkbox" name="gallery-type" value="environmental" onchange="gallerycategoryfunction(this)">
                                            <span class="custom-checkbox"></span>
                                            <span class="txt">Environmental</span>
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary text-uppercase d-none">filter</button>
                                </form>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="gallery-ajax"></div>
                        <div class="gallery-data">
                            <?php $args1 = array(
                                'post_type' => 'galleryimages',
                                'post_status' => array('publish'),
                                'posts_per_page' => -1,
                                'order' => 'DESC',
                                'orderby' => 'date',
                              );
                            $posts = new WP_Query( $args1 );
                            if ( $posts->have_posts() ) { ?>
                                <ul class="thumb-list" style="height: 100%;">
                                    <?php while ( $posts->have_posts() ) {
                                        $posts->the_post(); 
                                        $gallery_image = get_field('image'); 
                                        $tab_name = get_the_title(); ?>
                                        <li><a rel="lightbox[gallery]" title="<span class='title'><?php echo $tab_name; ?></span><a href='<?php echo $gallery_image; ?>' download><img src='<?php bloginfo('template_url'); ?>/images/download-icon.png' alt=''>Downlaod</a>" href="<?php echo $gallery_image; ?>"><span title=""><img src="<?php echo $gallery_image; ?>" class="img-fluid" alt=""><div class="gallery-img-caption"><?php echo $tab_name; ?></div></span></a><div class="bottom-download"><a href='<?php echo $gallery_image; ?>' download><img src='<?php bloginfo('template_url'); ?>/images/download-icon.png' alt=''>Download</a></div></li>  
                                    <?php } ?>
                                </ul>
                            <?php } else {
                                echo 'no gallery image found....';
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php get_footer(); ?>
