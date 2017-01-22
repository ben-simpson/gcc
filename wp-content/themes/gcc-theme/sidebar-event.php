<!-- sidebar -->
<aside class="sidebar" role="complementary">

	<div class="sidebar-widget">
		<h3>Related Events</h3>
		
		<?php
			// Targets the latest Sermon for the query
			$query_args = array( 'post_type' => 'event',
								 'category__in' => wp_get_post_categories($post->ID),
								 'post__not_in' => array($post->ID),
								 'posts_per_page' => 2 );
			// Create custom query
			$wp_query = new WP_Query( $query_args );
		?>

		<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

			<div class="preview event-<?php the_ID(); ?>">
				
				<!-- post thumbnail -->
				<?php 	$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				
				<!-- post header image -->
				<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="partial-hero" style="background: url(<?php echo $thumb_url; ?>) no-repeat center center; background-size: cover;"></a>
				<?php else: ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="partial-hero" style="background: url(<?php echo get_template_directory_uri(); ?>/img/event-hero.jpg) no-repeat center center; background-size: cover;"></a>
				<?php endif; ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="hero-date">
					<span class="day"></span>
					<span class="month"></span>
					<span class="year"></span>
				</a>
				<div class="details">
					<a href="<?php the_permalink(); ?>"><h3 class="title"><?php the_title(); ?></h3></a>

					<!-- event date range -->
					<a href="<?php the_permalink(); ?>">
						<span class="start-date"></span>

						<?php if (!empty( get_field( 'start_time' ) )) : ?>
							<span> at </span><span id="start-time"><?php the_field( 'start_time' ); ?><?php the_field( 'start_time_period' ); ?></span>
						<?php endif; ?>
						<?php if (!empty( get_field( 'end_date' ) )) : ?>
							<br/><span>until </span><span class="end-date"></span>
						<?php endif; ?>
						<?php if (!empty( get_field( 'end_time' ) )) : ?>
							<span> at </span><span id="end-time"><?php the_field( 'end_time' ); ?><?php the_field( 'end_time_period' ); ?></span>
						<?php endif; ?>
					</a>

				</div>

			</div>
		
			<script>
				var startDate = "<?php the_field('start_date'); ?>";
				var startMonth = getMonth(startDate);
				var startDateString = startMonth + " " + startDate.slice(6,8) + ", " + startDate.slice(0,4);

				$(".event-<?php the_ID(); ?> .start-date").html(startDateString);
				$(".event-<?php the_ID(); ?> .hero-date .day").html(startDate.slice(6,8));
				$(".event-<?php the_ID(); ?> .hero-date .month").html(startMonth.slice(0,3));
				$(".event-<?php the_ID(); ?> .hero-date .year").html(startDate.slice(0,4));

				var endDate = "<?php the_field('end_date'); ?>";
				if (endDate !== ""){
					var endMonth = getMonth(endDate);
					var endDateString = endMonth + " " + endDate.slice(6,8) + ", " + endDate.slice(0,4);

					$(".event-<?php the_ID(); ?> .end-date").html(endDateString);
				}

				function getMonth(date){

					var month = date.slice(4,6);
					var monthName;

					if (month == '01') {monthName = 'January';}
					else if (month == '02') {monthName = 'February';}
					else if (month == '03') {monthName = 'March';}
					else if (month == '04') {monthName = 'April';}
					else if (month == '05') {monthName = 'May';}
					else if (month == '06') {monthName = 'June';}
					else if (month == '07') {monthName = 'July';}
					else if (month == '08') {monthName = 'August';}
					else if (month == '09') {monthName = 'September';}
					else if (month == '10') {monthName = 'October';}
					else if (month == '11') {monthName = 'November';}
					else {monthName = 'December';}

					return monthName;

				}
			</script>

		<?php endwhile; ?>

		<?php else: ?>
		
			<h4>There are no related sermons.</h4>
		
		<?php wp_reset_postdata(); ?>

		<?php endif; ?>
		
	</div>
	
	<div class="sidebar-widget">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
	</div>

	<div class="sidebar-widget">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
	</div>

</aside>
<!-- /sidebar -->
