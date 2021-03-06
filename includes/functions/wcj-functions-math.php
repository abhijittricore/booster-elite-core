<?php
/**
 * Booster Core for WooCommerce - Functions - Math
 *
 * @version 1.0.0
 * @since  1.0.0
 * @author  Pluggabl LLC.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'wcj_round' ) ) {
	/**
	 * wcj_round.
	 *
	 * @version 1.0.0
	 * @since  1.0.0
	 */
	function wcj_round( $value, $precision = 0, $rounding_function = 'round' ) {
		return $rounding_function( $value, $precision );
	}
}

if ( ! function_exists( 'wcj_ceil' ) ) {
	/**
	 * wcj_ceil.
	 *
	 * @version 1.0.0
	 * @since  1.0.0
	 */
	function wcj_ceil( $value, $precision = 0 ) {
		$fig = ( int ) str_pad( '1', $precision + 1, '0' );
		return ( ceil( $value * $fig ) / $fig );
	}
}

if ( ! function_exists( 'wcj_floor' ) ) {
	/**
	 * wcj_floor.
	 *
	 * @version 1.0.0
	 * @since  1.0.0
	 */
	function wcj_floor( $value, $precision = 0 ) {
		$fig = ( int ) str_pad( '1', $precision + 1, '0' );
		return ( floor( $value * $fig ) / $fig );
	}
}
