<?php 
/**
   * Register a web post type, with REST API support
   *
   * Based on example at: http://codex.wordpress.org/Function_Reference/register_post_type
   */
  add_action( 'init', 'my_fbapp_cpt' );
  function my_fbapp_cpt() {
    $labels = array(
      'name'               => _x( 'FbApps', 'post type general name', 'your-plugin-textdomain' ),
      'singular_name'      => _x( 'FbApp', 'post type singular name', 'your-plugin-textdomain' ),
      'menu_name'          => _x( 'FbApps', 'admin menu', 'your-plugin-textdomain' ),
      'name_admin_bar'     => _x( 'FbApp', 'add new on admin bar', 'your-plugin-textdomain' ),
      'add_new'            => _x( 'Add New', 'fbapp', 'your-plugin-textdomain' ),
      'add_new_item'       => __( 'Add New FbApp', 'your-plugin-textdomain' ),
      'new_item'           => __( 'New FbApp', 'your-plugin-textdomain' ),
      'edit_item'          => __( 'Edit FbApp', 'your-plugin-textdomain' ),
      'view_item'          => __( 'View FbApp', 'your-plugin-textdomain' ),
      'all_items'          => __( 'All FbApps', 'your-plugin-textdomain' ),
      'search_items'       => __( 'Search FbApps', 'your-plugin-textdomain' ),
      'parent_item_colon'  => __( 'Parent FbApps:', 'your-plugin-textdomain' ),
      'not_found'          => __( 'No fbapps found.', 'your-plugin-textdomain' ),
      'not_found_in_trash' => __( 'No fbapps found in Trash.', 'your-plugin-textdomain' )
    );
  
    $args = array(
      'labels'             => $labels,
      'description'        => __( 'Description.', 'your-plugin-textdomain' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'fbapp' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => null,
      'show_in_rest'       => true,
      'rest_base'          => 'fbapps-api',
      'rest_controller_class' => 'WP_REST_Posts_Controller',
      'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );
  
    register_post_type( 'fbapp', $args );
}
?>