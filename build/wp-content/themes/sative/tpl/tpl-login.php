<?php /* Template Name: Login */ ?>
<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>
<?php get_template_part( 'partials/breadcrumbs', 'none' ); ?>
<div class="container">
    
    <?php while ( have_posts() ) : the_post(); ?>

        <?php the_content(); ?>

    <?php endwhile; // end of the loop. ?>
</div>

<?php get_footer(); ?>