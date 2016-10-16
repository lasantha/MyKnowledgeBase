	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'Title_Page_Widget', // Base ID
			__('Title Page Widget (PB)', 'text_domain'), // Name
			array('description' => __( 'Creates a full-screen title page - designed for use with Site Origin\'s Page Builder plugin', 'text_domain' ),) // Args
		);
		
		add_action( 'sidebar_admin_setup', array( $this, 'admin_setup' ) );

	}
	
	function admin_setup(){

		wp_enqueue_media();
		wp_register_script('tpw-admin-js', plugins_url('tpw_admin.js', __FILE__), array( 'jquery', 'media-upload', 'media-views' ) );
		wp_enqueue_script('tpw-admin-js');
		wp_enqueue_style('tpw-admin', plugins_url('tpw_admin.css', __FILE__) );

	}