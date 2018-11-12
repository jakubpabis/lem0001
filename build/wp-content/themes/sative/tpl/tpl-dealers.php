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

        <div class="dealers__grid container container-sml">

            <?php while ( have_rows('dealers') ) : the_row(); ?>

                <div class="dealers__grid-item">
                    <div class="image">
                        <?php $image = get_sub_field('logo'); ?>
                        <?php if(get_row_index() > 3) : ?>
                            <img class="lazy" src="<?= wp_get_attachment_image( $image, 'thumbnail' ) ?>" data-src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
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

<?php get_footer(); ?>