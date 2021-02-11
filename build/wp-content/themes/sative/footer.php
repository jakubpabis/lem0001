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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<?php wp_footer(); ?>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous" defer></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous" defer></script>
	<script src="<?= get_template_directory_uri(); ?>/assets/js/main.min.js?v=2.11" defer></script>
</body>
</html>
