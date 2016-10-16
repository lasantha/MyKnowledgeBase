<?php 
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
	}

	//ADMIN SCRIPTS - Add support js ad css files to admin pages
	function wp_role_manager_admin_scripts(){
		wp_register_style( 'bootstrap_min_css', plugin_dir_url( __FILE__ ).'css/bootstrap.min.css' );
		wp_enqueue_style( 'bootstrap_min_css');
		wp_register_style( 'font_awesome', plugin_dir_url( __FILE__ ).'css/font-awesome.css' );
		wp_enqueue_style( 'font_awesome');
		

		wp_register_script( 'bootstrap_min_js', plugin_dir_url( __FILE__ ).'js/bootstrap.min.js' );
		wp_enqueue_script( 'bootstrap_min_js');
	}

	function wp_role_manager_panel(){
		include_once(plugin_dir_url( __FILE__ ).'inc/view.php');
		//display roles
		global $wp_roles;

	    $all_roles = $wp_roles->roles;
	    echo "<div='container'></div><pre>";
	    foreach ($all_roles as $key => $value) {
	    	var_dump($value["name"]);
	    }
	     echo "<pre>";

	    $editable_roles = apply_filters('editable_roles', $all_roles);

	    return $editable_roles;
	}

	function __destruct(){

	}
	

}
?>