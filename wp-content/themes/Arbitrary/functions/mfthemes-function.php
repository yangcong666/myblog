<?php
/**
 * Mfthemes core theme functions
 *
 *
 * @package Mfthemes
 * @author Mufeng
 * @url http://mufeng.me
 */

	define('IsMobile', wp_is_mobile());
	
	define('THEMEVER', "1.50"); 
	
	define("TPLDIR", get_bloginfo('template_directory'));
 
	// Theme functions
	if( is_admin() ) :
		get_template_part('functions/mfthemes-widget');
		get_template_part('functions/mfthemes-class.tgm');
		get_template_part('functions/mfthemes-admin');
	else :
		get_template_part('functions/mfthemes-meta');
		get_template_part('functions/mfthemes-action');
		get_template_part('functions/mfthemes-widget');
	endif;
	
	// Add rss feed 
	add_theme_support( 'automatic-feed-links' );

	// Register wordpress menu
	register_nav_menus(array(
		'mobileMenu' => '移动版 菜单',
		'desktopMenu' => '桌面版 菜单',
		'customMenu' => '顶部导航 附加菜单'
	));

	// Register wordpress sidebar
	register_sidebar(array(
		'name'=>'sidebar',
		'id' => 'sidebar-page',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));	
	
	// Enqueue style-file, if it exists.
	add_action('wp_enqueue_scripts', 'mfthemes_script');
	function mfthemes_script() {
		if( !IsMobile ){
			$options = get_option('mfthemes_options');
			wp_enqueue_style('style', TPLDIR . '/style.css', array(), THEMEVER, 'screen');
			wp_enqueue_script( 'jquery1.8.2', TPLDIR . '/script/jquery.min.js', array(), '1.8.2', false);
			wp_enqueue_script( 'base', TPLDIR . '/script/base.js', array(), THEMEVER, false);
			
			if( !!$options["fixed"] ){
				wp_localize_script( 'base', 'mufeng', 
					array(
						"fixed" => 1
				));				
			}
		}else{
			wp_enqueue_style('mobile', TPLDIR . '/mobile.css', array(), THEMEVER, 'screen');
		}
				
		if ( is_singular() || is_page()){			
			wp_enqueue_script( 'jquery1.8.2', TPLDIR . '/script/jquery.min.js', array(), THEMEVER, false);			
			$config = get_option('ykv_config');
			if( function_exists('the_youku') && $config["pagename"] && is_page($config["pagename"]) ){
				wp_enqueue_style( 'video', TPLDIR . '/script/video.css', array(), THEMEVER, 'screen');
				wp_enqueue_script( 'video', TPLDIR . '/script/video.js', array(), THEMEVER, false);	
				wp_localize_script( 'video', 'youkujs', array("swfurl" => ($config["swf_url"] ? $config["swf_url"] : "") ));				
			}else if( is_page('archives') ){
				wp_enqueue_style( 'archives', TPLDIR . '/script/archives.css', array(), THEMEVER, 'screen');
				wp_enqueue_script( 'archives', TPLDIR . '/script/archives.js', array(), THEMEVER, false);
			}else{
				global $post;
				$postid = $post->ID;
				$ajaxurl = home_url("/");
				
				$fixed = !!$options["fixed"] ? 1 : 0;
				
				wp_enqueue_script( 'single', TPLDIR . '/script/single.js', array(), THEMEVER, false);
				
				wp_localize_script( 'single', 'mufeng', 
					array(
						"postid" => $postid,
						"ajaxurl" => $ajaxurl,
						"fixed" => $fixed
				));
			}
		}
	}
	
	// Pagenavi of archive and index part
	function pagenavi( $p = 5 ) {
		if ( is_singular() ) return;
		global $wp_query, $paged;
		$max_page = $wp_query->max_num_pages;
		if ( $max_page == 1 ) return;
		if ( empty( $paged ) ) $paged = 1;
		if ( $paged > 1 ) p_link( $paged - 1, '« Previous', '«' );
		if ( $paged > $p + 2 ) echo '<span class="page-numbers">...</span>';
		for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
			if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );
		}
		if ( $paged < $max_page - $p - 1 ) echo '<span class="page-numbers">...</span>';
		if ( $paged < $max_page ) p_link( $paged + 1,'Next »', '»' );
	}

	function p_link( $i, $title = '', $linktype = '' ) {
		if ( $title == '' ) $title = "第 {$i} 页";
		if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
		echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a> ";
	}
	
	function time_since($older_date,$comment_date = false) {
		$chunks = array(
			array(86400 , '天前'),
			array(3600 , '小时前'),
			array(60 , '分钟前'),
			array(1 , '秒前'),
		);
		$newer_date = time();
		$since = abs($newer_date - $older_date);
		if($since < 2592000){
			for ($i = 0, $j = count($chunks); $i < $j; $i++){
				$seconds = $chunks[$i][0];
				$name = $chunks[$i][1];
				if (($count = floor($since / $seconds)) != 0) break;
			}
			$output = $count.$name;
		}else{
			$output = !$comment_date ? (date('Y-m-j G:i', $older_date)) : (date('Y-m-j', $older_date));
		}
		return $output;
	}

	function comment_mail_notify($comment_id) {
		$comment = get_comment($comment_id);
		$parent_id = $comment->comment_parent ? $comment->comment_parent : '';
		$spam_confirmed = $comment->comment_approved;
		
		$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
		$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
		$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";	
		
		if (($parent_id != '') && ($spam_confirmed != 'spam')) {
			$to = trim(get_comment($parent_id)->comment_author_email);
			$subject = '你在 [' . get_option("blogname") . '] 的留言有了新回复';
			$message = '
				<div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">
				<p><strong>' . trim(get_comment($parent_id)->comment_author) . ', 你好!</strong></p>
				<p><strong>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言为:</strong><br />'
				. trim(get_comment($parent_id)->comment_content) . '</p>
				<p><strong>' . trim($comment->comment_author) . ' 给你的回复是:</strong><br />'
				. trim($comment->comment_content) . '<br /></p>
				<p>你可以点击此链接 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看完整内容</a></p><br />
				<p>欢迎再次来访<a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
				<p>(此邮件为系统自动发送，请勿直接回复.)</p>
				</div>';

			wp_mail( $to, $subject, $message, $headers );
		}
	}
	add_action('comment_post', 'comment_mail_notify');
	
	// MF_coment part
	function mfthemes_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		global $commentcount;
		if(!$commentcount) {
		   $page = ( !empty($in_comment_loop) ) ? get_query_var('cpage')-1 : get_page_of_comment( $comment->comment_ID, $args )-1;
		   $cpp = get_option('comments_per_page');
		   $commentcount = $cpp * $page;
		}
		if(!$comment->comment_parent){
		?>
		   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
				<div id="comment-<?php comment_ID(); ?>" class="comment-body">
					<div class="comment-avatar"><?php echo get_avatar( $comment, $size = '50'); ?></div>
						<span class="comment-floor">
							<?php 
								++$commentcount;
								switch($commentcount){
									case 1:
										print_r("沙发");
										break;
									case 2:	
										print_r("板凳");
										break;	
									case 3:	
										print_r("地板");
										break;		
									default:
										printf(__('%s楼'), $commentcount);
								}
							?>
						</span>					
					<div class="comment-data">
						<span class="comment-span"><?php printf(__('%s'), get_comment_author_link()) ?></span>
						<span class="comment-span comment-date"><?php echo time_since(abs(strtotime($comment->comment_date_gmt . "GMT")), true);?></span>
					</div>
					<div class="comment-text"><?php comment_text() ?></div>
					<div class="comment-reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('回复')))) ?></div>
				</div>
		<?php }else{?>
		   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
				<div id="comment-<?php comment_ID(); ?>" class="comment-body comment-children-body">
					<div class="comment-avatar"><?php echo get_avatar( $comment, $size = '30'); ?></div>
					<span class="comment-floor"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('回复')))) ?></span>					
					<div class="comment-data">
						<span class="comment-span">
							<?php $parent_id = $comment->comment_parent; $comment_parent = get_comment($parent_id); printf(__('%s'), get_comment_author_link()) ?>
						</span>
						<span class="comment-span comment-date"><?php echo time_since(abs(strtotime($comment->comment_date_gmt . "GMT")), true);?></span>
					</div>
					<div class="comment-text">
						<span class="comment-to"><a href="<?php echo "#comment-".$parent_id;?>" title="<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $comment_parent->comment_content)), 0, 100,"..."); ?>">@<?php echo $comment_parent->comment_author;?></a>：</span>
						<?php echo get_comment_text(); ?>
					</div>
				</div>	
		<?php }
	}
	
	// Post thumbnail
	add_theme_support( 'post-thumbnails' );
	function mfthemes_thumbnail($width=130, $height=130){
		global $post;
		$title = $post->post_title;
		if( has_post_thumbnail() ){
			$timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
			$src = $timthumb_src[0];
			return array(
				"hasThumbnail" => true,
				"src" => TPLDIR . "/timthumb.php&#63;src={$src}&#38;w={$width}&#38;h={$height}&#38;zc=1&#38;q=100"
			);
		}else{
			ob_start();
			ob_end_clean();
			$output = preg_match_all('/\<img.+?src="(.+?)".*?\/>/is',$post->post_content,$matches ,PREG_SET_ORDER);
			$cnt = count( $matches );
			if($cnt>0){
				$src = $matches[0][1];
				return array(
					"hasThumbnail" => true,
					"src" => TPLDIR . "/timthumb.php&#63;src={$src}&#38;w={$width}&#38;h={$height}&#38;zc=1&#38;q=100"
				);
			}
		}
		return array(
			"hasThumbnail" => false,
			"src" => null
		);
	}
	
	// Theme body style
	add_filter('body_class','mfthemes_body_classes');	
	function mfthemes_body_classes($classes) {
		$options = get_option('mfthemes_options');
		if( function_exists('the_youku') && $options["video"] == 1 ) $classes[] = 'has-video';
		return $classes;
	}	
?>