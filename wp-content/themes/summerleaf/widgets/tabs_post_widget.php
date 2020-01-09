<?php
/**
 * Block 1 - Slider Widget
 */

// Register the widget
add_action( 'widgets_init', create_function( '', 'return register_widget("Summerleaf_Tabs_Post_Widget");'));

// The widget class
class Summerleaf_Tabs_Post_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'tabs_post_widget', 'description' => esc_html__( "在侧边栏使用三列选项卡显示夏叶主题文章列表", 'summerleaf') );
		parent::__construct('sl_block2', esc_html__('夏叶侧边栏选项卡列表', 'summerleaf'), $widget_ops);
		$this->alt_option_name = 'widget_tabs_post';

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
			$cache = wp_cache_get( 'widget_tabs_post', 'widget' );
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

		echo '<aside id="'.$args['widget_id'].'" class="tabber-contain widget tabs_post_widget">';	
		

		$title1               = ( ! empty( $instance['title1'] ) ) ? $instance['title1']                             : esc_html__( '热门', 'summerleaf' );
		//创建过滤器apply_filters 
		$title1               = apply_filters( 'tabs_widget_title1', $title1, $instance, $this->id_base );	
		$title2               = ( ! empty( $instance['title2'] ) ) ? $instance['title2']                             : esc_html__( '最新', 'summerleaf' );
		//创建过滤器apply_filters 
		$title2               = apply_filters( 'tabs_widget_title2', $title2, $instance, $this->id_base );

		echo '<ul class="tabs tabber-header"> 
      <li class="active"><h3 class="widget-title"><a href="#tab1"><span>'.$title1.'</span></a></h3></li> 
      <li class=""><h3 class="widget-title"><a href="#tab2"><span>'.$title2.'</span></a></h3></li> 
      <li class=""><h3 class="widget-title"><a href="#tab3"><span>'.esc_html__( '评论', 'summerleaf' ).'</span></a></h3></li> 
      </ul><div class="clear"></div>';

		// 选项卡一Get values from the widget settings.

		$post_tags1	         = ( ! empty( $instance['post_tags1'] ) ) ? $instance['post_tags1']                             : '';
		$featured_categories1 = ( ! empty( $instance['featured_categories1'] ) ) ? $instance['featured_categories1'] : '';
		$ignore_sticky1 		 = isset($instance['ignore_sticky1']) ? $instance['ignore_sticky1'] : 0;
		$thumbnail1 		 = isset($instance['thumbnail1']) ? $instance['thumbnail1'] : 0;
		$orderby1			 = ( ! empty( $instance['orderby1'] ) ) ? $instance['orderby1']                         : 'date';
		$number_posts1        = ( ! empty( $instance['number_posts1'] ) ) ? absint( $instance['number_posts1'] ) : 5;
		if ( ! $number_posts1 ) $number_posts1 = 5;
