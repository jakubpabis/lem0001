<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-8 col-md-10">
		
			<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentyseventeen' ); ?></h1>
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentyseventeen' ); ?></p>
			<?php get_search_form(); ?>

		</div>
	</div>
</div>

<?php get_footer();
