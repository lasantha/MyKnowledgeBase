<?php
/**
 * myweb functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package myweb
 */

if ( ! function_exists( 'myweb_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function myweb_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on myweb, use a find and replace
	 * to change 'myweb' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'myweb', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'myweb' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'myweb_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;

$current_user = wp_get_current_user();
$url = explode('?', 'http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
$current_post = url_to_postid($url[0]);


class wp_ng_theme {
	
	function enqueue_scripts() {
		
		// Styles for Bootstrap and Font Awesome
		wp_enqueue_style( 'myweb_staticcss', get_stylesheet_directory_uri() . '/css/staticcss.css');
		wp_enqueue_style( 'stylesheet', get_stylesheet_directory_uri() . '/style.css');
		// Scripts for Jquery and Bootstrap
		wp_enqueue_script( 'angular-core', get_stylesheet_directory_uri() . '/js/staticjs.js', array( 'jquery' ),true,false );

		// wp_enqueue_script( 'angular-core', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js', array( 'jquery' ), '1.0', false );
		wp_enqueue_script( 'angular-resource', '//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-resource.js', array('angular-core'), '1.0', false );
		wp_enqueue_script( 'ui-router', 'https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.15/angular-ui-router.min.js', array( 'angular-core' ), '1.0', false );
		wp_enqueue_script( 'ngScripts', get_template_directory_uri() . '/js/scripts.js', array( 'ui-router' ), '1.0', false );
		wp_localize_script( 'ngScripts', 'appInfo',
			array(
				
				'api_url'			 => rest_get_url_prefix() . '/wp/v2/',
				'template_directory' => get_template_directory_uri() . '/',
				'nonce'				 => wp_create_nonce( 'wp_rest' ),
				'is_admin'			 => current_user_can('administrator')
				
			)
		);
		wp_localize_script( 'ngScripts', 'ajax_url', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	}
	
}

$ngTheme = new wp_ng_theme();
add_action( 'wp_enqueue_scripts', array( $ngTheme, 'enqueue_scripts' ) );




function myweb_scripts() {
	// Styles for Bootstrap and Font Awesome
	wp_enqueue_style( 'myweb_staticcss', get_stylesheet_directory_uri() . '/css/staticcss.css');
	wp_enqueue_style( 'stylesheet', get_stylesheet_directory_uri() . '/style.css');
	// Scripts for Jquery and Bootstrap
	wp_enqueue_script( 'staticjs', get_stylesheet_directory_uri() . '/js/staticjs.js', array( 'jquery' ),true,false );

	wp_register_script('custom_scripts',get_template_directory_uri() . '/js/scripts.js');
	wp_localize_script( 'custom_scripts', 'ajax_url', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	wp_localize_script( 'custom_scripts', 'post', array( 'id' => get_the_id()));
	wp_localize_script( 'custom_scripts', 'nonce', array( 'ajax_nonce' => wp_create_nonce('myweb')));

	// Enqueue our scripts
	wp_enqueue_script('custom_scripts',false,true );

}
// add_action( 'wp_enqueue_scripts', 'myweb_scripts' );






// Set the site logo

add_shortcode('site-logo','set_site_logo');

function set_site_logo(){
	$objLogo = get_field('site_logo',get_option('page_on_front'));
	?>
	<a href="<?php echo home_url();?>">
		<img src="<?php echo $objLogo["url"]; ?>" alt="<?php echo $objLogo["alt"];?>" title="<?php echo $objLogo["title"];?>" class="img-responsive" />
	</a>
	<?php
}

 include('inc/webs.php');
 include('inc/fbapps.php');

 /**
  * Add REST API support to an already registered post type.
  */
  add_action( 'init', 'my_custom_post_type_rest_support', 25 );
  function my_custom_post_type_rest_support() {
  	global $wp_post_types;
  
  	//be sure to set this to the name of your post type!
  	$post_type_name = 'web';
  	if( isset( $wp_post_types[ $post_type_name ] ) ) {
  		$wp_post_types[$post_type_name]->show_in_rest = true;
  		$wp_post_types[$post_type_name]->rest_base = $post_type_name;
  		$wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
  	}
  
  }
add_action('wp_ajax_get_dets', 'get_dets');
add_action('wp_ajax_nopriv_get_dets', 'get_dets');
function get_dets(){
	$id = $_GET['id'];
	$arrayName = array(
  array(
    "name"=>"Barot Bellingham",
    "shortname"=>"Barot_Bellingham",
    "reknown"=>"Royal Academy of Painting and Sculpture",
    "bio"=>"Barot has just finished his final year at The Royal Academy of Painting and Sculpture, where he excelled in glass etching paintings and portraiture. Hailed as one of the most diverse artists of his generation, Barot is equally as skilled with watercolors as he is with oils, and is just as well-balanced in different subject areas. Barot's collection entitled \"The Un-Collection\" will adorn the walls of Gilbert Hall, depicting his range of skills and sensibilities - all of them, uniquely Barot, yet undeniably different"
  ),
  array(
    "name"=>"Jonathan G. Ferrar II",
    "shortname"=>"Jonathan_Ferrar",
    "reknown"=>"Artist to Watch in 2012",
    "bio"=>"The Artist to Watch in 2012 by the London Review, Johnathan has already sold one of the highest priced-commissions paid to an art student, ever on record. The piece, entitled Gratitude Resort, a work in oil and mixed media, was sold for $750,000 and Jonathan donated all the proceeds to Art for Peace, an organization that provides college art scholarships for creative children in developing nations"
  ),
  array(
    "name"=>"Hillary Hewitt Goldwynn-Post",
    "shortname"=>"Hillary_Goldwynn",
    "reknown"=>"New York University",
    "bio"=>"Hillary is a sophomore art sculpture student at New York University, and has already won all the major international prizes for new sculptors, including the Divinity Circle, the International Sculptor's Medal, and the Academy of Paris Award. Hillary's CAC exhibit features 25 abstract watercolor paintings that contain only water images including waves, deep sea, and river."
  ),
  array(
    "name"=>"Hassum Harrod",
    "shortname"=>"Hassum_Harrod",
    "reknown"=>"Art College in New Dehli",
    "bio"=>"The Art College in New Dehli has sponsored Hassum on scholarship for his entire undergraduate career at the university, seeing great promise in his contemporary paintings of landscapes - that use equal parts muted and vibrant tones, and are almost a contradiction in art. Hassum will be speaking on \"The use and absence of color in modern art\" during Thursday's agenda."
  ),
  array(
    "name"=>"Jennifer Jerome",
    "shortname"=>"Jennifer_Jerome",
    "reknown"=>"New Orleans, LA",
    "bio"=>"A native of New Orleans, much of Jennifer's work has centered around abstract images that depict flooding and rebuilding, having grown up as a teenager in the post-flood years. Despite the sadness of devastation and lives lost, Jennifer's work also depicts the hope and togetherness of a community that has persevered. Jennifer's exhibit will be discussed during Tuesday's Water in Art theme."
  ),
  array(
    "name"=>"LaVonne L. LaRue",
    "shortname"=>"LaVonne_LaRue",
    "reknown"=>"Chicago, IL",
    "bio"=>"LaVonne's giant-sized paintings all around Chicago tell the story of love, nature, and conservation - themes that are central to her heart. LaVonne will share her love and skill of graffiti art on Monday's schedule, as she starts the painting of a 20-foot high wall in the Rousseau Room of Hotel Contempo in front of a standing-room only audience in Art in Unexpected Places."
  ),
  array(
    "name"=>"Constance Olivia Smith",
    "shortname"=>"Constance_Smith",
    "reknown"=>"Fullerton-Brighton-Norwell Award",
    "bio"=>"Constance received the Fullerton-Brighton-Norwell Award for Modern Art for her mixed-media image of a tree of life, with jewel-adorned branches depicting the arms of humanity, and precious gemstone-decorated leaves representing the spouting buds of togetherness. The daughter of a New York jeweler, Constance has been salvaging the discarded remnants of her father's jewelry-making since she was five years old, and won the New York State Fair grand prize at the age of 8 years old for a gem-adorned painting of the Manhattan Bridge."
  ),
  array(
    "name"=>"Riley Rudolph Rewington",
    "shortname"=>"Riley_Rewington",
    "reknown"=>"Roux Academy of Art, Media, and Design",
    "bio"=>"A first-year student at the Roux Academy of Art, Media, and Design, Riley is already changing the face of modern art at the university. Riley's exquisite abstract pieces have no intention of ever being understood, but instead beg the viewer to dream, create, pretend, and envision with their mind's eye. Riley will be speaking on the \"Art of Abstract\" during Thursday's schedule"
  ),
  array(
    "name"=>"Xhou Ta",
    "shortname"=>"Xhou_Ta",
    "reknown"=>"China International Art University",
    "bio"=>"A senior at the China International Art University, Xhou has become well-known for his miniature sculptures, often the size of a rice granule, that are displayed by rear projection of microscope images on canvas. Xhou will discuss the art and science behind his incredibly detailed works of art."
  )
);

	if (isset($id) && !empty($id)) {

		echo json_encode($arrayName[$id]);
	}
	else{
		echo json_encode($arrayName);
	}
	die();
}