<?php
$options = array(
    //开始第一个选项标签
    array(
        'title' => '常规选项',
        'id'    => 'panel_general',
        'type'  => 'panelstart' //panelatart 是顶部标签的意思
    ),
    array(  "name" => "列表页排版布局",
			"desc" => "说明：默认图左布局，首页和分类列表页的排版布局",
            "id" => "ygj_paibanbj",
            "type" => "select",
            "std" => "图左",
            "options" => array("图左", "图右", "图上", "图下")),
  
    array(  "name" => "侧边栏布局",
			"desc" => "说明：默认居右布局",
            "id" => "ygj_cblbj",
            "type" => "select",
            "std" => "居右",
            "options" => array("居右", "居左", "无侧边栏")),
			
	array(
        'name'  => '列表页页码',
        'desc'  => '默认为常规标准页码，人工加载和自动加载采用ajax方式滚动加载，不再出现页码',
        'id'    => 'ygj_gdjz',
        "type" => "select",
        "std" => "标准页码",
        "options" => array("标准页码", "人工加载", "自动加载")),
			
	array("name" => "站点连接符",
            "desc" => "站点标题与副标题之间的连接符，一般为 | 或 - 或 _",
            "id" => "ygj_lianjiefu",
			"type" => "select",
			"std" => "_",
			"options" => array("_", "|", "-")),
	
	array(	"name" => "首页公告栏内容",
            "desc" => "说明：请直接按格式修改(li)里面的链接地址及内容即可",
            "id" => "ygj_ggl_nr",
            "type" => "textarea",
            "std" => '<li class="scrolltext-title"><a href="https://yigujin.cn/blogs/" rel="bookmark" target="_blank">免费响应式博客主题Blogs</a></li><li class="scrolltext-title"><a href="https://yigujin.cn/nana/" rel="bookmark" target="_blank">WordPress免费响应式主题Nana</a></li>'),
						
	array(  "name" => "网站整体变灰",
			"desc" => "说明：默认不开启，开启后整个网站变灰，支持IE、Chrome。",
			"id" => "ygj_site_gray",
			"type" => "checkbox"),
					
	array(
		"name"    => "主题风格",
		"desc"    => "13种颜色供选择，选择你喜欢的颜色，保存后前端展示会有所改变。<br/><span style=\"padding:5px;color:#fff;background:#C01E22;\">C01E22</span>&nbsp;<span style=\"padding:5px;color:#fff;background:#0088cc;\">0088cc</span>&nbsp;<span style=\"padding:5px;color:#fff;background:#FF5E52;\">FF5E52</span>&nbsp;<span style=\"padding:5px;color:#fff;background:#2CDB87;\">2CDB87</span>&nbsp;<span style=\"padding:5px;color:#fff;background:#00D6AC;\">00D6AC</span>&nbsp;<span style=\"padding:5px;color:#fff;background:#EA84FF;\">EA84FF</span>&nbsp;<span style=\"padding:5px;color:#fff;background:#FDAC5F;\">FDAC5F</span>&nbsp;<span style=\"padding:5px;color:#fff;background:#FD77B2;\">FD77B2</span>&nbsp;<span style=\"padding:5px;color:#fff;background:#0DAAEA;\">0DAAEA</span>&nbsp;<span style=\"padding:5px;color:#fff;background:#C38CFF;\">C38CFF</span>&nbsp;<span style=\"padding:5px;color:#fff;background:#FF926F;\">FF926F</span>&nbsp;<span style=\"padding:5px;color:#fff;background:#8AC78F;\">8AC78F</span>&nbsp;<span style=\"padding:5px;color:#fff;background:#C7C183;\">C7C183</span>",
		"id"      => "ygj_theme_skin",
		"type"    => "select",
		"std"     => "C01E22",
		"options" => array("C01E22","0088cc","FF5E52","2CDB87","00D6AC","EA84FF","FDAC5F","FD77B2","0DAAEA","C38CFF","FF926F","8AC78F","C7C183")),	
	
	array("name" => "ICP备案号",
            "desc" => "",
            "id" => "ygj_icp",
            "type" => "text",
            "std" => "暂无备案"),
		
	array(	"name" => "添加百度统计",
            "desc" => "说明：不添加表示不启用，推荐使用百度统计（代码将添加到网站全部页面头部的head区域内）",
            "id" => "ygj_bdtjdm",
            "type" => "textarea",
            "std" => ''),
			
	array(	"name" => "友情链接ID",
            "desc" => '说明：默认显示友情链接ID为1，<a class="button-primary" href="https://yigujin.cn/500.html" target="_blank">友链添加教程</a>',
            "id" => "ygj_link_id",
            "type" => "number",
            "std" => 1),
			
	array(	"name" => "留言本地址",
            "desc" => "说明：首页、列表页留言按钮地址，悬浮按钮用到",
            "id" => "ygj_lyburl",
            "type" => "text",
            "std" => "https://yigujin.cn/zxly"),
	
    array(
        'name'  => '侧边栏3D标签云',
        'desc'  => '默认不开启，标签为彩色标签，开启后彩色标签将变成3D标签云',
        'id'    => 'ygj_3dtag',
        'type'  => 'checkbox'),
		
	array(
        'name'  => '压缩前端HTML代码',
        'desc'  => '默认不开启，开启后压缩优化WordPress前端html代码',
        'id'    => 'ygj_yhhtml',
        'type'  => 'checkbox'),
		
	array(	"name" => "自定义样式",
            "desc" => "说明：例如输入：.readMore {display: none;} 将隐藏阅读全文按钮",
            "id" => "ygj_custom_css",
            "type" => "textarea",
            "std" => ''),
  
    array(
        'type'  => 'panelend'//标签段的结束
    ),
    array(
        'title' => 'SEO设置',
        'id'    => 'panel_seo',
        'type'  => 'panelstart'
    ),
    
	array(	"name" => "网站描述（Description）",
			"desc" => "用简洁的文字描述本站点",
			"id" => "ygj_description",
			"type" => "textarea",
            "std" => "说明：输入你的网站描述（如懿古今、boke112导航都是懿古今的个人博客网站），建议一般不超过200个字符"),

	array(	"name" => "网站关键词（KeyWords）",
            "desc" => "各关键字间用半角逗号","分割",
            "id" => "ygj_keywords",
            "type" => "textarea",
            "std" => "说明：输入你的网站关键字（如懿古今,boke112导航），建议一般不超过100个字符"),
		
    array(
        'name'  => '标签自动内链',
        'desc'  => '默认不开启，开启后文章中的标签自动添加内链功能',
        'id'    => "ygj_autonl",
        'type'  => 'checkbox'),
	
    array(
        'name'  => '关键词链接次数',
        'desc'  => '文章中最多链接的次数，默认是1',
        'id'    => 'ygj_autonl_2',
        'type'  => 'number',
        'std'   => 1),

	array(
        'name'  => '图片的alt和title',
        'desc'  => '默认不开启，开启后智能为文章页中的图片添加alt和title属性',
        'id'    => "ygj_zntjtpat",
        'type'  => 'checkbox'),
    
	array(
        'name'  => '外链自动GO跳转',
        'desc'  => '默认不开启，开启后给外部链接加上跳转(需新建页面，模板选Go跳转页面，标题任意，别名为go)',
        'id'    => "ygj_wlgonof",
        'type'  => 'checkbox'),	
		
	array(
        'name'  => '目录页面以/结尾',
        'desc'  => '默认不开启，开启后分类目录和页面链接地址以斜杠/结尾',
        'id'    => "ygj_xiegang",
        'type'  => 'checkbox'
    ),
	
    array(
        'name'  => '百度实时推送',
        'desc'  => '默认不开启，开启后发布文章主动推送到百度，属于WordPress通用方式，启用后需填写Token值',
        'id'    => "ygj_baiduts",
        'type'  => 'checkbox'
    ),
	
    array(
        'name'  => '百度站点Token值',
        'desc'  => '填写在百度站长平台申请的Token值，<a class="button-primary" href="https://yigujin.cn/428.html" target="_blank">详细申请教程</a>',
        'id'    => "ygj_token_id",
        'type'  => 'text',
        'std'   => ''
    ),
	
	array(
        'name'  => '百度星火计划及360智能摘要',
        'desc'  => '默认不开启，开启后自动添加百度星火计划原创保护和360智能摘要Meta标签',
        'id'    => "ygj_xinghuo",
        'type'  => 'checkbox'
    ),
		
    array(
        'name'  => '360自动收录',
        'desc'  => '默认不开启，开启后页面被浏览时会自动提交URL到360以达到自动收录，启用后需填写私钥',
        'id'    => "ygj_360sl",
        'type'  => 'checkbox'
    ),

    array(
        'name'  => '360自动收录私钥',
        'desc'  => '填写在360站长平台获得的私钥，<a class="button-primary" href="https://yigujin.cn/701.html" target="_blank">详细申请教程</a>',
        'id'    => "ygj_360sl_id",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'type'  => 'panelend'//标签段的结束
    ),
    array(
        'title' => '文章设置',
        'id'    => 'panel_aritical',
        'type'  => 'panelstart'
    ),
    array(
        'title' => '文章页属性',
        'type'  => 'subtitle'
    ),
		
	array(
        'name'  => 'title是否显示分类名称',
        'desc'  => '默认不开启，开启后文章页title变为：文章标题（连接符）分类名称（连接符）站点名称',
        'id'    => 'ygj_titlecat',
        'type'  => 'checkbox'),
		
	array(
        'name'  => '文章类型',
        'desc'  => '默认显示，原创文章不显示，转载或投稿文章才会显示(需在编辑文章时自行勾选转载或投稿文章，不勾选为原创文章)',
        'id'    => 'ygj_post_wzlx',
        'type'  => 'checkbox'
    ),
	array(
        'name'  => '作者名/来源',
        'desc'  => '默认显示，原创文章显示作者，转载或投稿文章显示来源名称及链接（需在编辑文章时填写来源名称及链接地址）',
        'id'    => 'ygj_post_author',
        'type'  => 'checkbox'
    ),

	array(
        'name'  => '打赏功能',
        'desc'  => '默认不开启，开启后在文章页内左下角显示打赏功能',
        'id'    => 'ygj_post_shang',
        'type'  => 'checkbox'		
	 ),
		
	array(
        'name'  => '历史上的今天',
        'desc'  => '默认不开启，开启后文章页最后会展示同月同日不同年份的历史文章',
        'id'    => "ygj_lssdjt",
        'type'  => 'checkbox'),

    array(
        'name'  => '相关文章显示篇数',
        'desc'  => '篇&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 这是文章下面的相关文章数目，默认8',
        'id'    => "ygj_related_count",
        'type'  => 'number',
        'std'   => 8
    ),
    array(
        'name'  => '文章版权声明',
        'desc'  => '建议直接修改Nana主题的single.php文件36-44行的文字，参数不建议修改。PS:以下为版权格式（投稿和转载文章类似）',
        'id'    => "ygj_copyright",
        'type'  => 'textarea',
        'std'   => '投稿文章版权格式：
本文地址：https://yigujin.cn/701.html
温馨提示：文章内容系作者个人观点，不代表本地测试对观点赞同或支持。
版权声明：本文为投稿文章，感谢 boke112导航 的投稿，版权归原作者所有，欢迎分享本文，转载请保留出处！

原创文章版权格式：
本文地址：https://yigujin.cn/701.html
版权声明：本文为原创文章，版权归 懿古今 所有，欢迎分享本文，转载请保留出处！'
    ),
    array(
        'type'  => 'panelend'
    ),
    
    array(
        'title' => '评论设置',
        'id'    => 'panel_stylish',
        'type'  => 'panelstart'
    ),
    array(
        'title' => '评论等级设置',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '评论等级启用',
        'desc'  => '默认不开启，您需要在下面设置用户评论等级的称号及相关评论数，可默认不理会',
        'id'    => 'ygj_pldj',
        'type'  => 'checkbox'
    ),
	array(
        'name'  => '管理员评论的称号',
        'desc'  => '默认为：站长',
        'id'    => 'ygj_adminch',
        'type'  => 'text',
        'std'   => "站长"
    ),
	array(
        'name'  => '一级评论者称号',
        'desc'  => '默认为：农民',
        'id'    => 'ygj_pldjch_1',
        'type'  => 'text',
        'std'   => "农民"
    ),
    array(
        'name'  => '一级评论者的评论数',
        'desc'  => '一级评论者的默认评论数：1条<=默认<10条',
        'id'    => 'ygj_pldjs_1',
        'type'  => 'number',
        'std'   => 10
    ),
		array(
        'name'  => '二级评论者称号',
        'desc'  => '默认为：队长',
        'id'    => 'ygj_pldjch_2',
        'type'  => 'text',
        'std'   => "队长"
    ),
    array(
        'name'  => '二级评论者的评论数',
        'desc'  => '二级评论者的默认评论数：10条<=默认<20条',
        'id'    => 'ygj_pldjs_2',
        'type'  => 'number',
        'std'   => 20
    ),
		array(
        'name'  => '三级评论者称号',
        'desc'  => '默认为：村长',
        'id'    => 'ygj_pldjch_3',
        'type'  => 'text',
        'std'   => "村长"
    ),
    array(
        'name'  => '三级评论者的评论数',
        'desc'  => '三级评论者的默认评论数：20条<=默认<40条',
        'id'    => 'ygj_pldjs_3',
        'type'  => 'number',
        'std'   => 40
    ),
		array(
        'name'  => '四级评论者称号',
        'desc'  => '默认为：镇长',
        'id'    => 'ygj_pldjch_4',
        'type'  => 'text',
        'std'   => "镇长"
    ),
    array(
        'name'  => '四级评论者的评论数',
        'desc'  => '四级评论者的默认评论数：40条<=默认<80条',
        'id'    => 'ygj_pldjs_4',
        'type'  => 'number',
        'std'   => 80
    ),
		array(
        'name'  => '五级评论者称号',
        'desc'  => '默认为：县长',
        'id'    => 'ygj_pldjch_5',
        'type'  => 'text',
        'std'   => "县长"
    ),
    array(
        'name'  => '五级评论者的评论数',
        'desc'  => '五级评论者的默认评论数：80条<=默认<160条',
        'id'    => 'ygj_pldjs_5',
        'type'  => 'number',
        'std'   => 160
    ),
		array(
        'name'  => '六级评论者称号',
        'desc'  => '默认为：市长',
        'id'    => 'ygj_pldjch_6',
        'type'  => 'text',
        'std'   => "市长"
    ),
    array(
        'name'  => '六级评论者的评论数',
        'desc'  => '六级评论者的默认评论数：160条<=默认<320条',
        'id'    => 'ygj_pldjs_6',
        'type'  => 'number',
        'std'   => 320
    ),
		array(
        'name'  => '七级评论者称号',
        'desc'  => '默认为：省长',
        'id'    => 'ygj_pldjch_7',
        'type'  => 'text',
        'std'   => "省长"
    ),
    array(
        'name'  => '七级评论者的评论数',
        'desc'  => '七级评论者的默认评论数：320条<=默认<640条',
        'id'    => 'ygj_pldjs_7',
        'type'  => 'number',
        'std'   => 640
    ),
		array(
        'name'  => '八级评论者称号',
        'desc'  => '默认为：总理',
        'id'    => 'ygj_pldjch_8',
        'type'  => 'text',
        'std'   => "总理"
    ),
    array(
        'name'  => '八级评论者的评论数',
        'desc'  => '八级评论者的默认评论数：640条<=默认<1280条',
        'id'    => 'ygj_pldjs_8',
        'type'  => 'number',
        'std'   => 1280
    ),
		array(
        'name'  => '九级评论者称号',
        'desc'  => '默认为：主席；评论大于等于八级评论数（1280）即为九级',
        'id'    => 'ygj_pldjch_9',
        'type'  => 'text',
        'std'   => "主席"
    ),
    array(
        'type'  => 'panelend'
    ),
    array(
        'title' => '幻灯设置',
        'id'    => 'panel_slide',
        'type'  => 'panelstart'
    ),
    array(  "name" => "是否显示幻灯片",
			"desc" => "说明：默认显示，最大宽度800px，多张高度建议一致",
            "id" => "ygj_hdpkg",
            "type" => "select",
            "std" => "显示",
            "options" => array("显示", "关闭")),

	array(
        'name'  => '幻灯片一图片',
        'desc'  => '必填，在这里输入第一张幻灯片的图片路径',
        'id'    => "ygj_hdp_tp1",
        'type'  => 'text',
        'std'   => '' . get_template_directory_uri() . '/images/abc/blogs.jpg'
    ),
    array(
        'name'  => '幻灯片一链接',
        'desc'  => '选填，在这里输入第二张幻灯片的链接地址',
        'id'    => "ygj_hdp_lj1",
        'type'  => 'text',
        'std'   => 'https://yigujin.cn/blogs/'
    ),
    array(
        'name'  => '幻灯片一标题',
        'desc'  => '选填，在这里输入第一张幻灯片的标题',
        'id'    => "ygj_hdp_bt1",
        'type'  => 'text',
        'std'   => '免费响应式博客主题Blogs',
		"section" => '<div class="part"></div>'),
    array(
        'name'  => '幻灯片二图片',
        'desc'  => '必填，在这里输入第二张幻灯片的图片路径',
        'id'    => "ygj_hdp_tp2",
        'type'  => 'text',
        'std'   => '' . get_template_directory_uri() . '/images/abc/nana.jpg'
    ),
    array(
        'name'  => '幻灯片二链接',
        'desc'  => '选填，在这里输入第二张幻灯片的链接地址',
        'id'    => "ygj_hdp_lj2",
        'type'  => 'text',
        'std'   => 'https://yigujin.cn/nana/'
    ),
    array(
        'name'  => '幻灯片二标题',
        'desc'  => '选填，在这里输入第二张幻灯片的标题',
        'id'    => "ygj_hdp_bt2",
        'type'  => 'text',
        'std'   => 'WordPress免费响应式主题Nana',
		"section" => '<div class="part"></div>'
    ),
    array(
        'name'  => '幻灯片三图片',
        'desc'  => '必填，在这里输入第三张幻灯片的图片路径',
        'id'    => "ygj_hdp_tp3",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '幻灯片三链接',
        'desc'  => '选填，在这里输入第三张幻灯片的链接地址',
        'id'    => "ygj_hdp_lj3",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '幻灯片三标题',
        'desc'  => '选填，在这里输入第三张幻灯片的标题',
        'id'    => "ygj_hdp_bt3",
        'type'  => 'text',
        'std'   => ''
    ),	
    array(
        'type'  => 'panelend'
    ),
    array(
        'title' => '页脚设置',
        'id'    => 'panel_footer',
        'type'  => 'panelstart'
    ),

	array(	"name" => "页脚常用链接",
            "desc" => "说明：默认8个，少于5个会错位；请直接按格式修改(li)里面的链接地址及内容即可",
            "id" => "ygj_yjcylj",
            "type" => "textarea",
            "std" => '<li><span class="post_spliter">•</span><a href="https://yigujin.cn/nana/" target="_blank">Nana主题</a></li><li><span class="post_spliter">•</span><a href="https://yigujin.cn/zbpnana/" target="_blank">zbpNana</a></li><li><span class="post_spliter">•</span><a href="https://yigujin.cn/blogs/" target="_blank">Blogs主题</a></li><li><span class="post_spliter">•</span><a href="https://yigujin.cn/722.html" target="_blank">去除版权</a></li><li><span class="post_spliter">•</span><a href="https://yigujin.cn/unite/" target="_blank">Unite主题</a></li><li><span class="post_spliter">•</span><a href="https://yigujin.cn/three/" target="_blank">Three主题</a></li><li><span class="post_spliter">•</span><a href="https://yigujin.cn/673.html" target="_blank">NewUnite主题</a></li><li><span class="post_spliter">•</span><a href="http://boke112.com/" target="_blank">博客导航</a></li>'),
			
	array(	"name" => "关注我们二维码",
            "desc" => "说明：页脚右下角关注我们的二维码图片地址，自行按相同规格制作二维码",
            "id" => "ygj_gzwm_ewm",
            "type" => "text",
            "std" => '' . get_template_directory_uri() . '/images/gongzhonghao.jpg'),

	array(	"name" => "关注我们按钮一标题",
			"desc" => "说明：页脚右下角关注我们第一个按钮标题",
			"id" => "ygj_gzwm_bt1",
			"std" => "我的QQ空间",
			 "type" => "text"),

	array(	"name" => "关注我们按钮一链接",
            "desc" => "说明：页脚右下角关注我们第一个按钮的链接地址",
            "id" => "ygj_gzwm_lj1",
            "type" => "text",
            "std" => "http://user.qzone.qq.com/123456789"),			

	array(	"name" => "关注我们按钮二标题",
			"desc" => "说明：页脚右下角关注我们第一个按钮标题",
			"id" => "ygj_gzwm_bt2",
			"std" => "我的新浪微博",
			 "type" => "text"),
	
	array(	"name" => "关注我们按钮二链接",
            "desc" => "说明：页脚右下角关注我们第二个按钮的链接地址",
            "id" => "ygj_gzwm_lj2",
            "type" => "text",
            "std" => "http://weibo.com/weibo"),
    array(
        'type'  => 'panelend'
    ),
    array(
        'title' => '广告设置',
        'id'    => 'panel_ads',
        'type'  => 'panelstart'
    ),
    array(  "name" => "导航栏下方广告",
			"desc" => "说明：默认显示，首页通栏显示",
            "id" => "ygj_ddad",
            "type" => "select",
            "std" => "显示",
            "options" => array("显示", "关闭")),

	array(	"name" => "导航栏下方广告代码（PC端）",
            "desc" => "宽度1078px",
            "id" => "ygj_addd_c",
            "type" => "textarea",
            "std" => '<a href="http://boke112.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/abc/adboke112.jpg" alt="boke112导航_独立博客导航平台" /></a>'),
	
	array(	"name" => "导航栏下方广告代码（移动端）",
            "desc" => "",
            "id" => "ygj_addd_c_m",
            "type" => "textarea",
            "std" => '<a href="http://boke112.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/abc/adboke112.jpg" alt="boke112导航_独立博客导航平台" /></a>'),
	
	array(  "name" => "首页(列表页)第一广告",
			"desc" => "说明：默认显示",
            "id" => "ygj_adh",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(	"name" => "首页(列表页)第一广告代码（PC端）",
            "desc" => "最大宽度778px",
            "id" => "ygj_adh_c",
            "type" => "textarea",
            "std" => '<a href="http://boke112.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/abc/adboke112.jpg" alt="boke112导航_独立博客导航平台" /></a>'),
	
	array(	"name" => "首页(列表页)第一广告代码（移动端）",
            "desc" => "",
            "id" => "ygj_adh_c_m",
            "type" => "textarea",
            "std" => '<a href="http://boke112.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/abc/adboke112.jpg" alt="boke112导航_独立博客导航平台" /></a>'),
			
	array(  "name" => "首页（列表页）第二广告",
			"desc" => "说明：默认每页显示6篇文章及以上显示",
            "id" => "ygj_adhx",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(	"name" => "首页(列表页)第二广告代码（PC端）",
            "desc" => "最大宽度778px",
            "id" => "ygj_adh_cx",
            "type" => "textarea",
            "std" => '<a href="https://yigujin.cn/blogs/" target="_blank"><img src="' . get_template_directory_uri() . '/images/abc/adblogs.jpg" alt="免费响应式博客主题Blogs" /></a>'),
	
	array(	"name" => "首页(列表页)第二广告代码（移动端）",
            "desc" => "",
            "id" => "ygj_adh_cx_m",
            "type" => "textarea",
            "std" => '<a href="https://yigujin.cn/blogs/" target="_blank"><img src="' . get_template_directory_uri() . '/images/abc/adblogs.jpg" alt="免费响应式博客主题Blogs" /></a>'),

	array(  "name" => "正文标题下方广告",
			"desc" => "说明：默认显示",
            "id" => "ygj_g_single",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(	"name" => "正文标题下方广告代码（PC端）",
            "desc" => "最大宽度728px",
            "id" => "ygj_single_ad",
            "type" => "textarea",
            "std" => '<a href="https://yigujin.cn/blogs/" target="_blank"><img src="' . get_template_directory_uri() . '/images/abc/adblogs.jpg" alt="免费响应式博客主题Blogs" /></a>'),

	array(	"name" => "正文标题下方广告代码（移动端）",
            "desc" => "",
            "id" => "ygj_single_ad_m",
            "type" => "textarea",
            "std" => '<a href="https://yigujin.cn/blogs/" target="_blank"><img src="' . get_template_directory_uri() . '/images/abc/adblogs.jpg" alt="免费响应式博客主题Blogs" /></a>'),

	array(  "name" => "正文底部广告",
			"desc" => "说明：默认显示",
            "id" => "ygj_adt",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(	"name" => "正文底部广告代码（PC端）",
            "desc" => "最大宽度778px",
            "id" => "ygj_adtc",
            "type" => "textarea",
            "std" => '<a href="https://yigujin.cn/blogs/" target="_blank"><img src="' . get_template_directory_uri() . '/images/abc/adblogs.jpg" alt="免费响应式博客主题Blogs" /></a>'),
	
	array(	"name" => "正文底部广告代码（移动端）",
            "desc" => "",
            "id" => "ygj_adtc_m",
            "type" => "textarea",
            "std" => '<a href="https://yigujin.cn/blogs/" target="_blank"><img src="' . get_template_directory_uri() . '/images/abc/adblogs.jpg" alt="免费响应式博客主题Blogs" /></a>'),
		
	array(  "name" => "评论框上方广告",
			"desc" => "说明：默认显示",
            "id" => "ygj_g_comment",
            "type" => "select",
            "std" => "显示",
            "options" => array("显示", "关闭")),

	array(	"name" => "评论框上方广告代码（PC端）",
            "desc" => "最大宽度778px",
            "id" => "ygj_ad_c",
            "type" => "textarea",
            "std" => '<a href="http://boke112.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/abc/adboke112.jpg" alt="boke112导航_独立博客导航平台" /></a>'),
	
	array(	"name" => "评论框上方广告代码（移动端）",
            "desc" => "",
            "id" => "ygj_ad_c_m",
            "type" => "textarea",
            "std" => '<a href="http://boke112.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/abc/adboke112.jpg" alt="boke112导航_独立博客导航平台" /></a>'),
			
	array(  "name" => "通栏页面评论框上方广告",
			"desc" => "说明：默认显示",
            "id" => "ygj_g_full",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(	"name" => "通栏页面评论框上方广告代码（PC端）",
            "desc" => "最大宽度1078px",
            "id" => "ygj_ad_fc",
            "type" => "textarea",
            "std" => '<a href="http://boke112.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/abc/adboke112.jpg" alt="boke112导航_独立博客导航平台" /></a>'),
	
	array(	"name" => "通栏页面评论框上方广告代码（移动端）",
            "desc" => "",
            "id" => "ygj_ad_fc_m",
            "type" => "textarea",
            "std" => '<a href="http://boke112.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/abc/adboke112.jpg" alt="boke112导航_独立博客导航平台" /></a>'),
			
	array(	"name" => "下载弹窗广告",
            "desc" => "说明：宽度500px，高度300px",
            "id" => "ygj_file_ad",
            "type" => "textarea",
            "std" => '<a href="http://boke112.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/abc/ad500.jpg" alt="boke112导航_独立博客导航平台" /></a>'),
    array(
        'type'  => 'panelend'
    ),
	
    array(
        'title' => '高级设置',
        'id'    => 'panel_advence',
        'type'  => 'panelstart'
    ),
	array(
        'title' => 'WordPress安全设置[小白慎用]',
        'type'  => 'subtitle'
    ),
	array(
        'name'  => '防网站被恶意镜像',
        'desc'  => '默认不开启，开启后需前往修改functions.php文件（大约在1025行）中的$currentDomain为自己域名',
        'id'    => 'ygj_mirror',
        'type'  => 'checkbox'),
	array(
        'name'  => '隐藏后台忘记密码',
        'desc'  => '默认不开启，开启后后台登录页面的忘记密码及获取新密码页面将被隐藏',
        'id'    => 'ygj_lostpwd',
        'type'  => 'checkbox'),
    array(
        'name'  => '加密WordPress后台',
        'desc'  => '启用之后，请填写下面的问题与答案，默认后台登录地址将变为：http://yoursite/wp-login.php?问题=答案】',
        'id'    => "ygj_admin_link",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '访问问题[绝对不准用中文]',
        'desc'  => '这里随便填写一个字符，比如：yigujin',
        'id'    => "ygj_admin_q",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '访问答案[绝对不准用中文]',
        'desc'  => '这里随便填写一个字符，比如：boke112',
        'id'    => "ygj_admin_a",
        'type'  => 'text',
        'std'   => ''
    ),
	array(
        'name'  => '登录地址不对跳转',
        'desc'  => '默认跳转到首页',
        'id'    => "ygj_admin_url",
        'type'  => 'text',
        'std'   => '' . home_url() . ''
    ),
    array(
        'title' => '新浪微博同步设置',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '开启',
        'desc'  => '',
        'id'    => "ygj_sinasync",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '新浪用户名',
        'desc'  => '最好输入您的微博的登陆邮箱',
        'id'    => "ygj_sinasync_user",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '新浪密码',
        'desc'  => '请输入您的微博密码',
        'id'    => "ygj_sinasync_pwd",
        'type'  => 'password',
        'std'   => ''
    ),
    array(
        'name'  => '新浪appkey',
        'desc'  => '请输入您的微博appkey，<a class="button-primary" target="_blank" href="http://boke112.com/2480.html">详细申请教程</a>',
        'id'    => "ygj_sinasync_key",
        'type'  => 'text',
        'std'   => ''
    ),
  
    array(
        'title' => 'SMTP邮箱设置',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '发件人地址',
        'desc'  => '请输入您的邮箱地址',
        'id'    => "ygj_maildizhi_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '发件人昵称',
        'desc'  => '请输入您的网站名称',
        'id'    => "ygj_mailnichen_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => 'SMTP服务器地址',
        'desc'  => '请输入您的邮箱的SMTP服务器，查看<a class="button-primary" target="_blank" href="http://wenku.baidu.com/link?url=Xc_mRFw2K-dimKX845QalqLpZzly07mC4a_t_QjOSPov0uFx3MWTl3wgw4tOAyTbDlS7lT8TOAj8VOxDYU186wQLKPt1fKncz7k_jbP_RQi">查看常用SMTP地址</a>',
        'id'    => "ygj_mailsmtp_b",
        'type'  => 'text',
        'std'   => 'smtp.qq.com'
    ),
	array(
        'name'  => 'SSL安全连接',
        'desc'  => '【如果你不知道这个是什么东东，那么请不要启用】',
        'id'    => "ygj_smtpssl_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => 'SMTP服务器端口',
        'desc'  => '请输入您的smtp端口，一般QQ邮箱25就可以了',
        'id'    => "ygj_mailport_b",
        'type'  => 'text',
        'std'   => '25'
    ),
    array(
        'name'  => '邮箱账号',
        'desc'  => '请输入您的邮箱地址，比如懿古今的2226524923@qq.com',
        'id'    => "ygj_mailuser_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '邮箱密码',
        'desc'  => '请输入您的邮箱密码',
        'id'    => "ygj_mailpass_b",
        'type'  => 'password',
        'std'   => ''
    ),
    array(
        'type'  => 'panelend'
    )
);

function ygj_add_theme_options_page() {
    global $options;
    if (isset($_GET['page'])&&$_GET['page'] == basename(__FILE__)) {
        if (isset($_REQUEST['action'])&&'update' == $_REQUEST['action']) {
            foreach($options as $value) {
                if (isset($_REQUEST[$value['id']])) {
                    update_option($value['id'], $_REQUEST[$value['id']]);
                } else {
                    delete_option($value['id']);
                }
            }
            update_option('ygj_options_setup', true);
            header('Location: themes.php?page=theme-options.php&update=true');
            die;
        } else if( isset($_REQUEST['action'])&&'reset' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
                delete_option($value['id']);
            }
            delete_option('ygj_options_setup');
            header('Location: themes.php?page=theme-options.php&reset=true');
            die;
        }
    }
    add_theme_page('主题选项', '主题选项', 'edit_theme_options', basename(__FILE__) , 'ygj_options_page');
}


function ygj_options_page() {
    global $options;
    $optionsSetup = get_option('ygj_options_setup') != '';
    if (isset($_REQUEST['update'])) echo '<div class="updated"><p><strong>Blogs主题设置已保存！</strong></p></div>';
    if (isset($_REQUEST['reset'])) echo '<div class="updated"><p><strong>Blogs主题设置已重置。</strong></p></div>';
?>

<div class="wrap">
    <h2>Blogs 主题选项</h2>
    <input placeholder="搜索主题选项…" type="search" id="theme-options-search" />
    <div class="ygjtips">    
    <p>当前主题：Blogs&nbsp;1.1&nbsp;版 | 设计者：<a href="https://yigujin.cn/" target="_blank">懿古今</a> | <a href="https://yigujin.cn/722.html" target="_blank">赞助20元去版权</a> | 申请免费收录到 <a href="http://boke112.com/" target="_blank">boke112导航</a> </p>
    </div>
	<?php //获取所有站点分类id
	function Bing_show_category() {
    global $wpdb;
    $request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
    $request.= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
    $request.= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
    $request.= " ORDER BY term_id asc";
    $categorys = $wpdb->get_results($request);
    foreach ($categorys as $category) { //调用菜单
        $output = '<span>' . $category->name . "=(<b>" . $category->term_id . '</b>)</span>&nbsp;&nbsp;';
        echo $output;
    }
}
?>
    <div class="catlist">您的网站分类列表：<?php echo Bing_show_category(); ?></div>
    <form method="post">
        <h2 class="nav-tab-wrapper">
<?php
$panelIndex = 0;
foreach ($options as $value ) {
    if ( $value['type'] == 'panelstart' ) echo '<a href="#' . $value['id'] . '" class="nav-tab' . ( $panelIndex == 0 ? ' nav-tab-active' : '' ) . '">' . $value['title'] . '</a>';
    $panelIndex++;
}
echo '<a href="#about_theme" class="nav-tab">关于主题</a>';

?>
</h2>

<?php
$panelIndex = 0;
foreach ($options as $value) {
switch ( $value['type'] ) {
    case 'panelstart':
        echo '<div class="panel" id="' . $value['id'] . '" ' . ( $panelIndex == 0 ? ' style="display:block"' : '' ) . '><table class="form-table">';
        $panelIndex++;
        break;
    case 'panelend':
        echo '</table></div>';
        break;
    case 'subtitle':
        echo '<tr><th colspan="2"><h3>' . $value['title'] . '</h3></th></tr>';
        break;
    case 'text':
?>
<tr>
    <th><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
    <td>
        <label>
        <input name="<?php echo $value['id']; ?>" class="regular-text" id="<?php echo $value['id']; ?>" type='text' value="<?php if ( $optionsSetup || get_option( $value['id'] ) != '') { echo stripslashes(get_option( $value['id'] )); } else { echo $value['std']; } ?>" />
        <span class="description"><?php echo $value['desc']; ?></span>
        </label>
    </td>
</tr>
<?php
    break;
    case 'number':
?>
<tr>
    <th><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
    <td>
        <label>
        <input name="<?php echo $value['id']; ?>" class="small-text" id="<?php echo $value['id']; ?>" type="number" value="<?php if ( $optionsSetup || get_option( $value['id'] ) != '') { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
        <span class="description"><?php echo $value['desc']; ?></span>
        </label>
    </td>
</tr>
<?php
    break;
    case 'password':
?>
<tr>
    <th><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
    <td>
        <label>
        <input name="<?php echo $value['id']; ?>" class="regular-text" id="<?php echo $value['id']; ?>" type="password" value="<?php if ( $optionsSetup || get_option( $value['id'] ) != '') { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
        <span class="description"><?php echo $value['desc']; ?></span>
        </label>
    </td>
</tr>
<?php
    break;
    case 'textarea':
?>
<tr>
    <th><?php echo $value['name']; ?></th>
    <td>
        <p><label for="<?php echo $value['id']; ?>"><?php echo $value['desc']; ?></label></p>
        <p><textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" rows="5" cols="50" class="large-text code"><?php if ( $optionsSetup || get_option( $value['id'] ) != '') { echo stripslashes(get_option( $value['id'] )); } else { echo $value['std']; } ?></textarea></p>
    </td>
</tr>
<?php
    break;
    case 'select':
?>
<tr>
    <th><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
    <td>
        <label>
            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                <?php foreach ($value['options'] as $option) : ?>
                <option value="<?php echo $option; ?>" <?php selected( get_option( $value['id'] ), $option); ?>>
                    <?php echo $option; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <span class="description"><?php echo $value['desc']; ?></span>
        </label>
    </td>
</tr>

<?php
    break;
    case 'radio':
?>
<tr>
    <th><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
    <td>
        <?php foreach ($value['options'] as $name => $option) : ?>
        <label>
            <input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php echo $option; ?>" <?php checked( get_option( $value['id'] ), $option); ?>>
            <?php echo $name; ?>
        </label>
        <?php endforeach; ?>
        <p><span class="description"><?php echo $value['desc']; ?></span></p>
    </td>
</tr>
 
<?php
    break;
    case 'checkbox':
?>
<tr>
    <th><?php echo $value['name']; ?></th>
    <td>
        <label>
            <input type='checkbox' name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="1" <?php echo checked(get_option($value['id']), 1); ?> />
            <span><?php echo $value['desc']; ?></span>
        </label>
    </td>
</tr>

<?php
    break;
    case 'checkboxs':
?>
<tr>
    <th><?php echo $value['name']; ?></th>
    <td>
        <?php $checkboxsValue = get_option( $value['id'] );
        if ( !is_array($checkboxsValue) ) $checkboxsValue = array();
        foreach ( $value['options'] as $id => $title ) : ?>
        <label>
            <input type="checkbox" name="<?php echo $value['id']; ?>[]" id="<?php echo $value['id']; ?>[]" value="<?php echo $id; ?>" <?php checked( in_array($id, $checkboxsValue), true); ?>>
            <?php echo $title; ?>
        </label>
        <?php endforeach; ?>
        <span class="description"><?php echo $value['desc']; ?></span>
    </td>
</tr>
 
<?php
    break;
}
}
?>
<div class="panel" id="about_theme">
<h2>主题介绍</h2>
<p>主题命名为Blogs，是因为这款主题专门为博客布局设计的，它是从<a target="_blank" href="https://yigujin.cn/nana/">Nana主题</a>的博客布局演变而言，首页、文章列表页共分为4种布局，侧边栏共分为3种布局，组合起来就有12种布局，希望有一款是你所喜欢的。</p>
<h2>特别声明</h2>
<p>Blogs主题是免费的，所以希望大家能够尊重我们的劳动成果，有钱出钱有力出力。换句话说就是：<font color="#ff0000">如果你赞助20元及以上的版权费，就可以正大光明地去除版权，并加入懿古今主题交流群（477678587）；如果你不想赞助，希望你能够保留主题的版权链接，谢谢合作。</font></p>	
<p><font color="#ff0000">PS：如果不赞助本站，就直接删除版权的，对此我也无能为力，只能视你为人品不及格而已。</font></p>
<h2>支持懿古今</h2>
<p>如果您觉的这款主题很赞，欢迎您扫码支持懿古今！</p>
<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/zhutisuoxuwushan.jpg"></img>
<h2>联系我们</h2>
<p>QQ号：2226524923</p>
<p>懿古今主题交流群：477678587<font color="#ff0000">（赞助后联系本人拉人进入）</font></p>
</div>
<p class="submit">
    <input name="submit" type="submit" class="button button-primary" value="保存选项"/>
    <input type="hidden" name="action" value="update" />
</p>
</form>
<form method="post">
<p>
    <input name="reset" type="submit" class="button button-secondary" value="重置选项" onclick="return confirm('重置之后您的全部设置将被恢复默认，您确定还要吗？？？');"/>
    <input type="hidden" name="action" value="reset" />
</p>
</form>
</div>
<style>.catlist{border:2px solid #FFB6C1;padding:5px;margin-top: 12px;text-align: center;color:#000;}.ygjtips{border: 2px solid #C01E22;padding: 5px 15px}.panel{display:none}.panel h3{margin:0;font-size:1.2em}#panel_update ul{list-style-type:disc}.nav-tab-wrapper{clear:both}.nav-tab{position:relative}.nav-tab i:before{position:absolute;top:-10px;right:-8px;display:inline-block;padding:2px;border-radius:50%;background:#e14d43;color:#fff;content:"\f463";vertical-align:text-bottom;font:400 18px/1 dashicons;speak:none}#theme-options-search{display:none;float:right;margin-top:-34px;width:280px;font-weight:300;font-size:16px;line-height:1.5}.updated+#theme-options-search{margin-top:-91px}.wrap.searching .nav-tab-wrapper a,.wrap.searching .panel tr,#attrselector{display:none}.wrap.searching .panel{display:block !important}#attrselector[attrselector*=ok]{display:block}</style>
<style id="theme-options-filter"></style>
<div id="attrselector" attrselector="ok" ></div>
<script>
jQuery(function ($) {
    $(".nav-tab").click(function () {
        $(this).addClass("nav-tab-active").siblings().removeClass("nav-tab-active");
        $(".panel").hide();
        $($(this).attr("href")).show();
        return false;
    });

    var themeOptionsFilter = $("#theme-options-filter");
    themeOptionsFilter.text("ok");
    if ($("#attrselector").is(":visible") && themeOptionsFilter.text() != "") {
        $(".panel tr").each(function (el) {
            $(this).attr("data-searchtext", $(this).text().replace(/\r|\n/g, '').replace(/ +/g, ' ').toLowerCase());
        });

        var wrap = $(".wrap");
        $("#theme-options-search").show().on("input propertychange", function () {
            var text = $(this).val().replace(/^ +| +$/, "").toLowerCase();
            if (text != "") {
                wrap.addClass("searching");
                themeOptionsFilter.text(".wrap.searching .panel tr[data-searchtext*='" + text + "']{display:block}");
            } else {
                wrap.removeClass("searching");
                themeOptionsFilter.text("");
            };
        });
    };
});
</script>

<?php
}
//启用主题后自动跳转至选项页面
global $pagenow;
    if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' )
    {
        wp_redirect( admin_url( 'themes.php?page=theme-options.php' ) );
    exit;
}
function ygj_enqueue_pointer_script_style( $hook_suffix ) {
    $enqueue_pointer_script_style = false;
    $dismissed_pointers = explode( ',', get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
    if( !in_array( 'ygj_options_pointer', $dismissed_pointers ) ) {
        $enqueue_pointer_script_style = true;
        add_action( 'admin_print_footer_scripts', 'ygj_pointer_print_scripts' );
    }
    if( $enqueue_pointer_script_style ) {
        wp_enqueue_style( 'wp-pointer' );
        wp_enqueue_script( 'wp-pointer' );
    }
}
add_action( 'admin_enqueue_scripts', 'ygj_enqueue_pointer_script_style' );
add_action('admin_menu', 'ygj_add_theme_options_page');
function ygj_pointer_print_scripts() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        var $menuAppearance = $("#menu-appearance");
        $menuAppearance.pointer({
            content: '<h3>恭喜，Blogs 主题1.0安装成功！</h3><p>该主题支持选项，请访问<a href="themes.php?page=theme-options.php">主题选项</a>页面进行配置。</p>',
            position: {
                edge: "left",
                align: "center"
            },
            close: function() {
                $.post(ajaxurl, {
                    pointer: "ygj_options_pointer",
                    action: "dismiss-wp-pointer"
                });
            }
        }).pointer("open").pointer("widget").find("a").eq(0).click(function() {
            var href = $(this).attr("href");
            $menuAppearance.pointer("close");
            setTimeout(function(){
                location.href = href;
            }, 700);
            return false;
        });

        $(window).on("resize scroll", function() {
            $menuAppearance.pointer("reposition");
        });
        $("#collapse-menu").click(function() {
            $menuAppearance.pointer("reposition");
        });
    });
    </script>

<?php
}