<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
$attachment_ids = $product->get_gallery_image_ids();
// $columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
// $thumbnail_size    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );
// $post_thumbnail_id = get_post_thumbnail_id( $post->ID );
// $full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );
// $placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
// $wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
// 	'woocommerce-product-gallery',
// 	'woocommerce-product-gallery--' . $placeholder,
// 	'woocommerce-product-gallery--columns-' . absint( $columns ),
// 	'images',
// ) );
?>

<div class="product-detail__image">
	<div class="main">
		<div id="product-carousel">
		<?php if ( has_post_thumbnail() ) : ?>
				<picture>
					<source srcset="<?= get_the_post_thumbnail_url( $post->ID, 'atg-product-big'); ?>" media="(min-width: 740px)" type="image/jpeg">
					<source srcset="<?= get_the_post_thumbnail_url( $post->ID, 'atg-product-medium'); ?>" media="(min-width: 640px)" type="image/jpeg">
					<source srcset="<?= get_the_post_thumbnail_url( $post->ID, 'atg-product-big'); ?>" media="(min-width: 400px)" type="image/jpeg">
					<source srcset="<?= get_the_post_thumbnail_url( $post->ID, 'atg-product-medium'); ?>" media="(min-width: 1px)" type="image/jpeg">
					<img src="<?= get_the_post_thumbnail_url( $post->ID, 'atg-product-big'); ?>" alt="">
				</picture>
			<?php endif; ?>
			<?php if ( $attachment_ids && has_post_thumbnail() ) :
				foreach ( $attachment_ids as $attachment_id ) : ?>
					<picture>
						<source srcset="<?= wp_get_attachment_image_url( $attachment_id, 'atg-product-big'); ?>" media="(min-width: 740px)" type="image/jpeg">
						<source srcset="<?= wp_get_attachment_image_url( $attachment_id, 'atg-product-medium'); ?>" media="(min-width: 640px)" type="image/jpeg">
						<source srcset="<?= wp_get_attachment_image_url( $attachment_id, 'atg-product-big'); ?>" media="(min-width: 400px)" type="image/jpeg">
						<source srcset="<?= wp_get_attachment_image_url( $attachment_id, 'atg-product-medium'); ?>" media="(min-width: 1px)" type="image/jpeg">
						<img src="<?= wp_get_attachment_image_url( $attachment_id, 'atg-product-big'); ?>" alt="">
					</picture>
					<?php endforeach;
			endif; ?>
		</div>
		<?php if ( $attachment_ids && has_post_thumbnail() ) : ?>
			<div id="siema-prev">
				<i class="material-icons">chevron_left</i>
			</div>
			<div id="siema-next">
				<i class="material-icons">chevron_right</i>
			</div>
		<?php endif; ?>
	</div>
	<div class="thumbnails">
		<?php if ( $attachment_ids && has_post_thumbnail() ) : ?>
			<div class="thumb">
				<?php if ( has_post_thumbnail() ) : ?>
					<picture>
						<source srcset="<?= get_the_post_thumbnail_url( $post->ID, 'atg-product-xsmall'); ?>" media="(min-width: 767px)" type="image/jpeg">
						<source srcset="<?= get_the_post_thumbnail_url( $post->ID, 'atg-product-xxsmall'); ?>" media="(min-width: 640px)" type="image/jpeg">
						<source srcset="<?= get_the_post_thumbnail_url( $post->ID, 'atg-product-xsmall'); ?>" media="(min-width: 450px)" type="image/jpeg">
						<source srcset="<?= get_the_post_thumbnail_url( $post->ID, 'atg-product-xxsmall'); ?>" media="(min-width: 1px)" type="image/jpeg">
						<img src="<?= get_the_post_thumbnail_url( $post->ID, 'atg-product-xsmall'); ?>" alt="">
					</picture>
				<?php else :
					$html = sprintf( '<img src="%s" alt="%s"/>', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
				endif; ?>
			</div>
		<?php endif; ?>
		<?php if ( $attachment_ids && has_post_thumbnail() ) :
			foreach ( $attachment_ids as $attachment_id ) : ?>
				<div class="thumb">
					<picture>
						<source srcset="<?= wp_get_attachment_image_url( $attachment_id, 'atg-product-xsmall'); ?>" media="(min-width: 767px)" type="image/jpeg">
						<source srcset="<?= wp_get_attachment_image_url( $attachment_id, 'atg-product-xxsmall'); ?>" media="(min-width: 640px)" type="image/jpeg">
						<source srcset="<?= wp_get_attachment_image_url( $attachment_id, 'atg-product-xsmall'); ?>" media="(min-width: 450px)" type="image/jpeg">
						<source srcset="<?= wp_get_attachment_image_url( $attachment_id, 'atg-product-xxsmall'); ?>" media="(min-width: 1px)" type="image/jpeg">
						<img src="<?= wp_get_attachment_image_url( $attachment_id, 'atg-product-xsmall'); ?>" alt="">
					</picture>
				</div>
			<?php endforeach;
		endif; ?>
	</div>
</div>
