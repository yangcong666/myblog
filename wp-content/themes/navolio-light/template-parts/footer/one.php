<?php
/**
 * This template for displaying footer part
 *
 * @package Navolio_Light
 * @since 1.0
 */

/**
 * Footer Part show/hide condition
 *
 * @since 1.0
 */
if( get_post_meta( get_the_ID(), 'navolio_light_footer_show_footer', true) == 'no' ) {
    return;
} ?>
<!-- Footer
================================================== -->
<footer class="site-footer bg-blue-violet bd-t-white-20 pd-t-45 pd-b-30" id="footer" role="contentinfo">
    <div class="footer-copyright text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="copyright-text"><?php echo wp_kses_post( navolio_light_get_options( 'footer_copyright_info' ) ); ?></p> 
                </div><!--  /.col-md-6 -->
            </div><!--  /.row -->
        </div><!--  /.container -->
    </div><!--  /.footer-copyright -->
</footer><!--  /.site-footer -->