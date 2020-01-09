<?php
/**
 * This template for displaying default layout
 *
 * @package Navolio_Light
 * @since 1.0
 */
?>
<!-- Blog Block
================================================== -->
<section class="blog-page-block pd-t-195 pd-b-135" id="content" role="main">
    <?php if ( is_archive() || is_search() ): ?>
    <!-- Page Header
    ================================================== --> 
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">            
                <?php if ( is_archive() ) {
                    the_archive_title( '<h2 class="header-page-title mrb-75">', '</h2>' );
                } elseif ( is_search() ) { ?>
                    <h2 class="header-page-title mrb-75"><?php printf( '<span>'.esc_html__( 'Search Results for', 'navolio-light' ).'</span>%s', get_search_query() ); ?></h2>
                <?php } ?>  
            </div><!-- /.col-md-12 -->
        </div><!-- /.row-->
    </div><!-- /.container -->
    <?php endif; ?>
    <div class="container blog-container">
        <?php 
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
        ?>
        <div class="row">
            <div class="<?php echo esc_attr( $post_columns_class ); ?>">
                <div class="blog-page-content">
                    <?php 
                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post(); 
                                get_template_part( 'template-parts/post/content', get_post_format() );
                            endwhile;  
                        else :  
                            get_template_part( 'template-parts/post/content', 'none' ); 
                        endif; 
                    ?> 
                    
                    <?php navolio_light_posts_pagination_nav(); ?>

                </div><!-- /.blog-page-content -->
            </div><!-- /.col-lg-8 -->

            <?php if( $sidebar_position !=='full' ) { ?>
            <div id="secondary" class="<?php echo esc_attr( $sidebar_columns_class ); ?>" role="complementary">
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