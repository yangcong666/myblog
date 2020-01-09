<?php

class MTheme_widget1 extends WP_Widget {
    function MTheme_widget1() {
        $widget_ops = array('description' => 'Arbitrary主题：热门文章（需要WP-PostViews插件）');
        $this->WP_Widget('MTheme_widget1', 'Arbitrary：热门文章', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $limit = strip_tags($instance['limit']);
		$limit = $limit ? $limit : 10;
?>
	<div class="widget widget-populars">
		<h3>热门文章</h3>
		<ul class="list">
			<?php $args = array(
					'paged' => 1,
					'meta_key' => 'views',
					'orderby' => 'meta_value_num',
					'ignore_sticky_posts' => 1,
					'post_type' => 'post',
					'post_status' => 'publish',
					'showposts' => $limit
				);
				$posts = query_posts($args); ?>
			<?php while(have_posts()) : the_post(); ?>
			<li class="widget-popular"><p><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a><span>[<?php if(function_exists('the_views')) the_views();?>]</span></p></li>
			<?php endwhile;wp_reset_query();$posts=null;?>
		</ul>
	</div>	
<?php	
    }
	
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['limit'] = strip_tags($new_instance['limit']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('limit' => ''));
        $limit = strip_tags($instance['limit']);
?>
        
        <p><label for="<?php echo $this->get_field_id('limit'); ?>">文章数量：<input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label></p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php
    }
}
add_action('widgets_init', 'MTheme_widget1_init');
function MTheme_widget1_init() {
    register_widget('MTheme_widget1');
}

//////////////////////////////////////////////////////////


class MTheme_widget2 extends WP_Widget {
    function MTheme_widget2() {
        $widget_ops = array('description' => 'Arbitrary主题：最近更新的文章');
        $this->WP_Widget('MTheme_widget2', 'Arbitrary：最近更新', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $limit = strip_tags($instance['limit']);
		$limit = $limit ? $limit : 8;
?>
	<div class="widget widget-modified">
		<h3>最近更新的文章</h3>
		<ul class="list">
			<?php $args = array(
					'orderby' => 'modified',
					'ignore_sticky_posts' => 1,
					'post_type' => 'post',
					'post_status' => 'publish',
					'showposts' => $limit
				);
				$index = 0;
				$posts = query_posts($args); ?>
			<?php while(have_posts()) : the_post(); ?>
			<li><p><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
			<p>更新时间：<span><?php echo time_since(abs(strtotime($posts[$index]->post_modified_gmt)));?></span></p></li>
			<?php $index++; endwhile;wp_reset_query();$posts=null ?>
		</ul>
	</div>	
<?php	
    }
	
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['limit'] = strip_tags($new_instance['limit']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('limit' => ''));
        $limit = strip_tags($instance['limit']);
?>
        
        <p><label for="<?php echo $this->get_field_id('limit'); ?>">文章数量：<input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label></p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php
    }
}
add_action('widgets_init', 'MTheme_widget2_init');
function MTheme_widget2_init() {
    register_widget('MTheme_widget2');
}

//////////////////////////////////////////////////////////
?>