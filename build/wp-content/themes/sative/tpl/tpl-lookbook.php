<?php /* Template Name: Lookbook */ ?>
<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<section class="lookbook">
    <div class="container">

    <?php  for($i = 1; $i <= 10; $i++) : ?>

    <?php if(get_field('lb_image'.$i)) : ?>        

        <div class="lookbook__item">
            <?php if($i % 2 != 0) : ?>
            <div class="image">
                <?php $image = get_field('lb_image'.$i); ?>
                <img src="<?php echo $image['url']; ?>" alt="">
            </div>
            <?php endif; ?>
            <div class="text">
                <div class="text-container">
                    <?php $title = get_field('lb_title'.$i); ?>
                    <p class="title">
                        <?php echo $title; ?>
                    </p>
                    <hr>
                    <div class="summary">
                        <?php $links = get_field('lb_products'.$i); ?>
                        <?php if($links) : ?>
                            <ul>
                                <?php foreach($links as $link) : ?>
                                    <?php $product = new WC_Product( $link->ID ); ?>
                                    <li>
                                        <a href="<?php echo get_permalink($link->ID); ?>"><?php echo $product->name; ?> - <b>£<?php echo number_format($product->price, 2); ?></b></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if($i % 2 == 0) : ?>
            <div class="image">
                <?php $image = get_field('lb_image'.$i); ?>
                <img src="<?php echo $image['url']; ?>" alt="">
            </div>
            <?php endif; ?>
        </div>

    <?php endif; ?>  

    <?php endfor; ?>  

    </div>
</section>

<?php get_footer(); ?>