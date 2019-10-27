<?php 

add_action('widgets_init','pulsar_flickr');

function pulsar_flickr() {
	register_widget('pulsar_flickr');
	
	}

class pulsar_flickr extends WP_Widget {
	function pulsar_flickr() {
			
		$widget_ops = array('classname' => 'flickr','description' => esc_attr__('Flickr Widget - displays Flickr photos','energytheme'));
		parent::__construct('flickr-photo',esc_attr__('[Micro Themes] - Flickr','energytheme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$subtitle = empty($instance['subtitle']) ? '' : $instance['subtitle'];
		$flickrID = $instance['flickrID'];
		$count = $instance['count'];
		$type = $instance['type'];
		$display = $instance['display'];


		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo '<h5 class="pm-fat-footer-sub-title">'.$subtitle.'</h5>' . $before_title . $title . $after_title;
		?>
		<div class="flickr_badge_wrapper clearfix">
	
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo esc_attr($count) ?>&amp;display=<?php echo $display ?>&amp;size=s&amp;layout=x&amp;source=<?php echo esc_attr($type) ?>&amp;<?php echo esc_attr($type) ?>=<?php echo esc_attr($flickrID) ?>"></script><!-- flickr size params size=s, size=t, size=m -->
		
		</div>
	
			
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
		$instance['count'] = $new_instance['count'];
		$instance['type'] = $new_instance['type'];
		$instance['display'] = $new_instance['display'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'subtitle' => esc_attr__('Want to see more?','theme'),
			'title' => esc_attr__('View us on Flickr','theme'), 
			'flickrID' => '95484010@N06',
			'count' => '9',
			'type' => 'user',
			'display' => 'latest'
 		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        	
    <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'subtitle' )); ?>"><?php esc_attr_e('Sub-Title:', 'energytheme') ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'subtitle' )); ?>" value="<?php echo $instance['subtitle']; ?>" />
	</p>
    
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_attr_e('Title:', 'energytheme') ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'flickrID' )); ?>"><?php esc_attr_e('Flickr ID:', 'energytheme') ?> (<a href="http://idgettr.com/">idGettr</a>)</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'flickrID' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'flickrID' )); ?>" value="<?php echo $instance['flickrID']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php esc_attr_e('Number of Photos:', 'energytheme') ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" value="<?php echo $instance['count']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'type' )); ?>"><?php esc_attr_e('Type (user or group):', 'energytheme') ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>" class="widefat">
			<option <?php if ( 'user' == $instance['type'] ) echo 'selected="selected"'; ?>>user</option>
			<option <?php if ( 'group' == $instance['type'] ) echo 'selected="selected"'; ?>>group</option>
		</select>
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php esc_attr_e('Display (random or latest):', 'energytheme') ?></label>
		<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo esc_attr($this->get_field_name( 'display' )); ?>" class="widefat">
			<option <?php if ( 'random' == $instance['display'] ) echo 'selected="selected"'; ?>><?php esc_attr_e('random', 'energytheme') ?></option>
			<option <?php if ( 'latest' == $instance['display'] ) echo 'selected="selected"'; ?>><?php esc_attr_e('latest', 'energytheme') ?></option>
		</select>
	</p>
        
   <?php 
}
	} //end class