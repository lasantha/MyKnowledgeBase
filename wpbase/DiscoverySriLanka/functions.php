<?php
/**
 * DiscoverySriLanka functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DiscoverySriLanka
 */

if ( ! function_exists( 'DiscoverySriLanka_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function DiscoverySriLanka_setup() {
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'DiscoverySriLanka' ),
	) );
}
endif;
add_action( 'after_setup_theme', 'DiscoverySriLanka_setup' );


/**
 * Enqueue scripts and styles.
 */
function dsl_scripts() {
		// Styles for Bootstrap and Font Awesome
	wp_enqueue_style( 'staticcss', get_stylesheet_directory_uri() . '/css/staticcss.css');
	wp_enqueue_style( 'stylesheet', get_stylesheet_directory_uri() . '/style.css');
		// Scripts for Jquery and Bootstrap

	wp_enqueue_script( 'staticjs', get_stylesheet_directory_uri() . '/js/staticjs.js', array( 'jquery' ),true,false );

	wp_register_script('custom_scripts',get_template_directory_uri() . '/js/scripts.js');
	wp_localize_script( 'custom_scripts', 'ajax_url', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	wp_localize_script( 'custom_scripts', 'post', array( 'id' => get_the_id()));
	wp_localize_script( 'custom_scripts', 'nonce', array( 'ajax_nonce' => wp_create_nonce('citerp')));
	wp_localize_script( 'custom_scripts', 'media_nonce', array( 'ajax_nonce' => wp_create_nonce('media-form')));

		// wp_enqueue_script( 'custom_scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(),false,false );
		// 
	
		// Enqueue our scripts
	wp_enqueue_script('custom_scripts',false,true );
		// wp_enqueue_script('angularjs-route');
}
add_action( 'wp_enqueue_scripts', 'dsl_scripts' );

// Host Detection functions

// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

// Function to get the client IP address
function get_client_ip_server() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
//Get Page Id Using template
function getPageIDs( $template = NULL ){
    $args = [
        'post_type' => 'page',
        'fields' => 'ids',
        'nopaging' => true,
        'meta_key' => '_wp_page_template',
        'meta_value' => "page-templates/{$template}"
    ];

    $pages = get_posts( $args );
    return $pages;
}


// Custom Main menu  
function clean_custom_menu( $theme_location ) {
    global $post;
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
 
        // $menu_list  = '<nav>' ."\n";
        $menu_list .= '<ul class="main-nav">' ."\n";
 
        $count = 0;
        $submenu = false;
         
        $icons = get_field('main_menu_icons',get_option('page_on_front'));
        $menuIcon = array();

        foreach ($icons as $key => $value) {
            $menuIcon[$value['item_name']] = $value['item_icon'];
        }
        //var_dump($menuIcon);
        foreach( $menu_items as $menu_item ) {
            $link = $menu_item->url;
            $title = $menu_item->title;
             
            if ( !$menu_item->menu_item_parent ) {
                $parent_id = $menu_item->ID;
                $active = (strtolower($post->post_title) == strtolower($title)) ?"active":"";
                $menu_list .= '<li class="item '.$active.'">' ."\n";
                $menu_list .= '<a href="'.$link.'" class="title">';
                //echo strtolower($title);
                $menu_list .= $menuIcon[strtolower($title)];
                $menu_list .= $title.'</a></li>' ."\n";
            }
 
            if ( $parent_id == $menu_item->menu_item_parent ) {
 
                if ( !$submenu ) {
                    $submenu = true;
                    $menu_list .= '<ul class="sub-menu">' ."\n";
                }
 
                $menu_list .= '<li class="item">' ."\n";
                $menu_list .= '<a href="'.$link.'" class="title">'.$title.'</a>' ."\n";
                $menu_list .= '</li>' ."\n";
                     
 
                if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ){
                    $menu_list .= '</ul>' ."\n";
                    $submenu = false;
                }
 
            }
 
            if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id ) { 
                $menu_list .= '</li>' ."\n";      
                $submenu = false;
            }
 
            $count++;
        }
         
        $menu_list .= '</ul>' ."\n";
        // $menu_list .= '</nav>' ."\n";
 
    } else {
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }
    echo $menu_list;
}

