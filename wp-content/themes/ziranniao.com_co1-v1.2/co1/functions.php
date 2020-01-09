<?php
$coname = 'CO1';
add_action( 'after_setup_theme', 'cotheme_setup' );

//隐藏头部工具栏
function hide_admin_bar($flag) {
return false;
}
include('option/cotheme.php');

//侧边工具栏
if (function_exists('register_sidebar')){

    register_sidebar(array(

        'name'          => '网站侧栏',

        'id'            => 'widget_sidebar',

        'before_widget' => '<div class="widget %2$s">',

        'after_widget'  => '</div>',

        'before_title'  => '<h3 class="widget-title"><span>',

        'after_title'   => '</span></h3>',

    ));

}


//自定义字段
function get_custom_field_value($id, $szKey, $bPrint = false,$falsemsg) {

  $szValue = get_post_meta($id, $szKey, true);

  if ( $bPrint == false ) return $szValue; else echo $szValue;

        if($falsemsg !="" && $szValue=="") echo $falsemsg;

}

//广告系统
add_action('widgets_init', create_function('', 'return register_widget("CO_banner");'));
class CO_banner extends WP_Widget {

  function CO_banner() {

    global $dname;

        $this->WP_Widget( 'CO_banner', '主题 - 侧栏广告', array( 'description' => '显示侧栏广告' ) );

    }

  function widget($args, $instance) {

    extract($args, EXTR_SKIP);

    echo $before_widget;

    $title = empty($instance['title']) ? '0' : apply_filters('widget_name', $instance['title']);

    $url = empty($instance['url']) ? '0' : apply_filters('widget_url', $instance['url']);

    $pic = empty($instance['pic']) ? '0' : apply_filters('widget_pic', $instance['pic']);



    echo '<a href="'.$url.'"><img src="'.$pic.'" alt="'.$title.'">'.$title.'</a>';

    echo $after_widget;

  }

  function update($new_instance, $old_instance) {

    $instance = $old_instance;

    $instance['title'] = $new_instance['title'];

    $instance['url'] = $new_instance['url'];

    $instance['pic'] = $new_instance['pic'];

    return $instance;

  }

  function form($instance) {

    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'url' => '' ,'pic' => '' ) );

    $title = $instance['title'];

    $url = $instance['url'];

    $pic = $instance['pic'];



    echo '<p><label>名称：<input placeholder="Name" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.attribute_escape($title).'" class="widefat" /></label></p>';

    echo '<p><label>链接：<input placeholder="http://" id="'.$this->get_field_id('url').'" name="'.$this->get_field_name('url').'" type="text" value="'.attribute_escape($url).'" class="widefat" /></label></p>';

    echo '<p><label>图片（宽度=148px）：<input placeholder="" id="'.$this->get_field_id('pic').'" name="'.$this->get_field_name('pic').'" type="text" value="'.attribute_escape($pic).'" class="widefat" /></label></p>';

    echo '<p style="text-align:center"><a href="'.$url.'"><img src="'.$pic.'" alt="'.$title.'"></a></p>';

    

  }

}


//最新评论
class widget_newcomments extends WP_Widget {
  function widget_newcomments() {
    $option = array('classname' => 'widget_newcomments', 'description' => '显示网友最新评论（头像+名称+评论）' );
    $this->WP_Widget(false, 'CO - 最新评论 ', $option);
  }
  function widget($args, $instance) {
    extract($args, EXTR_SKIP);
    echo $before_widget;
    $title = empty($instance['title']) ? '最新评论' : apply_filters('widget_title', $instance['title']);
    $count = empty($instance['count']) ? '5' : apply_filters('widget_count', $instance['count']);

    echo $before_title . $title . $after_title;
    echo '<ul class="newcomments">';
    echo mod_newcomments( $count );
    echo '</ul>';
    echo $after_widget;
  }
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['count'] = strip_tags($new_instance['count']);
    return $instance;
  }
  function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => '' ) );
    $title = strip_tags($instance['title']);
    $count = strip_tags($instance['count']);

    echo '<p><label>标题：<input id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.attribute_escape($title).'" size="24" /></label></p>';
    echo '<p><label>数目：<input id="'.$this->get_field_id('count').'" name="'.$this->get_field_name('count').'" type="text" value="'.attribute_escape($count).'" size="3" /></label></p>';
  }
}

