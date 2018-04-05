<?php /* Template Name: Home page */ ?>
<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<main>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php if(have_rows('slide')) : ?>

			<div class="slider__container">
				<div class="owl-carousel owl-theme slider__full">

					<?php while ( have_rows('slide') ) : the_row(); ?>
						
						<div class="item">

							<?php if(get_sub_field('slide_type') === 'video') : ?>

								<div class="embed-container">
									<iframe class="mute-video" type="text/html" src="<?= get_sub_field('slide_video'); ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
								</div>

							<?php else : ?>

								<?php $image = get_sub_field('slide_photo'); ?>
								<img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">

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

			</div>

		<?php endif; ?>

		<?php if(have_rows('section')) : 

			while ( have_rows('section') ) : the_row(); ?>

				<section class="products container">

					<div class="section__intro container">
						<p class="section__title">
							<?= get_sub_field('title'); ?>
						</p>
						<hr>
						<div class="section__text">
							<?= get_sub_field('text'); ?>
						</div>
					</div>

					<?php if(have_rows('products')) : ?>

						<div class="products__container">

							<?php while ( have_rows('products') ) : the_row(); ?>

								<?php $product = wc_get_product( get_sub_field('product') ); ?>
								
								<div class="products__item">
									<div class="products__item-photo">
										<img src="<?= get_the_post_thumbnail_url( $product->get_id(), 'medium' ); ?>" alt="" width="300">
									</div>
									<div class="products__item-text">
										<?php do_action('sative_homepage_product_title', get_sub_field('product')); ?>
										<?php $currency = get_woocommerce_currency_symbol(); ?>
										<?php if ( $product->is_type( 'variable' ) && $product->get_variation_regular_price( 'min', true ) != $product->get_variation_price( 'min', true ) ) : ?>
											<p class="price">
												price online: <span><?= number_format( $product->get_variation_price( 'min', true ), $decimals=2, $dec_point=".", $thousands_sep="," ); ?></span> <?= $currency; ?>
											</p>
											<p class="sub-price">
												regular price: <span><?= number_format( $product->get_variation_regular_price( 'min', true ), $decimals=2, $dec_point=".", $thousands_sep="," ); ?></span> <?= $currency; ?>
											</p>
										<?php elseif ( $product->get_sale_price() ) : ?>
											<p class="price">
												price online: <span><?= number_format( $product->get_sale_price(), $decimals=2, $dec_point=".", $thousands_sep="," ); ?></span> <?= $currency; ?>
											</p>
											<p class="sub-price">
												regular price: <span><?= number_format( $product->get_regular_price(), $decimals=2, $dec_point=".", $thousands_sep="," ); ?></span> <?= $currency; ?>
											</p>
										<?php elseif ( $product->get_price() ) : ?>
											<p class="price">
												<span><?= number_format( $product->get_price(), $decimals=2, $dec_point=".", $thousands_sep="," ); ?></span> <?= $currency; ?>
											</p>
										<?php endif; ?>
									</div>
									<div class="products__item-btn">
										View product
										<i class="icon-chevron_right_bold"></i>
									</div>
								</div>

							<?php endwhile; ?>
						
						</div>

						<a href="" class="btn btn__normal">
							<span>Start shopping</span>
							<i class="icon-chevron_right_bold"></i>
						</a>

					<?php endif; ?>

				</section>

			<?php endwhile;

		endif; ?>

	<?php endwhile; // end of the loop. ?>

</main>

<?php get_footer(); ?>