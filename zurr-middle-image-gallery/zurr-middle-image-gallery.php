<?php 
/*
Plugin Name: Zurr Middle Image Gallery
Plugin URI: http://#
Description: Image Uploading and Displaying responsive gallery
Version: 1.0
Author: Lasantha kanchana Attanayake
Author URI: http://lasantha.info
License: GPL2
*/
//SETUP
//action hook for plugin activation
register_activation_hook( __FILE__, 'middle_plugin_install' );
//callback function
function middle_plugin_install(){
	global $wpdb;
	$table_name = $wpdb->prefix . "middle_image_slider_lka";
	//if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		$sql = "DROP TABLE IF EXISTS `wp_middle_image_slider_lka`; 
	   CREATE TABLE `wp_middle_image_slider_lka` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `meta_data` text NOT NULL,
		  `created_by` int(11) NOT NULL,
		  `created` datetime NOT NULL,
		  `order` int(11) NOT NULL,
		  PRIMARY KEY (`id`)
		);";
		//reference to upgrade.php file
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	//}
}

//SCRIPTS
function zurr_middle_image_gallery_scripts(){
	wp_register_style( 'zurr_middle_image_gallery_css', plugin_dir_url( __FILE__ ).'css/zurr-middle-image-gallery.css' );
	wp_enqueue_style( 'zurr_middle_image_gallery_css');
}

add_action('wp_enqueue_scripts','zurr_middle_image_gallery_scripts');

function zurr_middle_image_gallery_admin_scripts(){
	wp_enqueue_media ();
	wp_register_script( 'zurr_middle_image_gallery_js', plugin_dir_url( __FILE__ ).'js/zurr-middle-image-gallery-scripts.js' );
	wp_enqueue_script( 'zurr_middle_image_gallery_js');
}
add_action('admin_enqueue_scripts','zurr_middle_image_gallery_admin_scripts');

add_action('admin_menu', 'zurr_middle_slider_plugin_settings');

function zurr_middle_slider_plugin_settings() {

    add_menu_page('middle slider', 'middle slider', 'administrator', 'middle-slider-admin', 'middle_slider_admin_panel');
	add_submenu_page("middle-slider-admin", "middle slider options", "middle slider options",'administrator', "middle-slider-admin-options", "middle_slider_admin_options");
	add_submenu_page("middle-slider-admin", "middle slider add images", "middle slider add images",'administrator', "middle-slider-admin-add-images", "middle_slider_admin_add_images");

}

function middle_slider_admin_panel(){
	global $wpdb;
	$qry = "SELECT * FROM wp_middle_image_slider_lka order by created;";
  	$data = $wpdb->get_results( $qry );
   ?>
	<div class="zurr_slider_admin_wrapper">
    	<table>
        	<tr>
           		<th width="10%" align="left">ID</th> 
                <th width="30%" align="left">Order</th>
                <th width="10%" align="left">Image</th>
                <th width="20%" align="left">Created</th>
                <th width="20%" align="left">Uploaded By</th>
                <th width="5%" align="left">Edit</th>
                <th width="5%" align="left">Delete</th>
            </tr>
           <?php foreach($data as $key=>$value):?>
            <tr>
                <td><?php echo $value->id;?></td>  
                <td><?php echo $value->order;?></td>
                <td><?php 
					$det = maybe_unserialize($value) ;
					$det = maybe_unserialize($det->meta_data);
					?>
                    <img src="<?php echo plugin_dir_url( __FILE__ ).$det['path'];?>" width="50" />
                </td>
                <td><?php echo $value->created_by;?></td>
                <td><?php echo $value->created;?></td> 
                <td><a href="?page=middle-slider-admin-add-images&id=<?php echo $value->id;?>">Edit</a></td>  
                <td><a href="#" class="delete-mid-img" id="<?php echo $value->id;?>">Detete</a></td>  
            </tr> 
		   <?php endforeach;?>
        </table>
    </div>
<?php }

