<?php
/*
Plugin Name: Booster Core for WooCommerce
Plugin URI: https://booster.io
Description: Supercharge your WooCommerce site with these awesome powerful features. More than 100 modules. All in one WooCommerce plugin.
Version: 1.0.3
Author: Pluggabl LLC
Author URI: https://booster.io
Text Domain: woocommerce-jetpack
Domain Path: /langs
Copyright: © 2020 Pluggabl LLC.
WC tested up to: 6.0.0
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

// Core functions
require_once('includes/functions/wcj-functions-core.php');

// Check if WooCommerce is active
if (!wcj_is_plugin_activated('woocommerce', 'woocommerce.php')) {
	return;
}

// Check if Plus is active
if ('woocommerce-jetpack.php' === basename(__FILE__) && wcj_is_plugin_activated('booster-core-for-woocommerce', 'booster-core-for-woocommerce.php')) {
	return;
}

if (!defined('WCJ_PLUGIN_FILE')) {
	/**
	 * WCJ_PLUGIN_FILE.
	 *
	 * @since 3.2.4
	 */
	define('WCJ_PLUGIN_FILE', __FILE__);
}

if (!class_exists('Booster_Core')) :

	/**
	 * Main Booster_Core Class
	 *
	 * @class   Booster_Core
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	final class Booster_Core
	{

		/**
		 * Booster Core for WooCommerce version.
		 *
		 * @var   string
		 * @since 2.4.7
		 */
		public $version = '1.0.0';

		/**
		 * @var Booster_Core The single instance of the class
		 */
		protected static $_instance = null;

		/**
		 * @version 1.0.0
		 * @since   1.0.0
		 *
		 * @var array
		 */
		public $options = array();

		/**
		 * Main Booster_Core Instance.
		 *
		 * Ensures only one instance of Booster_Core is loaded or can be loaded.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 * @static
		 * @see    WCJ()
		 * @return Booster_Core - Main instance
		 */
		public static function instance()
		{
			if (is_null(self::$_instance)) {
					
				self::$_instance = new self();
			}
			add_option('wcj_addon_package_name',"level_elite");
			add_option('wcj_active_addon_list',"");
			return self::$_instance;
		}

		/**
		 * Booster_Core Constructor.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 * @access  public
		 */
		function __construct()
		{
			require_once('includes/core/wcj-loader.php');
		}
	}

endif;

if (!function_exists('WCJ')) {
	/**
	 * Returns the main instance of Booster_Core to prevent the need to use globals.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @return  Booster_Core
	 */
	function WCJ()
	{
		return Booster_Core::instance();
	}
}
register_deactivation_hook( __FILE__, 'my_plugin_remove_database' );

function my_plugin_remove_database(){
	
	delete_option("wcj_addon_package_name");
}


WCJ();