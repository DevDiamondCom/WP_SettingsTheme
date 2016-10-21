<?php
/**
 * Functions
 *
 * @author   DevDiamond <me@devdiamond.com>
 * @package  WP_ThemeSettings
 * @version  1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main instance of WP_ThemeSettings.
 *
 * @return WP_ThemeSettings
 */
function WPTS()
{
	return WP_ThemeSettings::instance();
}

/**
 * Get option from WP_ThemeSettings Settings
 *
 * @param  string $option_slug  - Option slug
 * @param  string $option_name  - Option name
 * @param  bool   $default      - Default options
 *
 * @return mixed
 */
function wpts_get_option( $option_slug, $option_name = null, $default = false )
{
	return WPTS()->get_option( $option_slug, $option_name, $default );
}