<?php 

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	global $wp;
	$main_menu = wp_get_nav_menu_items('main-menu');
	$side_menu = wp_get_nav_menu_items('side-menu'); 
	$current_url = home_url(add_query_arg(array(),$wp->request)).'/';
	
?>

<header class="topbar">
	<div class="container flex-cont">
		<nav class="topbar__nav-mobile">

			<div class="topbar__nav-mobile__close">
				+
			</div>
			
			<ul>
				<?php foreach($main_menu as $item) : ?>
				
					<li <?= $item->url == $current_url ? 'class="active"' : null ?>>
						<a href="<?= $item->url ? $item->url : 'javascript:void(0);' ?>">
							<?= $item->title; ?>
							<?= $item->url ? null : '<i class="icon-chevron_down_bold"></i>' ?>
						</a>
					</li>

				<?php endforeach; ?>
			</ul>

			<ul>
				<?php foreach($side_menu as $item) : ?>
				
					<li <?= $item->url == $current_url ? 'class="active"' : null ?>>
						<?php if($item->url) : ?>
							<a href="<?= $item->url; ?>">
								<?= $item->title; ?>
							</a>
						<?php endif; ?>
					</li>

				<?php endforeach; ?>
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
				<?php foreach($main_menu as $item) : ?>
					<li <?= $item->url == $current_url ? 'class="active"' : null ?>>
						<a href="<?= $item->url ? $item->url : 'javascript:void(0);' ?>">
							<?= $item->title; ?>
							<?= $item->url ? null : '<i class="icon-chevron_down_bold"></i>' ?>
						</a>
					</li>

				<?php endforeach; ?>
			</ul>
		</nav>
		<nav class="topbar__nav-side">
			<ul>
				<?php foreach($side_menu as $item) : ?>
				
					<li>
						<?php if($item->url) : ?>
							<a href="<?= $item->url; ?>">
								<?= $item->title; ?>
							</a>
						<?php endif; ?>
					</li>

				<?php endforeach; ?>
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