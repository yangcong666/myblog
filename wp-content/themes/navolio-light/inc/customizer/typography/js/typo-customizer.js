/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @package Navolio_Light
 * @since 1.0
 */
function navlolioLightGetCss( arraySizes, settings, to ) {
    'use strict';
     var data, desktopVal,
         className = settings.styleClass, i = 1;

    var val = JSON.parse( to );
    if ( typeof( val ) === 'object' && val !== null ) {
       if ('desktop' in val) {
           desktopVal = val.desktop;
       }
    }

    for ( var key in arraySizes ) {
        // skip loop if the property is from prototype
        if ( ! arraySizes.hasOwnProperty( key )) {
            continue;
        }
        var obj = arraySizes[key];
        var limit = 0;
        var correlation = [1,1,1];
        if ( typeof( val ) === 'object' && val !== null ) {

            if( typeof obj.limit !== 'undefined'){
                limit = obj.limit;
            }

            if( typeof obj.correlation !== 'undefined'){
                correlation = obj.correlation;
            }
            data = {
                desktop: ( parseInt(parseFloat( desktopVal ) / correlation[0]) + obj.values[0]) > limit ? ( parseInt(parseFloat( desktopVal ) / correlation[0]) + obj.values[0] ) : limit,
            };
        } else {
            if( typeof obj.limit !== 'undefined'){
                limit = obj.limit;
            }

            if( typeof obj.correlation !== 'undefined'){
                correlation = obj.correlation;
            }
            data =( parseInt( parseFloat( to ) / correlation[0] ) ) + obj.values[0] > limit ? ( parseInt( parseFloat( to ) / correlation[0] ) ) + obj.values[0] : limit;
        }
        settings.styleClass = className + '-' + i;
        settings.selectors  = obj.selectors;

        navlolioLightSetCss( settings, data );
        i++;
    }
}

/**
 * Add media query on settings from setStyle function.
 *
 * @param settings
 * An object with the following components:
 *  styleClass class that will be on style tag
 *  selectors specified selectors
 *
 * @param to
 * Current value of the control
 */
function navlolioLightSetCss( settings, to ){
    'use strict';
    var result     = '';
    var styleClass = jQuery( '.' + settings.styleClass );
    if ( to !== null && typeof to === 'object' ) {
        jQuery.each(
            to, function ( key, value ) {
                var style_to_add;
                    style_to_add = settings.selectors + '{ ' + settings.cssProperty + ':' + value + settings.propertyUnit + '}';
                switch ( key ) {
                    case 'desktop':
                        result += style_to_add;
                        break;
                }
            }
        );
    } else {
        jQuery( settings.selectors ).css( settings.cssProperty, to + 'px' );
    }
}



/**
 * Live refresh for font size for:
 * pages/posts titles
 */
wp.customize(
    'navolio_light_options[body_font_size]', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'body'
                };
                var arraySizes = {
                    size: { selectors: 'body', values: [0] }
                };
               
                navlolioLightGetCss( arraySizes, settings, to );
            }
        );
    }
);
wp.customize(
    'navolio_light_options[site_title_font_size]', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'body'
                };

                var arraySizes = {
                    size: { selectors: '.site-title', values: [0] }
                };

                navlolioLightGetCss( arraySizes, settings, to );
            }
        );
    }
);

wp.customize(
    'navolio_light_options[menu_font_size]', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'body'
                };

                var arraySizes = {
                    size: { selectors: '.navigation .mainmenu > li > a', values: [0] }
                };

                navlolioLightGetCss( arraySizes, settings, to );
            }
        );
    }
);
wp.customize(
    'navolio_light_options[post_blockquote_content]', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'body'
                };

                var arraySizes = {
                    size: { selectors: 'blockquote', values: [0] }
                };

                navlolioLightGetCss( arraySizes, settings, to );
            }
        );
    }
);

wp.customize(
    'navolio_light_options[post_title_content]', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'body'
                };

                var arraySizes = {
                    size: { selectors: '.post .entry-title', values: [0] }
                };
                navlolioLightGetCss( arraySizes, settings, to );
            }
        );
    }
);

wp.customize(
    'navolio_light_options[heading_one_content]', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'body'
                };

                var arraySizes = {
                    size: { selectors: 'h1', values: [0] }
                };
                navlolioLightGetCss( arraySizes, settings, to );
            }
        );
    }
);

wp.customize(
    'navolio_light_options[heading_two_content]', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'body'
                };

                var arraySizes = {
                    size: { selectors: 'h2', values: [0] }
                };
                navlolioLightGetCss( arraySizes, settings, to );
            }
        );
    }
);

wp.customize(
    'navolio_light_options[heading_three_content]', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'body'
                };

                var arraySizes = {
                    size: { selectors: 'h3', values: [0] }
                };
                navlolioLightGetCss( arraySizes, settings, to );
            }
        );
    }
);

wp.customize(
    'navolio_light_options[heading_four_content]', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'body'
                };

                var arraySizes = {
                    size: { selectors: 'h4', values: [0] }
                };
                navlolioLightGetCss( arraySizes, settings, to );
            }
        );
    }
);

wp.customize(
    'navolio_light_options[heading_five_content]', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'body'
                };

                var arraySizes = {
                    size: { selectors: 'h5', values: [0] }
                };
                navlolioLightGetCss( arraySizes, settings, to );
            }
        );
    }
);

wp.customize(
    'navolio_light_options[heading_six_content]', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'body'
                };

                var arraySizes = {
                    size: { selectors: 'h6', values: [0] }
                };
                navlolioLightGetCss( arraySizes, settings, to );
            }
        );
    }
);

wp.customize(
    'navolio_light_options[body_font_color]', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                jQuery( 'body' ).css({ 'color': to });
            }
        );
    }
);

wp.customize(
    'navolio_light_options[heading_font_color]', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                jQuery( 'h1,h2,h3,h4,h5,h6' ).css({ 'color': to });
            }
        );
    }
);

wp.customize(
    'navolio_light_options[site_title_color]', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                jQuery( '.site-branding-text .site-title' ).css({ 'color': to });
            }
        );
    }
);

wp.customize(
    'navolio_light_options[description_title_color]', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                jQuery( '.site-branding-text .site-description' ).css({ 'color': to });
            }
        );
    }
);
