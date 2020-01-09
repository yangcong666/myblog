<div id="copyright">

  <div class="container">

	<div class="copyright">

	  <p><span>版权所有 &copy; 2012 <a href="<?php bloginfo('url');?>"><?php bloginfo('name'); ?></a> Theme <a href="http://www.cocss.com">Co1</a> <?php echo dopt('co_track'); ?></span></div>

	  <p class="trademarks">转载请注明来源！ 保留一切权利！</p>

	</div>

        <script src="<?php bloginfo('template_url') ?>/js/jquery.min.js"></script> 

	<?php if(is_single() || is_page()){ ?>

	<script src="<?php bloginfo('template_url') ?>/js/article.js"></script>

	<?php } ?>

</div>

<?php wp_footer(); ?>


</body>

</html>

