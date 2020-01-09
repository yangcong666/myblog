<?php if (get_option('ygj_cblbj') !== '无侧边栏') {?>
<div id="sidebar" class="widget-area">			
		<?php wp_reset_query();if (is_single() || is_page() ) { ?>
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			<?php }else { ?>
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			<?php } ?>
</div>
<?php } ?>