function middle_slider_admin_options(){
	$zurr_middle_image_count    = (get_option('zurr_middle_image_count') != '') ? get_option('zurr_middle_image_count') : '6';
	$zurr_middle_image_rows     = (get_option('zurr_middle_image_rows') != '') ? get_option('zurr_middle_image_rows') : '1';
	$zurr_middle_image_height     = (get_option('zurr_middle_image_height') != '') ? get_option('zurr_middle_image_height') : '150';
    $html = '</pre>
<div class="wrap"><form action="options.php" method="post" name="options">
<h2>Select Your Settings</h2>
' . wp_nonce_field('update-options') . '
<table class="form-table" width="100%" cellpadding="10">
<tbody>
<tr>
<td scope="row" align="left">
 	<label>Number of Row(s)</label><input type="text" name="zurr_middle_image_rows" value="' . $zurr_middle_image_rows . '" /></td>
</td>
</tr>
<tr>
<td scope="row" align="left">
 	<label>Images For Row</label><input type="text" name="zurr_middle_image_count" value="' . $zurr_middle_image_count . '" /></td>
</td>
</tr>
<tr>
<td scope="row" align="left">
 	<label>Images Height</label><input type="text" name="zurr_middle_image_height" value="' . $zurr_middle_image_height . '" /></td>
</td>
</tr>
</tbody>
</table>
 <input type="hidden" name="action" value="update" />

 <input type="hidden" name="page_options" value="zurr_middle_image_rows,zurr_middle_image_count,zurr_middle_image_height" />

 <input type="submit" name="Submit" value="Update" /></form></div>
<pre>
';

    echo $html;
}

function middle_slider_admin_add_images(){
	$path = '';
	$cat  = '';
	$id = '';
	if(!empty($_GET['id'])){
		$id = $_GET['id'];
		$res = getMiddleImageData($id);
		$path = $res['image'];
		$cat  = $res['cat'];
	}
	?>

    	<div class="zurr_slider_admin_wrapper">
        <input type="hidden" name="hdn-id" id="hdn-id" value="<?php echo $id;?>" />
    	<table>
            <tr>
                <td><input type="button" name="zurr-middle-image" id="zurr-middle-image" value="Select the photo" /></td>  
                <td><img src="<?php echo $path;?>" width="100" id="selected-image" /></td> 
            </tr> 
            <tr>
                <td>Add URL</td>  
                <td>
				<select name="zurr-slider-url" id="zurr-slider-url">
				<?php $wcatTerms = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC',  'parent' =>0)); //, 'exclude' => '17,77'
                foreach($wcatTerms as $wcatTerm) : 
                    $wthumbnail_id = get_woocommerce_term_meta( $wcatTerm->term_id, 'thumbnail_id', true );
                    $wimage = wp_get_attachment_url( $wthumbnail_id );
					$selectedM = '';
					if(str_replace(site_url(),'',get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy )) == $cat){
						$selectedM = "selected";
					}
                ?>
                        <option value="<?php echo str_replace(site_url(),'',get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy )); ?>" <?php echo $selectedM;?>><?php echo $wcatTerm->name; ?></option>
  
                        <?php
                        $wsubargs = array(
                           'hierarchical' => 1,
                           'show_option_none' => '',
                           'hide_empty' => 0,
                           'parent' => $wcatTerm->term_id,
                           'taxonomy' => 'product_cat'
                        );
                        $wsubcats = get_categories($wsubargs);
                        foreach ($wsubcats as $wsc):
						$selectedS = '';
						if(str_replace(site_url(),'',get_term_link( $wsc->slug, $wsc->taxonomy )) == $cat){
							$selectedS = "selected";
						}
                        ?>
                            <option value="<?php echo str_replace(site_url(),'',get_term_link( $wsc->slug, $wsc->taxonomy ));?>" <?php echo $selectedS;?>>-<?php echo $wsc->name;?></a></option>
                        <?php
                        endforeach;
                        ?>  
                        
            <?php 
                endforeach; 
            ?>
            </select>
                </td> 
            </tr>
            <tr>
                <td><button type="reset" value="Clear">Clear</button></td>  
                <td><button type="button" value="Upload" id="btn-middle-upload">Save</button></td> 
  
            </tr>
        </table>
        
    </div>
    <?php
}

