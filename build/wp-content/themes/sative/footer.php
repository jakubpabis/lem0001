<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
		<footer class="footer">
			<a href="/" class="footer__logo">
				<object data="<?= get_template_directory_uri(); ?>/assets/img/logo.svg" type="image/svg+xml" width="260" height="105">
					<img src="<?= get_template_directory_uri(); ?>/assets/img/logo.svg" alt="Lemasomo logo black" width="260" height="105">
				</object>
			</a>
			<div class="container container-sml flex-cont">
				<div class="footer__item left">
					<p class="title">
						<?php if (function_exists('pll_e')) { pll_e('Contact'); } ?>
					</p>
					<hr>
					<p class="text">
						Lemasomo Sp. z o.o.<br/>
						<a href="tel:+48660848261">+48 660 848 261</a><br/>
						<a href="mailto:office@lemasomo.com">office@lemasomo.com</a>
					</p>
					<div class="socials">
						<a href="https://www.facebook.com/PinarelloPolska/" target="_blank" rel="noreferrer">
							<i class="fab fa-facebook-f"></i>
						</a>
						<a href="https://www.instagram.com/lemasomo/" target="_blank" rel="noreferrer">
							<i class="fab fa-instagram"></i>
						</a>
					</div>
				</div>
				<div class="footer__item center">
					<p class="title">
						<?php if (function_exists('pll_e')) { pll_e('About us'); } ?>
					</p>
					<hr>
					<?php 
						wp_nav_menu( array( 
							'theme_location' => 'footer_one', 
							'container' =>	'nav',
						) ); 
					?>
				</div>
				<div class="footer__item right">
					<p class="title">
						<?php if (function_exists('pll_e')) { pll_e('Customer service'); } ?>
					</p>
					<hr>
					<?php 
						wp_nav_menu( array( 
							'theme_location' => 'footer_two', 
							'container' =>	'nav',
						) ); 
					?>
				</div>
			</div>
			<div class="container container-sml flex-cont lower">
				<div class="footer__item lower left">
					Copyright © Lemasomo <?= date("Y"); ?>
				</div>
				<div class="footer__item lower right">
					Made by <a href="https://www.sative.co.uk" target="_blank" rel="noreferrer"><strong>SATIVE</strong></a>
				</div>
			</div>
		</footer>
		<div id="wrapper__overlay"></div>
		<?php include ('woocommerce/cart/cart.php'); ?>
		<div id="cookieMessage">
			<div class="container">
				<div class="message">
					<?php if (function_exists('pll_e')) { pll_e('Lemasomo uses cookies to improve our website and your user experience.<br/>By clicking any link or continuing to browse you are giving your consent to our'); } ?>
					<a href="/cookie-policy"><u><?php if (function_exists('pll_e')) { pll_e('cookie policy'); } ?></u></a>.
				</div>
				<div class="agree" onclick="cookieAgree()">
					Accept
				</div>
			</div>
		</div>
	</div>
	<div class="search__container">
		<?= do_shortcode( '[wcas-search-form]' ); ?>
	</div>
	<?php /* if( is_front_page() ) : ?>
		<a class="btn" href="#open-modal" style="display: none;"></a>
		<div id="open-modal" class="modal-window">
			<div class="modal-content text-center">
				<a href="javascript:void(0)" onclick="document.getElementById('open-modal').style.display = 'none';" title="<?php pll_e('Zamknij'); ?>" class="modal-close"><?php pll_e('Zamknij'); ?></a>
				<h2>
					<?php pll_e('Zapisz się do newsletter’a i odbierz kod rabatowy 10%'); ?>
				</h2>
				<form method="POST" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" accept-charset="UTF-8" role="form" id="newsletter-form" enctype="multipart/form-data">
					<input type="email" name="newsletter-email" value="" placeholder="<?php pll_e('Wpisz tutaj swój e-mail'); ?>" required>
					<input type="hidden" name="action" value="newsletter_form">
					<?php wp_nonce_field( 'newsletter_form', 'newsletter_form_nonce' ); ?>
					<button type="submit" class="btn btn__small btn__full"><span><?php pll_e('Zapisz się'); ?></span></button>
				</form>
			</div>
		</div>
		<div id="code-modal" class="modal-window">
			<div class="modal-content text-center">
				<a href="javascript:void(0)" onclick="document.getElementById('code-modal').style.display = 'none';" title="<?php pll_e('Zamknij'); ?>" class="modal-close"><?php pll_e('Zamknij'); ?></a>
				<h2>
					<?php pll_e('Dziękujemy! Twój kod rabatowy to: '); ?> <span style="color: #ff0000;"> <?= $_GET['code']; ?> </span>
				</h2>
			</div>
		</div>
	<?php endif; */ ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous" defer></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous" defer></script>
	<script src="<?= get_template_directory_uri(); ?>/assets/js/main.min.js?v=2.0" defer></script>
	<?php wp_footer(); ?>
	<?php /* if( is_front_page() ) : ?>
		<script defer>
			$(document).ready(function() {
				if( !getCookie('newsletter-coupon') ) {
					if( getUrlParameter('code') ) {
						setCookie('newsletter-coupon', getUrlParameter('code'), 365);
						$('#code-modal').css({ 'visibility': 'visible', 'opacity': '1','pointer-events': 'auto' });
					} else {
						setTimeout(function() {
							$('#open-modal').css({ 'visibility': 'visible', 'opacity': '1','pointer-events': 'auto' });
						}, 5000);
					}
				}
			});
		</script>
	<?php endif; */ ?>
</body>
</html>