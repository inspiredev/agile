<?php
/**
 * The template for displaying reference posts.
 *
 * @package agile
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="page-header">
			<div class="page-title">
				<span class="reference-title"><?php the_title(); ?></span>
			</div>
		</div>
		<div class="reference-content">
			<div class="reference-info">
				<div class="year"><label>Year:</label> <?php the_field( 'year' ); ?></div>
				<div class="country"><label>Country:</label> <?php the_field( 'country' );?></div>
			</div>
			<div class="reference-image">
				<?php the_post_thumbnail( 'large' ); ?>
			</div>
			<div class="reference-details">
				<?php the_content(); ?>
			</div>
		</div><!-- .reference-content -->
	<?php endwhile; // end of the loop. ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>