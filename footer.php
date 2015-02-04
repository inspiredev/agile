<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package agile
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-content">
			<div class="footer-logo">
				<img src="<?php echo get_stylesheet_directory_uri() . '/assets/logo.png' ?>" alt="<?php bloginfo( 'name' ); ?>"/>
			</div>
			<div class="footer-menu">
				<h4>About <?php bloginfo( 'name' ); ?></h4>
			</div>
			<div class="footer-popular">
				<h4><?php _e( 'Most Popular'); ?></h4>
			</div>
			<div class="footer-contact">
				<h4><?php _e( 'Contact' ); ?></h4>
			</div>
		</div>
		<div class="site-footer-bar">
			<div class="site-footer-bar-inner">
				<div class="site-info">
					<?php bloginfo( 'name' ); ?>
					<span class="copyright">Copyright <?php echo date('Y'); ?></span>
				</div><!-- .site-info -->
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
