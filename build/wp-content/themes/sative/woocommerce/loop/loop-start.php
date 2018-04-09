<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
?>

<?php

    $queried_object = get_queried_object();
    if(isset($queried_object->parent) && $queried_object->parent) {
        $cat_parent = get_term($queried_object->parent, 'product_cat');
    }

?>

<?php if(single_cat_title('', false)) : ?>
    <div class="section__intro container">
        <h1 class="section__title">
            <?= isset($cat_parent) ? $cat_parent->name : null ?>
            <?= single_cat_title('', false); ?>
        </h1>
    </div>
<?php endif; ?>

<div class="products__container">
    <?php
        /**
         * Sorting and breadcrumbs
         */
        //do_action( 'woocommerce_before_shop_loop' );
    ?>
