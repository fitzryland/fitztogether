<?php
/**
 * PixelSpoke Boilerplate functions and definitions
 *
 * @package PixelSpoke Boilerplate
 */

if ( ! function_exists( 'fitztogether_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fitztogether_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on PixelSpoke Boilerplate, use a find and replace
	 * to change 'fitztogether' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'fitztogether', get_template_directory() . '/languages' );

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
		'primary' => __( 'Primary Menu', 'fitztogether' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	add_image_size( 'small', 150, 150 );
	add_image_size( 'x-large', 700, 700 );
	add_image_size( 'xx-large', 900, 900 );

}
endif; // fitztogether_setup
add_action( 'after_setup_theme', 'fitztogether_setup' );

// apply style to editor
function add_editor_style_function() {
  add_editor_style('style.css');
}
add_action('init', 'add_editor_style_function');

// $wp_admin_bar->remove_node( 'wp-admin-bar-customize' );
add_action( 'admin_bar_menu', 'remove_extra_admin_bar_items', 999 );

function remove_extra_admin_bar_items( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
	$wp_admin_bar->remove_node( 'customize' );
	$wp_admin_bar->remove_node( 'comments' );
	// $wp_admin_bar->remove_node( 'my-account' );
	$wp_admin_bar->remove_node( 'wpseo-menu' );
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function fitztogether_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'fitztogether' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'fitztogether_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fitztogether_scripts() {

	$stylePath = get_stylesheet_directory() . '/style.css';
	wp_enqueue_style( 'fitztogether-style', get_stylesheet_uri(), '', filemtime( $stylePath ) );
  wp_register_script('production', get_bloginfo('stylesheet_directory').'/js/production.js', array('jquery'), false, true);
  wp_register_script('mainScripts',get_bloginfo('template_directory').'/js/main.js',array('jquery'), false, true);
  $php_vars_to_js = array(
  		"site_url" => site_url()
  	);
  wp_localize_script( 'mainScripts', 'phpVars', $php_vars_to_js );

	// PIX_ENVIRONMENT set (or not) in wp-config.php
	if ( ! defined( 'PIX_ENVIRONMENT' ) || PIX_ENVIRONMENT !== 'local' ) :
	  // if not the local environment load the concatinated and minified JS
	  // wp_enqueue_script('productionMin', get_bloginfo('stylesheet_directory').'/js/production.min.js', array('jquery'), false, true);
	  wp_enqueue_script('production');
	else :
	  // if local load the individual files. Better for debugging.
	  wp_enqueue_script('modernizr',get_bloginfo('template_directory').'/js/lib/modernizr.custom.25191.js', array(), false, true);
	  // wp_enqueue_script('bxslider',get_bloginfo('template_directory').'/js/vendor/jquery.bxslider.js',array('jquery'), false, true);
		wp_enqueue_script( 'fitztogether-skip-link-focus-fix', get_template_directory_uri() . '/js/lib/skip-link-focus-fix.js', array(), '20130115', true );
	  wp_enqueue_script('wufoo',get_bloginfo('template_directory').'/js/lib/wufoo.js',array(), false, true);
	  wp_enqueue_script('mainScripts');



	endif;



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fitztogether_scripts' );


if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}



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

/**
 * Add Helper Functions
 */
require get_template_directory() . '/functions-pix-overhead.php';
