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
				<?php if ($main_menu) foreach($main_menu as $item) : ?>
				
					<li <?= $item->url == $current_url ? 'class="active"' : null ?>>
						<a href="<?= $item->url ? $item->url : 'javascript:void(0);' ?>">
							<?= $item->title; ?>
							<?= $item->url ? null : '<i class="icon-chevron_down_bold"></i>' ?>
						</a>
					</li>

				<?php endforeach; ?>
			</ul>

			<ul>
				<?php if ($side_menu) foreach($side_menu as $item) : ?>
				
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
				<?php if ($main_menu) foreach($main_menu as $item) : ?>

					<?php if(get_permalink( wc_get_page_id( 'shop' ) ) === $item->url && (is_shop() || is_product() || is_product_category()) ) : ?>
						<li class="active">
					<?php else : ?>
						<li <?= $item->url == $current_url ? 'class="active"' : null ?>>
					<?php endif; ?>
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
				<?php if ($side_menu) foreach($side_menu as $item) : ?>
				
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
						<?php if(WC()->cart->get_cart_contents_count() !== 0) : ?>
							<span><?= WC()->cart->get_cart_contents_count(); ?></span>
						<?php endif; ?>
						<object data="<?= get_template_directory_uri(); ?>/assets/img/cart_black.svg" type="image/svg+xml" width="36" height="39">
							<img src="<?= get_template_directory_uri(); ?>/assets/img/cart_black.svg" alt="cart icon black" width="36" height="39">
						</object>
					</a>
				</li>
			</ul>
		</nav>
		<a href="javascript:void(0)" class="cart-btn-mobile" id="cartOpenBTNMobile">
			<?php if(WC()->cart->get_cart_contents_count() !== 0) : ?>
				<span><?= WC()->cart->get_cart_contents_count(); ?></span>
			<?php endif; ?>
			<object data="<?= get_template_directory_uri(); ?>/assets/img/cart_black.svg" type="image/svg+xml" width="28" height="30">
				<img src="<?= get_template_directory_uri(); ?>/assets/img/cart_black.svg" alt="cart icon black" width="28" height="30">
			</object>
		</a>
	</div>
	<?php if(is_shop() || is_product() || is_product_category()) : ?>
		<nav class="topbar__subnav">
			<?php
				$cat_args = array(
					'parent'        => 0,
					'hide_empty'    => false  
				);
				$product_categories = get_terms( 'product_cat', $cat_args );
				$haveChildren = null;
				$catParent = null;
				$is_child_active = null;

				if(is_product()) {
					global $post;
					$product_terms = get_the_terms( $post->ID, 'product_cat' );
				}

				if( !empty($product_categories) ){
					echo '<ul>';
					foreach ($product_categories as $key => $category) if($category->slug !== 'uncategorized') {

						$children = get_term_children($category->term_id, 'product_cat');
						if($children) foreach($children as $child) {
							if(is_product_category(get_term($child, 'product_cat')->slug)) {
								$is_child_active = 1;
								break;
							}
						}

						if(is_product()) {
							foreach($product_terms as $term) if($term->slug === $category->slug) {
								$is_child_active = 1;
								break;
							}
						}

						if(is_product_category($category->slug) || $is_child_active !== null) {
							$haveChildren = get_term_children($category->term_id, 'product_cat');
							$catParent = $category->term_id;
							$is_child_active = null;
							echo '<li class="active">';
						} else {
							echo '<li>';
						}

						echo '<a href="'.get_term_link($category).'" >';
						echo $category->name;
						echo '</a>';
						echo '</li>';
					}
					echo '</ul>';
				}
			?>
		</nav>
		<?php if($haveChildren !== null) : ?>
			<nav class="topbar__subsubnav">
				<?php
					$cat_args = array(
						'parent'        => $catParent,
						'hide_empty'    => false  
					);
					$product_categories = get_terms( 'product_cat', $cat_args );
					if( !empty($product_categories) ){
						echo '<ul>';
						foreach ($product_categories as $key => $category) {

							if(is_product()) {
								foreach($product_terms as $term) if($term->slug === $category->slug) {
									$is_child_active = 1;
									break;
								}
							}

							if(is_product_category($category->slug) || $is_child_active !== null) {
								$is_child_active = null;
								echo '<li class="active">';
							} else {
								echo '<li>';
							}
							echo '<a href="'.get_term_link($category).'" >';
							echo $category->name;
							echo '</a>';
							echo '</li>';
						}
						echo '</ul>';
					}
				?>
			</nav>
		<?php endif; ?>
	<?php endif;  ?>
</header>