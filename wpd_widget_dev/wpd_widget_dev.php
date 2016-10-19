<?php
/*
Plugin Name: wpd widget dev
Plugin URI: http://www.yourpluginurlhere.com/
Version: Current Version
Author: Name please
Description: What does your plugin do and what features does it offer...
*/
$WpWidgetDev = new WpWidgetDev();

/* 
	Plugin Funtion Class
*/
class WpWidgetDev{
	function __construct(){
	//SETUP
	//action hook for plugin activation
	// register_activation_hook( __FILE__, 'callback_plugin' );

		add_action( 'widgets_init', array($this,'register_wpd_widget') );
		add_action('admin_menu', array($this,'wp_widget_dev_menu'));
	}

	function register_wpd_widget() {
	    register_widget( 'wpd_widget' );
	}

	//callback function
	function callback_plugin(){
		
		
	}
	//Add plugin pages to menu
	function wp_widget_dev_menu() {
		add_menu_page('WP Widget Development', 'WP Widget Development', 'administrator', 'wp-widget-dev','dashicons-universal-access');

	}

	//ADMIN SCRIPTS - Add support js ad css files to admin pages
	function wp_widget_dev_admin_scripts(){
	// wp_register_style( 'bootstrap_min_css', plugin_dir_url( __FILE__ ).'css/bootstrap.min.css' );
	// wp_enqueue_style( 'bootstrap_min_css');


	// wp_register_script( 'bootstrap_min_js', plugin_dir_url( __FILE__ ).'js/bootstrap.min.js' );
	// wp_enqueue_script( 'bootstrap_min_js');
	}

	function __destruct(){

	}
}

/**
 * Adds wpd_widget widget.
 */
class wpd_widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'wpd_widget', // Base ID
			__( 'Widget Title', 'text_domain' ), // Name
			array( 'description' => __( 'wpd widget', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		echo __( esc_attr( 'Hello, World!' ), 'text_domain' );
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title 		= ! empty( $instance['title'] ) ? $instance['title'] : __( 'Widget Title', 'text_domain' );
		$post_type 	= ! empty( $instance['post_type'] ) ? $instance['post_type'] : __( 'Post Type', 'text_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
			<?php _e( esc_attr( 'Title:' ) ); ?>
		</label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>">
			<?php _e( esc_attr( 'Post Type:' ) ); ?>
		</label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>" type="text" value="<?php echo esc_attr( $post_type ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['post_type'] = ( ! empty( $new_instance['post_type'] ) ) ? strip_tags( $new_instance['post_type'] ) : '';

		return $instance;
	}
	// register Foo_Widget widget
	
	

} // class wpd_widget

?>