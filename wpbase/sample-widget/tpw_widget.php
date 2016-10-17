	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 * the 
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	
		// use a template for the output so that it can easily be overridden by theme
		
		// check for template in active theme
		$template = locate_template(array('tpw_template.php'));
		
		// if none found use the default template
		if ( $template == '' ) $template = 'tpw_template.php';
				
		include ( $template );
			
	}