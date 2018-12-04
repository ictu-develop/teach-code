<?php
/**
 * My Vcard functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package my_vcard_resume
 */

if ( ! function_exists( 'my_vcard_resume_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function my_vcard_resume_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on My Vcard, use a find and replace
		 * to change 'my-vcard-resume' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'my-vcard-resume', get_template_directory() . '/languages' );

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
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'my-vcard-resume' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'my_vcard_resume_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		
		// Add theme editor style.
		add_editor_style( 'assets/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'my_vcard_resume_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function my_vcard_resume_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'my_vcard_resume_content_width', 640 );
}
add_action( 'after_setup_theme', 'my_vcard_resume_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function my_vcard_resume_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'my-vcard-resume' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'my-vcard-resume' ),
		'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	
	
}
add_action( 'widgets_init', 'my_vcard_resume_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function my_vcard_resume_scripts() {
	/* PLUGIN CSS */

	wp_enqueue_style( 'Raleway-Roboto-Condensed', '//fonts.googleapis.com/css?family=Raleway:400,600|Roboto+Condensed:400,700', '1.0' );
	
	wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/vendors/font-awesome/css/font-awesome.css' ), '4.7.0' );
	wp_enqueue_style( 'owl-carousel', get_theme_file_uri( '/vendors/owlcarousel/assets/owl.carousel.css' ), '2.3.4' );
	wp_enqueue_style( 'magnific-popup', get_theme_file_uri( '/vendors/magnific-popup/magnific-popup.css' ), '1.1.0' );
	
	/* THEME CORE CSS */
	wp_enqueue_style( 'my-vcard-resume-common', get_theme_file_uri( '/assets/common.css' ), '1.0' );
	wp_enqueue_style( 'my-vcard-resume-layout', get_theme_file_uri( '/assets/layout.css' ), '1.0' );
	wp_enqueue_style( 'my-vcard-resume-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery-slimscroll', get_theme_file_uri( '/vendors/jquery.slimscroll.js' ), array(), '', true );
	wp_enqueue_script( 'owl-carousel', get_theme_file_uri( '/vendors/owlcarousel/owl.carousel.js' ), array(), '', true );
	wp_enqueue_script( 'magnific-popup', get_theme_file_uri( '/vendors/magnific-popup/jquery.magnific-popup.js' ), array(), '', true );
	
	wp_enqueue_script( 'my-vcard-resume-js', get_template_directory_uri().'/assets/my-vcard-resume.js', array('jquery'), '1.0.0', true);
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'my_vcard_resume_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';



/**
 * Customizer additions.
 */
require get_template_directory() . '/vendors/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/kirki.config.php';

require get_template_directory() . '/inc/theme-layout-hook.php';
require get_template_directory() . '/inc/function-hook.php';
require get_template_directory() . '/inc/post-hooks.php';

require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/tgm/recommend-plugins.php';

require get_template_directory() . '/inc/pro/admin-page.php';

//require get_template_directory() . '/inc/trt-customizer/class-customize.php';

require get_template_directory() . '/inc/customizer/customizer.php';
