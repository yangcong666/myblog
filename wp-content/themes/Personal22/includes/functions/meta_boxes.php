<?php




//为WordPress添加自定义域可视化面板



//=======================文章设置=======================
$post_meta_boxes =
array(
"keywords" => array("name" => "keywords","std" => "","title" => "关键字:","style" => "textarea"),
"description" => array("name" => "description","std" => "","title" => "网页描述:","style" => "textarea")
);

//创建自定义字段输入框
function post_meta_boxes() {
global $post, $post_meta_boxes; ?>
<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/includes/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/includes/theme-option.js"></script>
<table width="100%" border="0" cellspacing="0" cellpadding="5" style="font-family: 微软雅黑; font-size:14px;">
<style>.the_text{ line-height:20px;font-size:14px;}#poststuff h3, .metabox-holder h3{font-family: 微软雅黑; font-weight:100;}</style>
<?php foreach($post_meta_boxes as $meta_box) {
$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
if($meta_box['toptitle']){ ?>
<tr><td width="150" align="right" valign="top"></td><td align="left"  valign="top" style="padding:0px 2px;"><h2 style="font-size:16px;font-weight:200;padding:10px 2px 0; margin:0;font-family: 微软雅黑;color: #38A1B6;"><?php echo $meta_box['toptitle'];?></h2></td></tr>
<?php }
echo "<tr>";
if($meta_box_value == "")$meta_box_value = $meta_box['std'];
echo '<td width="150" align="right" valign="top">';

echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
echo'<label for="'.$meta_box['name'].'_value"><h4 style="font-size:14px;font-weight:200;padding:10px 2px 2px; margin:0;font-family: 微软雅黑;">'.$meta_box['title'].'</h4></label>';
echo '</td><td align="left"  valign="top" style="padding:10px 2px 2px;">';

if($meta_box['style']=='textarea'){
echo '<textarea cols="70" rows="3" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea>';
}elseif($meta_box['style']=='input'){
echo '<input name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" type="text" value="'.$meta_box_value.'" size="70" placeholder="'.$meta_box['placeholder'].'"  class="the_text">';
}elseif($meta_box['style']=='input2'){
echo '<input name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" type="text" value="'.$meta_box_value.'" size="50" placeholder="'.$meta_box['placeholder'].'" class="the_text">';
}elseif($meta_box['style']=='input3'){
echo '<input name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" type="text" value="'.$meta_box_value.'" size="20" placeholder="'.$meta_box['placeholder'].'" class="the_text">';
}elseif($meta_box['style']=='input_price'){
echo '<input name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" type="text" value="'.$meta_box_value.'" size="20" placeholder="'.$meta_box['placeholder'].'" class="the_text">';
}elseif($meta_box['style']=='checkbox'){ 
?><input name="<?php echo $meta_box['name'].'_value';?>" id="<?php echo $meta_box['name'].'_value';?>" type="checkbox" <?php if($meta_box_value){echo 'checked';}?> style="margin-top:5px;"><?php 
}elseif($meta_box['style']=='pro_img'){ ?>
<div class="paperdino-input-image"><input name="<?php echo $meta_box['name'].'_value';?>" id="<?php echo $meta_box['name'].'_value';?>" type="text" value="<?php echo $meta_box_value;?>" size="54"> &nbsp;<div class="button">Upload Image</div><br><img src="<?php echo $meta_box_value;?>"><br><a>删除图片</a></div>
<?php  }if($meta_box['points']){echo '<span style="font-size:12px; color:#999;display:block;padding:2px 0px;">'.$meta_box['points'].'</span>';}echo '</td>';}?>
<?php echo '</tr></table>';}




//=======================焦点图设置=======================
$banner_meta_boxes =
array(
"url" => array("name" => "url","std" => "","title" => "图片所指向网址","style" => "input","points" => "需要加上http:// <em>(如：http://www.shejiwo.net)</em>"),
"newin" => array("name" => "newin","std" =>"","title" => "网址是否新窗口","style" =>"checkbox")
);
function banner_meta_boxes() {
global $post, $banner_meta_boxes; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" style="font-family: 微软雅黑; font-size:14px;"><style>.the_text{ line-height:20px;font-size:14px;}#poststuff h3, .metabox-holder h3{font-family: 微软雅黑; font-weight:100;}#edit-slug-box,.notice-success a{display: none;}</style><?php foreach($banner_meta_boxes as $meta_box) {
$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
echo "<tr>";if($meta_box_value == "")$meta_box_value = $meta_box['std'];
echo '<td width="150" align="right" valign="top">';
echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
echo'<label for="'.$meta_box['name'].'_value"><h4 style="font-size:14px;font-weight:200;padding:2px 2px; margin:0;font-family: 微软雅黑;">'.$meta_box['title'].'：</h4></label>';
echo '</td><td align="left"  valign="top" style="padding:2px 2px;">';
if($meta_box['style']=='input'){
echo '<input name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" type="text" value="'.$meta_box_value.'" size="70" placeholder="'.$meta_box['placeholder'].'"  class="the_text">';
}elseif($meta_box['style']=='input3'){
echo '<input name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" type="text" value="'.$meta_box_value.'" size="20" placeholder="'.$meta_box['placeholder'].'" class="the_text">';
}elseif($meta_box['style']=='checkbox'){ 
?><input name="<?php echo $meta_box['name'].'_value';?>" id="<?php echo $meta_box['name'].'_value';?>" type="checkbox" <?php if($meta_box_value){echo 'checked';}?> style=" margin-top:5px;"><?php 
}if($meta_box['points']){echo '<span style="font-size:12px; color:#999;display:block;padding:2px 0px;">'.$meta_box['points'].'</span>';}echo '</td>';} echo '</tr></table>';}





//创建自定义字段模块
function create_meta_box() {
    global $theme_name;
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '文章参数设置', 'post_meta_boxes', 'post', 'normal', 'high' );
		add_meta_box( 'new-meta-boxes', '焦点图设置', 'banner_meta_boxes', 'banner', 'normal', 'high' );
    }
}


//保存文章数据
function save_postdata( $post_id ) {global $post, $post_meta_boxes;foreach($post_meta_boxes as $meta_box) {if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {return $post_id;}if ( 'page' == $_POST['post_type'] ) {if ( !current_user_can( 'edit_page', $post_id ))return $post_id;}else {if ( !current_user_can( 'edit_post', $post_id ))return $post_id;} $data = $_POST[$meta_box['name'].'_value']; if(get_post_meta($post_id, $meta_box['name'].'_value') == "")add_post_meta($post_id, $meta_box['name'].'_value', $data, true);elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))update_post_meta($post_id, $meta_box['name'].'_value', $data);elseif($data == "")delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));}}


function save_bannerdata( $post_id ) {global $post, $banner_meta_boxes;foreach($banner_meta_boxes as $meta_box) {if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {return $post_id;}if ( 'page' == $_POST['post_type'] ) {if ( !current_user_can( 'edit_page', $post_id ))return $post_id;}else {if ( !current_user_can( 'edit_post', $post_id ))return $post_id;}$data = $_POST[$meta_box['name'].'_value'];if(get_post_meta($post_id, $meta_box['name'].'_value') == "")add_post_meta($post_id, $meta_box['name'].'_value', $data, true);elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))update_post_meta($post_id, $meta_box['name'].'_value', $data);elseif($data == "")delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));}}







add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_bannerdata');
add_action('save_post', 'save_postdata');









?>