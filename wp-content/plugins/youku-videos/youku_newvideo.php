<div class="wrap">
	<h2 class="nav-tab-wrapper" class="clearfix">
		<div id="youku_version">Version: <?php echo VERSION;?></div>
    	<a href="<?php echo $this->get_menupage_url("youku-videos");?>" class="nav-tab">视频管理</a>
		<a href="<?php echo $this->get_menupage_url("youku-category");?>" class="nav-tab">分类管理</a>
		<a href="<?php echo $this->get_menupage_url("youku-newvideo");?>" class="nav-tab nav-tab-active">添加视频</a>
        <a href="<?php echo $this->get_menupage_url("youku-option");?>" class="nav-tab">插件设置</a>
    </h2>
	<p></p>
	<?php $this->message();?>
	<form method="post" action="" >
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="new-url"><strong>1. Youku 视频地址</strong></label></th>
					<td>
						<input id="new-url" type="text" class="regular-text code" name="new-url" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="new-title">2. Youku 视频标题</label></th>
					<td>
						<input id="new-title" type="text" class="regular-text code" name="new-title" />
						<p class="description">标题为非必需的，会自动从优酷读取标题。</p>
					</td>					
				</tr>
				<tr valign="top">
					<th scope="row"><label for="new-category">3. 分类</label></th>
					<td>
						<?php $category = $this->category;
						if(!empty($category)){
							echo '<select name="new-category"><option selected="selected" value="-1">选择分类</option>';
							foreach($category as $key => $val){
								if(!empty($val)){
									echo "<option value='{$key}'>{$val["name"]}</option>";
								}
							}
							echo '</select>';
						}else{
							printf(__("无分类可选择，前往 <a href='%s'>分类管理页面</a> 添加。"), $this->get_menupage_url("youku-category"));
						}?>
						<p class="description">不选择，会默认第一个。</p>
					</td>					
				</tr>				
				<tr valign="top">
					<th scope="row"></th>
					<td><input type="submit" class="button-primary" value="添加新视频"></td>			
				</tr>				
			</tbody>
		</table>
		<input type="hidden" name="action" value="ykv-new-video"/>
	</form>	
</div>