/*
 * WordPress 內置嵌套評論專用 Ajax comments >> WordPress-jQuery-Ajax-Comments v1.27(no-edit) by Willin Kan.

 	 如果有問題, 請移步 http://willin.heliohost.org/?p=1271 作者: Willin Kan
 */

var i = 0, got = -1, len = document.getElementsByTagName('script').length;//讀取網頁找 script 數量
while ( i <= len && got == -1){
	var js_url = document.getElementsByTagName('script')[i].src,//判斷哪一個 script 是這個文件
			got = js_url.indexOf('comments-ajax.js'); i++ ;         //找到這個文件路徑
}
var ajax_php_url = js_url.replace('-ajax.js','-ajax.php'),    //將 -ajax.js 替換為 -ajax.php, 找到 comments-ajax.php 路徑
		wp_url = js_url.substr(0,js_url.indexOf('/wp-content/')), //找到 WP 安裝路徑
		pic_sb_url = wp_url + '/wp-admin/images/wpspin_dark.gif', //提交 icon 位址
		pic_no_url = wp_url + '/wp-admin/images/no.png',          //錯誤 icon 位址
		pic_ys_url = wp_url + '/wp-admin/images/yes.png',         //成功 icon 位址
		txt1 = ' style="display:none; background:url(',           //--------------- 以下是過程所用的 html 字段, 儘量不去動它.
		txt2 = ') no-repeat left; padding-left:20px;',
		txt3 = '<div id="commentload"'+ txt1 + pic_sb_url + txt2 + '">正在提交, 請稍候...</div>',
		txt4 = '<div id="commenterror"'+ txt1 + pic_no_url + txt2 + '">#</div>',
		txt5 = '" style="display:none;">',
		txt6 = '\n<span id="success_',
		txt7 = '" style="margin-left:20px; background:url(' + pic_ys_url + txt2 + '">提交成功',
		div_, $new_comm, num = 1;

