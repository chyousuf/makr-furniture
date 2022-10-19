<?php

/**************************************************
                PRODUCTS OPTIONS CPT
 **************************************************/
// function PRODUCTSOPTIONS() {
//   register_post_type( 'Productsoptions',
//     array(
//         'labels' => array(
//             'name' => __( 'Products Options'),
//             'singular_name' => __( 'Products Options')
//         ),
//         'public' => true,
//             'menu_icon' => 'dashicons-list-view',
//             'rewrite' => array('slug' => 'products-options'),
//         )
//     );
// }
// add_action( 'init', 'PRODUCTSOPTIONS' );
// function PRODUCTSOPTIONS_a() {
//   $labels = array(
//     'name'                => _x( 'Productsoptions', 'Post Type General Name', 'soar' ),
//     'singular_name'       => _x( 'Productsoptions', 'Post Type Singular Name', 'soar' ),
//     'menu_name'           => __( 'Productsoptions', 'soar' ),
//     'parent_item_colon'   => __( 'Productsoptions', 'soar' ),
//     'all_items'           => __( 'All Productsoptions', 'soar' ),
//     'view_item'           => __( 'View Productsoptions', 'soar' ),
//     'add_new_item'        => __( 'Add New Productsoptions', 'soar' ),
//     'add_new'             => __( 'Add New', 'soar' ),
//     'edit_item'           => __( 'Edit Productsoptions', 'soar' ),
//     'update_item'         => __( 'Update Productsoptions', 'soar' ),
//     'search_items'        => __( 'Search Productsoptions', 'soar' ),
//     'not_found'           => __( 'Not Found', 'soar' ),
//     'not_found_in_trash'  => __( 'Not found in Trash', 'soar' ),
//   );
//   $args = array(
//     'label'               => __( 'Productsoptions', 'soar' ),
//     'description'         => __( 'Productsoptions', 'soar' ),
//     'labels'              => $labels,
//     'supports'            => array( 'title', 'editor', 'thumbnail'),
//     'taxonomies'          => array( 'genres' ),
//     'hierarchical'        => true,
//     'public'              => true,
//     'show_ui'             => true,
//     'show_in_menu'        => true,
//     'show_in_nav_menus'   => true,
//     'show_in_admin_bar'   => true,
//     'menu_position'       => 1,
//     'can_export'          => true,
//     'has_archive'         => true,
//     'exclude_from_search' => false,
//     'publicly_queryable'  => true,
//     'capability_type'     => 'page',
//   );
//   register_post_type( 'PRODUCTSOPTIONS', $args );
// }
// add_action( 'init', 'PRODUCTSOPTIONS_a', 0 );
/**************************************************
                Gallery CPT
 **************************************************/


