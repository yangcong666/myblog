<?php
global $YKV;
require dirname(__FILE__).'/class.youku.php';
if(!isset($YKV)){
	$YKV = new youku();
}

function the_youku(){
	global $YKV;
	$YKV->display();
}

function the_youku_four(){
	global $YKV;
	$YKV->display_four();
}

// Add shortcode
function ykv_shortcode($atts, $content=null){
	extract(shortcode_atts(array(), $atts));	
	return the_youku();
}

if( is_page() ):
	add_shortcode('the_youku','ykv_shortcode');
endif;