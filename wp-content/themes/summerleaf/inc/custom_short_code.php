<?php
/***********************************
* 文章列表
* 支持多个参数
* [post_list_one title="" title_ico="" title_url="" tags="" cats="" sticky="" orderby="" number="" h=""][/post_list_one]
* https://www.wpzhiku.com/all-wp_query-arguments-comments/
************************************/	

function  post_list_one_function($atts, $content = null) {
	
	
  //global $wp_query, $paged;  
  //var_dump($wp_query);
	extract(shortcode_atts(array(
	'title'  => '',
	'title_ico'  => '',
	'title_url'  => '',
	'tags'  => '',
	'cats'  => '',
	'orderby'  => '',	
	'number' => 3,
	'sticky' => '',
	'h' => '',
	),$atts));

	$content = trim($content) ? trim($content) : '';



	//判断要输出置顶文章

	  $postid = ($sticky == '1') ? get_option('sticky_posts') : array();
		$title_ico	         = ( ! empty( $title_ico ) ) ? $title_ico   : 'fa-newspaper-o';
		$title_url	         = ( ! empty( $title_url ) ) ? $title_url   : '#';
		$h                  = ( ! empty( $h ) ) ? $h   : 'h3';
		//$number        = ( ! empty( $number ) ) ? absint( $number ) : 3;






		//如果是静态首页需要使用page来获取当前页
		//https://developer.wordpress.org/reference/functions/get_query_var/
		$current_page = ( is_front_page() ) ? max(1, get_query_var('page'))  : max(1, get_query_var('paged'));
		
		//array_filter将删除掉数组空值
		$custom_query_args = array_filter(array(
			'post_type'           => 'post',
			'post__in'=> array_filter($postid),
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'tag__in' => array_filter(explode(',',$tags)),
			'category__in'        => array_filter(explode(',',$cats)),
			'posts_per_page'      => $number,
			'order'               => 'DESC',
			'orderby'             => $orderby,
			'paged'               => $current_page 
		));
		//创建过滤器apply_filters 可以在其它地方过滤参数
    $custom_query = new WP_Query(  $custom_query_args );
		$total_pages = $custom_query->max_num_pages;  //总共多少页



	  $return_string='';

		if ( $custom_query->have_posts() ) :

			$return_string.='<div class="line-one sort"> 
            <div class="cat-box wow " data-wow-delay="0.3s">';
            
			if ( $title ) $return_string.='<'.$h.' class="cat-title"><a href="'.$title_url.'"><i class="fa '.$title_ico.' left"></i>'.$title.'<i class="fa fa-angle-right right"></i></a></'.$h.'> 
                          <div class="clear"></div> ';
                          
       $return_string.='<div class="cat-site">';                               
					while ( $custom_query->have_posts() ) : $custom_query->the_post();
					global $post;
					$count++;
					
					$post_link = esc_url(get_permalink($post->ID));
					$post_title = $post->post_title;
					$excerpt_symbols_count = 100;
					
	        if( strpos( $post->post_content, '<!--more-->' ) ){
	            $excerpt=get_the_content();
	        } else {
	            if (empty($post->post_excerpt)) {
	                $txt = do_shortcode($post->post_content);
	                $txt = strip_tags($txt);

	                $excerpt= (mb_strlen($txt) > $excerpt_symbols_count ) ? (mb_substr($txt, 0, $excerpt_symbols_count) . " ...") : $txt;
	            } else {
	                $excerpt= (mb_strlen($post->post_excerpt) > $excerpt_symbols_count) ? (mb_substr($post->post_excerpt, 0, $excerpt_symbols_count) . " ...") : $post->post_excerpt;
	            }
	        }					

					 
     $return_string.='<article id="post-'.$post->ID.'" class="'.implode(" ",get_post_class()).'" data-wow-delay="0.3s"> 
      <figure class="thumbnail"> 
       <a href="'.$post_link.'"><img data-original="'.get_post_featured_image($post->ID,'450*240').'" src="http://placehold.it/450x240&text=SummerLeaf" alt="'.$post_title.'" /></a> 
       <span class="cat">'.get_the_category_list(' ', '', $post->ID).'</span> 
      </figure> 
      <header class="entry-header"> 
       <h2 class="entry-title"><a href="'.$post_link.'" rel="bookmark">'.$post_title.'</a></h2> 
      </header> 
      <!-- .entry-header --> 
      <div class="entry-content"> 
       <div class="archive-content">'.$excerpt.'</div> 
       <span class="entry-meta"> <span class="date"><i class="fa fa-calendar-check-o"></i> '.get_the_date('Y/m/d', $post->ID).' </span> <span class="comment"> <a href="'.$post_link.'#comments" rel="external nofollow"><i class="fa fa-comment-o"></i> '.esc_html($post->comment_count).'</a></span> </span> 
       <div class="clear"></div> 
      </div> 
      <!-- .entry-content --> 
      <span class="entry-more"><a href="'.$post_link.'" rel="bookmark">阅读全文</a></span> 
     </article>';

     

					endwhile;
				$return_string.='<nav class="navigation pagination" role="navigation">
		      <h2 class="screen-reader-text">文章导航</h2>
		       <div class="nav-links">'.paginate_links( array(
							'prev_text'          => __( '<i class="fa fa-angle-left"></i>', 'summerleaf' ),
							'next_text'          => __( '<i class="fa fa-angle-right"></i>', 'summerleaf' ),
							'screen_reader_text'  => null,
							'total' => $total_pages,
							'current' => $current_page,
							) ).'</div></nav>';	
							
      $return_string.='</div><div class="clear"></div></div>';		
		     
      $return_string.='</div>';


      


		endif;


	//重置查询
	  wp_reset_postdata();

	  $return_string.='';

	return $return_string;
}


