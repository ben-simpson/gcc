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
				$query_args = array( 'post_type' => 'sermon', 'posts_per_page' => 6, 'paged' => $paged );

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
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="partial-hero" style="background: url(<?php echo get_template_directory_uri(); ?>/img/sermon-hero.jpg) no-repeat center center; background-size: cover;"></a>
					<?php endif; ?>

					<!-- author avatar -->
					<a href="<?php the_permalink(); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?></a>

					<div class="details">
						
						<!-- post title -->
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						
						<!-- post author & date -->
						<span class="author">by <?php the_author_posts_link(); ?></span><span class="date"> on <?php the_time('F j, Y'); ?></span>

						<!-- post excerpt -->
						<?php html5wp_excerpt('gcc_custom_post'); // Defined custom callback length in functions.php ?>

						<!-- post categories -->
						<?php if ( has_category()) : // Check if categories exists ?>
							<?php the_category(); ?>
						<?php endif; ?>
						
					</div>

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