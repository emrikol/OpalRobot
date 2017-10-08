<?php

function opalrobot_create_default_menus() {

	if ( ! wp_get_nav_menu_object( 'Secondary Navigation [Theme Default]' ) ) {
		$menu_id = wp_create_nav_menu( 'Secondary Navigation [Theme Default]' );
		if ( ! is_wp_error( $menu_id ) ) {
			$locations = get_theme_mod( 'nav_menu_locations' );
			$locations['menu-2'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );

			$menu_item_data = array(
				'menu-item-title' => 'Events', // Title
				'menu-item-name' => 'events', // Slug
				'menu-item-url' => '/events', // URL
				'menu-item-status' => 'publish',
			);
			wp_update_nav_menu_item( $menu_id, 0, $menu_item_data );

			$menu_item_data = array(
				'menu-item-title' => 'Connect', // Title
				'menu-item-name' => 'connect', // Slug
				'menu-item-url' => '/connect', // URL
				'menu-item-status' => 'publish',
			);
			wp_update_nav_menu_item( $menu_id, 0, $menu_item_data );

			$menu_item_data = array(
				'menu-item-title' => 'Livestream', // Title
				'menu-item-name' => 'livestream', // Slug
				'menu-item-url' => '/livestream', // URL
				'menu-item-status' => 'publish',
			);
			wp_update_nav_menu_item( $menu_id, 0, $menu_item_data );

			$menu_item_data = array(
				'menu-item-title' => 'Archive', // Title
				'menu-item-name' => 'archive', // Slug
				'menu-item-url' => '/archive', // URL
				'menu-item-status' => 'publish',
			);
			wp_update_nav_menu_item( $menu_id, 0, $menu_item_data );

		}
	}

}

add_action( 'wp_loaded', 'opalrobot_create_default_menus' );

class OpalRobot_Default_Secondary_Walker extends Walker {

	var $db_fields = array(
		'parent' => 'menu_item_parent',
		'id' => 'db_id',
	);

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$output .= sprintf( "\n<div class='col-6 col-md-3 col-lg-12'><a href='%s' class='%s'>%s</a></div>\n",
			esc_url( $item->url ),
			( get_the_ID() === $item->object_id ) ? 'current' : '',
			esc_html( $item->title )
		);
	}

}
