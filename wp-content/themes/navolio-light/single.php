<?php
/**
 * The template for displaying all single posts.
 *
 * @package Navolio_Light
 * @since 1.0
 */
get_header(); ?>

<!-- Blog Block
================================================== -->
<section class="blog-page-block content-area-main pd-t-220 pd-b-135">
    <div class="container blog-container">
        <div class="row">
            <?php
                if( get_post_meta( get_the_ID(), 'navolio_light_sidebar_position', true) && get_post_meta( get_the_ID(), 'navolio_light_sidebar_position', true) !=='default' ) {
                    $sidebar_position = get_post_meta( get_the_ID(), 'navolio_light_sidebar_position', true);
                    if ( $sidebar_position == 'full' ) {
                        $post_columns_class = 'col-lg-11 full-content';
                        $sidebar_columns_class = '';
                    } elseif ( $sidebar_position == 'left' ) {
                       $post_columns_class = 'col-lg-8 order-last';
                       $sidebar_columns_class = 'col-lg-4 order-first';
                    } else {
                        $post_columns_class = 'col-lg-8';
                        $sidebar_columns_class = 'col-lg-4';
                    }
                } else {
                    $sidebar_position = navolio_light_get_options('blog_sidebar_dispay');
                    if ( $sidebar_position == 'full' ) {
                        $post_columns_class = 'col-lg-11 full-content';
                        $sidebar_columns_class = '';
                    } elseif ( $sidebar_position == 'left' ) {
                       $post_columns_class = 'col-lg-8 order-last';
                       $sidebar_columns_class = 'col-lg-4 order-first';
                    } else {
                        $post_columns_class = 'col-lg-8';
                        $sidebar_columns_class = 'col-lg-4';
                    }
                }
            ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <div class="<?php echo esc_attr( $post_columns_class ); ?>">
                <div class="blog-page-content blog-single-page">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                        <?php if ( has_post_thumbnail() ) { ?>
                            <figure class="entry-thumb">
                                <?php 
                                if ( $sidebar_position == 'full' ) {
                                    navolio_light_post_featured_image(924, 450, true, false);
                                } elseif ( $sidebar_position == 'left' ) {
                                   navolio_light_post_featured_image(652, 418, true, false);
                                } else {
                                    navolio_light_post_featured_image(652, 418, true, false);
                                } ?> 
                            </figure><!-- /.entry-thumb -->
                        <?php } ?>

                        <div class="entry-content"> 
                            <div class="post-meta-content">
                                <span class="entry-date"><i class="fa fa-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></span>
                                <span class="entry-author"><i class="fa fa-user"></i> <?php echo the_author_posts_link(); ?></span><!--  /.entry-author -->
                                <span class="entry-category"><i class="fa fa-sitemap"></i> <?php the_category(', ' ); ?></span><!--  /.entry-author -->
                            </div><!--  /.post-meta-content --> 

                            <?php the_title( '<h2 class="entry-title w-700">', '</h2>' ); ?> 
                            <?php 
                                the_content(); 
                                navolio_light_wp_link_pages(); 
                            ?>
                        </div><!-- /.entry-content -->
                    </article><!-- /.post -->

                    <div class="single-post-footer">
                        <?php if( has_tag() ): ?>
                        <div class="entry-tag">
                            <?php the_tags(' ', ' ', ' '); ?>
                        </div><!-- /.entry-tag -->
                        <?php endif; ?>

                    </div><!-- /.single-post-footer -->
                </div><!-- /.blog-page-content -->
                
                <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || get_comments_number() ) :
                      comments_template();
                    endif;
                ?>
            </div><!-- /.col-lg-8 -->
            <?php endwhile; ?>
            <?php if( $sidebar_position !=='full' ) { ?>
            <div class="<?php echo esc_attr( $sidebar_columns_class ); ?>">
                <?php get_sidebar(); ?>
            </div><!-- /.col-lg-4 -->
            <?php } ?>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.blog-block -->

<!-- Mailchimp Block
================================================== -->
<section class="mailchip-block">
    <?php if( function_exists( 'navolio_light_mail_chimp_functions' ) ) {
        navolio_light_mail_chimp_functions();
    } ?>
</section><!--  /.mailchip-block -->

<?php get_footer(); ?>