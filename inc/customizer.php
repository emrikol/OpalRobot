<?php
function opalrobot_remove_default_customizer_options( $wp_customize ) {
	// Remove header image and widgets option from theme customizer.
	$wp_customize->remove_control( 'header_image' );
	$wp_customize->remove_panel( 'widgets' );

	// Remove colors, background image, and static front page option from theme customizer.
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'static_front_page' );
}
add_action( 'customize_register', 'opalrobot_remove_default_customizer_options' );

function opalrobot_secondary_custom_logo( $wp_customize ) {
	$wp_customize->add_setting( 'custom_logo_desktop' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_logo_desktop', array(
		'label'    => esc_html__( 'Desktop Logo', 'opalrobot' ),
		'section'  => 'title_tagline',
		'settings' => 'custom_logo_desktop',
	) ) );
}
add_action( 'customize_register', 'opalrobot_secondary_custom_logo' );

function opalrobot_customizer_theme_settings( $wp_customize ) {
	$wp_customize->add_section( 'opalrobot-theme-settings', array(
		'title' => esc_html__( 'Theme Settings', 'opalrobot' ),
	) );

	// Secondary Link Media.
	$wp_customize->add_setting( 'secondary_link_media' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'secondary_link_media', array(
		'label'    => esc_html__( 'Secondary Link Media', 'opalrobot' ),
		'section'  => 'opalrobot-theme-settings',
		'settings' => 'secondary_link_media',
	) ) );

	// Fallback Slide Media.
	$wp_customize->add_setting( 'backup_slide_media' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'backup_slide_media', array(
		'label'    => esc_html__( 'Backup Slide Media', 'opalrobot' ),
		'section'  => 'fsa-slides',
		'settings' => 'backup_slide_media',
	) ) );

	for ( $i = 1; $i <= 2; $i++ ) {
		// Large Image Link Media.
		$wp_customize->add_setting( sprintf( 'l_image_%d_media', (int) $i ) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, sprintf( 'l_image_%d_media', (int) $i ), array(
			'label'    => esc_html__( sprintf( 'Primary Section %d Image', (int) $i ), 'opalrobot' ),
			'section'  => 'opalrobot-theme-settings',
			'settings' => sprintf( 'l_image_%d_media', (int) $i ),
		) ) );

		// Large Image Link Text.
		$wp_customize->add_setting( sprintf( 'l_image_%d_text', (int) $i ), array(
			'sanitize_callback' => 'esc_html',
		) );

		$wp_customize->add_control( sprintf( 'l_image_%d_text', (int) $i ), array(
			'type'        => 'url',
			'section'     => 'opalrobot-theme-settings',
			'label'       => esc_html__( sprintf( 'Primary Section %d Text', (int) $i ), 'opalrobot' ),
			'input_attrs' => array(
				'placeholder' => esc_attr__( sprintf( 'Visit Example %d', (int) $i ), 'opalrobot' ),
			),
		) );

		// Large Image Link URL.
		$wp_customize->add_setting( sprintf( 'l_image_%d_url', (int) $i ), array(
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( sprintf( 'l_image_%d_url', (int) $i ), array(
			'type'        => 'url',
			'section'     => 'opalrobot-theme-settings',
			'label'       => esc_html__( sprintf( 'Primary Section %d URL', (int) $i ), 'opalrobot' ),
			'input_attrs' => array(
				'placeholder' => esc_attr__( sprintf( 'https://www.example.com/%d', (int) $i ), 'opalrobot' ),
			),
		) );
	}

	// Large Text Area.
	$wp_customize->add_setting( 'l_textarea', array(
		'sanitize_callback' => 'wp_kses_post',
		'default'           => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet tristique erat, ac vehicula lacus. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
	<ul class="leaders">
		<li><span>Lorem ipsum</span><span>123</span></li>
		<li><span>Aliquam tincidunt</span><span>456</span></li>
		<li><span>Vestibulum</span><span>789</span></li>
	</ul>
</div>',
	) );

	$wp_customize->add_control( 'l_textarea', array(
		'type'    => 'textarea',
		'section' => 'opalrobot-theme-settings',
		'label'   => esc_html__( 'Contact Information', 'opalrobot' ),
	) );

	for ( $i = 1; $i <= 4; $i++ ) {
		// Tertiary Link Media.
		$wp_customize->add_setting( sprintf( 't_link_%d_media', (int) $i ) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, sprintf( 't_link_%d_media', (int) $i ), array(
			'label'    => esc_html__( sprintf( 'Tertiary Link %d Image', (int) $i ), 'opalrobot' ),
			'section'  => 'opalrobot-theme-settings',
			'settings' => sprintf( 't_link_%d_media', (int) $i ),
		) ) );

		// Tertiary Link Text.
		$wp_customize->add_setting( sprintf( 't_link_%d_text', (int) $i ), array(
			'sanitize_callback' => 'esc_html',
		) );

		$wp_customize->add_control( sprintf( 't_link_%d_text', (int) $i ), array(
			'type'        => 'url',
			'section'     => 'opalrobot-theme-settings',
			'label'       => esc_html__( sprintf( 'Tertiary Link %d Text', (int) $i ), 'opalrobot' ),
			'input_attrs' => array(
				'placeholder' => esc_attr__( sprintf( 'Example Link %d', (int) $i ), 'opalrobot' ),
			),
		) );

		// Tertiary Link URL.
		$wp_customize->add_setting( sprintf( 't_link_%d_url', (int) $i ), array(
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( sprintf( 't_link_%d_url', (int) $i ), array(
			'type'        => 'url',
			'section'     => 'opalrobot-theme-settings',
			'label'       => esc_html__( sprintf( 'Tertiary Link %d URL', (int) $i ), 'opalrobot' ),
			'input_attrs' => array(
				'placeholder' => esc_attr__( sprintf( 'https://www.example.com/%d', (int) $i ), 'opalrobot' ),
			),
		) );
	}

}
add_action( 'customize_register', 'opalrobot_customizer_theme_settings' );
