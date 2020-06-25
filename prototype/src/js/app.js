'use strict';

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

function checkCookieMessage()
{
	if(getCookie('cookieConfirm') !== 'yes') {
		document.getElementById('cookieMessage').classList.add('show');
	}
}

function cookieAgree()
{
	setCookie('cookieConfirm', 'yes', 365);
	document.getElementById('cookieMessage').classList.remove('show');
}

function updateCartButton($el)
{
	$btn = $('button[name="update_cart"]');
	if($btn.is(':disabled') && $el.value != $($el).data('value')) {
		$btn.attr('disabled', false);
	} else if($el.value == $($el).data('value')) {
		$btn.attr('disabled', true);
	}
}

function initContactMap()
{
	var contact_map = document.getElementById('contact_map');
	var map = new google.maps.Map(contact_map, {
		center: {lat: 52.3214064, lng: 4.8788931},
		zoom: 14,
		scrollwheel: false,
		draggable: true,
		mapTypeControl: false,
		scaleControl: true,
		streetViewControl: true
	});
	var pathArray = location.href.split( '/' );
	var protocol = pathArray[0];
	var host = pathArray[2];
	var $url = protocol + '//' + host;
	var image = {
		url: $url+'/themes/searchit/assets/img/logo-pin.png',
		// This marker is 20 pixels wide by 32 pixels high.
		size: new google.maps.Size(160, 200),
		// The origin for this image is (0, 0).
		origin: new google.maps.Point(0, 0),
		// The anchor for this image is the base of the flagpole at (0, 32).
		anchor: new google.maps.Point(40, 100),
		scaledSize: new google.maps.Size(80, 100)
	};
	var marker = new google.maps.Marker({
		map: map,
		position: new google.maps.LatLng(52.3214064,4.8788931),
		icon: image
	});
	map.set('styles', 
		[
			{
				"featureType": "administrative",
				"elementType": "labels.text.fill",
				"stylers": [
					{
						"color": "#444444"
					}
				]
			},
			{
				"featureType": "landscape",
				"elementType": "all",
				"stylers": [
					{
						"color": "#f2f2f2"
					}
				]
			},
			{
				"featureType": "poi",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "road",
				"elementType": "all",
				"stylers": [
					{
						"saturation": -100
					},
					{
						"lightness": 45
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "simplified"
					}
				]
			},
			{
				"featureType": "road.arterial",
				"elementType": "labels.icon",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "transit",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "water",
				"elementType": "all",
				"stylers": [
					{
						"color": "#7f8ec1"
					},
					{
						"visibility": "on"
					}
				]
			}
		]
	);
}

function configOpen()
{
	$('.product__single-info').find('.select').on('focusin', function(e) {
		e.preventDefault();
		$(this).find('ul').slideDown(200);
	});

	$('.product__single-info').find('.select').on('focusout', function() {
		$(this).find('ul').slideUp(200);
	});

	$('.product__single-info').find('.select').find('li').on('click', function(e) {
		e.preventDefault();
		$(this).parent().slideUp(200).parent().find('span').text($(this).text());
	});
}

function tabsSwitching()
{
	$('.tabs__option').on('click', function() {
		var $this = $(this);
		var $tabActive = $('.tabs__option.active');
		var $bodyActive = $('.tabs__content.active');
		var $target = $('.tabs__content[data-tab='+$this.data("tab")+']');

		if(!$this.hasClass('active')) {

			$tabActive.removeClass('active');
			$bodyActive.removeClass('active');
			$this.addClass('active');
			$target.addClass('active');

		}

	});

}

function cartToggle()
{
	$('#cartOpenBTN, #cartOpenBTNMobile, #cartOpenBTNSuccess').on('click', function() {
		$('#wrapper').addClass('before-before-cart-open');
		$('body').addClass('cart-active');
		setTimeout(function() {
			$('#wrapper').addClass('before-cart-open');
		}, 10);
		setTimeout(function() {
			$('#wrapper').addClass('cart-open');
		}, 20);
	});

	$('.cart__close, #wrapper__overlay').on('click', function() {
		
		if($('#wrapper').hasClass('cart-open')) {
			$('body').removeClass('cart-active');
			$('#wrapper').removeClass('cart-open');
			setTimeout(function() {
				$('#wrapper').removeClass('before-cart-open');
				$('#wrapper').removeClass('before-before-cart-open');
			}, 600);
		}

	});

}

