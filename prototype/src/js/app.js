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

function hasClass(el, cls) 
{
	return el.className && new RegExp("(\\s|^)" + cls + "(\\s|$)").test(el.className);
}

function jobsLoadingIndicator()
{
	var loader = document.getElementsByClassName('job-listing__list-container')[0];
	if(hasClass(loader, 'loading')) {
		loader.classList.remove('loading');
	} else {
		loader.classList.add('loading');
	}
}

function openSearch($el) 
{
	$el.classList.add('active');
	document.getElementById('search-field-general').classList.add('active');
	document.getElementById('header-social-links').classList.add('active');
	setTimeout(function() {
		document.getElementById('search-field-general-input').focus();
	}, 500);
}

function openFilters($el) 
{
	$el.parentNode.classList.toggle('active');
}

function hideSearch() 
{
	document.getElementById('search-field-general').classList.remove('active');
	document.getElementById('header-social-links').classList.remove('active');
	document.getElementsByClassName('search-btn')[0].classList.remove('active');
}

function showLang($el, event) 
{
	if(window.innerWidth <= 760 && !hasClass($el, 'active')) {
		event.preventDefault();
		$el.classList.add('active');
	} else if(window.innerWidth <= 760 && hasClass($el, 'active')) {
		event.preventDefault();
		$el.classList.remove('active');
	}
}

function showMenu($el) 
{
	if(hasClass($el, 'active')) {
		hideMenu();
	} else {
		$el.classList.add('active');
		document.getElementsByTagName('body')[0].classList.add('menu-active');
		document.getElementsByTagName('html')[0].classList.add('menu-active');
		document.getElementById('wrapper').classList.add('menu-active');
		setTimeout(function() {
			document.getElementById('wrapper').insertAdjacentHTML('afterend', '<div id="menuCloserButton"></div>');
			document.getElementById('menuCloserButton').addEventListener('click', hideMenu);
		}, 300);
	}
}

function hideMenu() 
{
	var elem = document.getElementById('menuCloserButton');
	document.getElementById('menu-btn').classList.remove('active');
	document.getElementsByTagName('body')[0].classList.remove('menu-active');
	document.getElementsByTagName('html')[0].classList.remove('menu-active');
	document.getElementById('wrapper').classList.remove('menu-active');
	elem.parentNode.removeChild(elem);
}

function showSubMenu($el)
{
	if(hasClass($el.nextElementSibling, 'active')) {
		$el.classList.remove('active');
		$el.nextElementSibling.classList.remove('active');
	} else {
		$el.classList.add('active');
		$el.nextElementSibling.classList.add('active');
	}
}

function checkboxLabel($el) 
{
	if($el.getElementsByTagName('input')[0].checked === true) {
		$el.classList.remove('active');
		$el.getElementsByTagName('input')[0].checked = false;
	} else {
		$el.classList.add('active');
		$el.getElementsByTagName('input')[0].checked = true;
	}
}

function siemaAutoplay($time, $siema, $carousel) 
{
	var timer = setInterval(function() {
		$siema.next();
	}, $time);
	$carousel.addEventListener('mouseenter', function() {
		clearInterval(timer);
	});
	$carousel.addEventListener('mouseleave', function() {
		timer = setInterval(function() {
			$siema.next();
		}, $time);
	});
}

function loadCarousel() 
{
	var siema = document.getElementById('siema-carousel');
	if(siema) {
		const mySiema = new Siema({
			selector: '#siema-carousel',
			duration: 500,
			easing: 'ease',
			perPage: 1,
			startIndex: 0,
			draggable: true,
			threshold: 20,
			loop: true
		});
		document.getElementById('siema-prev').addEventListener('click', function() {
			mySiema.prev()
		});
		document.getElementById('siema-next').addEventListener('click', function() {
			mySiema.next()
		});
		siemaAutoplay(5000, mySiema, siema);
	}
}

function getFileName($input, $el)
{
	$text = $input.value;
	document.getElementById($el).innerHTML = $text.split('\\')[2];
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

