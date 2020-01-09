<?php
class kindeditor {
	public $plugin_path = "";
	
	public function __construct()
	{
		$this->plugin_path = plugins_url('/',__FILE__);
	}
	
	public function deactivate()
	{
		global $current_user;
		update_user_option($current_user->ID, 'rich_editing', 'true', true);
        delete_option('ke_auto_highlight');
        delete_option('ke_highlight_type');
	}

	public function activate()
	{
		global $current_user;
		update_user_option($current_user->ID, 'rich_editing', 'false', true);
        add_option('ke_auto_highlight', '');
        add_option('ke_highlight_type', 'prettify');
	}
	
	public function load_kindeditor()
	{
		?>
		<script type="text/javascript">
		//<![CDATA[
			var editor;
			var options = {
				cssPath : ['<?php echo $this->plugin_path; ?>plugins/code/prettify.css','<?php echo $this->plugin_path; ?>style.css'],
				uploadJson : '<?php echo $this->plugin_path ?>php/upload_json.php',
				fileManagerJson : '<?php echo $this->plugin_path ?>php/file_manager_json.php',
				items : [
				'source', '|', 'undo', 'redo', '|', 'template', 'cut', 'copy', 'paste',
				'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
				'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
				'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'map', 'baidumap','fullscreen', '/',
				'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
				'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage','flash', 'media', 'table', 'hr', 'emoticons', 'code', 'anchor', 'blockquote', 'wpmore',
				'link', 'unlink'
				],
				afterChange : function() {
					jQuery('#wp-word-count .word-count').html(this.count('text'));
				}
			};
			KindEditor.ready(function(K) {
					editor = K.create('#content',options);
			});
		//]]>
		</script>
		<?php
	}
	
	public function user_personalopts_update()
    {
        global $current_user;
        update_user_option($current_user->ID, 'rich_editing', 'false', true);
    }
	
	public function add_admin_js()
	{
		wp_deregister_script(array('media-upload')); 
		wp_enqueue_script('media-upload', $this->plugin_path .'media-upload.js', array('thickbox'), '20110922'); 
		wp_enqueue_script('kindeditor', $this->plugin_path . 'kindeditor.js');
		wp_enqueue_script('zh_CN', $this->plugin_path . 'lang/zh_CN.js');
		wp_enqueue_script('plugins', $this->plugin_path . 'plugins.js');
	}
	
	public function add_admin_style()
	{	
		$ke_style = plugins_url('themes/default/default.css', __FILE__);
		wp_register_style('default', $ke_style);
		wp_enqueue_style('default');
	}
	
	public function add_head_script()
	{
        //wp_enqueue_script('jquery');
	    wp_enqueue_script('prettify-js', $this->plugin_path .'plugins/code/prettify.js','','20110329');
        ?>
        <script type="text/javascript">
             window.onload = function(){
                 prettyPrint();
             }
        </script>
        <?php
	}

    public function add_head_style()
    {
    	$type = get_option('ke_highlight_type');
        wp_enqueue_style('prettify-css', $this->plugin_path .'plugins/code/' . $type . '.css','','20110329');
    }
	
	public function add_admin_head()
    {
		?>
		<style type="text/css">
			#ed_toolbar,
            #content-tmce,
            #content-html { display: none; }
			.ke-container {border: none;!important}
			.ke-icon-wpmore {
				background-image: url(<?php echo $this->plugin_path;?>themes/default/default.png);
				background-position: 0px -1024px;
				width: 16px;
				height: 16px;
			}
			.ke-icon-blockquote {
				background-image: url(<?php echo $this->plugin_path;?>themes/default/quote.gif);
				width: 16px;
				height: 16px;
			}
		</style>
		<?php
    }
}

$kindeditor = new kindeditor();