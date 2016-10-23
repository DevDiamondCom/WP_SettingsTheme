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
			self::_default_settings( $page_slug, $page_data_group );
	}

	/**
	 * Activate WP_ThemeSettings
	 * @static
	 */
	public static function activate_wpts()
	{
		return;
//		foreach ( array_keys( WPTS_Admin_Menus::$submenu ) as $mVal )
//		{
//			if ( ! preg_match('/[\w-]+/', $mVal) || wpts_get_option($mVal) )
//				continue;
//
//			// Get Page Tabs list (API)
//			$arr_tabs = (array) apply_filters('wpts_tabs_'.$mVal, array());
//
//			foreach ( $arr_tabs as $tKey => $tVal )
//			{
//				if ( ! isset($tVal[ $tKey ]['groups']) || ! is_array($tVal[ $tKey ]['groups']) )
//					continue;
//
//				self::_default_settings( $mVal, $tVal[ $tKey ]['groups'] );
//			}
//		}
	}

	/**
	 * Deactivate WP_ThemeSettings
	 * @static
	 */
	public static function deactivate_wpts()
	{
		return;
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
	 * Reset (default) WPTS settings
	 *
	 * @param  string $page_slug        - Page slug
	 * @param  array  $page_data_group  - Page Tab fields data
	 * @static
	 */
	private static function _default_settings( $page_slug, &$page_data_group )
	{
		$data = array();
		foreach ( $page_data_group as $tVal )
		{
			if ( ! isset($tVal['fields']) )
				continue;

			foreach ( $tVal['fields'] as $gVal )
			{
				if ( ! isset($gVal['fields']) )
					continue;

				foreach ( $gVal['fields'] as $fVal )
				{
					if ( ! isset( $fVal['type'], $fVal['name'] ) )
						continue;

					if ( ! isset($fVal['default']) )
						$fVal['default'] = ($fVal['type'] === 'checkbox' ? array() : '');
					elseif ( $fVal['type'] === 'checkbox' )
						$fVal['default'] = (array) $fVal['default'];
					elseif ( $fVal['type'] === 'switch' )
						$fVal['default'] = (bool) $fVal['default'];
					else
						$fVal['default'] = (string) $fVal['default'];

					$data[ $fVal['name'] ] = $fVal['default'];
				}
			}
		}

		// Update options
		if ( $data )
			self::_update_option( $page_slug, $data, true );
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
			$option = get_option( WP_ThemeSettings::OPTIONS_PREFIX . $option_slug );
			$option = ( false === $option ) ? array() : (array) $option;
			$option = array_merge( $option, (array) $options );
		}
		elseif ( $is_merge === false )
			$option = (array) $options;
		else
			return;

		update_option( WP_ThemeSettings::OPTIONS_PREFIX . $option_slug, $option );
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
			delete_option( WP_ThemeSettings::OPTIONS_PREFIX . $sVal );
	}

}
