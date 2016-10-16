<?php
/*
Plugin Name: Wp Role Manager
Plugin URI: 
Version: 1.0
Author: Lasantha Attanayake
Description: This plugin use to add new user roles / add and remove user capabilities
*/
?>
<?php
//Include the plugin function class
// require_once(dirname(__FILE__).'/class/role_manager.class.php');
// Object to call roleManager class
$roleManager = new roleManager();

/* 
	Plugin Funtion Class
	
*/
class roleManager{
	function __construct(){
		//SETUP
		//action hook for plugin activation
		register_activation_hook( __FILE__, 'callback_plugin' );
		add_action('admin_menu', array($this,'role_manager_menu'));
		add_action('wp_role_manager_header',array($this,'wp_role_manager_admin_scripts'));
	}
	//callback function
	function callback_plugin(){

	}
	//Add plugin pages to menu
	function role_manager_menu() {
		add_menu_page('WP Role Manager', 'WP Role Manager', 'administrator', 'wp-role-manager', array($this,'wp_role_manager_panel'),'dashicons-universal-access');
		add_submenu_page("wp-role-manager", "WP Add New Role", "WP Add New Role",'administrator', "wp-role-manager-add-new",  array($this,'wp_role_manager_add_new'));
		add_submenu_page("wp-role-manager", "WP Add New Capabilities", "WP Add New Capabilities",'administrator', "wp-role-manager-add-capabilities",  array($this,'wp_role_manager_add_capabilities'));
		
	}

	//ADMIN SCRIPTS - Add support js ad css files to admin pages
	function wp_role_manager_admin_scripts(){
		wp_register_style( 'bootstrap_min_css', plugin_dir_url( __FILE__ ).'css/bootstrap.min.css' );
		wp_enqueue_style( 'bootstrap_min_css');
		wp_register_style( 'font_awesome', plugin_dir_url( __FILE__ ).'css/font-awesome.css' );
		wp_enqueue_style( 'font_awesome');
		wp_register_style( 'wp_role_manager_css', plugin_dir_url( __FILE__ ).'css/wp_role_manager_css.css' );
		wp_enqueue_style( 'wp_role_manager_css');

		wp_register_script( 'bootstrap_min_js', plugin_dir_url( __FILE__ ).'js/bootstrap.min.js' );
		wp_enqueue_script( 'bootstrap_min_js');
	}

	function wp_role_manager_panel(){
		include_once('inc/roles.php');
	}

	function wp_role_manager_add_new(){
		include_once('inc/add_roles.php');
	}

	function wp_role_manager_add_capabilities(){
		include_once('inc/add_capabilities.php');
	}

	function get_all_user_roles(){
		//display roles
		global $wp_roles;

	    $all_roles = $wp_roles->roles;
	    foreach ($all_roles as $key => $value) {
	    	// var_dump($value["name"]);
	    }
	    $editable_roles = apply_filters('editable_roles', $all_roles);
	    return $editable_roles;
	}

	function __destruct(){

	}
	

}
?>