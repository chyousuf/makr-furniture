<?php
get_template_part( 'inc/functions/register-post-types' );
get_template_part( 'inc/products/products-dropdown-option-function' );

/**************************************************
                REMOVE ADMIN MENU
**************************************************/
function remove_menus(){
  // remove_menu_page( 'index.php' );               //Dashboard
  remove_menu_page( 'edit.php' );                   //Posts
  // remove_menu_page( 'upload.php' );              //Media
  remove_menu_page( 'edit-comments.php' );          //Comments
  // remove_menu_page( 'plugins.php' );             //Plugins
  // remove_menu_page( 'users.php' );               //Users
  //remove_menu_page( 'tools.php' );                  //Tools
  // remove_menu_page( 'options-general.php' );     //Settings
}
add_action( 'admin_menu', 'remove_menus' );
/**************************************************
            REGISTER HEADER AND FOOTER
**************************************************/
register_nav_menus( array(
  'header'  => __( 'Header', 'gavco' ),
  'categories'  => __( 'Categories', 'gavco' ),
  'products-menu'  => __( 'Products Menu', 'gavco' ),
  'about-menu'  => __( 'About Menu', 'gavco' ),
) );
add_theme_support( 'menus' );

add_filter( 'body_class', 'bbloomer_wc_product_cats_css_body_class' );

    function bbloomer_wc_product_cats_css_body_class( $classes ){
      if( is_singular( 'product' ) )
      {
        $custom_terms = get_the_terms(0, 'product_cat');
        if ($custom_terms) {
          foreach ($custom_terms as $custom_term) {
            $classes[] = 'product_cat_' . $custom_term->term_id;
          }
        }
      }
      return $classes;
    }
/**************************************************
            Add Class in Menu
**************************************************/
function my_walker_nav_menu_start_el($item_output, $item, $depth, $args) {
  if ( $depth == 0 && 'header' == $args->theme_location ) {
    $item_output = preg_replace('/<a /', '<a class="nav-link" ', $item_output, 1);
  }
  return $item_output;
}
add_filter('walker_nav_menu_start_el', 'my_walker_nav_menu_start_el', 10, 4);
// remove_filter('the_content', 'wpautop');
// remove_filter ('acf_the_content', 'wpautop');
/**************************************************
            ACF THEME SETTINGS PAGE
**************************************************/
if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
      'page_title' => 'Theme General Settings',
      'menu_title' => 'Theme Settings',
      'menu_slug' => 'theme-general-settings',
      'capability' => 'edit_posts',
      'redirect' => false
  ));
}
/**************************************************
            Admin Preview Button Remove
**************************************************/
function posttype_admin_css() {
  global $post_type;
  $post_types = array(
    /* set post types */
    'post_type_name',
    'services',
    'newsletter',
    'partner',
    'slider',
    'page',
  );
  if(in_array($post_type, $post_types))
  echo '<style type="text/css">.editor-post-preview,#post-preview{display: none !important;}</style>';
}
add_action( 'admin_head-post-new.php', 'posttype_admin_css' );
add_action( 'admin_head-post.php', 'posttype_admin_css' );
/**************************************************
          Span option enabled in editor
**************************************************/
function override_mce_options($initArray)
{
  $opts = '*[*]';
  $initArray['valid_elements'] = $opts;
  $initArray['extended_valid_elements'] = $opts;
  return $initArray;
 }
 add_filter('tiny_mce_before_init', 'override_mce_options');
 /**************************************************
            FEATURED IMAGE Dimension
**************************************************/
function custom_admin_post_thumbnail_html( $content ) {
  if('product' === get_post_type()){
    return $content = str_replace( __( 'Set featured image' ), __( 'Upload image (500 x 500)' ), $content);
  } else {
    return $content = str_replace( __( 'Set featured image' ), __( 'Upload image (500 x 500)' ), $content);
  }
}
add_filter( 'admin_post_thumbnail_html', 'custom_admin_post_thumbnail_html' );
function custom_admin_post_thumbnail_html1( $content1 ) {
  if('product' === get_post_type()){
    return $content1 = str_replace( __( 'Click the image to edit or update' ), __( 'image (500 x 500)' ), $content1);
  } else {
    return $content1 = str_replace( __( 'Click the image to edit or update' ), __( 'image (500 x 500)' ), $content1);
  }
}
add_filter( 'admin_post_thumbnail_html', 'custom_admin_post_thumbnail_html1' );
/**************************************************
      add class in image uploading in editor
**************************************************/
function nddt_add_class_to_images($class){
    $class .= ' img-fluid';
    return $class;
}
add_filter('get_image_tag_class','nddt_add_class_to_images');
/**************************************************
                FEATURED IMAGE
**************************************************/
add_theme_support('post-thumbnails');
add_post_type_support( 'featured_image', 'thumbnail' );
function create_post_type() {
  register_post_type( 'featured_image',
    array(
      'labels' => array(
        'name' => __( 'Featured Image' ),
        'singular_name' => __( 'featured image' )
      ),
      'public' => true,
      'has_archive' => true
    )
  );
}
/**************************************************
            Declare WooCommerce support
**************************************************/
add_theme_support( 'woocommerce' );
/**************************************************
To change add to cart text on single product page
**************************************************/
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' );
function woocommerce_custom_single_add_to_cart_text() {
  return __( 'Add to Quote', 'woocommerce' );
}
/**************************************************
      Change Sku Meta Position after Price
**************************************************/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 20 );

