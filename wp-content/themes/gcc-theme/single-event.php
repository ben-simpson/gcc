<?php get_header(); ?>

	<main role="main">

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" class="event-<?php the_ID(); ?>" >

				<!-- post thumbnail -->
				<?php 	$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				
				<!-- post header image -->
				<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
					<div class="hero" style="background: url(<?php echo $thumb_url; ?>) no-repeat center center; background-size: cover;"></div>
				<?php else: ?>
					<div class="hero" style="background: url(<?php echo get_template_directory_uri(); ?>/img/event-hero.jpg) no-repeat center center; background-size: cover;"></div>
				<?php endif; ?>
				
				<div class="hero-date">
					<span class="day" id="header-start-day-<?php the_ID(); ?>"></span>
					<span class="month" id="header-start-month-<?php the_ID(); ?>"></span>
					<span class="year" id="header-start-year-<?php the_ID(); ?>"></span>
				</div>
				
				<h1><?php the_title(); ?></h1>
				
				<!-- event date range -->
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
				
				<?php the_content(); ?>

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
				
			</article>

			<?php endwhile; ?>

		<?php else: ?>

			<article>

				<h1><?php _e( 'Sorry, nothing to display.'); ?></h1>

			</article>
		
		<?php endif; ?>

	<?php get_sidebar( 'event' ); ?>
		
	</main>

<?php get_footer(); ?>