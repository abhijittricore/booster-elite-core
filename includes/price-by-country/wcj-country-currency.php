<?php
/**
 * Booster Core for WooCommerce Country Currency functions
 *
 * @version 1.0.0
 * @author  Pluggabl LLC.
 * @todo    maybe move this to `functions` folder
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'wcj_get_paypal_supported_currencies' ) ) {
	/**
	 * wcj_get_paypal_supported_currencies.
	 *
	 * @version 1.0.0
	 */
	function wcj_get_paypal_supported_currencies() {
		return array(
			'AUD',
			'BRL',
			'CAD',
			'CHF',
			'CZK',
			'DKK',
			'EUR',
			'GBP',
			'HKD',
			'HUF',
			'ILS',
			'JPY',
			'MYR',
			'MXN',
			'NOK',
			'NZD',
			'PHP',
			'PLN',
			'RUB',
			'SEK',
			'SGD',
			'THB',
			'TRY',
			'TWD',
			'USD',
		);
	}
}

if ( ! function_exists( 'wcj_get_country_currency' ) ) {
	/**
	 * wcj_get_country_currency.
	 *
	 * @version 1.0.0
	 */
	function wcj_get_country_currency() {
		return array(
			'ZW' => 'ZAR',
			'BT' => 'BTN',
			'BN' => 'BND',
			'KH' => 'KHR',
			'CU' => 'CUP',
			'IM' => 'GBP',
			'JE' => 'JEP',
			'LS' => 'LSL',
			'NA' => 'NAD',
			'PS' => 'JOD',
			'PA' => 'PAB',
			'SG' => 'SGD',
			'UA' => 'UAH',
			'AF' => 'AFN',
			'AL' => 'ALL',
			'DZ' => 'DZD',
			'AD' => 'EUR',
			'AO' => 'AOA',
			'AI' => 'XCD',
			'AG' => 'XCD',
			'AR' => 'ARS',
			'AM' => 'AMD',
			'AW' => 'AWG',
			'AU' => 'AUD',
			'AT' => 'EUR',
			'AZ' => 'AZN',
			'BS' => 'BSD',
			'BH' => 'BHD',
			'BD' => 'BDT',
			'BB' => 'BBD',
			'BY' => 'BYN',
			'BE' => 'EUR',
			'BZ' => 'BZD',
			'BJ' => 'XOF',
			'BM' => 'BMD',
			'BO' => 'BOB',
			'BQ' => 'USD',
			'BA' => 'BAM',
			'BW' => 'BWP',
			'BR' => 'BRL',
			'IO' => 'USD',
			'VG' => 'USD',
			'BG' => 'BGN',
			'BF' => 'XOF',
			'BI' => 'BIF',
			'KY' => 'KYD',
			'CM' => 'XAF',
			'CA' => 'CAD',
			'CV' => 'CVE',
			'CF' => 'XAF',
			'TD' => 'XAF',
			'CL' => 'CLP',
			'CN' => 'CNY',
			'CY' => 'EUR',
			'CC' => 'AUD',
			'CO' => 'COP',
			'KM' => 'KMF',
			'CG' => 'CDF',
			'CK' => 'NZD',
			'CR' => 'CRC',
			'CI' => 'XOF',
			'HR' => 'HRK',
			'CW' => 'ANG',
			'CZ' => 'CZK',
			'DK' => 'DKK',
			'DJ' => 'DJF',
			'DM' => 'XCD',
			'DO' => 'DOP',
			'TP' => 'USD',
			'EC' => 'USD',
			'EG' => 'EGP',
			'SV' => 'USD',
			'GQ' => 'XAF',
			'ER' => 'ERN',
			'EE' => 'EUR',
			'ET' => 'ETB',
			'FK' => 'FKP',
			'FO' => 'DKK',
			'FJ' => 'FJD',
			'FI' => 'EUR',
			'FR' => 'EUR',
			'PF' => 'XPF',
			'GA' => 'XAF',
			'GM' => 'GMD',
			'GE' => 'GEL',
			'DE' => 'EUR',
			'GH' => 'GHS',
			'GI' => 'GIP',
			'GR' => 'EUR',
			'GD' => 'XCD',
			'GT' => 'GTQ',
			'GG' => 'GBP',
			'GY' => 'GYD',
			'GN' => 'GNF',
			'GW' => 'XOF',
			'HT' => 'HTG',
			'HN' => 'HNL',
			'HK' => 'HKD',
			'HU' => 'HUF',
			'IS' => 'ISK',
			'YE' => 'YER',
			'IN' => 'INR',
			'ID' => 'IDR',
			'IR' => 'IRR',
			'IQ' => 'IQD',
			'IE' => 'EUR',
			'IL' => 'ILS',
			'IT' => 'EUR',
			'JM' => 'JMD',
			'JP' => 'JPY',
			'JO' => 'JOD',
			'KZ' => 'KZT',
			'KE' => 'KES',
			'KG' => 'KGS',
			'KI' => 'AUD',
			'KP' => 'KPW',
			'KR' => 'KRW',
			'XK' => 'EUR',
			'KW' => 'KWD',
			'LA' => 'LAK',
			'LV' => 'EUR',
			'LB' => 'LBP',
			'LR' => 'LRD',
			'LY' => 'LYD',
			'LI' => 'CHF',
			'LT' => 'EUR',
			'LU' => 'EUR',
			'MO' => 'MOP',
			'MK' => 'MKD',
			'MG' => 'MGA',
			'MY' => 'MYR',
			'MW' => 'MWK',
			'MV' => 'MVR',
			'ML' => 'XOF',
			'MT' => 'EUR',
			'MH' => 'USD',
			'MR' => 'MRO',
			'MU' => 'MUR',
			'MX' => 'MXN',
			'MM' => 'MMK',
			'FM' => 'USD',
			'MD' => 'MDL',
			'MC' => 'EUR',
			'MN' => 'MNT',
			'ME' => 'EUR',
			'MS' => 'XCD',
			'MA' => 'MAD',
			'MZ' => 'MZN',
			'NR' => 'AUD',
			'NP' => 'NPR',
			'NL' => 'EUR',
			'NC' => 'XPF',
			'NZ' => 'NZD',
			'NI' => 'NIO',
			'NE' => 'XOF',
			'NG' => 'NGN',
			'NU' => 'NZD',
			'NO' => 'NOK',
			'OM' => 'OMR',
			'PK' => 'PKR',
			'PW' => 'USD',
			'PG' => 'PGK',
			'PY' => 'PYG',
			'PE' => 'PEN',
			'PH' => 'PHP',
			'PN' => 'NZD',
			'PL' => 'PLN',
			'PT' => 'EUR',
			'QA' => 'QAR',
			'RO' => 'RON',
			'RU' => 'RUB',
			'RW' => 'RWF',
			'SH' => 'SHP',
			'KN' => 'XCD',
			'LC' => 'XCD',
			'VC' => 'XCD',
			'WS' => 'WST',
			'SM' => 'EUR',
			'ST' => 'STD',
			'SA' => 'SAR',
			'SC' => 'SCR',
			'SN' => 'XOF',
			'RS' => 'RSD',
			'SL' => 'SLL',
			'SX' => 'ANG',
			'SY' => 'SYP',
			'SK' => 'EUR',
			'SI' => 'EUR',
			'SB' => 'SBD',
			'SO' => 'SOS',
			'ZA' => 'ZAR',
			'GS' => 'GBP',
			'SS' => 'SSP',
			'ES' => 'EUR',
			'LK' => 'LKR',
			'SD' => 'SDG',
			'SR' => 'SRD',
			'SZ' => 'SZL',
			'SE' => 'SEK',
			'CH' => 'CHF',
			'TW' => 'TWD',
			'TJ' => 'TJS',
			'TZ' => 'TZS',
			'TH' => 'THB',
			'TG' => 'XOF',
			'TO' => 'TOP',
			'TT' => 'TTD',
			'SH' => 'SHP',
			'TN' => 'TND',
			'TR' => 'TRY',
			'TM' => 'TMT',
			'TC' => 'USD',
			'TV' => 'AUD',
			'UG' => 'UGX',
			'AE' => 'AED',
			'GB' => 'GBP',
			'US' => 'USD',
			'UY' => 'UYU',
			'UZ' => 'UZS',
			'VU' => 'VUV',
			'VA' => 'EUR',
			'VE' => 'VEF',
			'VN' => 'VND',
			'WF' => 'XPF',
			'ZM' => 'ZMW',
		);
	}
}
