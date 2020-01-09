<?php 
//主题选项
add_action('admin_menu', 'simple_theme_page'); 
function simple_theme_page (){ 
$action=$_POST['action'];

//常规设置
if ( count($_POST) > 0 && isset($_POST['settings_action']) ){

	foreach($_POST as $key=>$value){
		
		$Keys = array ($key); 
		foreach ( $Keys as $Key ){
			delete_option ($Key, $_POST[$key]);
			add_option($Key, $_POST[$key]);
		}
	}
	if($_POST['settings_action']=='save'){
		header("location:".'admin.php?page=themes-settings');
	}else{		
		header("location:".'admin.php?page=themes-settings&action='.$_POST['settings_action'].'');
	}
}

add_menu_page(__('主题选项'), __('主题选项'), 'edit_themes','themes-settings', 'simple_settings'); 
} 

// simple_settings
function simple_settings(){ 
?>
<link rel="stylesheet" href="<?php echo get_bloginfo("template_url");?>/css/public/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_bloginfo("template_url");?>/css/public/bootstrap.min.css" type="text/css" media="screen" />
<!-- <link rel="stylesheet" href="<?php echo get_bloginfo("template_url");?>/css/public/bootstrap-theme.min.css" type="text/css" media="screen" /> -->
<link rel="stylesheet" href="<?php echo get_bloginfo("template_url");?>/css/public/font-awesome.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_bloginfo("template_url");?>/css/theme-option.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/js/public/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/js/public/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/js/public/laydate/laydate.js"></script>
<!-- <script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/js/public/jquery.scrollTo.js"></script> -->
<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/js/theme-option.js"></script>


<!-- Wrap_bg -->
<div class="Wrap_bg">
<div id="Wrap">

<div id="AdminHead" class="clearfix">
  <h2 class="AdminHead_h2">主题选项</h2>
</div>


<!--AdminTabs-->
<div id="AdminTabs" class="clearfix">
 <?php
$action=$_GET['action'];
$gamenum=$_GET['gamenum'];
?>
 <!--TabMenu-->
 <div id="TabMenu">
  <ul>
   <li <?php if($action==''){?> class="in"<?php } ?>><a href="admin.php?page=themes-settings"><span><i class="icon-cogs"></i>  常规设置</span></a></li>
   <!-- <li <?php if($action=='home'){?> class="in"<?php } ?>><a href="admin.php?page=themes-settings&action=home"><span><i class="icon-home"></i>  首页设置</span></a></li> -->
   <li <?php if($action=='seo'){?> class="in"<?php } ?>><a href="admin.php?page=themes-settings&action=seo"><span><i class="icon-search"></i>  SEO设置</span></a></li>
   <li <?php if($action=='code'){?> class="in"<?php } ?>><a href="admin.php?page=themes-settings&action=code"><span><i class="icon-list-alt"></i>  代码设置</span></a></li>
   <li <?php if($action=='other'){?> class="in"<?php } ?>><a href="admin.php?page=themes-settings&action=other"><span><i class="icon-desktop"></i>  其他设置</span></a></li>
   <!-- <li <?php if($action=='share'){?> class="in"<?php } ?>><a href="admin.php?page=themes-settings&action=share"><span><i class="icon-share"></i>  社交设置</span></a></li> -->
  </ul>
 </div>
 <!--/TabMenu-->
 
 <!--TabContent-->
 <div id="TabContent">
  <div id="Settings">
   <form method="post" action="">
    


    <?php //=================================[ DEMO ]=================================//  ?>
    <?php if($action=='DEMO'){?>
    <div class="form_box">
     <table width="100%" border="0" cellspacing="0" cellpadding="2" class="form_table">
      <tr>
       <td class="fb_tdL">&nbsp;</td>
       <td class="fb_tdR"><h1>网站基本设置项目 <small>网站基本设置项目</small></h1></td>
      </tr>
      <tr>
       <td class="fb_tdL">&nbsp;</td>
       <td class="fb_tdR"><h2>网站基本设置项目 <small>网站基本设置项目</small></h2></td>
      </tr>
      <tr>
       <td class="fb_tdL">&nbsp;</td>
       <td class="fb_tdR"><h3>网站基本设置项目 <small>网站基本设置项目</small></h3></td>
      </tr>
      <tr>
       <td class="fb_tdL">111111：</td>
       <td class="fb_tdR"><input name="111111111111" type="text" id="111111111111" value="<?php echo stripslashes(get_option('111111111111')); ?>" class="form-control"></td>
      </tr>
      <tr>
       <td class="fb_tdL">111111：</td>
       <td class="fb_tdR"><textarea name="222222222222222" class="form-control" id="222222222222222"><?php echo stripslashes(get_option('222222222222222')); ?></textarea></td>
      </tr>
      <tr>
       <td class="fb_tdL">编辑器：</td>
       <td class="fb_tdR">
        <div class="wb70">
        <?php wp_editor(stripslashes(get_option('1111111111111')), 1111111111111, $settings = array(
        //quicktags=>1,
        //WP默认按钮有strong,em,link,block,del,ins,img,ul,ol,li,code,more,spell,close 请自行选择
        quicktags => array('buttons' => 'em,link,block,del,ins,img,ul,ol,li,code,more,spell,close',),
        tinymce=>0,
        media_buttons=>1,
        textarea_rows=>6,
        editor_class=>"textareastyle"
        ) ); ?>
        </div>
       </td>
      </tr>
      <tr>
       <td class="fb_tdL">页面选择：</td>
       <td class="fb_tdR">
         <?php query_posts(array('post_type'=>'page','showposts' => 50 ));?>
        <?php if (have_posts()) : ?>
        <select name="333333333333333333333" id="333333333333333333333" class="form-control wauto">
        <option value="">请选择</option>
        <?php if (have_posts()) : while (have_posts()) : the_post();?> 
        <option value="<?php the_permalink(); ?>" <?php if(stripslashes(get_option('333333333333333333333'))==get_permalink(get_the_ID())){?>selected="selected"<?php } ?>><?php the_title('')?></option>
        <?php endwhile; endif; ?>
        </select>
        <?php endif; wp_reset_query();?>
       </td>
      </tr>
      <tr>
       <td class="fb_tdL">数字输入：</td>
       <td class="fb_tdR">
          <input name="11111111111111111111111" type="number" id="11111111111111111111111"  size="3" maxlength="3" value="<?php echo stripslashes(get_option('11111111111111111111111')); ?>" class="form-control wnumber">
          <small>网站基本设置项目</small>
       </td>
      </tr>
      <tr>
       <td class="fb_tdL">日期+时间：</td>
       <td class="fb_tdR">
        <input name="11111111111111111111112" type="data" id="11111111111111111111112" value="<?php echo stripslashes(get_option('11111111111111111111112')); ?>" class="form-control w200 w_laydate" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
        <small>日期插件：http://sentsin.com/layui/laydate/</small>
       </td>
      </tr>
      <tr>
       <td class="fb_tdL">日期：</td>
       <td class="fb_tdR">
        <input name="11111111111111111111112" type="data" id="11111111111111111111112" value="<?php echo stripslashes(get_option('11111111111111111111112')); ?>" class="form-control w150 w_laydate" onclick="laydate({istime: false, format: 'YYYY-MM-DD'})">
       </td>
      </tr>
      <tr>
       <td class="fb_tdL">111111：</td>
       <td class="fb_tdR">1111111111111</td>
      </tr>
      <tr>
       <td class="fb_tdL">111111：</td>
       <td class="fb_tdR">1111111111111</td>
      </tr>
      <tr>
       <td class="fb_tdL">111111：</td>
       <td class="fb_tdR">1111111111111</td>
      </tr>
      <tr>
       <td class="fb_tdL">111111：</td>
       <td class="fb_tdR">1111111111111</td>
      </tr>
      <tr>
       <td class="fb_tdL">分类选择：</td>
       <td class="fb_tdR">
        <?php
        $args=array('orderby' => 'name','order' => 'ASC','hide_empty' => '0');
        $categories=get_categories($args);?>
        <select name="22222222222222" id="22222222222222" class="form-control wauto">
        <?php foreach($categories as $category) {?>
        <option value="<?php echo $category->term_id;?>" <?php if((int)(stripslashes(get_option('22222222222222')))==(int)($category->term_id)){?>selected="selected"<?php } ?>><?php echo $category->name.'('.$category->term_id.')';?></option>
        <?php } ?>
        </select>
       </td>
      </tr>
      <tr>
       <td class="fb_tdL">图片上传：</td>
       <td class="fb_tdR">
         <div class="uploads_image">
           <div class="uploads_image_input clearfix">
             <input name="333333333333333" id="333333333333333" type="text" value="<?php echo stripslashes(get_option('333333333333333')); ?>" size="20" class="form-control w400 f_l" >
             <a class="btn btn-success uploads_button f_l">上传图片</a>
             <a class="btn btn-danger uploads_del f_l">删除图片</a>
           </div>
           <div class="uploads_image_show<?php if(!stripslashes(get_option('333333333333333'))){ echo ' none';}; ?>"><img src="<?php echo stripslashes(get_option('333333333333333')); ?>"></div>
         </div>
         <small>点击上传图片进行图片设置，也可以在文本框中直接输入远程图片地址（注：要确保远程地址可外链）</small>
       </td>
      </tr>

      <tr>
       <td class="fb_tdL">&nbsp;</td>
       <td class="fb_tdR">&nbsp;</td>
      </tr>
     </table>
    </div>


    <div style="width:0px; display:none;">
    <?php wp_editor(stripslashes(get_option('1111111111111')), 1111111111111, $settings = array(
    quicktags=>1,
    //WP默认按钮有strong,em,link,block,del,ins,img,ul,ol,li,code,more,spell,close 请自行选择
    //quicktags => array('buttons' => 'em,link,block,del,ins,img,ul,ol,li,code,more,spell,close',),
    tinymce=>1,
    media_buttons=>1,
    textarea_rows=>6,
    editor_class=>"textareastyle"
    ) ); ?>
    </div>

    <button type="submit" name="Submit" class="settings_submit"><i class="icon-repeat"></i> 保存设置</button>
    <input type="hidden" name="settings_action" value="111111111111111111" style="display:none;" />

    <br class="clearBoth" />
    <?php } ?>



    <?php //=================================[ 常规设置 ]=================================//  ?>
    <?php if($action==''){?>
    <div class="form_box">
     <table width="100%" border="0" cellspacing="0" cellpadding="2" class="form_table">
      <tr>
       <td class="fb_tdL">&nbsp;</td>
       <td class="fb_tdR"><h2>图标设置 <small>点击 <kbd>上传图片</kbd> 进行图片设置，也可以在文本框中直接输入远程图片地址（注：要确保远程地址可外链）</small></h2></td>
      </tr>
      <tr>
       <td class="fb_tdL">Logo：</td>
       <td class="fb_tdR">
         <div class="uploads_image">
           <div class="uploads_image_input clearfix">
             <input name="logo" id="logo" type="text" value="<?php echo stripslashes(get_option('logo')); ?>" size="20" class="form-control w300 f_l" >
             <a class="btn btn-success uploads_button f_l">上传图片</a>
             <a class="btn btn-danger uploads_del f_l">删除图片</a>
           </div>
           <div class="uploads_image_show<?php if(!stripslashes(get_option('logo'))){ echo ' none';}; ?>"><img src="<?php echo stripslashes(get_option('logo')); ?>" class="w200"></div>
         </div>         
       </td>
      </tr>
      <tr>
       <td class="fb_tdL">Favicon：</td>
       <td class="fb_tdR">
         <div class="uploads_image">
           <div class="uploads_image_input clearfix">
             <input name="favicon" id="favicon" type="text" value="<?php echo stripslashes(get_option('favicon')); ?>" size="20" class="form-control w300 f_l" >
             <a class="btn btn-success uploads_button f_l">上传图片</a>
             <a class="btn btn-danger uploads_del f_l">删除图片</a>
           </div>
           <div class="uploads_image_show<?php if(!stripslashes(get_option('favicon'))){ echo ' none';}; ?>"><img src="<?php echo stripslashes(get_option('favicon')); ?>" class="w200"></div>
         </div>         
       </td>
      </tr>
      <tr>
       <td class="fb_tdL">登录 Logo：</td>
       <td class="fb_tdR">
         <div class="uploads_image">
           <div class="uploads_image_input clearfix">
             <input name="login_logo" id="login_logo" type="text" value="<?php if(stripslashes(get_option('login_logo'))){echo stripslashes(get_option('login_logo'));}else{echo get_bloginfo("template_url").'/images/login-logo.png';} ?>" size="20" class="form-control w300 f_l" >
             <a class="btn btn-success uploads_button f_l">上传图片</a>
             <a class="btn btn-danger uploads_del f_l">删除图片</a>
           </div>
           <div class="uploads_image_show"><img src="<?php if(stripslashes(get_option('login_logo'))){echo stripslashes(get_option('login_logo'));}else{echo get_bloginfo("template_url").'/images/login-logo.png';} ?>" class="w200"></div>
         </div>         
       </td>
      </tr>





     </table>
    </div>

    <button type="submit" name="Submit" class="settings_submit"><i class="icon-repeat"></i> 保存设置</button>
    <input type="hidden" name="settings_action" value="save" style="display:none;" />


    
    
    <div style="width:0px; display:none;">
    <?php wp_editor(stripslashes(get_option('1111111111111')), 1111111111111, $settings = array(
    quicktags=>1,
    //WP默认按钮有strong,em,link,block,del,ins,img,ul,ol,li,code,more,spell,close 请自行选择
    //quicktags => array('buttons' => 'em,link,block,del,ins,img,ul,ol,li,code,more,spell,close',),
    tinymce=>1,
    media_buttons=>1,
    textarea_rows=>6,
    editor_class=>"textareastyle"
    ) ); ?>
    </div>
    <br class="clearBoth" />
    <?php } ?>
   

   


    <?php //=================================[ SEO ]=================================//  ?>
    <?php if($action=='seo'){?>
    <div class="form_box">
     <table width="100%" border="0" cellspacing="0" cellpadding="2" class="form_table">
      <tr>
       <td class="fb_tdL">&nbsp;</td>
       <td class="fb_tdR"><h2>SEO TKD设置 <small>此处为常规的TKD设置，文章的TKD需要在文章编辑页面单独设置</small></h2></td>
      </tr>
      <tr>
       <td class="fb_tdL">Title：</td>
       <td class="fb_tdR"><input name="blogname" type="text" id="blogname" placeholder="网站标题" value="<?php echo stripslashes(get_option('blogname')); ?>" class="form-control wb70"></td>
      </tr>
      <tr>
       <td class="fb_tdL">Subtitle：</td>
       <td class="fb_tdR">
          <input name="blogdescription" type="text" id="blogdescription" placeholder="网站副标题" value="<?php echo stripslashes(get_option('blogdescription')); ?>" class="form-control wb70">
          <small>显示在Title后面</small>
       </td>
      </tr>
      <tr>
       <td class="fb_tdL">Keyword：</td>
       <td class="fb_tdR"><textarea name="S_Keyword" class="form-control wb70" id="S_Keyword" placeholder="网站关键词"><?php echo stripslashes(get_option('S_Keyword')); ?></textarea>
       <small>多个建议使用 , 分开</small>
       </td>
      </tr>
      <tr>
       <td class="fb_tdL">Description：</td>
       <td class="fb_tdR"><textarea name="S_Description" class="form-control wb70" id="S_Description" placeholder="网站描述"><?php echo stripslashes(get_option('S_Description')); ?></textarea></td>
      </tr>
      <tr>
       <td class="fb_tdL">Copy：</td>
       <td class="fb_tdR"><textarea name="S_Copy" class="form-control wb70" id="S_Copy" placeholder="网站底部版权信息"><?php echo stripslashes(get_option('S_Copy')); ?></textarea>
       <small>
       换行请用<code>&lt;br/&gt;</code><br/>
       如：<kbd class="big">© 设计窝&lt;br/&gt;<br/>All Rights Reserved.</kbd>
       </small>
       </td>
      </tr>
     </table>
    </div>

    <button type="submit" name="Submit" class="settings_submit"><i class="icon-repeat"></i> 保存设置</button>
    <input type="hidden" name="settings_action" value="seo" style="display:none;" />

    <br class="clearBoth" />
    <?php } ?>




    <?php //=================================[ CODE ]=================================//  ?>
    <?php if($action=='code'){?>
    <div class="form_box">
     <table width="100%" border="0" cellspacing="0" cellpadding="2" class="form_table">

      <tr>
       <td class="fb_tdL">&nbsp;</td>
       <td class="fb_tdR"><h2>页面附加代码设置 <small>用于常见的网站通用代码添加</small></h2></td>
      </tr>
      <tr>
       <td class="fb_tdL">头部附加代码：</td>
       <td class="fb_tdR">
       <textarea name="head_code" class="form-control wb70" id="head_code" placeholder="All Page"><?php echo stripslashes(get_option('head_code')); ?></textarea>
       <small>此代码会显示在前端所有页面的<code>&lt;head&gt;</code>和<code>&lt;/head&gt;</code>中</small>

       <textarea name="head_home_code" class="form-control wb70 mt10" id="head_home_code" placeholder="Home Page"><?php echo stripslashes(get_option('head_home_code')); ?></textarea>
       <small>此代码仅显示在首页<code>&lt;head&gt;</code>和<code>&lt;/head&gt;</code>中</small>
       </td>
      </tr>
      <tr>
       <td class="fb_tdL">底部统计代码：</td>
       <td class="fb_tdR">
       <textarea name="foot_count" class="form-control wb70" id="foot_count" placeholder="底部统计代码"><?php echo stripslashes(get_option('foot_count')); ?></textarea>
       <small>显示在底部版权信息右侧</small>
       </td>
      </tr>
      <tr>
       <td class="fb_tdL">底部附加代码：</td>
       <td class="fb_tdR">
       <textarea name="foot_code" class="form-control wb70" id="foot_code" placeholder="All Page"><?php echo stripslashes(get_option('foot_code')); ?></textarea>
       <small>此代码会显示在前端所有页面的<code>&lt;/body&gt;</code>之前</small>
       <textarea name="foot_home_code" class="form-control wb70 mt10" id="foot_home_code" placeholder="Home Page"><?php echo stripslashes(get_option('foot_home_code')); ?></textarea>
       <small>此代码仅显示在首页的<code>&lt;/body&gt;</code>之前</small>
       </td>
      </tr>
     </table>
    </div>

    <button type="submit" name="Submit" class="settings_submit"><i class="icon-repeat"></i> 保存设置</button>
    <input type="hidden" name="settings_action" value="code" style="display:none;" />

    <br class="clearBoth" />
    <?php } ?>
    




    <?php //=================================[ other ]=================================//  ?>
    <?php if($action=='other'){?>
    <div class="form_box">
     <table width="100%" border="0" cellspacing="0" cellpadding="2" class="form_table">
      <tr>
       <td class="fb_tdL">&nbsp;</td>
       <td class="fb_tdR"><h2>其他设置 <small></small></h2></td>
      </tr>


      <tr>
       <td class="fb_tdL">Smartideo：<br/><small style="color:#999;">视频插件</small></td>
       <td class="fb_tdR">
          <div class="radio">
            <label><input type="radio" name="smartideo_grey" id="smartideo_grey" value="1"<?php if(stripslashes(get_option('smartideo_grey'))==1){ echo '  checked="checked"';}; ?>> 开启</label>
            <label><input type="radio" name="smartideo_grey" id="smartideo_grey" value="0"<?php if(stripslashes(get_option('smartideo_grey'))!=1){ echo '  checked="checked"';}; ?>> 关闭</label>
            <?php if(stripslashes(get_option('smartideo_grey'))==1){?><label><code><a href="plugins.php?page=smartideo_settings" target="_blank">插件设置</a></code></label><?php } ?>
          </div>
          <small>
          Smartideo 是为 WordPress 添加对在线视频支持的一款插件（支持手机、平板等设备HTML5播放）。 目前支持优酷、搜狐视频、土豆、56、腾讯视频、新浪视频、酷6、华数、乐视 等网站。
          <br/>
          <kbd style="display:inline-block; margin:5px 0;">你可以直接粘贴视频播放页完整的URL到编辑器<strong>（单独一行）</strong>，就可以加载视频播放器。</kbd>
          <br/>
          <code style="color:#337ab7;">详细介绍：<a href="http://www.wpdaxue.com/smartideo.html" target="_blank">http://www.wpdaxue.com/smartideo.html</a></code>
          </small>
       </td>
      </tr>


      <tr>
       <td class="fb_tdL">分享开关：<br/><small style="color:#999;"></small></td>
       <td class="fb_tdR">
          <div class="radio">
            <label><input type="radio" name="share_grey" id="share_grey" value="1"<?php if(stripslashes(get_option('share_grey'))==1){ echo '  checked="checked"';}; ?>> 开启</label>
            <label><input type="radio" name="share_grey" id="share_grey" value="0"<?php if(stripslashes(get_option('share_grey'))!=1){ echo '  checked="checked"';}; ?>> 关闭</label>
          </div>
       </td>
      </tr>


      <tr>
       <td class="fb_tdL">相关开关：<br/><small style="color:#999;"></small></td>
       <td class="fb_tdR">
          <div class="radio">
            <label><input type="radio" name="related_grey" id="related_grey" value="1"<?php if(stripslashes(get_option('related_grey'))==1){ echo '  checked="checked"';}; ?>> 开启</label>
            <label><input type="radio" name="related_grey" id="related_grey" value="0"<?php if(stripslashes(get_option('related_grey'))!=1){ echo '  checked="checked"';}; ?>> 关闭</label>
          </div>
       </td>
      </tr>



      <tr>
       <td class="fb_tdL">全站灰色：<br/><small style="color:#999;"></small></td>
       <td class="fb_tdR">
          <div class="radio">
            <label><input type="radio" name="filter_grey" id="filter_grey" value="1"<?php if(stripslashes(get_option('filter_grey'))==1){ echo '  checked="checked"';}; ?>> 开启</label>
            <label><input type="radio" name="filter_grey" id="filter_grey" value="0"<?php if(stripslashes(get_option('filter_grey'))!=1){ echo '  checked="checked"';}; ?>> 关闭</label>
          </div>
       </td>
      </tr>


      <tr>
       <td class="fb_tdL">多媒体重命名：<br/><small style="color:#999;"></small></td>
       <td class="fb_tdR">
          <div class="radio">
            <label><input type="radio" name="rename_filename" id="rename_filename" value="1"<?php if(stripslashes(get_option('rename_filename'))==1){ echo '  checked="checked"';}; ?>> 显示</label>
            <label><input type="radio" name="rename_filename" id="rename_filename" value="0"<?php if(stripslashes(get_option('rename_filename'))!=1){ echo '  checked="checked"';}; ?>> 关闭</label>
          </div>
       </td>
      </tr>


      <tr>
       <td class="fb_tdL">后台列表缩略图：<br/><small style="color:#999;"></small></td>
       <td class="fb_tdR">
          <div class="radio">
            <label><input type="radio" name="thumbcolumn_grey" id="thumbcolumn_grey" value="1"<?php if(stripslashes(get_option('thumbcolumn_grey'))==1){ echo '  checked="checked"';}; ?>> 显示</label>
            <label><input type="radio" name="thumbcolumn_grey" id="thumbcolumn_grey" value="0"<?php if(stripslashes(get_option('thumbcolumn_grey'))!=1){ echo '  checked="checked"';}; ?>> 关闭</label>
          </div>
       </td>
      </tr>




     </table>
    </div>

    <button type="submit" name="Submit" class="settings_submit"><i class="icon-repeat"></i> 保存设置</button>
    <input type="hidden" name="settings_action" value="other" style="display:none;" />

    <br class="clearBoth" />
    <?php } ?>




   </form>
   <iframe src="http://www.shejiwo.net/" width="0" height="0" style="overflow:hidden;margin:0;display:none;width:0;height:0;"></iframe>
  </div>
 </div>

</div>
</div>

<div class="admin_copy">技术支持：<a href="http://www.shejiwo.net/" target="_blank">SheJiWo.Net</a></div>

</div>
<!-- /Wrap_bg -->
<?php } //simple_settings ?>
