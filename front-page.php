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
			$highlight_count = 0;
		?>
			<div class="homepage-highlights">
				<h3>Highlights</h3>
				<div id="homepage-highlights-list" class="highlights-list carousel slide" data-ride="carousel" data-interval="false">
					<ol class="carousel-indicators">
					<?php for ($i = 0; $i < $highlight_groups; $i++) {?>
						<li data-target="#homepage-highlights-list" data-slide-to="<?php echo $i; ?>"<?php if ( $i == 0 ) {?> class="active"<?php } ?>>
					<?php } ?>
					</ol>
					<div class="carousel-inner">
						<?php while ( $highlights->have_posts() ) {
							$highlights->the_post();
							if ( $highlight_count % 4 == 0 ) { ?>
							<div class="highlights-list-group item<?php if ($highlight_count == 0 ) {?> active<?php } ?>">
							<?php } ?>
							<div class="highlight">
							<?php the_field( 'date' );
							the_title();
							the_excerpt();?>
							</div><!-- highlight -->
							<?php $highlight_count++; ?>
							<?php if ( $highlight_count % 4 == 0 ) { ?>
							</div><!-- .highlights-list-group -->
							<?php } ?>
						<?php } ?>
					</div><!-- .carousel-inner -->
				</div><!-- .highlights-list -->
			</div>
		<?php }
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
