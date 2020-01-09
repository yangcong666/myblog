<?php

$themename = $danme.'主题';

$options = array (

	//基本设置
	array( "name" => "基本设置","type" => "section","desc" => "主题的基本设置，包括模块是否开启等"),

	array( "name" => "升级/维护提醒","type" => "tit" ),	
	array( "id" => "co_onlytip_b","type" => "checkbox" ),
	array( "id" => "co_onlytip","type" => "textarea","std" => "友情提示：本站升级维护中，如给您带来不便，还望谅解！" ),

	array( "name" => "网站描述","type" => "tit"),
	array( "id" => "co_description","type" => "text","std" => "输入你的网站描述，一般不超过200个字符"),
	
	array( "name" => "网站关键字","type" => "tit"),	
	array( "id" => "co_keywords","type" => "text","std" => "输入你的网站关键字，一般不超过100个字符。 关键字之间用 ',' 隔开"),
	array( "name" => "新浪微博","type" => "tit"),
	
	array( "id" => "co_weibo","type" => "text","class" => "co_inp_short","std" => "http://weibo.com/lyushine"),

	array( "name" => "腾讯微博","type" => "tit"),
	array( "id" => "co_tqq","type" => "text","class" => "co_inp_short","std" => "http://t.qq.com/lyushine"),
	
	array( "name" => "流量统计代码","type" => "tit"),
	array( "id" => "co_track_b","type" => "checkbox" ),
	array( "id" => "co_track","type" => "textarea","std" => "百度统计、CNZZ、51啦、量子统计等等"),

	array( "name" => "评论头像缓存","type" => "tit"),	
	array( "id" => "co_avatar_b","type" => "checkbox" ),
	array( "type" => "endtag"),


);

function mytheme_add_admin() {
	global $themename, $options;
	if ( $_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
			}
			header("Location: admin.php?page=cotheme.php&saved=true");
			die;
		}
		else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($options as $value) {delete_option( $value['id'] ); }
			header("Location: admin.php?page=cotheme.php&reset=true");
			die;
		}
	}
	add_theme_page($themename."设置", $themename."设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin() {
	global $themename, $options;
	$i=0;
	if ( $_REQUEST['saved'] ) echo '<div class="co_message">'.$themename.'修改已保存</div>';
	if ( $_REQUEST['reset'] ) echo '<div class="co_message">'.$themename.'已恢复设置</div>';
?>

	<script type="text/javascript">
		(function(){
			var init, ed, qt, first_init, mce = true;

			if ( typeof(tinymce) == 'object' ) {
				// mark wp_theme/ui.css as loaded
				tinymce.DOM.files[tinymce.baseURI.getURI() + '/themes/advanced/skins/wp_theme/ui.css'] = true;

				for ( ed in tinyMCEPreInit.mceInit ) {
					if ( first_init ) {
						init = tinyMCEPreInit.mceInit[ed] = tinymce.extend( {}, first_init, tinyMCEPreInit.mceInit[ed] );
					} else {
						init = first_init = tinyMCEPreInit.mceInit[ed];
					}

					if ( mce )
						try { tinymce.init(init); } catch(e){}
				}
			}

			if ( typeof(QTags) == 'function' ) {
				for ( qt in tinyMCEPreInit.qtInit ) {
					try { quicktags( tinyMCEPreInit.qtInit[qt] ); } catch(e){}
				}
			}
		})();

		var wpActiveEditor;

		jQuery('.wp-editor-wrap').mousedown(function(e){
			wpActiveEditor = this.id.slice(3, -5);
		});

	</script>
	<link rel="stylesheet" href="<?php bloginfo('template_url') ?>/option/cotheme.css"/>

<div class="wrap co_wrap">
	<h2><?php echo $themename; ?>设置
	</h2>
	
	<form method="post">
		<div class="co_tab"><a class="co_tab_on">基本设置</a></div>
		<?php foreach ($options as $value) { switch ( $value['type'] ) { case "": ?>
			<?php break; case "tit": ?>
			
			</li><li class="co_li">
			<h4><?php echo $value['name']; ?>：</h4>
			
			<?php break; case 'text': ?>
			<?php if ( $value['desc'] != "") { ?><label class="co_the_desc"><?php echo $value['desc']; ?></label><?php } ?><input class="co_inp <?php echo $value['class']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
			
			<?php break; case 'textarea': ?>
			<textarea class="co_tarea" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
			
			<?php break; case 'select': ?>
			<?php if ( $value['desc'] != "") { ?><span class="co_the_desc" id="<?php echo $value['id']; ?>_desc"><?php echo $value['desc']; ?></span><?php } ?><select class="co_sel" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
				<?php foreach ($value['options'] as $option) { ?>
				<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected" class="co_sel_opt"'; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
			
			<?php break; case "checkbox": ?>
			<?php if(get_settings($value['id']) != ""){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
			<label class="co_check"><input type="checkbox" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>" <?php echo $checked; ?> />开启</label>
			
			<?php break; case "section": $i++; ?>
			<div class="co_mainbox" id="d_mainbox_<?php echo $i; ?>">
				<div class="co_desc"><input class="button-primary" name="save<?php echo $i; ?>" type="submit" value="保存设置" /><?php echo $value['desc']; ?></div>
				<ul class="co_inner">
					<li class="co_li">
				
			<?php break; case "endtag": ?>
			</li></ul>
			<div class="co_desc d_desc_b"><input class="button-primary" name="save<?php echo $i; ?>" type="submit" value="保存设置" /></div>
			</div>
			
		<?php break; }} ?>
				
		<input type="hidden" name="action" value="save" />
		
		<div class="co_popup d_export">
			<h3><input class="button-primary" type="button" value="关闭" /><?php echo $themename; ?>设置-导出：</h3>
			<h4>妥善保管好您导出的数据，否则您就要一条条的添加！</h4>
			<p><textarea onmouseover="this.focus();this.select();" disabled="true" name="" id="" cols="30" rows="10"></textarea></p>
		</div>
		<div class="co_popup d_import">
			<h3><input class="button-primary" type="button" value="立即导入" /><?php echo $themename; ?>设置-导入：</h3>
			<h4>贴入您之前保存的导出数据，点击“立即导入”，确定导入成功后再保存！</h4>
			<p><textarea onmouseover="this.focus();this.select();" name="" id="" cols="30" rows="10"></textarea></p>
		</div>
	</form>
<script src="<?php bloginfo('template_url') ?>/js/jquery.min.js"></script>
<script src="<?php bloginfo('template_url') ?>/option/cotheme.js"></script>
</div>
<?php } ?>
<?php add_action('admin_menu', 'mytheme_add_admin');?>