/**************************************************
          Cart Total for header icon
**************************************************/
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start(); ?>
  <a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
  <?php
  $fragments['a.cart-customlocation'] = ob_get_clean();
  return $fragments;
}
/**************************************************
  Set Preority of custom woocommerce stylesheet
**************************************************/
add_action('wp_enqueue_scripts', 'cvf_st_load_custom_css_before_main');
function cvf_st_load_custom_css_before_main() {
  if (class_exists('woocommerce')){
    wp_enqueue_style('my-woocommerce-style', get_template_directory_uri().'/css/woocommerce-style.css', array('woocommerce-general'));
  }
}
/**************************************************
    Remove Downloads option from Account Page
**************************************************/
add_filter( 'woocommerce_account_menu_items', 'custom_remove_downloads_my_account', 999 );
function custom_remove_downloads_my_account( $items ) {
  unset($items['downloads']);
  return $items;
}
/**************************************************
    Limit Wordpress Search to specific posttype
**************************************************/
function searchfilter($query) {
  if ($query->is_search && !is_admin() ) {
    $post_type = $_GET['post_type'];
    if($post_type != 'galleryimages'){
      $query->set('post_type',array('product'));
    } else {
      $query->set('post_type',array('galleryimages'));
    }
  }
  return $query;
}
add_filter('pre_get_posts','searchfilter');

/*********************************************
        Products Listing Pagination
**********************************************/
function custom_posts_per_page( $query ) {
  if ( !is_admin() && $query->is_archive('products') ) {
    set_query_var('posts_per_page', 12);
  }
}
add_action( 'pre_get_posts', 'custom_posts_per_page' );
/*********************************************
        Search Page Number of products
**********************************************/
function my_post_queries( $query ) {
  if (!is_admin() && $query->is_main_query()){
    if(is_search()){
      $post_type = $_GET['post_type'];
      if($post_type != 'galleryimages'){
        $query->set('posts_per_page', 12);
      } else {
        $query->set('posts_per_page', -1);
      }
    }
  }
}
add_action( 'pre_get_posts', 'my_post_queries' );


add_filter( 'woocommerce_is_attribute_in_product_name', 'remove_attribute_in_product_name' );
function remove_attribute_in_product_name( $boolean){
    // if ( ! is_cart() )
    //     $boolean = false;
    // return $boolean;
}


add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_false' );
add_filter( 'woocommerce_is_attribute_in_product_name', '__return_false' );


/**************************************************
      trigger update quantity button on change
**************************************************/
add_action( 'wp_footer', 'bbloomer_cart_refresh_update_qty' );
function bbloomer_cart_refresh_update_qty() {
   if (is_cart()) {
      ?>
      <script type="text/javascript">
         jQuery('div.woocommerce').on('click', 'input.qty', function(){
            jQuery("[name='update_cart']").trigger("click");
         });
      </script>
      <?php
   }
}

