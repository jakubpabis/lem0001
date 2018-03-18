<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<header class="topbar">
	<div class="container flex-cont">
		<nav class="topbar__nav-mobile">
			<div class="topbar__nav-mobile__close">
				+
			</div>
			<ul>
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
						About us
					</a>
				</li>
				<li>
					<a href="javascript:void(0)">
						More
						<i class="icon-chevron_down_bold"></i>
					</a>
				</li>
			</ul>
			<ul>
				<li>
					<a href="help.html">
						Help
					</a>
				</li>
				<li>
					<a href="contact.html">
						Contact
					</a>
				</li>
			</ul>
		</nav>
		<a href="javascript:void(0)" class="menu-btn-mobile" id="menuOpenBTN">
			<object data="<?= get_template_directory_uri(); ?>/assets/img/bars.svg" type="image/svg+xml" width="28" height="28">
				<img src="<?= get_template_directory_uri(); ?>/assets/img/bars.svg" alt="Sative logo black" width="28" height="28">
			</object>
		</a>
		<a href="/" class="topbar__logo">
			<object data="<?= get_template_directory_uri(); ?>/assets/img/logo_black.svg" type="image/svg+xml" width="227" height="90">
				<img src="<?= get_template_directory_uri(); ?>/assets/img/logo_black.svg" alt="Sative logo black" width="227" height="90">
			</object>
		</a>
		<nav class="topbar__nav-main">
			<ul>
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
						About us
					</a>
				</li>
				<li>
					<a href="javascript:void(0)">
						More
						<i class="icon-chevron_down_bold"></i>
					</a>
				</li>
			</ul>
		</nav>
		<nav class="topbar__nav-side">
			<ul>
				<li>
					<a href="help.html">
						Help
					</a>
				</li>
				<li>
					<a href="contact.html">
						Contact
					</a>
				</li>
				<li>
					<a href="javascript:void(0)" id="cartOpenBTN">
						<object data="<?= get_template_directory_uri(); ?>/assets/img/cart_black.svg" type="image/svg+xml" width="36" height="39">
							<img src="<?= get_template_directory_uri(); ?>/assets/img/cart_black.svg" alt="Sative cart icon black" width="36" height="39">
						</object>
					</a>
				</li>
			</ul>
		</nav>
		<a href="javascript:void(0)" class="cart-btn-mobile" id="cartOpenBTNMobile">
			<object data="<?= get_template_directory_uri(); ?>/assets/img/cart_black.svg" type="image/svg+xml" width="28" height="30">
				<img src="<?= get_template_directory_uri(); ?>/assets/img/cart_black.svg" alt="Sative cart icon black" width="28" height="30">
			</object>
		</a>
	</div>
</header>