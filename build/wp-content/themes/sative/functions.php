<?php

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sative_setup() {

	load_theme_textdomain( 'sative' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'side'    => __( 'Side Menu', 'sative' ),
		'menu'    => __( 'Main Menu', 'sative' ),
		'footer_one'    => __( 'Footer Menu First', 'sative' ),
		'footer_two'    => __( 'Footer Menu Second', 'sative' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'sative_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sative_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Nav', 'sative' ),
		'id'            => 'nav-sidebar',
		'description'   => __( 'Add widgets here to appear in your nav sidebar.', 'sative' ),
		'before_widget' => '<nav id="%1$s" class="topbar__subnav widget %2$s">',
		'after_widget'  => '</nav>',
		'before_title'  => '',
		'after_title'   => '',
	) );

}
add_action( 'widgets_init', 'sative_widgets_init' );

/* Disable WordPress Admin Bar for all users but admins. */
show_admin_bar(false);


/**
 * Register polylang strings for translation
 */
if (function_exists('pll_register_string')) {
	$strings = [
		'Your Cart',
	];
	foreach($strings as $string) {
		pll_register_string($string, $string);
	}
}


/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function sative_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'sative_front_page_template' );


function searchForId($id, $array) {
	foreach ($array as $key => $val) {
		if ($val->ID == $id) {
			return $key;
		}
	}
	return null;
 }

/**
 * Main menu array setup
 *
 * @param [type] $id
 * @return void
 */
function sative_main_menu_setup($menu) {

	$main_menu = [];
	foreach($menu as $item) {

		if($item->menu_item_parent == 0) {
			$main_menu[] = $item;
		} else {
			$id = searchForId($item->menu_item_parent, $main_menu);

			if(!$main_menu[$id]->menu_children) {
				$main_menu[$id]->menu_children = [];
				array_push($main_menu[$id]->menu_children, $item);
			} else {
				array_push($main_menu[$id]->menu_children, $item);
			}
		}

	}

	return $main_menu;
}

/**
 * 
 * Add WooCommerce support
 * 
 */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// Remove all WooCommerce styles and scripts
add_filter( 'woocommerce_enqueue_styles', '__return_false' );







/**
 * 
 * 
 * uncomment this on production
 * 
 */

// function pm_remove_all_scripts() {
//     global $wp_scripts;
//     $wp_scripts->queue = array();
// }
// add_action('wp_print_scripts', 'pm_remove_all_scripts', 100);
// function pm_remove_all_styles() {
//     global $wp_styles;
//     $wp_styles->queue = array();
// }
// add_action('wp_print_styles', 'pm_remove_all_styles', 100);

/**
 * 
 * 
 * uncomment this on production
 * 
 */





// function my_search_form($html)
// {
//     return str_replace('Search ', 'Search ', $html);
// }
// add_filter('get_search_form', 'my_search_form');

/**
 * Disable responsive image support (test!)
 */

// Clean the up the image from wp_get_attachment_image()
add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['sizes'] ) )
        unset( $attr['sizes'] );

    if( isset( $attr['srcset'] ) )
        unset( $attr['srcset'] );

    return $attr;

}, PHP_INT_MAX );
// Override the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_empty_array',  PHP_INT_MAX );
// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_empty_array', PHP_INT_MAX );
// Remove the reponsive stuff from the content
remove_filter( 'the_content', 'wp_make_content_images_responsive' );

/**
 * 
 * Add Brand taxonomy to WooCommerce products
 * 
 */
function brand_taxonomy()  {

	$labels = array(
		'name'                       => __('Brands'),
		'singular_name'              => __('Brand'),
		'menu_name'                  => __('Brands'),
		'all_items'                  => __('All brands'),
		'parent_item'                => __('Parent brand'),
		'parent_item_colon'          => __('Parent item'),
		'new_item_name'              => __('New brand'),
		'add_new_item'               => __('Add new brand'),
		'edit_item'                  => __('Edit item'),
		'update_item'                => __('Update item'),
		'separate_items_with_commas' => __('Separate Brand with commas'),
		'search_items'               => __('Search Brands'),
		'add_or_remove_items'        => __('Add or remove Brands'),
		'choose_from_most_used'      => __('Choose from the most used Brands'),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'brand', 'product', $args );
	
}
add_action( 'init', 'brand_taxonomy', 0 );




/**
 * 
 * 
 * Homepage WooCommerce functions.
 * 
 * 
 */

