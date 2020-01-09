<?php
/*********************************************************************************************

Set Max Content Width

*********************************************************************************************/
if ( ! isset( $content_width ) ) $content_width = 480;

/*********************************************************************************************

If 3.1 isn't installed display a notice that post type archives will not work

*********************************************************************************************/
function site5framework_archive_nag(){
    global $pagenow;
    if ( $pagenow == 'themes.php' ) {
         echo '<div class="updated"><p>';
		 _e('Portfolio archive pages will only display in WordPress 3.1 or above.  Please upgrade.', 'site5framework');
		 echo '</p></div>';
    }
}

if ( get_bloginfo('version') < 3.1 ) {
	add_action('admin_notices', 'site5framework_archive_nag');
}

/*********************************************************************************************

Add Theme Support

*********************************************************************************************/
add_theme_support( 'automatic-feed-links' );


/*********************************************************************************************

Custom Admin Login Logo

*********************************************************************************************/
function custom_login_logo() {
    if ( !of_get_option('diary_clogo')== '') {
    echo '<style type="text/css">
    #login h1 a {background-image: url('.of_get_option('diary_clogo').') !important; background-size: auto !important;  }
    </style>';
    }
}
add_action('login_head', 'custom_login_logo');


/*********************************************************************************************

Remove and Reformat Admin Footer

*********************************************************************************************/
function remove_footer_admin () {

$themename = get_theme_data(get_stylesheet_directory() . '/style.css');
$version = 'version '.$themename['Version'];
$themename = $themename['Name'];

    echo '<b><a href="http://www.s5themes.com/theme/diary">'.$themename.' - '.$version.'</a></b> Wordpress Theme | <a href="http://www.site5.com/"">Designed by Site5.com</a> ';
}
add_filter('admin_footer_text', 'remove_footer_admin');



/*********************************************************************************************

Theme Excerpts Format

*********************************************************************************************/
function theme_excerpt($num) {
        $link = get_permalink();
        $limit = $num;
        if(!$limit) $limit = 55;
        $excerpt = explode(' ', strip_tags(get_the_excerpt()), $limit);
        if (count($excerpt)>=$limit) {
                array_pop($excerpt);
                $excerpt = implode(" ",$excerpt).'...<a href="'.$link.'" class="round button">'.__("Read more &raquo;", "site5framework").'</a>&nbsp;';
        } else {
                $excerpt = implode(" ",$excerpt).'<a href="'.$link.'" class="round button">'.__("Read more &raquo;", "site5framework").'</a>&nbsp;';
        }
        $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
        echo '<p>'.$excerpt.'</p>';
}

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

/*********************************************************************************************

Content Validation

*********************************************************************************************/
function content_validation( $content ) {
    $content = str_replace( array( '<b>', '</b>' ), array( '<strong>', '</strong>' ), $content );
    $content = str_replace( '></param>', ' />', $content );
    $content = str_replace( '></embed>', ' />', $content );
    $content = str_replace( '<object', '<object type="video/flv"', $content );
    return $content;
}


/*********************************************************************************************

WP MU IMAGE SUPPORT

*********************************************************************************************/
function get_image_url() {
    $theImageSrc = wp_get_attachment_url(get_post_thumbnail_id($post_id));
    global $blog_id;
    if (isset($blog_id) && $blog_id > 0) {
        $imageParts = explode('/files/', $theImageSrc);
        if (isset($imageParts[1])) {
            $theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
        }
    }
    echo $theImageSrc;
}

/*********************************************************************************************

WP MU CUSTOM META IMAGE SUPPORT

*********************************************************************************************/
function get_image_path($cutommeta_image) {
$theImageSrc1 = $cutommeta_image;
global $blog_id;
if (isset($blog_id) && $blog_id > 0) {
    $imageParts = explode('/files/', $theImageSrc1);
    if (isset($imageParts[1])) {
        $theImageSrc1 = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
    }
}
return $theImageSrc1;
}

?>