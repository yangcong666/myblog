<div id="featured-area-1">
<?php if ( get_theme_mod('nevler_box_enable') && is_front_page() ) : ?>
	<div class="popular-articles col-md-12">
		<?php if (get_theme_mod('nevler_box_title') ) : ?>
		<div class="section-title">
			<?php echo get_theme_mod('nevler_box_title'); ?>
		</div>
		<?php endif; ?>	
		
		<?php /* Start the Loop */ $count=0; ?>
				<?php
		    		$args = array( 'posts_per_page' => 4, 'category' => get_theme_mod('nevler_box_cat') );
					$lastposts = get_posts( $args );
					foreach ( $lastposts as $post ) :
					  setup_postdata( $post ); ?>
				
				    <div class="col-md-3 col-sm-6 col-xs-6 imgcontainer">
				    	<div class="popimage">
				        <?php if (has_post_thumbnail()) : ?>	
								<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_post_thumbnail('nevler-pop-thumb'); ?></a>
						<?php else : ?>
								<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder2.jpg"; ?>"></a>
						<?php endif; ?>
							<div class="titledesc">
				            <h2><a href="<?php the_permalink() ?>"><?php echo the_title(); ?></a></h2>
				        </div>
				    	</div>	
				        <div class="postdate">
			            	<span class="day"><?php echo date_i18n( get_the_time('j') ); ?></span>
			            	<span class="month"><?php echo date_i18n( the_time('M') ); ?></span>
			            </div>
				    </div>
				    
				<?php $count++;
				if ($count == 4) break;
				 endforeach; ?>
				 <?php wp_reset_postdata(); ?>
	</div>

<?php endif; ?>
</div>