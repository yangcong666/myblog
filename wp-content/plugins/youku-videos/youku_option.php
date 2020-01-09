<div class="wrap">
	<h2 class="nav-tab-wrapper" class="clearfix">
		<div id="youku_version">Version: <?php echo VERSION;?></div>
    	<a href="<?php echo $this->get_menupage_url("youku-videos");?>" class="nav-tab">视频管理</a>
		<a href="<?php echo $this->get_menupage_url("youku-category");?>" class="nav-tab">分类管理</a>
		<a href="<?php echo $this->get_menupage_url("youku-newvideo");?>" class="nav-tab">添加视频</a>
        <a href="<?php echo $this->get_menupage_url("youku-option");?>" class="nav-tab nav-tab-active">插件设置</a>
    </h2>
	<p></p>
	<?php $this->message(); $config = $this->config; $config_name = $config["pagename"];?>
	<form method="post" action="" >
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="url">1. 视频页面地址</label></th>
					<td>
						<select name="pagename" id="pagename">
							<?php $pages = get_pages(array('post_type' => 'page','post_status' => 'publish')); 
								foreach($pages as $val){
									$selected = ($val->post_name == $config_name)? 'selected="selected"' : "";
									$page_title = $val->post_title;
									$page_name = $val->post_name;
									echo "<option class='level-0' value='{$page_name}' {$selected}>{$page_title}</option>";
								}
							?>
						</select>
						<strong> （分页需要，必须选择！）</strong>
						<?php if($config_name){
							$plink = $this->get_pagelink();
						?>
							<p class="description">页面地址：<a href="<?=$plink;?>" target="_blank"><?=$plink;?></a></p>
						<?php }?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="number">2. 视频数量设置</label></th>
					<td>
						<p>每页 总数量：<input name="number" type="number" step="1" min="1" id="number" value="<?php echo $config["number"];?>" class="small-text"><span>  默认每页 12 个视频；</span></p>
						<p>每行 数量：<input name="row" type="number" step="1" min="1" id="rowr" value="<?php echo $config["row"];?>" class="small-text"><span>  默认每行 4 个视频；</span></p>
					</td>					
				</tr>
				<tr valign="top">
					<th scope="row"><label for="time">3. 是否显示时长</label></th>
					<td>
						<p><input name="time" type="checkbox" id="time" value="1" <?php if($config["time"]) echo 'checked="checked"';?>><label for="time"> 显示视频时长</label><span>  （此选项默认开启）</span></p>
					</td>					
				</tr>
				<tr valign="top">
					<th scope="row"><label for="swf_url">4. Flash 播放器地址</label></th>
					<td>
						<textarea id="swf_url" cols="80" rows="2" type="text" name="swf_url"><?=$config["swf_url"];?></textarea>
						<p class="description">默认为：<code>优酷自带播放器</code>，无广告播放器可以从<a href="http://mufeng.me/youku-videos.html" target="_blank">http://mufeng.me/youku-videos.html</a>来获取，<br />也自行可以上传 <code> loader.swf + player.swf </code>，然后将<code>loader.swf</code>的地址填写到上面的输入框！</p>
					</td>
				</tr>				
				<tr valign="top">
					<th scope="row">
						<input type="submit" name="empty-config" class="button" value="清空设置">
					</th>
					<td>
						<input type="submit" class="button-primary" value="保存设置">
					</th>
				</tr>				
			</tbody>
		</table>
		<input type="hidden" name="action" value="ykv-update-config"/>
	</form>
</div>