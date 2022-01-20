<?php
/**
 * Booster Core for WooCommerce - PDF Invoicing - Paid Stamp
 *
 * @version 1.0.0
 * @author  Pluggabl LLC.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'WCJ_PDF_Invoicing_Paid_stamp' ) ) :

class WCJ_PDF_Invoicing_Paid_stamp extends WCJ_Module {

	/**
	 * Constructor.
	 *
	 * @version 1.0.0
	 */
	function __construct() { 

		$this->id         = 'pdf_invoicing_paid_stamp';
		$this->parent_id  = 'pdf_invoicing';
		$this->short_desc = __( 'Paid Stamp', 'woocommerce-jetpack' );
		$this->desc       = '';
		parent::__construct( 'submodule' );
	}

}

endif;

return new WCJ_PDF_Invoicing_Paid_stamp();