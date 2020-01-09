<div class="post-date-ribbon"><div class="corner"></div><?php the_time( 'Y年m月d日' ); ?></div>
		<?php if (get_option('ygj_paibanbj') == '图下') {?>
		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"  title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>		
		</header>
		<figure class="thumbnail">		
			<?php ygj_thumbnail(768,220);?>					
		</figure>
		<?php }else{?>
		<figure class="thumbnail">
			<?php if (get_option('ygj_paibanbj') == '图上') {ygj_thumbnail(768,220);}else{ygj_thumbnail(270,180);}?>					
		</figure>
		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>		
		</header>
		<?php }?>
		<div class="entry-content">
			<div class="archive-content">			 				
				<?php if ((get_option('ygj_cblbj') == '无侧边栏' && get_option('ygj_paibanbj') == '图下') || (get_option('ygj_cblbj') == '无侧边栏' && get_option('ygj_paibanbj') == '图上')) {$zynum=80;}elseif (get_option('ygj_cblbj') == '无侧边栏') {$zynum=160;}else{$zynum=80;}
if (has_excerpt()){ echo wp_trim_words( get_the_excerpt(), $zynum, '...' );} elseif (post_password_required()){echo wp_trim_words( get_the_content(), $zynum, '...' ); }else {echo wp_trim_words( get_the_content(), $zynum, '...' );}?>
			</div>
			<div class="entry-meta">
				<span class="post_cat"><i class="fa fa-folder" aria-hidden="true"></i>&nbsp;<?php the_category( ' | ' ) ?></span>
				<span class="views"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;<?php if( function_exists( 'the_views' ) ) { the_views(); print ' 人阅读'; } ;?></span>
				<span class="comment"><i class="fa fa-comment" aria-hidden="true"></i>&nbsp;<?php comments_popup_link( '0 条评论', '1 条评论', '% 条评论' ); ?></span>		
			</div>
			<div class="readMore"><a href="<?php the_permalink(); ?>" target="_blank" rel="nofollow">阅读全文</a></div>
			<div class="clear"></div>
		</div><!-- .entry-content -->