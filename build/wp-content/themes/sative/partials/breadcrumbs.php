<?php if ( function_exists('bcn_display') && !is_front_page() ) : ?>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav class="breadcrumbs">
					<?php bcn_display(false, true, false, false); ?>
				</nav>
			</div>
		</div>
	</div>
<?php endif; ?>