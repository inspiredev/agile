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
				<?php $release = new WP_Query( array(
					'connected_type' => 'reference_to_release',
					'connected_items' => get_queried_object(),
					'posts_per_page' => 1
				) );
				if ( $release->have_posts() ) {
					while ( $release->have_posts() ) { $release->the_post();
				?>
				<li>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<i class="fa fa-chevron-right"></i>
				</li>
					<?php } ?>
				<?php }
				wp_reset_postdata(); ?>
				<li><?php the_title(); ?></li>
			</ul>
		</div><!-- .breadcrumb -->
		<div class="page-header">
			<div class="page-title">
				<span class="reference-title"><?php the_title(); ?></span>
			</div>
		</div>
		<div class="reference-content">
			<div class="reference-info">
				<div class="year"><label><?php _e( 'Year', 'agile' ); ?>:</label> <?php the_field( 'year' ); ?></div>
				<div class="country"><label><?php _e( 'Country', 'agile' ); ?>:</label> <?php the_field( 'country' );?></div>
				<div class="url"><label><?php _e( 'URL', 'agile' ); ?>:</label> <a href="<?php the_field( 'client_url' ); ?>"><?php the_field( 'client_url' ); ?></a></div>
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