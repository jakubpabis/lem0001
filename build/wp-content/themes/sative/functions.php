<?php

class WP_HTML_Compression
{
    // Settings
    protected $compress_css = true;
    protected $compress_js = true;
    protected $info_comment = true;
    protected $remove_comments = true;

    // Variables
    protected $html;
    public function __construct($html)
    {
   	 if (!empty($html))
		{
			$this->parseHTML($html);
		}
    }
    public function __toString()
    {
   	 	return $this->html;
    }
    protected function bottomComment($raw, $compressed)
    {
		$raw = strlen($raw);
		$compressed = strlen($compressed);
		
		$savings = ($raw-$compressed) / $raw * 100;
		
		$savings = round($savings, 2);
		
		return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
    }
    protected function minifyHTML($html)
    {
		$pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
		preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
		$overriding = false;
		$raw_tag = false;
		// Variable reused for output
		$html = '';
		foreach ($matches as $token)
		{
			$tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
			
			$content = $token[0];
			
			if (is_null($tag))
			{
				if ( !empty($token['script']) )
				{
					$strip = $this->compress_js;
				}
				else if ( !empty($token['style']) )
				{
					$strip = $this->compress_css;
				}
				else if ($content == '<!--wp-html-compression no compression-->')
				{
					$overriding = !$overriding;
					
					// Don't print the comment
					continue;
				}
				else if ($this->remove_comments)
				{
					if (!$overriding && $raw_tag != 'textarea')
					{
						// Remove any HTML comments, except MSIE conditional comments
						$content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
					}
				}
			}
			else
			{
				if ($tag == 'pre' || $tag == 'textarea')
				{
					$raw_tag = $tag;
				}
				else if ($tag == '/pre' || $tag == '/textarea')
				{
					$raw_tag = false;
				}
				else
				{
					if ($raw_tag || $overriding)
					{
						$strip = false;
					}
					else
					{
						$strip = true;
						
						// Remove any empty attributes, except:
						// action, alt, content, src
						$content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
						
						// Remove any space before the end of self-closing XHTML tags
						// JavaScript excluded
						$content = str_replace(' />', '/>', $content);
					}
				}
			}
			
			if ($strip)
			{
				$content = $this->removeWhiteSpace($content);
			}
			
			$html .= $content;
   	 }
   	 
   	 return $html;
    }
   	 
    public function parseHTML($html)
    {
		$this->html = $this->minifyHTML($html);
		
		if ($this->info_comment)
		{
			$this->html .= "\n" . $this->bottomComment($html, $this->html);
		}
    }
    
    protected function removeWhiteSpace($str)
    {
		$str = str_replace("\t", ' ', $str);
		$str = str_replace("\n",  '', $str);
		$str = str_replace("\r",  '', $str);
		
		while (stristr($str, '  '))
		{
			$str = str_replace('  ', ' ', $str);
		}
		
		return $str;
    }
}

function wp_html_compression_finish($html)
{
    return new WP_HTML_Compression($html);
}

function wp_html_compression_start()
{
    ob_start('wp_html_compression_finish');
}
add_action('get_header', 'wp_html_compression_start');

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
 * Register polylang strings for translation
 */
if (function_exists('pll_register_string')) 
{
	$strings = [
		'Your Cart',
		'Our Shopping & Return Policy',
		'Go to Checkout'
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




/**
 * @snippet       Disable Free Shipping if Cart has Shipping Class (WooCommerce 2.6+)
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=19960
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.4.4
 */
 
add_filter( 'woocommerce_package_rates', 'businessbloomer_hide_free_shipping_for_shipping_class', 10, 2 );
  
function businessbloomer_hide_free_shipping_for_shipping_class( $rates, $package ) 
{
	$shipping_class_target = 367;
	$in_cart = false;
	foreach( WC()->cart->cart_contents as $key => $values ) {
		if( $values[ 'data' ]->get_shipping_class_id() == $shipping_class_target ) {
			$in_cart = true;
			break;
		} 
	}
	if( $in_cart ) {
		unset( $rates['free_shipping:6'] ); 
		unset( $rates['flat_rate:1'] );
		unset( $rates['flat_rate:7'] );
	} else {
		unset( $rates['local_pickup:8'] );
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