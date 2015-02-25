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
				<div class="highlights-feature">
				<?php while ( $highlights->have_posts() ) {
					$highlights->the_post();?>
					<div class="highlight-feature">
						<div class="feature-image"><?php the_post_thumbnail( 'large' ); ?>
						</div>
						<div class="feature-details">
							<h2 class="title"><?php the_title(); ?></h2>
							<div class="excerpt"><?php the_excerpt(); ?></div>
							<a class="read-more" href="<?php the_permalink(); ?>">Read more</a>
						</div>
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
						<ul class="highlights-list-group item<?php if ($highlights->current_post == 0 ) {?> active<?php } ?>">
						<?php } ?>
							<li class="highlight">
								<a href="<?php the_permalink(); ?>">
								<div class="timestamp">
									<?php
									$dateField = get_field( 'date' );
									$date = DateTime::createFromFormat( 'd/m/Y', get_field( 'date' ) ); ?>
									<?php if ( $date ) { ?>
									<span class="date"><?php echo $date->format( 'd' ); ?></span>
									<span class="month"><?php echo $date->format( 'M' ); ?></span>
									<?php } ?>
								</div>
								<?php the_title();
								the_excerpt();?>
								</a>
							</li><!-- highlight -->
						<?php if ( ($highlights->current_post + 1) % 4 == 0 ) { ?>
						</ul><!-- .highlights-list-group -->
						<?php } ?>
					<?php
					}
					wp_reset_postdata();
					?>
					</div><!-- .carousel-inner -->
				</div><!-- .highlights-list -->
			</div><!-- .homepage-highlights -->
		<?php } ?>
		<div class="homepage-content">
			<?php the_content(); ?>
		</div><!-- .homepage-content -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
