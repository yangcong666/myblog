<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'options-summerleaf';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'theme-textdomain'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {



	$options = array();
	
	$options[] = array(
		'name' => __( '通用设置', 'summerleaf' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' =>  __( '站长头像', 'summerleaf' ),
		'desc' => __( '上传站长头像', 'summerleaf' ),
		'id' => 'summer_autherlogo',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( '代码高亮', 'summerleaf' ),
		'desc' => __( '开启主题自带的代码高亮，代码高亮适合技术网站。打勾表示开启。', 'summerleaf' ),
		'id' => 'summer_prettify',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => __( '头像缓存', 'summerleaf' ),
		'desc' => __( '开启主题自带的头像缓存，如果出现错误，请检查wp-content\uploads\avatar文件夹是否存在。打勾表示开启。', 'summerleaf' ),
		'id' => 'summer_avatar',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => __( '页眉设置', 'summerleaf' ),
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => __( '顶部工具条上的短语', 'summerleaf' ),
		'desc' => __( '在文本框中输入一条短语', 'summerleaf' ),
		'id' => 'summer_top_text',
		'std' => 'Default',
		'type' => 'text'
	);

	$options[] = array(
		'name' =>  __( '站点LOGO', 'summerleaf' ),
		'desc' => __( '上传网站LOGO', 'summerleaf' ),
		'id' => 'summer_weblogo',
		'type' => 'upload'
	);


	$options[] = array(
		'name' => __( '页脚设置', 'summerleaf' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( '版权信息', 'summerleaf' ),
		'desc' => __( '输入版权信息', 'summerleaf' ),
		'id' => 'summer_copyright',
		'std' => 'Copyright © 2015-2018 WordPress Leaf. All rights reserved',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'SEO设置', 'summerleaf' ),
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => __( '标题分隔符', 'summerleaf' ),
		'desc' => __( '分隔符一般使用英文的“-” “|” “_”，WordPress默认为“-”，夏叶主题默认为“|”', 'summerleaf' ),
		'id' => 'summer_separator',
		'std' => '|',
		'type' => 'text'
	);	
	
	$options[] = array(
		'name' => __( '首页标题', 'summerleaf' ),
		'desc' => __( '输入你需要的首页标题，将替换WordPrss默认的首页标题。', 'summerleaf' ),
		'id' => 'summer_sitetitle',
		'std' => '',
		'type' => 'text'
	);		

	$options[] = array(
		'name' => __( '首页关键字', 'summerleaf' ),
		'desc' => __( '输入你需要的首页关键字。', 'summerleaf' ),
		'id' => 'summer_keywords',
		'std' => '',
		'type' => 'text'
	);	

	$options[] = array(
		'name' => __( '首页描述', 'summerleaf' ),
		'desc' => __( '输入你需要的首页描述。', 'summerleaf' ),
		'id' => 'summer_description',
		'std' => '',
		'type' => 'textarea'
	);	


	$options[] = array(
		'name' => __( '出站URL加上nofollow', 'summerleaf' ),
		'desc' => __( '为出站的网址加上nofollow，有利于提高网站本身的权重。打勾表示开启。', 'summerleaf' ),
		'id' => 'summer_nofollow',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( '文章与页面的标题、关键字和描述', 'summerleaf' ),
		'desc' => __( '文章与页面，可以在编辑文章和页面的时候来设置，如果不设置那么会自动读取标签、分类来当做关键字，截取文章内容当作描述。', 'summerleaf' ),
		'id' => 'summer_seo_info',
		'std' => '',
		'type' => 'info'
	);

	$options[] = array(
		'name' => __( '分类和标签的标题、关键字和描述', 'summerleaf' ),
		'desc' => __( '分类和标签可以在编辑图像描述的时候使用“||”来设置，如果不设置那么会自动设置。', 'summerleaf' ),
		'id' => 'summer_info',
		'std' => '',
		'type' => 'info'
	);

	$options[] = array(
		'name' => __( '优化与安全', 'summerleaf' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( '移植WP版本号', 'summerleaf' ),
		'desc' => __( '从网页中移除WP版本号以提高安全性。打勾表示移除。', 'summerleaf' ),
		'id' => 'summer_wpversion',
		'std' => '1',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => __( '禁止远程离线编辑提交文章', 'summerleaf' ),
		'desc' => __( '禁止WordPress的xmlrpc，rsd_link，wlwmanifest_link功能。打勾表示禁止。', 'summerleaf' ),
		'id' => 'summer_xmlrpc',
		'std' => '1',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => __( '禁止保存文章修订版本', 'summerleaf' ),
		'desc' => __( '禁止保存文章修订版本。打勾表示禁止。', 'summerleaf' ),
		'id' => 'summer_revisions',
		'std' => '1',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => __( '启用页面HTML代码压缩功能', 'summerleaf' ),
		'desc' => __( '将网页的HTML代码压缩，如果网页出现错误请取消压缩，开启压缩后有可能降低服务器性能。打勾表示开启压缩。', 'summerleaf' ),
		'id' => 'summer_htmlcompress',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( '开启后台登录地址保护', 'summerleaf' ),
		'desc' => __( '点击开启后台登录地址保护，开启后，输入错误的地址会跳转到首页。', 'summerleaf' ),
		'id' => 'summer_admin',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( '请在此处输入后台登录地址改变的值。', 'summerleaf' ),
		'desc' => __( '你的后台登录地址目前为：'.home_url('/wp-login.php').'?love='.(trim(of_get_option('summer_admin_addr')) ? trim(of_get_option('summer_admin_addr')) : 'wordpressleaf'), 'summerleaf' ),
		'id' => 'summer_admin_addr',
		'std' => 'wordpressleaf',
		'class' => 'hidden',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( '使用CDN加载js|css|png|jpg|jpeg|gif|ico文件', 'summerleaf' ),
		'desc' => __( '注意，此功能只会将静态文件的域名替换为CDN的域名，目录结构与原站一致。', 'summerleaf' ),
		'id' => 'summer_cdn',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( '请在此处输入CDN域名。', 'summerleaf' ),
		'desc' => __( '目前你的静态资源CDN地址类似：'.(trim(of_get_option('summer_cdn_addr')) ? trim(of_get_option('summer_cdn_addr')) : home_url()).'/wp-content/themes/summerleaf/js/summerleaf.js', 'summerleaf' ),
		'id' => 'summer_cdn_addr',
		'std' => home_url(),
		'class' => 'hidden',
		'type' => 'text'
	);


	$options[] = array(
		'name' => __( '注意，公用css、js已经使用公共前端库。', 'summerleaf' ),
		'desc' => __( '为了提高网站速度，夏叶主题使用的是公用前端库的css、js。如果你需要从本地服务器加载，那么自行修改加载代码。如果网页提示flexslider字体文件跨站错误，这是因为公共前端库没有开放权限，已经做了优化，请不用理会，或者将flexslider全部文件从本地服务器加载可以解决这个错误。', 'summerleaf' ),
		'id' => 'summer_info',
		'std' => '',
		'type' => 'info'
	);	
	
	
	$options[] = array(
		'name' => __( '主题作者', 'summerleaf' ),
		'type' => 'heading'
	);	


	$options[] = array(
		'name' => __( '夏叶主题作者', 'summerleaf' ),
		'desc' => __( '夏叶主题（SUMMERLEAF）由<a href=http://www.wordpressleaf.com target=_blank>WordPress leaf</a>、<a href=http://themostspecialname.com target=_blank>The Most Special Name</a>联合出品。如果您需要购买正版请联系作者，访问作者网站<a href=http://www.wordpressleaf.com target=_blank>WordPress leaf</a>。<br>
			<a target=_blank href=http://www.wordpressleaf.com class=wordpressleaf-badge wp-badge>WordPress Leaf</a> <br>
			<a target=_blank href=http://themostspecialname.com class=themostspecialname-badge wp-badge>themostspecialname</a><br><br>
   		<h3 style=margin: 0 0 10px;>捐助我们</h3>
			如果您愿意捐助我们，请点击<a href=http://www.wordpressleaf.com/donate target=_blank><strong>这里</strong></a>或者使用微信扫描下面的二维码进行捐助。谢谢！<br>
			<img src=http://www.wordpressleaf.com/wp-content/themes/wordpressleaf/assets/images/weixin.png width=140 height=140 alt=捐助我们>', 'summerleaf' ),
		'id' => 'summer_info',
		'std' => '',
		'type' => 'info'
	);	
	return $options;
}