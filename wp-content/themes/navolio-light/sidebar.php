<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Navolio_Light
 * @since 1.0
 */
?>
<div class="blog-sidebar-content">
    <?php 
    $sidebar_id = (is_single()) ? "sidebar-single": "sidebar-blog"; 
    if ( is_active_sidebar( $sidebar_id ) ) : 
        dynamic_sidebar( $sidebar_id ); 
    else :
        the_widget('WP_Widget_Categories', '', 'before_widget=<div class="widget widget_categories">&before_title=<h2 class="widget-title" >&after_title=</h2>&after_widget=</div>'); 

        the_widget('WP_Widget_Archives', '', 'before_widget=<div class="widget widget_archive">&before_title=<h2 class="widget-title" >&after_title=</h2>&after_widget=</div>'); 

        the_widget('WP_Widget_Tag_Cloud', '', 'before_widget=<div class="widget widget_tag_cloud">&before_title=<h2 class="widget-title" >&after_title=</h2>&after_widget=</div>');
    endif; ?>
</div><!-- /.blog-sidebar-content -->