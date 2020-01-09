<?php
/*
Plugin Name: Live2dHistoire
Plugin URI: http://www.wikimoe.com/?tag=Live2d
Description: 给博客加上live2d伊斯特瓦尔，请从左侧菜单→设置→live2d伊斯特瓦尔设置进行设置。
Author: 广树
Version: 1.0.2
Author URI: http://www.wikimoe.com
*/

define('Live2dHistoire_path', plugins_url('', __FILE__));
define('Live2dHistoire_home', home_url());
//SETTINGS
add_action('admin_menu', 'Live2dHistoire_l2d');
function Live2dHistoire_l2d() {
    add_options_page('Live2dHistoire', 'live2d伊斯特瓦尔设置', 'manage_options', 'plugin-Live2dHistoire', 'plugin_Live2dHistoire_option_page');
}
function plugin_Live2dHistoire_option($option_name) {
    global $plugin_Live2dHistoire_options;
    if (isset($plugin_Live2dHistoire_options[$option_name])) {
        return $plugin_Live2dHistoire_options[$option_name];
    } else {
        return null;
    }
}
function plugin_Live2dHistoire_update_options() {
	update_option('plugin_Live2dHistoire_jq', plugin_Live2dHistoire_option('jq'));
    update_option('plugin_Live2dHistoire_key', plugin_Live2dHistoire_option('key'));
	update_option('plugin_Live2dHistoire_talk1', plugin_Live2dHistoire_option('talk1'));
	update_option('plugin_Live2dHistoire_talk2', plugin_Live2dHistoire_option('talk2'));
	update_option('plugin_Live2dHistoire_talk3', plugin_Live2dHistoire_option('talk3'));
	update_option('plugin_Live2dHistoire_talk4', plugin_Live2dHistoire_option('talk4'));
	update_option('plugin_Live2dHistoire_talk5', plugin_Live2dHistoire_option('talk5'));
	
	update_option('plugin_Live2dHistoire_bgm1', plugin_Live2dHistoire_option('bgm1'));
	update_option('plugin_Live2dHistoire_bgm2', plugin_Live2dHistoire_option('bgm2'));
	update_option('plugin_Live2dHistoire_bgm3', plugin_Live2dHistoire_option('bgm3'));
	update_option('plugin_Live2dHistoire_bgm4', plugin_Live2dHistoire_option('bgm4'));
	update_option('plugin_Live2dHistoire_bgm5', plugin_Live2dHistoire_option('bgm5'));
	
	file_put_contents(dirname(__FILE__).'/live2d.com.php','<?php die; ?>'.serialize(array(
		'ak'=>plugin_Live2dHistoire_option('key'),	
	)));
}
function plugin_Live2dHistoire_option_page() {
    if(!current_user_can('manage_options')) wp_die('抱歉，您没有权限来更改设置');
    if(isset($_POST['update_options'])){
        global $plugin_Live2dHistoire_options;
		$plugin_Live2dHistoire_options['jq'] = $_POST['jq'];
        $plugin_Live2dHistoire_options['key'] = $_POST['key'];
		
		$plugin_Live2dHistoire_options['talk1'] = $_POST['talk1'];
		$plugin_Live2dHistoire_options['talk2'] = $_POST['talk2'];
		$plugin_Live2dHistoire_options['talk3'] = $_POST['talk3'];
		$plugin_Live2dHistoire_options['talk4'] = $_POST['talk4'];
		$plugin_Live2dHistoire_options['talk5'] = $_POST['talk5'];
		
		$plugin_Live2dHistoire_options['bgm1'] = $_POST['bgm1'];
		$plugin_Live2dHistoire_options['bgm2'] = $_POST['bgm2'];
		$plugin_Live2dHistoire_options['bgm3'] = $_POST['bgm3'];
		$plugin_Live2dHistoire_options['bgm4'] = $_POST['bgm4'];
		$plugin_Live2dHistoire_options['bgm5'] = $_POST['bgm5'];
		
        plugin_Live2dHistoire_update_options();
        echo '<div id="message" class="updated fade"><p>设置已保存</p></div>';
    } ?>
    <div class="wrap">
        <h2>伊斯特瓦尔设置</h2>
        <form action="options-general.php?page=plugin-Live2dHistoire" method="post">
        <?php wp_nonce_field('plugin-Live2dHistoire-options'); ?>
            <table class="form-table">
                <tr>
                <td>
                	<h3>加载jQuery库</h3>
                   <input type="text" size="3" maxlength="1" value="<?php echo(get_option('plugin_Live2dHistoire_jq')); ?>" name="jq" />配置是否加载JQ：1是，0否<br />
                   
                   <h3>图灵机器人apikey</h3>
                   <input type="text" value="<?php echo(get_option('plugin_Live2dHistoire_key')); ?>" name="key" /><br />
                   
                   <h3>要说的话其一</h3>
                   <input type="text" value="<?php echo(get_option('plugin_Live2dHistoire_talk1')); ?>" name="talk1" /><br />
                   <h3>要说的话其二</h3>
                   <input type="text" value="<?php echo(get_option('plugin_Live2dHistoire_talk2')); ?>" name="talk2" /><br />
                   <h3>要说的话其三</h3>
                   <input type="text" value="<?php echo(get_option('plugin_Live2dHistoire_talk3')); ?>" name="talk3" /><br />
                   <h3>要说的话其四</h3>
                   <input type="text" value="<?php echo(get_option('plugin_Live2dHistoire_talk4')); ?>" name="talk4" /><br />
                   <h3>要说的话其五</h3>
                   <input type="text" value="<?php echo(get_option('plugin_Live2dHistoire_talk5')); ?>" name="talk5" /><br />
                   
                   <h3>背景音乐一</h3>
                   <input type="text" value="<?php echo(get_option('plugin_Live2dHistoire_bgm1')); ?>" name="bgm1" /><br />
                   <h3>背景音乐二</h3>
                   <input type="text" value="<?php echo(get_option('plugin_Live2dHistoire_bgm2')); ?>" name="bgm2" /><br />
                   <h3>背景音乐三</h3>
                   <input type="text" value="<?php echo(get_option('plugin_Live2dHistoire_bgm3')); ?>" name="bgm3" /><br />
                   <h3>背景音乐四</h3>
                   <input type="text" value="<?php echo(get_option('plugin_Live2dHistoire_bgm4')); ?>" name="bgm4" /><br />
                   <h3>背景音乐五</h3>
                   <input type="text" value="<?php echo(get_option('plugin_Live2dHistoire_bgm5')); ?>" name="bgm5" /><br />
                   
				</td>
                </tr>
            </table>
            <p class="submit"><input name="update_options" value="保存设置" type="submit" /></p>
        </form>
    </div><?php        
}
//MAIN
add_action('wp_footer','Live2dHistoire_main');
function Live2dHistoire_main(){ 
	echo '
	   <div id="landlord" style="left:5px;bottom:0px;"><div class="message" style="opacity:0"></div><canvas id="live2d" width="500" height="560" class="live2d"></canvas><div class="live_talk_input_body"><div class="live_talk_input_name_body"><input name="name" type="text" class="live_talk_name white_input" id="AIuserName" autocomplete="off" placeholder="你的名字" /></div><div class="live_talk_input_text_body"><input name="talk" type="text" class="live_talk_talk white_input" id="AIuserText" autocomplete="off" placeholder="要和我聊什么呀？"/><button type="button" class="live_talk_send_btn" id="talk_send">发送</button></div></div><input name="live_talk" id="live_talk" value="1" type="hidden" /><div class="live_ico_box"><div class="live_ico_item type_info" id="showInfoBtn"></div><div class="live_ico_item type_talk" id="showTalkBtn"></div><div class="live_ico_item type_quit" id="hideButton"></div><div class="live_ico_item type_music" id="musicButton"></div><audio src="" style="display:none;" id="live2d_bgm" data-bgm="0" preload="none"></audio><input name="live_statu_val" id="live_statu_val" value="0" type="hidden" /></div></div>';
	echo '<div id="open_live2d">召唤伊斯特瓦尔</div>';	
	
	if(!empty(get_option(plugin_Live2dHistoire_talk1))){
		echo '<div class="live2d_weiyu_cache" style="display:none;">'.get_option(plugin_Live2dHistoire_talk1).'</div>';
	};
	if(!empty(get_option(plugin_Live2dHistoire_talk2))){
		echo '<div class="live2d_weiyu_cache" style="display:none;">'.get_option(plugin_Live2dHistoire_talk2).'</div>';
	};
	if(!empty(get_option(plugin_Live2dHistoire_talk3))){
		echo '<div class="live2d_weiyu_cache" style="display:none;">'.get_option(plugin_Live2dHistoire_talk3).'</div>';
	};
	if(!empty(get_option(plugin_Live2dHistoire_talk4))){
		echo '<div class="live2d_weiyu_cache" style="display:none;">'.get_option(plugin_Live2dHistoire_talk4).'</div>';
	};
	if(!empty(get_option(plugin_Live2dHistoire_talk5))){
		echo '<div class="live2d_weiyu_cache" style="display:none;">'.get_option(plugin_Live2dHistoire_talk5).'</div>';
	};
	
	if(!empty(get_option(plugin_Live2dHistoire_bgm1))){
		echo '<input name="live2dBGM" value="'.get_option(plugin_Live2dHistoire_bgm1).'" type="hidden">';
	};
	if(!empty(get_option(plugin_Live2dHistoire_bgm2))){
		echo '<input name="live2dBGM" value="'.get_option(plugin_Live2dHistoire_bgm2).'" type="hidden">';
	};
	if(!empty(get_option(plugin_Live2dHistoire_bgm3))){
		echo '<input name="live2dBGM" value="'.get_option(plugin_Live2dHistoire_bgm3).'" type="hidden">';
	};
	if(!empty(get_option(plugin_Live2dHistoire_bgm4))){
		echo '<input name="live2dBGM" value="'.get_option(plugin_Live2dHistoire_bgm4).'" type="hidden">';
	};
	if(!empty(get_option(plugin_Live2dHistoire_bgm5))){
		echo '<input name="live2dBGM" value="'.get_option(plugin_Live2dHistoire_bgm5).'" type="hidden">';
	};
	
	if(get_option(plugin_Live2dHistoire_jq)==1){
		echo '<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>';
	};
	echo "<script>
		var message_Path = '".Live2dHistoire_path.'/'."';
		var home_Path = '".Live2dHistoire_home.'/'."';
	</script>";
	echo '<script src="'. Live2dHistoire_path .'/js/live2d.js?ver0.2"></script>';
	echo '<script src="'. Live2dHistoire_path .'/js/message.js?ver0.9.1"></script>';

}
//CSS
add_action('wp_enqueue_scripts','Live2dHistoire_scripts');
function Live2dHistoire_scripts(){
    wp_enqueue_style('Live2dHistoire_css',Live2dHistoire_path.'/css/live2d.css',array(),'1.0');
    
}