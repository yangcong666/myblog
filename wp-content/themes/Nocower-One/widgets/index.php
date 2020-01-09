<?php  

include('wid-banner.php');
include('wid-slidebanner.php');
include('wid-readers.php');
include('wid-postlist.php');
include('wid-comment.php');
include('wid-tags.php');
include('wid-textbanner.php');


add_action('widgets_init','unregister_d_widget');
function unregister_d_widget(){
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
}
//smtp
add_action('phpmailer_init', 'mail_smtp');
function mail_smtp( $phpmailer ) {
$phpmailer->FromName = '挖坟网';
$phpmailer->Host = 'smtp.exmail.qq.com';
$phpmailer->Port = 465; 
$phpmailer->Username = 'wafen@wafen.cn';   
$phpmailer->Password = 'CALMZHANG19871020';
$phpmailer->From = 'wafen@wafen.cn'; 
$phpmailer->SMTPAuth = true;   
$phpmailer->SMTPSecure = 'ssl';
$phpmailer->IsSMTP();
}
?>