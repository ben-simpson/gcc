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
					<div class="hero" style="background: url(<?php echo get_template_directory_uri(); ?>/img/article-hero.jpg) no-repeat center center; background-size: cover;"></div>
				<?php endif; ?>
				
				<h1><?php the_title(); ?></h1>
				
				<p class="article-details">by <span class="author"><?php the_author_posts_link(); ?> </span> on <span class="date"><?php the_time('F j, Y'); ?></span></p>

				<!-- post categories -->
				<?php if ( has_category()) : // Check if categories exists ?>
					<?php the_category(); ?>
				<?php endif; ?>
				
				<?php the_content(); ?>

			</article>

			<?php endwhile; ?>

		<?php else: ?>

			<article>

				<h1><?php _e( 'Sorry, nothing to display.'); ?></h1>

			</article>

		<?php endif; ?>

	<?php get_sidebar( 'article' ); ?>
		
	</main>

<?php get_footer(); ?>