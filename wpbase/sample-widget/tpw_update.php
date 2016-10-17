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
		$instance['background_video'] = ( ! empty( $new_instance['background_video'] ) ) ? strip_tags( $new_instance['background_video'] ) : '';
		$instance['background_image'] = ( ! empty( $new_instance['background_image'] ) ) ? strip_tags( $new_instance['background_image'] ) : '';
		$instance['title_text'] = ( ! empty( $new_instance['title_text'] ) ) ? strip_tags( $new_instance['title_text'] ) : '';
		$instance['title_image'] = ( ! empty( $new_instance['title_image'] ) ) ? strip_tags( $new_instance['title_image'] ) : '';
		return $instance;
	}
