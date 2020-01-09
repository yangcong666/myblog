<?php
header("Content-type: text/html; charset=utf-8");
include("includes/functions/meta_boxes.php");
include("includes/functions/face.php");
include("includes/functions/admin.php");
if(stripslashes(get_option('smartideo_grey'))==1){
include("includes/functions/smartideo.php");
};

// 去除头部不必要信息
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'print_emoji_detection_script', 7 );
remove_action('admin_print_scripts', 'print_emoji_detection_script' );
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_action('admin_print_styles', 'print_emoji_styles' );





// 后台登陆LOGO修改
function custom_login_logo(){
  echo "<link rel='stylesheet' id='colors-fresh-css'  href='".get_bloginfo("template_url")."/css/admin_style.css' type='text/css' media='all' />";
  if(stripslashes(get_option('login_logo'))){
    echo "<style>.login h1 a{background:url(".stripslashes(get_option('login_logo')).") center bottom no-repeat;}</style>";
  }
  echo "<style>body.login{background:url(".stripslashes(get_option('login_bgpic')).") ".stripslashes(get_option('login_bgcolor'))." center no-repeat;}</style>";
  echo '<script type="text/javascript" src="'.get_bloginfo("template_url").'/js/public/jquery-1.11.2.min.js"></script><script type="text/javascript">$(document).ready(function() {$("#login h1 a").attr("href", "http://www.shejiwo.net/").attr("target", "_blank");});</script>';
}
add_action('login_head', 'custom_login_logo');


//按原格式输出
function forHtml($str){
	$returnstr=htmlspecialchars($str);
	$returnstr=str_replace(' ',' ',$returnstr);
	$returnstr=str_replace(chr(10),'<br/>',$returnstr);
	return($returnstr);
}




//Gravatar 头像被墙及解决方案
function get_ssl_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');


//主题自定义菜单
register_nav_menus(
	array(
    'header-menu' => __( '顶部导航' ),
    'mobile-header-menu' => __( '手机导航' )
	)
);



//文章图片
function post_thumbnail(){
    if(has_post_thumbnail()){    //如果有缩略图，则显示缩略图
        the_post_thumbnail(array(250,250));
    } else {
        global $post, $posts;
        $post_img = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        $post_img_src = $matches [1][0];
        $post_img = '<img src="'.$post_img_src.'" alt="" />';    //如果没有缩略图，则显示日志中的第一张图片
        if(empty($post_img_src)){    //如果日志中没有图片，则显示默认图片
            $post_img = '<img src="'.get_bloginfo("template_url").'/images/nopic.gif" alt="" />';
        }
        echo $post_img;
    }
}
//输出缩略图地址
function post_thumbnail_src(){
    global $post;
  if( $values = get_post_custom_values("thumb") ) { //输出自定义域图片地址
    $values = get_post_custom_values("thumb");
    $post_thumbnail_src = $values [0];
  } elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
    $post_thumbnail_src = $thumbnail_src [0];
    } else {
    $post_thumbnail_src = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $post_thumbnail_src = $matches [1] [0];   //获取该图片 src
    if(empty($post_thumbnail_src)){ //如果日志中没有图片，则显示随机图片
      $random = mt_rand(1, 10);
      echo get_bloginfo('template_url');
      echo '/images/pic/'.$random.'.jpg';
      //如果日志中没有图片，则显示默认图片
      //echo '/images/default_thumb.jpg';
    }
  };
  echo $post_thumbnail_src;
}



if(stripslashes(get_option('thumbcolumn_grey'))==1){
// 为WordPress后台文章列表添加缩略图
if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
// for post and page
add_theme_support('post-thumbnails', array( 'post' ) );
function fb_AddThumbColumn($cols) {
  $cols['thumbnail'] = __('Thumbnail');
  return $cols;
}
function fb_AddThumbValue($column_name, $post_id) {
  $width = (int) 160;
  $height = (int) 160;
  if ( 'thumbnail' == $column_name ) {
    // thumbnail of WP 2.9
    $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
    // image from gallery
    $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
    if ($thumbnail_id)
      $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
    elseif ($attachments) {
      foreach ( $attachments as $attachment_id => $attachment ) {
        $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
      }
    }
    if ( isset($thumb) && $thumb ) {
      echo $thumb;
    } else {
      echo __('None');
    }
  }
}
// for posts
add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
// for pages
add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );
}
}




// 上传文件自动重命名
if(stripslashes(get_option('rename_filename'))){

function rename_filename($filename) {
  $info = pathinfo($filename);
  $ext = empty($info['extension']) ? '' : '.' . $info['extension'];
  $name = basename($filename, $ext);
  return substr(md5($name), 0, 20) . $ext;
}
add_filter('sanitize_file_name', 'rename_filename', 10);

}



// 全站灰度
function grey_style(){
  if(stripslashes(get_option('filter_grey'))==1){
?>
<style>
html{overflow-y:scroll;filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(100%);}
</style>
<?php
  }
}
add_action('wp_head', 'grey_style');






add_theme_support( 'post-thumbnails' );



//开启主题后自动跳转
if ( ! function_exists( 'catchbox_setup' ) ) :

function shjiwo_setup(){
	//Redirect to Theme Options Page on Activation
	global $pagenow;
	if ( is_admin() && isset($_GET['activated'] ) && $pagenow =="themes.php" ) {
		
		
		wp_redirect( 'admin.php?page=themes-settings' );
	}
}

endif;
add_action( 'after_setup_theme', 'shjiwo_setup' );


?>