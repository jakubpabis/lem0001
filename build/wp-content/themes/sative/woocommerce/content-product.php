<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<div <?php post_class('products__item'); ?>>

	<?php //do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="products__item-photo">
			<?= get_the_post_thumbnail( $post->ID, 'medium'); ?>
		</div>
	<?php endif; ?>

	<div class="products__item-text">
		
		<?php 
		/**
		 * Display product title
		 */
		do_action( 'sative_product_title', 'h3' ); ?>

		<?php  
		/**
		 *  Display price
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' ); ?>

	</div>

	<div class="products__item-btn">
		<?= __('View product') ?>
		<i class="icon-chevron_right_bold"></i>
	</div>
	<?php 
	/**
	 * Display product link
	 */
	do_action( 'sative_product_link' ); ?>

</div>
