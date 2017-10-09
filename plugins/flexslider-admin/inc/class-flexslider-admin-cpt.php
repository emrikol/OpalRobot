<?php
/**
 * Main file for Flexslider_Admin_CPT class.
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The child class for managing the Flexslider Admin custom post type.
 */
class Flexslider_Admin_CPT extends Flexslider_Admin {
	/**
	 * Primary Flexslider Admin custom post type constructor.
	 *
	 * Sets up WordPress hooks.
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_cpt' ) );

		add_filter( 'post_updated_messages', array( $this, 'updated_messages' ) );
		add_filter( 'bulk_post_updated_messages', array( $this, 'bulk_updated_messages' ), 10, 2 );
	}

	/**
	 * Register Custom Post Type.
	 *
	 * @return void
	 */
	function register_cpt() {
		$labels = array(
			'name'                  => esc_html_x( 'Slides', 'Post Type General Name', 'flexslider-admin' ),
			'singular_name'         => esc_html_x( 'Slide', 'Post Type Singular Name', 'flexslider-admin' ),
			'menu_name'             => esc_html__( 'Slides', 'flexslider-admin' ),
			'name_admin_bar'        => esc_html__( 'Slides', 'flexslider-admin' ),
			'archives'              => esc_html__( 'Slide Archives', 'flexslider-admin' ),
			'attributes'            => esc_html__( 'Slide Attributes', 'flexslider-admin' ),
			'parent_item_colon'     => esc_html__( 'Parent Slide:', 'flexslider-admin' ),
			'all_items'             => esc_html__( 'All Slides', 'flexslider-admin' ),
			'add_new_item'          => esc_html__( 'Add New Slide', 'flexslider-admin' ),
			'add_new'               => esc_html__( 'Add New', 'flexslider-admin' ),
			'new_item'              => esc_html__( 'New Slide', 'flexslider-admin' ),
			'edit_item'             => esc_html__( 'Edit Slide', 'flexslider-admin' ),
			'update_item'           => esc_html__( 'Update Slide', 'flexslider-admin' ),
			'view_item'             => esc_html__( 'View Slide', 'flexslider-admin' ),
			'view_items'            => esc_html__( 'View Slides', 'flexslider-admin' ),
			'search_items'          => esc_html__( 'Search Slide', 'flexslider-admin' ),
			'not_found'             => esc_html__( 'Not found', 'flexslider-admin' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'flexslider-admin' ),
			'featured_image'        => esc_html__( 'Slide Image', 'flexslider-admin' ),
			'set_featured_image'    => esc_html__( 'Set Slide image', 'flexslider-admin' ),
			'remove_featured_image' => esc_html__( 'Remove Slide image', 'flexslider-admin' ),
			'use_featured_image'    => esc_html__( 'Use as Slide image', 'flexslider-admin' ),
			'insert_into_item'      => esc_html__( 'Insert into slide', 'flexslider-admin' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this slide', 'flexslider-admin' ),
			'items_list'            => esc_html__( 'Slides list', 'flexslider-admin' ),
			'items_list_navigation' => esc_html__( 'Slides list navigation', 'flexslider-admin' ),
			'filter_items_list'     => esc_html__( 'Filter slides list', 'flexslider-admin' ),
		);

		$args = array(
			'label'                 => esc_html__( 'Slide', 'flexslider-admin' ),
			'description'           => esc_html__( 'A list of slides for Flexslider', 'flexslider-admin' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'page-attributes', 'thumbnail' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-images-alt2',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			'rewrite'               => false,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
		);
		register_post_type( $this->cpt, $args );
	}

	/**
	 * Customizes the update message for the custom post type.
	 *
	 * @param array $messages The filterable post update messages.
	 *
	 * @return array $messages
	 */
	function updated_messages( $messages ) {
		$post = get_post();

		$messages[ $this->cpt ] = array(
			1  => esc_html__( 'Slide updated.', 'flexslider-admin' ),
			4  => esc_html__( 'Slide updated.', 'flexslider-admin' ),
			// translators: %s is revision title.
			5  => isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Slide restored to revision from %s', 'flexslider-admin' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // WPCS: input var okay. CSRF ok.
			6  => esc_html__( 'Slide published.', 'flexslider-admin' ),
			7  => esc_html__( 'Slide saved.', 'flexslider-admin' ),
			8  => esc_html__( 'Slide submitted.', 'flexslider-admin' ),
			9  => sprintf(
				// translators: %s is the scheduled datetime.
				wp_kses_post( __( 'Slide scheduled for: <strong>%1$s</strong>.', 'flexslider-admin' ) ),
				esc_html( date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) )
			),
			10 => esc_html__( 'Slide draft updated.' ),
		);

		return $messages;
	}

	/**
	 * Customizes the bulk update message for the custom post type.
	 *
	 * @param array $bulk_messages The filterable post bulk update messages.
	 * @param array $bulk_counts The post bulk update counts.
	 *
	 * @return array $bulk_messages
	 */
	function bulk_updated_messages( $bulk_messages, $bulk_counts ) {
		$bulk_messages['fsa-slide '] = array(
			// translators: %s is the number of slides updated.
			'updated'   => esc_html( _n( '%s Slide updated.', '%s Slides updated.', $bulk_counts['updated'] ) ),
			// translators: %s is the number of slides not updated.
			'locked'    => esc_html( _n( '%s Slide not updated, somebody is editing it.', '%s Slides not updated, somebody is editing them.', $bulk_counts['locked'] ) ),
			// translators: %s is the number of slides deleted.
			'deleted'   => esc_html( _n( '%s Slide permanently deleted.', '%s Slides permanently deleted.', $bulk_counts['deleted'] ) ),
			// translators: %s is the number of slides moved to trash.
			'trashed'   => esc_html( _n( '%s Slide moved to the Trash.', '%s Slides moved to the Trash.', $bulk_counts['trashed'] ) ),
			// translators: %s is the number of slides restored from trash.
			'untrashed' => esc_html( _n( '%s Slide restored from the Trash.', '%s Slides restored from the Trash.', $bulk_counts['untrashed'] ) ),
		);

		return $bulk_messages;
	}
}
