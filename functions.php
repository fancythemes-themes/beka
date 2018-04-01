<?php
/**
 * Functions and Definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

/**
 * Beka only works in WordPress 4.5 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.5', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}


if ( ! function_exists( 'beka_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function beka_setup() {
		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on beka, use a find and replace
		 * to change 'beka' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'beka', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for custom logo.
		 */
		add_theme_support( 'custom-logo', array(
			'height'     => 60,
			'width'      => 175,
			'flex-width' => true,
		) );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'beka-featured', 750, 490, true );
		add_image_size( 'beka-grid', 360, 260, true );
		add_image_size( 'beka-author', 262, 274, true );
		add_image_size( 'beka-widget', 108, 78, true );
		add_image_size( 'beka-slider', 878, 635, true );
		add_image_size( 'beka-sliderfull', 1140, 635, true );

		/**
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

		/**
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'beka' ),
		) );
	}

endif;

add_action( 'after_setup_theme', 'beka_setup' );


/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function beka_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'beka_content_width', 750 );
}

add_action( 'after_setup_theme', 'beka_content_width', 0 );


/**
 * Setup the WordPress core custom background feature.
 */
function beka_register_custom_background() {

	add_theme_support( 'custom-background', apply_filters( 'beka_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}

add_action( 'after_setup_theme', 'beka_register_custom_background' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function beka_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'beka' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'beka' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
}

add_action( 'widgets_init', 'beka_widgets_init' );


/**
 * Registers Widgets.
 */
function beka_register_widgets() {

	require( get_template_directory() . '/inc/widgets/widget-about.php' );
	require( get_template_directory() . '/inc/widgets/widget-recent-posts.php' );

	register_widget( 'Beka_Widget_About' );
	register_widget( 'Beka_Widget_Recent_Posts' );
}

add_action( 'widgets_init', 'beka_register_widgets' );


/**
 * Enqueue scripts and styles.
 */
function beka_scripts() {
	$version = wp_get_theme()->get( 'Version' );

	/**
	 * Load FontAwesome
	 */
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0' );

	/**
	 * Load Theme Styles.
	 */
	wp_enqueue_style( 'beka-style', get_stylesheet_uri(), array(), $version );

	/**
	 * Load Theme Scripts.
	 */
	wp_enqueue_script( 'beka-navigation', get_template_directory_uri() . '/js/navigation.js', array(), $version, true );
	wp_enqueue_script( 'beka-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), $version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'beka_scripts' );


if ( ! function_exists( 'beka_load_font' ) ) :
	/**
	 * Load Google Web Fonts.
	 */
	function beka_load_font() {

		wp_enqueue_style( 'beka-google-fonts', '//fonts.googleapis.com/css?family=Playfair+Display:400,700|Caveat:400,700|Signika:400,300,600,700', false );
	}

endif;

add_action( 'wp_enqueue_scripts', 'beka_load_font' );


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

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
