<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package Navolio_Light
 */
get_header();

$elemetor = get_post_meta( get_the_ID(), '_elementor_edit_mode');
if( $elemetor ) : 
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); ?> 
        <div class="navolio-light-page-builder-content clearfix">
            <?php the_content(); ?>
        </div>
        <?php 
        endwhile; 
    endif;
else: ?>
    <!-- Blog Block
    ================================================== -->
    <section class="blog-page-block content-area-main pd-t-195 pd-b-135" role="main" id="content">
        <div class="container blog-container">
            <div class="row">
                <?php while ( have_posts() ) : the_post(); ?>
                <div class="col-md-10 full-content">
                    <div class="blog-page-content blog-single-page site-single-post">
                        <article id="post-<?php the_ID(); ?>" <?php post_class(' post '); ?> >
                            <?php if ( has_post_thumbnail() ) { ?>
                                <figure class="entry-thumb">          
                                    <a href="<?php the_permalink(); ?>">
                                        <?php navolio_light_post_featured_image(655, 420); ?>
                                    </a> 
                                </figure><!-- /.entry-thumb -->
                            <?php } ?>

                            <div class="entry-content"> 
                                <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?> 
                                <?php 
                                    the_content(); 
                                    navolio_light_wp_link_pages(); 
                                ?>
                            </div><!-- /.entry-content -->
                        </article><!-- /.post -->

                    </div><!-- /.blog-page-content -->
                    
                    <div class="page-comments-area">             
                        <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || get_comments_number() ) :
                          comments_template();
                        endif;
                        ?>
                    </div><!--  /.page-comments-area -->
                </div><!-- /.col-md-9 full-content -->
                <?php endwhile; ?>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.blog-block -->
<?php endif; ?>
<?php get_footer(); ?>