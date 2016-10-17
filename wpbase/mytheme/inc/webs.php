<?php 
  /**
   * Register a web post type, with REST API support
   *
   * Based on example at: http://codex.wordpress.org/Function_Reference/register_post_type
   */
  add_action( 'init', 'my_web_cpt' );
  function my_web_cpt() {
    $labels = array(
      'name'               => _x( 'Webs', 'post type general name', 'your-plugin-textdomain' ),
      'singular_name'      => _x( 'Web', 'post type singular name', 'your-plugin-textdomain' ),
      'menu_name'          => _x( 'Webs', 'admin menu', 'your-plugin-textdomain' ),
      'name_admin_bar'     => _x( 'Web', 'add new on admin bar', 'your-plugin-textdomain' ),
      'add_new'            => _x( 'Add New', 'web', 'your-plugin-textdomain' ),
      'add_new_item'       => __( 'Add New Web', 'your-plugin-textdomain' ),
      'new_item'           => __( 'New Web', 'your-plugin-textdomain' ),
      'edit_item'          => __( 'Edit Web', 'your-plugin-textdomain' ),
      'view_item'          => __( 'View Web', 'your-plugin-textdomain' ),
      'all_items'          => __( 'All Webs', 'your-plugin-textdomain' ),
      'search_items'       => __( 'Search Webs', 'your-plugin-textdomain' ),
      'parent_item_colon'  => __( 'Parent Webs:', 'your-plugin-textdomain' ),
      'not_found'          => __( 'No webs found.', 'your-plugin-textdomain' ),
      'not_found_in_trash' => __( 'No webs found in Trash.', 'your-plugin-textdomain' )
    );
  
    $args = array(
      'labels'             => $labels,
      'description'        => __( 'Description.', 'your-plugin-textdomain' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'web' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => null,
      'show_in_rest'       => true,
      'rest_base'          => 'webs-api',
      'rest_controller_class' => 'WP_REST_Posts_Controller',
      'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );
  
    register_post_type( 'web', $args );
}


/**
   * Register a category post type, with REST API support
   *
   * Based on example at: https://codex.wordpress.org/Function_Reference/register_taxonomy
   */
  add_action( 'init', 'my_web_taxonomy', 30 );
  function my_web_taxonomy() {
  
    $labels = array(
      'name'              => _x( 'Categories', 'taxonomy general name' ),
      'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
      'search_items'      => __( 'Search Categories' ),
      'all_items'         => __( 'All Categories' ),
      'parent_item'       => __( 'Parent Category' ),
      'parent_item_colon' => __( 'Parent Category:' ),
      'edit_item'         => __( 'Edit Category' ),
      'update_item'       => __( 'Update Category' ),
      'add_new_item'      => __( 'Add New Category' ),
      'new_item_name'     => __( 'New Category Name' ),
      'menu_name'         => __( 'Category' ),
    );
  
    $args = array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => 'category' ),
      'show_in_rest'       => true,
      'rest_base'          => 'category',
      'rest_controller_class' => 'WP_REST_Terms_Controller',
    );
  
    register_taxonomy( 'category', array( 'web' ), $args );
  
  }
 ?>