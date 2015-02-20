<?php
/*
Default template
*/

get_header(); ?>

	<div id="primary" class="content-area full-width">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'agile' ); ?>
			<?php get_sidebar(); ?>
		<?php endwhile; ?>
	<?php endif; ?>
	</div><!-- #primary -->

<?php get_footer();?>