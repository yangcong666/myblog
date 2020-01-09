<?php
/**************************************************
*标题分隔符修改成 “-”
*https://developer.wordpress.org/reference/hooks/document_title_separator/
*新的 WordPress 网页标题设置方法
**************************************************/

if (!function_exists('Sl_Title_Separator_To_line')) :
    function Sl_Title_Separator_To_line()
    {
        $separator = of_get_option( 'summer_separator');
         
        return ($separator) ? $separator :'|' ;//自定义标题分隔符
    }

endif;

add_filter('document_title_separator', 'Sl_Title_Separator_To_line');


/**************************************************
 * SEO标题-----用于网站SEO标题
 * 新的 WordPress 网页标题设置方法
 **************************************************/
//
function Sl_Seo_title( $title )
{
    global $post;

    //静态首页SEO标题
    if (is_front_page() || is_home()) {

        //获取静态页面的SEO标题，第一个为标题，第二个为关键字
        $seo_title = of_get_option( 'summer_sitetitle');
        //如果标题存在
        if ($seo_title) {
            //如果存在首页标题描述则取消
            if (isset($title['tagline'])) { 
                unset($title['tagline']); 
            }
            //设置首页的SEO标题
            $title['title']=strip_tags($seo_title);

        }


    } elseif (is_single() || is_page()) {

        //获取页面、文章的SEO标题，第一个为标题，第二个为关键字
        $seo_meta =explode('||', get_post_meta($post->ID, 'seo_info', true));
        //如果标题存在
        if ($seo_meta[0]) {
            //设置页面、文章的SEO标题
            $title['title']=strip_tags($seo_meta[0]);

        }


    } elseif (is_tag() || is_category()) {



        //获取标签、分类的SEO标题，第一个为普通描述，第二个为SEO标题
        $seo_meta = explode('||', get_the_archive_description());
        //如果标题存在
        if ($seo_meta[1]) {
            //设置页面、文章的SEO标题
            $title['title']=strip_tags($seo_meta[1]);
        }


        


    }
    //返回标题
    return $title;
}

/**************************************************
*SEO标题-----用于网站SEO标题
*新的 WordPress 网页标题设置方法
**************************************************/
add_filter('document_title_parts', 'Sl_Seo_title');


/**************************************************
*SEO关键字-----用于SEO关键字
**************************************************/
if (!function_exists('Sl_keywords')) :
    function Sl_keywords() 
    {
        global $s, $post;
        $keywords = '';

        //静态首页SEO关键字
        if (is_front_page() || is_home()) {

            //获取静态页面的SEO关键字，第一个为标题，第二个为关键字
            $seo_keywords =of_get_option( 'summer_keywords');
            //如果标题存在
            if ($seo_keywords) {

                //设置首页的SEO关键字
                $keywords=strip_tags($seo_keywords);

            }


        } elseif (is_page()) {

            //获取页面、文章的SEO关键字，第一个为标题，第二个为关键字
            $seo_meta =explode('||', get_post_meta($post->ID, 'seo_info', true));
            //如果标题存在
            if ($seo_meta[1]) {
                //设置页面、文章的SEO标题
                $keywords=strip_tags($seo_meta[1]);
            }


        } elseif (is_single()) {

            //获取页面、文章的SEO关键字，第一个为标题，第二个为关键字
            $seo_meta =explode('||', get_post_meta($post->ID, 'seo_info', true));
            //如果标题存在
            if ($seo_meta[1]) {
                //设置页面、文章的SEO标题
                $keywords=strip_tags($seo_meta[1]);
            } else { //如果没有seo关键字就输出标签和分类
                if (get_the_tags($post->ID)) {
                    foreach (get_the_tags($post->ID) as $tag) {
                        $keywords .= $tag->name . ', ';
                    }

                }
                foreach (get_the_category($post->ID) as $category) {
                    $keywords .= $category->cat_name . ', ';
                }
                $keywords = substr_replace($keywords, '', -2);
            }

        } elseif (is_tag() || is_category()) {


            //找出标签和分类的slug
            $tag_slug=get_query_var('tag');
            $cat_slug=get_query_var('category_name');




            //获取标签、分类的SEO标题，第一个为普通描述，第二个为SEO标题,第三个为关键字
            $seo_meta =explode('||', get_the_archive_description());
            //如果关键字存在
            if ($seo_meta[2]) {
                //设置页面、文章的SEO标题
                $keywords=strip_tags($seo_meta[2]);
            } else {

                $keywords=get_the_archive_title().','.get_bloginfo('name');
            }





        } elseif (is_search()) {
            $keywords = esc_html($s, 1).','.get_bloginfo('name');;
        } else {
            $keywords = get_the_archive_title().','.get_bloginfo('name');
        }//各种类型的判断


        if ($keywords) {
            echo "<meta name=\"keywords\" content=\"$keywords\">\n";
        }

    }
