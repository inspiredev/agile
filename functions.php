<?php
/**
 * agile functions and definitions
 *
 * @package agile
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'agile_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function agile_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on agile, use a find and replace
	 * to change 'agile' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'agile', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'agile' ),
		'footer' => __( 'Footer Menu', 'agile' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'agile_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // agile_setup
add_action( 'after_setup_theme', 'agile_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function agile_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'agile' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'	=> __( 'Footer Content', 'agile' ),
		'id'	=> 'footer-content'
	) );
}
add_action( 'widgets_init', 'agile_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function agile_scripts() {
	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Lato' );
	wp_enqueue_style( 'agile-style', get_stylesheet_uri() );
	// for custom style override
	wp_enqueue_style( 'agile-custom', get_template_directory_uri() . '/custom.css' );

	// wp_enqueue_style( 'icono', get_template_directory_uri() . '/assets/icono.min.css' );
	wp_enqueue_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');

	// wp_enqueue_script( 'agile-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'agile-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'agile-main-js', get_template_directory_uri() . '/js/dist/main.js', array( 'jquery' ), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'agile_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Reference post type
 */
require get_template_directory() . '/structure/reference.php';

/**
 * Release post type
 */
require get_template_directory() . '/structure/release.php';

/**
 * Release post type
 */
require get_template_directory() . '/structure/highlight.php';

/**
 * Solution post type
 */
require get_template_directory() . '/structure/solution.php';

/**
 * Post 2 Post Connections
 */
require get_template_directory() . '/structure/connections.php';

/**
 * Excerpt
 */
function agile_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'agile_excerpt_more');
function agile_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'agile_excerpt_length', 999 );

/**
 * Date format for localization
 */
function agile_translate_date_format($format) {
	if (function_exists('icl_translate')) {
		$format = icl_translate('Formats', $format, $format);
	}
	return $format;
}
add_filter('option_date_format', 'agile_translate_date_format');

// Shortcodes

// [button]
// $atts properties
// - border_radius: eg. "2px"
function agile_button( $atts, $content='' ) {
	$button = shortcode_atts( array(
		'border_radius' => 0
	), $atts );

	return '<button class="agile-button" style="border-radius: ' . $button['border_radius'] . '">' . $content . '</button>';
}
add_shortcode( 'button', 'agile_button' );