function menuToggle()
{
	$('#menuOpenBTN').on('click', function() {
		$('#wrapper').addClass('before-before-menu-open');
		$('body').addClass('menu-active');
		setTimeout(function() {
			$('#wrapper').addClass('before-menu-open');
		}, 10);
		setTimeout(function() {
			$('#wrapper').addClass('menu-open');
		}, 20);
	});

	$('.topbar__nav-mobile__close, #wrapper__overlay').on('click', function() {
		
		if($('#wrapper').hasClass('menu-open')) {
			$('body').removeClass('menu-active');
			$('#wrapper').removeClass('menu-open');
			setTimeout(function() {
				$('#wrapper').removeClass('before-menu-open');
				$('#wrapper').removeClass('before-before-menu-open');
			}, 250);
		}

	});

}

function subMenuToggle()
{
	$('a[data-action="dropdown"]').on('click', function(e) {
		e.preventDefault();
		$(this).parent().stop(true, true).toggleClass('active');
		$(this).next('.sub_menu').stop(true, true).toggleClass('active');
	});
}

function initOwlCarousel() 
{
	
	var $owl = $('.owl-carousel');
	$owl.owlCarousel({
		loop: false,
		rewind: true,
		margin: 0,
		nav: false,
		dots: false,
		speed: 500,
		autoplay: true,
		autoplayTimeout: 5000,
		autoplayHoverPause: true,
		responsive: {
			0: {
				items: 1
			}
		},
		onTranslated: owlCallback
	});

	function owlCallback(event) {
		var $position = event.item.index;
		$('.owl-miniatures').find('div').removeClass('active');
		$('.owl-miniatures').find('div[data-index="'+$position+'"]').addClass('active');
	}

	$('.owl-next').click(function() {
		$owl.trigger('next.owl.carousel');
	});
	$('.owl-prev').click(function() {
		$owl.trigger('prev.owl.carousel');
	});
	
	$('.owl-miniatures').find('div').on('click', function(e) {
		e.preventDefault();
		var $position = $(this).data('index');
		$owl.trigger('to.owl.carousel', [$position]);
	});

	$(document).on('change', '#pa_color', function(event) {
		var $selected = $(this).children("option:selected").val();
		var $position = $owl.find('img[data-col="'+$selected+'"]').parent().parent().index();
		$owl.trigger('to.owl.carousel', [$position]);
	});

}

function showSearch()
{
	$('.search__container').fadeIn(300).find('input').focus();
	$('html, body').css({'overflow' : 'hidden'});
	setTimeout(function() {
		$('.search__container').addClass('opened');
	}, 300);
}

function lazyImages()
{
	$('.lazy').each(function() {
		var $src = $(this).data('src');
		$(this).attr('src', $src).removeAttr('data-src');	
	});
}

