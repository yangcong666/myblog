<!-- side -->

<div class="side">

	<div class="entry-page-links social-counter-widget clearfix">

		<ul class="social-counter">

			<li class="rss-counter"><a href="<?php bloginfo('rss2_url'); ?>"><span>RSS订阅</span></a></li>

			<li class="sina-counter"><a href="<?php echo dopt('co_weibo'); ?>"><span>新浪微博</span></a></li>

			<li class="tencent-counter"><a href="<?php echo dopt('co_tqq'); ?>"><span>腾讯微博</span></a></li>

		</ul>

	</div>

	<div class="widget widget_search clearfix">

		<form action="<?php bloginfo('url'); ?>/" class="searchform" method="get">

			<input x-webkit-speech type="text" class="s" name="s" placeholder="请输入搜索内容...">

			<input type="submit" value="搜索" class="searchsubmit">

		</form>

	</div>

      <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_sidebar')) : else : ?>

		<div class="widget_tips">

			请前往“后台 - 外观 - 小工具”进行主题边栏设置

		</div>

<?php endif; ?>

</div>

<!-- side -->

