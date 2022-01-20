<?php
/**
 * Booster Core for WooCommerce - Settings Meta Box - One Page Checkout
 *
 * @version 1.0.0
 * @author  Pluggabl LLC.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$product_id       = get_the_ID();
$products         = wcj_get_products( array(), 'publish' );
unset( $products[ $product_id  ] );
$options = array(
	array(
		'title'    => __( 'Enable', 'woocommerce-jetpack' ),
		'name'     => 'wcj_product_opc_enabled',
		'default'  => "no",
		'type'     => 'select',
		'options'  => array(
			'no'  => __( 'No', 'woocommerce-jetpack' ),
			'yes' => __( 'Yes', 'woocommerce-jetpack' ),
		),
	),
);
return $options;