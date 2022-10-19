<?php $page_id = get_the_ID();
$parent_term = get_queried_object();
$parent_term_id = $parent_term->parent;
?>
<div class="sidebar">
    <h2>PRODUCTS</h2>
    <ul>
        <?php
            $orderby = 'name';
            $order = 'ASC';
            $hide_empty = false;
            $current_term = get_queried_object();
            $current_term_id = $current_term->term_id;
            $cat_args = array(
                // 'orderby'    => $orderby,
                // 'order'      => $order,
                'hide_empty' => $hide_empty,
                'parent' => 0,
                'exclude'    => array(17,461)
            );
            $product_categories = get_terms( 'product_cat', $cat_args );
            if( !empty($product_categories) ){
                foreach ($product_categories as $key => $category) {
                    $cat_id = $category->term_id;
                    $banner = get_field('banner',$category);
                    $cat_name = $category->name;
                    $cat_slug = $category->slug;
                    $cat_link = get_term_link($category);
                    $sub_heading = get_field('sub_heading',$category);
                    $tagline = get_field('tagline',$category);
                    $children = get_terms( 'product_cat', array(
                        'parent'    => $cat_id,
                        'hide_empty' => false
                    ) );
                    if($current_term_id == $cat_id || $parent_term_id == $cat_id){
                        $class = ' class="active"';
                    } else {
                        $class = '';
                    } ?>
                    <li <?php echo $class; ?>>
                        <a href="<?php echo $cat_link; ?>"><?php echo $cat_name; ?></a>
                        <?php if(!empty($children)){ ?>
                            <ul>
                                <?php foreach($children as $child){
                                    $child_id = $child->term_id;
                                    if($current_term_id == $child_id){$class = ' class="active"';}
                                    else{$class = '';}
                                    ?>
                                    <li <?php echo $class; ?>><a href="<?php echo get_term_link($child); ?>"><?php echo $child->name; ?></a></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php }
            }
        ?>
        <li <?php if($page_id==184){echo 'class="active"'; }?>><a href="<?php echo get_page_link(184); ?>">Reception</a></li>
        <li <?php if($page_id==40692){echo 'class="active"'; }?>><a href="<?php echo get_page_link(40692); ?>">Custom Furniture</a></li>
    </ul>
</div>
