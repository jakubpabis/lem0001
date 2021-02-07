<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	global $wp;
	// if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ 'menu' ] ) ) {
	// 	$menu = wp_get_nav_menu_object( $locations[ 'menu' ] );
	// 	$menu_items = wp_get_nav_menu_items($menu->term_id);
	// 	$main_menu = sative_main_menu_setup($menu_items);
	// }

	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ 'side' ] ) ) {
		$menu = wp_get_nav_menu_object( $locations[ 'side' ] );
		$side_menu = wp_get_nav_menu_items($menu->term_id);
	}
	$current_url = home_url(add_query_arg(array(),$wp->request)).'/';
	$menu_cats = get_categories_hierarchical( ['taxonomy' => 'product_cat', 'hide_empty' => false ] );

?>

<header id="topbarmenu" class="topbar">
	<div class="container-fluid flex-cont justify-content-between">
		<nav class="topbar__nav-mobile">

			<div class="topbar__nav-mobile__close">
				+
			</div>

			<ul>
				<?php /* if ($main_menu) foreach($main_menu as $item) : ?>

						<?php if( get_permalink( wc_get_page_id( 'shop' ) ) === $item->url || get_permalink( wc_get_page_id( 'sklep' ) ) === $item->url && (is_shop() || is_product() || is_product_category()) ) : ?>
							<li class="active">
						<?php else : ?>
							<li <?php echo $item->url == $current_url ? 'class="active"' : null ?>>
						<?php endif; ?>
						<?php if( get_permalink( wc_get_page_id( 'shop' ) ) === $item->url || get_permalink( wc_get_page_id( 'sklep' ) ) === $item->url ): ?>
							<a data-toggle="collapse" href="#<?php echo $item->title; ?>-<?php echo $item->post_name; ?>-m" role="button" aria-expanded="false" aria-controls="<?php echo $item->title; ?>-<?php echo $item->post_name; ?>-m">
								<?php echo $item->title; ?>
								<i class="fas fa-chevron-down"></i>
							</a>
							<div class="sub_menu collapse" id="<?php echo $item->title; ?>-<?php echo $item->post_name; ?>-m">
								<a class="viewAll" href="<?php echo $item->url ?>"><?php echo _e('View all', 'sative'); ?></a>
								<ul>
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
											foreach ($product_categories as $key => $category) if( $category->slug !== 'uncategorized' && $category->slug !== 'uncategorized-pl' && $category->slug !== 'uncategorized-en' ) {

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

												if(is_product_category($category->slug) && $is_child_active == null) {
													echo '<li class="active item">';
												} else if($is_child_active !== null) {
													$haveChildren = get_term_children($category->term_id, 'product_cat');
													$catParent = $category->term_id;
													echo '<li class="current-cat item">';
												} else {
													echo '<li class="item">';
												}
												if($haveChildren !== null) {
													echo '<a href="#" data-action="dropdown">'.$category->name;
													echo '<i class="fas fa-chevron-down"></i>';
												} else {
													echo '<a href="'.get_term_link($category).'">'.$category->name;
												}
												echo '</a>';
												if($haveChildren !== null) : ?>
													<ul class="subsub_menu">
													<?php echo '<a class="viewAll" href="'.get_term_link($category).'">'; ?>
													<?php echo _e('View all', 'sative'); ?>
													<?php echo '</a>'; ?>
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

																	if(is_product_category($category->slug)) {
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
												echo '</li>';
											}
										}
									?>
								</ul>
							</div>
						<?php else: ?>
							<a href="<?php echo $item->url ?>">
								<?php echo $item->title; ?>
							</a>
						<?php endif; ?>
						</li>
				<?php endforeach; */ ?>
				<?php if ($menu_cats) foreach($menu_cats as $item) : ?>

					<li <?php echo get_term_link( $item->term_id ) == $current_url ? 'class="active"' : null ?>>
						<?php if( !empty( $item->child_categories ) ): ?>
						<a data-toggle="collapse" href="#<?php echo $item->slug; ?>-<?php echo $item->term_id; ?>" role="button" aria-expanded="false" aria-controls="<?php echo $item->slug; ?>-<?php echo $item->term_id; ?>">
							<?php echo $item->name; ?>
						</a>
						<ul class="sub_menu collapse" id="<?php echo $item->slug; ?>-<?php echo $item->term_id; ?>" data-parent=".menu">
							<li class="sub_menu-all">
								<a href="#">
									<?php pll_e( 'Pokaż wszystko' ); ?>
								</a>
							</li>
							<?php foreach( $item->child_categories as $children ): ?>
								<li <?php echo get_term_link( $children->term_id ) == $current_url ? 'class="active"' : null ?>>
									<?php if( !empty( $children->child_categories ) ): ?>
										<a data-toggle="collapse" href="#<?php echo $children->slug; ?>-<?php echo $children->term_id; ?>" role="button" aria-expanded="false" aria-controls="<?php echo $children->slug; ?>-<?php echo $children->term_id; ?>">
											<?php echo $children->name; ?>
										</a>
										<ul class="sub_menu collapse" id="<?php echo $children->slug; ?>-<?php echo $children->term_id; ?>">
											<li class="sub_menu-all">
												<a href="#">
													<?php pll_e( 'Pokaż wszystko' ); ?>
												</a>
											</li>
											<?php foreach( $children->child_categories as $child ): ?>
												<li <?php echo get_term_link( $child->term_id ) == $current_url ? 'class="active"' : null ?>>
													<a href="<?php echo get_term_link( $child->term_id ); ?>">
														<?php echo $child->name; ?>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php else: ?>
										<a href="<?php echo get_term_link( $children->term_id ); ?>">
											<?php echo $children->name; ?>
										</a>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
						<?php else: ?>
							<a href="<?php echo get_term_link( $item->term_id ); ?>">
								<?php echo $item->name; ?>
							</a>
						<?php endif; ?>
					</li>


				<?php endforeach; ?>
			</ul>

			<ul>
				<?php if ($side_menu) foreach($side_menu as $item) : ?>

					<li <?php echo $item->url == $current_url ? 'class="active"' : null ?>>
						<?php if($item->url) : ?>
							<a href="<?php echo $item->url; ?>">
								<?php echo $item->title; ?>
							</a>
						<?php endif; ?>
					</li>

				<?php endforeach; ?>
			</ul>
		</nav>
		<div class="menu-btn-mobile">
			<a href="javascript:void(0)" id="menuOpenBTN">
				<i class="fas fa-bars"></i>
			</a>
			<a class="mobileBig" href="javascript:void(0)" onclick="showSearch()">
				<i class="fas fa-search"></i>
			</a>
		</div>
		<a href="/" class="topbar__logo">
			<object data="<?php echo get_template_directory_uri(); ?>/assets/img/logo_black.svg" type="image/svg+xml" width="227" height="90">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo_black.svg" alt="Sative logo black" width="227" height="90">
			</object>
		</a>
		<nav class="topbar__nav-main">
			<ul class="menu">
				<?php if ($menu_cats) foreach($menu_cats as $item) : ?>

					<li <?php echo get_term_link( $item->term_id ) == $current_url ? 'class="active"' : null ?>>
						<?php if( !empty( $item->child_categories ) ): ?>
						<a data-toggle="collapse" href="#<?php echo $item->slug; ?>-<?php echo $item->term_id; ?>" role="button" aria-expanded="false" aria-controls="<?php echo $item->slug; ?>-<?php echo $item->term_id; ?>">
							<?php echo $item->name; ?>
						</a>
						<ul class="sub_menu collapse" id="<?php echo $item->slug; ?>-<?php echo $item->term_id; ?>" data-parent=".menu">
							<li class="sub_menu-all">
								<a href="#">
									<?php pll_e( 'Pokaż wszystko' ); ?>
								</a>
							</li>
							<?php foreach( $item->child_categories as $children ): ?>
								<li <?php echo get_term_link( $children->term_id ) == $current_url ? 'class="active"' : null ?>>
									<?php if( !empty( $children->child_categories ) ): ?>
										<a data-toggle="collapse" href="#<?php echo $children->slug; ?>-<?php echo $children->term_id; ?>" role="button" aria-expanded="false" aria-controls="<?php echo $children->slug; ?>-<?php echo $children->term_id; ?>">
											<?php echo $children->name; ?>
										</a>
										<ul class="sub_menu collapse" id="<?php echo $children->slug; ?>-<?php echo $children->term_id; ?>">
											<li class="sub_menu-all">
												<a href="#">
													<?php pll_e( 'Pokaż wszystko' ); ?>
												</a>
											</li>
											<?php foreach( $children->child_categories as $child ): ?>
												<li <?php echo get_term_link( $child->term_id ) == $current_url ? 'class="active"' : null ?>>
													<a href="<?php echo get_term_link( $child->term_id ); ?>">
														<?php echo $child->name; ?>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php else: ?>
										<a href="<?php echo get_term_link( $children->term_id ); ?>">
											<?php echo $children->name; ?>
										</a>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
						<?php else: ?>
							<a href="<?php echo get_term_link( $item->term_id ); ?>">
								<?php echo $item->name; ?>
							</a>
						<?php endif; ?>
					</li>


				<?php endforeach; ?>
			</ul>
		</nav>
		<nav class="topbar__nav-side">
			<ul>
				<?php if (function_exists('pll_the_languages')) { pll_the_languages(array('show_flags'=>1,'show_names'=>1, 'hide_current'=>1)); } ?>
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
							<span><?php echo WC()->cart->get_cart_contents_count(); ?></span>
						<?php endif; ?>
						<i class="fas fa-shopping-cart"></i>
					</a>
				</li>
			</ul>
		</nav>
		<div class="cart-btn-mobile">
			<?php if ( is_user_logged_in() ) : ?>
				<a class="mobileBig" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','sative'); ?>">
					<i class="far fa-user"></i>
					<?php // _e('My Account','sative'); ?>
				</a>
			<?php else : ?>
				<a class="mobileBig" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','sative'); ?>">
					<i class="far fa-user"></i>
					<?php // _e('Login / Register','sative'); ?>
				</a>
			<?php endif; ?>
			<a href="javascript:void(0)" id="cartOpenBTNMobile">
				<?php if(WC()->cart->get_cart_contents_count() !== 0) : ?>
					<span><?php echo WC()->cart->get_cart_contents_count(); ?></span>
				<?php endif; ?>
				<?php /* <object data="<?php echo get_template_directory_uri(); ?>/assets/img/cart_black.svg" type="image/svg+xml" width="36" height="39">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/cart_black.svg" alt="cart icon black" width="36" height="39">
				</object> */ ?>
				<i class="fas fa-shopping-cart"></i>
			</a>
		</div>
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
<?php /* if ( function_exists('yoast_breadcrumb') && !is_front_page() ) : ?>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php yoast_breadcrumb( '<nav class="breadcrumbs">','</nav>' ); ?>
			</div>
		</div>
	</div>
<?php endif; */ ?>
