<?php
/**
 * Booster Core for WooCommerce - Settings - Wishlist
 *
 * @version 1.0.0
 * @author  Pluggabl LLC.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$settings                    = array();
$single_or_archive_array     = array( 'archive', 'single' );

foreach ( $single_or_archive_array as $single_or_archive ) {

	$single_or_archive_desc = ( 'archive' === $single_or_archive ? __( 'Archives (Products Loop)', 'woocommerce-jetpack' ) : __( 'Single Product Pages', 'woocommerce-jetpack' ) );
	
	$settings = array_merge( $settings, array(
		array(
			'title'    => $single_or_archive_desc,
			'type'     => 'title',
			'id'       => 'wcj_wishlist_options_'.$single_or_archive,
		),
		array(
			'title'    => __( 'Enable/Disable', 'woocommerce-jetpack' ),
			'desc'     => __( 'Enable', 'woocommerce-jetpack' ),
			'id'       => 'wcj_wishlist_enabled_'.$single_or_archive,
			'default'  => 'yes',
			'type'     => 'checkbox',
		),
		array(
			'title'    => __( 'Title', 'woocommerce-jetpack' ),
			'id'       => 'wcj_wishlist_title_'.$single_or_archive,
			'default'  => __( 'Add to wishlist', 'woocommerce-jetpack' ),
			'type'     => 'text',
		),
		array(
			'title'    => __( 'Style', 'woocommerce-jetpack' ),
			'id'       => 'wcj_wishlist_style_'.$single_or_archive,
			'default'  => 'text',
			'type'     => 'select',
			'options'  => array(
				'text'   => __( 'Text(link)', 'woocommerce-jetpack' ),
				'button' => __( 'Button', 'woocommerce-jetpack' ),
			),
		),
		/*array(
			'title'    => __( 'Message After Successfully Added to Wishlist', 'woocommerce-jetpack' ),
			'id'       => 'wcj_wishlist_title_'.$single_or_archive,
			'default'  => __( 'Add to wishlist', 'woocommerce-jetpack' ),
			'type'     => 'text',
		),*/
        array(
			'title'    => __( 'Position', 'woocommerce-jetpack' ),
			'id'       => 'wcj_wishlist_hook_'.$single_or_archive,
			'default'  => ( 'single' === $single_or_archive ) ? 'woocommerce_after_add_to_cart_button' : 'woocommerce_after_shop_loop_item',
			'type'     => 'select',
			'options'  => array_merge( ( 'single' === $single_or_archive ?
				array(
					'woocommerce_after_add_to_cart_button'      => __( 'After add to cart button', 'woocommerce-jetpack' ),
					'woocommerce_before_add_to_cart_button'     => __( 'Before add to cart button', 'woocommerce-jetpack' ),
					'woocommerce_after_add_to_cart_form'        => __( 'After add to cart form', 'woocommerce-jetpack' ),
					'woocommerce_before_add_to_cart_form'       => __( 'Before add to cart form', 'woocommerce-jetpack' ),
					'woocommerce_before_single_product_summary' => __( 'Before single product summary', 'woocommerce-jetpack' ),
					'woocommerce_single_product_summary'        => __( 'Inside single product summary', 'woocommerce-jetpack' ),
					'woocommerce_after_single_product_summary'  => __( 'After single product summary', 'woocommerce-jetpack' ),
				) :
				array(
					'woocommerce_after_shop_loop_item'      => __( 'After add to cart button', 'woocommerce-jetpack' ),
					'woocommerce_after_shop_loop_item'     => __( 'Before add to cart button', 'woocommerce-jetpack' ),
					'woocommerce_shop_loop_item_title'       => __( 'Before product title', 'woocommerce-jetpack' ),
					'woocommerce_after_shop_loop_item_title'        => __( 'After product title', 'woocommerce-jetpack' ),
				) ) ),
		),
		array(
			'title'    => __( 'Position Order (i.e. Priority)', 'woocommerce-jetpack' ),
			'id'       => 'wcj_wishlist_priority_'.$single_or_archive,
			'default'  => 15,
			'type'     => 'number',
		),
		array(
			'type'     => 'sectionend',
			'id'       => 'wcj_wishlist_options_'.$single_or_archive,
		),
	) );
}

$settings = array_merge( $settings, array(
		array(
			'title'    => "Wishlist Page",
			'type'     => 'title',
			'id'       => 'wcj_wishlist_general_options',
		),
		array(
			'desc'    => "Create page and this shortcode [wcj_wishlist] for display wishlist",
			'type'     => 'title',
			'id'       => 'wcj_wishlist_shortcode',
		),
		array(
			'title'    => __( 'Enter wishlist page URL', 'woocommerce-jetpack' ),
			'id'       => 'wcj_wishlist_page_url',
			'default'  => '',
			'type'     => 'text',
		),
		array(
			'type'     => 'sectionend',
			'id'       => 'wcj_wishlist_general_options',
		),
	) );

return $settings;