<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package infiniture
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php echo 'Nothing Found'; ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php
				printf( '发布一篇新的文章? <a href="%1$s">从这里开始</a>.', esc_url( admin_url( 'post-new.php' ) ) );
			?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php echo '抱歉, 没有找到您所搜索的内容，请重新搜索。'; ?></p>
			<?php
				get_search_form();

		else : ?>

			<p><?php echo '未能找到您所寻找的信息，请尝试搜索。'; ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
