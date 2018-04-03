<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
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
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$currency = get_woocommerce_currency_symbol();
?>

<?php if ( isset($product->get_variation_regular_price()) && $product->get_variation_regular_price( 'min', true ) != $product->get_variation_price( 'min', true ) ) : ?>
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
