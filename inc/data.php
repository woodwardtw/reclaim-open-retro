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

