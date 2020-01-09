<?php
/**
 * Block 1 - Slider Widget
 */

// Register the widget
add_action( 'widgets_init', create_function( '', 'return register_widget("Summerleaf_List_Post_Widget");'));

// The widget class
class Summerleaf_List_Post_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'list_post_widget', 'description' => esc_html__( "在侧边栏显示夏叶主题文章列表", 'summerleaf') );
		parent::__construct('sl_block1', esc_html__('夏叶侧边栏文章列表', 'summerleaf'), $widget_ops);
		$this->alt_option_name = 'widget_list_post';

		add_action( 'save_post', array($this, 'remove_cache') );
		add_action( 'deleted_post', array($this, 'remove_cache') );
		add_action( 'switch_theme', array($this, 'remove_cache') );
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		//extract( $args );
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_list_post', 'widget' );
		}
		if ( ! is_array( $cache ) ) {
			$cache = array();
		}
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}
	  ob_start();

		// Get values from the widget settings.
		$title               = ( ! empty( $instance['title'] ) ) ? $instance['title']                             : '';
		//创建过滤器apply_filters 可以在其它地方过滤标题
		$title               = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$title_ico	         = ( ! empty( $instance['title_ico'] ) ) ? $instance['title_ico']                             : 'fa-archive';
		$post_tags	         = ( ! empty( $instance['post_tags'] ) ) ? $instance['post_tags']                             : '';
		$featured_categories = ( ! empty( $instance['featured_categories'] ) ) ? $instance['featured_categories'] : '';
		$ignore_sticky 		 = isset($instance['ignore_sticky']) ? $instance['ignore_sticky'] : 0;
		$thumbnail 		 = isset($instance['thumbnail']) ? $instance['thumbnail'] : 0;
		$orderby			 = ( ! empty( $instance['orderby'] ) ) ? $instance['orderby']                         : 'date';
		$number_posts        = ( ! empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] ) : 6;
		if ( ! $number_posts ) $number_posts = 6;