endif;



/**************************************************
*SEO关键字-----用于SEO关键字
**************************************************/
add_action('wp_head', 'Sl_keywords', 1);



/**************************************************
*SEO关键字-----用于SEO描述
**************************************************/
if (!function_exists('Sl_description')) :
    function Sl_description() 
    {
        global $s, $post;
        $description = '';

        //静态首页SEO描述
        if (is_front_page()) {

            //获取静态页面的SEO描述，第一个为标题，第二个为关键字，第三个为描述
            $seo_description =of_get_option( 'summer_description');
            //如果标题存在
            if ($seo_description) {

                //设置首页的SEO关键字
                $description=trim(strip_tags($seo_description));

            }


        } elseif (is_page()) {

            //获取页面的SEO描述，第一个为标题，第二个为关键字，第三个为描述
            $seo_meta =explode('||', get_post_meta($post->ID, 'seo_info', true));
            //如果描述存在
            if ($seo_meta[2]) {
                //设置页面的SEO描述
                $description=trim(strip_tags($seo_meta[2]));

            }


        } elseif (is_single()) {

            //获取文章的SEO描述，第一个为标题，第二个为关键字，第三个为描述
            $seo_meta =explode('||', get_post_meta($post->ID, 'seo_info', true));
            //如果描述存在
            if ($seo_meta[2]) {
                //设置文章的SEO描述
                $description = trim(strip_tags($seo_meta[2]));

            } else {
                //获取文章摘要内容
                $description = desc_excerpt(53);
                $description = mb_substr($description, 0, 160, 'utf-8');
            }


        } elseif (is_tag() || is_category()) {


            //找出标签和分类的slug
            $tag_slug=get_query_var('tag');
            $cat_slug=get_query_var('category_name');
 



            //获取标签、分类的SEO标题，第一个为普通描述，第二个为SEO标题,第三个为关键字
            $seo_meta =explode('||', get_the_archive_description());
            //如果关键字存在
            if ($seo_meta[3]) {
                //设置页面、文章的SEO标题
                $description=trim(strip_tags($seo_meta[3]));
            }


        


        } elseif (is_search()) {
            $description = "'About" . esc_html($s, 1) . "' ".",".get_bloginfo('name');
        } else {
            $description = get_the_archive_title().','.get_bloginfo('name');
        }//各种类型的判断

        if ($description) {

            echo "<meta name=\"description\" content=\"$description\">\n";

        }

    }
endif;



/**************************************************
*SEO关键字-----用于SEO关键字
**************************************************/
add_action('wp_head', 'Sl_description', 1);


/********************************
* 添加获取自动描述的摘要函数
*********************************/

if (!function_exists('desc_excerpt')) {
    function desc_excerpt($limit) 
    {
        global $post;
        $excerpt = $post->post_excerpt ? $post->post_excerpt : $post->post_content;

        $excerpt = explode(' ', $excerpt, $limit);
        if (count($excerpt)>=$limit) {
            array_pop($excerpt);
            $excerpt = implode(" ", $excerpt).'...';
        } else {
            $excerpt = implode(" ", $excerpt).'...';
        }
        $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

        $excerpt = strip_shortcodes($excerpt);
        $excerpt = strip_tags($excerpt);
        $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
        return $excerpt;
    }
}


// 同时删除head和feed中的WP版本号
function Sl_Remove_Wp_version() 
{
    return '';
}


