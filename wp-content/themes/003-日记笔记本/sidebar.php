<aside id="sidebar">
	<!-- Begin Social Icons -->
	<section id="socialIcons">
	<ul>
		<?php if(of_get_option('diary_twitter_user')!=""){ ?>
		<li><a href="http://twitter.com/<?php echo of_get_option('diary_twitter_user'); ?>" class="twitter <?php if(of_get_option('diary_latest_tweet')!="no"):?>tip<?php endif?>" title="Follow Us on Twitter!"><?php _e("Follow Us on Twitter!", "site5framework"); ?></a></li>
		<?php }?>
		<?php if(of_get_option('diary_facebook_link')!=""){ ?>
		<li><a href="<?php echo of_get_option('diary_facebook_link'); ?>" class="facebook" title="Join Us on Facebook!">"<?php _e("Join Us on Facebook!", "site5framework"); ?></a></li>
		<?php }?>
		<li><a href="<?php bloginfo('rss2_url'); ?>" title="RSS" class="rss"><?php _e("RSS", "site5framework"); ?></a></li>
	</ul>
	<?php if(of_get_option('diary_contact_page')):?>
	<a href="<?php echo get_page_link(of_get_option('diary_contact_page')); ?>" id="butContact"><?php _e("Contact", "site5framework"); ?></a>
	<?php endif;?>
	</section>
	<!-- End Social Icons -->
	<?php // Widgetized sidebar 
			if ( ! dynamic_sidebar( 'sidebar' ) ) :?>
			<div class="sideBox">
				<h3><?php _e("WIDGETS NEEDED!", "site5framework"); ?></h3>
				<p><?php _e("Go ahead and add some widgets here! Admin > Appearance > Widgets", "site5framework"); ?></p>
			</div>
			<?php endif; ?>
</aside>
