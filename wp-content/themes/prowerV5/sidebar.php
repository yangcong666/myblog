<div id="sidebar">

		<div id="search" class="widget">		
			<form id="searchform" method="get" action="<?php home_url(); ?>">
				<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" size="30" />
				<button type="submit">Search</button>
			</form>
		</div>
		<div class="widget">
		<?php wp_link_pages(); ?>
		</div>
		<div class="widget">
			<h3>Archives</h3>
			<ul><?php wp_get_archives( array( 'type' => 'monthly' ) ); ?></ul>
		</div>
		<div class="widget">
			<h3>最新日志</h3>
			<?php if (is_home()) : ?>
	<?php query_posts('showposts=10'); ?>
	<ul>
		<?php while (have_posts()) : the_post(); ?>
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php endwhile;?>
	</ul>
	<?php wp_reset_query(); ?>
<?php else : ?>
	<?php $categories = get_the_category(); foreach ($categories as $category) : ?>

        <ul>
        <?php $posts = get_posts('numberposts=10&category='. $category->term_id); foreach($posts as $post) : ?>
          <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li> <?php endforeach; ?> <?php endforeach; ?>
        </ul>

<?php endif; ?>



		</div>
		<?php wp_list_bookmarks('title_before=<h3>&title_after=</h3>&category_before=<div id=%id class="linkcat widget">&category_after=</div>'); ?>
		<div class="widget">
			<h3>Meta</h3>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</div>

</div>