// 隐藏js/css附加的WP版本号
function Sl_Remove_Wp_Version_strings( $src ) 
{
    global $wp_version;
    parse_str(parse_url($src, PHP_URL_QUERY), $query);
    if (!empty($query['ver']) && $query['ver'] === $wp_version) {
        // 用WP版本号 + 56.7来替代js/css附加的版本号
        // 既隐藏了WordPress版本号，也不会影响缓存
        // 建议把下面的 56.7 替换成其他数字，以免被别人猜出
        $src = str_replace($wp_version, $wp_version + rand(1,100), $src);
    }
    return $src;
}
if (of_get_option( 'summer_wpversion') == 1){
	add_filter('the_generator', 'Sl_Remove_Wp_version');
	add_filter('script_loader_src', 'Sl_Remove_Wp_Version_strings');
  add_filter('style_loader_src', 'Sl_Remove_Wp_Version_strings');
	
}

//禁止远程提交
if (of_get_option( 'summer_xmlrpc') == 1){
add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link'); 
}

//禁止所有文章的修订版本
if (of_get_option( 'summer_revisions') == 1){
add_filter('wp_revisions_to_keep', 'Specs_Wp_Revisions_To_keep', 10, 2);
function Specs_Wp_Revisions_To_keep( $num, $post ) 
{
    return 0;
}
}



//压缩html代码 
//https://zhangge.net/4731.html


if (of_get_option( 'summer_htmlcompress') == 1){
function wp_compress_html(){
    function wp_compress_html_main ($buffer){
        $initial=strlen($buffer);
        $buffer=explode("<!--wp-compress-html-->", $buffer);
        $count=count ($buffer);
        for ($i = 0; $i <= $count; $i++){
            if (stristr($buffer[$i], '<!--wp-compress-html no compression-->')) {
                $buffer[$i]=(str_replace("<!--wp-compress-html no compression-->", " ", $buffer[$i]));
            } else {
                $buffer[$i]=(str_replace("\t", " ", $buffer[$i]));
                $buffer[$i]=(str_replace("\n\n", "\n", $buffer[$i]));
                $buffer[$i]=(str_replace("\n", "", $buffer[$i]));
                $buffer[$i]=(str_replace("\r", "", $buffer[$i]));
                while (stristr($buffer[$i], '  ')) {
                    $buffer[$i]=(str_replace("  ", " ", $buffer[$i]));
                }
            }
            $buffer_out.=$buffer[$i];
        }
        $final=strlen($buffer_out);   
        $savings=($initial-$final)/$initial*100;   
        $savings=round($savings, 2);   
        $buffer_out.="\n<!--压缩前的大小: $initial bytes; 压缩后的大小: $final bytes; 节约：$savings% -->";   
    return $buffer_out;
}
ob_start("wp_compress_html_main");
}
add_action('get_header', 'wp_compress_html');
//文章内容中的代码高亮竞争压缩
function unCompress($content) {
    if(preg_match_all('/(crayon-|<\/pre>)/i', $content, $matches)) {
        $content = '<!--wp-compress-html--><!--wp-compress-html no compression-->'.$content;
        $content.= '<!--wp-compress-html no compression--><!--wp-compress-html-->';
    }
    return $content;
}
add_filter( "the_content", "unCompress");

}


/*出站链接加上nofollow,站内的url跳转链接也加上nofollow*/

if (of_get_option('summer_nofollow') == 1){
add_filter( 'the_content', 'cn_nf_url_parse_one');
}

if (!function_exists('cn_nf_url_parse_one')) :
function cn_nf_url_parse_one( $content ) {
	$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
	if(preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
		if( !empty($matches) ) {
			$srcUrl = get_option('siteurl');

			$srcUrlgo = get_option('siteurl').'/url/';
			for ($i=0; $i < count($matches); $i++)
			{
				$tag = $matches[$i][0];
				$tag2 = $matches[$i][0];
				$url = $matches[$i][0];
				$noFollow = '';
				$pattern = '/target\s*=\s*"\s*_blank\s*"/';
				preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
				if( count($match) < 1 )
				$noFollow .= ' target="_blank" ';
				$pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
				preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
				if( count($match) < 1 )
				$noFollow .= ' rel="nofollow" ';

				//对大小写不敏感
				$pos = stripos($url,$srcUrl);
				$posgo = stripos($url,$srcUrlgo);
				if ( $pos === false || $posgo==true) {
					$tag = rtrim ($tag,'>');
					$tag .= $noFollow.'>';
					$content = str_replace($tag2,$tag,$content);
				}


			}
		}
	}
	$content = str_replace(']]>', ']]>', $content);
	return $content;
}
endif;



