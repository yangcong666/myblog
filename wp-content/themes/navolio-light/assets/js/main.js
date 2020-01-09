(function ($) {
	"use strict";
	
	var navolioLightApp = {
		/* ---------------------------------------------
		 Preloader
		--------------------------------------------- */
		preloader: function() {
			//After 2s preloader is fadeOut
			$('.preloader').delay(2000).fadeOut('slow');
			setTimeout(function() {
			    //After 2s, the no-scroll class of the body will be removed
			    $('body').removeClass('no-scroll');
			}, 2000); //Here you can change preloader time
		},
		/* ---------------------------------------------
		 Header Overlay
		--------------------------------------------- */
		header_overlay:function() {
			var $overlayClose = $('.overlay-close');
			$overlayClose.on('click', function(e) {
				e.preventDefault();
				$(this).parent().slideUp('slow');
			});

			var $searchExtend = $('.header-right .right-menu .search-extend');
			$searchExtend.on('click', function(e) {
				e.preventDefault();
				$overlayClose.parent().slideDown('slow');
			});
		},
		/* ---------------------------------------------
		 One Page Menu Script
		--------------------------------------------- */
		onePageMenu: function() {
			function onePageNav($selector) {
				var $navSelector = $($selector);
				$navSelector
				.not('[href="#"]')
				.not('[href="#0"]')
				.click(function(event) {
				    if ( location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname ) {
				      	var target = $(this.hash);
				      	target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

				      	$navSelector.removeClass("active");
				      	if( target.length) {
					      	if($(this)[0].hash.slice(1) === target[0].id) {
					      		$(this).addClass("active");
					      	} else {
					      		$(this).removeClass("active");
					      	}
				      	}
				     	
					    if (target.length) {
					        event.preventDefault();
					        $('html, body').animate({
					          	scrollTop: target.offset().top
					        }, 1000);
					    }
				    }
				});

				$navSelector.each(function(event) {
			      	var target = $(this.hash);
			      	if( target.length) {
				      	if(location.hash.slice(1) === target[0].id) {
				      		$(this).addClass("active");
				      	} else if(!location.hash) {
				      		
				      	} else {
				      		$(this).removeClass("active");
				      	}
			      	}
				});

				function onScroll(event){
				    var scrollPos = $(document).scrollTop();
				    $navSelector.each(function () {
				        var currLink = $(this);
		                if(currLink[0].hash !== "" && $(currLink[0].hash).position() !== undefined) {

	                		var $getNavHas = $(currLink).prop('href').split('#')[1],
	                			$getSection = $('#' + $getNavHas); 

	                		$getSection.each(function() {
		                		var $topPos = $(this).offset().top,
		                			$topPosRound = Math.round($topPos - 120 ),
		                			$presentPos = Math.round(scrollPos);

		                		if ($topPosRound <= $presentPos && $topPosRound + $(this).height() > $presentPos) {
		                		    $(currLink).parent().addClass("active"); 
		                		} else {
		                			$(currLink).parent().removeClass("active");
		                		}
	                		});
		                } else {
		                	return false;
		                }
				    });
				}

				$(document).on("scroll", onScroll);	     
			}
			onePageNav('.mainmenu li a');
			onePageNav('.btn-banner');
		},


		/* ---------------------------------------------
		 Litmus Menu
		--------------------------------------------- */
		sh_lm_menu: function() {
			// Sub Menu Indicator
			var $submenuIndicator = $('ul > li > .sub-menu');
			$submenuIndicator.prev().append('<i class="fa fa-angle-down"></i>');

			//Clone Mobile Menu
			var $submenu = $('.navigation .mainmenu').find('li').has('.sub-menu');
			$submenu.prepend("<span class='menu-click'><i class='menu-arrow fa fa-plus'></i></span>");
			var $mobileSubMenuOpen = $(".menu-click");
			$mobileSubMenuOpen.each(function() {

				var $self = $(this);
				$self.on("click", function(e) {
					e.stopImmediatePropagation();
				    $self.siblings(".sub-menu, .dropdown-menu").slideToggle("slow");
				    $self.children(".menu-arrow").toggleClass("menu-extend");
				});
			});


			// Mobile Menu
			function mobileNav($selector, $parentSelector) {
				var $mobileNav = $($selector);
				$mobileNav.on("click", function() {
					$($parentSelector).addClass('slide-left');
					$($parentSelector).parent().addClass('slide-left');
				});

				var $closeButton = $($parentSelector).find(".close-menu");
				$closeButton.each(function(){
					var $self = $(this);
					$self.on("click", function() {
						$self.parent($parentSelector).removeClass('slide-left');
						$self.parent($parentSelector).parent().removeClass('slide-left');
					});
				});

				$(document).on('click', function(e) {
					var $selectorType = $($parentSelector).add($mobileNav);
				    if ($selectorType.is(e.target) !== true && $selectorType.has(e.target).length === 0) {
				        $($parentSelector).removeClass("slide-left");
				        $($parentSelector).parent().removeClass("slide-left");
				    }				   
				});
			}
			mobileNav('.hamburger-menu', '.expand-block');

			var $navRightIssue = $(".header-middle .mainmenu ul li");
			$navRightIssue.on("mouseenter mouseleave", function (e) {
			    var $self = $(this);
			    if ($("ul", $self).length) {
			        var elm = $("ul:first", $self),
			            off = elm.offset(),
			            l = off.left,
			            w = elm.width(),
			            docW = $(".site-header").width(),
			            isEntirelyVisible = (l + w <= docW);

			        if (!isEntirelyVisible) {
			            $self.addClass("right-side-menu");
			        } 
			    }
			});



			//hamburger Menu
			$('.hamburger-btn-wrap').on('click', function(e) {
				e.preventDefault();
				$(this).toggleClass('active');
				$('.hamburger-block').toggleClass('active');
				$('.site-header').toggleClass('hamburger-header');
			});
		},
		/* ---------------------------------------------
		Portfolio / Hover Animation
		 --------------------------------------------- */
		hoverAnimation: function() {
			var IsoGriddoload = $('.portfolio-grid');
			IsoGriddoload.isotope({
			    itemSelector: '.item',
			    masonryHorizontal: {
			        rowHeight: 100
			    }
			});

			var ProjMli = $('.portfolio-filter-menu li a');
			var ProjGrid = $('.portfolio-grid');
			ProjMli.on('click', function(e) {
				e.preventDefault();
			    ProjMli.removeClass("active");
			    $(this).addClass("active");
			    var selector = $(this).attr('data-filter');
			    ProjGrid.isotope({
			        filter: selector,
			        animationOptions: {
			            duration: 750,
			            easing: 'linear',
			            queue: false,
			        }
			    });
			});
			
			$('[data-toggle="tooltip"]').tooltip();

			$('.video-popup-btn').magnificPopup({
			    disableOn: 700,
			    type: 'iframe',
			    mainClass: 'mfp-fade',
			    preloader: false,
			    removalDelay: 300,
			    fixedContentPos: false,
			});

			$('.img-popup-btn').magnificPopup({ 
				type: 'image', 
				gallery:{
					enabled: true
				}
			});
		},
		/* ---------------------------------------------
		Individual Select
		 --------------------------------------------- */
		sh_lm_select: function() {
			var $postVideo = $('.blog-single-page, .entry-content');
			$postVideo.fitVids();

			$('ul li.nav-item a').click(function (e) {
				e.preventDefault();
			    $('ul li.nav-item a.active').removeClass('active');
			});

			$('[data-toggle="tooltip"]').tooltip(); 
		},		
		/* ---------------------------------------------
		Coming Soon Timer
		 --------------------------------------------- */
		coming_soon_timer: function() {
			var $selector = $('.commingsoon-count');
			$selector.each(function(){
			    var $this = $(this),
			        data_year = $this.attr('data-year'),
			        data_month = $this.attr('data-month'),
			        data_day = $this.attr('data-day'),
			        data_hour = $this.attr('data-hour'),
			        data_minutes = $this.attr('data-minutes');
			    $this.syotimer({
			        year: data_year,
			        month: data_month,
			        day: data_day,
			        hour: data_hour,
			        minute: data_minutes
			    });    
			});
		},
		/* ---------------------------------------------
		 Service Item Mobile
		--------------------------------------------- */
		service_item_mobile: function() {
			var $aboutItem = $(".policy-xs-slider"),
				$owlOptions = {
					loop: false,
					margin: 0,
					responsive: {
						0:{
							items: 1
						},
						480 : {
							items: 1
						},
						580 : {
							items: 1
						},
						768 : {
						   items: 2
						},
						960 : {
						   items: 2
						}
					}
				};
				if($(window).width() < 970) {
					var $sliderActive = $aboutItem.owlCarousel($owlOptions);
					$aboutItem.addClass("owl-carousel");
				} else {
					$aboutItem.addClass("off");
				}

			$(window).on("resize", function() {
				if($(window).width() < 970) {
					if($(".policy-xs-slider").hasClass("off")) {
						var $sliderActive = $aboutItem.owlCarousel($owlOptions);
						$aboutItem.removeClass("off");
						$aboutItem.addClass("owl-carousel");
					}
				} else {
					if(!$(".policy-xs-slider").hasClass("off")) {
						$aboutItem.removeClass("owl-carousel");
						$aboutItem.addClass("off").trigger("destroy.owl.carousel");
						$aboutItem.find(".owl-stage-outer").children(":eq(0)").unwrap();
					}
				}
			});
		},

		/* ---------------------------------------------
		 Widget Mobile fix
		--------------------------------------------- */
		widget_mobile: function () {
		    function debouncer(func, timeout) {
		        var timeoutID, timeout = timeout || 500;
		        return function () {
		            var scope = this,
		                args = arguments;
		            clearTimeout(timeoutID);
		            timeoutID = setTimeout(function () {
		                func.apply(scope, Array.prototype.slice.call(args));
		            }, timeout);
		        }
		    }
		    function resized() {
		        var getWidgetTitle = $('.widget .widget-title');
		        var getWidgetTitleContent;
		        if ($(window).width() <= 991) {
		            getWidgetTitleContent = $('.widget .widget-title').nextAll().hide();
		            getWidgetTitle.addClass('expand-margin');
		            getWidgetTitle.on('click', function(e) {
		                e.stopImmediatePropagation();
		                $(this).toggleClass('expand');
		                $(this).nextAll().slideToggle();
		                return false;
		            });
		            getWidgetTitle.each(function(){
		                $(this).addClass('mb-widget');
		            });
		        } else {
		            getWidgetTitleContent = $('.widget .widget-title').nextAll().show();
		            getWidgetTitle.removeClass('expand-margin');
		            getWidgetTitle.each(function(){
		                $(this).parent().removeClass('mb-widget');
		            });
		        };
		    }
		    resized();

		    var prevW = window.innerWidth || $(window).width();
		    $(window).resize(debouncer(function (e) {
		        var currentW = window.innerWidth || $(window).width();
		        if (currentW != prevW) {
		            resized();
		        }
		        prevW = window.innerWidth || $(window).width();
		    }));

		    //Mobile Responsive
		    var $extendBtn = $(".extend-btn .extend-icon");
		    $extendBtn.on("click", function(e) {
		        e.preventDefault();
		        var $self = $(this);
		        $self.parent().prev().toggleClass("mobile-extend");
		        $self.parent().toggleClass("extend-btn");
		        $self.toggleClass("up");
		    });
		},
 		/* ---------------------------------------------
		 Date Picker
		 --------------------------------------------- */
		datePicker: function() {
			var $dateSelector = $(".date-selector");
			var $timeSelector = $(".time-selector");
			if($dateSelector.length) {			
				$dateSelector.datetimepicker({
				    yearOffset: 0,
				    lang:'en',
				    mask:true,
				    timepicker: false,
				    format:'d/m/Y',
				    formatDate:'Y/m/d',
				    minDate: "1"
				});
			}
			if($timeSelector.length) {			
				$timeSelector.datetimepicker({
				    datepicker:false,
				    format:'H:i',
				    step:5
				});
			}
		},
		/* ---------------------------------------------
		 Scroll top
		--------------------------------------------- */
	    scroll_top: function () {
	    	//Fixed Navbar
	    	var $fixedHeader = $('.sticky-header');
	    	$(window).on('scroll', function() {
	    		if($(this).scrollTop() >= $(this).height()) {
	    			$fixedHeader
	    			.addClass('sticky-show')
	    			.removeClass('sticky-hide');
	    		} else if($(this).scrollTop() >= 100) {
	    			$fixedHeader
	    			.addClass('sticky-hide')
	    			.removeClass('sticky-show');
	    		} else {
	    			$fixedHeader
	    			.removeClass('sticky-hide');
	    		}
	    	});

	    	//Scroll Top Event
	    	var $scroll_top_enable = navolioLight.scroll_top;
	    	if($scroll_top_enable == '1' ) {    		
		    	//Footer Scroll Top
				$("body").append("<a href='#top' id='scroll-top' class='topbutton btn-hide'><span class='fa fa-angle-up'></span></a>");
				
				var $scrolltop = $('#scroll-top');
				$(window).on('scroll', function() {
					if($(this).scrollTop() > $(this).height()) {
						$scrolltop
						.addClass('btn-show')
						.removeClass('btn-hide');
					} else {
						$scrolltop
						.addClass('btn-hide')
						.removeClass('btn-show');
					}
				});
				$("a[href='#top']").on('click', function() {
					$("html, body").animate({
						scrollTop: 0
					}, "normal");
					return false;
				});
	    	}

	    	var $sticky_contact_btn = navolioLight.sticky_contact;
	    	var $sticky_contact_url = navolioLight.sticky_contact_url;
	    	if($sticky_contact_btn == '1' ) {    		
		    	//Footer Scroll Top
				$("body").append("<a href='"+ $sticky_contact_url +"' class='contact-sticky-button  btn-hide'><span class='fa fa-at'></span></a>");
				
				var $contactScrolltop = $('.contact-sticky-button');
				$(window).on('scroll', function() {
					if($(this).scrollTop() > 450 ) {
						$contactScrolltop
						.addClass('btn-show')
						.removeClass('btn-hide');
					} else {
						$contactScrolltop
						.addClass('btn-hide')
						.removeClass('btn-show');
					}
				});
	    	}
		},
		/* ---------------------------------------------
		 function initializ
		 --------------------------------------------- */
		initializ: function() {
			navolioLightApp.onePageMenu();
			navolioLightApp.sh_lm_menu();
			navolioLightApp.sh_lm_select();
			navolioLightApp.coming_soon_timer();
			navolioLightApp.datePicker();
			navolioLightApp.scroll_top();
		}
	};
	/* ---------------------------------------------
	 Document ready function
	 --------------------------------------------- */
	$(function() {
		navolioLightApp.initializ();
	});

	$(window).on('load', function() {
		navolioLightApp.header_overlay();
		navolioLightApp.hoverAnimation();
		navolioLightApp.preloader();
		navolioLightApp.service_item_mobile();
	});
})(jQuery);
