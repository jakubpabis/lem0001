<?php /* Template Name: Find dealer */ ?>
<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<section class="dealers">
    <?php while ( have_posts() ) : the_post(); ?>

        <div class="dealers__intro">
            <div class="container container-xsml">
                <h1 class="text-center"><?php the_title(); ?></h1>
                <?php the_content(); ?>
            </div>
        </div>

        <div class="dealers__map" id="dealers_map"></div>

        <div class="dealers__grid container container-sml">

            <?php while ( have_rows('dealers') ) : the_row(); ?>

                <div class="dealers__grid-item">
                    <div class="image">
                        <?php $image = get_sub_field('logo'); ?>
                        <?php if(get_row_index() > 3) : ?>
                            <img class="lazy" data-src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                        <?php else : ?>
                            <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                        <?php endif; ?>
                    </div>
                    <h3>
                        <?= get_sub_field('title'); ?>
                    </h3>
                    <hr/>
                    <div class="content">
                        <?= get_sub_field('content'); ?>
                    </div>
                </div>                
            
            <?php endwhile; ?>

        </div>

    <?php endwhile; // end of the loop. ?>
</section>
<script>
    function initMap() {

        var markers = [

            <?php while ( have_rows('dealers') ) : the_row(); ?>
                <?php $name = get_sub_field('title'); ?>
                <?php $lat = floatval(get_sub_field('latitude')); ?>
                <?php $lng = floatval(get_sub_field('longitude')); ?>
                <?php $index = get_row_index(); ?>

                <?php if(!empty($lat) && !empty($lng)) : ?>
                    ['<?= $name; ?>', <?= $lat; ?>, <?= $lng; ?>, <?= $index; ?>],
                <?php endif; ?>

            <?php endwhile; ?>

        ];

        // Create a map object and specify the DOM element
        // for display.
        var map = new google.maps.Map(document.getElementById('dealers_map'), {
            zoom: 6,
            center: new google.maps.LatLng(markers[0][1], markers[0][2]),
            styles: [
    {
        "featureType": "all",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "weight": "2.00"
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#9c9c9c"
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
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
        "featureType": "landscape",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
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
        "featureType": "road",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#eeeeee"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#7b7b7b"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "color": "#ffffff"
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
                "color": "#46bcec"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#c8d7d4"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#070707"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    }
]
        });

        var infowindow = new google.maps.InfoWindow();
        var marker, i;
        for (i = 0; i < markers.length; i++) {  
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(markers[i][1], markers[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }

        var bounds = new google.maps.LatLngBounds();
        for (var j = 0; j < markers.length; j++) {
            bounds.extend(new google.maps.LatLng(markers[j][1], markers[j][2]));
        }
        // Create a marker and set its position.
        map.fitBounds(bounds);

    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChUaXItSbUlby58mbo2-8VEG07BMKFphI&callback=initMap" async defer></script>
<?php get_footer(); ?>