<?php /* Template Name: Find dealer */ ?>
<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<section class="dealers">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>

            <div class="about__pod">
                <h1><?php the_title(); ?></h1>
                <?php the_post_thumbnail(); ?>
                <?php the_content(); ?>
            </div>

        <?php endwhile; // end of the loop. ?>
    </div>
</section>

<?php get_footer(); ?>