<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Navolio_Light
 * @since 1.0
 */
get_header(); ?> 

<!-- Error  Block
================================================== -->
<section class="error-page-block pd-t-220 pd-b-135">
    <div class="container error-content">
        <div class="text-center">
            <h2 class="error-title"><?php esc_html_e('Opps Page Not Found!!!!!', 'navolio-light'); ?></h2><!-- /.error-title -->
            <h2 class="error-main color-blue-violet"><?php esc_html_e('404', 'navolio-light'); ?></h2><!-- /.error-main -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="error-home-btn btn-md bg-blue-violet color-white rd-30"><?php esc_html_e('Go Home', 'navolio-light'); ?></a>
        </div>
    </div><!-- /.container -->
</section><!-- /.blog-block -->
<?php get_footer(); ?>