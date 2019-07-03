<?php 

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	global $wp;
	$main_menu = sative_main_menu_setup(wp_get_nav_menu_items('main-menu'));
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
		<?php //var_dump($main_menu); ?>
			<ul class="menu">
				<?php if ($main_menu) foreach($main_menu as $item) : ?>

					<?php if($item->menu_item_parent == 0) : ?>
					
						<?php if(get_permalink( wc_get_page_id( 'shop' ) ) === $item->url && (is_shop() || is_product() || is_product_category()) ) : ?>
							<li class="active">
						<?php else : ?>
							<li <?= $item->url == $current_url ? 'class="active"' : null ?>>
						<?php endif; ?>
							<a href="<?= $item->url ? $item->url : 'javascript:void(0);' ?>" <?= $item->url ? null : 'data-action="dropdown"' ?>>
								<?= $item->title; ?>
								<?= $item->url ? null : '<i class="icon-chevron_down_bold"></i>' ?>
							</a>
							<?php if(get_permalink( wc_get_page_id( 'shop' ) ) === $item->url): ?>
							<div class="sub_menu">
								<div class="container">
									<?php
										$cat_args = array(
											'parent'        => 0,
											'hide_empty'    => true  
										);
										$product_categories = get_terms( 'product_cat', $cat_args );
										$haveChildren = null;
										$catParent = null;
										$is_child_active = null;

										global $post;
										$product_terms = get_the_terms( $post->ID, 'product_cat' );

										if( !empty($product_categories) ){
											foreach ($product_categories as $key => $category) if($category->slug !== 'uncategorized') {

												$children = get_term_children($category->term_id, 'product_cat');

												if(get_term_children($category->term_id, 'product_cat')) {
													$haveChildren = get_term_children($category->term_id, 'product_cat');
													$catParent = $category->term_id;
												}

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
													echo '<div class="active">';
												} else {
													echo '<div>';
												}
												echo '<a href="'.get_term_link($category).'" >';
												$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
												$image = wp_get_attachment_image_url( $thumbnail_id, 'thumbnail' );
												echo '<div class="img-cont">';
												if ( $image ) {
													echo '<img width="200" height="200" class="lazy" data-src="' . $image . '" alt="' . $category->name . '" />';
												} else {
													echo '<img width="200" height="200" data-src="'. get_template_directory_uri() .'/assets/img/img_coming.png" class="lazy" alt="Picture coming soon...">';
												}
												echo '</div>';
												
												echo '<span>'.$category->name.'</span>';
												echo '</a>';
												if($haveChildren !== null) : ?>
													<ul class="subsub_menu">
														<?php
															$cat_args = array(
																'parent'        => $catParent,
																'hide_empty'    => true 
															);
															$product_categories = get_terms( 'product_cat', $cat_args );
															if( !empty($product_categories) ){
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
															}
														?>
													</ul>
												<?php endif;
												$haveChildren = null;
												$catParent = null;
												echo '</div>';
											}
										}
									?>
								</div>
							</div>
							<?php endif; ?>
							<?php /* if($item->menu_children): ?>

								<ul class="sub_menu">
									
									<?php foreach($item->menu_children as $child): ?>
										
										<li <?= $child->url == $current_url ? 'class="active"' : null ?>>

											<a href="<?= $child->url ? $child->url : 'javascript:void(0);' ?>">
												<?= $child->title; ?>
											</a>

										</li>

									<?php endforeach; ?>
									
								</ul>
							
							<?php endif; */ ?>
						</li>
					
					<?php endif; ?>

				<?php endforeach; ?>
			</ul>
		</nav>
		<nav class="topbar__nav-side">
			<ul>
				<?php pll_the_languages(array('show_flags'=>1,'show_names'=>1, 'hide_current'=>1)); ?>
				<li class="searchForm">
					<a href="javascript:void(0)" onclick="showSearch()">
						<i class="fas fa-search"></i>
					</a>
				</li>
				<li>
					<?php if ( is_user_logged_in() ) : ?>
						<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','sative'); ?>">
							<i class="far fa-user"></i>
							<?php // _e('My Account','sative'); ?>
						</a>
					<?php else : ?>
						<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','sative'); ?>">
							<i class="far fa-user"></i>
							<?php // _e('Login / Register','sative'); ?>
						</a>
					<?php endif; ?>
				</li>
				<li>
					<a href="javascript:void(0)" id="cartOpenBTN" title="<?php _e('Cart','sative'); ?>">
						<?php if(WC()->cart->get_cart_contents_count() !== 0) : ?>
							<span><?= WC()->cart->get_cart_contents_count(); ?></span>
						<?php endif; ?>
						<i class="fas fa-shopping-cart"></i>
					</a>
				</li>
			</ul>
		</nav>
		<a href="javascript:void(0)" class="cart-btn-mobile" id="cartOpenBTNMobile">
			<?php if(WC()->cart->get_cart_contents_count() !== 0) : ?>
				<span><?= WC()->cart->get_cart_contents_count(); ?></span>
			<?php endif; ?>
			<?php /* <object data="<?= get_template_directory_uri(); ?>/assets/img/cart_black.svg" type="image/svg+xml" width="36" height="39">
				<img src="<?= get_template_directory_uri(); ?>/assets/img/cart_black.svg" alt="cart icon black" width="36" height="39">
			</object> */ ?>
			<i class="fas fa-shopping-cart"></i>
		</a>
	</div>
	<?php /* if(is_shop() || is_product() || is_product_category()) : ?>
		<nav class="topbar__subnav">
			<?php
				$cat_args = array(
					'parent'        => 0,
					'hide_empty'    => true  
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
						'hide_empty'    => true 
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
	<?php endif; */ ?>
</header>
<div class="search__container">
	<?= do_shortcode( '[wcas-search-form]' ); ?>
</div>
