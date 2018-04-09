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
						Contact
					</p>
					<hr>
					<p class="text">
						Lemasomo Sp. z o.o.<br/>
						<a href="tel:+48882837257">+48 882 837 257</a><br/>
						<a href="mailto:office@lemasomo.com">office@lemasomo.com</a>
					</p>
					<div class="socials">
						<a href="">
							<i class="fa fa-facebook"></i>
						</a>
						<a href="">
							<i class="fa fa-twitter"></i>
						</a>
						<a href="">
							<i class="fa fa-instagram"></i>
						</a>
					</div>
				</div>
				<div class="footer__item center">
					<p class="title">
						About us
					</p>
					<hr>
					<nav>
						<ul>
							<li>
								<a href="index.html">
									Home
								</a>
							</li>
							<li>
								<a href="shop.html">
									Shop
								</a>
							</li>
							<li>
								<a href="brands.html">
									Our brands
								</a>
							</li>
							<li>
								<a href="about.html">
									Our story
								</a>
							</li>
							<li>
								<a href="blog.html">
									Blog
								</a>
							</li>
						</ul>
					</nav>
				</div>
				<div class="footer__item right">
					<p class="title">
						Customer service
					</p>
					<hr>
					<nav>
						<ul>
							<li>
								<a href="index.html">
									Help / FAQ
								</a>
							</li>
							<li>
								<a href="shop.html">
									Returns policy
								</a>
							</li>
							<li>
								<a href="brands.html">
									Warranty
								</a>
							</li>
							<li>
								<a href="about.html">
									Terms & Conditions
								</a>
							</li>
							<li>
								<a href="blog.html">
									Privacy policy
								</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<div class="container container-sml flex-cont lower">
				<div class="footer__item lower left">
					Copyright © Lemasomo <?= date("Y"); ?>
				</div>
				<div class="footer__item lower right">
					Made by <a href="https://www.sative.co.uk" target="_blank"><strong>SATIVE</strong></a>
				</div>
			</div>
		</footer>
		<div id="wrapper__overlay"></div>
		<?php include ('woocommerce/cart/cart.php'); ?>
	</div>
	<script src="<?= get_template_directory_uri(); ?>/assets/js/app.js"></script>
	<?php wp_footer(); ?>
</body>
</html>