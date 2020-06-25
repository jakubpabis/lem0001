<?php /* Template Name: Contact */ ?>
<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<section class="contact">
    <?php get_template_part( 'partials/breadcrumbs', 'none' ); ?>
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>

            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            <?php the_content(); ?>

        <?php endwhile; // end of the loop. ?>
    </div>
</section>

<?php get_footer(); ?>