<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package agile
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'agile' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php echo get_stylesheet_directory_uri() . '/assets/logo.png' ?>" alt="<?php bloginfo( 'name' ); ?>"/>
				</a>
			</h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div><!-- .site-branding -->

		<a class="menu-toggle" aria-controls="menu">
			<i class="icono-bars"></i>
			<span class="screen-reader-text"><?php _e( 'Primary Menu', 'agile' ); ?></span>
		</a>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php //wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			<ul class="top-level">
			<?php
				$categories = get_categories();
				foreach( $categories as $cat ) { ?>
					<li><a href="#" class="category-name"><?php _e( $cat->name ); ?></a>
						<div class="releases">
							<h3>New Releases</h3>
							<?php $releases = new WP_Query( array(
								'category_name' => $cat->slug,
								'post_type' => 'release'
							) );
							if ( $releases->have_posts() ) { ?>
								<ul>
								<?php while ( $releases->have_posts() ) {
									$releases->the_post(); ?>
									<li><?php _e( get_the_title() ); ?>
									</li>
								<?php } ?>
								</ul>
							<?php } ?>
						</div><!-- .releases -->
						<?php wp_reset_postdata(); ?>
						<div class="references">
							<h3>Success Stories</h3>
							<?php $references = new WP_Query( array(
								'category_name' => $cat->slug,
								'post_type' => 'reference'
							) );
							if ( $references->have_posts() ) { ?>
								<ul>
								<?php while ( $references->have_posts() ) {
									$references->the_post(); ?>
									<li><?php _e( get_the_title() ); ?>
									</li>
								<?php } ?>
								</ul>
							<?php } ?>
						</div><!-- .references -->
						<?php wp_reset_postdata(); ?>
						<div class="highlights">
							<h3>Highlights</h3>
							<?php $highlights = new WP_Query( array(
								'category_name' => $cat->slug,
								'post_type' => 'highlight'
							) );
							if ( $highlights->have_posts() ) { ?>
								<ul>
								<?php while ( $highlights->have_posts() ) {
									$highlights->the_post(); ?>
									<li><?php _e( get_the_title() ); ?>
									</li>
								<?php } ?>
								</ul>
							<?php } ?>
						</div><!-- .highlights -->
						<?php wp_reset_postdata(); ?>
					</li><?php
				}
			?>
			</ul>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