function mod_newcomments( $limit ){
  global $wpdb;
  $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved,comment_author_email, comment_type,comment_author_url, 
  SUBSTRING(comment_content,1,24) AS com_excerpt
  FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1'
  AND comment_type = ''
  AND post_password = ''
  AND user_id!='1'
  ORDER BY comment_date_gmt DESC LIMIT $limit ";
  $comments = $wpdb->get_results($sql);
  foreach ( $comments as $comment ) {
    echo "<li><a href=\"" . get_permalink($comment->ID) . "#comment-" . $comment->comment_ID . "\" title=\"" . $comment->post_title . "上的评论\">". get_avatar( $comment->comment_author_email, $size = '55', $default = get_bloginfo('wpurl').'/avatar/default.jpg' ) . "<h5>". strip_tags($comment->comment_author) ."</h5><p>". strip_tags($comment->com_excerpt) ."</p></a></li>";
  }
  echo $output;
};
register_widget('widget_newcomments');

//end



/* 
 * 最新评论获取 cocss_theme_recent_comments( $outer='', $limit='10' );
 * $outer 不显示某人的评论
 * $limit 显示条数
*/
function cocss_theme_recent_comments($outer,$limit){
    global $wpdb;
    $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved,comment_author_email, comment_type,comment_author_url, SUBSTRING(comment_content,1,40) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND comment_author != '".$outer."' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $limit";
    $comments = $wpdb->get_results($sql);
    foreach ( $comments as $comment ) {
        $output .= "\n<li><div class=\"clearfix\"><div class=\"entry-image\"><a href=\"" . get_permalink($comment->ID) . "#comment-" . $comment->comment_ID . "\" title=\"" . $comment->post_title . " 上的评论\">".get_avatar($comment->comment_author_email, 55 )."</a></div><div class=\"entry-details clearfix\"><h5 class=\"entry-title\"><a rel=\"bookmark\"title=\"".strip_tags($comment->comment_author)."\"href=\"" . get_permalink($comment->ID) . "#comment-" . $comment->comment_ID . "\">".strip_tags($comment->comment_author)."</a></h5><div class=\"entry-meta\"><a title=\"".strip_tags($comment->com_excerpt)."\"href=\"" . get_permalink($comment->ID) . "#comment-" . $comment->comment_ID . "\">".strip_tags($comment->com_excerpt)."</a></div></div></div></li>";
    }
  
    echo $output;
}


function dopt($e){



    return stripslashes(get_option($e));



}





/**



 * Helper function for pagination which builds the page links.



 *



 * @access private



 *



 * @author Eric Martin <eric@ericmmartin.com>



 * @copyright Copyright (c) 2009, Eric Martin



 * @version 1.0



 *



 * @param int $start The first link page.



 * @param int $max The last link page.



 * @return int $page Optional, default is 0. The current page.



 */



function emm_paginate_loop($start, $max, $page = 0) {



  $output = "";



  for ($i = $start; $i <= $max; $i++) {



    $output .= ($page === intval($i)) 



      ? "<span class='pages current'>$i</span>" 



      : "<a href='" . get_pagenum_link($i) . "' class='page'>$i</a>";



  }



  return $output;



}




function cotheme_setup(){
  
  //去除头部冗余代码
  remove_action( 'wp_head',   'feed_links_extra', 3 ); 
  remove_action( 'wp_head',   'rsd_link' ); 
  remove_action( 'wp_head',   'wlwmanifest_link' ); 
  remove_action( 'wp_head',   'index_rel_link' ); 
  remove_action( 'wp_head',   'start_post_rel_link', 10, 0 ); 
  remove_action( 'wp_head',   'wp_generator' ); 

  add_filter('show_admin_bar','hide_admin_bar'); 
  add_action('wp_head',     'cotheme_keywords');      //关键字
  add_action('wp_head',     'cotheme_description');   //页面描述
  add_action('init',      'cotheme_gzip');        //Gzip压缩
  add_filter('smilies_src', 'cotheme_smilies_src',1,10);  //评论表情改造，如需更换表情，img/smilies/下替换

    //头像缓存
    if(dopt('co_avatar_b')!=''){
     add_filter('get_avatar','cotheme_avatar');
    }

    //缩略图设置
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(140, 98, true); 
  
  //移除自动保存和修订版本
  add_action('wp_print_scripts',  'cotheme_disable_autosave' );
  remove_action('pre_post_update','wp_save_post_revision' );
  
  //去除自带js
  wp_deregister_script( 'l10n' ); 
  
  //修改默认发信地址
  add_filter('wp_mail_from', 'cotheme_res_from_email');
  add_filter('wp_mail_from_name', 'cotheme_res_from_name');
  
  //定义菜单
  if (function_exists('register_nav_menus')){
    register_nav_menus( array(
        'nav'     => __('站点导航'),
        'menu'    => __('顶部菜单')
    ) );
  }

}

