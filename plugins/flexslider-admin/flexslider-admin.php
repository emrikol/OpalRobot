<?php
/**
 * Plugin Name: Flexslider Admin
 * Plugin URI: TBA
 * Description: A wp-admin interface to manage slides for Flexslider.  Does not include a frontend function.  It will need to be coded manually.
 * Version: 1.0.0
 * Text Domain: flexslider-admin
 * Author: Derrick Tennant
 * Author URI: https://emrikol.com/
 * GitHub Plugin URI: TBA
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
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
		require_once( dirname( __FILE__ ) . '/inc/class-flexslider-admin-views.php' );
		require_once( dirname( __FILE__ ) . '/inc/class-flexslider-admin-views.php' );
		require_once( dirname( __FILE__ ) . '/inc/class-flexslider-admin-customizer.php' );

		new Flexslider_Admin_CPT();
		new Flexslider_Admin_Views();
		new Flexslider_Admin_Customizer();
	}
}

Flexslider_Admin::get_instance();
