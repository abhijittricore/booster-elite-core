<?php
/**
 * Booster Core for WooCommerce - Settings - Product Variation Swatches
 *
 * @version 1.0.2
 * @author  Pluggabl LLC.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$settings = array(
    array(
        'title'    => __( 'Variation Swatches', 'woocommerce-jetpack' ),
        'type'     => 'title',
        'id'       => 'wcj_product_variation_swatches_general_options',
    ),
    array(
        'title'    => __( 'Convert default dropdowns to button', 'woocommerce-jetpack' ),
        'desc'     => __( 'Enable', 'woocommerce-jetpack' ),
            apply_filters( 'booster_message', '', 'desc' ),
        'type'     => 'checkbox',
        'id'       => 'wcj_product_variation_defualt_to_button',
        'default'  => 'yes',
    ),
    array(
        'title'    => __( 'Attribute Display Style', 'woocommerce-jetpack' ),
        'id'       => "wcj_product_pvs_attr_display_style",
        'default'  => ' Squared',
        'desc'=>apply_filters( 'booster_message', '', 'desc' ),
		'custom_attributes' => apply_filters( 'booster_message', '', 'disabled' ),
        'type'     => 'select',
        'options'  => array(
            'squared' => __( 'Squared', 'woocommerce-jetpack' ),
            'rounded'   => __( 'Rounded', 'woocommerce-jetpack' ),
        ),
    ),
    array(
        'title'    => __( 'Color Variation Item Width', 'woocommerce-jetpack' ),
        'id'       => 'wcj_product_color_variation_item_width',
        'default'  => "30px",
        'type'     => 'text',
        'desc'=>apply_filters( 'booster_message', '', 'desc' ),
		'custom_attributes' => apply_filters( 'booster_message', '', 'disabled' ),
    ),
    array(
        'title'    => __( 'Color Variation Item Height', 'woocommerce-jetpack' ),
        'id'       => 'wcj_product_color_variation_item_height',
        'default'  => "30px",
        'type'     => 'text',
    ),
    array(
        'title'    => __( 'Image Variation Item Width', 'woocommerce-jetpack' ),
        'id'       => 'wcj_product_image_variation_item_width',
        'default'  => "30px",
        'type'     => 'text',
    ),
    array(
        'title'    => __( 'Image Variation Item Height', 'woocommerce-jetpack' ),
        'id'       => 'wcj_product_image_variation_item_height',
        'default'  => "30px",
        'type'     => 'text',
    ),
    array(
        'title'    => __( 'Button Variation Item Width', 'woocommerce-jetpack' ),
        'id'       => 'wcj_product_button_variation_item_width',
        'default'  => "auto",
        'type'     => 'text',
    ),
    array(
        'title'    => __( 'Button Variation Item Height', 'woocommerce-jetpack' ),
        'id'       => 'wcj_product_button_variation_item_height',
        'default'  => "auto",
        'type'     => 'text',
        'desc'=>apply_filters( 'booster_message', '', 'desc' ),
		'custom_attributes' => apply_filters( 'booster_message', '', 'disabled' ),
    ),
    array(
        'type'     => 'sectionend',
        'id'       => 'wcj_product_variation_swatches_general_options',
    ),
);

return $settings;