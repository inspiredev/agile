<?php
/*
Template Name: Left Sidebar
*/

get_header(); ?>

	<div id="primary" class="content-area left-sidebar">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<header class="page-header">
				<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			<main id="main" class="site-main" role="main">
				<div class="page-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			</main><!-- #main -->
			<?php get_sidebar(); ?>
		<?php endwhile; ?>
	<?php endif; ?>


	</div><!-- #primary -->

<?php get_footer();?>