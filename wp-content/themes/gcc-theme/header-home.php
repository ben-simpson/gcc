<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700&amp;subset=latin-ext" rel="stylesheet">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		
		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>
		
		<style>
			body {background: url("<?php echo get_template_directory_uri(); ?>/img/background-2.jpg") no-repeat center center fixed;}
		</style>

	</head>
	
	<body <?php body_class(); ?>>
		
		<?php include( get_template_directory() . '/img/svg-defs.svg'); ?>
		
		<div class="slide-menu hide">
			
			<div class="menu-wrapper">
			
				<div class="menu-container sections-menu">

					<h2>Sections</h2>

					<?php wp_nav_menu(array('theme_location' => 'sections-menu')); ?>

				</div>

				<div class="menu-container category-menu">

					<?php get_template_part('searchform'); ?>

					<h3>Categories</h3>

					<?php wp_nav_menu(array('theme_location' => 'category-menu')); ?>

				</div>
			
			</div>

		</div>
		
		
		<!-- wrapper -->
		<div class="wrapper">

			<!-- header -->
			<header class="header" role="banner">

					<!-- logo -->
					<a href="<?php echo home_url(); ?>" class="logo">
						<svg class="gcc-logo"><use xlink:href="#gcc-logo"></use></svg>
					</a>
					<!-- /logo -->
				
					<div class="menu-link">
						<span class="link">Menu</span>
						<span class="link hide">Close</span>
						<svg class="icon"><use xlink:href="#menu"></use></svg>
						<svg class="icon hide"><use xlink:href="#circle-x"></use></svg>
					</div>

			</header>
			<!-- /header -->