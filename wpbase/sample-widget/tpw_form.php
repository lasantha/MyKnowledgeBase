	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
		
		$bg_video = ( isset( $instance['background_video'] ) ) ? $instance['background_video'] : '';
		$bg_image = ( isset( $instance['background_image'] ) ) ? $instance['background_image'] : '';
		$title_text = ( isset( $instance['title_text'] ) ) ? $instance['title_text'] : '';
		$title_image = ( isset( $instance['title_image'] ) ) ? $instance['title_image'] : '';

	
	?>	
		
		<div class="titlepage_widget">
		
			<h3>Title</h3>
			<p>
				<div class="widget_input">
					<label for="<?php echo $this->get_field_id( 'title_text' ); ?>"><?php _e( 'Text :' ); ?></label> 	
					<input class="title_text" id="<?php echo $this->get_field_id( 'title_text' ); ?>" 
						name="<?php echo $this->get_field_name( 'title_text' ); ?>" value="<?php echo $title_text ?>" type="text"><br/>
				</div>
				<div class="widget_input">
					<label for="<?php echo $this->get_field_id( 'title_image' ); ?>"><?php _e( 'Image :' ); ?></label> 	
					<input class="title_image" id="<?php echo $this->get_field_id( 'title_image' ); ?>" 
						name="<?php echo $this->get_field_name( 'title_image' ); ?>" value="<?php echo $title_image ?>" type="text">
					<button id="title_image_button" class="button" 
						onclick="image_button_click('Choose Title Image','Select Image','image','title_image_preview','<?php echo $this->get_field_id( 'title_image' );  ?>');">Select Image</button>			
				</div>
				<div id="title_image_preview" class="preview_placholder">
				<?php 
					if ($title_image!='') echo '<img src="' . $title_image . '">';
				?>
				</div>
			</p>	
			
			<h3>Background</h3>
			<p id="title_background_inputs">
				<label for="<?php echo $this->get_field_id( 'background_video' ); ?>"><?php _e( 'Video :' ); ?></label> 	
				<input class="background_video" id="<?php echo $this->get_field_id( 'background_video' ); ?>" 
					name="<?php echo $this->get_field_name( 'background_video' ); ?>" value="<?php echo $bg_video ?>" type="text">
				<button id="background_video_button" class="button" onclick="image_button_click('Choose Background Video','Select Video','video','background_video_preview','<?php echo $this->get_field_id( 'background_video' );  ?>');">Select Video</button>			
				<div id="background_video_preview" class="preview_placholder">
				<?php 
            		if ($bg_video!='') echo '<video autoplay loop><source src="' . $bg_video . '" type="video/' . substr( $bg_video, strrpos( $bg_video, '.') + 1 ) . '" /></video>';
				?>				
				</div>
				<label for="<?php echo $this->get_field_id( 'background_image' ); ?>"><?php _e( 'Image :' ); ?></label> 	
				<input class="background_image" id="<?php echo $this->get_field_id( 'background_image' ); ?>" 
					name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php echo $bg_image ?>" type="text">
				<button id="background_image_button" class="button" onclick="image_button_click('Choose Background Image','Select Image','image','background_image_preview','<?php echo $this->get_field_id( 'background_image' );  ?>');">Select Image</button>	
				<div id="background_image_preview" class="preview_placholder">
				<?php 
					if ($bg_image!='') echo '<img src="' . $bg_image . '">';
				?>				
				</div>
			</p>
			
		</div>
	
		<?php 
	}