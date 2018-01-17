<?php
/**
 * Main file for Flexslider_Admin_Customizer class.
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The child class for managing Flexslider Admin customizer settings.
 */
class Flexslider_Admin_Customizer extends Flexslider_Admin {
	/**
	 * Primary Flexslider Admin customizer settings constructor.
	 *
	 * Sets up WordPress hooks.
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'customize_register' ) );
	}

	/**
	 * Registers Flexslider Admin settings in the customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize WP_Customize_Manager instance.
	 *
	 * @return void
	 */
	public function customize_register( $wp_customize ) {
		$wp_customize->add_section( 'fsa-slides', array(
			'title' => esc_html__( 'Slider', 'flexslider-admin' ),
		) );

		// Animation Type.
		$wp_customize->add_setting( 'fsa-slides_animation', array(
			'sanitize_callback' => 'sanitize_key',
			'default'           => 'fade',
		) );

		$wp_customize->add_control( 'fsa-slides_animation', array(
			'type'    => 'select',
			'section' => 'fsa-slides',
			'label'   => esc_html__( 'Animation Type' ),
			'choices' => array(
				'fade'  => esc_html__( 'Fade', 'flexslider-admin' ),
				'slide' => esc_html__( 'Slide', 'flexslider-admin' ),
			),
		) );

		// Easing.
		$wp_customize->add_setting( 'fsa-slides_easing', array(
			'sanitize_callback' => 'sanitize_key',
			'default'           => 'swing',
		) );

		$wp_customize->add_control( 'fsa-slides_easing', array(
			'type'        => 'select',
			'section'     => 'fsa-slides',
			'label'       => esc_html__( 'Easing Animation' ),
			'description' => esc_html__( 'Easing specifies the speed at which the animation progresses at different points within the animation.', 'flexslider-admin' ),
			'choices'     => array(
				'swing'  => esc_html__( 'Swing', 'flexslider-admin' ),
				'linear' => esc_html__( 'Linear', 'flexslider-admin' ),
			),
		) );

		// Direction.
		$wp_customize->add_setting( 'fsa-slides_direction', array(
			'sanitize_callback' => 'sanitize_key',
			'default'           => 'horizontal',
		) );

		$wp_customize->add_control( 'fsa-slides_direction', array(
			'type'    => 'select',
			'section' => 'fsa-slides',
			'label'   => esc_html__( 'Animation Direction', 'flexslider-admin' ),
			'choices' => array(
				'horizontal' => esc_html__( 'Horizontal', 'flexslider-admin' ),
				'vertical'   => esc_html__( 'Vertical', 'flexslider-admin' ),
			),
		) );

		// Slide Speed.
		$wp_customize->add_setting( 'fsa-slides_speed', array(
			'default' => 7,
		) );

		$wp_customize->add_control( 'fsa-slides_speed', array(
			'type'        => 'number',
			'section'     => 'fsa-slides',
			'label'       => esc_html__( 'Slideshow Speed', 'flexslider-admin' ),
			'description' => esc_html__( 'Set the speed of the slideshow cycling, in seconds.', 'flexslider-admin' ),
			'input_attrs' => array(
				'min'  => 0.1,
				'max'  => 60,
				'step' => 0.1,
			),
		) );

		// Animation Speed.
		$wp_customize->add_setting( 'fsa-slides_animation_speed', array(
			'default' => .6,
		) );

		$wp_customize->add_control( 'fsa-slides_animation_speed', array(
			'type'        => 'number',
			'section'     => 'fsa-slides',
			'label'       => esc_html__( 'Animation Speed', 'flexslider-admin' ),
			'description' => esc_html__( 'Set the speed of animations, in seconds.', 'flexslider-admin' ),
			'input_attrs' => array(
				'min'  => 0.1,
				'max'  => 10,
				'step' => 0.1,
			),
		) );

		// Start Delay.
		$wp_customize->add_setting( 'fsa-slides_start_delay', array(
			'default' => 0,
		) );

		$wp_customize->add_control( 'fsa-slides_start_delay', array(
			'type'        => 'number',
			'section'     => 'fsa-slides',
			'label'       => esc_html__( 'Start Delay', 'flexslider-admin' ),
			'description' => esc_html__( 'Set an initialization delay, in seconds.', 'flexslider-admin' ),
			'input_attrs' => array(
				'min'  => 0.1,
				'max'  => 60,
				'step' => 0.1,
			),
		) );

		// Reverse.
		$wp_customize->add_setting( 'fsa-slides_reverse', array(
			'default' => false,
		) );

		$wp_customize->add_control( 'fsa-slides_reverse', array(
			'type'    => 'checkbox',
			'section' => 'fsa-slides',
			'label'   => esc_html__( 'Reverse the animation direction', 'flexslider-admin' ),
		) );

		// Randomize Slides.
		$wp_customize->add_setting( 'fsa-slides_randomize', array(
			'default' => false,
		) );

		$wp_customize->add_control( 'fsa-slides_randomize', array(
			'type'    => 'checkbox',
			'section' => 'fsa-slides',
			'label'   => esc_html__( 'Randomize slide order', 'flexslider-admin' ),
		) );

		// Pause on Interaction.
		$wp_customize->add_setting( 'fsa-slides_pause_interaction', array(
			'default' => true,
		) );

		$wp_customize->add_control( 'fsa-slides_pause_interaction', array(
			'type'        => 'checkbox',
			'section'     => 'fsa-slides',
			'label'       => esc_html__( 'Pause on Interaction', 'flexslider-admin' ),
			'description' => esc_html__( 'Pause the slideshow when interacting with control elements, highly recommended.', 'flexslider-admin' ),
		) );

		// Pause on Hover.
		$wp_customize->add_setting( 'fsa-slides_pause_hover', array(
			'default' => false,
		) );

		$wp_customize->add_control( 'fsa-slides_pause_hover', array(
			'type'        => 'checkbox',
			'section'     => 'fsa-slides',
			'label'       => esc_html__( 'Pause on Hover', 'flexslider-admin' ),
			'description' => esc_html__( 'Pause the slideshow when hovering over slider, then resume when no longer hovering.', 'flexslider-admin' ),
		) );

	}
}
