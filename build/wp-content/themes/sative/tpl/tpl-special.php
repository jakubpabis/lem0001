<?php /* Template Name: Special offer */ ?>
<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<main>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php if(have_rows('section')) : 

			while ( have_rows('section') ) : the_row(); ?>

				<section class="products container special">

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
										<?php do_action('sative_homepage_price', $product); ?>
									</div>
									<div class="products__item-btn">
										<?= __('View product'); ?>
										<i class="icon-chevron_right_bold"></i>
									</div>
									<?php do_action('sative_homepage_product_link', get_sub_field('product')); ?>
								</div>

							<?php endwhile; ?>
						
						</div>

						<?php if(get_sub_field('cta')) : ?>
							<a href="<?= get_sub_field('cta')['url']; ?>" class="btn btn__normal">
								<span><?= get_sub_field('cta')['title']; ?></span>
								<i class="icon-chevron_right_bold"></i>
							</a>
						<?php endif; ?>
					
					<?php endif; ?>

				</section>

			<?php endwhile; ?>

        <?php else : ?>

            <section class="products container special">

                <div class="section__intro container">
                    <p class="section__title">
                        <?= __('No special offers for now...', 'sative'); ?>
                    </p>
                    <hr>
                    <div class="section__text">
                        <?= __('Come back later and checkout our best offers.', 'sative'); ?>
                    </div>
                </div>

            </section>

		<?php endif; ?>

	<?php endwhile; // end of the loop. ?>

</main>

<?php get_footer(); ?>