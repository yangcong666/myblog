<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package Navolio_Light
 * @since 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( has_post_thumbnail() ) { ?>
    <figure class="post-thumb">
        <?php
            if( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ) {
                $image_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
            } else {
                $image_alt = get_the_title();
            }
            the_post_thumbnail( 'navolio-light-single-full', array( 'class' => " img-responsive", 'alt' => $image_alt ));
        ?>
    </figure> <!-- /.post-thumb -->
    <?php } ?>
    <header class="entry-header">            
        <?php the_title( sprintf( '<h2 class="entry-title">', esc_url( get_permalink() ) ), '</h2>' ); ?>
    </header> <!-- /.entry-header -->

    <div class="entry-content">
    <?php 
        the_content(); 
        navolio_light_wp_link_pages();
    ?>
    </div> <!-- .entry-content --> 
</article> <!-- /.post-->