/***********************************
* 读者墙
* 支持多个参数
* [readers_wall outer="" timer="" limit="" ][/readers_wall]
* https://www.wpzhiku.com/all-wp_query-arguments-comments/
************************************/	

function  readers_wall_function($atts, $content = null) {
	
	
  //global $wp_query, $paged;  

	extract(shortcode_atts(array(
	'number'  => 10,
	),$atts));

	$content = trim($content) ? trim($content) : '';



	//判断要输出置顶文章


  $outer	         = ( ! empty( $outer ) ) ? $outer   : '1';
  $timer	         = ( ! empty( $timer ) ) ? $timer   : '100';
  $limit                  = ( ! empty( $limit ) ) ? $limit   : '60';

	global $wpdb;
	$return_string='<div class="summerreaders">';
	$counts = $wpdb->get_results("select count(comment_author) as cnt, comment_author, comment_author_url, comment_author_email from (select * from $wpdb->comments left outer join $wpdb->posts on ($wpdb->posts.id=$wpdb->comments.comment_post_id) where comment_date > date_sub( now(), interval $timer month ) and user_id='0' and comment_author != '".$outer."' and post_password='' and comment_approved='1' and comment_type='') as tempcmt group by comment_author, comment_author_url, comment_author_email order by cnt desc limit $limit");
	foreach ($counts as $count) {
		$c_url = $count->comment_author_url;
		if (!$c_url) $c_url = 'javascript:;';
		$find = array("0.gravatar.com","1.gravatar.com");
  	$return_string .= '<a id="duzhe" target="_blank" rel="external nofollow" href="'. $c_url . '" title="['.$count->comment_author.']近期评论'. $count->cnt . '次">'.str_replace($find, 'secure.gravatar.com',get_avatar( $count->comment_author_email, $size = '70' )).'<span>'.$count->comment_author.'</span></a>';
	}


  $return_string.='</div>';

	return $return_string;
}


/***********************************
* 站点地图
* 支持多个参数
* [sitemap number="" orderby=""][/sitemap]
* https://www.wpzhiku.com/all-wp_query-arguments-comments/
************************************/	

function  sitemap_function($atts, $content = null) {
	
	
  //global $wp_query, $paged;  

	extract(shortcode_atts(array(
	'number'  => '25',
	'orderby'  => '',	
	),$atts));

	$content = trim($content) ? trim($content) : '';


   //echo $number;
		//如果是静态首页需要使用page来获取当前页
		//https://developer.wordpress.org/reference/functions/get_query_var/
		$current_page = ( is_front_page() ) ? max(1, get_query_var('page'))  : max(1, get_query_var('paged'));
		
		//array_filter将删除掉数组空值
		$custom_query_args = array_filter(array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => absint($number),
			'order'               => 'DESC',
			'orderby'             => $orderby,
			'paged'               => $current_page 
		));
		//创建过滤器apply_filters 可以在其它地方过滤参数
    $custom_query = new WP_Query(  $custom_query_args );
		$total_pages = $custom_query->max_num_pages;  //总共多少页



	  $return_string='<h2>最新文章</h2>';

		if ( $custom_query->have_posts() ) :


                          
       $return_string.='<ul>';                               
					while ( $custom_query->have_posts() ) : $custom_query->the_post();
					global $post;
					$count++;
					
					$post_link = esc_url(get_permalink($post->ID));
					$post_title = $post->post_title;
					$excerpt_symbols_count = 100;
					
		

					 
          $return_string.='<li><a href="'.$post_link.'" title="'.$post_title.'" target="_blank">'.$post_title.'</a></li>';

     

					endwhile;
					
				$return_string.='</ul>';
				
			

		endif;

	//重置查询
	  
	  wp_reset_postdata();


					if ( $total_pages == $current_page){



						$return_string.='<h2>分类目录</h2>';
						
						$return_string.='<ul>'.wp_list_categories('title_li=&echo=0').'</ul>';
							
						$return_string.='<h2>单页面</h2>';	

						$return_string.=wp_page_menu('echo=0');



					}//判断是否是最后一页，是最后一页输出分类和页面
					
					


					$return_string.='<p>访问网站首页: <strong><a href="'.get_bloginfo('url').'/">'.get_bloginfo('name').'</a></strong> <br /></p>';
          global $wpdb; 
          $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')",OBJECT);
          $last = date('Y-m-d G:i:s', strtotime($last[0]->MAX_m));


					$return_string.='<p>查看<strong><a href="/sitemap.xml" target="_blank">SiteMap.xml</a></strong> 网站最后更新时间:' .$last .'<br /><br /></p>';  
	

				$return_string.='<nav class="navigation pagination" role="navigation">
		      <h2 class="screen-reader-text">文章导航</h2>
		       <div class="nav-links">'.paginate_links( array(
							'prev_text'          => __( '<i class="fa fa-angle-left"></i>', 'summerleaf' ),
							'next_text'          => __( '<i class="fa fa-angle-right"></i>', 'summerleaf' ),
							'screen_reader_text'  => null,
							'total' => $total_pages,
							'current' => $current_page,
							) ).'</div></nav>';		


  
	  

	  $return_string.='';

	return $return_string;
}



