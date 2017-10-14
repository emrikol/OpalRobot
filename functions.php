<?php
/**
 * OpalRobot functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package OpalRobot
 */

if ( ! function_exists( 'opalrobot_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function opalrobot_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on OpalRobot, use a find and replace
		 * to change 'opalrobot' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'opalrobot', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'opalrobot' ),
			'menu-2' => esc_html__( 'Secondary', 'opalrobot' ),
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
		add_theme_support( 'custom-background', apply_filters( 'opalrobot_custom_background_args', array(
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

		$sizes = array(
			array(
				'name'   => 'slides-xl',
				'width'  => '750',
				'height' => '422',
				'crop'   => true,
			),
			array(
				'name'   => 'slides-lg',
				'width'  => '600',
				'height' => '337',
				'crop'   => true,
			),
			array(
				'name'   => 'slides-md',
				'width'  => '618',
				'height' => '348',
				'crop'   => true,
			),
			array(
				'name'   => 'slides-sm',
				'width'  => '510',
				'height' => '287',
				'crop'   => true,
			),
			array(
				'name'   => 'slides-thumbnail',
				'width'  => '150',
				'height' => '84',
				'crop'   => true,
			),
		);

		if ( class_exists( 'Flexslider_Admin' ) ) {
			Flexslider_Admin_Views::add_sizes( $sizes );
			add_filter( 'flexslider_admin_slide_width', function( $width ) {
				return 750;
			} );
			add_filter( 'flexslider_admin_slide_height', function( $height ) {
				return 422;
			} );

			add_filter( 'flexslider_admin_thumbnail_size', function ( $size ) {
				return 'slides-thumbnail';
			} );
		}

	}
endif;
add_action( 'after_setup_theme', 'opalrobot_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function opalrobot_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'opalrobot_content_width', 750 );
}
add_action( 'after_setup_theme', 'opalrobot_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function opalrobot_scripts() {
	wp_enqueue_style( 'opalrobot', get_stylesheet_uri() );

	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700', array( 'opalrobot' ) );

	if ( is_front_page() || is_home() ) {

		$flexslider_vars = array(
			'data' => array(
				'animation'      => get_theme_mod( 'fsa-slides_animation', 'fade' ),
				'easing'         => get_theme_mod( 'fsa-slides_easing', 'swing' ),
				'direction'      => get_theme_mod( 'fsa-slides_direction', 'horizontal' ),
				'slideshowSpeed' => ( get_theme_mod( 'fsa-slides_speed' ) ? get_theme_mod( 'fsa-slides_speed' ) : 7 ) * 1000,
				'animationSpeed' => ( get_theme_mod( 'fsa-slides_animation_speed' ) ? get_theme_mod( 'fsa-slides_animation_speed' ) : .6 ) * 1000,
				'initDelay'      => ( get_theme_mod( 'fsa-slides_start_delay' ) ? get_theme_mod( 'fsa-slides_start_delay' ) : 0 ) * 1000,
				'reverse'        => get_theme_mod( 'fsa-slides_reverse' ) ? get_theme_mod( 'fsa-slides_reverse' ) : false,
				'pauseOnAction'  => get_theme_mod( 'fsa-slides_pause_interaction' ) ? get_theme_mod( 'fsa-slides_pause_interaction' ) : false,
				'pauseOnHover'   => get_theme_mod( 'fsa-slides_pause_hover' ) ? get_theme_mod( 'fsa-slides_pause_hover' ) : true,
			),
		);

		$flexslider_inline = <<<EOT
jQuery( window ).load( function() {
	jQuery( '.flexslider' ).flexslider( {
		animation: flexslider_admin.data.animation,
		easing: flexslider_admin.data.easing,
		direction: flexslider_admin.data.direction,
		slideshowSpeed: flexslider_admin.data.slideshowSpeed,
		animationSpeed: flexslider_admin.data.animationSpeed,
		initDelay: flexslider_admin.data.initDelay,
		reverse: flexslider_admin.data.reverse,
		pauseOnAction: flexslider_admin.data.pauseOnAction,
		pauseOnHover: flexslider_admin.data.pauseOnHover,
	} );
} );
EOT;

		wp_enqueue_style( 'flexslider-custom', get_stylesheet_directory_uri() . '/flexslider-custom.css', array( 'flexslider' ) );
		wp_enqueue_style( 'flexslider', get_stylesheet_directory_uri() . '/flexslider/flexslider.css' );
		wp_enqueue_script( 'flexslider', get_stylesheet_directory_uri() . '/flexslider/jquery.flexslider.js', array( 'jquery' ) );
		wp_add_inline_script( 'flexslider', $flexslider_inline );
		wp_localize_script( 'flexslider', 'flexslider_admin', $flexslider_vars );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'opalrobot_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Default Menus.
 */
require get_template_directory() . '/inc/class-opalrobot-default-secondary-walker.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function opalrobot_upload_mime_types( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'opalrobot_upload_mime_types' );

function opalrobot_serve_mime_types( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'mime_types', 'opalrobot_serve_mime_types' );

if ( ! function_exists( 'wpcom_vip_cached_nav_menu' ) ) {
	require_once dirname( __FILE__ ) . '/plugins/cache-nav-menus/cache-nav-menu.php';
}

function opalrobot_nav_menu( $args ) {
	if ( function_exists( 'wpcom_vip_cached_nav_menu' ) ) {
		wpcom_vip_cached_nav_menu( $args );
	} else {
		wp_nav_menu( $args );
	}
}

require_once dirname( __FILE__ ) . '/plugins/Flexslider-Admin/flexslider-admin.php';


function opalrobot_create_default_menus() {
	if ( ! wp_get_nav_menu_object( 'Secondary Navigation [Theme Default]' ) ) {
		$menu_id = wp_create_nav_menu( 'Secondary Navigation [Theme Default]' );
		if ( ! is_wp_error( $menu_id ) ) {
			$locations           = get_theme_mod( 'nav_menu_locations' );
			$locations['menu-2'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );

			$menu_item_data = array(
				'menu-item-title'  => 'Events', // Title
				'menu-item-name'   => 'events', // Slug
				'menu-item-url'    => '/events', // URL
				'menu-item-status' => 'publish',
			);
			wp_update_nav_menu_item( $menu_id, 0, $menu_item_data );

			$menu_item_data = array(
				'menu-item-title'  => 'Connect', // Title
				'menu-item-name'   => 'connect', // Slug
				'menu-item-url'    => '/connect', // URL
				'menu-item-status' => 'publish',
			);
			wp_update_nav_menu_item( $menu_id, 0, $menu_item_data );

			$menu_item_data = array(
				'menu-item-title'  => 'Livestream', // Title
				'menu-item-name'   => 'livestream', // Slug
				'menu-item-url'    => '/livestream', // URL
				'menu-item-status' => 'publish',
			);
			wp_update_nav_menu_item( $menu_id, 0, $menu_item_data );

			$menu_item_data = array(
				'menu-item-title'  => 'Archive', // Title
				'menu-item-name'   => 'archive', // Slug
				'menu-item-url'    => '/archive', // URL
				'menu-item-status' => 'publish',
			);
			wp_update_nav_menu_item( $menu_id, 0, $menu_item_data );
		}
	}

}

add_action( 'wp_loaded', 'opalrobot_create_default_menus' );