function subMenu()
{
	var highest = 0, this_id;
	$('.topbar__nav-main').find('ul.menu').find('> li').on('mouseenter touchstart', function(e) {
		var $nav = $(this).find('.sub_menu');
		if($nav.is(':hidden')) {
			e.preventDefault();
		}
		$h = $('.topbar__nav-main').find('ul.menu').find('> li').find('.sub_menu').find('.item')
		$h.each( function(i,v){
			this_id = parseInt($(this).height());
			if (this_id > highest)
			{
				highest = this_id;
			}
		});
		$h.each(function() {
			$(this).css({'min-height' : highest});
		});
		if($nav.length) {
			$nav.stop(true, true).slideDown(300);
			setTimeout(function() {
				$nav.css({'min-height' : $nav.outerHeight(true)});
			}, 300);
		}
	});
	$('.topbar__nav-main').find('ul.menu').find('> li').on('mouseleave', function() {
		var $nav = $(this).find('.sub_menu');
		$nav.stop(true, true).css({'min-height' : '0'});
		$nav.stop(true, true).slideUp(200);
	});

	$('.topbar__nav-main').find('ul.menu').find('> li').find('.sub_menu').find('.item').on('mouseenter touchstart', function(e) {
		if($(this).find('> a').next('ul.subsub_menu').length && $(this).find('> a').next('ul.subsub_menu').is(':hidden')) {
			e.preventDefault();
		}
		if($(this).find('> a').next('ul.subsub_menu').length) {
			$(this).css({'min-height' : highest}).find('.img-cont').stop(true, true).slideUp(200);
			$(this).find('ul.subsub_menu').stop(true, true).delay(200).slideDown(150);
		}
	});
	$('.topbar__nav-main').find('ul.menu').find('> li').find('.sub_menu').find('.item').on('mouseleave', function() {
		var $item = $(this);
		$item.stop().css({'min-height' : '0'});
		$item.find('ul.subsub_menu').stop(true, true).slideUp(50);
		$item.find('.img-cont').stop(true, true).slideDown(250);
	});


	$('.topbar__nav-mobile').find('> ul').find('> li').find('> a').on('click', function(e) {
		if($(this).next('.sub_menu').length) {
			e.preventDefault();
		}
		$(this).next('.sub_menu').stop(true, true).slideToggle(300);
		var $this = $(this);
		setTimeout(function() {
			$this.parent().toggleClass('active');
		}, 300);
	});

	$('.topbar__nav-mobile').find('> ul').find('> li').find('.sub_menu').find('> ul').find('> li').find('> a').on('click', function(e) {
		if($(this).next('.subsub_menu').length) {
			e.preventDefault();
		}
		$(this).next('.subsub_menu').stop(true, true).slideToggle(300);
		var $this = $(this);
		setTimeout(function() {
			$this.parent().toggleClass('current-cat');
		}, 300);
	});

}

function checkLocal(el)
{
	if($(el).val() == 'local_pickup:8' || $(el).prev().val() == 'local_pickup:8') {
		$('#pickup_location_field').slideDown(300);
	} else {
		$('#pickup_location_field').slideUp(300);
	}

}


$(document).ready(function() {
	
	lazyImages();
	checkCookieMessage();
	initOwlCarousel();
	configOpen();
	tabsSwitching();
	cartToggle();
	menuToggle();
	subMenuToggle();
	//subMenu();

	$(document).on('click', function(e) {
		console.log( $.contains( document.getElementById('topbarmenu'), e.target ) );
		if( !$.contains( document.getElementById('topbarmenu'), e.target ) ) {
			$('.sub_menu.collapse').each(function() {
				var id = $(this).attr('id');
				$('#'+id).collapse('hide');
			});
		}
	});

	$('.dgwt-wcas-close, .dgwt-wcas-preloader').on('click', function() {
		$('.search__container').fadeOut(300).removeClass('opened');
		$('html, body').css({'overflow' : 'visible'});
	});
	
	$( document ).on( 'found_variation', '.variations_form', function ( event, variation) {
		//console.log(variation);
		$('.product__single-info').find('> .price').find('span').text((variation.display_price).toLocaleString('en'));
		$('.product__single-info').find('> .sub-price').find('span').text((variation.display_regular_price).toLocaleString('en'));
	});

	$('body').on('click', function(event){
		if(!$(event.target).is('form.dgwt-wcas-search-form') && !$(event.target).is('.dgwt-wcas-search-input') && !$(event.target).is('.dgwt-wcas-sf-wrapp') && $('.search__container').hasClass('opened')){
			$('.search__container').fadeOut(300).removeClass('opened');
			$('html, body').css({'overflow' : 'visible'});
		}
	});

});

$(window).on('load', function() {

	$('.warranty__title, .warranty__extra').each(function() {

		if(!$(this).parent().hasClass('warranty__full')){
			$(this).parent().addClass('warranty__full');
		}

	});

	setTimeout(function() {
		$('.warranty__title, .warranty__extra').each(function() {

			if(!$(this).parent().hasClass('warranty__full')){
				$(this).parent().addClass('warranty__full');
			}
			
		});
	}, 500);

});

