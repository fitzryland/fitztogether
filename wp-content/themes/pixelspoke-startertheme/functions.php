<?php
/**
 * PixelSpoke Boilerplate functions and definitions
 *
 * @package PixelSpoke Boilerplate
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'pixelspoke_boilerplate_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pixelspoke_boilerplate_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on PixelSpoke Boilerplate, use a find and replace
	 * to change 'pixelspoke-startertheme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'pixelspoke-startertheme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'pixelspoke-startertheme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

}
endif; // pixelspoke_boilerplate_setup
add_action( 'after_setup_theme', 'pixelspoke_boilerplate_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function pixelspoke_boilerplate_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'pixelspoke-startertheme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'pixelspoke_boilerplate_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pixelspoke_boilerplate_scripts() {

	$stylePath = get_stylesheet_directory() . '/style.css';
	wp_enqueue_style( 'pixelspoke-startertheme-style', get_stylesheet_uri(), '', filemtime( $stylePath ) );

	// PIX_ENVIRONMENT set (or not) in wp-config.php
	if ( ! defined( 'PIX_ENVIRONMENT' ) || PIX_ENVIRONMENT !== 'local' ) :
	  // if not the local environment load the concatinated and minified JS
	  // wp_enqueue_script('productionMin', get_bloginfo('stylesheet_directory').'/js/production.min.js', array('jquery'), false, true);
	  wp_enqueue_script('production', get_bloginfo('stylesheet_directory').'/js/production.js', array('jquery'), false, true);
	else :
	  // if local load the individual files. Better for debugging.
	  wp_enqueue_script('modernizr',get_bloginfo('template_directory').'/js/lib/modernizr.custom.25191.js', array(), false, true);
	  // wp_enqueue_script('bxslider',get_bloginfo('template_directory').'/js/vendor/jquery.bxslider.js',array('jquery'), false, true);
		wp_enqueue_script( 'pixelspoke-startertheme-skip-link-focus-fix', get_template_directory_uri() . '/js/lib/skip-link-focus-fix.js', array(), '20130115', true );
	  wp_enqueue_script('mainScripts',get_bloginfo('template_directory').'/js/main.js',array('jquery'), false, true);



	endif;



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pixelspoke_boilerplate_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