//SHORT CODES
add_shortcode("middle_slider", "middle_display_slider");
function middle_display_slider() {
	global $wpdb;
  	$plugins_url = plugins_url();
	$qry = "SELECT * FROM wp_middle_image_slider_lka order by created limit 6;";
  	$data = $wpdb->get_results( $qry );
	$c=0;
	$zurr_middle_image_count    = (get_option('zurr_middle_image_count') != '') ? get_option('zurr_middle_image_count') : '3';
	$zurr_middle_image_rows     = (get_option('zurr_middle_image_rows') != '') ? get_option('zurr_middle_image_rows') : '1';
	$zurr_middle_image_height     = (get_option('zurr_middle_image_height') != '') ? get_option('zurr_middle_image_height') : '150';
	//create row 
	for($i=0;$i<$zurr_middle_image_rows;$i++){
		$html .= '<div class="row clearfix">';	
		$html .= getResultSet(array_slice($data, $i*$zurr_middle_image_count, $i*$zurr_middle_image_count + $zurr_middle_image_count),$zurr_middle_image_height);
		$html .= '</div>';	
	}
	echo $html;
				
 ?>  
 <?php 
}

function getResultSet($data,$zurr_middle_image_height){
	$html ='';
	foreach($data as $key=>$value):
		$det = maybe_unserialize($value) ;
		$det = maybe_unserialize($det->meta_data);
		$html .=  '<article class="middle_slider">
                    <a href="'.site_url().$det['url'].'">
                        <img src="'.site_url().$det['path'].'" alt="Shop Suits" />
                    </a>
                    <section class="overlay">
                    </section>
                </article>';
	endforeach;
	return $html;
}
function ajax_zurr_middle_add_changes_action(){
	global $wpdb;
    $imageUrl =  $_POST['imageUrl'];
    $category =  $_POST['category'];
	$id       =  $_POST['id'];
	$arrayMetaData = array();
	$arrayMetaData['path'] = str_replace(site_url(),'',$imageUrl);
	$arrayMetaData['url']  = str_replace(site_url(),'',$category);
	if($id == ''){
		$query = "INSERT INTO wp_middle_image_slider_lka (`meta_data`,`created_by`,`created`,`order`) VALUES ('".maybe_serialize($arrayMetaData)."','1',now(),'1')";
	}
	else{
		$query = "UPDATE wp_middle_image_slider_lka SET `meta_data` = '".maybe_serialize($arrayMetaData)."',`created_by` = '1',`created` = now() WHERE id = '".$id."'";
	}
	$arrImage = array();
	if($wpdb->query($query)){
		$arrImage['result'] = 'true';	
	}
    
    echo json_encode($arrImage);
    die();
}
add_action('wp_ajax_zurr_middle_add_changes_action', 'ajax_zurr_middle_add_changes_action');
add_action('wp_ajax_nopriv_zurr_middle_add_changes_action', 'ajax_zurr_middle_add_changes_action');

function ajax_zurr_middle_delete_changes_action(){
	global $wpdb;
	$id       =  $_POST['id'];
	$arrImage = array();
	$query = "DELETE FROM wp_middle_image_slider_lka  WHERE id = '".$id."'";
	if($wpdb->query($query)){
		$arrImage['result'] = 'true';	
	}
    
    echo json_encode($arrImage);
    die();
}
add_action('wp_ajax_zurr_middle_delete_changes_action', 'ajax_zurr_middle_delete_changes_action');
add_action('wp_ajax_nopriv_zurr_middle_delete_changes_action', 'ajax_zurr_middle_delete_changes_action');

function getMiddleImageData($id=NULL){
	global $wpdb;
	$query = "SELECT * FROM wp_middle_image_slider_lka WHERE wp_middle_image_slider_lka.id = '".$id."'";
	$data = $wpdb->get_results($query);
	foreach( $data as $key => $value){
			$det = maybe_unserialize($value) ;
			$det = maybe_unserialize($det->meta_data);
   			return array('image'=>$det['path'],'cat'=>$det['url']);
	}
	
}
?>