<?php
/**
 * beka Theme Customizer.
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function beka_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Header Section.
	 */
	$wp_customize->add_section( 'header_section', array(
		'title'    => esc_html__( 'Header', 'beka' ),
		'priority' => 30,
	) );

	// Header text
	$wp_customize->add_setting( 'header_text', array(
		'default'           => 'Welcome to Awesome Blog Design perfect blog',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_filter_post_kses',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_text', array(
		'label'    => esc_html__( 'Header Text', 'beka' ),
		'section'  => 'header_section',
		'settings' => "header_text",
		'type'     => 'textarea',
	) ) );

	// Show Social Button
	$wp_customize->add_setting( 'social_button', array(
		'default'              => '',
		'sanitize_callback'    => 'beka_sanitize_checkbox',
		'sanitize_js_callback' => 'beka_sanitize_checkbox_js',
		'transport'            => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_button', array(
		'label'    => esc_html__( 'Show Social Button', 'beka' ),
		'section'  => 'header_section',
		'settings' => "social_button",
		'type'     => 'checkbox',
	) ) );

	// Facebook
	$wp_customize->add_setting( 'facebook_url', array(
		'default'              => '',
		'sanitize_callback'    => 'esc_url_raw',
		'sanitize_js_callback' => 'esc_url',
		'transport'            => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook_url', array(
		'label'    => esc_html__( 'Facebook URL', 'beka' ),
		'section'  => 'header_section',
		'settings' => "facebook_url",
		'type'     => 'url',
	) ) );

	// twitter
	$wp_customize->add_setting( 'twitter_url', array(
		'default'              => '',
		'sanitize_callback'    => 'esc_url_raw',
		'sanitize_js_callback' => 'esc_url',
		'transport'            => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter_url', array(
		'label'    => esc_html__( 'Twitter URL', 'beka' ),
		'section'  => 'header_section',
		'settings' => "twitter_url",
		'type'     => 'url',
	) ) );

	// Google Plus
	$wp_customize->add_setting( 'gp_url', array(
		'default'              => '',
		'sanitize_callback'    => 'esc_url_raw',
		'sanitize_js_callback' => 'esc_url',
		'transport'            => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gp_url', array(
		'label'    => esc_html__( 'Google Plus URL', 'beka' ),
		'section'  => 'header_section',
		'settings' => "gp_url",
		'type'     => 'url',
	) ) );

	// Instagram
	$wp_customize->add_setting( 'instagram_url', array(
		'default'              => '',
		'sanitize_callback'    => 'esc_url_raw',
		'sanitize_js_callback' => 'esc_url',
		'transport'            => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'instagram_url', array(
			'label'    => esc_html__( 'Instagram URL', 'beka' ),
			'section'  => 'header_section',
			'settings' => "instagram_url",
			'type'     => 'url',
		)
	) );

}

add_action( 'customize_register', 'beka_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function beka_customize_preview_js() {
	wp_enqueue_script( 'beka-customize-preview', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', 'beka_customize_preview_js' );


/**
 * Sanitize Checkbox value for DB,
 *
 * @param $value
 *
 * @return int
 */
function beka_sanitize_checkbox( $value ) {
	$value = (int) $value;

	return ( 1 === $value || true === $value ) ? 1 : 0;
}


/**
 * Output Checkbox value for JS.
 *
 * @param $value
 *
 * @return bool
 */
function beka_sanitize_checkbox_js( $value ) {
	$value = (int) $value;

	return ( 1 === $value || true === $value ) ? true : false;
}
