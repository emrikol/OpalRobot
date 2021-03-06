<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package OpalRobot
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function opalrobot_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'opalrobot_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details' => array(
			'stylesheet' => 'opalrobot-style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
	) );
}
add_action( 'after_setup_theme', 'opalrobot_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function opalrobot_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}

// Photonize Theme Images.
function opalrobot_photonize_media( $url ) {
	if ( function_exists( 'jetpack_photon_url' ) && false === strpos( $url, '.svg' ) ) {
		return jetpack_photon_url( $url );
	}
	return $url;
}
add_filter( 'theme_mod_l_image_1_media', 'opalrobot_photonize_media', 10, 1 );
add_filter( 'theme_mod_l_image_2_media', 'opalrobot_photonize_media', 10, 1 );
add_filter( 'theme_mod_t_link_1_media', 'opalrobot_photonize_media', 10, 1 );
add_filter( 'theme_mod_t_link_2_media', 'opalrobot_photonize_media', 10, 1 );
add_filter( 'theme_mod_t_link_3_media', 'opalrobot_photonize_media', 10, 1 );
add_filter( 'theme_mod_t_link_4_media', 'opalrobot_photonize_media', 10, 1 );
add_filter( 'theme_mod_secondary_link_media', 'opalrobot_photonize_media', 10, 1 );
