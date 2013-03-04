<?php
/*
Plugin Name: mywidget
Plugin URI: localhost
Description:
Author: April Hodge Silver
Version: 1.0
Author URI: localhost
*/

class Posts_From_Category extends WP_Widget {

	function Posts_From_Category() {

		$widget_ops = array(
			'classname' => 'postsfromcat', 
			'description' => 'Allows you to display a list of recent posts within a particular category.');


		$control_ops = array(
			'width' => 250, 
			'height' => 250, 
			'id_base' => 'postsfromcat-widget');

		$this->WP_Widget('postsfromcat-widget', 'Posts from a Category', $widget_ops, $control_ops );
	}
	
	function form ($instance) {


		$defaults = array('numberposts' => '4');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?> " value="<?php echo $instance['title'] ?>" size="20">
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('catid'); ?>">Category:</label>
			<?php wp_dropdown_categories('hide_empty=0&hierarchical=1&id='.$this->get_field_id('catid').'&name='.$this->get_field_name('catid').'&selected='.$instance['catid']); ?>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('numberposts'); ?>">Number of posts:</label>
			<select id="<?php echo $this->get_field_id('numberposts'); ?>" name="<?php echo $this->get_field_name('numberposts'); ?>">
			<?php for ($i=1;$i<=20;$i++) {
				echo '<option value="'.$i.'"';
				if ($i==$instance['numberposts']) echo ' selected="selected"';
				echo '>'.$i.'</option>';
			} ?>
			</select>
		</p>
		
		<p>
			<input type="checkbox" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" <?php if ($instance['rss']) echo 'checked="checked"' ?> />
			<label for="<?php echo $this->get_field_id('rss'); ?>">Show RSS feed link?</label>
		</p>
		
		<?php
	}

	function update ($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['catid'] = $new_instance['catid'];
		$instance['numberposts'] = $new_instance['numberposts'];
		$instance['title'] = $new_instance['title'];
		$instance['rss'] = $new_instance['rss'];

		return $instance;
	}

	function widget ($args,$instance) {
		extract($args);

		$title = $instance['title'];
		$catid = $instance['catid'];
		$numberposts = $instance['numberposts'];
		$rss = $instance['rss'];
	
		// retrieve posts information from database
		global $wpdb;
        echo $before_widget;
        echo $before_title.$title.$after_title;
        echo $after_widget;

        $out = '<ul>';
		$posts = get_posts('numberposts='.$numberposts.'&category='.$catid);
        ?>
        <li style="clear: both">
            <ul id="lastest_events">
            <?php foreach ($posts as $posts): ?>
                <li>
                <?php echo get_the_post_thumbnail($posts->ID, array(50,50)); ?>
                <a href="<?php the_permalink() ?>"><?php echo $posts->post_title; ?></a>
                </li>
            <?php endforeach; ?>
            </ul>
        </li>
<?php
    if ($rss) $out .= '<li><a href="'.get_category_link($catid).'feed/" class="rss">Category RSS</a></li>';
        $out .= '</ul>';
        echo $out;

	}
}

function ahspfc_load_widgets() {
	register_widget('Posts_From_Category');
}

add_action('widgets_init', 'ahspfc_load_widgets');

?>
