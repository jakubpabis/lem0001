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
					<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
				</div>
				<?php $i++; ?>
			<?php endforeach; ?>
			<?php if(the_field('technical_specs')) : ?>
				<div class="tabs__option" data-tab="tab-<?php echo esc_attr( $i ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $i ); ?>">
					<?= __('Technical Specs'); ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="tabs__body">
			<?php $j = 0; ?>
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<div class="tabs__content <?= $j == 0 ? 'active' : null ?>" data-tab="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
					<?php call_user_func( $tab['callback'], $key, $tab ); ?>
				</div>
				<?php $j++; ?>
			<?php endforeach; ?>
			<?php if(the_field('technical_specs')) : ?>
				<div class="tabs__content" data-tab="tab-<?php echo esc_attr( $j ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $j ); ?>">
					<?php the_field('technical_specs'); ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="tabs__footer">
			<span>
				<?= __('Share it!'); ?>
			</span>
			<a href="" target="_blank" class="facebook">
				<i class="fa fa-facebook"></i>
			</a>
			<a href="" target="_blank" class="twitter">
				<i class="fa fa-twitter"></i>
			</a>
			<a href="" target="_blank" class="linkedin">
				<i class="fa fa-linkedin"></i>
			</a>
			<a href="" target="_blank" class="google-plus">
				<i class="fa fa-google-plus"></i>
			</a>
			<a href="" target="_blank" class="pinterest">
				<i class="fa fa-pinterest-p"></i>
			</a>
			<a href="" target="_blank" class="whatsapp">
				<i class="fa fa-whatsapp"></i>
			</a>
		</div>
	</div>

</section>

<?php endif; ?>