// ======================================================
function register_footer_menu() {
  register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'register_footer_menu' );
//Deletes all CSS classes and id's, except for those listed in the array below
function custom_wp_nav_menu($var) {
  return is_array($var) ? array_intersect($var, array(
        //List of allowed menu classes
        'current_page_item',
        'current_page_parent',
        'current_page_ancestor',
        'first',
        'last',
        'vertical',
        'horizontal'
        )
    ) : '';
}
add_filter('nav_menu_css_class', 'custom_wp_nav_menu');
add_filter('nav_menu_item_id', 'custom_wp_nav_menu');
add_filter('page_css_class', 'custom_wp_nav_menu');


//Replaces "current-menu-item" with "active"
function current_to_active($text){
    $replace = array(
        //List of menu item classes that should be changed to "active"
        'current_page_item' => 'active',
        'current_page_parent' => 'active',
        'current_page_ancestor' => 'active',
    );
    $text = str_replace(array_keys($replace), $replace, $text);
        return $text;
    }
add_filter ('wp_nav_menu','current_to_active');
//Deletes empty classes and removes the sub menu class
function strip_empty_classes($menu) {
    $menu = preg_replace('/ class=""| class="sub-menu"/','',$menu);
    return $menu;
}
add_filter ('wp_nav_menu','strip_empty_classes');
// =====================================================

