<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Gavco
 */

get_header();
$post_type = $_GET['post_type'];
$search_term = $_GET['s'];
if($post_type == 'galleryimages'){
    //exit;
	$search_result_array1 = array();
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			$search_result_ids = get_the_ID();
			$post_type = get_post_type($search_result_ids);
			if($post_type != 'product'){
				array_push($search_result_array1,$search_result_ids);
			}
		endwhile;
	endif;
	//$search_result_array = implode (", ", $search_result_array1);
	session_start();
	$_SESSION['search-results-ids-array'] = $search_result_array1;
	$id = '63292'; ?>
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
                            <ul class="nav nav-tabs d-block" id="myTab2" role="tablist">
                                <?php
                                $fields = get_fields(63272);
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
                                    <h2 id="clearfilter" class="d-none"><a href="<?php echo get_page_link(63292); ?>">Clear Filters</a></h2>
                                    <h2>Products</h2>
                                    <div class="mt-3 mb-3">
                                        <?php foreach($gallery_cat as $gc){ 
                                            //$parent_term = get_term( $gc->parent, 'gallery-category' );
                                            //$parent_term_id = $parent_term->term_id; 
                                            $children = get_terms( 'gallery-category', array(
                                                'parent'    => $gc->term_id,
                                                'hide_empty' => false
                                            ) );  ?>
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
                        <?php 
                            // if(!empty($search_result_array1)){
                            //     echo '<h2 class="mb-3 mb-lg-4">Search Results For <strong style="font-weight:700;">"'.$search_term.'"</strong></h2>';
                            // }
                        ?>
                        <div class="gallery-ajax"></div>
	                    <div class="gallery-data">
	                        <?php
                                echo '<h2 class="mb-3 mb-lg-4">Search Results For <strong style="font-weight:700;">"'.$search_term.'"</strong></h2>';
                                if ( have_posts() ) : 
                                    $images_count = 0; ?>
	                                <ul class="thumb-list" style="height: 100%;">
	                                    <?php while ( have_posts() ) : the_post();
	                                    	$post_id = get_the_ID();
	                                    	$post_type = get_post_type($post_id);
											if($post_type != 'product'){
		                                        $gallery_image1 = get_field('image'); 
		                                        $gallery_image = wp_get_attachment_image_url( $gallery_image1, 'full' );
		                                        $tab_name = get_the_title($post_id); 
                                                $images_count++; ?>
		                                        <li class="moreimages"><a rel="lightbox[gallery]" title="<span class='title'><?php echo $tab_name; ?></span><a href='<?php echo $gallery_image; ?>' download><img src='<?php bloginfo('template_url'); ?>/images/download-icon.png' alt=''>Downlaod</a>" href="<?php echo $gallery_image; ?>"><span title=""><img src="<?php echo $gallery_image; ?>" class="img-fluid" alt=""><div class="gallery-img-caption"><?php echo $tab_name; ?></div></span></a><div class="bottom-download"><a href='<?php echo $gallery_image; ?>' download><img src='<?php bloginfo('template_url'); ?>/images/download-icon.png' alt=''>Download</a></div></li>  
	                                    	<?php } 
	                                    endwhile; ?>
	                                </ul>
	                        	<?php 
	                        	else: 
	                            echo '<div class="mb-5">No gallery image found....</div>';
	                        endif; ?>
		                </div>
                        <?php if($images_count > '15'){ ?>
                            <div class="text-center">
                                <img src="<?php bloginfo('template_url'); ?>/images/spinner.gif" class="img-fluid load-spinner" alt="" style="display: none;">
                            </div>
                            <div class="text-center mt-5 w-100 d-none"><a href="#" id="loadimages">Load More</a></div>
                        <?php } ?>
		            </div>
                </div>
            </div>
        </div>
    </main>
<?php } else {
?>
	<main id="main">
        <div class="block pb-4">
            <div class="container">
                <?php if ( have_posts() ) :
					echo '<h2 class="mb-3 mb-lg-4">Search Results For <strong style="font-weight:700;">"'.$_GET['s'].'"</strong></h2>';
					echo '<div class="row products mb-3">';
					while ( have_posts() ) : the_post();
						global $product;
                        $postname = get_post_type( get_the_ID() );
                        if($postname != 'galleryimages'){
                            $count = 0;
                            $product_thumb = get_the_post_thumbnail_url();
                            if(empty($product_thumb)){$product_thumb = get_template_directory_uri().'/images/pthumbnail.png';} ?>
    						<div class="col-lg-3 col-md-4 col-sm-6 col-12">
    							<div class="product">
    								<img src="<?php echo $product_thumb; ?>" class="img-fluid border" alt="">
    							</div>
    							<div class="text">
    								<span class="title"><?php the_title(); ?></span>
    								<span class="txt"></span>
    								<a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary">Configure</a>
    							</div>
    						</div>
                        <?php $count++; } ?>
					<?php endwhile;
					echo '</div>';
                    echo '<div class="plist-pagination">';
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => __( 'PREV', 'gavco' ),
                        'next_text' => __( 'NEXT', 'gavco' ),
                    ) );
                    echo '</div>';
				else: $count = 1; ?>
					<h2 style="font-weight: 300;">SORRY, THERE ARE NO RESULTS FOR <span style="font-weight: 500;">"<?php echo $_GET['s']; ?>"</span></h2>
                    <strong>Try your search again using these tips:</strong>
                    <ul class="mb-lg-5">
                        <li>Double check the spelling. Try modifying the spelling.</li>
                        <li>Limit the search to one or two words.</li>
                        <li>Be less specific in your wording. Sometimes a more general term will lead you to similar products.</li>
                    </ul>
				<?php endif; ?>
                <?php if($count == 0){ ?>
                    <h2 style="font-weight: 300;">SORRY, THERE ARE NO RESULTS FOR <span style="font-weight: 500;">"<?php echo $_GET['s']; ?>"</span></h2>
                    <strong>Try your search again using these tips:</strong>
                    <ul class="mb-lg-5">
                        <li>Double check the spelling. Try modifying the spelling.</li>
                        <li>Limit the search to one or two words.</li>
                        <li>Be less specific in your wording. Sometimes a more general term will lead you to similar products.</li>
                    </ul>
                <?php } ?>
			</div>
		</div>
	</main>

<?php
}
get_footer();
