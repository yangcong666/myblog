/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */
(function( $ ) {

	// Collect information from customize-controls.js about which panels are opening.
	wp.customize.bind( 'preview-ready', function() {
		// Initially hide the theme option placeholders on load
		$( '.panel-placeholder' ).hide();
		wp.customize.preview.bind( 'section-highlight', function( data ) {

			// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
			if ( true === data.expanded ) {
				$( 'body' ).addClass( 'highlight-front-sections' );
				$( '.panel-placeholder' ).slideDown( 200, function() {
					$.scrollTo( $( '#panel1' ), {
						duration: 600,
						offset: { 'top': -70 } // Account for sticky menu.
					});
				});
			} else {
				$( 'body' ).removeClass( 'highlight-front-sections' );
				// Don't change scroll when leaving - it's likely to have unintended consequences.
				$( '.panel-placeholder' ).slideUp( 200 );
			}
		});
	});

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});
	//Banner Text
	wp.customize( 'navolio_light_options[blog_heading_text]', function( value ) {
		value.bind( function( to ) {
			$( '.blog-page-home.banner-post .banner-text h2.page-title' ).text( to );
		});
	});
	//Banner Height
	wp.customize( 'navolio_light_options[blog_banner_height]', function( value ) {
		value.bind( function( to ) {
			$( '.blog-page-home.banner-post' ).css({'height': ''+to+''});
		});
	});

	wp.customize( 'navolio_light_options[logo_margin_top]', function( value ) {
		value.bind( function( to ) {
			$( '.navbar-header .logo' ).css({'margin-top': ''+to+'px'});
		});
	});	

	wp.customize( 'navolio_light_options[logo_margin_bottom]', function( value ) {
		value.bind( function( to ) {
			$( '.navbar-header .logo' ).css({'margin-bottom': ''+to+'px'});
		});
	});

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
				// Add class for different logo styles if title and description are hidden.
				$( 'body' ).addClass( 'title-tagline-hidden' );
			} else {
				// Check if the text color has been removed and use default colors in theme stylesheet.
				if ( ! to.length ) {
					$( '#navolio-light-custom-header-styles' ).remove();
				}
				$( '.site-title, .site-description' ).css({
					clip: 'auto',
					position: 'relative'
				});
				$( '.site-branding-text .site-title' ).css({
					color: to
				});
				// Add class for different logo styles if title and description are visible.
				$( 'body' ).removeClass( 'title-tagline-hidden' );
			}
		});
	});

	// Page layouts.
	wp.customize( 'page_layout', function( value ) {
		value.bind( function( to ) {
			if ( 'one-column' === to ) {
				$( 'body' ).addClass( 'page-one-column' ).removeClass( 'page-two-column' );
			} else {
				$( 'body' ).removeClass( 'page-one-column' ).addClass( 'page-two-column' );
			}
		} );
	} );

	// Whether a header image is available.
	function hasHeaderImage() {
		var image = wp.customize( 'header_image' )();
		return '' !== image && 'remove-header' !== image;
	}

	// blog Grid
	wp.customize( 'navolio_light_options[dropdown_menu_bg]', function( value ) {
		value.bind( function( to ) {
			$( '.mainmenu .sub-menu, .mainmenu .sub-menu .sub-menu, .mainmenu .sub-menu .sub-menu .sub-menu' ).css({'background': ''+to+''});
		});
	});		

	wp.customize( 'navolio_light_options[menu_color]', function( value ) {
		value.bind( function( to ) {
			$( '.navigation .mainmenu > li > a' ).css({'color': ''+to+''});
		});
	});		

	wp.customize( 'navolio_light_options[dropdown_menu_color]', function( value ) {
		value.bind( function( to ) {
			$( '.mainmenu .sub-menu li a' ).css({'color': ''+to+''});
		});
	});	
	
	// Footer Background
	wp.customize( 'navolio_light_options[footer_background]', function( value ) {
		value.bind( function( to ) {
			$( 'footer.site-footer' ).css({'background': ''+to+''});
		});
	});	
	//Footer Text Color
	wp.customize( 'navolio_light_options[footer_color]', function( value ) {
		value.bind( function( to ) {
			$( 'footer.site-footer' ).css({'color': ''+to+''});
		});
	});	

	//Footer Link Color
	wp.customize( 'navolio_light_options[footer_link_color]', function( value ) {
		value.bind( function( to ) {
			$( 'footer.site-footer a' ).css({'color': ''+to+''});
		});
	});

	//Blog Content Padding
	wp.customize("navolio_light_options[top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-navolio_light_blog_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-navolio_light_blog_top_padding">.blog-page-block { padding-top: ' + to + "px; }</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("navolio_light_options[bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-navolio_light_blog_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-navolio_light_blog_bottom_padding">.blog-page-block { padding-bottom: ' + to + "px; }</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("navolio_light_options[tablet_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-navolio_light_blog_tablet_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-navolio_light_blog_tablet_top_padding">@media (max-width: 768px){ .blog-page-block { padding-top: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("navolio_light_options[tablet_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-navolio_light_blog_tablet_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-navolio_light_blog_tablet_bottom_padding">@media (max-width: 768px){ .blog-page-block { padding-bottom: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("navolio_light_options[mobile_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-navolio_light_blog_mobile_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-navolio_light_blog_mobile_top_padding">@media (max-width: 480px){ .blog-page-block { padding-top: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("navolio_light_options[mobile_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-navolio_light_blog_mobile_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-navolio_light_blog_mobile_bottom_padding">@media (max-width: 480px){ .blog-page-block { padding-bottom: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	//End Blog Content Padding

	//Logo Padding
	wp.customize("navolio_light_options[logo_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-navolio_light_logo_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-navolio_light_logo_top_padding">.site-header .site-logo { padding-top: ' + to + "px; }</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("navolio_light_options[logo_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-navolio_light_logo_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-navolio_light_logo_bottom_padding">.site-header .site-logo { padding-bottom: ' + to + "px; }</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("navolio_light_options[logo_tablet_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-navolio_light_logo_tablet_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-navolio_light_logo_tablet_top_padding">@media (max-width: 768px){ .site-header .site-logo { padding-top: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("navolio_light_options[logo_tablet_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-navolio_light_logo_tablet_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-navolio_light_logo_tablet_bottom_padding">@media (max-width: 768px){ .site-header .site-logo { padding-bottom: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("navolio_light_options[logo_mobile_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-navolio_light_logo_mobile_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-navolio_light_logo_mobile_top_padding">@media (max-width: 480px){ .site-header .site-logo { padding-top: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("navolio_light_options[logo_mobile_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-navolio_light_logo_mobile_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-navolio_light_logo_mobile_bottom_padding">@media (max-width: 480px){ .site-header .site-logo { padding-bottom: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	//End Logo Padding

} )( jQuery );
