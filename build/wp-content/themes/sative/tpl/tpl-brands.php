<?php /* Template Name: Our brands */ ?>
<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<main>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php if(have_rows('panels')) : ?>
		
			<section class="cards__container container">

                <div class="section__intro container">
                    <p class="section__title">
                        <?= get_field('title'); ?>
					</p>
					<?php if(get_field('text')) : ?>
						<hr>
						<div class="section__text">
							<?= get_field('text'); ?>
						</div>
					<?php endif; ?>
                </div>

				<?php while ( have_rows('panels') ) : the_row(); ?>
			
					<div class="cards__item">
						<div class="image">
							<?php $image = get_sub_field('image'); ?>
							<img src="<?= $image['url']; ?>" alt="<?= $image['alt'] ? $image['alt'] : null ?>">
						</div>
						<div class="text">

							<p class="text__title">
								<?= get_sub_field('title'); ?>
							</p>
							<hr>
							<p class="text__text">
								<?= get_sub_field('text'); ?>
							</p>

							<?php if(get_sub_field('cta')) : ?>
								<a href="<?= get_sub_field('cta')['url']; ?>" class="btn btn__smaller btn__full">
									<span>
										<?= get_sub_field('cta')['title']; ?>
									</span>
									<i class="icon-chevron_right_bold"></i>
								</a>
							<?php endif;?>
						
						</div>
					</div>

				<?php endwhile; ?>

				<?php if(get_field('cta')) : ?>

					<a href="<?= get_field('cta')['url']; ?>" class="btn btn__big">
						<span>
							<?= get_field('cta')['title']; ?>
						</span>
						<i class="icon-chevron_right_bold"></i>
					</a>

				<?php endif; ?>
			
			</section>
		
		<?php endif; ?>

		<?php if(get_field('about-title') && get_field('hide_section') !== true) : ?>
		
			<section class="homepage__about">
				<div class="container">

					<p class="homepage__about-title">
						<?= get_field('about-title'); ?>
					</p>
					<hr/>

					<?php if(get_field('about-content')) : ?>

						<div class="homepage__about-content">
							<?= get_field('about-content'); ?>
						</div>

					<?php endif; ?>

					<?php if(get_field('about-cta')) : ?>
						<a href="<?= get_field('about-cta')['url']; ?>" class="btn btn__smaller btn__full">
							<span>
								<?= get_field('about-cta')['title']; ?>
							</span>
							<i class="icon-chevron_right_bold"></i>
						</a>
					<?php endif; ?>
				
				</div>
			</section>
		
		<?php endif; ?>

	<?php endwhile; // end of the loop. ?>

</main>

<?php get_footer(); ?>