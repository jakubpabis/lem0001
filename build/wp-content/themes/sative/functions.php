<?php

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sative_setup() 
{
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
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'sative_setup' );

/**
 * Remove Post from menu
 */
function post_remove() 
{ 
   remove_menu_page('edit.php');
}
add_action('admin_menu', 'post_remove'); 

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sative_widgets_init() 
{
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
 * 
 * Add Brand taxonomy to WooCommerce products
 * 
 */
 function brand_taxonomy() {

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
 * Add Type taxonomy to WooCommerce products
 * 
 */
function type_taxonomy() {

	$labels = array(
		'name'                       => __('Types'),
		'singular_name'              => __('Type'),
		'menu_name'                  => __('Types'),
		'all_items'                  => __('All types'),
		'parent_item'                => __('Parent type'),
		'parent_item_colon'          => __('Parent item'),
		'new_item_name'              => __('New type'),
		'add_new_item'               => __('Add new type'),
		'edit_item'                  => __('Edit item'),
		'update_item'                => __('Update item'),
		'separate_items_with_commas' => __('Separate Type with commas'),
		'search_items'               => __('Search Types'),
		'add_or_remove_items'        => __('Add or remove Types'),
		'choose_from_most_used'      => __('Choose from the most used Types'),
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
	register_taxonomy( 'type', 'product', $args );
	
}
add_action( 'init', 'type_taxonomy', 0 );

/**
 * Register polylang strings for translation
 */
if (function_exists('pll_register_string')) 
{
	$strings = [
		'Your Cart',
		'Our Shopping & Return Policy',
		'Go to Checkout',
		'Contact',
		'About us',
		'Customer service',
		'Lemasomo uses cookies to improve our website and your user experience.<br/>By clicking any link or continuing to browse you are giving your consent to our',
		'cookie policy',
		'Zamknij',
		'Zapisz się',
		'Wpisz tutaj swój e-mail'
	];
	foreach($strings as $string) {
		pll_register_string($string, $string);
	}
}

function searchForId($id, $array) 
{
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
function sative_main_menu_setup($menu) 
{
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
function woocommerce_support() 
{
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

// function pm_remove_all_scripts() 
// {
//     global $wp_scripts;
//     $wp_scripts->queue = array();
// }
// add_action('wp_print_scripts', 'pm_remove_all_scripts', 100);
// function pm_remove_all_styles() 
// {
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
if ( ! function_exists( 'sative_homepage_add_product_link' ) ) 
{
	function sative_homepage_add_product_link($id) 
	{
		$link = get_the_permalink($id);
		$product = wc_get_product($id);
		echo '<a href="' . esc_url( $link ) . '" class="whole-element-link" title="' . __("View product").' '. $product->get_name() .'"></a>';
	}
}
add_action( 'sative_homepage_product_link', 'sative_homepage_add_product_link', 10 );

/**
 * Display price on homepage
 */
if( ! function_exists( 'sative_homepage_add_price' ) ) 
{
	function sative_homepage_add_price($product) 
	{
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
if ( ! function_exists( 'sative_homepage_add_product_title' ) ) 
{
	function sative_homepage_add_product_title($item) 
	{
		$product = wc_get_product( get_sub_field('product') );
		$terms = get_the_terms( $item , 'brand' ); 
		echo '<h3 class="title">';
		if($terms) {
			echo $terms[0]->name.'&nbsp;';
		}
		echo $product->get_name();
		echo '</h3>';
		echo '<p class="description">'.wp_trim_words($product->get_description(), 21).'</p>';
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
 * Insert the anchor tag for products in the loop.
 */
if ( ! function_exists( 'sative_add_product_link' ) ) 
{
	function sative_add_product_link() 
	{
		global $product;
		$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
		echo '<a href="' . esc_url( $link ) . '" class="whole-element-link" title="' . __("View product").' '. get_the_title() .'"></a>';
	}
}
add_action( 'sative_product_link', 'sative_add_product_link', 10 );

/**
 * Insert the title for products in the loop.
 */
if ( ! function_exists( 'sative_add_product_title' ) ) 
{
	function sative_add_product_title($tag) 
	{
		global $product;
		//global $post;
		$terms = get_the_terms( $product->get_id() , 'brand' ); 
		echo '<'.$tag.' class="title">';
		if($terms) {
			echo $terms[0]->name.'&nbsp;';
		}
		echo get_the_title();
		echo '</'.$tag.'>';
		echo '<p class="description">'.wp_trim_words($product->get_description(), 21).'</p>';

	}
}
add_action( 'sative_product_title', 'sative_add_product_title', 10 );

/**
 * Insert the title for products in the loop.
 */
if ( ! function_exists( 'sative_add_single_product_title' ) ) 
{
	function sative_add_single_product_title($tag) 
	{
		global $product;
		$terms = get_the_terms( $product->get_id() , 'brand' ); 
		echo '<'.$tag.' class="title">';
		if($terms) {
			echo $terms[0]->name.'&nbsp;';
		}
		echo get_the_title();
		echo '</'.$tag.'>';
		echo '<hr/>';

	}
}
add_action( 'sative_single_product_title', 'sative_add_single_product_title', 10 );

/**
 * Output the related products.
 */
if ( ! function_exists( 'woocommerce_output_related_products' ) ) 
{
	function woocommerce_output_related_products() 
	{
		global $upsellsused;
		if($upsellsused == false) { 
			$args = array(
				'posts_per_page' => 3,
				'columns'        => 3,
				'orderby'        => 'rand', // @codingStandardsIgnoreLine.
			);
			woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
		}
	}
}

/**
 * Change Checkout button in cart
 */
if ( ! function_exists( 'sative_widget_shopping_cart_proceed_to_checkout' ) ) 
{
	function sative_widget_shopping_cart_proceed_to_checkout() 
	{
		echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="button checkout wc-forward btn btn__normal btn__full btn__checkout"><span>' . pll__('Go to Checkout') . '</span><i class="icon-chevron_right_bold"></i></a>';
	}
}
add_action( 'sative_widget_shopping_cart_buttons', 'sative_widget_shopping_cart_proceed_to_checkout', 20 );

/**
 * Change view cart message
 */
function sative_custom_add_to_cart_message() 
{
	global $woocommerce;
	$return_to  = get_permalink(wc_get_page_id('shop'));
	$message    = __('Product successfully added to your cart. ', 'woocommerce').'<span id="cartOpenBTNSuccess">View cart</span>';
	return $message;
}
add_filter( 'wc_add_to_cart_message_html', 'sative_custom_add_to_cart_message' );

/**
 * Ensure variation combinations are working properly - standard limit is 30
 */
function woo_custom_ajax_variation_threshold( $qty, $product ) 
{
    return 500;
}       
add_filter( 'woocommerce_ajax_variation_threshold', 'woo_custom_ajax_variation_threshold', 10, 2 );




// /**
//  * @snippet       Disable Free Shipping if Cart has Shipping Class (WooCommerce 2.6+)
//  * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
//  * @sourcecode    https://businessbloomer.com/?p=19960
//  * @author        Rodolfo Melogli
//  * @testedwith    WooCommerce 3.4.4
//  */
 
// add_filter( 'woocommerce_package_rates', 'businessbloomer_hide_free_shipping_for_shipping_class', 10, 2 );
  
// function businessbloomer_hide_free_shipping_for_shipping_class( $rates, $package ) 
// {
// 	$shipping_class_target = 'bikes';
// 	$in_cart = false;
// 	foreach( WC()->cart->cart_contents as $key => $values ) {
// 		dd($values[ 'data' ]->get_shipping_class());
// 		if( $values[ 'data' ]->get_shipping_class() == $shipping_class_target ) {
// 			$in_cart = true;
// 			//break;
// 		} 
// 	}
// 	if( $in_cart ) {
// 		//unset( $rates['free_shipping:6'] ); 
// 		//unset( $rates['flat_rate:1'] );
// 		//unset( $rates['flat_rate:10'] );
// 		//unset( $rates['flat_rate:7'] );
// 	} else {
// 		//unset( $rates['local_pickup:8'] );
// 	}
// 	//return $rates;
// }

add_filter( 'woocommerce_package_rates', 'hide_shipping_method_based_on_shipping_class', 10, 2 );
function hide_shipping_method_based_on_shipping_class( $rates, $package )
{
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    // HERE define your shipping class to find
	$class1 = 'bikes';
	$class2 = 'bikes-pl';

	$in_cart = false;
    // HERE define the shipping method to hide
    // $method_key_id = 'flat_rate:7';

    // Checking in cart items
    foreach( $package['contents'] as $item ){
        // If we find the shipping class
        if( $item['data']->get_shipping_class() == $class1 || $item['data']->get_shipping_class() == $class2 ){
			$in_cart = true;
			unset($rates['flat_rate:10']);
			unset($rates['flat_rate:9']);
			unset($rates['flat_rate:7']);
			unset($rates['flat_rate:1']);
            break; // Stop the loop
        }
	}
	if($in_cart == false) {
		unset($rates['local_pickup:8']);
	}
    return $rates;
}

function my_custom_loop_category_title( $category ) 
{
	echo '<h2 class="woocommerce-loop-category__title">';
	echo esc_html( $category->name );
	echo '</h2>';
}    
add_action( 'my_woocommerce_shop_loop_subcategory_title', 'my_custom_loop_category_title', 10 ); 


/**
 * Insert the title for products in the loop.
 */
if ( ! function_exists( 'sative_single_product_images' ) ) 
{
	function sative_single_product_images($size = 'large', $attr = 'pa_color') 
	{
		global $post, $product;
		$attachment_ids = $product->get_gallery_image_ids();
		$images = [];
		$varimages = [];

		if( $product->is_type('variable') ) {
			$variations = $product->get_visible_children(); 
			foreach ( $variations as $variation ) {
				$variation = wc_get_product( $variation );
				$pa_color = $variation->get_attribute('pa_color');
				if(!empty($pa_color) && !in_array($variation->get_image_id(), $varimages)) {
					$images[] = [
						'url' => wp_get_attachment_image_url($variation->get_image_id(), $size),
						'attr' => $variation->get_attributes()[$attr],
					];
					$varimages[] = $variation->get_image_id();
				}
			}
		}

		if ( $product->get_image() ) {
			if(in_array($product->get_image_id(), $varimages)) {
				$search = array_search(wp_get_attachment_image_url($product->get_image_id(), $size), array_column($images, 'url'));
				$color = $images[$search]['attr'];
				$thumb = [
					'url' => wp_get_attachment_image_url($product->get_image_id(), $size),
					'attr' => $color,
				];
				unset($images[$search]);
				array_unshift($images, $thumb);
			} else {
				$thumb = [
					'url' => get_the_post_thumbnail_url($post->ID, $size),
					'attr' => '',
				];
				array_unshift($images, $thumb);
			}
		}

		if ( $attachment_ids && has_post_thumbnail() ) {
			foreach ( $attachment_ids as $attachment_id ) {
				if (!in_array($attachment_id, $varimages)) {
					$images[] = [
						'url' => wp_get_attachment_image_url($attachment_id, $size),
						'attr' => '',
					];
				} 
			}
		} 

		return $images;

	}
}

function custom_post_type_newsletter_users() 
{
 
// Set UI labels for Custom Post Type
$labels = array(
    'name'                => _x( 'Newsletter Users', 'Post Type General Name', 'sative' ),
    'singular_name'       => _x( 'Newsletter Users', 'Post Type Singular Name', 'sative' ),
    'menu_name'           => __( 'Newsletter Users', 'sative' ),
    'parent_item_colon'   => __( 'Parent Newsletter Users', 'sative' ),
    'all_items'           => __( 'All Newsletter Users', 'sative' ),
    'view_item'           => __( 'View Newsletter Users', 'sative' ),
    'add_new_item'        => __( 'Add New Newsletter Users', 'sative' ),
    'add_new'             => __( 'Add New', 'sative' ),
    'edit_item'           => __( 'Edit Newsletter Users', 'sative' ),
    'update_item'         => __( 'Update Newsletter Users', 'sative' ),
    'search_items'        => __( 'Search Newsletter Users', 'sative' ),
    'not_found'           => __( 'Not Found', 'sative' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'sative' ),
);
    
// Set other options for Custom Post Type
$args = array(
    'label'               => __( 'newsletter-users', 'sative' ),
    'description'         => __( 'Newsletter Users', 'sative' ),
    'labels'              => $labels,
    // Features this CPT supports in Post Editor
    'supports'            => array( 'title', 'editor', 'custom-fields' ),
    // You can associate this CPT with a taxonomy or custom taxonomy. 
    'taxonomies'          => array(),
    /* A hierarchical CPT is like Pages and can have
    * Parent and child items. A non-hierarchical CPT
    * is like Posts.
    */ 
    'hierarchical'        => false,
    'public'              => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => false,
    'show_in_admin_bar'   => false,
    'menu_position'       => 20,
    'menu_icon'           => 'dashicons-groups',
    'can_export'          => true,
    'has_archive'         => false,
    'exclude_from_search' => true,
    'publicly_queryable'  => false,
    'capability_type'     => 'post',
);   
// Registering your Custom Post Type
register_post_type( 'newsletter-users', $args );
}
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
add_action( 'init', 'custom_post_type_newsletter_users', 0 );

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateCouponCode( $email )
{
	$coupon_code = generateRandomString(10); // Code - perhaps generate this from the user ID + the order ID
	$amount = '10'; // Amount
	$discount_type = 'percent'; // Type: fixed_cart, percent, fixed_product, percent_product

	$coupon = array(
		'post_title' => $coupon_code,
		'post_content' => '',
		'post_status' => 'publish',
		'post_author' => 1,
		'post_type' => 'shop_coupon'
	);    

	$new_coupon_id = wp_insert_post( $coupon );

	// Add meta
	update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
	update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
	update_post_meta( $new_coupon_id, 'customer_email', $email );
	update_post_meta( $new_coupon_id, 'individual_use', 'yes' );
	update_post_meta( $new_coupon_id, 'product_ids', '' );
	update_post_meta( $new_coupon_id, 'exclude_sale_items', 'yes' );   
	update_post_meta( $new_coupon_id, 'exclude_product_categories', array( 95, 91, 93, 969, 94, 97, 977, 96, 89, 88, 92, 1002, 441, 457, 1215, 1213, 449, 445, 455, 443, 451, 453, 447, 1217 ) );
	update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
	update_post_meta( $new_coupon_id, 'usage_limit', '1' );
	update_post_meta( $new_coupon_id, 'expiry_date', date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+1 month" ) ) );
	update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
	update_post_meta( $new_coupon_id, 'free_shipping', 'no' );

	return $coupon_code;

}

function sative_newsletter_form_submit() {

	$coupon_code = generateCouponCode( $_POST['newsletter-email'] );
	
	$newsletterArray = array(
        'post_type'     => 'newsletter-users',
        'post_status'   => 'private',
		'post_title'    => $_POST['newsletter-email'],
		'post_content'  => $coupon_code
    );

    if( !post_exists( $_POST['newsletter-email'] ) ) {
        wp_insert_post( $newsletterArray, true );
    }

    $redirect = '/?code='.$coupon_code;
    header("Location: $redirect");

}
add_action( 'admin_post_nopriv_newsletter_form', 'sative_newsletter_form_submit' );
add_action( 'admin_post_newsletter_form', 'sative_newsletter_form_submit' );