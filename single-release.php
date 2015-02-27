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
			<?php
			$references = new WP_Query( array(
				'connected_type' => 'reference_to_release',
				'connected_items' => get_queried_object(),
				'nopaging' => true,
			) );
			$solution_detail = new WP_Query( array(
				'connected_type' => 'release_to_solution_detail',
				'connected_items' => get_queried_object(),
				'nopaging' => true,
			) );
			?>
			<div class="breadcrumb">
				<ul>
					<li data-breadcrumb="home"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'Home', 'agile' ); ?></a>
						<i class="fa fa-chevron-right"></i>
					</li>
					<?php
						$categories = get_the_category();
						$category = $categories[0];
					?>
					<li><a href="<?php get_category_link( $category->term_id ); ?>"><?php echo $category->cat_name; ?></a>
						<i class="fa fa-chevron-right"></i>
					</li>
					<li><?php the_title(); ?></li>
				</ul>
			</div><!-- .breadcrumb -->
			<div class="page-header">
				<div class="page-title">
					<span class="category-title"><?php
					// fix for old PHP
					$categories = get_the_category();
					echo $categories[0]->name; ?></span>
					<span class="separator"> | </span>
					<span class="release-title"><?php echo get_the_title(); ?></span>
				</div>
				<ul class="release-tabs">
				<?php if ( $solution_detail->have_posts() || $references->have_posts() ) { ?>
					<li class="active"><a class="tab" href="#overview" data-toggle="tab"><?php _e( 'Overview', 'agile' ); ?></a></li>
				<?php } ?>
				<?php if ( $solution_detail->have_posts() ) { ?>
					<li><a class="tab" href="#solution-details" data-toggle="tab"><?php _e( 'Solution Detail', 'agile' ); ?></a></li>
				<?php } ?>
				<?php if ( $references->have_posts() ) { ?>
					<li><a class="tab" href="#references" data-toggle="tab"><?php _e( 'References', 'agile' ); ?></a></li>
				<?php } ?>
				</ul>
			</div>
			<div class="release-content tab-content">
				<div id="overview" class="tab-pane fade in active">
					<h4 class="subtitle"><?php the_field( 'subtitle' ); ?></h4>
					<?php the_content(); ?>
				</div>
				<div id="solution-details" class="tab-pane fade">
				<?php if ( $solution_detail->have_posts() ) {
					while ( $solution_detail->have_posts() ) {
						$solution_detail->the_post();
						the_content();
					}
				} ?>
				</div>
				<div id="references" class="tab-pane fade">
				<?php if ( $references->have_posts() ) {
					while ( $references->have_posts() ) {
						$references->the_post();
						?>
						<div class="reference">
							<div class="reference-image"><?php the_post_thumbnail( 'large' ); ?></div>
							<div class="reference-details">
								<h3 class="reference-title"><?php the_title(); ?></h3>
								<div class="reference-info">
									<div class="year"><label><?php _e( 'Year', 'agile' ); ?>:</label> <?php the_field( 'year' ); ?></div>
									<div class="country"><label><?php _e( 'Country', 'agile' ); ?>:</label> <?php the_field( 'country' ); ?></div>
									<div class="url"><label><?php _e( 'URL', 'agile' ); ?>:</label> <a href="<?php the_field( 'client_url' ); ?>"><?php the_field( 'client_url' ); ?></a></div>
								</div>
								<div class="reference-content">
									<?php the_excerpt( '<div class="more">Read More</div>' ); ?>
									<a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'agile' ); ?></a>
								</div>
							</div>
						</div>
					<?php }
					wp_reset_postdata();
				}
				?>
				</div><!-- #references -->
			</div><!-- .release-content -->
		<?php endwhile; // end of the loop. ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>
