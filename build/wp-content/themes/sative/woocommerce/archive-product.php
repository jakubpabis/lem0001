<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


//var_dump(get_terms());
//var_dump(get_term_by('slug', '733-bob-pl', 'pa_color'));


//var_dump($url);
//$filters = sative_wc_filters();
//var_dump(sative_wc_filters());
get_header();



?>

<?php do_action( 'woocommerce_before_main_content' ); ?>
<?php get_template_part( 'partials/breadcrumbs', 'none' ); ?>
<main class="products__listing">

	<?php  ?>

	<?php if ( woocommerce_product_loop() ) { ?>

	<div class="container">

		<?php woocommerce_product_loop_start(); ?>

		<aside class="products__filters">
			<?php do_action( 'woocommerce_before_shop_loop' ); dynamic_sidebar('shop-sidebar'); ?>
		</aside>

		<section class="products__list">

			<?php

				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 */
						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					}
				}

			?>

		</section>

		<?php woocommerce_product_loop_end(); ?>

	</div>

	<?php
		/**
		 * woocommerce_after_shop_loop hook.
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action( 'woocommerce_after_shop_loop' );
	?>

	<?php

		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action( 'woocommerce_no_products_found' );
		}

	?>

</main>

<?php get_footer(); ?>
