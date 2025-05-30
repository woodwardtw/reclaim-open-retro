<?php
/**
 * Custom data structures for the Reclaim Open
 *
 * 
 *
 *
 *
 *
 * @package Reclaim_Open_Retro_v_Justin
 */


//session custom post type

// Register Custom Post Type session
// Post Type Key: session

function create_session_cpt() {

  $labels = array(
    'name' => __( 'Sessions', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Session', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Session', 'textdomain' ),
    'name_admin_bar' => __( 'Session', 'textdomain' ),
    'archives' => __( 'Session Archives', 'textdomain' ),
    'attributes' => __( 'Session Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Session:', 'textdomain' ),
    'all_items' => __( 'All Sessions', 'textdomain' ),
    'add_new_item' => __( 'Add New Session', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Session', 'textdomain' ),
    'edit_item' => __( 'Edit Session', 'textdomain' ),
    'update_item' => __( 'Update Session', 'textdomain' ),
    'view_item' => __( 'View Session', 'textdomain' ),
    'view_items' => __( 'View Sessions', 'textdomain' ),
    'search_items' => __( 'Search Sessions', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into session', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this session', 'textdomain' ),
    'items_list' => __( 'Session list', 'textdomain' ),
    'items_list_navigation' => __( 'Session list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter Session list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'session', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => '',
    'supports' => array('title', 'editor', 'revisions', 'author', 'trackbacks', 'custom-fields', 'thumbnail',),
    'taxonomies' => array('category', 'post_tag'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-universal-access-alt',
  );
  register_post_type( 'session', $args );
  
  // flush rewrite rules because we changed the permalink structure
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_action( 'init', 'create_session_cpt', 0 );

add_action( 'init', 'create_theme_taxonomies', 0 );
function create_theme_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Themes', 'taxonomy general name' ),
    'singular_name' => _x( 'theme', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Themes' ),
    'popular_items' => __( 'Popular Themes' ),
    'all_items' => __( 'All Themes' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Themes' ),
    'update_item' => __( 'Update theme' ),
    'add_new_item' => __( 'Add New theme' ),
    'new_item_name' => __( 'New theme' ),
    'add_or_remove_items' => __( 'Add or remove Themes' ),
    'choose_from_most_used' => __( 'Choose from the most used Themes' ),
    'menu_name' => __( 'Theme' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('themes', array('session'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'theme' ),
    'show_in_rest'          => true,
    'rest_base'             => 'theme',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => true,    
  ));
}


add_action( 'init', 'create_type_taxonomies', 0 );
function create_type_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Types', 'taxonomy general name' ),
    'singular_name' => _x( 'type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Types' ),
    'popular_items' => __( 'Popular Types' ),
    'all_items' => __( 'All Types' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Types' ),
    'update_item' => __( 'Update type' ),
    'add_new_item' => __( 'Add New type' ),
    'new_item_name' => __( 'New type' ),
    'add_or_remove_items' => __( 'Add or remove Types' ),
    'choose_from_most_used' => __( 'Choose from the most used Types' ),
    'menu_name' => __( 'Type' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('types', array('session'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type' ),
    'show_in_rest'          => true,
    'rest_base'             => 'type',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => true,    
  ));
}





