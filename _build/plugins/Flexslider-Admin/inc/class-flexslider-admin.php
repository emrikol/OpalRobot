<?php
/**
 * Main file for Flexslider_Admin class.
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The primary singleton class for Flexslider Admin.
 */
class Flexslider_Admin {
	/**
	 * The unique instance of the plugin.
	 *
	 * @var Flexslider_Admin
	 */
	private static $instance;

	/**
	 * Flexslider Admin custom post type slug.
	 *
	 * @var string
	 */
	public $cpt = 'fsa-slide';

	/**
	 * Gets an instance of our plugin.
	 *
	 * @return Flexslider_Admin
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Primary Flexslider Admin constructor.
	 *
	 * Includes necessary files and classes.
	 *
	 * @return null
	 */
	public function __construct() {
		require_once dirname( __FILE__ ) . '/class-flexslider-admin-cpt.php';
		require_once dirname( __FILE__ ) . '/class-flexslider-admin-views.php';
		require_once dirname( __FILE__ ) . '/class-flexslider-admin-customizer.php';

		new Flexslider_Admin_CPT();
		new Flexslider_Admin_Views();
		new Flexslider_Admin_Customizer();
	}

	/**
	 * Adds custom image sizes for Sizes, including 2x sizes.
	 *
	 * @param array $sizes Image sizes to add.
	 *
	 * @return void
	 */
	public function add_sizes( $sizes ) {
		if ( empty( $sizes ) || ! is_array( $sizes ) ) {
			return;
		}

		foreach ( $sizes as $size ) {
			add_image_size( $size['name'], absint( $size['width'] ), absint( $size['height'] ), absint( $size['crop'] ) );
			add_image_size( $size['name'] . '_x2', absint( $size['width'] * 2 ), absint( $size['height'] * 2 ), absint( $size['crop'] ) );
		}
	}

	/**
	 * Returns formatted data about valid slides for frontend output.
	 *
	 * @param array $args Arguments for the Slides query.
	 *
	 * @return array
	 */
	public function get_slides( $args = array() ) {
		$defaults = array(
			'count'      => 10,
			'image_size' => 'full',
		);

		$args = wp_parse_args( $args, $defaults );

		$slide_query_args = array(
			'posts_per_page'         => absint( $args['count'] ),
			'no_found_rows'          => true,
			'update_post_term_cache' => false,
			'post_type'              => Flexslider_Admin::get_instance()->cpt,
		);

		$slides     = new WP_Query( $slide_query_args );
		$slide_data = array();

		if ( $slides->have_posts() ) {
			foreach ( $slides->posts as $slide ) {
				$slide_id = $slide->ID;
				if ( ! empty( get_post_thumbnail_id( $slide_id ) ) ) {
					$slide_data[ $slide_id ]['title']            = get_the_title( $slide_id );
					$slide_data[ $slide_id ]['url']              = get_post_meta( $slide_id, 'slide_url_value', true );
					$slide_data[ $slide_id ]['image']['url']     = get_the_post_thumbnail_url( $slide_id, $args['image_size'] );
					$slide_data[ $slide_id ]['image']['id']      = get_post_thumbnail_id( $slide_id );
					$slide_data[ $slide_id ]['image']['caption'] = wp_get_attachment_caption( $slide_id );
				}
			}
		}

		return $slide_data;
	}

}