//保护后台登录，除了这个地址其他的都不能登陆: http://www.wordpressleaf.com/wp-login.php?love=wordpress
if (of_get_option('summer_admin')){
add_action('login_enqueue_scripts','login_protection');  
}
function login_protection(){  
	  
	  $leaf_admin_addr = trim(of_get_option('summer_admin_addr')) ? trim(of_get_option('summer_admin_addr')) : 'wordpressleaf';
	  
    if($_GET['love'] != $leaf_admin_addr)header('Location: '.home_url('/'));  
}



////自建cdn
if (of_get_option('summer_cdn')){
if ( !is_admin() ) {
	add_action('wp_loaded','leaf_ob_start');
	
	function leaf_ob_start() {
		ob_start('leaf_cdn_replace');
	}
	
function leaf_cdn_replace($html){
	$local_host = home_url(); //博客域名
	$leaf_host = of_get_option('summer_cdn_addr'); //七牛域名
	$cdn_exts   = 'js|css|png|jpg|jpeg|gif|ico'; //扩展名（使用|分隔）
	//$cdn_exts   = 'css|png|jpg|jpeg|gif|ico'; //扩展名（使用|分隔）
	$cdn_dirs   = 'wp-content|wp-includes'; //目录（使用|分隔）
	
	$cdn_dirs   = str_replace('-', '\-', $cdn_dirs);

	if ($cdn_dirs) {
		$regex	=  '/' . str_replace('/', '\/', $local_host) . '\/((' . $cdn_dirs . ')\/[^\s\?\\\'\"\;\>\<]{1,}.(' . $cdn_exts . '))([\"\\\'\s\?]{1})/';
		$html =  preg_replace($regex, $leaf_host . '/$1$4', $html);
	} else {
		$regex	= '/' . str_replace('/', '\/', $local_host) . '\/([^\s\?\\\'\"\;\>\<]{1,}.(' . $cdn_exts . '))([\"\\\'\s\?]{1})/';
		$html =  preg_replace($regex, $leaf_host . '/$1$3', $html);
	}
	return $html;
}
}

}


/********************************************************
www.wordpressleaf.com评论头像缓存 
请在网站跟目录下建立名字为avatar的文件夹，
它的访问地址类似于：www.wordressleaf.com/avatar/
如果因为网络问题读取不到你的头像，它会随机从100张头像中选取一张。
**************************************************************/



if (!function_exists('leaf_avatar')) :

function leaf_avatar($avatar) {
	$avatar = strtr($avatar, array('0.gravatar.com' => 'secure.gravatar.com','1.gravatar.com' => 'secure.gravatar.com','2.gravatar.com' => 'secure.gravatar.com','www.gravatar.com' => 'secure.gravatar.com'));
	$tmp = strpos($avatar, 'http');
	$g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
	$tmp = strpos($g, 'avatar/') + 7;
	$f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
	$w = get_bloginfo('wpurl');
  
  if (empty($f))$f='wwwwordpressleafcomdefault';
  
	//$e = ABSPATH .'avatar/'. $f .'.png';
	$upload_dir = wp_upload_dir();

	$e_dir =$upload_dir['basedir'].'/avatar/';
	
	$e = $e_dir. $f .'.png';
	
	if(!is_dir($e_dir)){
		mkdir($e_dir);
		}

	$t = 1209600;
	if ( !is_file($e) || (time() - filemtime($e)) > $t )
	{
		$uri = 'http://secure.gravatar.com/avatar/' . $f . '?d=404';
		$headers = @get_headers($uri);
		if (preg_match("|200|", $headers[0])) {
			copy(htmlspecialchars_decode($g), $e);
		}
		else
		{
			copy(get_bloginfo('template_directory').'/images/tx/'.strval(rand(1,100)).'.png', $e);
		}
	}

	else
	{
		if( empty($f))
		{
			$avatar = strtr($avatar, array($g => get_bloginfo('template_directory').'/images/tx/'.strval(rand(1,100)).'.png'));
		}
		else
		{
			$avatar = strtr($avatar, array($g => $w.'/avatar/'.$f.'.png'));
		}
	}
	if ( filesize($e) < 500 )
	copy(get_bloginfo('template_directory').'/images/tx/'.strval(rand(1,100)).'.png', $e);
	return $avatar;
}
endif;



if (of_get_option("summer_avatar")==1){ 
	add_filter('get_avatar','leaf_avatar');
}