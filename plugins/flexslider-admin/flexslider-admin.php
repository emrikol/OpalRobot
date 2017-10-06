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

// Register Custom Post Type
function flexslider_admin_register_cpt() {
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
	register_post_type( 'fsa-slide', $args );

}
add_action( 'init', 'flexslider_admin_register_cpt', 0 );

function flexslider_admin_updated_messages( $messages ) {
	$post = get_post();

	$messages['fsa-slide'] = array(
		1  => esc_html__( 'Slide updated.', 'flexslider-admin' ),
		4  => esc_html__( 'Slide updated.', 'flexslider-admin' ),
		5  => isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Slide restored to revision from %s', 'flexslider-admin' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // WPCS: input var okay. CSRF ok.
		6  => esc_html__( 'Slide published.', 'flexslider-admin' ),
		7  => esc_html__( 'Slide saved.', 'flexslider-admin' ),
		8  => esc_html__( 'Slide submitted.', 'flexslider-admin' ),
		9  => sprintf(
			wp_kses_post( __( 'Legacy Redirect scheduled for: <strong>%1$s</strong>.', 'flexslider-admin' ) ),
			esc_html( date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) )
		),
		10 => esc_html__( 'Slide draft updated.' ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'flexslider_admin_updated_messages' );

function flexslider_admin_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	$bulk_messages['fsa-slide '] = array(
		'updated'   => esc_html( _n( '%s Slide updated.', '%s Slides updated.', $bulk_counts['updated'] ) ),
		'locked'    => esc_html( _n( '%s Slide not updated, somebody is editing it.', '%s Slides not updated, somebody is editing them.', $bulk_counts['locked'] ) ),
		'deleted'   => esc_html( _n( '%s Slide permanently deleted.', '%s Slides permanently deleted.', $bulk_counts['deleted'] ) ),
		'trashed'   => esc_html( _n( '%s Slide moved to the Trash.', '%s Slides moved to the Trash.', $bulk_counts['trashed'] ) ),
		'untrashed' => esc_html( _n( '%s Slide restored from the Trash.', '%s Slides restored from the Trash.', $bulk_counts['untrashed'] ) ),
	);

	return $bulk_messages;
}
add_filter( 'bulk_post_updated_messages', 'flexslider_admin_bulk_updated_messages', 10, 2 );

// Customize and move featured image box to main column
function flexslider_admin_image_box() {
	$options = get_option( 'flexslider_admin_options' );
	$title = sprintf( esc_html__( 'Slide Image (%1$dx%2$d)', 'flexslider-admin' ),
		absint( $options['slide_width'] ),
		absint( $options['slide_height'] )
	);

	remove_meta_box( 'postimagediv', 'fsa-slide', 'side' );
	add_meta_box( 'postimagediv', $title, 'post_thumbnail_meta_box', 'fsa-slide', 'normal', 'high' );
}
add_action( 'do_meta_boxes', 'flexslider_admin_image_box' );

// Remove Jetpack likes metabox
function flexslider_admin_remove_jetpack_likes_metabox() {
	remove_meta_box( 'sharing_meta', array( 'fsa-slide' ), 'advanced' );
}
add_action( 'do_meta_boxes', 'flexslider_admin_remove_jetpack_likes_metabox' );

// Remove permalink metabox
function flexslider_admin_remove_permalink_meta_box() {
	remove_meta_box( 'slugdiv', 'fsa-slide', 'core' );
}
add_action( 'admin_menu', 'flexslider_admin_remove_permalink_meta_box' );

// Adds meta box for Slide URL
function flexslider_admin_create_url_meta_box() {
	global $theme_name;

	if ( function_exists( 'add_meta_box' ) ) {
		add_meta_box( 'flexslider-admin-url-box', esc_html__( 'Slide Link','flexslider-admin' ), 'flexslider_admin_new_meta_box', 'fsa-slide', 'normal', 'low' );
	}
}
add_action( 'admin_menu', 'flexslider_admin_create_url_meta_box' );

function flexslider_admin_new_meta_box() {
	global $post;

	$flexslider_admin_new_meta_box = array(
		'slide_url' => array(
			'name' => 'slide_url',
			'std' => '',
		),
	);

	foreach ( $flexslider_admin_new_meta_box as $meta_box ) {
		$nonce = $meta_box['name'] . '_noncename';
		$meta_name = $meta_box['name'] . '_value';
		$meta_value = get_post_meta( $post->ID, $meta_box['name'] . '_value', true );

		if ( '' === trim( $meta_value ) ) {
			$meta = $meta_box['std'];
		}

		echo "<input type='hidden' name='" . esc_attr( $nonce ) . "' id='" . esc_attr( $nonce ) . "' value='" . esc_attr( wp_create_nonce( plugin_basename( __FILE__ ) ) ) . "' />";
		echo "<input type='text' name='" . esc_attr( $meta_name ) . "' value='" . esc_attr( $meta_value ) . "' size='55' /><br />";
		echo '<p>' . esc_html__( 'Add the URL this slide should link to.','flexslider-admin' ) . '</p>';
	}
}

// Save and retrieve the Slide URL data
add_action( 'save_post_fsa-slide', 'flexslider_admin_save_postdata' );
function flexslider_admin_save_postdata( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}

	global $post;

	$flexslider_admin_new_meta_box = array(
		'slide_url' => array(
			'name' => 'slide_url',
			'type' => 'url',
			'std' => '',
		),
	);

	foreach ( $flexslider_admin_new_meta_box as $meta_box ) {
		$nonce = isset( $_POST[ $meta_box['name'] . '_noncename' ] ) ? $_POST[ $meta_box['name'] . '_noncename' ] : false; //@codingStandardsIgnoreLine.
		$meta_name = $meta_box['name'] . '_value';
		$meta_value = sanitize_text_field( $_POST[ $meta_name ] ); //@codingStandardsIgnoreLine.

		if ( ! wp_verify_nonce( $nonce, plugin_basename( __FILE__ ) ) ) {
			return $post_id;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

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

// Adds slide image and link to slides column view
function flexslider_admin_edit_columns( $meteor_columns ) {
	$meteor_columns = array(
		'cb'         => '<input type="checkbox" />',
		'slide'      => esc_html__( 'Slide Image', 'meteor-slides' ),
		'title'      => esc_html__( 'Slide Title', 'meteor-slides' ),
		'slide-link' => esc_html__( 'Slide Link', 'meteor-slides' ),
		'date'       => esc_html__( 'Date', 'meteor-slides' ),
	);

	return $meteor_columns;
}
add_filter( 'manage_edit-fsa-slide_columns', 'flexslider_admin_edit_columns' );

function flexslider_admin_custom_columns( $meteor_column ) {
	global $post;

	switch ( $meteor_column ) {
		case 'slide':
			echo the_post_thumbnail( 'featured-slide-thumb' );
			break;
		case 'slide-link':
			if ( '' !== get_post_meta( $post->ID, 'slide_url_value', true ) ) {
				echo "<a href='" . esc_url( get_post_meta( $post->ID, 'slide_url_value', true ) ) . "'>" . esc_html( get_post_meta( $post->ID, 'slide_url_value', true ) ) . '</a>';
			} else {
				esc_html_e( 'No Link', 'meteor-slides' );
			}
			break;
	}
}
add_action( 'manage_posts_custom_column', 'flexslider_admin_custom_columns' );
