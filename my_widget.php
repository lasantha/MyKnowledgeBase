<?php
/**
 * WordPress Sample text widget class
 * 
 * Creates a sample widget "My Widget" with a title and text output
 * http://wp-dreams.com/creating-a-wordpress-widget-a-simple-text-widget/   
 * 
 * @author Ernest Marcinko <ernest.marcinko@wp-dreams.com>
 * @version 1.0
 * @link http://wp-dreams.com, http://codecanyon.net/user/anago/portfolio
 * @copyright Copyright (c) 2014, Ernest Marcinko
 */

class My_Widget extends WP_Widget {
 
  public function __construct() {
      $widget_ops = array('classname' => 'My_Widget', 'description' => 'Displays an My widget!' );
      $this->WP_Widget('My_Widget', 'My widget', $widget_ops);
  }
  
  function widget($args, $instance) {
    // PART 1: Extracting the arguments + getting the values
    extract($args, EXTR_SKIP);
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    $text = empty($instance['text']) ? '' : $instance['text'];
   
    // Before widget code, if any
    echo (isset($before_widget)?$before_widget:'');
   
    // PART 2: The title and the text output
    if (!empty($title))
      echo $before_title . $title . $after_title;;
    if (!empty($text))
      echo $text;
   
    // After widget code, if any  
    echo (isset($after_widget)?$after_widget:'');
  }
 
  public function form( $instance ) {
   
     // PART 1: Extract the data from the instance variable
     $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
     $title = $instance['title'];
     $text = $instance['text'];   
   
     // PART 2-3: Display the fields
     ?>
     <!-- PART 2: Widget Title field START -->
     <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">Title: 
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
               name="<?php echo $this->get_field_name('title'); ?>" type="text" 
               value="<?php echo attribute_escape($title); ?>" />
      </label>
      </p>
      <!-- Widget Title field END -->
   
     <!-- PART 3: Widget Text field START -->
     <p>
      <label for="<?php echo $this->get_field_id('text'); ?>">Text: 
        <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" 
               name="<?php echo $this->get_field_name('text'); ?>" type="text" 
               value="<?php echo attribute_escape($text); ?>" />
      </label>
      </p>
      <!-- Widget Text field END -->
     <?php
   
  }
 
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['text'] = $new_instance['text'];
    return $instance;
  }
  
}

add_action( 'widgets_init', create_function('', 'return register_widget("My_Widget");') );
?>