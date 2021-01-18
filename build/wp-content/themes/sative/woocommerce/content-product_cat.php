<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div <?php wc_product_cat_class( 'products__item', $category ); ?>>
	<?php
	/**
	 * woocommerce_before_subcategory_title hook.
	 *
	 * @hooked woocommerce_subcategory_thumbnail - 10
	 */
	$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true ); ?>
	
	<?php if ( !empty(wp_get_attachment_image_url( $thumbnail_id, 'medium' )) ) : ?>
		<div class="products__item-photo">
			<img class="lazy attachment-medium size-medium wp-post-image" data-src="<?= wp_get_attachment_image_url( $thumbnail_id, 'medium' ); ?>" alt="<?= esc_attr( $category->name ); ?>">
		</div>
	<?php else : ?>
		<div class="products__item-photo">
			<img width="320" height="320" data-src="<?= get_template_directory_uri(); ?>/assets/img/img_coming.png" class="attachment-medium size-medium wp-post-image lazy" alt="Picture coming soon...">
		</div>
	<?php endif; ?>

	<div class="products__item-text category">
		<h2 class="category_title">
			<?= esc_html( $category->name ); ?>
		</h2>
		<?php if($category->description) : ?>
			<p class="description">
				<?= esc_html( wp_trim_words($category->description, 25) ); ?>
			</p>
		<?php endif; ?>
	</div>

	<?php
	/**
	 * woocommerce_after_subcategory_title hook.
	 */
	do_action( 'woocommerce_after_subcategory_title', $category );
	/**
	 * woocommerce_before_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_open - 10
	 */
	do_action( 'woocommerce_before_subcategory', $category );
	/**
	 * woocommerce_after_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_close - 10
	 */
	do_action( 'woocommerce_after_subcategory', $category ); 
	?>
</div>