/**************************************************
            Hide or emove product tag
**************************************************/
add_action( 'admin_menu', 'misha_hide_product_tags_admin_menu', 9999 );
function misha_hide_product_tags_admin_menu() {
  remove_submenu_page( 'edit.php?post_type=product', 'edit-tags.php?taxonomy=product_tag&amp;post_type=product' );
}


/**************************************************
              Change View cart text
**************************************************/
function my_text_strings( $translated_text, $text, $domain ) {
  switch ( $translated_text ) {
    case 'View cart' :
      $translated_text = __( 'View Quote', 'woocommerce' );
    break;
  }
  return $translated_text;
}
add_filter( 'gettext', 'my_text_strings', 20, 3 );



function ace_product_page_ajax_add_to_cart_js() {
    ?><script type="text/javascript" charset="UTF-8">
    jQuery(function($) {
      $('form.cart').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        form.block({ message: null, overlayCSS: { background: '#fff', opacity: 0.6 } });
        var formData = new FormData(form.context);
        formData.append('add-to-cart', form.find('[name=add-to-cart]').val() );
        // Ajax action.
        $.ajax({
          url: wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'ace_add_to_cart' ),
          data: formData,
          type: 'POST',
          processData: false,
          contentType: false,
          complete: function( response ) {
            response = response.responseJSON;
            if ( ! response ) {
              return;
            }
            if ( response.error && response.product_url ) {
              window.location = response.product_url;
              return;
            }
            // Redirect to cart option
            if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
              window.location = wc_add_to_cart_params.cart_url;
              return;
            }
            var $thisbutton = form.find('.single_add_to_cart_button'); //
//            var $thisbutton = null; // uncomment this if you don't want the 'View cart' button
            // Trigger event so themes can refresh other areas.
            $( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, $thisbutton ] );
            // Remove existing notices
            $( '.woocommerce-error, .woocommerce-message, .woocommerce-info' ).remove();
            // Add new notices
            form.closest('.product').before(response.fragments.notices_html)
            form.unblock();
          }
        });
      });
    });
  </script><?php
}
add_action( 'wp_footer', 'ace_product_page_ajax_add_to_cart_js' );



function ace_ajax_add_to_cart_handler() {
  WC_Form_Handler::add_to_cart_action();
  WC_AJAX::get_refreshed_fragments();
}
add_action( 'wc_ajax_ace_add_to_cart', 'ace_ajax_add_to_cart_handler' );
add_action( 'wc_ajax_nopriv_ace_add_to_cart', 'ace_ajax_add_to_cart_handler' );
// Remove WC Core add to cart handler to prevent double-add
remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );


function ace_ajax_add_to_cart_add_fragments( $fragments ) {
  $all_notices  = WC()->session->get( 'wc_notices', array() );
  $notice_types = apply_filters( 'woocommerce_notice_types', array( 'error', 'success', 'notice' ) );
  ob_start();
  foreach ( $notice_types as $notice_type ) {
    if ( wc_notice_count( $notice_type ) > 0 ) {
      wc_get_template( "notices/{$notice_type}.php", array(
        'messages' => array_filter( $all_notices[ $notice_type ] ),
      ) );
    }
  }
  $fragments['notices_html'] = ob_get_clean();
  wc_clear_notices();
  return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'ace_ajax_add_to_cart_add_fragments' );


add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );
function iconic_cart_count_fragments( $fragments ) {
  $fragments['div.header-cart-count'] = '<div class="header-cart-count">' . WC()->cart->get_cart_contents_count() . '</div>';
  return $fragments;
}


/**************************************************
                User role settings
**************************************************/
remove_role( 'subscriber' );
remove_role( 'contributor' );
remove_role( 'author' );

add_role('dealer', __(
 'Dealer'),
 array()
);



