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

    <?php endwhile; // end of the loop. ?>
</section>

<?php get_footer(); ?>