<article id="comments">	
	<?php if ( post_password_required() ) : ?>
		<p>请输入密码查看评论。</p>
	<?php return; endif; ?>
	<?php if ( have_comments() ) : ?>
		<h3><?php comments_number(__('No Comments', '1 Comment', '% Comments' ));?></h3>
		<ol class="comment_list">
			<?php wp_list_comments( array ('avatar_size'=>24,'type'=>'comment'));?>
		</ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation">	
    	    	<span class="alignleft"><?php previous_comments_link(('&laquo; 上一页' )); ?></span>
        		<span class="alignright"><?php next_comments_link(( '下一页 &raquo;' )); ?></span>
    		</nav>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( ! comments_open() ) : ?>
		<p>评论被关闭！</p>
	<?php endif; ?>
	<?php comment_form(); ?>
</article>