/**************************************************
  Remove Price for logged out user and customer
**************************************************/
// add_filter( 'woocommerce_get_price_html', function( $price ) {
//   if ( ! is_user_logged_in() ) return '';
//   $user = wp_get_current_user();
//   $hide_for_roles = array( 'customer' );
//   if ( array_intersect( $user->roles, $hide_for_roles ) ) {
//     return '';
//   }
//   return $price;
// } );
// add_filter( 'woocommerce_cart_item_price', '__return_false' );


/**************************************************
        INCLUDE CATEGORY PRODUCT IN SEARCH
**************************************************/
function atom_search_where($where){
  global $wpdb, $wp_query;
  if (is_search() && !is_admin()) {
    $search_terms = get_query_var( 'search_terms' );
    $where .= " OR (";
    $i = 0;
    foreach ($search_terms as $search_term) {
      $i++;
      if ($i>1) $where .= " AND";     // --- make this OR if you prefer not requiring all search terms to match taxonomies
      $where .= " (t.name LIKE '%".$search_term."%')";
    }
    $where .= " AND {$wpdb->posts}.post_status = 'publish')";
  }
  return $where;
}

function atom_search_join($join){
  global $wpdb;
  if (is_search() && !is_admin())
    $join .= "LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_taxonomy_id=tr.term_taxonomy_id INNER JOIN {$wpdb->terms} t ON t.term_id = tt.term_id";
  return $join;
}

function atom_search_groupby($groupby){
  global $wpdb;
  // we need to group on post ID
  $groupby_id = "{$wpdb->posts}.ID";
  if(!is_search() || strpos($groupby, $groupby_id) !== false) return $groupby;
  // groupby was empty, use ours
  if(!strlen(trim($groupby))) return $groupby_id;
  // wasn't empty, append ours
  return $groupby.", ".$groupby_id;
}

add_filter('posts_where','atom_search_where');
add_filter('posts_join', 'atom_search_join');
add_filter('posts_groupby', 'atom_search_groupby');


/**************************************************
       CHANGE ORER NOTE TEXT ON CHECKOUT
**************************************************/
function md_custom_woocommerce_checkout_fields( $fields )
{
    $fields['order']['order_comments']['placeholder'] = 'Add your quote note';
    $fields['order']['order_comments']['label'] = 'Quote notes';
    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'md_custom_woocommerce_checkout_fields' );



/**************************************************
      ADD CONTINUE SHOPPING BUTTON ON PRODUCT
**************************************************/
// function filter_wc_add_to_cart_message_html( $message, $products ) {
//   $return_to = apply_filters(
//     'woocommerce_continue_shopping_redirect',
//     wc_get_raw_referer() ? wp_validate_redirect( wc_get_raw_referer(), false ) : wc_get_page_permalink( 'shop' )
//   );
//   $continue   = sprintf(
//     '<a href="%s" class="button wc-forward ml-0 mt-4 d-block text-center float-none">%s</a>',
//     esc_url( $return_to ),
//     esc_html__( 'Continue shopping', 'woocommerce' )
//   );
//   $message .= $continue;
//   return $message;
// };
// add_filter( 'wc_add_to_cart_message_html', 'filter_wc_add_to_cart_message_html', 10, 2 );


// add_filter ( 'wc_add_to_cart_message', 'wc_add_to_cart_message_filter', 10, 2 );
// function wc_add_to_cart_message_filter($message, $product_id = null) {
// $titles[] = get_the_title( $product_id );

// $titles = array_filter( $titles );
// $added_text = sprintf( _n( '%s has been added to your cart.', '%s have been added to your cart.', sizeof( $titles ), 'woocommerce' ), wc_format_list_of_items( $titles ) );

// $message = sprintf( '%s <a href="%s" class="button detail-message-button">%s</a><a href="%s" class="button detail-message-button">%s</a>',
//                 esc_html( $added_text ),
//                 esc_url( wc_get_page_permalink( 'cart' ) ),
//                 esc_html__( 'View Quote', 'woocommerce' ),
//                 esc_url( wc_get_page_permalink( 'shop' ) ),
//                 esc_html__( 'Continue shopping', 'woocommerce' ));

// return $message;}

