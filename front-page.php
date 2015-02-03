<?php
/**
 * Front page.
 *
 * @package agile
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		$highlights = new WP_Query( array(
			'post_type' => 'highlight'
		) );
		if ( $highlights->have_posts() ) {
			$highlight_groups = floor($highlights->post_count / 4);
			if ($highlights->post_count % 4 != 0) {
				$highlight_groups++;
			}
		?>
			<div class="homepage-highlights">
				<div class="highlights-feature tab-content">
				<?php while ( $highlights->have_posts() ) {
					$highlights->the_post();?>
					<div class="highlight-feature tab-pane fade in<?php if ( $highlights->current_post == 0 ) {?> active<?php } ?>" id="highlight-<?php echo $post->ID; ?>">
						<div class="feature-image"><?php the_post_thumbnail( 'lage' ); ?></div>
						<div class="title"><?php the_title(); ?></div>
						<div class="excerpt"><?php the_excerpt(); ?></div>
						<a class="read-more">Read more</a>
					</div>
				<?php } ?>
				</div><!-- .homepage-highlights-feature -->
				<div id="homepage-highlights-list" class="highlights-list carousel slide" data-ride="carousel" data-interval="false">
					<h3>Highlights</h3>
					<ol class="carousel-indicators">
					<?php for ($i = 0; $i < $highlight_groups; $i++) {?>
						<li data-target="#homepage-highlights-list" data-slide-to="<?php echo $i; ?>"<?php if ( $i == 0 ) {?> class="active"<?php } ?>>
					<?php } ?>
					</ol>
					<div class="carousel-inner">
					<?php while ( $highlights->have_posts() ) {
						$highlights->the_post();
						if ( $highlights->current_post % 4 == 0 ) { ?>
						<div class="highlights-list-group item<?php if ($highlights->current_post == 0 ) {?> active<?php } ?>">
						<?php } ?>
						<div class="highlight<?php if ( $highlights->current_post == 0 ) {?> active<?php } ?>">
							<a class="tab" href="#highlight-<?php echo $post->ID; ?>" data-toggle="tab">
							<?php the_field( 'date' );
							the_title();
							the_excerpt();?>
							</a>
						</div><!-- highlight -->
						<?php if ( ($highlights->current_post + 1) % 4 == 0 ) { ?>
						</div><!-- .highlights-list-group -->
						<?php } ?>
					<?php
					}
					wp_reset_postdata();
					?>
					</div><!-- .carousel-inner -->
				</div><!-- .highlights-list -->
			</div>
		<?php }
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
