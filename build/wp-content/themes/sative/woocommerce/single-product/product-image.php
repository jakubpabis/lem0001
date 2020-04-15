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
 * @version 3.3.2
 */

defined( 'ABSPATH' ) || exit;

global $post, $product;
$attachment_ids = $product->get_gallery_image_ids();
//$product_variations = $product->get_available_variations();

/*
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

if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( has_post_thumbnail() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper">
		<?php
		if ( has_post_thumbnail() ) {
			$html  = wc_get_gallery_image_html( $post_thumbnail_id, true );
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
			$html .= '</div>';
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );

		do_action( 'woocommerce_product_thumbnails' );
		?>
	</figure>
</div>
*/ ?>
<?php /* if ( !empty( $product_variations ) ) : ?>
	<?php 
		foreach ( $product_variations as $variation ) {
			echo $variation['image']['src'];
		}
	?>
<?php endif; */ ?>

	

<div class="product__single-slider slider__container">
	<div class="product__single-slider_wrapper">
		<div class="owl-carousel owl-theme">

			<?php $slides = sative_single_product_images(); ?>
			<?php foreach($slides as $slide) : ?>

				<div class="item">
					<img class="lazy" data-col="<?= $slide['attr']; ?>" src="<?= $slide['url']; ?>" alt="">
				</div>

			<?php endforeach; ?>

		</div>

		<?php if ( $attachment_ids && has_post_thumbnail() ) : ?>
			<div class="owl-prev">
				<i class="icon-chevron_left"></i>
			</div>
			<div class="owl-next">
				<i class="icon-chevron_right"></i>
			</div>
		<?php endif; ?>
		
	</div>

	<?php if ( sative_single_product_images() ) : ?>
		<div class="owl-miniatures">
			<?php $miniatures = sative_single_product_images('thumbnail'); ?>
			<?php $i = 0; ?>
			<?php foreach($miniatures as $miniature) : ?>

				<div data-index="<?= $i; ?>">
					<img width="50" class="lazy bg-cover" data-col="<?= $miniature['attr']; ?>" data-src="<?= $miniature['url']; ?>" alt="">
				</div>
				<?php $i = $i + 1; ?>

			<?php endforeach; ?>
			
		</div>
	<?php endif; ?>

</div>