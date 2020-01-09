<?php

	add_action('admin_menu', 'mfthemes_admin_menu');
	function mfthemes_admin_menu() {
		add_theme_page('主题设置', '主题设置', 'edit_themes', basename(__FILE__), 'mfthemes_settings_page');
		add_action( 'admin_init', 'mfthemes_settings' );
	}


	function mfthemes_settings() {
		register_setting( 'mfthemes-settings-group', 'mfthemes_options' );
	}

	function mfthemes_settings_page() {
		if ( isset($_REQUEST['settings-updated']) ) echo '<div id="message" class="updated fade"><p><strong>主题设置已保存.</strong></p></div>';
		if( 'reset' == isset($_REQUEST['reset']) ) {
			delete_option('mfthemes_options');
			echo '<div id="message" class="updated fade"><p><strong>主题设置已重置!</strong></p></div>';
		}
	?>

		<div class="wrap">
			<div id="icon-options-general" class="icon32"><br></div><h2>主题设置</h2><br>
			<form method="post" action="options.php">
				<?php settings_fields( 'mfthemes-settings-group' ); ?>
				<?php $options = get_option('mfthemes_options');?>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label>网站描述</label></th>
							<td>
								<p>用简洁凝练的话对你的网站进行描述</p>
								<p><textarea type="textarea" class="large-text" name="mfthemes_options[description]"><?php echo $options['description']; ?></textarea></p>
							</td>
						</tr>	
						<tr valign="top">
							<th scope="row"><label>网站关键词</label></th>
							<td>
								<p>多个关键词请用英文逗号隔开</p>
								<p><textarea type="textarea" class="large-text" name="mfthemes_options[keywords]"><?php echo $options['keywords']; ?></textarea></p>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label>在首页展示 四个最新视频</label></th>
							<td>
								<p><input id="video" type="checkbox" name="mfthemes_options[video]" value="1" <?php if($options['video']) echo 'checked="checked"'; ?>/> <label for="video">勾选后 在首页展示 四个最新视频</label></p>
							</td>
						</tr>						
						<tr valign="top">
							<th scope="row"><label>使用全站导航</label></th>
							<td>
								<p><input id="global_nav" type="checkbox" name="mfthemes_options[global_nav]" value="1" <?php if($options['global_nav']) echo 'checked="checked"'; ?>/> <label for="global_nav">勾选后 使用全站导航</label></p>
							</td>
						</tr>				
						<tr valign="top">
							<th scope="row"><label>全站导航标签数量</label></th>
							<td>
								<p><input id="tagnumber" name="mfthemes_options[tagnumber]" type="number" step="1" min="1" max="50" value="<?php echo $options['tagnumber'] ? $options['tagnumber'] : 25;?>" class="small-text"  /> <label for="tagnumber">默认热门标签数量为25，最小为1，最大为50</label></p>
							</td>
							<link rel="stylesheet" id="admin-style-css" href="<?php echo TPLDIR . '/script/admin/admin.css'; ?>" type="text/css" media="screen">
							<script type="text/javascript" src="<?php echo TPLDIR . '/script/admin/admin.js'; ?>"></script>
						</tr>					
					</tbody>
				</table>			
				<div class="mfthemes_submit_form">
					<input type="submit" class="button-primary mfthemes_submit_form_btn" name="save" value="<?php _e('Save Changes') ?>"/>
				</div>
			</form>
			<form method="post">
				<div class="mfthemes_reset_form">
					<input type="submit" name="reset" value="<?php _e('Reset') ?>" class="button-secondary mfthemes_reset_form_btn"/> 重置有风险，操作需谨慎！
					<input type="hidden" name="reset" value="reset" />
				</div>
			</form>
		</div>
	<?php }
	
	add_action( 'tgmpa_register', 'mfthemes_required_plugins' );
	/*  Register required plugins  */
	if(!function_exists('mfthemes_required_plugins')){
		function mfthemes_required_plugins() {
			$plugins = array(
				array(
					'name'     				=> 'YoukuVideos', // The plugin name
					'slug'     				=> 'youku-videos', // The plugin slug (typically the folder name)
					'source'   				=> '/youku-videos.zip', // The plugin source
					'required' 				=> false,
					'version' 				=> '',
					'force_activation' 		=> true,
					'force_deactivation' 	=> true
				),
				array(
					'name'     				=> 'WP-PostViews ',
					'slug'     				=> 'wp-postviews',
					'required' 				=> false,
				),				
			);
		
		
			/**
			 * Array of configuration settings. Amend each line as needed.
			 * If you want the default strings to be available under your own theme domain,
			 * leave the strings uncommented.
			 * Some of the strings are added into a sprintf, so see the comments at the
			 * end of each line for what each argument will be.
			 */
			$config = array(
				'domain'       		=> 'mfthemes',         	// Text domain - likely want to be the same as your theme.
				'default_path' 		=> TPLDIR.'/plugins',                       	// Default absolute path to pre-packaged plugins
				'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
				'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
				'menu'         		=> 'install-required-plugins', 	// Menu slug
				'has_notices'      	=> true,                       	// Show admin notices or not
				'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
				'message' 			=> '',							// Message to output right before the plugins table				
				'strings'      		=> array(
					'page_title'                       			=> __( '安装推荐插件', 'mfthemes' ),
					'menu_title'                       			=> __( '安装插件', 'mfthemes' ),
					'installing'                       			=> __( '正在安装插件: %s', 'mfthemes' ), // %1$s = plugin name
					'oops'                             			=> __( '出错了.', 'mfthemes' ),
					'notice_can_install_required'     			=> _n_noop( '主题需要安装下面的插件: %1$s.', 'mfthemes主题需要安装下面的插件: %1$s.' ), // %1$s = plugin name(s)
					'notice_can_install_recommended'			=> _n_noop( '主题推荐安装下面的插件: %1$s.', 'mfthemes主题推荐安装下面的插件: %1$s.' ), // %1$s = plugin name(s)
					'notice_cannot_install'  					=> _n_noop( '对不起，您没有权限安装%s插件.请联系网站管理员安装.', '对不起，您没有权限安装%s插件.请联系网站管理员安装..' ), // %1$s = plugin name(s)
					'notice_can_activate_required'    			=> _n_noop( '必需的插件没有被启用: %1$s.', '必需的插件没有被启用: %1$s.' ), // %1$s = plugin name(s)
					'notice_can_activate_recommended'			=> _n_noop( '推荐的插件没有被启用: %1$s.', '推荐的插件没有被启用: %1$s.' ), // %1$s = plugin name(s)
					'notice_cannot_activate' 					=> _n_noop( '对不起，您没有权限启用%s插件，请联系网站管理员启用插件.', '对不起，您没有权限启用%s插件，请联系网站管理员启用插件.' ), // %1$s = plugin name(s)
					'notice_ask_to_update' 						=> _n_noop( '为了获得最好的兼容性，请更新插件（注意：更新后将不再是汉化版本）: %1$s.', '为了获得最好的兼容性，请更新插件（注意：更新后将不再是汉化版本）: %1$s.' ), // %1$s = plugin name(s)
					'notice_cannot_update' 						=> _n_noop( '对不起，您没有权限更新%s插件，请联系网站管理员更新d.', '对不起，您没有权限更新%s插件，请联系网站管理员更新。' ), // %1$s = plugin name(s)
					'install_link' 					  			=> _n_noop( '开始安装插件', '开始安装插件' ),
					'activate_link' 				  			=> _n_noop( '启用已安装的插件。', '启用已安装的插件' ),
					'return'                           			=> __( '继续安装推荐插件。', 'mfthemes' ),
					'plugin_activated'                 			=> __( '成功开启插件。', 'mfthemes' ),
					'complete' 									=> __( '所有插件已成功安装并开启 %s。', 'mfthemes' ), // %1$s = dashboard link
					'nag_type'									=> 'updated', // Determines admin notice type - can only be 'updated' or 'error'
					'dismiss'									=> '不再提示'
				)
			);
			tgmpa($plugins, $config);
		}
	}	