<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package infiniture
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div id="post-main" class="post-main">

				<?php if ( have_posts() ) : 

					while ( have_posts() ) : the_post(); ?>
						<div class="posts">
							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<div class="post-header">
								  <h1 class="post-title"><?php the_title(); ?></h1>
								  <div class="post-meta">

										<span class="post-date">
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
												<?php the_time( get_option( 'date_format' ) ); ?>
											</a>
										</span>

										<span class="separator">/</span>
											
										<span class="post-author"><?php the_author_posts_link(); ?></span>
										
										<span class="separator">/</span>
										
										<?php comments_popup_link( '0 评论', '1 评论', '% 评论' ); ?>
										
										<?php if ( current_user_can( 'manage_options' ) ) { ?>
											<span class="separator">/</span>
											<?php edit_post_link( '编辑' ); ?>
										<?php } ?>
																
									</div>
								</div> <!-- .post-header -->
														                                    	    
								<div class="post-content">		            			
									<?php the_content(); ?>	
									<?php wp_link_pages(); ?>	        
								</div> <!-- .post-content -->

								<div class="post-footer">										
									<p class="post-categories">
										<span class="category-icon"><span class="front-flap"></span></span><?php the_category(', '); ?>
									</p>
									<?php if( has_tag() ) { ?>
										<p class="post-tags"><?php the_tags( '', '' ); ?></p>
									<?php } ?>				
									<div class="post-nav clear">
										<?php 
										$prev_post = get_previous_post();
										if ( ! empty( $prev_post ) ) : ?>
											<a class="post-nav-older" title="<?php echo '上一篇文章: '. get_the_title( $prev_post ); ?>" href="<?php echo get_permalink( $prev_post->ID ); ?>">
												<h5><?php echo '上一篇文章'; ?></h5>																
												<?php echo get_the_title( $prev_post ); ?>
											</a>
										<?php endif; ?>

										<?php
										$next_post = get_next_post();
										if ( ! empty( $next_post ) ): ?>
											<a class="post-nav-newer" title="<?php echo '下一篇文章: ' . get_the_title( $next_post ); ?>" href="<?php echo get_permalink( $next_post->ID ); ?>">
												<h5><?php echo '下一篇文章'; ?></h5>							
												<?php echo get_the_title( $next_post ); ?>
											</a>
										<?php endif; ?>
									</div> <!-- .post-nav -->		
								</div> <!-- .post-footer -->

								<?php 
								if ( comments_open() || get_comments_number() ) :
									comments_template( '', true );
								endif; 
								?>			                        
							</div> <!-- .post -->	
						</div> <!-- .posts -->
					<?php endwhile; 
				else: ?>
					<p><?php echo '找不到请求的文章，请重新尝试！'; ?></p>
				<?php endif; ?>   
			</div><!-- #post-main -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