/************************************************************************
//增加下载和演示短代码。包括网盘下载、github下载、本地下载、演示。你可以方便的在后台使用。
//短代码支持参数传递，href：地址，leaf：图标，内容。图标请用字体图标中的名字。
*************************************************************************/


function  demo_function($atts, $content = null) {
  extract(shortcode_atts(array(
	   'href' => 'http://www.wordpressleaf.com',
	   'leaf' => 'leaf',
	   ),$atts));
	
	
	$content = trim($content) ? trim($content) : '演示';
	$href = trim($href) ? trim($href) :  'http://www.wordpressleaf.com';
  $leaf = trim($leaf) ? trim($leaf) :  'leaf';
	
	$return_string='<a rel="nofollow" target="_blank" class="leafdl" href="'.$href.'"><i class="fa fa-'.$leaf.'"></i>  '.$content.'</a>';
	
	return $return_string;
	}


function  download_local_function($atts, $content = null) {
	extract(shortcode_atts(array(
	   'href' => 'http://www.wordpressleaf.com',
	   'leaf' => 'cloud-download',
	   ),$atts));
	
	$content = trim($content) ? trim($content) : '本地';
	$href = trim($href) ? trim($href) :  'http://www.wordpressleaf.com';
  $leaf = trim($leaf) ? trim($leaf) :  'cloud-download';

	
	$return_string='<a rel="nofollow" target="_blank" class="leafdl" href="'.$href.'"><i class="fa fa-'.$leaf.'"></i>  '.$content.'</a>';
	
	return $return_string;
	}


function  download_baidu_function($atts, $content = null) {
	
	extract(shortcode_atts(array(
	   'href' => 'http://www.wordpressleaf.com',
	   'leaf' => 'paw',
	   ),$atts));
	
	$content = trim($content) ? trim($content) : '网盘';
	$href = trim($href) ? trim($href) :  'http://www.wordpressleaf.com';
  $leaf = trim($leaf) ? trim($leaf) :  'paw';	

	
	$return_string='<a rel="nofollow" target="_blank" class="leafdl" href="'.$href.'"><i class="fa fa-'.$leaf.'"></i>  '.$content.'</a>';
	
	return $return_string;
	}
	
function  download_github_function($atts, $content = null) {
	
	extract(shortcode_atts(array(
	   'href' => 'http://www.wordpressleaf.com',
	   'leaf' => 'github',
	   ),$atts));
	
	$content = trim($content) ? trim($content) : 'github';
	$href = trim($href) ? trim($href) :  'http://www.wordpressleaf.com';
  $leaf = trim($leaf) ? trim($leaf) :  'github';	
	
	$return_string='<a rel="nofollow" target="_blank" class="leafdl" href="'.$href.'"><i class="fa fa-'.$leaf.'"></i>  '.$content.'</a>';
	
	return $return_string;
	}	


/***********************************
* 注册短代码
************************************/	
function	register_shortcodes() {

	   add_shortcode ('post_list_one' ,'post_list_one_function');
	   
	   add_shortcode ('readers_wall' ,'readers_wall_function');
	   
	   add_shortcode ('sitemap' ,'sitemap_function');	 
	   
	   add_shortcode ('download_baidu' ,'download_baidu_function');
	   add_shortcode ('download_github' ,'download_github_function');
	   add_shortcode ('download_local' ,'download_local_function');
	   add_shortcode ('leaf_demo' ,'demo_function');  
	   
	 }


add_action('init','register_shortcodes');		   