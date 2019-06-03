/* JS Document */

/******************************

[Table of Contents]

1. Vars and Inits
2. Set Header
3. Init Custom Dropdown
4. Init Page Menu
5. Init Deals Slider
6. Init Tab Lines
7. Init Tabs
8. Init Featured Slider
9. Init Favorites
10. Init ZIndex
11. Init Popular Categories Slider
12. Init Banner 2 Slider
13. Init Arrivals Slider
14. Init Arrivals Slider ZIndex
15. Init Best Sellers Slider
16. Init Trends Slider
17. Init Reviews Slider
18. Init Recently Viewed Slider
19. Init Brands Slider
20. Init Timer


******************************/

$(document).ready(function () {
	"use strict";

	/* 

	1. Vars and Inits

	*/

	var menuActive = false;
	var header = $('.header');

	setHeader();

	initPageMenu();
	initDealsSlider();
	initTabLines();
	initFeaturedSlider();
	featuredSliderZIndex();
	initPopularSlider();
	initBanner2Slider();
	initFavs();
	initArrivalsSlider();
	arrivalsSliderZIndex();
	bestsellersSlider();
	initTabs();
	initTrendsSlider();
	initReviewsSlider();
	initViewedSlider();
	initBrandsSlider();
	initBannerSlider();
	// calcWidth();

	$(window).on('resize', function () {
		setHeader();
		featuredSliderZIndex();
		initTabLines();
		calcWidth();
	});



	function calcWidth() {
		var navwidth = 0;
		var morewidth = $('.main_nav_content  .more').outerWidth(true);
		$('.main_nav_content  > ul > li:not(.more)').each(function () {
			navwidth += $(this).outerWidth(true);
		});
		var availablespace = $('.main_nav_content ').outerWidth(true)// - morewidth;

		if (navwidth > availablespace) {
			var lastItem = $('.main_nav_content  > ul > li:not(.more)').last();
			lastItem.attr('data-width', lastItem.outerWidth(true));
			lastItem.prependTo($('.main_nav_dropdown .more ul'));
			calcWidth();
		} else {
			var firstMoreElement = $('.main_nav_content  li.more li').first();
			if (navwidth + firstMoreElement.data('width') < availablespace) {
				firstMoreElement.insertBefore($('.main_nav_content .more'));
			}
		}

		if ($('.more li').length > 0) {
			$('.more').css('display', 'inline-block');
		} else {
			$('.more').css('display', 'none');
		}
	}


	$(".cat_menu_toggle").click(function () {
		var
			elem = $(this).parent(),
			bool = elem.hasClass("open");
		$(".open").removeClass("open");
		if (!bool) elem.addClass("open");
	});

	$("#searchbar_toggle").click(function (e) {
		e.preventDefault();
		$("#searchbar").toggleClass('open');
	});

	$(".searchbar_overlay, .searchbar_close").click(function () {
		$("#searchbar").removeClass('open');
	});


	function initBannerSlider() {
		if ($('.banner-slider').length) {
			var bslider = $('.banner-slider');
			bslider.owlCarousel({
				items: 1,
				animateIn: 'fadeIn',
				animateOut: 'fadeOut',
				loop: false,
				navClass: ['banner_slider_prev', 'banner_slider_next'],
				nav: false,
				dots: false,
				smartSpeed: 1200,
				autoplay: false,
				autoplayTimeout: 5000
			});

			if ($('.banner_slider_prev').length) {
				var prev = $('.banner_slider_prev');
				prev.on('click', function () {
					bslider.trigger('prev.owl.carousel');
				});
			}

			if ($('.banner_slider_next').length) {
				var next = $('.banner_slider_next');
				next.on('click', function () {
					bslider.trigger('next.owl.carousel');
				});
			}
		}
	}


	/* 
	
	2. Set Header
	
	*/

	function setHeader() {
		//To pin main nav to the top of the page when it's reached
		//uncomment the following

		// var controller = new ScrollMagic.Controller(
		// {
		// 	globalSceneOptions:
		// 	{
		// 		triggerHook: 'onLeave'
		// 	}
		// });

		// var pin = new ScrollMagic.Scene(
		// {
		// 	triggerElement: '.main_nav'
		// })
		// .setPin('.main_nav').addTo(controller);

		if (window.innerWidth > 991 && menuActive) {
			closeMenu();
		}
	}

	/* 
	
	4. Init Page Menu
	
	*/

	function initPageMenu() {
		if ($('.page_menu').length && $('.page_menu_content').length) {
			var menu = $('.page_menu');
			var menuContent = $('.page_menu_content');
			var menuTrigger = $('.menu_trigger');

			//Open / close page menu
			menuTrigger.on('click', function () {
				if (!menuActive) {
					openMenu();
				}
				else {
					closeMenu();
				}
			});

			//Handle page menu
			if ($('.page_menu_item').length) {
				var items = $('.page_menu_item');
				items.each(function () {
					var item = $(this);
					if (item.hasClass("has-children")) {
						item.on('click', function (evt) {
							var subItem = item.find('> ul');
							if (subItem.hasClass('active')) {
								subItem.toggleClass('active');
								TweenMax.to(subItem, 0.3, { height: 0 });
							}
							else {
								evt.preventDefault();
								evt.stopPropagation();
								subItem.toggleClass('active');
								TweenMax.set(subItem, { height: "auto" });
								TweenMax.from(subItem, 0.3, { height: 0 });
							}
						});
					}
				});
			}
		}
	}

	function openMenu() {
		var menu = $('.page_menu');
		var menuContent = $('.page_menu_content');
		TweenMax.set(menuContent, { height: "auto" });
		TweenMax.from(menuContent, 0.3, { height: 0 });
		menuActive = true;
	}

	function closeMenu() {
		var menu = $('.page_menu');
		var menuContent = $('.page_menu_content');
		TweenMax.to(menuContent, 0.3, { height: 0 });
		menuActive = false;
	}

	/* 
	
	5. Init Deals Slider
	
	*/

	function initDealsSlider() {
		if ($('.deals_slider').length) {
			var dealsSlider = $('.deals_slider');
			dealsSlider.owlCarousel(
				{
					items: 1,
					loop: false,
					navClass: ['deals_slider_prev', 'deals_slider_next'],
					nav: false,
					dots: false,
					smartSpeed: 1200,
					margin: 30,
					autoplay: false,
					autoplayTimeout: 5000
				});

			if ($('.deals_slider_prev').length) {
				var prev = $('.deals_slider_prev');
				prev.on('click', function () {
					dealsSlider.trigger('prev.owl.carousel');
				});
			}

			if ($('.deals_slider_next').length) {
				var next = $('.deals_slider_next');
				next.on('click', function () {
					dealsSlider.trigger('next.owl.carousel');
				});
			}
		}
	}

	/* 
	
	6. Init Tab Lines
	
	*/

	function initTabLines() {
		if ($('.tabs').length) {
			var tabs = $('.tabs');

			tabs.each(function () {
				var tabsItem = $(this);
				var tabsLine = tabsItem.find('.tabs_line span');
				var tabGroup = tabsItem.find('ul li');

				var posX = $(tabGroup[0]).position().left;
				tabsLine.css({ 'left': posX, 'width': $(tabGroup[0]).width() });
				tabGroup.each(function () {
					var tab = $(this);
					tab.on('click', function () {
						if (!tab.hasClass('active')) {
							tabGroup.removeClass('active');
							tab.toggleClass('active');
							var tabXPos = tab.position().left;
							var tabWidth = tab.width();
							tabsLine.css({ 'left': tabXPos, 'width': tabWidth });
						}
					});
				});
			});
		}
	}

	/* 
	
	7. Init Tabs
	
	*/

	function initTabs() {
		if ($('.tabbed_container').length) {
			//Handle tabs switching

			var tabsContainers = $('.tabbed_container');
			tabsContainers.each(function () {
				var tabContainer = $(this);
				var tabs = tabContainer.find('.tabs ul li');
				var panels = tabContainer.find('.panel');
				var sliders = panels.find('.slider');

				tabs.each(function () {
					var tab = $(this);
					tab.on('click', function () {
						panels.removeClass('active');
						var tabIndex = tabs.index(this);
						$($(panels[tabIndex]).addClass('active'));
						sliders.slick("unslick");
						sliders.each(function () {
							var slider = $(this);
							// slider.slick("unslick");
							if (slider.hasClass('bestsellers_slider')) {
								initBSSlider(slider);
							}
							if (slider.hasClass('featured_slider')) {
								initFSlider(slider);
							}
							if (slider.hasClass('arrivals_slider')) {
								initASlider(slider);
							}
						});
					});
				});
			});
		}
	}

	/* 
	
	8. Init Featured Slider
	
	*/

	function initFeaturedSlider() {
		if ($('.featured_slider').length) {
			var featuredSliders = $('.featured_slider');
			featuredSliders.each(function () {
				var featuredSlider = $(this);
				initFSlider(featuredSlider);
			});

		}
	}

	function initFSlider(fs) {
		var featuredSlider = fs;
		featuredSlider.on('init', function () {
			var activeItems = featuredSlider.find('.slick-slide.slick-active');
			for (var x = 0; x < activeItems.length - 1; x++) {
				var item = $(activeItems[x]);
				item.find('.border_active').removeClass('active');
				if (item.hasClass('slick-active')) {
					item.find('.border_active').addClass('active');
				}
			}
		}).on(
			{
				afterChange: function (event, slick, current_slide_index, next_slide_index) {
					var activeItems = featuredSlider.find('.slick-slide.slick-active');
					activeItems.find('.border_active').removeClass('active');
					for (var x = 0; x < activeItems.length - 1; x++) {
						var item = $(activeItems[x]);
						item.find('.border_active').removeClass('active');
						if (item.hasClass('slick-active')) {
							item.find('.border_active').addClass('active');
						}
					}
				}
			})
			.slick(
				{
					rows: 2,
					slidesToShow: 4,
					slidesToScroll: 4,
					infinite: false,
					arrows: false,
					dots: true,
					responsive:
						[
							{
								breakpoint: 768, settings:
								{
									rows: 2,
									slidesToShow: 3,
									slidesToScroll: 3,
									dots: true
								}
							},
							{
								breakpoint: 575, settings:
								{
									rows: 2,
									slidesToShow: 2,
									slidesToScroll: 2,
									dots: false
								}
							},
							{
								breakpoint: 480, settings:
								{
									rows: 1,
									slidesToShow: 1,
									slidesToScroll: 1,
									dots: false
								}
							}
						]
				});
	}

	/* 
	
	9. Init Favorites
	
	*/

	function initFavs() {
		// Handle Favorites
		var items = document.getElementsByClassName('product_fav');
		for (var x = 0; x < items.length; x++) {
			var item = items[x];
			item.addEventListener('click', function (fn) {
				fn.target.classList.toggle('active');
			});
		}
	}

	/* 
	
	10. Init ZIndex
	
	*/

	function featuredSliderZIndex() {
		// Hide slider dots on item hover
		var items = document.getElementsByClassName('featured_slider_item');

		for (var x = 0; x < items.length; x++) {
			var item = items[x];
			item.addEventListener('mouseenter', function () {
				$('.featured_slider .slick-dots').css('display', "none");
			});

			item.addEventListener('mouseleave', function () {
				$('.featured_slider .slick-dots').css('display', "block");
			});
		}
	}

	/* 
	
	11. Init Popular Categories Slider
	
	*/

	function initPopularSlider() {
		if ($('.popular_categories_slider').length) {
			var popularSlider = $('.popular_categories_slider');

			popularSlider.owlCarousel(
				{
					loop: true,
					autoplay: false,
					nav: false,
					dots: false,
					responsive:
					{
						0: { items: 1 },
						575: { items: 2 },
						640: { items: 3 },
						768: { items: 4 },
						991: { items: 5 }
					}
				});

			if ($('.popular_categories_prev').length) {
				var prev = $('.popular_categories_prev');
				prev.on('click', function () {
					popularSlider.trigger('prev.owl.carousel');
				});
			}

			if ($('.popular_categories_next').length) {
				var next = $('.popular_categories_next');
				next.on('click', function () {
					popularSlider.trigger('next.owl.carousel');
				});
			}
		}
	}

	/* 
	
	12. Init Banner 2 Slider
	
	*/

	function initBanner2Slider() {
		if ($('.banner_2_slider').length) {
			var banner2Slider = $('.banner_2_slider');
			banner2Slider.owlCarousel(
				{
					items: 1,
					loop: true,
					nav: false,
					dots: true,
					dotsContainer: '.banner_2_dots',
					smartSpeed: 1200
				});
		}
	}

	/* 
	
	13. Init Arrivals Slider
	
	*/

	function initArrivalsSlider() {
		if ($('.arrivals_slider').length) {
			var arrivalsSliders = $('.arrivals_slider');
			arrivalsSliders.each(function () {
				var arrivalsSlider = $(this);
				initASlider(arrivalsSlider);
			});

		}
	}

	function initASlider(as) {
		var arrivalsSlider = as;
		arrivalsSlider.on('init', function () {
			var activeItems = arrivalsSlider.find('.slick-slide.slick-active');
			for (var x = 0; x < activeItems.length - 1; x++) {
				var item = $(activeItems[x]);
				item.find('.border_active').removeClass('active');
				if (item.hasClass('slick-active')) {
					item.find('.border_active').addClass('active');
				}
			}
		}).on(
			{
				afterChange: function (event, slick, current_slide_index, next_slide_index) {
					var activeItems = arrivalsSlider.find('.slick-slide.slick-active');
					activeItems.find('.border_active').removeClass('active');
					for (var x = 0; x < activeItems.length - 1; x++) {
						var item = $(activeItems[x]);
						item.find('.border_active').removeClass('active');
						if (item.hasClass('slick-active')) {
							item.find('.border_active').addClass('active');
						}
					}
				}
			})
			.slick(
				{
					rows: 2,
					slidesToShow: 5,
					slidesToScroll: 5,
					infinite: false,
					arrows: false,
					dots: true,
					responsive:
						[
							{
								breakpoint: 768, settings:
								{
									rows: 2,
									slidesToShow: 3,
									slidesToScroll: 3,
									dots: true
								}
							},
							{
								breakpoint: 575, settings:
								{
									rows: 2,
									slidesToShow: 2,
									slidesToScroll: 2,
									dots: false
								}
							},
							{
								breakpoint: 480, settings:
								{
									rows: 1,
									slidesToShow: 1,
									slidesToScroll: 1,
									dots: false
								}
							}
						]
				});
	}

	/* 
	
	14. Init Arrivals Slider ZIndex
	
	*/

	function arrivalsSliderZIndex() {
		// Hide slider dots on item hover
		var items = document.getElementsByClassName('arrivals_slider_item');

		for (var x = 0; x < items.length; x++) {
			var item = items[x];
			item.addEventListener('mouseenter', function () {
				$('.arrivals_slider .slick-dots').css('display', "none");
			});

			item.addEventListener('mouseleave', function () {
				$('.arrivals_slider .slick-dots').css('display', "block");
			});
		}
	}

	/* 
	
	15. Init Best Sellers Slider
	
	*/

	function bestsellersSlider() {
		if ($('.bestsellers_slider').length) {
			var bestsellersSliders = $('.bestsellers_slider');
			bestsellersSliders.each(function () {
				var bestsellersSlider = $(this);

				initBSSlider(bestsellersSlider);
			})
		}
	}

	function initBSSlider(bss) {
		var bestsellersSlider = bss;

		bestsellersSlider.slick(
			{
				rows: 2,
				infinite: true,
				slidesToShow: 3,
				slidesToScroll: 3,
				arrows: false,
				dots: true,
				autoplay: true,
				autoplaySpeed: 6000,
				responsive:
					[
						{
							breakpoint: 1199, settings:
							{
								rows: 2,
								slidesToShow: 2,
								slidesToScroll: 2,
								dots: true
							}
						},
						{
							breakpoint: 991, settings:
							{
								rows: 2,
								slidesToShow: 1,
								slidesToScroll: 1,
								dots: true
							}
						},
						{
							breakpoint: 575, settings:
							{
								rows: 1,
								slidesToShow: 1,
								slidesToScroll: 1,
								dots: false
							}
						}
					]
			});
	}

	/* 
	
	16. Init Trends Slider
	
	*/

	function initTrendsSlider() {
		if ($('.trends_slider').length) {
			var trendsSlider = $('.trends_slider');
			trendsSlider.owlCarousel(
				{
					loop: false,
					margin: 30,
					nav: false,
					dots: false,
					autoplayHoverPause: true,
					autoplay: false,
					responsive:
					{
						0: { items: 1 },
						575: { items: 2 },
						991: { items: 3 }
					}
				});

			trendsSlider.on('click', '.trends_fav', function (ev) {
				$(ev.target).toggleClass('active');
			});

			if ($('.trends_prev').length) {
				var prev = $('.trends_prev');
				prev.on('click', function () {
					trendsSlider.trigger('prev.owl.carousel');
				});
			}

			if ($('.trends_next').length) {
				var next = $('.trends_next');
				next.on('click', function () {
					trendsSlider.trigger('next.owl.carousel');
				});
			}
		}
	}

	/* 
	
	17. Init Reviews Slider
	
	*/

	function initReviewsSlider() {
		if ($('.reviews_slider').length) {
			var reviewsSlider = $('.reviews_slider');

			reviewsSlider.owlCarousel(
				{
					items: 3,
					loop: true,
					margin: 30,
					autoplay: true,
					autoplayTimeout: 3000,
					nav: false,
					dots: false,
					// dotsContainer: '.reviews_dots',
					responsive:
					{
						0: { items: 1 },
						768: { items: 2 },
						991: { items: 3 }
					}
				});
		}
	}

	/* 
	
	18. Init Recently Viewed Slider
	
	*/

	function initViewedSlider() {
		if ($('.viewed_slider').length) {
			var viewedSlider = $('.viewed_slider');

			viewedSlider.owlCarousel(
				{
					loop: true,
					margin: 30,
					nav: false,
					dots: false,
					responsive:
					{
						0: { items: 1 },
						575: { items: 2 },
						768: { items: 3 },
						991: { items: 4 },
						1199: { items: 6 }
					}
				});

			if ($('.viewed_prev').length) {
				var prev = $('.viewed_prev');
				prev.on('click', function () {
					viewedSlider.trigger('prev.owl.carousel');
				});
			}

			if ($('.viewed_next').length) {
				var next = $('.viewed_next');
				next.on('click', function () {
					viewedSlider.trigger('next.owl.carousel');
				});
			}
		}
	}

	/* 
	
	19. Init Brands Slider
	
	*/

	function initBrandsSlider() {
		if ($('.brands_slider').length) {
			var brandsSlider = $('.brands_slider');

			brandsSlider.owlCarousel(
				{
					loop: false,
					// rewind: true,
					// autoplay: true,
					// autoplayTimeout: 5000,
					nav: false,
					dots: false,
					autoWidth: true,
					items: 8,
					margin: 42
				});

			if ($('.brands_prev').length) {
				var prev = $('.brands_prev');
				prev.on('click', function () {
					brandsSlider.trigger('prev.owl.carousel');
				});
			}

			if ($('.brands_next').length) {
				var next = $('.brands_next');
				next.on('click', function () {
					brandsSlider.trigger('next.owl.carousel');
				});
			}
		}
	}
});

