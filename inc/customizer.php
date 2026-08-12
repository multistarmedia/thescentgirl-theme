<?php
/**
 * Theme Customizer — consultant + catalog settings.
 *
 * @package The_Scent_Girl
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer.
 */
function tsg_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'tsg_brand',
		array(
			'title'    => __( 'The Scent Girl', 'the-scent-girl' ),
			'priority' => 30,
		)
	);

	$fields = array(
		'consultant_name'       => __( 'Consultant name', 'the-scent-girl' ),
		'consultant_title'      => __( 'Consultant title', 'the-scent-girl' ),
		'consultant_photo'      => __( 'Consultant photo URL', 'the-scent-girl' ),
		'logo_url'              => __( 'Logo URL (dark)', 'the-scent-girl' ),
		'logo_white_url'        => __( 'Logo URL (white)', 'the-scent-girl' ),
		'logo_tagline'          => __( 'Logo tagline', 'the-scent-girl' ),
		'primary_category_slug' => __( 'Primary product category slug', 'the-scent-girl' ),
		'coupon_label'          => __( 'Floating coupon label', 'the-scent-girl' ),
		'club_heading'          => __( 'Club banner text', 'the-scent-girl' ),
		'club_button'           => __( 'Club button label', 'the-scent-girl' ),
		'club_url'              => __( 'Club URL (optional override)', 'the-scent-girl' ),
		'external_handoff_url'  => __( 'External shop handoff URL', 'the-scent-girl' ),
	);

	$defaults = tsg_default_options();

	foreach ( $fields as $key => $label ) {
		$setting = 'tsg_' . $key;
		$wp_customize->add_setting(
			$setting,
			array(
				'default'           => $defaults[ $key ] ?? '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			$setting,
			array(
				'label'   => $label,
				'section' => 'tsg_brand',
				'type'    => false !== strpos( $key, 'heading' ) ? 'textarea' : 'text',
			)
		);
	}
}
add_action( 'customize_register', 'tsg_customize_register' );