add_filter( 'wc_add_to_cart_message', 'filter_wc_add_to_cart_message', 10, 2 ); 
function filter_wc_add_to_cart_message( $message, $product_id ) { 
    // make filter magic happen here... 
    $titles[] = get_the_title( $product_id );
    $added_text = sprintf( _n( '%s has been added to your cart.', '%s have been added to your cart.', sizeof( $titles ), 'woocommerce' ), wc_format_list_of_items( $titles ) );
    $message  = sprintf( '%s <a href="%s" class="button detail-message-button">%s</a><a href="%s" class="button detail-message-button">%s</a>',
                esc_html( $added_text ),
                esc_url( wc_get_page_permalink( 'cart' ) ),
                esc_html__( 'View Quote', 'woocommerce' ),
                esc_url( wc_get_page_permalink( 'shop' ) ),
                esc_html__( 'Continue shopping', 'woocommerce' ));
    return $message; 
}; 


add_filter( 'post_row_actions', 'remove_row_actions', 10, 1 );
function remove_row_actions( $actions )
{
    if( get_post_type() === 'productsoptions' )
        unset( $actions['view'] );
    return $actions;
}
add_action('admin_footer', function() {
  global $post_type;
  if ($post_type == 'productsoptions') {
    echo '<script> document.getElementById("edit-slug-box").outerHTML = ""; </script>';
    echo '<script> document.getElementById("message").outerHTML = ""; </script>';
  }
});


$current_user = wp_get_current_user();
$current_user_id = $current_user->ID;
$user = get_userdata($current_user_id);
$user_roles = $user->roles;
if(empty($user_roles)){
  $user_roles = array(
    '0' => 'customer',
  );
}
if ( in_array( 'dealer', $user_roles, true ) || in_array( 'dealer', $user_roles, true )) {
  add_filter('woocommerce_checkout_get_value','__return_empty_string',10);
}

add_filter( 'woocommerce_checkout_fields' , 'misha_not_required_fields', 9999 );

function misha_not_required_fields( $f ) {

  unset( $f['billing']['billing_country']['required'] ); // that's it

  // the same way you can make any field required, example:
  // $f['billing']['billing_company']['required'] = true;

  return $f;
}


// add_action( 'init', 'woocommerce_clear_cart_url' );
// function woocommerce_clear_cart_url() {
//   global $woocommerce;
//   $woocommerce->cart->empty_cart();
// }


/******************************************
  wordpress admin category hierarchical order
******************************************/
add_filter('wp_terms_checklist_args', function($args, $idPost) {
    $taxonomies = ['gallery-category'];

    if (isset($args['taxonomy']) && in_array($args['taxonomy'], $taxonomies)) {
        $args['checked_ontop'] = false;
    }

    return $args;
}, 10, 2);



