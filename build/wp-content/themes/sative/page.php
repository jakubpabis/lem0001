<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<main class="generic article">
    <div class="container container-sml">
        <?php while ( have_posts() ) : the_post(); ?>

            <?php the_title( '<h1 class="entry-title text-center">', '</h1>' ); ?>
            <?php the_content(); ?>

        <?php endwhile; // end of the loop. ?>
    </div>
</main>  

<?php get_footer(); ?>