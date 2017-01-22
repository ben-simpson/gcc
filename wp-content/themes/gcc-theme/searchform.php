<!-- search -->
<form class="search-form" name="search" method="get" action="<?php echo home_url(); ?>" role="search">

	<input class="search-input input" type="search" name="s" placeholder="Search...">
	<a href="#" onclick="document.forms['search'].submit();">
		<svg class="icon"><use xlink:href="#magnifying-glass"></use></svg>
	</a>

	<!-- <button class="search-submit" type="submit" role="button"><?php _e( 'Search', 'html5blank' ); ?></button> -->

</form>
<!-- /search -->