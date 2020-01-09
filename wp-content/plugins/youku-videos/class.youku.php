<?php

class youku{
	public function __construct(){

		$this->config = get_option('ykv_config');
		$this->videos = get_option('ykv_videos') ? get_option('ykv_videos') : array();
		$this->category = get_option('ykv_category') ? get_option('ykv_category') : array();
		$this->notice = array();
		$this->base_dir = WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__));
		
		/**
		** 事件绑定
		**/
		
		add_action('init', array($this,'init'));
		add_action('admin_menu', array($this, 'admin_menu'));
		add_filter('plugin_action_links', array($this, 'plugin_action_link'), 10, 4);
	}

	/**
	 * 初始化
	 */
	 
	public function init(){
		if(is_user_logged_in() && is_admin()){
			$this->action_quest();
			if ( isset($_GET['page']) ) {
			
				if(  $_GET['page'] == 'youku-videos' || $_GET['page'] == 'youku-category' || $_GET['page'] == 'youku-newvideo' || $_GET['page'] == 'youku-option'){
					wp_enqueue_style('youku-admin-css', $this->base_dir . '/scripts/youku-admin.css', false, VERSION, false);
				}
			
				wp_enqueue_script( 'youku-videos-ajax', $this->base_dir . '/scripts/youku-videos-ajax.js', array(), VERSION, false);
				
				$category = $this->category;
				if(!empty($category)){
					foreach($category as $key => $val){
						if(!empty($val)){
							$category[$key]["ID"] = $key;
						}else{
							unset($category[$key]);
						}
					}
				}
				
				wp_localize_script( 'youku-videos-ajax', 'ykc', 
					array(
						"ajax_url" => $this->get_menupage_url("youku-videos"),
						"category" => $category
				));					
			}
		}
		
		if(empty($this->config)){
			$this->initialize_config();
			$this->update_videos(array());
		}
		
		$this->rewrite();
	}
	
	/**
	 * 显示后台菜单
	 */
	 
	public function admin_menu(){
		add_menu_page('优酷视频收藏设置', '优酷视频收藏', 'administrator', 'youku-videos', array($this,'youku_page'), $this->base_dir.'/images/youku.png');
		add_submenu_page('youku-videos', '分类管理', '分类管理', 'administrator', 'youku-category', array($this,'youku_category'));
		add_submenu_page('youku-videos', '添加视频', '添加视频', 'administrator', 'youku-newvideo', array($this,'youku_newvideo'));
		add_submenu_page('youku-videos', '插件设置', '插件设置', 'administrator', 'youku-option', array($this,'youku_option'));
	}
	
	public function youku_page(){
		@include 'class.wplisttable.php';
		@include 'youku_manage.php';
	}
	
	public function youku_category(){
		@include 'youku_category.php';
	}
	
	public function youku_newvideo(){
		@include 'youku_newvideo.php';
	}
	
	public function youku_option(){
		@include 'youku_option.php';
	}	
	
	public function plugin_action_link($actions, $plugin_file, $plugin_data){
		if(strpos($plugin_file,'youku-videos')!==false && is_plugin_active($plugin_file)){
			unset($actions['edit']);$myactions = array('newvideo'=>'<a href="'.$this->get_menupage_url('youku-newvideo').'">添加视频</a>','option'=>'<a href="'.$this->get_menupage_url('youku-option').'">设置</a>');$actions = array_merge($myactions,$actions);
		}
		return $actions;
	}
	
	public function message(){
		$notice = $this->notice;
		if(!empty($notice)){
			switch ($notice["type"])
			{
				case "msg":
					echo '<div class="updated"><p>'.$notice["msg"].'</p></div>';
					break;  
				case "err":
					echo '<div id="message" class="error"><p>'.$notice["msg"].'</p></div>';
					break;
			}
		}
	}
	
	public function action_quest(){

		if( isset($_COOKIE['ykv_msg_'.COOKIEHASH]) ){
			$this->notice = array("type" => "msg","msg" => $_COOKIE['ykv_msg_'.COOKIEHASH]);setcookie('ykv_msg_'.COOKIEHASH, '', time()- 60*60*24, COOKIEPATH,COOKIE_DOMAIN);	
		}else if( isset($_COOKIE['ykv_err_'.COOKIEHASH]) ){
			$this->notice = array("type" => "err","msg" => $_COOKIE['ykv_err_'.COOKIEHASH]);setcookie('ykv_err_'.COOKIEHASH, '', time()- 60*60*24, COOKIEPATH,COOKIE_DOMAIN);
		}else{
			$this->notice = array();
		}
		
		// 页面跳转
		
		if( isset($_POST["ykc-return-to-cat"]) ){
			$cat_id = intval( $_POST["cat-actions"]);
			if($cat_id>-1){
				wp_safe_redirect($this->get_menupage_url("youku-videos") ."&category=". $cat_id );exit();
			}else{
				wp_safe_redirect($this->get_menupage_url("youku-videos"));exit();
			}
		}
	
		// 新视频
		if( $_POST["action"]=="ykv-new-video" ){
			$url = $_POST['new-url'];
			$title = trim(strip_tags($_POST['new-title']));
			preg_match("#https?://v\.youku\.com/v_show/id_(?<video_id>[a-z0-9_=\-]+)#i", $url, $match);
			
			if($url=="" || empty($match)){
				setcookie('ykv_err_'.COOKIEHASH, '请输入正确的优酷视频地址！', time()+300, COOKIEPATH, COOKIE_DOMAIN);wp_safe_redirect($this->get_menupage_url("youku-newvideo"));exit();
			}
			
			$detail = $this->get_video_detail($match['video_id']);
			
			if(!$detail){
				setcookie('ykv_err_'.COOKIEHASH, '无法从优酷获取相关视频信息！', time()+300, COOKIEPATH, COOKIE_DOMAIN);wp_safe_redirect($this->get_menupage_url("youku-newvideo"));exit();
			}

			$videos = $this->videos;
			$cat_id = intval($_POST["new-category"]) > 0 ? intval($_POST["new-category"]) : 1;
			
			$new_video = array("ID" => count($videos),"title" => ($title? $title : $detail["title"]),"created" => (time()  + (60*60*get_settings("gmt_offset"))),"thumbnail" => $detail["thumbnail"],"youkuid" => $detail["youkuid"],"strtime" => $detail["seconds"],"category" => $cat_id,"streamfileids" =>count($detail["streamtypes"]));
			
			$videos[] = $new_video;
			$this->update_videos($videos);
			
			setcookie('ykv_msg_'.COOKIEHASH, '已经成功添加  《'.$new_video["title"].'》', time()+300, COOKIEPATH, COOKIE_DOMAIN);
			wp_safe_redirect($this->get_menupage_url("youku-newvideo"));
			exit();			
		}
		
		// 编辑视频
		if( $_POST["action"]=="ykv-edit-video" ){
			$video_id = intval($_POST['video_id']);
			$title = trim(strip_tags($_POST['title']));
			$cat_id = intval($_POST['cat_id']);
			$videos = $this->videos;
			$the_video = $videos[$video_id];
			$the_video["title"] = $title;
			$the_video["category"] = $cat_id;
			$videos[$video_id] = $the_video;
			$this->update_videos($videos);
			die();		
		}		
		
		// 新分类
		if( $_POST["action"]=="ykv-new-category" ){
			$cat_name = trim(strip_tags($_POST['catname']));
			$cat_slug = trim(strip_tags($_POST['catslug']));
			
			if($cat_name==""){
				setcookie('ykv_err_'.COOKIEHASH, '分类 &#34;名称&#34; 不能为空！', time()+60, COOKIEPATH, COOKIE_DOMAIN);wp_safe_redirect($this->get_menupage_url("youku-category"));exit();				
			}

			if($cat_slug==""){
				setcookie('ykv_err_'.COOKIEHASH, '分类 &#34;别名&#34; 不能为空！', time()+60, COOKIEPATH, COOKIE_DOMAIN);wp_safe_redirect($this->get_menupage_url("youku-category"));exit();				
			}
			
			$category = $this->category;
			
			if(!empty($category)){
				foreach($category as $key => $val){
					if(!empty($val)){
						if($cat_name==$val["name"]){
							setcookie('ykv_err_'.COOKIEHASH, '分类名称 &#34;'.$cat_name.'&#34; 已被使用！', time()+60, COOKIEPATH, COOKIE_DOMAIN);wp_safe_redirect($this->get_menupage_url("youku-category"));exit();
						}
						
						if($cat_slug==$val["slug"]){
							setcookie('ykv_err_'.COOKIEHASH, '分类别名 &#34;'.$cat_slug.'&#34; 已被使用！', time()+60, COOKIEPATH, COOKIE_DOMAIN);wp_safe_redirect($this->get_menupage_url("youku-category"));exit();
						}
					}
				}
				$category[] = array(
					"name" => $cat_name,
					"slug" => $cat_slug
				);				
			}else{
				$category[1] = array(
					"name" => $cat_name,
					"slug" => $cat_slug
				);			
			}
			$this->update_category($category);
			
			setcookie('ykv_msg_'.COOKIEHASH, '已经成功添加分类 &#34;'.$cat_name.'&#34;', time()+300, COOKIEPATH, COOKIE_DOMAIN);
			wp_safe_redirect($this->get_menupage_url("youku-category"));
			exit();			
		}
		
		// 删除分类
		if( $_REQUEST["action"]=="ykv-category-delete"){
			$category = $this->category;
			$cat_id = intval($_REQUEST["cat_id"]);
			$cat_name = $category[$cat_id]["name"];
			$category[$cat_id] = array();
			$this->update_category($category);
			setcookie('ykv_msg_'.COOKIEHASH, '已经成功删除分类 &#34;'.$cat_name.'&#34;', time()+300, COOKIEPATH, COOKIE_DOMAIN);
			wp_safe_redirect($this->get_menupage_url("youku-category"));
			exit();				
		}
		
		// 保存设置
		if( $_POST["action"]=="ykv-update-config" ){
			if( isset($_POST["empty-config"]) ){
				$this->initialize_config();
				
				setcookie('ykv_msg_'.COOKIEHASH, '设置已清空，恢复到默认设置！', time()+300, COOKIEPATH, COOKIE_DOMAIN);
			}else{
			
				$this->update_config(array("pagename" => trim($_POST["pagename"]),"number" => $_POST["number"],"row"=> $_POST["row"],"time" => $_POST["time"],"swf_url" => $_POST["swf_url"]));
				
				setcookie('ykv_msg_'.COOKIEHASH, '已保存设置！', time()+300, COOKIEPATH, COOKIE_DOMAIN);
			}
			wp_safe_redirect($this->get_menupage_url("youku-option"));
			exit();				
		}
		
		// 删除视频
		if( $_REQUEST["action"]=="ykv-delete"){
			$videos = $this->videos;
			$number = 1;
			if( is_array( $_REQUEST['videoid']) ){
				foreach($_REQUEST['videoid'] as $val){
					$videos[ intval($val) ] = array();
				}
				$number = count($_REQUEST['videoid']);
			}else{
				$videos[ intval($_REQUEST['videoid']) ] = array();
			}
			$this->update_videos($videos);
			
			setcookie('ykv_msg_'.COOKIEHASH, '成功删除'.$number.'个视频！', time()+300, COOKIEPATH, COOKIE_DOMAIN);
			wp_safe_redirect($this->get_menupage_url("youku-videos"));
			exit();				
		}
	}
	
	public function display(){
		$config = $this->config;		
		$page_link = $this->get_pagelink();
		$cat_slug = get_query_var('ykccat');
		$cat_id = $cat_slug ? ($this->get_catid_by_slug($cat_slug)) : null;
		$per_page = $config["number"];
		$videos = $this->the_video($cat_id);
		$count  = count($videos);
		$max_page = ceil($count/$per_page);
		$paged = get_query_var('paged') ? get_query_var('paged') : 1;
		$result = array_slice( $videos,( ( $paged-1 )* $per_page ), $per_page );		
		$index = 0;
		$row = $config["row"];	
		$all_class = !$cat_id ? "current" : "";		
		echo "<!-- Start Youku Videos V".VERSION." --><div id='ykv_youku-video'><div class='ykv_youku-nav'><div class='container clearfix'><ul><li class='{$all_class}'><a href='{$page_link}'>全部视频</a></li>";		
		$category = $this->category;
		if(!empty($category)){
			foreach($category as $key => $val){
				if(!empty($val)){
					$class = ($cat_id && $cat_id==$key) ? "current" : "";
				?>
					<li class="<?=$class;?>"><a href="<?php echo $this->get_cat_link($val["slug"]);?>"><?=$val["name"];?></a>
				<?php }
			}
		}		
		echo "</ul></div></div><div class='ykv_video-group'><div class='container clearfix'>";
		foreach($result as $val){
			$index++;
			if($val["streamfileids"]==3)
			{$definition ="<i class='hd2'>超清</i>";}
			elseif($val["streamfileids"]==2)
			{$definition ="<i class='mp4'>高清</i>";}
			else
			{$definition="";}
			$class = $index%$row == 0 ? "ykv_video ykv_video-last" : "ykv_video";
			?><a href="javascript:void(0)" class="<?=$class;?>" title="<?php echo $val["title"];?>" youkuid="<?php echo $val["youkuid"];?>"><img class="ykv_video-image" src="<?php echo $val["thumbnail"];?>" alt="<?php echo $val["title"];?>" /><span class="ykv_video-text"><?php echo $val["title"];?></span><?php if($config["time"]) echo "<span class='ykv_video-date'>{$val["strtime"]}</span>";?><?php echo $definition ?></a><?php
			if( $index%$row==0 && $index < $per_page) echo "</div></div><div class='ykv_video-group'><div class='container clearfix'>";
		}
		echo "</div></div></div><div id='ykv_youku-pagenavi'><div class='container clearfix'>";
		$this->pagenavi($max_page, $paged, $cat_slug);
		echo "</div></div><!-- End Youku Videos V".VERSION." -->";
	}

		// display 4 videos
	public function display_four(){
		$videos = $this->the_video();
		$page_link = $this->get_pagelink();
		$result = array_slice( $videos, 0, 4 );	
		$index = 0;
		echo '<div id="videos"><div class="container clearfix">';
		foreach($result as $val){
			$index++;
			if($val["streamfileids"]==3)
			{$definition ="<i class='hd2'>超清</i>";}
			elseif($val["streamfileids"]==2)
			{$definition ="<i class='mp4'>高清</i>";}
			else
			{$definition="";}			
			$class = $index%4 == 0 ? "video video-last" : "video";
			
			?>
			<a href="<?php echo $page_link. '#' .$val["youkuid"];?>" class="<?=$class;?>" title="<?php echo $val["title"];?>"><img class="video-image" src="<?php echo $val["thumbnail"];?>" alt="<?php echo $val["title"];?>" /><span class="video-text"><?php echo $val["title"];?></span><?php if($config["time"]) echo "<span class='video-date'>{$val["strtime"]}</span>";?><?php echo $definition ?></a>
		<?php }
		echo '</div></div><!-- #videos -->';
	}
	
	// pagenavi
	private function pagenavi($max_page, $paged, $cat_slug=null, $plus = 3){
		if ( $max_page == 1 ) return false;
		if ( $paged > 1 ) $this->page_link( $paged - 1, '«', $cat_slug);
		if ( $paged > $plus + 2 ) echo '... ';
		for( $i = $paged - $plus; $i <= $paged + $plus; $i++ ) { // 中间页
			if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='ykv_page-youku current'>{$i}</span> " : $this->page_link( $i, "", $cat_slug );
		}
		if ( $paged < $max_page - $plus - 1 ) echo '<span class="ykv_page-youku">...</span>';
		if ( $paged < $max_page ) $this->page_link( $paged + 1,'»', $cat_slug);			
	}
	
	private function page_link($i, $title = "", $cat_slug, $admin=null){
		$page_link = $this->get_pagelink();
		if ( $title == '' ){$title = "第 {$i} 页";$linktext = $i;}else{$linktext = $title;}
		if(!$admin){
			if( $i>1 ){
				if( $cat_slug ){
					$link = get_query_var("page_id") ? ($page_link."&ykccat=".$cat_slug."&paged=".$i): ($page_link.'/'.$cat_slug.'/page/'.$i);
				}else{
					$link = get_query_var("page_id") ? ($page_link."&paged=".$i): ($page_link.'/page/'.$i);
				}
			}else{
				if( $cat_slug ){
					$link = get_query_var("page_id") ? ($page_link."&ykccat=".$cat_slug): ($page_link.'/'.$cat_slug);
				}else{
					$link = $page_link;
				}
			}
			echo '<a class="ykv_page-youku" href="'.$link.'" title="'.$title.'">'.$linktext.'</a>';
		}else{
			$link = $page_link."#".$title;
			if( $i>1 ) $link = get_query_var("page_id") ? ($page_link."&paged=".$i."#".$title): ($page_link.'/page/'.$i."#".$title);
			return $link;
		}
	}
	
	private function initialize_config(){
		$config = array(
			"pagename" => "",
			"number" => 12,
			"row" => 4,
			"time" => 1,
			"swf_url" => ""
		);
		$this->update_config($config);
	}
	
	private function get_video_detail($youku_id){
		$link = "http://v.youku.com/player/getPlayList/VideoIDS/{$youku_id}/timezone/+08/version/5/source/out?password=&ran=2513&n=3";
		$ch=@curl_init($link);
		@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$cexecute=@curl_exec($ch);
		@curl_close($ch);
		if ($cexecute) {
			$result = json_decode($cexecute,true);
			$json = $result['data'][0];
			$hour = floor( $json["seconds"]/3600 );
			$hour = $hour > 0 ? "{$hour}:" : "";
			$ltime = $hour . gmstrftime('%M:%S', $json["seconds"]);			
			$array = array("created" => time(),"thumbnail" => $json['logo'],"streamtypes"=> $json['streamtypes'],"title" => $json['title'],"youkuid" => $youku_id,"seconds" => $ltime);
			return $array;
		} else {
			return false;
		}		
	}

	public function notice(){
		if( isset($_COOKIE['ykv_msg_'.COOKIEHASH]) ){
			$msg = $_COOKIE['ykv_msg_'.COOKIEHASH];
			echo '<div class="updated"><p>'.$msg.'</p></div>';
			setcookie('ykv_msg_'.COOKIEHASH, '', time()- 60*60*24, COOKIEPATH,COOKIE_DOMAIN);
		}
		if( isset($_COOKIE['ykv_err_'.COOKIEHASH]) ){
			$err = $_COOKIE['ykv_err_'.COOKIEHASH];
			echo '<div id="message" class="error"><p>'.$err.'</p></div>';
			setcookie('ykv_err_'.COOKIEHASH, '', time()- 60*60*24, COOKIEPATH,COOKIE_DOMAIN);
		}		
	}
	
	private function is_admin_access(){
		return current_user_can('manage_options');
	}
	
	public function get_menupage_url($pageslug){
		return site_url('/wp-admin/admin.php?page='.$pageslug);
	}

	private function update_config($config){
		$this->config = $config;
		update_option('ykv_config', $config);
	}

	private function update_category($category){
		$this->category = $category;
		update_option('ykv_category', $category);
	}	
	
	private function update_videos($videos){
		$this->videos = $videos;
		update_option('ykv_videos', $videos);
	}
	
	private function reverse_array($array){
		$new_array = array();
		foreach($array as $key => $val){
			array_unshift($new_array, $val);
		}
		return $new_array;
	}
	
	private function rewrite(){
		global $wp;
		$config = $this->config;
		$config_name = $config["pagename"];
		$wp->add_query_var('ykccat');

		add_rewrite_rule(
			'^'.$config_name.'/([^/]+)/?$',
			'index.php?pagename='.$config_name.'&ykccat=$matches[1]',
			'top'
		);
		add_rewrite_rule(
			'^'.$config_name.'/([^/]+)/page/?([0-9]+)/?$',
			'index.php?pagename='.$config_name.'&ykccat=$matches[1]&paged=$matches[2]',
			'top'
		);
		flush_rewrite_rules();
	}
	
	public function get_pagelink(){
		$config = $this->config;
		$slug = $config["pagename"];		
		if($slug){
			$slug = get_permalink( get_page_by_path($slug) );
			$slug = rtrim($slug,'/\\');
			return $slug;
		}
		return false;
	}
	
	public function category_count($cat_id){
		$index = 0;
		$videos = $this->videos;
		foreach($videos as $val){
			if( $val["category"]==$cat_id ) $index++;
		}
		return $index;
	}
	
	public function the_video($cat_id=null){
		$videos = $this->videos;
		if($cat_id){
			foreach($videos as $key => $val){
				if( $val["category"]!=$cat_id || empty($val) ) unset($videos[$key]);
			}
		}else{
			foreach($videos as $key => $val){
				if( empty($val) ) unset($videos[$key]);
			}
		}
		$videos = $this->reverse_array($videos);
		return $videos;
	}	
	
	private function get_cat_link($cat_slug){
		$page_link = $this->get_pagelink();
		return get_query_var("page_id") ? ($page_link."&ykccat=".$cat_slug): ($page_link.'/'.$cat_slug);
	}
	
	private function get_catid_by_slug($slug){
		$category = $this->category;
		if(!empty($category) && $slug){
			foreach($category as $key => $val){
				if(!empty($val)){
					if($val["slug"] == $slug) return $key;
				}
			}
		}
		return false;
	}
	
	public function the_cat_link($cat_name=null, $cat_id=null){
		$manage_link = $this->get_menupage_url("youku-videos");
		return sprintf('<a href="%s&category=%s">%s</a>', $manage_link, $cat_id, $cat_name);
	}
	
	public function the_video_link($video_id, $video_hash){
		$config = $this->config;
		$per_page = $config["number"];
		
		$videos = $this->the_video();
		$count  = count($videos);
		
		$paged = floor(($count-$video_id+1)/$per_page);
		return $this->page_link($paged, $video_hash, null, true);
	}
}

?>