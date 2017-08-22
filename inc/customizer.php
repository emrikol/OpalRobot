<?php
add_action( "customize_register", "ruth_sherman_theme_customize_register" );
function ruth_sherman_theme_customize_register( $wp_customize ) {

	//=============================================================
	// Remove header image and widgets option from theme customizer
	//=============================================================
	$wp_customize->remove_control("header_image");
	$wp_customize->remove_panel("widgets");

	//=============================================================
	// Remove Colors, Background image, and Static front page 
	// option from theme customizer     
	//=============================================================
	$wp_customize->remove_section("colors");
	$wp_customize->remove_section("background_image");
	$wp_customize->remove_section("static_front_page");

}

function m1_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'custom_logo_desktop' ); // Add setting for logo uploader
         
    // Add control for logo uploader (actual uploader)
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_logo_desktop', array(
        'label'    => esc_html__( 'Desktop Logo', 'opalrobot' ),
        'section'  => 'title_tagline',
        'settings' => 'custom_logo_desktop',
    ) ) );
}
add_action( 'customize_register', 'm1_customize_register' );