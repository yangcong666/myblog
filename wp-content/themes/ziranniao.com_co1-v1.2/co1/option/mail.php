<?php

$Uurl = $HTTP_SERVER_VARS['HTTP_REFERER'];

$time = date("Y-m-d G:i:s");

$url =  $_POST["article_url"];

$title = $_POST["article_title"];

$author = $_POST["author"];

$email = $_POST["email"];

$tel= $_POST["tel"];

$comment= $_POST["w"];

$to = "testshop@testshop.cn";



$subject = "来自官网的咨询";



if($email == ''){

$msg = '<meta http-equiv="refresh" content="2;URL='.$Uurl.'"/><center><div style="width:450px;padding:0px;border:1px solid #ccc;margin:0 auto"><div style="padding:6px;font-size:12px;border-bottom:1px solid #ccc;"><b>咨询发送失败！</b></div><div style="height:130px;font-size:10pt;background:#ffffff"><br>'.'<br><a href="'.$Uurl.'">信息不完整，请返回填写...</a><br></div></div></center>';

header("Content-type: text/html; charset=utf-8"); 

echo $msg;

}



else{


// 当发送 HTML 电子邮件时，请始终设置 content-type


$message = "称呼：".$author."<br />邮件：".$email."<br />电话：".$tel."<br />信息：".$comment."<br /><br />页面：".$title."<br />链接：".$url."<br />时间：".$time;



$from = $email;

require_once ('email.class.php');
//##########################################
$smtpserver = "smtp.exmail.qq.com";
$smtpserverport =25;
$smtpusermail = "info@testshop.cn";
$smtpuser = "info@testshop.cn";
$smtppass = "Testshop001";
$mailtype = "HTML";

##########################################
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
$smtp->debug = false;
if ($smtp->sendmail($to, $smtpusermail, $subject,$message, $mailtype,'','','',$from))
{
$msg = '<meta http-equiv="refresh" content="2;URL='.$Uurl.'"/><center><div style="width:450px;padding:0px;border:1px solid #ccc;margin:0 auto"><div style="padding:6px;font-size:12px;border-bottom:1px solid #ccc;"><b>咨询发送成功！</b></div><div style="height:130px;font-size:10pt;background:#ffffff"><br>'.'<br><a href="'.$Uurl.'">如果你的浏览器没反应，请点击这里返回...</a><br></div></div></center>';
header("Content-type: text/html; charset=utf-8"); 
echo $msg;
}else{
	$msg = '<meta http-equiv="refresh" content="2;URL='.$Uurl.'"/><center><div style="width:450px;padding:0px;border:1px solid #ccc;margin:0 auto"><div style="padding:6px;font-size:12px;border-bottom:1px solid #ccc;"><b>咨询发送失败！</b></div><div style="height:130px;font-size:10pt;background:#ffffff"><br>'.'<br><a href="'.$Uurl.'">服务器故障，发送失败，请重试...</a><br></div></div></center>';
	header("Content-type: text/html; charset=utf-8"); 
	echo $msg;
}

}



?>