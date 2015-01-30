<?php
/**
 * The template for displaying release posts.
 *
 * @package agile
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="page-header">
				<div class="page-title">
					<span class="category-title"><?php
					// fix for old PHP
					$categories = get_the_category();
					echo $categories[0]->name; ?> | </span>
					<span class="release-title"><?php echo get_the_title(); ?></span>
				</div>
				<div class="release-tabs">
					<a class="tab active" href="#overview" data-toggle="tab">Overview</a>
					<a class="tab" href="#solution-details" data-toggle="tab">Solution Detail</a>
					<a class="tab" href="#references" data-toggle="tab">References</a>
				</div>
			</div>
			<div class="release-content tab-content">
				<div id="overview" class="tab-pane fade in active"><?php the_content(); ?></div>
				<div id="solution-details" class="tab-pane fade"><?php the_field('solution_details'); ?></div>
				<div id="references" class="tab-pane fade">
				<?php
				$references = new WP_Query( array(
					'connected_type' => 'reference_to_release',
					'connected_items' => get_queried_object(),
					'nopaging' => true,
				) );
				if ( $references->have_posts() ) {
					while ( $references->have_posts() ) {
						$references->the_post();
						?>
						<div class="reference">
							<h4 class="reference-title"><?php the_title(); ?></h4>
						</div>
					<?php }
					wp_reset_postdata();
				}
				?>
				</div>
			</div>
		<?php endwhile; // end of the loop. ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>
