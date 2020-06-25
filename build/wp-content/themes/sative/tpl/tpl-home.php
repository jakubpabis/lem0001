<?php /* Template Name: Home page */ ?>
<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<main class="homepage">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php if(have_rows('slide')) : ?>

			<section class="slider__container">
				<div class="owl-carousel owl-theme slider__full">

					<?php while ( have_rows('slide') ) : the_row(); ?>
						
						<div class="item">

							<?php if(get_sub_field('slide_type') === 'video') : ?>

								<div class="embed-container">
									<iframe class="mute-video" type="text/html" src="<?= get_sub_field('slide_video'); ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
								</div>

							<?php else : ?>

								<?php $image = get_sub_field('slide_photo'); ?>
								<?php if(get_row_index() > 1) : ?>
									<img class="lazy" data-src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
								<?php else : ?>
									<img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
								<?php endif; ?>

							<?php endif; ?>

							<?php if(get_sub_field('slide_title') || get_sub_field('slide_text') || get_sub_field('slide_cta')) : ?>
							
								<div class="slider__overlay">

									<?php if(get_sub_field('slide_title')) : ?>
										<p class="slider__title">
											<?= get_sub_field('slide_title'); ?>
										</p>
									<?php endif; ?>

									<?php if(get_sub_field('slide_text')) : ?>
										<p class="slider__text">
											<?= get_sub_field('slide_text'); ?>
										</p>
									<?php endif; ?>

									<?php if(get_sub_field('slide_cta')) : ?>
										<a href="<?= get_sub_field('slide_cta')['url']; ?>" class="btn btn__smaller btn__full">
											<span>
												<?= get_sub_field('slide_cta')['title']; ?>
											</span>
											<i class="icon-chevron_right_bold"></i>
										</a>
									<?php endif; ?>
									
								</div>
							
							<?php endif; ?>

						</div>

					<?php endwhile; ?>

				</div>

				<?php if(count(get_field('slide')) > 1) : ?>

					<div class="owl-prev">
						<i class="icon-chevron_left"></i>
					</div>
					<div class="owl-next">
						<i class="icon-chevron_right"></i>
					</div>

				<?php endif; ?>

			</section>

		<?php endif; ?>

		<?php if(have_rows('section')) : 

			while ( have_rows('section') ) : the_row(); ?>

				<section class="products container homepage">

					<div class="section__intro container">
						<p class="section__title">
							<?= get_sub_field('title'); ?>
						</p>
						<hr>
						<div class="section__text">
							<?= get_sub_field('text'); ?>
						</div>
						<?php if(get_sub_field('cta')) : ?>
							<a href="<?= get_sub_field('cta')['url']; ?>" class="btn btn__normal">
								<span><?= get_sub_field('cta')['title']; ?></span>
								<i class="icon-chevron_right_bold"></i>
							</a>
						<?php endif; ?>
					</div>

					<?php if(have_rows('products')) : ?>

						<div class="products__container">

							<?php while ( have_rows('products') ) : the_row(); ?>

								<?php $product = wc_get_product( get_sub_field('product') ); ?>

								<?php if( $product ) : ?>
								
								<div class="products__item">
									<div class="products__item-photo">
										<img class="lazy" data-src="<?= get_the_post_thumbnail_url( $product->get_id(), 'medium' ); ?>" alt="" width="360">
									</div>
									<div class="products__item-text">
										<?php do_action('sative_homepage_product_title', get_sub_field('product')); ?>
										<?php do_action('sative_homepage_price', $product); ?>
									</div>
									<?php /* <div class="products__item-btn">
										<?= __('View product'); ?>
										<i class="icon-chevron_right_bold"></i>
									</div> */ ?>
									<?php do_action('sative_homepage_product_link', get_sub_field('product')); ?>
								</div>

								<?php endif; ?>

							<?php endwhile; ?>
						
						</div>
					
					<?php endif; ?>

				</section>

			<?php endwhile;

		endif; ?>

		<?php if(have_rows('panels')) : ?>
		
			<section class="cards__container container">

				<?php while ( have_rows('panels') ) : the_row(); ?>
			
					<div class="cards__item">
						<div class="image">
							<?php $image = get_sub_field('image'); ?>
							<img class="lazy" data-src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
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