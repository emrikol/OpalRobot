<?php
/**
 * Main file for Flexslider_Admin_Views class.
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The child class for managing Flexslider Admin views.
 */
class Flexslider_Admin_Views extends Flexslider_Admin {
	/**
	 * Holds the structure of metabox data.
	 *
	 * @var array
	 */
	private $meta_box_data;

	/**
	 * Primary Flexslider Admin Views constructor.
	 *
	 * Sets up data and WordPress hooks.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->meta_box_data = array(
			'slide_url' => array(
				'name' => 'slide_url',
				'std'  => '',
			),
		);

		add_action( 'do_meta_boxes', array( $this, 'slide_image_box' ) );
		add_action( 'do_meta_boxes', array( $this, 'remove_jetpack_likes_metabox' ) );
		add_action( 'admin_menu', array( $this, 'remove_permalink_meta_box' ) );
		add_action( 'do_meta_boxes', array( $this, 'create_url_meta_box' ) );
		add_action( 'save_post_fsa-slide', array( $this, 'save_postdata' ) );
		add_action( 'manage_posts_custom_column', array( $this, 'custom_columns' ) );

		add_filter( 'manage_edit-fsa-slide_columns', array( $this, 'edit_columns' ) );
	}

	/**
	 * Customize and move featured image box to main column.
	 *
	 * @return void
	 */
	public function slide_image_box() {
		// translators: 1st %d is width in pixels, 2nd %d is height in pixels.
		$title = sprintf( esc_html__( 'Slide Image (%1$dx%2$d)', 'flexslider-admin' ),
			/**
			 * Filters the width shown in the Slide editor.
			 *
			 * @since 1.0.0
			 *
			 * @param int $width Image width in pixels.  Defaults to 0.
			 */
			absint( apply_filters( 'flexslider_admin_slide_width', 0 ) ),
			/**
			 * Filters the height shown in the Slide editor.
			 *
			 * @since 1.0.0
			 *
			 * @param int $height Image height in pixels.  Defaults to 0.
			 */
			absint( apply_filters( 'flexslider_admin_slide_height', 0 ) )
		);

		remove_meta_box( 'postimagediv', $this->cpt, 'side' );
		add_meta_box( 'postimagediv', $title, 'post_thumbnail_meta_box', $this->cpt, 'normal', 'high' );
	}

	/**
	 * Remove Jetpack likes metabox.
	 *
	 * @return void
	 */
	public function remove_jetpack_likes_metabox() {
		remove_meta_box( 'sharing_meta', array( $this->cpt ), 'advanced' );
	}

	/**
	 * Remove permalink metabox.
	 *
	 * @return void
	 */
	public function remove_permalink_meta_box() {
		remove_meta_box( 'slugdiv', $this->cpt, 'core' );
	}

	/**
	 * Adds meta box for Slide URL.
	 *
	 * @return void
	 */
	public function create_url_meta_box() {
		add_meta_box( 'flexslider-admin-url-box', esc_html__( 'Slide Link', 'flexslider-admin' ), array( $this, 'output_url_meta_box' ), $this->cpt, 'normal', 'low' );
	}

	/**
	 * Outputs markup for Slide URL metabox.
	 *
	 * @return void
	 */
	public function output_url_meta_box() {
		global $post;

		foreach ( $this->meta_box_data as $meta_box ) {
			$nonce      = $meta_box['name'] . '_noncename';
			$meta_name  = $meta_box['name'] . '_value';
			$meta_value = get_post_meta( $post->ID, $meta_box['name'] . '_value', true );

			if ( '' === trim( $meta_value ) ) {
				$meta = $meta_box['std'];
			}

			echo "<input type='hidden' name='" . esc_attr( $nonce ) . "' id='" . esc_attr( $nonce ) . "' value='" . esc_attr( wp_create_nonce( plugin_basename( __FILE__ ) ) ) . "' />";
			echo "<input type='text' name='" . esc_attr( $meta_name ) . "' value='" . esc_attr( $meta_value ) . "' size='55' /><br />";
			echo '<p>' . esc_html__( 'Add the URL this slide should link to.', 'flexslider-admin' ) . '</p>';
		}
	}

	/**
	 * Save and retrieve the Slide URL data.
	 *
	 * @param int $post_id The post ID.
	 *
	 * @return void
	 */
	public function save_postdata( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		global $post;

		foreach ( $this->meta_box_data as $meta_box ) {
			if (
				isset( $_POST[ $meta_box['name'] . '_noncename' ] ) // Input var okay.
				&& ! wp_verify_nonce( sanitize_key( $_POST[ $meta_box['name'] . '_noncename' ] ), plugin_basename( __FILE__ ) ) // Input var okay.
			) {
				return $post_id;
			}

			$meta_name  = $meta_box['name'] . '_value';
			$meta_value = isset( $_POST[ $meta_name ] ) ? sanitize_text_field( wp_unslash( $_POST[ $meta_name ] ) ) : false; // Input var okay.

			if ( '' === trim( $meta_value ) ) {
				delete_post_meta( $post_id, $meta_name );
			} else {
				switch ( $meta_box['type'] ) {
					case 'url':
						$meta_value = esc_url_raw( $meta_value );
						break;
				}

				update_post_meta( $post_id, $meta_name, $meta_value );
			}
		}
	}

	/**
	 * Adds slide image and link to slides column view.
	 *
	 * @param array $columns The filterable columns.
	 *
	 * @return array
	 */
	public function edit_columns( $columns ) {
		$columns = array(
			'cb'         => '<input type="checkbox" />',
			'slide'      => esc_html__( 'Slide Image', 'flexslider-admin' ),
			'title'      => esc_html__( 'Slide Title', 'flexslider-admin' ),
			'slide-link' => esc_html__( 'Slide Link', 'flexslider-admin' ),
			'date'       => esc_html__( 'Date', 'flexslider-admin' ),
		);

		return $columns;
	}

	/**
	 * Provides data for custom columns.
	 *
	 * @param array $column The filterable columns.
	 *
	 * @return void
	 */
	public function custom_columns( $column ) {
		global $post;

		switch ( $column ) {
			case 'slide':
				/**
				 * Filters the size of the Slide thumbnals in wp-admin.
				 *
				 * @since 1.0.0
				 *
				 * @param string|array $size Image size to retrieve. Accepts any valid image size, or an array of
				 *                           width and height values in pixels (in that order). Default 'thumbnail'.
				 */
				echo the_post_thumbnail( apply_filters( 'flexslider_admin_thumbnail_size', 'thumbnail' ) );
				break;
			case 'slide-link':
				if ( '' !== get_post_meta( $post->ID, 'slide_url_value', true ) ) {
					echo "<a href='" . esc_url( get_post_meta( $post->ID, 'slide_url_value', true ) ) . "'>" . esc_html( get_post_meta( $post->ID, 'slide_url_value', true ) ) . '</a>';
				} else {
					esc_html_e( 'No Link', 'flexslider-admin' );
				}
				break;
		}
	}
}
