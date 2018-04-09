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

function updateCartButton()
{
	$btn = $('button[name="update_cart"]');
	if($btn.is(':disabled') && $btn.val() !== $btn.data('value')) {
		$btn.attr('disabled', false);
	} else if($btn.val() === $btn.data('value')) {
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
			}, 250);
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

function initOwlCarousel() 
{
	
	var $owl = $('.owl-carousel');
	$owl.owlCarousel({
		loop: true,
		margin: 0,
		nav: false,
		dots: true,
		smartSpeed: 500,
		responsive: {
			0: {
				items: 1
			}
		}
	});

	$('.owl-next').click(function() {
		$owl.trigger('next.owl.carousel');
	});
	$('.owl-prev').click(function() {
		$owl.trigger('prev.owl.carousel');
	});
}

$(document).ready(function() {
	
	initOwlCarousel();
	configOpen();
	tabsSwitching();
	cartToggle();
	menuToggle();
	
	$( document ).on( 'found_variation', '.variations_form', function ( event, variation) {
		console.log(variation);
		$('.product__single-info').find('> .price').find('span').text((variation.display_price).toLocaleString('en'));
		$('.product__single-info').find('> .sub-price').find('span').text((variation.display_regular_price).toLocaleString('en'));
	});	

});

$(window).on('load', function() {

});

