<?php
class OpalRobot_Default_Secondary_Walker extends Walker {

	var $db_fields = array(
		'parent' => 'menu_item_parent',
		'id'     => 'db_id',
	);

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$output .= sprintf( "\n<div class='col-6 col-md-3 col-lg-12'><a href='%s' style='%s' class='%s'>%s</a></div>\n",
			esc_url( $item->url ),
			wp_kses_post( get_theme_mod( 'l_image_1_media' ) ? 'background-image: url( ' . esc_url( get_theme_mod( 'secondary_link_media' ) ) . ' );' : '' ),
			( get_the_ID() === $item->object_id ) ? 'current' : '',
			esc_html( $item->title )
		);
	}

}
