<div class="wrap">
	<h2 class="nav-tab-wrapper" class="clearfix">
		<div id="youku_version">Version: <?php echo VERSION;?></div>
    	<a href="<?php echo $this->get_menupage_url("youku-videos");?>" class="nav-tab">视频管理</a>
		<a href="<?php echo $this->get_menupage_url("youku-category");?>" class="nav-tab nav-tab-active">分类管理</a>
		<a href="<?php echo $this->get_menupage_url("youku-newvideo");?>" class="nav-tab">添加视频</a>
        <a href="<?php echo $this->get_menupage_url("youku-option");?>" class="nav-tab">插件设置</a>
    </h2>
	<p></p>
	<?php $this->message();?>
	<h3>所有分类</h3>
	<table class="category">
		<thead><tr><th class="pding">分类名称</th><th>分类别名</th><th>视频数量</th><th>操作</th></tr></thead>
		<tbody>
		<?php $category = $this->category;
			if(!empty($category)){
				foreach($category as $key => $val){
					if(!empty($val)){?>
						<tr>
							<td class="pding"><?php echo $val["name"];?></td>
							<td><?php echo $val["slug"];?></td>
							<td><?php echo $this->category_count($key);?></td>
							<td><?php printf('<a href="%s&action=%s&cat_id=%s">删除</a>', $this->get_menupage_url("youku-category"), 'ykv-category-delete', $key);?></td>
						</tr>
					<?php }
				}
			}
		?>
		</tbody>
	</table>
	<h3>添加新分类</h3>
	<form method="post" action="" >
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="catname">1. 新分类名称</label></th>
					<td>
						<input id="catname" type="text" class="regular-text code" name="catname" />
						<p class="description">这将是它在站点上显示的名字。</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="catslug">2. 新分类别名</label></th>
					<td>
						<input id="catslug" type="text" class="regular-text code" name="catslug" />
						<p class="description">“别名”是在 URL 中使用的别称，它可以令 URL 更美观。通常使用小写，只能包含字母，数字和连字符（-）。</p>
					</td>					
				</tr>
				<tr valign="top">
					<th scope="row"></th>
					<td><input type="submit" class="button-primary" value="添加新分类"></td>					
				</tr>				
			</tbody>
		</table>
		<input type="hidden" name="action" value="ykv-new-category"/>
	</form>
</div>