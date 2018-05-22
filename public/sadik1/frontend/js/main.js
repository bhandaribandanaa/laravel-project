jQuery(document).on('ready', function ($) {
	"use strict";

	/*--------------------------
	    SCROLLSPY ACTIVE
	---------------------------*/
	$('body').scrollspy({
		target: '.bs-example-js-navbar-scrollspy',
		offset: 65
	});


	/*--------------------------
	    STICKY MAINMENU
	---------------------------*/
	var $mainmenuSticky = $("#mainmenu-area");
	$mainmenuSticky.sticky({
		topSpacing: 0
	});


	/*--------------------------
	   HOME PARALLAX BACKGROUND
	----------------------------*/
	$(window).stellar({
		responsive: true,
		positionProperty: 'position',
		horizontalScrolling: false
	});


	/*--------------------------
	    PUSH MENU OPEN COLOSE
	---------------------------*/
	var $content = $('.push-menu-and-content');
	$('.push-menu-open-button').on('click', function () {
		$content.addClass('menu-open');
	});
	$('.push-menu-close').on('click', function () {
		$content.removeClass('menu-open');
	});

	/*--------------------------
	    SMOOTH SCROLL
	----------------------------*/
	$content.niceScroll({
		cursorwidth: "10px"
	});


	/*---------------------------
	    SMOOTH SCROLL
	-----------------------------*/
	$('ul#nav li a[href^="#"], .push-menu ul li a, a.navbar-brand,a.scrolltotop,.call-to-action a').on('click', function (event) {
		var id = $(this).attr("href");
		var offset = 40;
		var target = $(id).offset().top - offset;
		$('html, body').animate({
			scrollTop: target
		}, 1500, "easeInOutExpo");
		event.preventDefault();
	});


	/*----------------------------
	    SCROLL TO TOP
	------------------------------*/
	$(window).on("scroll", function () {
		var $totalHeight = $(window).scrollTop();
		var $scrollToTop = $(".scrolltotop");
		if ($totalHeight > 300) {
			$scrollToTop.fadeIn();
		} else {
			$scrollToTop.fadeOut();
		}
		if ($totalHeight + $(window).height() === $(document).height()) {
			$scrollToTop.css("bottom", "90px");
		} else {
			$scrollToTop.css("bottom", "20px");
		}


		// scroll and fade header text
		var scrollPosition = jQuery(this).scrollTop();
		jQuery('.welcome-text').css({
			'margin-top': -(scrollPosition / 4) + "px",
			'opacity': 1 - (scrollPosition / 400)
		});


		//Welcome Img Slide On Scrolling..
		var $topImageLagyer = $('.welcome-image-layer');
		$topImageLagyer.css('right', (0 + (scrollPosition / 8)) + '%');
	});


	/*-------------------------------
	    ABOUT WORK FLOW ACTIVE ON CLICK
	---------------------------------*/
	var $flowmenu = ('.single-work-flow');
	$('.single-work-flow').on('click', function (e) {
		$('.single-work-flow').removeClass('active');
		var $this = $(this);
		if (!$this.hasClass('active')) {
			$this.addClass('active');
		}
		e.preventDefault();

	});


	/*---------------------------
	    HOME SLIDER
	-----------------------------*/
	/*	var $homeSlider = $('.welcome-text-slider');
		$homeSlider.owlCarousel({
			merge: true,
			smartSpeed: 1000,
			loop: true,
			nav: false,
			navText: ['<i class="icofont icofont-thin-left"></i>', '<i class="icofont icofont-thin-right"></i>'],
			autoplay: true,
			autoplayTimeout: 3000,
			margin: 0,
			animateIn: 'fadeIn',
			animateOut: 'fadeOut',
			responsiveClass: true,
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 1
				},
				1000: {
					items: 1
				},
				1200: {
					items: 1
				}
			}
		});*/


	/*---------------------------
	    PROJECT SLIDER
	-----------------------------*/
	var $projectCarousel = $('.project-list');
	$projectCarousel.owlCarousel({
		merge: true,
		smartSpeed: 1000,
		loop: true,
		nav: false,
		center: true,
		navText: ['<i class="icofont icofont-thin-left"></i>', '<i class="icofont icofont-thin-right"></i>'],
		autoplay: true,
		autoplayTimeout: 3000,
		margin: 20,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 2
			},
			1000: {
				items: 3
			},
			1200: {
				items: 3
			}
		}
	});


	/*---------------------------
	    TESTMONIAL SLIDER
	-----------------------------*/
	var $testmonialCarousel = $('.testmonial-slider');
	$testmonialCarousel.owlCarousel({
		merge: true,
		smartSpeed: 1000,
		loop: true,
		nav: true,
		navText: ['<i class="icofont icofont-long-arrow-left"></i>', '<i class="icofont icofont-long-arrow-right"></i>'],
		autoplay: false,
		autoplayTimeout: 2000,
		margin: 30,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 1
			},
			700: {
				items: 1
			},
			1000: {
				items: 2
			}
		}
	});


	/*------------------------------
	    FOOTER FLICKR FEED POPUP
	-------------------------------*/
	var $flickrPopup = $('.flicker-popup');
	$flickrPopup.magnificPopup({
		type: 'image',
		removalDelay: 500, //delay removal by X to allow out-animation
		callbacks: {
			beforeOpen: function () {
				// just a hack that adds mfp-anim class to markup 
				this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				this.st.mainClass = this.st.el.attr('data-effect');
			}
		},
		gallery: {
			enabled: true
		},
		closeOnContentClick: true,
		midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
	});


	/*--------------------------
	    ACTIVE WOW JS
	----------------------------*/
	new WOW().init();

}(jQuery));



jQuery(window).on('load', function () {
	"use strict";
	/*--------------------------
	    PRE LOADER
	----------------------------*/
	var $preloader = $(".preeloader");
	$preloader.fadeOut(1000);
});
