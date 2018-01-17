=== Flexslider Admin ===
Contributors: emrikol
Tags: flexslider, slides, wp-admin, developer
Donate link: http://wordpressfoundation.org/donate/
Requires at least: 4.8.2
Tested up to: 4.8.2
Requires PHP: 7.0
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides a simple administrative interface to manage slides for Flexslider.

== Description ==

[Flexslider](https://woocommerce.com/flexslider/) is a very powerful jQuery slider toolkit.  While there [are plugins](https://woocommerce.com/products/wooslider/) that can provide a robust interface to manage slides, I needed something a lot simpler.  Some code borrowed from [Meteor Slides](https://github.com/JLeuze/Meteor-Slides) :D

This plugin **WILL NOT**:

* Enqueue Flexslider JS/CSS in your theme.
* Generate HTML markup automatically.
* Manage complex Flexslider layouts and settings.

== Installation ==

This plugin is for developers only, and _will_ require developer work to integrate it into a theme.

There are three filters that should be added:

* `flexslider_admin_slide_width` => The largest width of a slide, used for size display.
* `flexslider_admin_slide_height` => The largest height of a slide, used for size display.
* `flexslider_admin_thumbnail_size` => The size of the thumbnails to show in the admin interface.

One example of how to set up the plugin:

```php
if ( class_exists( 'Flexslider_Admin' ) ) {
	$sizes = array(
		array(
			'name'   => 'slides',
			'width'  => 750,
			'height' => 422,
			'crop'   => true,
		),
		array(
			'name'   => 'slides-thumbnail',
			'width'  => '150',
			'height' => '84',
			'crop'   => true,
		),
	);

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
```

```php
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

$flexslider_inline = <<
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

wp_enqueue_style( 'flexslider', get_stylesheet_directory_uri() . '/flexslider/flexslider.css' );
wp_enqueue_script( 'flexslider', get_stylesheet_directory_uri() . '/flexslider/jquery.flexslider.js', array( 'jquery' ) );
wp_add_inline_script( 'flexslider', $flexslider_inline );
wp_localize_script( 'flexslider', 'flexslider_admin', $flexslider_vars );
```