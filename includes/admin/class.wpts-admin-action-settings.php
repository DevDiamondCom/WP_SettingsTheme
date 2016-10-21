<?php
/**
 * Actions Settings WP_ThemeSettings
 *
 * Manipulation of settings WP_ThemeSettings
 *
 * @class    WPTS_Admin_Action_Settings
 * @author   DevDiamond <me@devdiamond.com>
 * @package  WP_ThemeSettings/Admin
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class WPTS_Admin_Action_Settings - Actions Settings WP_ThemeSettings
 */
class WPTS_Admin_Action_Settings
{
	const OPTIONS_PREFIX = 'WPTS_';

	/**
	 * Get option
	 *
	 * @param  string $option_slug  - Option slug
	 * @param  string $option_name  - Option name
	 * @param  bool   $default      - Default options
	 *
	 * @return mixed
	 * @static
	 */
	public static function get_option( $option_slug, $option_name = null, $default = false )
	{
		$option = get_option( self::OPTIONS_PREFIX . $option_slug );

		if ( false === $option )
			return $default;

		if ( $option_name === null )
			return $option;
		elseif ( isset( $option[ $option_name ] ) )
			return $option[ $option_name ];
		else
			return $default;
	}

	/**
	 * Check and Update WPTS settings
	 *
	 * @param  string $page_slug        - Current Page slug
	 * @param  string $active_tab       - Active page tab
	 * @param  array  $page_data_group  - Current Page Tab fields data
	 * @static
	 */
	public static function update_settings( &$page_slug, &$active_tab, &$page_data_group )
	{
		// check POST data from WPTS
		if ( ! isset($_POST['wpts_action']) || $_POST['wpts_action'] !== 'wpts_update' )
			return;

		// check NONCE data from WPTS
		if ( ! check_admin_referer('wpts_action_update_'.$active_tab, 'wpts_set_id') )
			return;

		// Action type
		if ( isset($_POST['bt_save_settings']) )
			self::_update_settings( $page_slug );
		elseif ( isset($_POST['bt_reset_settings']) )
			self::_reset_settings( $page_slug, $page_data_group );
	}

	/**
	 * Activate WP_ThemeSettings
	 * @static
	 */
	public static function activate_wpts()
	{
		//
	}

	/**
	 * Deactivate WP_ThemeSettings
	 * @static
	 */
	public static function deactivate_wpts()
	{
		//
	}

	/**
	 * Uninstall WP_ThemeSettings
	 *
	 * @param  array $option_slugs  - Delete Option slug list
	 * @static
	 */
	public static function uninstall_wpts( $option_slugs )
	{
		self::_delete_option( $option_slugs );
	}

	/**
	 * Update WPTS settings
	 *
	 * @param  string $page_slug  - Current Page slug
	 * @static
	 */
	private static function _update_settings( $page_slug )
	{
		// delete unnecessary data
		self::delete_unnecessary_post_data();

		// Update options
		self::_update_option( $page_slug, $_POST );
	}

	/**
	 * Reset WPTS settings
	 *
	 * @param  string $page_slug        - Current Page slug
	 * @param  array  $page_data_group  - Current Page Tab fields data
	 * @static
	 */
	private static function _reset_settings( $page_slug, &$page_data_group )
	{
		$data = array();
		foreach ( $page_data_group as $tVal )
		{
			if ( ! isset($tVal['fields']) )
				continue;

			foreach ( $tVal as $gVal )
			{
				if ( ! isset($gVal['fields']) )
					continue;

				foreach ( $gVal as $fVal )
				{
					if ( ! isset($fVal['type']) || ! isset($fVal['name']) )
						continue;

					if ( ! isset($fVal['default']) )
						$fVal['default'] = ($fVal['type'] === 'checkbox' ? array() : '');
					elseif ( $fVal['type'] === 'checkbox' )
						$fVal['default'] = (array) $fVal['default'];
					else
						$fVal['default'] = (string) $fVal['default'];

					$data[ $fVal['name'] ] = $fVal['default'];
				}
			}
		}

		// Update options
		self::_update_option( $page_slug, $data, false );
	}

	/**
	 * Delete unnecessary POST data
	 * @static
	 */
	private static function delete_unnecessary_post_data()
	{
		unset($_POST['wpts_action'], $_POST['wpts_set_id'], $_POST['_wp_http_referer']);
		unset($_POST['bt_save_settings'], $_POST['bt_reset_settings']);
	}

	/**
	 * Update option
	 *
	 * @param  string       $option_slug  - Option slug
	 * @param  array|string $options      - Update option data
	 * @param  bool|true    $is_merge     - Is merge data
	 *
	 * @static
	 */
	private static function _update_option( $option_slug, $options, $is_merge = true )
	{
		if ( $is_merge === true )
		{
			$option = get_option( self::OPTIONS_PREFIX . $option_slug );
			$option = ( false === $option ) ? array() : (array) $option;
			$option = array_merge( $option, (array) $options );
		}
		elseif ( $is_merge === false )
			$option = (array) $options;
		else
			return;

		update_option( self::OPTIONS_PREFIX . $option_slug, $option );
	}

	/**
	 * Delete option
	 *
	 * @param  array $option_slugs  - Delete Option slug list
	 * @static
	 */
	private static function _delete_option( $option_slugs )
	{
		foreach ( $option_slugs as $sVal )
			delete_option( self::OPTIONS_PREFIX . $sVal );
	}

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
	return WPTS_Admin_Action_Settings::get_option( $option_slug, $option_name, $default );
}