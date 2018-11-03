<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

<section class="container container-sml">

	<div class="product__single-tabs">
		<div class="tabs__header">
			<?php $i = 0; ?>
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<div class="tabs__option <?= $i == 0 ? 'active' : null ?>" data-tab="tab-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
					<span><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></span>
				</div>
				<?php if(get_field('technical_specs') && $i === 0) : ?>
					<?php $i++; ?>
					<div class="tabs__option" data-tab="tab-<?php echo esc_attr( $i ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $i ); ?>">
						<span><?= __('Technical Specs'); ?></span>
					</div>
				<?php endif; ?>
				<?php $i++; ?>
			<?php endforeach; ?>
		</div>
		<div class="tabs__body">
			<?php $j = 0; ?>
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<div class="tabs__title" data-tab="tab-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
					<span><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></span>
				</div>
				<div class="tabs__content <?= $j == 0 ? 'active' : null ?>" data-tab="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
					<?php call_user_func( $tab['callback'], $key, $tab ); ?>
				</div>
				<?php if(get_field('technical_specs') && $j === 0) : ?>
					<?php $j++; ?>
					<div class="tabs__title" data-tab="tab-<?php echo esc_attr( $j ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $j ); ?>">
						<span><?= __('Technical Specs'); ?></span>
					</div>
					<div class="tabs__content" data-tab="tab-<?php echo esc_attr( $j ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $j ); ?>">
						<?php the_field('technical_specs'); ?>
					</div>
				<?php endif; ?>
				<?php $j++; ?>
			<?php endforeach; ?>
		</div>
		<div class="tabs__footer">
			<span>
				<?= __('Share it!'); ?>
			</span>
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?= get_permalink(); ?>" target="_blank" class="facebook" rel="noopener noreferrer">
				<i class="fab fa-facebook-f"></i>
			</a>
			<a href="https://twitter.com/intent/tweet?status=<?= rawurlencode(get_the_title()); ?>+<?= get_permalink(); ?>" target="_blank" class="twitter" rel="noopener noreferrer">
				<i class="fab fa-twitter"></i>
			</a>
			<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= get_permalink(); ?>&title=<?= rawurlencode(get_the_title()); ?>&summary=&source=<?= get_permalink(); ?>" target="_blank" class="linkedin" rel="noopener noreferrer">
				<i class="fab fa-linkedin-in"></i>
			</a>
			<a href="https://plus.google.com/share?url=<?= get_permalink(); ?>" target="_blank" class="google-plus" rel="noopener noreferrer">
				<i class="fab fa-google-plus-g"></i>
			</a>
			<a href="https://pinterest.com/pin/create/bookmarklet/?media=<?= wp_get_attachment_url( get_post_thumbnail_id() ); ?>&url=<?= get_permalink(); ?>&is_video=false&description=<?= rawurlencode(get_the_title()); ?>" target="_blank" class="pinterest" rel="noopener noreferrer">
				<i class="fab fa-pinterest-p"></i>
			</a>
			<a href="whatsapp://send?text<?= rawurlencode(get_the_title()); ?> <?= get_permalink(); ?>" target="_blank" class="whatsapp" rel="noopener noreferrer">
				<i class="fab fa-whatsapp"></i>
			</a>
		</div>
	</div>

</section>

<?php endif; ?>