function get_ajax_posts() {
  // Query Arguments
  session_start();
  $search_array = $_SESSION['search-results-ids-array'];
  $x = 0;
  $y = 0;
  $z = 0;
  $gallery_cat = $_REQUEST['cat-val'];
  $gallery_tag = $_REQUEST['tag-val'];
  $gallery_type = $_REQUEST['type-val'];
  //print_r($gallery_type);
  $tax_query = array( 'relation' => 'AND' );
  $meta_query = array( 'relation' => 'AND' );
  $args = array(
    'post__in'      => 61291,
  );
  if(!empty($gallery_cat)){
    while($x < count($gallery_cat)){
      $tax_query[] = array(
        'taxonomy' => 'gallery-category',
        'field'    => 'term_id',
        'terms'    => $gallery_cat[$x],
      );
       $x++;
    }
  }
  if(!empty($gallery_tag)){
    while($y < count($gallery_tag)){
      $tax_query[] = array(
        'taxonomy' => 'gallery_tags',
        'field'    => 'term_id',
        'terms'    => $gallery_tag[$y],
      );
       $y++;
    }
  }
  if(!empty($gallery_type)){
    while($z < count($gallery_type)){
      $meta_query[] = array(
        'key'     => 'image_type',
        'value'     => $gallery_type[$z],
        'compare'   => 'LIKE'
      );
       $z++;
    }
  }
  if(!empty($search_array)){
    $args = array(
      'post_type' => 'galleryimages',
      'post_status' => array('publish'),
      'posts_per_page' => -1,
      'post__in'      => $search_array,
      'tax_query' => $tax_query,
    );
  } else {
    $args = array(
      'post_type' => 'galleryimages',
      'post_status' => array('publish'),
      'posts_per_page' => -1,
      'tax_query' => $tax_query,
    );
  }
  if(!empty($gallery_type)){
    if(!empty($search_array)){
      $args = array(
        'post_type' => 'galleryimages',
        'post_status' => array('publish'),
        'posts_per_page' => -1,
        'post__in'      => $search_array,
        'tax_query' => $tax_query,
        'meta_query'  => $meta_query,
        // 'meta_query'  => array(
        //   'relation'    => 'AND',
        //   array(
        //     'key'     => 'image_type',
        //     'value'     => $gallery_type,
        //     'compare'   => 'LIKE',
        //   ),
        // ),
      );
    } else {
      $args = array(
        'post_type' => 'galleryimages',
        'post_status' => array('publish'),
        'posts_per_page' => -1,
        'tax_query' => $tax_query,
        'meta_query'  => $meta_query,
          // 'relation'    => 'AND',
          // array(
          //   'key'     => 'image_type',
          //   'value'     => $gallery_type,
          //   'compare'   => 'LIKE',
          // ),
        //),
      );
    }
  }
  if(empty($gallery_cat) && empty($gallery_tag) && empty($gallery_type)){
    if(!empty($search_array)){
      $args = array(
        'post_type' => 'galleryimages',
        'post_status' => array('publish'),
        'posts_per_page' => -1,
        'post__in'      => $search_array,
        'tax_query' => $tax_query,
      );
    } else {
      $args = array(
        'post_type' => 'galleryimages',
        'post_status' => array('publish'),
        'posts_per_page' => -1,
        'tax_query' => $tax_query,
      );
    }
  }
  // The Query
  $ajaxposts = new WP_Query( $args );
  $response = '';
  // The Query
  if ( $ajaxposts->have_posts() ) { 
    $images_count = 0; ?>
    <ul class="thumb-list" style="height: 100%;">
    <?php while ( $ajaxposts->have_posts() ) {
      $ajaxposts->the_post(); 
      $gallery_image = get_field('image'); 
      $tab_name = get_the_title(); 
      $images_count++; ?>
      <li class="moreimages2"><a rel="lightbox[gallery]" title="<span class='title'><?php echo $tab_name; ?></span><a href='<?php echo $gallery_image; ?>' download><img src='<?php bloginfo('template_url'); ?>/images/download-icon.png' alt=''>Download</a>" href="<?php echo $gallery_image; ?>"><span title=""><img src="<?php echo $gallery_image; ?>" class="img-fluid" alt=""><div class="gallery-img-caption"><?php echo $tab_name; ?></div></span></a><div class="bottom-download"><a href='<?php echo $gallery_image; ?>' download><img src='<?php bloginfo('template_url'); ?>/images/download-icon.png' alt=''>Download</a></div></li>  
    <?php } ?>
    </ul>
    <?php if($images_count > '15'){ ?>
      <!-- <div class="text-center d-inline-block mt-5 w-100"><a href="#" id="loadimages2">Load More</a></div> -->
      <!-- <div class="text-center">
        <img src="<?php bloginfo('template_url'); ?>/images/spinner.gif" class="img-fluid load-spinner" alt="" style="display: none;">
      </div> -->
      <div class="text-center mt-5 w-100 d-none"><a href="#" id="loadimages2">Load More</a></div>
    <?php } ?>
  <?php } else {
    echo 'No gallery image found....';
  }
  echo $response;
  exit; // leave ajax call
}

// Fire AJAX action for both logged in and non-logged in users
add_action('wp_ajax_get_ajax_posts', 'get_ajax_posts');
add_action('wp_ajax_nopriv_get_ajax_posts', 'get_ajax_posts');


?>
