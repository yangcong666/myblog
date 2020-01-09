<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Navolio_Light
 */


if ( ! function_exists( 'navolio_light_posts_pagination_nav' ) ) :
/**
 * This is for post pagination
 */
function navolio_light_posts_pagination_nav($wp_query = '', $custom_class = '', $page_url = false) {

    if(!$wp_query) {
        $wp_query = $GLOBALS['wp_query'];
    }

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    if($page_url == false) {
        $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    } else {
        $paged = ( isset($_GET['paged']) ? sanitize_text_field( wp_unslash( $_GET['paged'] ) ) : 1 );
    }
    
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    $div_class = ($custom_class != "") ? $custom_class : "";
    echo '<div class="pagination-block '. esc_attr( $div_class ) .' "><ul class="pagination">' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() ) {
        printf( '<li class="nav-previous">%s</li>' . "\n", wp_kses_post( get_previous_posts_link('<i class="fa fa-angle-left"></i>' ) ) );
    } 
    
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a class="page-numbers" href="%s">%s</a></li>' . "\n", wp_kses_post( $class ), esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li><span class="page-numbers dots">&hellip;</span></li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a class="page-numbers" href="%s">%s</a></li>' . "\n", wp_kses_post( $class ), esc_url( get_pagenum_link( $link ) ), wp_kses_post( $link ) );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li><span class="page-numbers dots">&hellip;</span></li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a class="page-numbers curent" href="%s">%s</a></li>' . "\n", wp_kses_post( $class ), esc_url( get_pagenum_link( $max ) ), wp_kses_post( $max ) );
    }


    /** Next Post Link */
    if ( get_next_posts_link() ) {
        printf( '<li class="nav-next">%s</li>' . "\n", wp_kses_post( get_next_posts_link( '<i class="fa fa-angle-right"></i>') ) );
    } 
    echo '</ul></div>' . "\n";
}
endif;


if ( ! function_exists( 'navolio_light_wp_link_pages' ) ) :
/**
 * To show wp_link_pages
 */
function navolio_light_wp_link_pages() {
    wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'navolio-light' ),
        'after'  => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
    ) );
}
endif;


if ( ! function_exists( 'navolio_light_the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function navolio_light_the_archive_description( $before = '', $after = '' ) {
    $description = apply_filters( 'get_the_archive_description', term_description() );

    if ( ! empty( $description ) ) {
        /**
         * Filter the archive description.
         *
         * @see term_description()
         *
         * @param string $description Archive description to be displayed.
         */

        echo wp_kses( $before, Navolio_Light_Static::html_allow() ) . wp_kses( $description, Navolio_Light_Static::html_allow() ) . wp_kses( $after, Navolio_Light_Static::html_allow() ); // WPCS: XSS OK
    }
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function navolio_light_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'navolio_light_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,

            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'navolio_light_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so navolio_light_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so navolio_light_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in navolio_light_categorized_blog.
 */
function navolio_light_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'navolio_light_categories' );
}
add_action( 'edit_category', 'navolio_light_category_transient_flusher' );
add_action( 'save_post',     'navolio_light_category_transient_flusher' );

/**
 * Navolio_Light Post Type Search
 * @package Navolio_Light
 * @since  1.0
 */
function navolio_light_post_type_search_query( $query ) {
    if ( is_search() && $query->is_main_query() && $query->get( 's' ) ) {
        $query->set( 'post_type', array('post', 'page', 'portfolio', 'product') );
        return $query;
    }
}
add_action( 'pre_get_posts', 'navolio_light_post_type_search_query' );
