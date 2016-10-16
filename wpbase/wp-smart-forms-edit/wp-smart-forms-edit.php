<?php
/*
Plugin Name: Wp Smart Forms Edit
Plugin URI: 
Version: 1.0
Author: Lasantha Attanayake
Description: This plugin use to Edit the cleints of  smart forms
*/
?>
<?php
//Include the plugin function class
// require_once(dirname(__FILE__).'/class/role_manager.class.php');
// Object to call roleManager class
$smartFormclients = new smartFormclients();

/* 
	Plugin Funtion Class
	
*/
class smartFormclients{
	function __construct(){
		//SETUP
		//action hook for plugin activation
		register_activation_hook( __FILE__, 'callback_plugin' );
		add_action('admin_menu', array($this,'smart_formsmanage_clients_menu'));
		add_action('smart_formsmanage_clients_header',array($this,'wp_role_manager_admin_scripts'));
	}
	//callback function
	function callback_plugin(){

	}
	//Add plugin pages to menu
	function smart_formsmanage_clients_menu() {

		add_submenu_page("smart_forms_menu", "Edit Clients", "Edit Clients",'administrator', "smart-formsmanage-clients",  array($this,'smart_formsmanage_clients'));

	}

	//ADMIN SCRIPTS - Add support js ad css files to admin pages
	function wp_role_manager_admin_scripts(){
		wp_register_style( 'bootstrap_min_css', plugin_dir_url( __FILE__ ).'css/bootstrap.min.css' );
		wp_enqueue_style( 'bootstrap_min_css');
		wp_register_style( 'font_awesome', plugin_dir_url( __FILE__ ).'css/font-awesome.css' );
		wp_enqueue_style( 'font_awesome');
		wp_register_style( 'smart_form_edit_clients', plugin_dir_url( __FILE__ ).'css/smart_form_edit_clients.css' );
		wp_enqueue_style( 'smart_form_edit_clients');

		wp_register_script( 'bootstrap_min_js', plugin_dir_url( __FILE__ ).'js/bootstrap.min.js' );
		wp_enqueue_script( 'bootstrap_min_js');
	}

	function smart_formsmanage_clients(){
		global $wpdb;
		
		if( isset($_POST) && !empty($_POST['entry_id'])){
			
			$fieldSet = explode(',', $_POST['fieldSet']);
			$data = array();
			$mData = array();
			foreach ($fieldSet  as $key => $value) {
				$data[$value] = array('value' =>$_POST[$value]);
				$mData[$value] =  array('value' =>$_POST[$value]);
			}
			$dataJ = json_encode($data);
			$res = $wpdb->update( 'ce_rednao_smart_forms_entry', array('data'=>$dataJ), array( 'entry_id' => $_POST['entry_id'] ), 
				array( 
					'%s',	// value1
				), 
				array( '%s' ) );

			foreach ($fieldSet  as $key => $value) {
				$dataS = json_encode($mData[$value]);
				$wpdb->update( 'ce_rednao_smart_forms_entry_detail', 
					array('json_value' =>$dataS), 
					array( 'entry_id' => $_POST['entry_id'],'field_id'=> $value ), 
					array( 
						'%s',	// value1

					), 
					array( '%s' ) );
			}

			
		}

		include_once('inc/clients.php');
	}

	function smart_formsmanage_clients_edit(){

	}

	function __destruct(){

	}
	

}
?>