$(".sidebar_categories .sidebar_toggle").click(function () {
	const bool = $(this).parent().hasClass("open");
	$(".sidebar_categories > li").removeClass("open");
	if (!bool) $(this).parent().addClass("open");
});

$(".shop_sidebar_toggle").click(function () {
	$(this).toggleClass("close-icon");
	$(".shop_sidebar_overlay").toggle();
	$(".shop_sidebar").toggleClass('open');
});

if ($(this).innerWidth() <= 991 && $(this).scrollTop() >= 450) {
	$(".shop_sidebar_toggle").fadeIn(400);
} else {
	$(".shop_sidebar_toggle").fadeOut(400);
}

$(".shop_sidebar_overlay").click(function () {
	$(this).toggle();
	$(".shop_sidebar_toggle").removeClass('close-icon');
	$(".shop_sidebar").removeClass('open');
});

$(window).scroll(function () {
	if ($(this).innerWidth() <= 991 && $(this).scrollTop() >= 450) {
		$(".shop_sidebar_toggle").fadeIn(400);
	} else {
		$(".shop_sidebar_toggle").fadeOut(400);
	}
});

window.onkeydown = function (e) {
	if (e.keyCode === 27 && $(window).innerWidth() <= 991 && $(".shop_sidebar").hasClass("open")) {
		$(".shop_sidebar_toggle").removeClass('close-icon');
		$(".shop_sidebar_overlay").toggle();
		$(".shop_sidebar").removeClass("open");
	}
};