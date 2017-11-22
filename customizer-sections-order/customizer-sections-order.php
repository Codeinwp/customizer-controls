<?php
/**
 * Customizer sections order main file
 *
 * @package customizer-controls
 */

define( 'SECTIONS_ORDER_VERSION', '1.0.0' );

/**
 * Function to enqueue sections order main script.
 */
function sections_order_script() {
	wp_enqueue_script( 'customizer-sections-order-script', get_template_directory_uri() . '/customizer-sections-order/js/customizer-sections-order.js', array( 'jquery', 'jquery-ui-sortable' ), SECTIONS_ORDER_VERSION, true );
	$control_settings = array(
		'sections_container' => '#accordion-panel-your_panel_name > ul, #sub-accordion-panel-your_panel_name', // Edit this
		'blocked_items'      => '#accordion-section-blocked_section1, #accordion-section-blocked_section2, #accordion-section-blocked_section3', // Edit this
		'saved_data_input'   => '#customize-control-sections_order input', // Edit this
	);
	wp_localize_script( 'customizer-sections-order-script', 'control_settings', $control_settings );
	wp_enqueue_style( 'customizer-sections-order-style', get_template_directory_uri() . '/customizer-sections-order/css/customizer-sections-order-style.css', array( 'dashicons' ), SECTIONS_ORDER_VERSION );
}
add_action( 'customize_controls_enqueue_scripts', 'sections_order_script' );


/**
 * Register input for sections order.
 *
 * @param object $wp_customize Customizer object.
 */
function sections_order_register_control( $wp_customize ) {

	$wp_customize->add_setting(
		'sections_order', array(
			'sanitize_callback' => 'sanitize_sections_order',
		)
	);

	$wp_customize->add_control(
		'sections_order', array( // Edit this
			'section'  => 'your_section_name', // Edit this
			'type'     => 'hidden',
			'priority' => 80,
		)
	);

}
add_action( 'customize_register', 'sections_order_register_control' );


/**
 * Function for returning section priority
 *
 * @param int    $value Default priority.
 * @param string $key Section id.
 *
 * @return int
 */
function sections_order_section_priority( $value, $key = '' ) {
	$orders = get_theme_mod( 'sections_order' );
	if ( ! empty( $orders ) ) {
		$json = json_decode( $orders );
		if ( isset( $json->$key ) ) {
			return $json->$key;
		}
	}

	return $value;
}
add_filter( 'section_priority', 'sections_order_section_priority', 10, 2 );


/**
 * Function to refresh customize preview when changing sections order
 */
function sections_order_refresh_positions() {
	$section_order         = get_theme_mod( 'sections_order' ); // Edit this
	$section_order_decoded = json_decode( $section_order, true );
	if ( ! empty( $section_order_decoded ) ) {
		remove_all_actions( 'theme_sections' );
		foreach ( $section_order_decoded as $k => $priority ) {
			if ( function_exists( $k ) ) {
				add_action( 'theme_sections', $k, $priority );
			}
		}
	}
}
add_action( 'customize_preview_init', 'sections_order_refresh_positions', 1 );

/**
 * Function to sanitize sections order control
 *
 * @param string $input Sections order in json format.
 */
function sanitize_sections_order( $input ) {

	$json = json_decode( $input, true );
	foreach ( $json as $section => $priority ) {
		if ( ! is_string( $section ) || ! is_int( $priority ) ) {
			return false;
		}
	}
	$filter_empty = array_filter( $json, 'check_not_empty' );
	return json_encode( $filter_empty );
}

/**
 * Function to filter json empty elements.
 *
 * @param int $val Element of json decoded.
 *
 * @return bool
 */
function check_not_empty( $val ) {
	return ! empty( $val );
}
