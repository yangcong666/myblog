<?php
/**
 * Block 1 - Slider Widget
 */

// Register the widget
add_action( 'widgets_init', create_function( '', 'return register_widget("Summerleaf_Auther_Info_Widget");'));

// The widget class
class Summerleaf_Auther_Info_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'auther_info_widget', 'description' => esc_html__( "在侧边栏显示站长信息", 'summerleaf') );
		parent::__construct('sl_block6', esc_html__('夏叶侧边栏站长信息', 'summerleaf'), $widget_ops);
		$this->alt_option_name = 'widget_auther_info';

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
			$cache = wp_cache_get( 'widget_auther_info', 'widget' );
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
		$title               = ( ! empty( $instance['title'] ) ) ? $instance['title']                             : '夏叶';
		//创建过滤器apply_filters 可以在其它地方过滤标题
		$title               = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$title_desc	         = ( ! empty( $instance['title_desc'] ) ) ? $instance['title_desc']                             : '夏叶绚丽，秋叶静美';
		$qq_url	         = ( ! empty( $instance['qq_url'] ) ) ? $instance['qq_url']  : '#';
		$comment_url = ( ! empty( $instance['comment_url'] ) ) ? $instance['comment_url'] : '#';

    //https://codex.wordpress.org/Function_Reference/wp_count_comments
    $comments_count = wp_count_comments();
    $count_posts = wp_count_posts();
    

    $autherlogo = of_get_option( 'summer_autherlogo');
       	
    $autherlogo = ($autherlogo) ? $autherlogo : get_theme_file_uri('/images/wordpressleaf.png') ;

		echo $args['before_widget'];
							
    echo '<div id="auther_info_widget_'.$args['widget_id'].'">
  <div class="aside-con clear">
   <div class="c-xintop"></div>
   <div class="c-xinboby">
    <div class="c-xin-img">
     <img src="'. $autherlogo .'" />
    </div>
    <h4>'.$title.'</h4>
    <p class="c-p">'.$title_desc.'</p>
    <div class="c-foot"> 
     <span class="c-span-lf"><a title="QQ联系我" href="'.$qq_url.'"  rel="nofollow"><i class="fa fa-qq"></i>QQ群</a></span>
     <span class="c-span-lr"><a title="给我留言" href="'.$comment_url.'" rel="nofollow"><i class="fa fa-envelope"></i>留言</a></span>
    </div>
   </div>
   <div class="c-xinfoot">
    <ul>
     <li><span>'.$count_posts->publish.'</span>文章</li>
     <li><span>' . $comments_count->total_comments .'</span>评论</li>
     <li><span>166231</span>浏览</li>
    </ul>
   </div>
  </div>   	
   </div>
   <div class="clear"></div>';		
			
			
      

      echo $args['after_widget'];
      

		?>

		<?php
		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_auther_info', $cache, 'widget' );
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
			'title'               => '',
			'title_desc' => '',		
			'qq_url' => '',	
			'comment_url' => '',		
		) );

		$instance['title']               = sanitize_text_field( $new_instance['title'] );
		$instance['title_desc']              = sanitize_text_field( $new_instance['title_desc'] );
		$instance['qq_url']              = sanitize_text_field( $new_instance['qq_url'] );
		$instance['comment_url']              = sanitize_text_field( $new_instance['comment_url'] );

		return $instance;
	}

	/**
	 * @access public
	 */
	public function remove_cache() {
		wp_cache_delete('widget_auther_info', 'widget');
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {

		// Set default value.
		$defaults = array(
			'title'               => '',
			'title_desc' => '',		
			'qq_url' => '',	
			'comment_url' => '',				

		);
		$instance            = wp_parse_args( (array) $instance, $defaults );



		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('作者名字标题：', 'summerleaf') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title_desc' ); ?>"><?php esc_html_e('作者语录：', 'summerleaf') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title_desc' ); ?>" name="<?php echo $this->get_field_name( 'title_desc' ); ?>" value="<?php echo $instance['title_desc']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'qq_url' ); ?>"><?php esc_html_e('QQ群网址：', 'summerleaf') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'qq_url' ); ?>" name="<?php echo $this->get_field_name( 'qq_url' ); ?>" value="<?php echo $instance['qq_url']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'comment_url' ); ?>"><?php esc_html_e('评论网址：', 'summerleaf') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'comment_url' ); ?>" name="<?php echo $this->get_field_name( 'comment_url' ); ?>" value="<?php echo $instance['comment_url']; ?>" />
		</p>

<?php
	}
}
