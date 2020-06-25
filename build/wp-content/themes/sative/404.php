<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>
<?php get_template_part( 'partials/navigation', 'none' ); ?>
<div class="container py-5">
	<div class="row justify-content-center py5">
		<div class="col-lg-8 col-md-10 text-center">
		
			<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentyseventeen' ); ?></h1>
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentyseventeen' ); ?></p>
			<?php get_search_form(); ?>

		</div>
	</div>
</div>

<?php get_footer();
