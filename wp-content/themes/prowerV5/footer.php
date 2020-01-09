	</div>
</div>
<?php if (is_home()&&!is_paged()) : ?>
<aside id="footer_box">
	<div id="sponsor">
		<a href="http://faq.wopus.org" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/faq_side.png" width="250" height="100" alt="日本VPS主机" title="日本VPS主机"></a>
		<a style="margin:0 20px;" href="http://idc.wopus.org/host/vps/" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/vps_japan.jpg" width="250" height="100" alt="WordPress问答" title="WordPress问答"></a>
		<a href="http://reeoo.com" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/reeoo.jpg" width="250" height="100" alt="精美网页设计欣赏" title="精美网页设计欣赏"></a>
	</div>
	<div id="linkcat"><?php wp_list_bookmarks('categorize=0&title_li=0&before='); ?></div>
</aside>
<?php endif; ?>
<footer id="footer">
	<p>&copy; 2012 <?php bloginfo('name'); ?>. Powered by <a href="http://wordpress.org/" target="_blank">WordPress</a>. Theme by <a href="http://www.prower.cn" target="_blank">Prower</a>. Support by <a href="http://faq.wopus.org/tag/prower+v5/" target="_blank">WopusFAQ</a></p>
</footer>
<?php wp_footer(); ?>
</body>
</html>