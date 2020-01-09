<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */
// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define( 'DB_NAME', 'WordPressTest' );

/** MySQL数据库用户名 */
define( 'DB_USER', 'WordPressTestUser' );

/** MySQL数据库密码 */
define( 'DB_PASSWORD', 'password1955026632' );

/** MySQL主机 */
define( 'DB_HOST', 'localhost' );

/** 创建数据表时默认的文字编码 */
define( 'DB_CHARSET', 'utf8mb4' );

/** 数据库整理类型。如不确定请勿更改 */
define( 'DB_COLLATE', '' );

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '/El~24m_v0_&~[a~xvzn$2JQVi#6.F8A]E|tEnT+/Zd*u/Ly#)X+cd)[Av[iXYL0' );
define( 'SECURE_AUTH_KEY',  '28rs-8r3ko.A&{Dt$#H]%N%{NeC$m*)eSQ zxVTBz)P<CD `]}K]qjmgU/jfuD^Z' );
define( 'LOGGED_IN_KEY',    'E!::L{9Ph|!W3WPQBGKq9G`dDF7ufHL;,k{>3lr,ev>JZDy$aJ,Rs.t(2=j6anY0' );
define( 'NONCE_KEY',        '?m{iogz2$<)|NkMH^] w`iMM&rflAUm6@(D&02&PTC}z%K>uz)@VysQ}Wqp$ObN_' );
define( 'AUTH_SALT',        'fWVvDKk]@<F*]DyzRrPtFO=<d&/=#-mL=.BGKT}S_?NngG8t.GL)$L$ !?lB+?o>' );
define( 'SECURE_AUTH_SALT', 'h2ByDC~@4I)OW,>L~bjAJiFl0-+iVT=^D|HC4e=1j901_28U(bM=q?V=8;ogt!%$' );
define( 'LOGGED_IN_SALT',   'y=kdq#+*# `<-86Mf>wSB>ju*C8}4vvG4wn..juw3*(XuBb87sh4Zn|T4Aa^[SnZ' );
define( 'NONCE_SALT',       '5:l(pt/*:`JW`hm7=:b666wm``*76p(2bn2FW[w%xNSZF@o`NC7i[j!kabl~`e-g' );

define("FS_METHOD","direct");
define("FS_CHMOD_DIR", 0777);
define("FS_CHMOD_FILE", 0777);

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** 设置WordPress变量和包含文件。 */
require_once( ABSPATH . 'wp-settings.php' );