//
		$custom_query_args = array_filter(array(
			'post_type'           => 'post',
			'posts_per_page'      => $number_posts1,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => $ignore_sticky1,
			'tag__in' => array_filter(explode(',',$post_tags1)),
			'category__in'        => array_filter($featured_categories1),
			'order'               => 'DESC',
			'orderby'             => $orderby1,
		));
		//创建过滤器apply_filters 可以在其它地方过滤参数
		$custom_query = new WP_Query( apply_filters( 'tabs_widget_tabs_post_args1', $custom_query_args ) );
	

		$count        = 0;


		
		if ( $custom_query->have_posts() ) :



      
      if ($thumbnail1 == 0) {
          echo  '<div id="tab1" class="tabber-content"><ul>'; 
    
    
  
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
      	
          echo  '<div id="tab1" class="hot_commend tabber-content"><ul>'; 
    
    
  
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
		endif;
		wp_reset_postdata(); // reset the query
		
		// 选项卡二Get values from the widget settings.

		$post_tags2	         = ( ! empty( $instance['post_tags2'] ) ) ? $instance['post_tags2']                             : '';
		$featured_categories2 = ( ! empty( $instance['featured_categories2'] ) ) ? $instance['featured_categories2'] : '';
		$ignore_sticky2 		 = isset($instance['ignore_sticky2']) ? $instance['ignore_sticky2'] : 0;
		$thumbnail2 		 = isset($instance['thumbnail2']) ? $instance['thumbnail2'] : 0;
		$orderby2			 = ( ! empty( $instance['orderby2'] ) ) ? $instance['orderby2']                         : 'date';
		$number_posts2        = ( ! empty( $instance['number_posts2'] ) ) ? absint( $instance['number_posts2'] ) : 5;
		if ( ! $number_posts2 ) $number_posts2 = 5;
//
		$custom_query_args = array_filter(array(
			'post_type'           => 'post',
			'posts_per_page'      => $number_posts2,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => $ignore_sticky2,
			'tag__in' => array_filter(explode(',',$post_tags2)),
			'category__in'        => array_filter($featured_categories2),
			'order'               => 'DESC',
			'orderby'             => $orderby2,
		));
		//创建过滤器apply_filters 可以在其它地方过滤参数
		$custom_query = new WP_Query( apply_filters( 'tabs_widget_tabs_post_args2', $custom_query_args ) );
	

		$count        = 0;


		
		if ( $custom_query->have_posts() ) :



      
      if ($thumbnail2 == 0) {
          echo  '<div id="tab2" class="tabber-content"><ul>'; 
    
    
  
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
      	
          echo  '<div id="tab2" class="hot_commend tabber-content"><ul>'; 
    
    
  
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
		endif;
		wp_reset_postdata(); // reset the query


		$comment_number        = ( ! empty( $instance['comment_number'] ) ) ? absint( $instance['comment_number'] ) : 5;
		if ( ! $comment_number ) $comment_number = 5;
    
    $comment_args = array( 'number' => $comment_number, 'status' => 'approve' ); 
    $comments = get_comments( $comment_args );
    if ( $comments ) { 
        echo  '<div id="tab3" class="hot_commend tabber-content"><ul>';          	
        foreach ( $comments as $comment ) { 
					?>
          <li> 
          	<span class="thumbnail"> 
          		<?php echo get_avatar( $comment, '75' );
          		?>
          	</span>
          	<span class="hot-title">
          		<?php echo strip_tags($comment->comment_author); ?> <?php _e( '说：', 'summerleaf' ); ?> <br>
          		<a href="<?php echo get_permalink($comment->comment_post_ID); ?>" title="<?php echo strip_tags($comment->comment_author); ?> 评论 <?php echo get_the_title($comment->comment_post_ID); ?>"><?php

              $com_trim = strip_tags($comment->comment_content);
              $trimmed_content = wp_trim_words( $com_trim, 12 );
              echo $trimmed_content;

               ?></a>
          	</span> 
          	<span class="views"> </span> <i class="fa fa-calendar-check-o">&nbsp;<?php echo $comment->comment_date; ?></i> 
          </li> 
					<?php

				}
        echo '</ul></div>'; 
        echo '<div class="clear"></div>'; 				
		}
      
    wp_reset_postdata(); // reset the query

    echo $args['after_widget'];
		
		?>

		<?php
		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_tabs_post', $cache, 'widget' );
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
			'title1' 				=> '',
			'ignore_sticky1' 		=> '',
			'thumbnail1' => '',		
			'post_tags1' => '',	
			'featured_categories1' 	=> '',
			'number_posts1' 			=> '',
			'orderby1' 				=> '',
			'title2' 				=> '',
			'ignore_sticky2' 		=> '',
			'thumbnail2' => '',		
			'post_tags2' => '',	
			'featured_categories2' 	=> '',
			'number_posts2' 			=> '',
			'orderby2' 				=> '',		
			'comment_number'       => '',
		) );

		$instance['title1']               = sanitize_text_field( $new_instance['title1'] );
		$instance['ignore_sticky1']       = isset($new_instance['ignore_sticky1']) && $new_instance['ignore_sticky1'] ? 1 : 0;
		$instance['thumbnail1']       = isset($new_instance['thumbnail1']) && $new_instance['thumbnail1'] ? 1 : 0;
		$instance['post_tags1']              = sanitize_text_field( $new_instance['post_tags1'] );
		$instance['featured_categories1'] = isset( $new_instance['featured_categories1'] ) ?  array_map( 'absint', ( array) $new_instance['featured_categories1'] ) : false ;
		$instance['number_posts1']        = absint( $new_instance['number_posts1'] );
		$instance['orderby1'] 		     = sanitize_text_field( $new_instance['orderby1'] );

		$instance['title2']               = sanitize_text_field( $new_instance['title2'] );
		$instance['ignore_sticky2']       = isset($new_instance['ignore_sticky2']) && $new_instance['ignore_sticky2'] ? 1 : 0;
		$instance['thumbnail2']       = isset($new_instance['thumbnail2']) && $new_instance['thumbnail2'] ? 1 : 0;
		$instance['post_tags2']              = sanitize_text_field( $new_instance['post_tags2'] );
		$instance['featured_categories2'] = isset( $new_instance['featured_categories2'] ) ?  array_map( 'absint', ( array) $new_instance['featured_categories2'] ) : false ;
		$instance['number_posts2']        = absint( $new_instance['number_posts2'] );
		$instance['orderby2'] 		     = sanitize_text_field( $new_instance['orderby2'] );
		
		$instance['comment_number']        = absint( $new_instance['comment_number'] );

		return $instance;
	}

	/**
	 * @access public
	 */
	public function remove_cache() {
		wp_cache_delete('widget_tabs_post', 'widget');
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {

		// Set default value.
		$defaults = array(
			'title1'               => '',
			'featured_categories1' => '',
			'post_tags1' => '',	
			'thumbnail1' => 0,				
			'ignore_sticky1'		  => 0,
			'number_posts1'        => 5,
			'orderby1'             => 'date',
			'title2'               => '',
			'featured_categories2' => '',
			'post_tags2' => '',	
			'thumbnail2' => 0,				
			'ignore_sticky2'		  => 0,
			'number_posts2'        => 5,
			'orderby2'             => 'date',
			'comment_number'       => 5
		);
		$instance            = wp_parse_args( (array) $instance, $defaults );
		$featured_categories1 = (array)$instance['featured_categories1'];
		$featured_categories2 = (array)$instance['featured_categories2'];
		$orderby 	         = array( 'date', 'comment_count', 'rand' );


		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title1' ); ?>"><?php esc_html_e('选项卡一标题：', 'summerleaf') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title1' ); ?>" name="<?php echo $this->get_field_name( 'title1' ); ?>" value="<?php echo $instance['title1']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_tags1' ); ?>"><?php esc_html_e('选项卡一多选标签（请输入标签ID，英文逗号分隔“,”）：', 'summerleaf') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'post_tags1' ); ?>" name="<?php echo $this->get_field_name( 'post_tags1' ); ?>" value="<?php echo $instance['post_tags1']; ?>" />
		</p>
		<?php $categories = get_categories(); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'featured_categories1' ); ?>"><?php esc_html_e('选项卡一多选分类（不选表示全部文章）：', 'summerleaf') ?></label>
			<select class="widefat" multiple="multiple" name="<?php echo $this->get_field_name( 'featured_categories1' );?>[]" id="<?php echo $this->get_field_id( 'featured_categories1' );?>">
				<?php foreach ( $categories as $category ) { ?>
					<option value="<?php echo $category->term_id; ?>" <?php echo in_array( $category->term_id, $featured_categories1 ) ? 'selected="selected" ' : '';?>><?php echo $category->name . " (". $category->count . ")"; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number_posts1' ); ?>"><?php esc_html_e('选项卡一显示文章数量：', 'summerleaf') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number_posts1' ); ?>" name="<?php echo $this->get_field_name( 'number_posts1' ); ?>" value="<?php echo $instance['number_posts1']; ?>" />
		</p>
		<p>
		   <input id="<?php echo $this->get_field_id('ignore_sticky1'); ?>" name="<?php echo $this->get_field_name('ignore_sticky1'); ?>" type="checkbox" value="1" <?php checked('1', $instance['ignore_sticky1']); ?>/>
		   <label for="<?php echo $this->get_field_id('ignore_sticky1'); ?>"><?php esc_html_e('选项卡一忽略置顶帖', 'summerleaf') ?></label>
	  </p>
		<p>
		   <input id="<?php echo $this->get_field_id('thumbnail1'); ?>" name="<?php echo $this->get_field_name('thumbnail1'); ?>" type="checkbox" value="1" <?php checked('1', $instance['thumbnail1']); ?>/>
		   <label for="<?php echo $this->get_field_id('thumbnail1'); ?>"><?php esc_html_e('选项卡一缩略图风格', 'summerleaf') ?></label>
	  </p>	  
		<p>
			<label for="<?php echo $this->get_field_id( 'orderby1' ); ?>"><?php esc_html_e('选项卡一排序：', 'summerleaf') ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'orderby1' );?>" id="<?php echo $this->get_field_id( 'orderby1' );?>">
				<?php for ( $i = 0; $i <= 2; $i++ ){ ?>
					<option value="<?php echo $orderby[$i]; ?>" <?php echo ($orderby[$i] == $instance['orderby1']) ? 'selected="selected" ' : '';?>><?php echo $orderby[$i]; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title2' ); ?>"><?php esc_html_e('选项卡二标题：', 'summerleaf') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title2' ); ?>" name="<?php echo $this->get_field_name( 'title2' ); ?>" value="<?php echo $instance['title2']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_tags2' ); ?>"><?php esc_html_e('选项卡二多选标签（请输入标签ID，英文逗号分隔“,”）：', 'summerleaf') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'post_tags2' ); ?>" name="<?php echo $this->get_field_name( 'post_tags2' ); ?>" value="<?php echo $instance['post_tags2']; ?>" />
		</p>
		<?php $categories = get_categories(); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'featured_categories2' ); ?>"><?php esc_html_e('选项卡二多选分类（不选表示全部文章）：', 'summerleaf') ?></label>
			<select class="widefat" multiple="multiple" name="<?php echo $this->get_field_name( 'featured_categories2' );?>[]" id="<?php echo $this->get_field_id( 'featured_categories2' );?>">
				<?php foreach ( $categories as $category ) { ?>
					<option value="<?php echo $category->term_id; ?>" <?php echo in_array( $category->term_id, $featured_categories2 ) ? 'selected="selected" ' : '';?>><?php echo $category->name . " (". $category->count . ")"; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number_posts2' ); ?>"><?php esc_html_e('选项卡二显示文章数量：', 'summerleaf') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number_posts2' ); ?>" name="<?php echo $this->get_field_name( 'number_posts2' ); ?>" value="<?php echo $instance['number_posts2']; ?>" />
		</p>
		<p>
		   <input id="<?php echo $this->get_field_id('ignore_sticky2'); ?>" name="<?php echo $this->get_field_name('ignore_sticky2'); ?>" type="checkbox" value="1" <?php checked('1', $instance['ignore_sticky2']); ?>/>
		   <label for="<?php echo $this->get_field_id('ignore_sticky2'); ?>"><?php esc_html_e('选项卡二忽略置顶帖', 'summerleaf') ?></label>
	  </p>
		<p>
		   <input id="<?php echo $this->get_field_id('thumbnail2'); ?>" name="<?php echo $this->get_field_name('thumbnail2'); ?>" type="checkbox" value="1" <?php checked('1', $instance['thumbnail2']); ?>/>
		   <label for="<?php echo $this->get_field_id('thumbnail2'); ?>"><?php esc_html_e('选项卡二缩略图风格', 'summerleaf') ?></label>
	  </p>	  
		<p>
			<label for="<?php echo $this->get_field_id( 'orderby2' ); ?>"><?php esc_html_e('选项卡二排序：', 'summerleaf') ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'orderby2' );?>" id="<?php echo $this->get_field_id( 'orderby2' );?>">
				<?php for ( $i = 0; $i <= 2; $i++ ){ ?>
					<option value="<?php echo $orderby[$i]; ?>" <?php echo ($orderby[$i] == $instance['orderby2']) ? 'selected="selected" ' : '';?>><?php echo $orderby[$i]; ?></option>
				<?php } ?>
			</select>
		</p>
	  <p>
			<label for="<?php echo $this->get_field_id( 'comment_number' ); ?>"><?php esc_html_e('选项卡三显示评论数量：', 'summerleaf') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'comment_number' ); ?>" name="<?php echo $this->get_field_name( 'comment_number' ); ?>" value="<?php echo $instance['comment_number']; ?>" />
		</p>
<?php
	}
}
