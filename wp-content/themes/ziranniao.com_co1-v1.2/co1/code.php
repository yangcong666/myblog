<?php
	require_once($_SERVER['DOCUMENT_ROOT']. '/wp-load.php'); //使本文件可以使用WP自带的方法和属性
	$post_id = $_GET[id];
	$queried_post = get_post($post_id);
	get_custom_field_value($_GET[id], 'code',true,"该页面不存在演示代码");
?>