/** 啟用 jQuery */
jQuery(document).ready(function($){
var cancel_text = $('#cancel-comment-reply-link').html();
		$('#submit').attr("disabled",false);                      //確定提交按鈕功能沒取消
		$('#comment').after( txt3 + txt4 );                       //添加提交和錯誤提示, 在#comment 或 #submit 後添加, 視模板設計而定

/** submit 時的動作 */
$('#commentform').submit(function(){
		$('#commenterror').hide();                                //隱藏:錯誤提示
		$('#commentload').slideDown();                            //拉下顯示:正在提交
		$('#submit').attr("disabled",true).fadeTo('slow', 0.6);   //防範再次按提交按鈕

/** 啟用 Ajax */
	$.ajax({
			url: ajax_php_url,                                      //comments-ajax.php 位址
			data: $('#commentform').serialize(),                    //發送的數據 id='commentform'
			type: 'POST',                                           //請求類型為 POST

		error: function(request){                                 //錯誤時的動作
			$('#commentload').slideUp();                            //推上隱藏:正在提交
			$('#commenterror').slideDown().html(request.responseText);//顯示:錯誤提示
			setTimeout(function(){$('#submit').attr('disabled',false).fadeTo('slow', 1);$('#commenterror').slideUp();}, 3000);//恢復: 提交按鈕
			},

		success: function(data){                                  //成功時的動作
			$('textarea').each(function(){this.value=''});          //清空: textarea 《使用 $('#comment').val(''); 也可以, 但有些模板不動作》
			$('#commentload').hide();                               //隱藏:正在提交
		var t = addComment, cancel = t.I('cancel-comment-reply-link'),//評論框 & 取消回覆鏈接定義
			temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId),//評論框的臨時節點定義
			post = t.I('comment_post_ID').value, parent = t.I('comment_parent').value;//傳回父層值


/** 評論數變化 */
			if ($('#comments').length){                             //如果已有 id='comments'
				tmp_txt = t.I('comments').innerHTML,                  //取 id='comments' 內容
				n = parseInt(tmp_txt.match(/\d+/)),                   //在字串中找數字
				tmp_txt = tmp_txt.replace( n, n + 1 );                //替換評論數字串
				$('#comments').text(tmp_txt);                         //顯示:新評論數
			} else {
				tmp_txt = '<h3 id="comments">已有 '+ num +' 條評論: </h3>';//沒有時, 產生新 id='comments'
				$('#respond').before(tmp_txt);                        //將新 id 加入
			};

/** 顯示新評論 */
		 	num_t = num.toString();                                 //數字轉文字, 給編號
		if ( parent == '0'){
			new_htm = '\n<ol class="commentlist" id="new_comm_' + num_t + txt5 + '</ol>'; //如果是底層, 加:ol
		} else {
			new_htm = '\n<ul class="children" id="new_comm_' + num_t + txt5 + '</ul>';    //如果是子層, 加:ul
		};
		is_div = document.body.innerHTML.indexOf('div-comment-'); //找尋 div-comment- 字頭
		if (is_div == -1){div_ = ''} else {div_ = 'div-'};        //如果找到, comment 的 id 也要加 div- 字頭, 因 WP 默認的的有字頭, 但一般模板設計沒字頭.
		new_htm = new_htm.concat(txt6,num_t,txt7,'</span>\n');    //加:提交成功
		$('#respond').before(new_htm);                            //在 #respond 前加入 new_htm
		$('#new_comm_' + num_t).append(data).fadeIn(4000);        //將新評論內容傳入, 以淡入效果顯示新評論, (4000)表示4秒

		countdown();                                              //(倒計時函式在最下面)
		num++ ;                                                   //編號累進, 目的是不讓 id 重覆

		cancel.style.display = 'none';                            //隱藏:取消回覆	-------------- 評論框回底層
		cancel.onclick = null;                                    //清空:回覆鏈接
		t.I('comment_parent').value = '0';                        //回底層
if ( temp && respond ){                                       //如果有節點和回覆框
		temp.parentNode.insertBefore(respond, temp);              //temp 節點前加評論框
		temp.parentNode.removeChild(temp)                         //刪除 temp 節點
		};

		} // 結束: 成功時的動作
	}); // 結束 Ajax
  return false;
	}); // 結束: submit 時的動作

/** 回覆時的動作 (以下參考 wp-includes\js\comment-reply.dev.js) */
addComment = {
	moveForm : function(commId, parentId, respondId, postId) {
		var t = this, div, comm = t.I(commId), respond = t.I(respondId),
		cancel = t.I('cancel-comment-reply-link'), parent = t.I('comment_parent'), post = t.I('comment_post_ID');
		$('#commenterror').hide();                                //隱藏:錯誤提示
		t.respondId = respondId;
		postId = postId || false;

		if ( ! t.I('wp-temp-form-div') ) {
			div = document.createElement('div');
			div.id = 'wp-temp-form-div';
			div.style.display = 'none';
			respond.parentNode.insertBefore(div, respond)
		};

		if ( post && postId && comm )
			comm.parentNode.insertBefore(respond, comm.nextSibling);
		post.value = postId;
		parent.value = parentId;
		cancel.style.display = '';

/** 取消回覆時的動作 */
		cancel.onclick = function() {
			$('#commenterror').hide();                              //隱藏:錯誤提示
			var t = addComment, temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId);
			this.style.display = 'none';
			this.onclick = null;
			t.I('comment_parent').value = '0';
		if ( temp && respond ){
			temp.parentNode.insertBefore(respond, temp);
			temp.parentNode.removeChild(temp)}
			return false;
		};

		try { t.I('comment').focus(); }
		catch(e) {}
		return false;
	},

	I : function(e) {
		return document.getElementById(e)
}}; // 結束: 回覆時的動作

/** 倒計時函式 */
var wait = 15, submit_val = $('#submit').val();               //時間設15秒, 暫存:按鈕上的字
function countdown(){
	if ( wait > 0 ){                                            //如果時間沒到
		$('#submit').val(wait); wait--; setTimeout(countdown,1000);//顯示:秒數, 秒數遞減, 1秒延遲
	} else {
		$('#submit').val(submit_val).attr('disabled',false).fadeTo('slow', 1);//恢復:提交按鈕
		wait = 15;                                                //重置時間
  };
};	// 結束 Ajax-Comments


});// jQ 結束