//
		$custom_query_args = array_filter(array(
			'post_type'           => 'post',
			'posts_per_page'      => $number_posts,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => $ignore_sticky,
			'tag__in' => array_filter(explode(',',$post_tags)),
			'category__in'        => array_filter($featured_categories),
			'order'               => 'DESC',
			'orderby'             => $orderby,
		));
		//创建过滤器apply_filters 可以在其它地方过滤参数
		$custom_query = new WP_Query( apply_filters( 'widget_list_post_args', $custom_query_args ) );
	

		$count        = 0;
		if ( $custom_query->have_posts() ) :

			echo $args['before_widget'];
							
			if ( $title_ico ) $args['before_title'] = '<h3 class="widget-title"><i class="fa '.$title_ico .'"></i><span>';			
			if ( $title ) echo $args['before_title'] . $title . $args['after_title'];
      
      if ($thumbnail == 0) {
          echo  '<div id="list_post_widget_'.$args['widget_id'].'"><ul>'; 
    
    
  
					while ( $custom_query->have_posts() ) : $custom_query->the_post();
					global $post;
					$count++;
					
					$post_link = esc_url(get_permalink($post->ID));
					$post_title = $post->post_title;
					
					$cnt= ($count < 10) ? '0'.$count : $count;
					?>
				  <li><span class="li-icon li-icon-<?php echo $count; ?>"><?php echo $cnt; ?></span><a href="<?php echo $post_link; ?>" ><?php echo $post_title; ?></a></li> 
					<?php

					endwhile;
      
          echo '</ul></div>';
      } else {
      	
          echo  '<div id="list_post_widget_'.$args['widget_id'].'" class="hot_commend"><ul>'; 
    
    
  
					while ( $custom_query->have_posts() ) : $custom_query->the_post();
					global $post;
					$count++;
					
					$post_link = esc_url(get_permalink($post->ID));
					$post_title = $post->post_title;
					

					?>
          <li> 
          	<span class="thumbnail"> 
          	  <a href="<?php echo $post_link; ?>">
          	    <img src="http://placehold.it/200x150&text=SummerLeaf" data-original="<?php echo get_post_featured_image($post->ID,'200*150');?>"  class="wp-post-image" alt="<?php echo $post_title; ?>" />
          	  </a>
          	</span>
          	<span class="hot-title">
          		<a href="<?php echo $post_link; ?>" rel="bookmark"><?php echo $post_title; ?></a>
          	</span> 
          	<span class="views"><i class="fa fa-comment"></i> <?php echo esc_html($post->comment_count); ?></span> <i class="fa fa-calendar-check-o">&nbsp;<?php echo get_the_date('Y/m/d', $post->ID); ?></i> 
          </li> 
					<?php

					endwhile;
      
          echo '</ul></div>';      	
      	
      	
      
      }
      echo '<div class="clear"></div>';
      echo $args['after_widget'];
      
			

		endif;
		wp_reset_postdata(); // reset the query
		?>

		<?php
		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_list_post', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$this->remove_cache();
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) ) delete_option('widget_recent_entries');

		$new_instance = wp_parse_args( $new_instance, array(
			'title' 				=> '',
			'ignore_sticky' 		=> '',
			'thumbnail' => '',		
			'title_ico' 				=> '',
			'post_tags' => '',	
			'featured_categories' 	=> '',
			'number_posts' 			=> '',
			'orderby' 				=> '',
		) );

		$instance['title']               = sanitize_text_field( $new_instance['title'] );
		$instance['ignore_sticky']       = isset($new_instance['ignore_sticky']) && $new_instance['ignore_sticky'] ? 1 : 0;
		$instance['thumbnail']       = isset($new_instance['thumbnail']) && $new_instance['thumbnail'] ? 1 : 0;
		$instance['title_ico']              = sanitize_text_field( $new_instance['title_ico'] );
		$instance['post_tags']              = sanitize_text_field( $new_instance['post_tags'] );
		$instance['featured_categories'] = isset( $new_instance['featured_categories'] ) ?  array_map( 'absint', ( array) $new_instance['featured_categories'] ) : false ;
		$instance['number_posts']        = absint( $new_instance['number_posts'] );
		$instance['orderby'] 		     = sanitize_text_field( $new_instance['orderby'] );

		return $instance;
	}

	/**
	 * @access public
	 */
	public function remove_cache() {
		wp_cache_delete('widget_list_post', 'widget');
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {

		// Set default value.
		$defaults = array(
			'title'               => '',
			'featured_categories' => '',
			'title_ico' => '',		
			'post_tags' => '',	
			'thumbnail' => 0,				
			'ignore_sticky'		  => 0,
			'number_posts'        => 6,
			'orderby'             => 'date'
		);
		$instance            = wp_parse_args( (array) $instance, $defaults );
		$featured_categories = (array)$instance['featured_categories'];
		$orderby 	         = array( 'date', 'comment_count', 'rand' );


		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('小工具标题：', 'summerleaf') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title_ico' ); ?>"><?php esc_html_e('标题图标：', 'summerleaf') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title_ico' ); ?>" name="<?php echo $this->get_field_name( 'title_ico' ); ?>" value="<?php echo $instance['title_ico']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_tags' ); ?>"><?php esc_html_e('多选标签（请输入标签ID，英文逗号分隔“,”）：', 'summerleaf') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'post_tags' ); ?>" name="<?php echo $this->get_field_name( 'post_tags' ); ?>" value="<?php echo $instance['post_tags']; ?>" />
		</p>
		<?php $categories = get_categories(); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'featured_categories' ); ?>"><?php esc_html_e('多选分类（不选表示全部文章）：', 'summerleaf') ?></label>
			<select class="widefat" multiple="multiple" name="<?php echo $this->get_field_name( 'featured_categories' );?>[]" id="<?php echo $this->get_field_id( 'featured_categories' );?>">
				<?php foreach ( $categories as $category ) { ?>
					<option value="<?php echo $category->term_id; ?>" <?php echo in_array( $category->term_id, $featured_categories ) ? 'selected="selected" ' : '';?>><?php echo $category->name . " (". $category->count . ")"; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number_posts' ); ?>"><?php esc_html_e('显示文章数量：', 'summerleaf') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_posts' ); ?>" value="<?php echo $instance['number_posts']; ?>" />
		</p>
		<p>
		   <input id="<?php echo $this->get_field_id('ignore_sticky'); ?>" name="<?php echo $this->get_field_name('ignore_sticky'); ?>" type="checkbox" value="1" <?php checked('1', $instance['ignore_sticky']); ?>/>
		   <label for="<?php echo $this->get_field_id('ignore_sticky'); ?>"><?php esc_html_e('忽略置顶帖', 'summerleaf') ?></label>
	  </p>
		<p>
		   <input id="<?php echo $this->get_field_id('thumbnail'); ?>" name="<?php echo $this->get_field_name('thumbnail'); ?>" type="checkbox" value="1" <?php checked('1', $instance['thumbnail']); ?>/>
		   <label for="<?php echo $this->get_field_id('thumbnail'); ?>"><?php esc_html_e('缩略图风格', 'summerleaf') ?></label>
	  </p>	  
		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php esc_html_e('排序：', 'summerleaf') ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'orderby' );?>" id="<?php echo $this->get_field_id( 'orderby' );?>">
				<?php for ( $i = 0; $i <= 2; $i++ ){ ?>
					<option value="<?php echo $orderby[$i]; ?>" <?php echo ($orderby[$i] == $instance['orderby']) ? 'selected="selected" ' : '';?>><?php echo $orderby[$i]; ?></option>
				<?php } ?>
			</select>
		</p>

<?php
	}
}