function Galleryimages()
{
    register_post_type(
        'Galleryimages',
        array(
            'labels' => array(
                'name' => __('Gallery Images'),
                'singular_name' => __('Gallery Images')
            ),
            'public' => true,
            'menu_icon' => 'dashicons-list-view',
            // 'has_archive' => ture,  sss
            'rewrite' => array('slug' => 'gallery_images'),
        )
    );
}
add_action('init', 'Galleryimages');
function Galleryimages_a()
{
    $labels = array(
        'name'                => _x('Gallery Images', 'Post Type General Name', 'Gavco'),
        'singular_name'       => _x('Gallery Images', 'Post Type Singular Name', 'Gavco'),
        'menu_name'           => __('Gallery Images', 'Gavco'),
        'parent_item_colon'   => __('Gallery Images', 'Gavco'),
        'all_items'           => __('All Gallery Images', 'Gavco'),
        'view_item'           => __('View Gallery Images', 'Gavco'),
        'add_new_item'        => __('Add New Gallery Images', 'Gavco'),
        'add_new'             => __('Add New', 'Gavco'),
        'edit_item'           => __('Edit Gallery Images', 'Gavco'),
        'update_item'         => __('Update Gallery Images', 'Gavco'),
        'search_items'        => __('Search Gallery Images', 'Gavco'),
        'not_found'           => __('Not Found', 'Gavco'),
        'not_found_in_trash'  => __('Not found in Trash', 'Gavco'),
    );
    $args = array(
        'label'               => __('Gallery Images', 'Gavco'),
        'description'         => __('Gallery Images', 'Gavco'),
        'labels'              => $labels,
        'supports'            => array('title'),
        'taxonomies'          => array('genres'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 1,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        //'taxonomies'          => array( 'category', 'post_tag' )
    );
    register_post_type('Galleryimages', $args);
}
add_action('init', 'Galleryimages_a', 0);
/**************************************************
                Gallery CPT Taxonomy
 **************************************************/
function be_register_taxonomies()
{
    $taxonomies2 = array(
        array(
            'slug'         => 'gallery-category',
            'single_name'  => 'Gallery Category',
            'plural_name'  => 'Gallery Category',
            'post_type'    => 'galleryimages',
            'rewrite'      => array('slug' => 'gallery-category'),
        ),
    );
    foreach ($taxonomies2 as $taxonomy2) {
        $labels2 = array(
            'name' => $taxonomy2['plural_name'],
            'singular_name' => $taxonomy2['single_name'],
            'search_items' =>  'Search ' . $taxonomy2['plural_name'],
            'all_items' => 'All ' . $taxonomy2['plural_name'],
            'parent_item' => 'Parent ' . $taxonomy2['single_name'],
            'parent_item_colon' => 'Parent ' . $taxonomy2['single_name'] . ':',
            'edit_item' => 'Edit ' . $taxonomy2['single_name'],
            'update_item' => 'Update ' . $taxonomy2['single_name'],
            'add_new_item' => 'Add New ' . $taxonomy2['single_name'],
            'new_item_name' => 'New ' . $taxonomy2['single_name'] . ' Name',
            'menu_name' => $taxonomy2['plural_name']
        );
        $rewrite2 = isset($taxonomy2['rewrite']) ? $taxonomy2['rewrite'] : array('slug' => $taxonomy2['slug']);
        $hierarchical2 = isset($taxonomy2['hierarchical']) ? $taxonomy2['hierarchical'] : true;
        register_taxonomy($taxonomy2['slug'], $taxonomy2['post_type'], array(
            'hierarchical' => 1,
            'depth'              => 2,
            'labels' => $labels2,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => $rewrite2,
            'show_admin_column' => true,
        ));
    }
}
add_action('init', 'be_register_taxonomies');

/**************************************************
                Gallery CPT TAssign Parent
 **************************************************/
add_action('save_post', 'assign_parent_terms', 10, 2);

function assign_parent_terms($post_id, $post)
{
    $arrayPostTypeAllowed = array('galleryimages');
    $arrayTermsAllowed = array('gallery-category');

    //Check post type
    if (!in_array($post->post_type, $arrayPostTypeAllowed)) {
        return $post_id;
    } else {

        // get all assigned terms   
        foreach ($arrayTermsAllowed as $t_name) {
            $terms = wp_get_post_terms($post_id, $t_name);

            foreach ($terms as $term) {

                while ($term->parent != 0 && !has_term($term->parent, $t_name, $post)) {

                    // move upward until we get to 0 level terms
                    wp_set_post_terms($post_id, array($term->parent), $t_name, true);
                    $term = get_term($term->parent, $t_name);
                }
            }
        }
    }
}
/**************************************************
                Gallery CPT Taxonomy
 **************************************************/
function cptui_register_my_taxes_gallery_tags()
{
    $labels = [
        "name" => __("Applications", "custom-post-type-ui"),
        "singular_name" => __("Gallery Tags", "custom-post-type-ui"),
    ];

    $args = [
        "label" => __("Gallery Tags", "custom-post-type-ui"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ['slug' => 'gallery_tags', 'with_front' => true,],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "rest_base" => "gallery_tags",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
    ];
    register_taxonomy("gallery_tags", ["galleryimages"], $args);
}
add_action('init', 'cptui_register_my_taxes_gallery_tags');
