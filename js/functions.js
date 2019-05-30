/**

 * Theme functions file.

 *

 * Contains handlers for navigation and widget area.

 */

(function($) {

	var body, masthead, menuToggle, siteNavigation, socialNavigation, siteHeaderMenu, resizeTimer;

	function boatseller_initMainNavigation(container) {

		// Add dropdown toggle that displays child menu items.

		var dropdownToggle = $('<button />', {

			'class': 'dropdown-toggle',

			'aria-expanded': false

		}).append($('<span />', {

			'class': 'screen-reader-text',

			text: boatseller_screenReaderText.expand

		}));

		container.find('.menu-item-has-children > a').after(dropdownToggle);

		// Toggle buttons and submenu items with active children menu items.

		container.find('.current-menu-ancestor > button').addClass('toggled-on');

		container.find('.current-menu-ancestor > .sub-menu').addClass('toggled-on');

		// Add menu items with submenus to aria-haspopup="true".

		container.find('.menu-item-has-children').attr('aria-haspopup', 'true');

		container.find('.dropdown-toggle').click(function(e) {

			var _this = $(this),

				screenReaderSpan = _this.find('.screen-reader-text');

			e.preventDefault();

			_this.toggleClass('toggled-on');

			_this.next('.children, .sub-menu').toggleClass('toggled-on');

			// jscs:disable

			_this.attr('aria-expanded', _this.attr('aria-expanded') === 'false' ? 'true' : 'false');

			// jscs:enable

			//screenReaderText = '';

			screenReaderSpan.text(screenReaderSpan.text() === boatseller_screenReaderText.expand ? boatseller_screenReaderText.collapse : boatseller_screenReaderText.expand);

		});

	}

	boatseller_initMainNavigation($('.main-navigation'));

	masthead = $('#masthead');

	menuToggle = masthead.find('#menu-toggle');

	siteHeaderMenu = masthead.find('#site-header-menu');

	siteNavigation = masthead.find('#site-navigation');

	socialNavigation = masthead.find('#social-navigation');

	// Enable menuToggle.

	(function() {

		// Return early if menuToggle is missing.

		if (!menuToggle.length) {

			return;

		}

		// Add an initial values for the attribute.

		menuToggle.add(siteNavigation).add(socialNavigation).attr('aria-expanded', 'false');

		menuToggle.on('click.boatseller', function() {

			$(this).add(siteHeaderMenu).toggleClass('toggled-on');

			// jscs:disable

			$(this).add(siteNavigation).add(socialNavigation).attr('aria-expanded', $(this).add(siteNavigation).add(socialNavigation).attr('aria-expanded') === 'false' ? 'true' : 'false');

			// jscs:enable

		});

	})();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.

	(function() {

		if (!siteNavigation.length || !siteNavigation.children().length) {

			return;

		}

		// Toggle `focus` class to allow submenu access on tablets.

		function boatseller_toggleFocusClassTouchScreen() {

			if (window.innerWidth >= 890) {

				$(document.body).on('touchstart.boatseller', function(e) {

					if (!$(e.target).closest('.main-navigation li').length) {

						$('.main-navigation li').removeClass('focus');

					}

				});

				siteNavigation.find('.menu-item-has-children > a').on('touchstart.boatseller', function(e) {

					var el = $(this).parent('li');

					if (!el.hasClass('focus')) {

						e.preventDefault();

						el.toggleClass('focus');

						el.siblings('.focus').removeClass('focus');

					}

				});

			} else {

				siteNavigation.find('.menu-item-has-children > a').unbind('touchstart.boatseller');

			}

		}

		if ('ontouchstart' in window) {

			$(window).on('resize.boatseller', boatseller_toggleFocusClassTouchScreen);

			boatseller_toggleFocusClassTouchScreen();

		}

		siteNavigation.find('a').on('focus.boatseller blur.boatseller', function() {

			$(this).parents('.menu-item').toggleClass('focus');

		});

	})();

	// Add the default ARIA attributes for the menu toggle and the navigations.

	function boatseller_onResizeARIA() {

		if (window.innerWidth < 890) {

			if (menuToggle.hasClass('toggled-on')) {

				menuToggle.attr('aria-expanded', 'true');

			} else {

				menuToggle.attr('aria-expanded', 'false');

			}

			if (siteHeaderMenu.hasClass('toggled-on')) {

				siteNavigation.attr('aria-expanded', 'true');

				socialNavigation.attr('aria-expanded', 'true');

			} else {

				siteNavigation.attr('aria-expanded', 'false');

				socialNavigation.attr('aria-expanded', 'false');

			}

            menuToggle.attr('aria-controls', 'site-navigation social-navigation');

         } // < 890

		 else {

			menuToggle.removeAttr('aria-expanded');

			siteNavigation.removeAttr('aria-expanded');

			socialNavigation.removeAttr('aria-expanded');

			menuToggle.removeAttr('aria-controls');

		}

	}

	// Add 'below-entry-meta' class to elements.

	function boatseller_belowEntryMetaClass(param) {

		if (body.hasClass('page') || body.hasClass('search') || body.hasClass('single-attachment') || body.hasClass('error404')) {

			return;

		}

		$('.entry-content').find(param).each(function() {

			var element = $(this),

				elementPos = element.offset(),

				elementPosTop = elementPos.top,

				entryFooter = element.closest('article').find('.entry-footer'),

				entryFooterPos = entryFooter.offset(),

				entryFooterPosBottom = entryFooterPos.top + (entryFooter.height() + 28),

				caption = element.closest('figure'),

				newImg;

			// Add 'below-entry-meta' to elements below the entry meta.

			if (elementPosTop > entryFooterPosBottom) {

				// Check if full-size images and captions are larger than or equal to 840px.

				if ('img.size-full' === param) {

					// Create an image to find native image width of resized images (i.e. max-width: 100%).

					newImg = new Image();

					newImg.src = element.attr('src');

					$(newImg).on('load.boatseller', function() {

						if (newImg.width >= 840) {

							element.addClass('below-entry-meta');

							if (caption.hasClass('wp-caption')) {

								caption.addClass('below-entry-meta');

								caption.removeAttr('style');

							}

						}

					});

				} else {

					element.addClass('below-entry-meta');

				}

			} else {

				element.removeClass('below-entry-meta');

				caption.removeClass('below-entry-meta');

			}

		});

	}

	body = $(document.body);

	$(window).on('load.boatseller', boatseller_onResizeARIA).on('resize.boatseller', function() {

		clearTimeout(resizeTimer);

		resizeTimer = setTimeout(function() {

			boatseller_belowEntryMetaClass('img.size-full');

			boatseller_belowEntryMetaClass('blockquote.alignleft, blockquote.alignright');

		}, 300);

		boatseller_onResizeARIA();

	});

	boatseller_belowEntryMetaClass('img.size-full');

	boatseller_belowEntryMetaClass('blockquote.alignleft, blockquote.alignright');

	$("#display_loading").fadeOut("slow");

	var amountScrolled = 300;

	$(window).scroll(function() {

		if ($(window).scrollTop() > amountScrolled) {

			$('a.back-to-top').fadeIn('fast');

		} else {

			$('a.back-to-top').fadeOut('fast');

		}

	});

	$('a.back-to-top, a.simple-back-to-top').click(function() {

		$("html, body").animate({

			scrollTop: 0

		}, "fast");

		return false;

	}); /* Sticky Header */

	$(window).bind("load resize scroll", function(e) {

		win = $(window);

		var $wpAdminBar = $('#wpadminbar');

		if ($wpAdminBar.length) {

			var $wpAdminBarHeight = $wpAdminBar.height();

		} else {

			var $wpAdminBarHeight = 0;

		}

		if ($wpAdminBar.css("position") != "fixed") {

			$wpAdminBarHeight = 0;

		}

		var boatsellerwidth = document.body.offsetWidth;

		var top_header = $("#top_header");

		var site_header = $(".site-header");

		var site_header_main = $(".site-header-main");

        var site_header_menu = $(".site-header-menu");

        var custom_logo = $(".custom-logo");

		var boatseller_my_shopping_cart = $(".boatseller_my_shopping_cart");

		var pos = site_header.offset().top;

        var site_branding = $(".site-branding");

		boatsellerwidth = document.body.offsetWidth;

		var rolou = win.scrollTop();

		rolar = rolou;

        if (boatsellerwidth < 1000)

         {

            site_header_menu.attr('style', 'font-size: 12pt !important');

            jQuery('.search-toggle').hide();

            jQuery('.site-header-main').attr('style', 'border-bottom: 0px');

         }

         else

         {

             jQuery('.search-toggle').show();

         }

        if (boatsellerwidth < 1000 && boatsellerwidth > 890 )

         {

            site_branding.attr('style', 'max-width: 170px !important');

         }

         else

         {

             site_branding.attr('style', 'max-width: 220px !important');

         } 

		if (boatsellerwidth > 890) {

			if (rolou > 100) {

				rolar = rolou;

				site_header.attr('style', 'margin-top: -20px !important;') // , 'max-height: 50px!important');

				if ($wpAdminBar.length) {

					site_header_main.attr('style', 'margin-top: ' + ($wpAdminBarHeight + 25) + 'px !important');

				} else {

					site_header_main.attr('style', 'margin-top: 30px !important');

				}

				top_header.slideUp();

				boatseller_my_shopping_cart.attr('style', 'display: none !important');

				site_header.css({

					"max-height": "90px !important"

				});

                custom_logo.attr('style', 'max-width: 75% !important');

			} else // no rolou > 100

			{

				boatseller_my_shopping_cart.attr('style', 'margin-top: 40px !important;') // , 'max-height: 50px!important');

				site_header.attr('style', 'margin-top: -20px !important;') // , 'max-height: 50px!important');

				if ($wpAdminBar.length) {

					site_header_main.attr('style', 'margin-top: ' + ($wpAdminBarHeight + 15) + 'px !important');

				} else {

					site_header_main.attr('style', 'margin-top: 20px !important');

				}

				boatseller_my_shopping_cart.attr('style', 'display: block !important');

				top_header.attr('style', 'margin-top: 30px !important');

				if (boatsellerwidth > 890) {

					top_header.attr('style', 'display: block');

				} else {

					top_header.attr('style', 'display: block !important');

				}

				top_header.attr('style', 'margin-top: 30px !important');

                custom_logo.attr('style', 'max-width: 100% !important');

            }

		} else // < 911 985

		{

			top_header.attr('style', 'display: none !important');

            site_header.css({

				"position": "relative",

			});

			if (rolou > 100) {

				rolar = rolar + 120; /* era 60 */

				if ($wpAdminBar.length) {

					site_header_main.attr('style', 'margin-top: ' + ($wpAdminBarHeight) + 'px !important');

				} else {

					site_header_main.attr('style', 'margin-top: 0px !important;') // , 'max-height: 50px!important');

				}

				site_header.attr('style', 'margin-top: ' - rolar + 'px !important;') // , 'max-height: 50px!important');

				site_header.attr('style', 'padding-bottom: 10px !important;') // , 'max-height: 50px!important');

			} else // < 100 

			{

				site_header.attr('style', 'margin-top: 0px !important;') // , 'max-height: 50px!important');

				if ($wpAdminBar.length) {

					site_header_main.attr('style', 'margin-top: 0px !important');

				} else {

					site_header_main.attr('style', 'margin-top: 0px !important;') // , 'max-height: 50px!important');

				}

			}

		}

	});

	$("a").hover(

	function() {

		$(this).animate({

			opacity: .7

		}, 500);

	}, function() {

		$(this).animate({

			opacity: 1

		}, 500);

	});

})(jQuery);

jQuery(function() {

	jQuery(window).on('load', function() {

		jQuery("#boat-loader").fadeOut();

	});

});

jQuery(function() {

	var revapi5 = jQuery(document).ready(function() {

     

	}); // end doc ready...

	jQuery(function() {

		jQuery('#search-toggle').click(function(e) {

			if (jQuery('#boatseller_searchform').is(':visible')) {

                 jQuery("#boatseller_searchform").slideUp();

			} else {

				jQuery("#boatseller_searchform").slideDown();

			}

		});

		// Search toggle

		jQuery('.search-submit').click(function(e) {

			if (jQuery(this).parent().find('.search-field').val() == '') {

				e.preventDefault();

				jQuery("#boatseller_searchform").slideUp();

			}

		});

		if (jQuery(".boatseller_blog_grid").length) {

			var m = new Masonry(jQuery('.boatseller_blog_grid').get()[0], {

				itemSelector: ".boatseller_masonry_thumbnail",

				gutter: 0

			});

		}

	});

});