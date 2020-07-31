<?php /* Template Name: Find dealer */ ?>
<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>
<section style="background-color: #f4f4f4;">
    <?php get_template_part( 'partials/breadcrumbs', 'none' ); ?>
</section>
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
                <?php $content = str_replace(array("\n", "\r"), ' ', get_sub_field('content')); ?>
                <?php $image = get_sub_field('logo')['url']; ?>

                <?php if(!empty($lat) && !empty($lng)) : ?>
                    ['<?= $name; ?>', <?= $lat; ?>, <?= $lng; ?>, <?= $index; ?>, '<?= $content; ?>', '<?= $image; ?>'],
                <?php endif; ?>

            <?php endwhile; ?>

        ];

        // Create a map object and specify the DOM element
        // for display.
        var map = new google.maps.Map(document.getElementById('dealers_map'), {
            zoom: 6,
            center: new google.maps.LatLng(markers[0][1], markers[0][2])
        });

        var infowindow = new google.maps.InfoWindow({
            maxWidth: 300,
            minWidth: 250
        });
        var marker, i, contentString;
        for (i = 0; i < markers.length; i++) {  

            marker = new google.maps.Marker({
                position: new google.maps.LatLng(markers[i][1], markers[i][2]),
                map: map,
                title: markers[i][0]
            });

            contentString = '<div class="dealers__map-infowindow">'+
                '<img src="'+markers[i][5]+'" alt="">'+
                '<h4>'+markers[i][0]+'</h4>'+
                markers[i][4]+
                '</div>';
            

            google.maps.event.addListener(marker, 'click', (function(marker, i, contentString) {
                return function() {
                    infowindow.setContent(contentString);
                    infowindow.open(map, marker);
                }
            })(marker, i, contentString));

        }

        var bounds = new google.maps.LatLngBounds();
        for (var j = 0; j < markers.length; j++) {
            bounds.extend(new google.maps.LatLng(markers[j][1], markers[j][2]));
        }
        // Create a marker and set its position.
        map.fitBounds(bounds);

    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_qPHs7-G-Z23AMS-9W9jOaWC2YI4oa88&callback=initMap" async defer></script>
<?php get_footer(); ?>