//Gzip压缩
function cotheme_gzip() {
  if ( strstr($_SERVER['REQUEST_URI'], '/js/tinymce') )
    return false;
  if ( ( ini_get('zlib.output_compression') == 'On' || ini_get('zlib.output_compression_level') > 0 ) || ini_get('output_handler') == 'ob_gzhandler' )
    return false;
  if (extension_loaded('zlib') && !ob_start('ob_gzhandler'))
    ob_start();
}

function cocss_paging($args = null) {
  $defaults = array(
    'page' => null, 'pages' => null, 
    'range' => 3, 'gap' => 3, 'anchor' => 1,
    'before' => '<div class="paging_wrap clearfix"><div class="paging">', 'after' => '</div></div>',
    'title' => __('Pages:'),
    'nextpage' => __('&raquo;'), 'previouspage' => __('&laquo'),
    'echo' => 1
  );
  $r = wp_parse_args($args, $defaults);
  extract($r, EXTR_SKIP);
  if (!$page && !$pages) {
    global $wp_query;
    $page = get_query_var('paged');
    $page = !empty($page) ? intval($page) : 1;







    $posts_per_page = intval(get_query_var('posts_per_page'));



    $pages = intval(ceil($wp_query->found_posts / $posts_per_page));



  }



  



  $output = "";



  if ($pages > 1) { 



    $output .= "$before<span class='pages_title'></span>"; //add $title



    $ellipsis = "<span class='emm-gap'>...</span>";







    if ($page > 1 && !empty($previouspage)) {



      $output .= "<a href='" . get_pagenum_link($page - 1) . "' class='emm-prev'>$previouspage</a>";



    }



    



    $min_links = $range * 2 + 1;



    $block_min = min($page - $range, $pages - $min_links);



    $block_high = max($page + $range, $min_links);



    $left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;



    $right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;







    if ($left_gap && !$right_gap) {



      $output .= sprintf('%s%s%s', 



        emm_paginate_loop(1, $anchor), 

        $ellipsis, 



        emm_paginate_loop($block_min, $pages, $page)



      );



    }



    else if ($left_gap && $right_gap) {



      $output .= sprintf('%s%s%s%s%s', 



        emm_paginate_loop(1, $anchor), 



        $ellipsis, 



        emm_paginate_loop($block_min, $block_high, $page), 



        $ellipsis, 



        emm_paginate_loop(($pages - $anchor + 1), $pages)



      );



    }



    else if ($right_gap && !$left_gap) {



      $output .= sprintf('%s%s%s', 



        emm_paginate_loop(1, $block_high, $page),



        $ellipsis,



        emm_paginate_loop(($pages - $anchor + 1), $pages)



      );



    }



    else {



      $output .= emm_paginate_loop(1, $pages, $page);



    }







    if ($page < $pages && !empty($nextpage)) {



      $output .= "<a href='" . get_pagenum_link($page + 1) . "' class='emm-next'>$nextpage</a>";



    }







    $output .= $after;



  }







  if ($echo) {



    echo $output;



  }







  return $output;



}





function cotheme_keywords() {



  global $s, $post;



  $keywords = '';



  if ( is_single() ) {



    if ( get_the_tags( $post->ID ) ) {



      foreach ( get_the_tags( $post->ID ) as $tag ) $keywords .= $tag->name . ', ';



    }



    foreach ( get_the_category( $post->ID ) as $category ) $keywords .= $category->cat_name . ', ';



    $keywords = substr_replace( $keywords , '' , -2);



  } elseif ( is_home () )    { $keywords = dopt('co_keywords');



  } elseif ( is_tag() )      { $keywords = single_tag_title('', false);



  } elseif ( is_category() ) { $keywords = single_cat_title('', false);



  } elseif ( is_search() )   { $keywords = esc_html( $s, 1 );



  } else { $keywords = trim( wp_title('', false) );



  }



  if ( $keywords ) {



    echo "<meta name=\"keywords\" content=\"$keywords\" />\n";



  }



}









//网站描述
function cotheme_description() {
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
  } elseif ( is_home () )    { $description = $blog_name . "-" . get_bloginfo('description') . dopt('co_description'); // 首頁要自己加
  } elseif ( is_tag() )      { $description = $blog_name . "有关 '" . single_tag_title('', false) . "' 的文章";
  } elseif ( is_category() ) { $description = $blog_name . "有关 '" . single_cat_title('', false) . "' 的文章";
  } elseif ( is_archive() )  { $description = $blog_name . "在: '" . trim( wp_title('', false) ) . "' 的文章";
  } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' 的搜索結果";
  } else { $description = $blog_name . "有关 '" . trim( wp_title('', false) ) . "' 的文章";
  }
  $description = mb_substr( $description, 0, 220, 'utf-8' ) . '..';
  echo "<meta name=\"description\" content=\"$description\" />\n";
}












