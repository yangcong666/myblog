<div class="wrap">
	<h2 class="nav-tab-wrapper" class="clearfix">
		<div id="youku_version">Version: <?php echo VERSION;?></div>
    	<a href="<?php echo $this->get_menupage_url("youku-videos");?>" class="nav-tab nav-tab-active">视频管理</a>
		<a href="<?php echo $this->get_menupage_url("youku-category");?>" class="nav-tab">分类管理</a>
		<a href="<?php echo $this->get_menupage_url("youku-newvideo");?>" class="nav-tab">添加视频</a>
        <a href="<?php echo $this->get_menupage_url("youku-option");?>" class="nav-tab">插件设置</a>
    </h2>	
	<p></p>
	<?php $this->message();$cat_id = $_GET["category"];?>
	<form id="myListTable" method="post" action="" cataction="<?=$cat_id;?>">
		<?php
			$myListTable = new YKV_List_Table();
			$myListTable->prepare_items($cat_id);
			$myListTable->display(); 
		?>
	</form>
</div>