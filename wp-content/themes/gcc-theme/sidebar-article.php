<!-- sidebar -->
<aside class="sidebar" role="complementary">

	<div class="sidebar-widget">
		<h3>Related Articles</h3>
		
		<?php
			// Targets the latest Sermon for the query
			$query_args = array( 'post_type' => 'post',
								 'category__in' => wp_get_post_categories($post->ID),
								 'post__not_in' => array($post->ID),
								 'posts_per_page' => 2 );
			// Create custom query
			$wp_query = new WP_Query( $query_args );
		?>

		<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

			<div class="preview">
				<!-- post header image -->
				<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="partial-hero" style="background: url(<?php echo $thumb_url; ?>) no-repeat center center; background-size: cover;"></a>
				<?php else: ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="partial-hero" style="background: url(<?php echo get_template_directory_uri(); ?>/img/article-hero.jpg) no-repeat center center; background-size: cover;"></a>
				<?php endif; ?>
				<a href="<?php the_permalink(); ?>" class="avatar-link"><?php echo get_avatar(get_the_author_meta( 'ID' ),60); ?></a>
				<div class="details">
					<a href="<?php the_permalink(); ?>"><h3 class="title"><?php the_title(); ?></h3></a>
					<span class="author">by <a href="<?php the_permalink(); ?>"><?php the_author(); ?></a></span>
					<span class="date">on <?php the_time('F j, Y'); ?></span>
				</div>
			</div>

		<?php endwhile; ?>

		<?php else: ?>
		
			<h4>There are no related articles.</h4>
		
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