// Custom Post type for packages
// https://www.iplocation.net
function dsl_custom_post_package() {
  $labels = array(
    'name'               => _x( 'Packages', 'post type general name' ),
    'singular_name'      => _x( 'Package', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'add_new_item'       => __( 'Add New Package' ),
    'edit_item'          => __( 'Edit Package' ),
    'new_item'           => __( 'New Package' ),
    'all_items'          => __( 'All Package' ),
    'view_item'          => __( 'View Package' ),
    'search_items'       => __( 'Search Packages' ),
    'not_found'          => __( 'No packages found' ),
    'not_found_in_trash' => __( 'No packages found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Packages'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our tour packages and package specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt'),
    'has_archive'   => true,
  );
  register_post_type( 'package', $args ); 
}
add_action( 'init', 'dsl_custom_post_package' );


function dsl_taxonomies_package() {
  $labels = array(
    'name'              => _x( 'Package Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Package Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Package Categories' ),
    'all_items'         => __( 'All Package Categories' ),
    'parent_item'       => __( 'Parent Package Category' ),
    'parent_item_colon' => __( 'Parent Package Category:' ),
    'edit_item'         => __( 'Edit Package Category' ), 
    'update_item'       => __( 'Update Package Category' ),
    'add_new_item'      => __( 'Add New Package Category' ),
    'new_item_name'     => __( 'New Package Category' ),
    'menu_name'         => __( 'Package Categories' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'package_category', 'package', $args );
}
add_action( 'init', 'dsl_taxonomies_package', 0 );

// Custom Post type for Destinations
function dsl_custom_post_destination() {
  $labels = array(
    'name'               => _x( 'Destinations', 'post type general name' ),
    'singular_name'      => _x( 'Destination', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'add_new_item'       => __( 'Add New Destination' ),
    'edit_item'          => __( 'Edit Destination' ),
    'new_item'           => __( 'New Destination' ),
    'all_items'          => __( 'All Destination' ),
    'view_item'          => __( 'View Destination' ),
    'search_items'       => __( 'Search Destinations' ),
    'not_found'          => __( 'No destinations found' ),
    'not_found_in_trash' => __( 'No destinations found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Destinations'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our tour destinations and destination specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt'),
    'has_archive'   => true,
  );
  register_post_type( 'destination', $args ); 
}
add_action( 'init', 'dsl_custom_post_destination' );

function dsl_taxonomies_destination() {
  $labels = array(
    'name'              => _x( 'Destination Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Destination Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Destination Categories' ),
    'all_items'         => __( 'All Destination Categories' ),
    'parent_item'       => __( 'Parent Destination Category' ),
    'parent_item_colon' => __( 'Parent Destination Category:' ),
    'edit_item'         => __( 'Edit Destination Category' ), 
    'update_item'       => __( 'Update Destination Category' ),
    'add_new_item'      => __( 'Add New Destination Category' ),
    'new_item_name'     => __( 'New Destination Category' ),
    'menu_name'         => __( 'Destination Categories' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'destination_category', 'destination', $args );
}
add_action( 'init', 'dsl_taxonomies_destination', 0 );

// breadcrumb
// Breadcrumbs
function get_breadcrumb() {
       
    // Settings
    $separator          = '&gt;';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Homepage';
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
           
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
              
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            // Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end(array_values($category));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
              
            } else {
                  
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
       
        echo '</ul>';
           
    }
       
}


function getSiteData( $customField  = NULL ){
    return get_field($customField,get_option('page_on_front'));
}

// Set the title tags
function set_title(){
    global $post;
    $title = get_field('title_tags',$post->ID);
    if (empty($title)) {
        $title = $post->post_title;
    }
    echo $title .' | '. get_bloginfo( 'name' );
}

// Set Site Description
function set_description(){
    global $post;
    $decription = get_field('decription',$post->ID);
    if (empty($decription)) {
        $decription =  get_field('decription',get_option('page_on_front'));
    }
    echo $decription;
}

// Set Site Key Words
function set_keywords(){
    global $post;
    $key_words = get_field('key_words',$post->ID);
    if (empty($key_words)) {
        $key_words = get_field('key_words',get_option('page_on_front'));
    }
    echo $key_words;
}

//Get the Tour Packages
function getPackages(){
    $args = array( 'post_type' => 'package', 'posts_per_page' => -1 );
    $loop = new WP_Query( $args );
    $arrayPackages = array();
    while ( $loop->have_posts() ) : $loop->the_post();
        $arrayPackages[get_the_id()] =  get_the_title();
    endwhile;
    return $arrayPackages;
}

function getDestinations(){
    $args = array( 'post_type' => 'destination', 'posts_per_page' => -1 );
    $loop = new WP_Query( $args );
    $arrayDestinations = array();
    $i = 0;
    while ( $loop->have_posts() ) : $loop->the_post();
        $arrayDestinations[$i]['title'] =  get_the_title();
        $arrayDestinations[$i]['url'] =  get_the_permalink(get_the_id());
        $i++;
    endwhile;
    return $arrayDestinations;
}

function getTopDestinations(){
    $args = array( 'post_type' => 'destination', 'posts_per_page' => -1 );
    $loop = new WP_Query( $args );
    $arrayDestinations = array();
    
    while ( $loop->have_posts() ) : $loop->the_post();
        $destination_images         = get_field('destination_images',get_the_id());
        $postID = get_the_id();
        $arrayDestinations[$postID]['url'] =  get_the_permalink();
        if(!empty($destination_images[0]["image"]["url"])){
                $arrayDestinations[$postID]['image'] =  $destination_images[0]["image"]["url"];
        }
        
    endwhile;
    return $arrayDestinations;
}

function getTopPackages(){
    $args = array( 'post_type' => 'package', 'posts_per_page' => -1 );
    $loop = new WP_Query( $args );
    $arrayPackages = array();
    $i = 0;
    while ( $loop->have_posts() ) : $loop->the_post();
        $arrayPackages[$i]['title'] =  get_the_title();
        $arrayPackages[$i]['url'] =  get_the_permalink();
        $package_images         = get_field('package_image',get_the_id());
        $arrayPackages[$i]['image'] =  $package_images;
        $package_duration       = get_field('package_duration',get_the_id());
        $arrayPackages[$i]['duration'] =  $package_duration;
        $i++;
    endwhile;
    return $arrayPackages;
}

function getReviews(){
    $pageID = getPageIDs('tpl_reviews.php');
    $reviews = get_field('reviews',$pageID[0]);
    return $reviews;
}

// --------------

$api_request    = 'http://api.ean.com/ean-services/rs/hotel/v3/avail?cid=55505&minorRev=99&apiKey=cbrzfta369qwyrm9t5b8y8kf&locale=en_US...';
$api_response = wp_remote_get( $api_request );
$api_data = json_decode( wp_remote_retrieve_body( $api_response ), true );
// echo "<pre>";
// var_dump($api_data);
// die();