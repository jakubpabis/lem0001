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

$(document).ready(function() {
	
	$('.owl-carousel').owlCarousel({
		loop: true,
		margin: 0,
		nav: true,
		dots: true,
		smartSpeed: 500,
		navText: [
			'<i class="fa fa-chevron-left"></i>',
			'<i class="fa fa-chevron-right"></i>'
		],
		// video: true,
		// videoHeight: 100,
		responsive: {
			0: {
				items: 1
			}
		}
	});

});

$(window).on('load', function() {

});

