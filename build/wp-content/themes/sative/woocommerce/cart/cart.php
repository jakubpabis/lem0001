<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
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
	exit;
}

wc_print_notices(); ?>

<aside class="cart">
    <div class="cart__close">
		&times;
    </div>
    <div class="cart__container">

        <div class="cart__title">
			<?= pll__('Your Cart'); ?>
        </div>

		<?php do_action( 'woocommerce_before_cart' ); ?>

		<?php if ( ! WC()->cart->is_empty() ) : ?>

			<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
				<?php do_action( 'woocommerce_before_cart_table' ); ?>

				<div class="cart__items woocommerce-mini-cart cart_list product_list_widget">
					<?php do_action( 'woocommerce_before_cart_contents' ); ?>

					<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<div class="cart__item woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

								<?php
									// @codingStandardsIgnoreLine
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
										'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									), $cart_item_key );
								?>

								<div class="photo">
									<?= $_product->get_image('thumbnail'); ?>
								</div>

								<div class="info">

									<div class="info__title">
										<?= $_product->get_title(); ?>
									</div>
									
									<?php if($_product->get_attributes()) : ?>
										<div class="info__details">
											<?php $i = 0; $len = count($_product->get_attributes()); ?>
											<?php foreach ( $_product->get_attributes() as $data ) : ?>
												<?php if(is_object($data)) : ?>
													<?php // var_dump($data); ?>
												<?php else : ?>
													<?= strtoupper(preg_replace('/-/', ' ', $data)); ?>
												<?php endif; ?>
												<?php
													if (!$i == $len - 1) {
														echo '&nbsp;-&nbsp;';
													}
													$i++;
												?>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>

									<div class="info__price">
										<div class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
											<?php
											if ( $_product->is_sold_individually() ) {
												$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
											} else {
												$product_quantity = woocommerce_quantity_input( array(
													'input_name'    => "cart[{$cart_item_key}][qty]",
													'input_value'   => $cart_item['quantity'],
													'max_value'     => $_product->get_max_purchase_quantity(),
													'min_value'     => '0',
													'product_name'  => $_product->get_name(),
												), $_product, false );
											}

											echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
											?>
										</div>

										<?php
											echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
										?>

									</div>

								</div>

							</div>
							<?php
						}
					}
					?>

					<?php do_action( 'woocommerce_cart_contents' ); ?>

					<?php do_action( 'woocommerce_after_cart_contents' ); ?>

				</div>

				<div class="cart__subtotal">
					<span>
						<?php _e( 'Subtotal', 'woocommerce' ); ?>
					</span>
					<span>
						<?php echo WC()->cart->get_cart_subtotal(); ?>
					</span>
				</div>

				<div class="text-center">
					<button disabled type="submit" class="button btn btn__full btn__small" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
						<span>
							<?php esc_html_e( 'Update cart', 'woocommerce' ); ?>
						</span>
						<i class="fa fa-sync"></i>
					</button>
				</div>

				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>

				<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

				<?php do_action( 'sative_widget_shopping_cart_buttons' ); ?>

				<a href="" class="cart__policy">
					<?= pll__('Our Shopping & Return Policy'); ?>
				</a>

				<?php do_action( 'woocommerce_after_cart_table' ); ?>

			</form>

		<?php else : ?>

			<p class="woocommerce-mini-cart__empty-message"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_cart' ); ?>

	</div>
</aside>