function cotheme_smilies_src ($img_src, $img, $siteurl){
    return get_bloginfo('template_directory').'/img/smilies/'.$img;
}

function cotheme_disable_autosave() {
  wp_deregister_script('autosave');
}
function cotheme_smilies(){
    $a = array( 'mrgreen','razz','sad','smile','oops','grin','eek','???','cool','lol','mad','twisted','roll','wink','idea','arrow','neutral','cry','?','evil','shock','!' );
    $b = array( 'mrgreen','razz','sad','smile','redface','biggrin','surprised','confused','cool','lol','mad','twisted','rolleyes','wink','idea','arrow','neutral','cry','question','evil','eek','exclaim' );
    for( $i=0;$i<22;$i++ ){
        echo '<a title="'.$a[$i].'" href="javascript:grin('."':".$a[$i].":'".')"><img src="'.get_bloginfo('template_directory').'/img/smilies/icon_'.$b[$i].'.gif" /></a>';
    }
}
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













function cotheme_res_from_email($email) {



    $wp_from_email = get_option('admin_email');



    return $wp_from_email;



}



function cotheme_res_from_name($email){



    $wp_from_name = get_option('blogname');



    return $wp_from_name;



}



//评论头像缓存
function cotheme_avatar($avatar) {
  $tmp = strpos($avatar, 'http');
  $g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
  $tmp = strpos($g, 'avatar/') + 7;
  $f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
  $w = get_bloginfo('wpurl');
  $e = ABSPATH .'avatar/'. $f ;
  $t = 1209600; //14天过期
  if ( !is_file($e) || (time() - filemtime($e)) > $t ) { 
    copy(htmlspecialchars_decode($g), $e);
  } else  $avatar = strtr($avatar, array($g => $w.'/avatar/'.$f));
  if (filesize($e) < 500) copy(get_bloginfo('template_directory').'/img/default.png', $e);
  return $avatar;
}





//时间显示方式‘xx以前’

function time_ago( $type = 'commennt', $day = 14 ) {

  $d = $type == 'post' ? 'get_post_time' : 'get_comment_time';

  if (time() - $d('U') > 60*60*24*$day) return;

  echo ' (', human_time_diff($d('U'), strtotime(current_time('mysql', 0))), '前)';

}



//评论样式

function dtheme_comment_list($comment, $args, $depth) {

  $GLOBALS['comment'] = $comment;

    global $commentcount,$wpdb, $post;

    if(!$commentcount) { //初始化楼层计数器

    $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent");

    $cnt = count($comments);//获取主评论总数量

    $page = get_query_var('cpage');//获取当前评论列表页码

    $cpp=get_option('comments_per_page');//获取每页评论显示数量

    if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page  == ceil($cnt / $cpp))) {

      $commentcount = $cnt + 1;//如果评论只有1页或者是最后一页，初始值为主评论总数

    } else {

      $commentcount = $cpp * $page + 1;

    }

    }



  echo '<li '; comment_class(); echo ' id="comment-'.get_comment_ID().'">';

  //楼层

  if(!$parent_id = $comment->comment_parent) {

    echo '<div class="c-floor"><a href="#comment-'.get_comment_ID().'">'; printf('#%1$s', --$commentcount); echo '</a></div>';

  }

  //头像

  echo '<div class="c-avatar">';

  if (($comment->comment_author_email) == get_bloginfo ('admin_email')){

    echo '<img src="'.get_bloginfo('template_directory').'/img/admin.png" class="avatar" />';

  } else {

    echo get_avatar( $comment->comment_author_email, $size = '36' ,$default = get_bloginfo('wpurl') . '/avatar/default.png'); 

  }

  echo '</div>';

  //内容

  echo '<div class="c-main" id="div-comment-'.get_comment_ID().'">';

    echo comment_text();

    if ($comment->comment_approved == '0'){

      echo '<span class="c-approved">您的评论正在排队审核中，请稍后！</span><br />';

    }

    //信息

    echo '<div class="c-meta">';

       echo '<span class="c-author"><a href="'; echo comment_author_url(); echo '" target="_blank" rel="external nofollow" class="url">'; echo comment_author(); echo '</a></span>'; echo get_comment_time('m-d H:i '); echo time_ago(); 

      if ($comment->comment_approved !== '0'){ 

        echo comment_reply_link( array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); 

        echo edit_comment_link(__('(编辑)'),' - ','');

      } 

    echo '</div>';

  echo '</div>';

}

function random_img($post_id){

  $num=$post_id%10;

  return bloginfo('template_directory').'/img/thumbmail_'.$num.'.png';





}







?>