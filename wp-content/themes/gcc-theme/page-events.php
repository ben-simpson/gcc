<?php get_header(); ?>

	<main role="main">

		<!-- section -->
		<section class="posts">

		<h1><?php the_title(); ?></h1>
			
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<h4 class="description"><?php the_content(); ?></h4>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
		<?php endif; ?>

		<div class="posts-list">	

			<?php

				// Initializes pagination for custom query
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

				// Excludes 'case study' category from query
				$query_args = array('post_type' 		=> 'event',
									'posts_per_page' 	=> 6,
									'meta-key'			=> 'start_date',
									'orderby' 			=> 'meta_value_num',
									'order' 			=> 'DESC',
									'paged' 			=> $paged
								   );

				// Create custom query
				$wp_query = new WP_Query( $query_args );

			?>

			<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

				<!-- article -->
				<article id="post-<?php the_ID(); ?>" class="partial-article">

					<!-- post thumbnail -->
					<?php 	$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

					<!-- post header image -->
					<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="partial-hero" style="background: url(<?php echo $thumb_url; ?>) no-repeat center center; background-size: cover;"></a>
					<?php else: ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="partial-hero" style="background: url('<?php echo get_template_directory_uri(); ?>/img/event-hero.jpg') no-repeat center center; background-size: cover;"></a>
					<?php endif; ?>

					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="hero-date">
						<span class="day" id="header-start-day-<?php the_ID(); ?>"></span>
						<span class="month" id="header-start-month-<?php the_ID(); ?>"></span>
						<span class="year" id="header-start-year-<?php the_ID(); ?>"></span>
					</a>

					<div class="details">

						<!-- post title -->
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

						<!-- event start date, required -->
						<span id="start-month-<?php the_ID(); ?>"></span> <span id="start-day-<?php the_ID(); ?>"></span><span>, </span><span id="start-year-<?php the_ID(); ?>"></span>

						<!-- event start time displays if it has a value -->
						<?php if (!empty( get_field( 'start_time' ) )) : ?>
							<span> at </span><span id="start-time"><?php the_field( 'start_time' ); ?><?php the_field( 'start_time_period' ); ?></span>
						<?php endif; ?>

						<!-- event end date displays if it has a value -->
						<?php if (!empty( get_field( 'end_date' ) )) : ?>
							<br/><span>until </span><span id="end-month-<?php the_ID(); ?>"></span> <span id="end-day-<?php the_ID(); ?>"></span><span>, </span><span id="end-year-<?php the_ID(); ?>"></span>
						<?php endif; ?>

						<!-- event end time displays if it has a value -->
						<?php if (!empty( get_field( 'end_time' ) )) : ?>
							<span> at </span><span id="end-time"><?php the_field( 'end_time' ); ?><?php the_field( 'end_time_period' ); ?></span>
						<?php endif; ?>


						<p class="location">

							<!-- event location displays if it has a value -->
							<?php if (!empty( get_field( 'location_name' ) )) : ?>
								<span><?php the_field( 'location_name' ); ?></span>
							<?php endif; ?>

							<!-- event location address 1 displays if it has a value -->
							<?php if (!empty( get_field( 'location_address_line_1' ) )) : ?>
								<br/><span><?php the_field( 'location_address_line_1' ); ?></span>
							<?php endif; ?>

							<!-- event location address 2 displays if it has a value -->
							<?php if (!empty( get_field( 'location_address_line_2' ) )) : ?>
								<br/><span><?php the_field( 'location_address_line_2' ); ?></span>
							<?php endif; ?>

							<!-- event location address 3 displays if it has a value -->
							<?php if (!empty( get_field( 'location_address_line_2' ) )) : ?>
								<br/><span><?php the_field( 'location_address_line_3' ); ?></span>
							<?php endif; ?>

						</p>

					</div>

					<script>

					var startDate = "<?php the_field('start_date'); ?>";
					var startYear = startDate.slice(0,4);
					var startMonth = startDate.slice(4,6);
					var startDay = startDate.slice(6,8);
					var startMonthName;

					if (startMonth == '01') {startMonthName = 'January';}
					else if (startMonth == '02') {startMonthName = 'February';}
					else if (startMonth == '03') {startMonthName = 'March';}
					else if (startMonth == '04') {startMonthName = 'April';}
					else if (startMonth == '05') {startMonthName = 'May';}
					else if (startMonth == '06') {startMonthName = 'June';}
					else if (startMonth == '07') {startMonthName = 'July';}
					else if (startMonth == '08') {startMonthName = 'August';}
					else if (startMonth == '09') {startMonthName = 'September';}
					else if (startMonth == '10') {startMonthName = 'October';}
					else if (startMonth == '11') {startMonthName = 'November';}
					else {startMonthName = 'December';}

					document.getElementById("header-start-day-<?php the_ID(); ?>").innerHTML = startDay;
					document.getElementById("header-start-month-<?php the_ID(); ?>").innerHTML = startMonthName.slice(0,3);
					document.getElementById("header-start-year-<?php the_ID(); ?>").innerHTML = startYear;

					document.getElementById("start-day-<?php the_ID(); ?>").innerHTML = startDay;
					document.getElementById("start-month-<?php the_ID(); ?>").innerHTML = startMonthName;
					document.getElementById("start-year-<?php the_ID(); ?>").innerHTML = startYear;

					var endDate = "<?php the_field('end_date'); ?>";
					console.log(endDate);
					
					if (endDate !== "") {	
						var endYear = endDate.slice(0,4);
						var endMonth = endDate.slice(4,6);
						var endDay = endDate.slice(6,8);
						var endMonthName;	

						if (endMonth == '01') {endMonthName = 'January';}
						else if (endMonth == '02') {endMonthName = 'February';}
						else if (endMonth == '03') {endMonthName = 'March';}
						else if (endMonth == '04') {endMonthName = 'April';}
						else if (endMonth == '05') {endMonthName = 'May';}
						else if (endMonth == '06') {endMonthName = 'June';}
						else if (endMonth == '07') {endMonthName = 'July';}
						else if (endMonth == '08') {endMonthName = 'August';}
						else if (endMonth == '09') {endMonthName = 'September';}
						else if (endMonth == '10') {endMonthName = 'October';}
						else if (endMonth == '11') {endMonthName = 'November';}
						else {endMonthName = 'December';}

						document.getElementById("end-day-<?php the_ID(); ?>").innerHTML = endDay;
						document.getElementById("end-month-<?php the_ID(); ?>").innerHTML = endMonthName;
						document.getElementById("end-year-<?php the_ID(); ?>").innerHTML = endYear;
					}
						
					</script>

				</article>
				<!-- /article -->

			<?php endwhile; ?>

			<?php else: ?>

				<!-- article -->
				<article>
					<h2><?php _e( 'Sorry, nothing to display.'); ?></h2>
				</article>
				<!-- /article -->

			<?php endif; ?>
		</div>

		<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>