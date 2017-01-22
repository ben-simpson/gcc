<?php get_header(); ?>

	<main role="main">

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<!-- post thumbnail -->
				<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				
				<!-- post header image -->
				<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
					<div class="hero" style="background: url(<?php echo $thumb_url; ?>) no-repeat center center; background-size: cover;"></div>
				<?php else: ?>
					<div class="hero" style="background: url(<?php echo get_template_directory_uri(); ?>/img/sermon-hero.jpg) no-repeat center center; background-size: cover;"></div>
				<?php endif; ?>
				
				<h1><?php the_title(); ?></h1>
				
				<p class="article-details">by <span class="author"><?php the_author_posts_link(); ?> </span> on <span class="date"><?php the_time('F j, Y'); ?></span></p>

				<!-- post categories -->
				<?php if ( has_category()) : // Check if categories exists ?>
					<?php the_category(); ?>
				<?php endif; ?>
				
				<?php $sermon_audio = get_field( 'sermon_audio_url'); ?>
				
				<?php if ( !empty( $sermon_audio )) : ?>
					<div id="audio-player" class="audio-player">

						<audio class="audio" ontimeupdate="audioUpdate('audio-player')" preload="metadata">
							<source src="<?php echo $sermon_audio; ?>" type="audio/mp3">
						</audio>

						<div class="progress"><div class="progress-bar"></div></div>

						<div class="track-meta">
							<div class="thumbnail"><?php echo get_avatar(get_the_author_meta( 'ID' ),80); ?></div>
							<div class="meta">
								<span class="title"><?php the_title(); ?></span>
								<span class="artist">by <?php the_author(); ?></span>
							</div>
						</div>

						<div class="controls">
							<div class="play-btn"><svg class="icon-play"><use xlink:href="#play"></use></svg><svg class="icon-pause hide"><use xlink:href="#pause"></use></svg></div>
						</div>

						<div class="volume-time">
							
							<div class="mute-btn"><svg class="icon-volume"><use xlink:href="#volume"></use></svg><svg class="icon-mute hide"><use xlink:href="#mute"></use></svg></div>
							<div class="volume"><div class="volume-bar"></div></div>
							
							<div class="time"><span class="current-time">00:00</span><span> | </span><span class="duration">00:00</span></div>
							
							<a href="<?php echo $sermon_audio; ?>" class="download" download=""><svg class="icon-download"><use xlink:href="#cloud-down"></use></svg></a>
						</div>

					</div>
				<?php endif; ?>
				
				
				
				<?php the_content(); ?>

			</article>

			<?php endwhile; ?>

		<?php else: ?>

			<article>

				<h1><?php _e( 'Sorry, nothing to display.'); ?></h1>

			</article>

		<?php endif; ?>

	<?php get_sidebar( 'sermon' ); ?>
		
	</main>



<?php if ( !empty( $sermon_audio )) : ?>
	<script>buildPlayer('audio-player');</script>
<?php endif; ?>

<?php get_footer(); ?>