/**
 * Insert the anchor tag for products on homepage.
 */
if ( ! function_exists( 'sative_homepage_add_product_link' ) ) {
	function sative_homepage_add_product_link($id) {
		$link = get_the_permalink($id);
		$product = wc_get_product($id);
		echo '<a href="' . esc_url( $link ) . '" class="whole-element-link" title="' . __("View product").' '. $product->get_name() .'"></a>';
	}
}
add_action( 'sative_homepage_product_link', 'sative_homepage_add_product_link', 10 );

/**
 * Display price on homepage
 */
if( ! function_exists( 'sative_homepage_add_price' ) ) {
	function sative_homepage_add_price($product) {
		$currency = get_woocommerce_currency_symbol();
		if ( $product->is_type( 'variable' ) && $product->get_variation_regular_price( 'min', true ) != $product->get_variation_price( 'min', true ) ) : ?>
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
		<?php endif;
	}
}
add_action( 'sative_homepage_price', 'sative_homepage_add_price', 10 );

/**
 * Insert the title for products on the homepage.
 */
if ( ! function_exists( 'sative_homepage_add_product_title' ) ) {
	function sative_homepage_add_product_title($item) {
		$product = wc_get_product( get_sub_field('product') );
		$terms = get_the_terms( $item , 'brand' ); 
		echo '<h3 class="title">';
		if($terms) {
			echo $terms[0]->name.'&nbsp;';
		}
		echo $product->get_name();
		echo '</h3>';
		echo '<hr/>';
	}
}
add_action( 'sative_homepage_product_title', 'sative_homepage_add_product_title', 10 );


/**
 * 
 * 
 * Shop WooCommerce functions.
 * 
 * 
 */

/**
 * Insert the  anchor tag for products in the loop.
 */
if ( ! function_exists( 'sative_add_product_link' ) ) {
	function sative_add_product_link() {
		global $product;
		$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
		echo '<a href="' . esc_url( $link ) . '" class="whole-element-link" title="' . __("View product").' '. get_the_title() .'"></a>';
	}
}
add_action( 'sative_product_link', 'sative_add_product_link', 10 );

/**
 * Insert the title for products in the loop.
 */
if ( ! function_exists( 'sative_add_product_title' ) ) {
	function sative_add_product_title($tag) {
		global $product;
		global $post;
		$terms = get_the_terms( $post->ID , 'brand' ); 
		echo '<'.$tag.' class="title">';
		if($terms) {
			echo $terms[0]->name.'&nbsp;';
		}
		echo get_the_title();
		echo '</'.$tag.'>';
		echo '<hr/>';

	}
}
add_action( 'sative_product_title', 'sative_add_product_title', 10 );

/**
 * Output the related products.
 */
if ( ! function_exists( 'woocommerce_output_related_products' ) ) {
	function woocommerce_output_related_products() {

		$args = array(
			'posts_per_page' => 3,
			'columns'        => 3,
			'orderby'        => 'rand', // @codingStandardsIgnoreLine.
		);

		woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
	}
}

/**
 * Change Checkout button in cart
 */
if ( ! function_exists( 'sative_widget_shopping_cart_proceed_to_checkout' ) ) {
	function sative_widget_shopping_cart_proceed_to_checkout() {
		echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="button checkout wc-forward btn btn__normal btn__full btn__checkout"><span>' . esc_html__( 'Go to Checkout', 'woocommerce' ) . '</span><i class="icon-chevron_right_bold"></i></a>';
	}
}
add_action( 'sative_widget_shopping_cart_buttons', 'sative_widget_shopping_cart_proceed_to_checkout', 20 );

/**
 * Change view cart message
 */
function sative_custom_add_to_cart_message() {
	global $woocommerce;
	$return_to  = get_permalink(wc_get_page_id('shop'));
	$message    = __('Product successfully added to your cart. ', 'woocommerce').'<span id="cartOpenBTNSuccess">View cart</span>';
	return $message;
}
add_filter( 'wc_add_to_cart_message_html', 'sative_custom_add_to_cart_message' );

/**
 * Ensure variation combinations are working properly - standard limit is 30
 */
function woo_custom_ajax_variation_threshold( $qty, $product ) {
    return 500;
}       
add_filter( 'woocommerce_ajax_variation_threshold', 'woo_custom_ajax_variation_threshold', 10, 2 );