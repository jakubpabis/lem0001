<?php /* Template Name: Home page */ ?>
<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<div class="container">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php for($i = 1; $i <= 6; $i++) : ?>

			<?php if(get_field('hc_image_'.$i)) : ?>

				<section class="home home__product">
					<?php $term = get_field('hc_link_'.$i); if( $term ): ?>
						<a href="<?php echo get_term_link( $term ); ?>" class="whole-element-link"></a>
					<?php endif; ?>
					<?php if($i % 2 != 0) : ?>
						<div class="image">
							<?php $image = get_field('hc_image_'.$i); if( !empty($image) ): ?>
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<div class="text">
						<div class="text-container">
							<p class="title">
								<?php the_field('hc_title_'.$i); ?>
							</p>
							<hr>
							<p class="summary">
								<?php the_field('hc_summary_'.$i); ?>
							</p>
							<?php $term = get_field('hc_link_'.$i); if( $term ): ?>
								<a href="<?php echo get_term_link( $term ); ?>" class="btn btn-default">
									<span><?php the_field('hc_link_text_'.$i); ?></span>
								</a>
							<?php endif; ?>
						</div>
					</div>
					<?php if($i % 2 == 0) : ?>
						<div class="image">
							<?php $image = get_field('hc_image_'.$i); if( !empty($image) ): ?>
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</section>

			<?php endif; ?>

		<?php endfor; ?>

		<section class="home home__lookbook">
			<a href="/lookbook" class="whole-element-link"></a>
			<div class="text">
				<div class="text-container">
					<p class="title">
						Checkout our
						<!-- <span>Coming soon!</span> -->
						<a href="/lookbook">Lookbook</a>
					</p>
				</div>
			</div>
			<div class="image">
				<img src="<?= get_template_directory_uri(); ?>/assets/img/lookbook_new.jpg" alt="">
			</div>
		</section>

		<section class="home home__comments">
			<p class="title">
				A few comments
			</p>
			<div id="comments-carousel">
				<div>
					<p class="comment">
						‘Thank you so much! Lovely presentation and a great quality, special handbag! Lovely to have it hand delivered as well. All the best!’
					</p>
					<span>-</span>
					<p class="author">
						Agnieszka
					</p>
				</div>
				<div>
					<p class="comment">
						‘Thank you so much, I love my bag and scarf so much! The box it came in was gorgeous, just like Xmas come early, will be back soon!! Xxx’
					</p>
					<span>-</span>
					<p class="author">
						Julie
					</p>
				</div>
				<div>
					<p class"=comment">
						‘Love, love, LOVE my new scarf! It’s perfect to accessorise any outfit, and to wear in the evenings when it gets a little cold! Awesome quality too!’
					</p>
					<span>-</span>
					<p class="author">
						Steph
					</p>
				</div>
			</div>
			<div id="siema-prev">
				<i class="material-icons">chevron_left</i>
			</div>
			<div id="siema-next">
				<i class="material-icons">chevron_right</i>
			</div>
		</section>

	<?php endwhile; // end of the loop. ?>

</div>

<?php get_footer(); ?>