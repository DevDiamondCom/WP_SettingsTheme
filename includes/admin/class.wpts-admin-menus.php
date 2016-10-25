<?php
/**
 * Setup menus in WP admin
 *
 * @class    Admin_Menus
 * @author   DevDiamond <me@devdiamond.com>
 * @package  WP_Theme_Settings/Admin
 * @version  1.0.0
 */

namespace WPTS\admin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Admin_Menus - Create WP_Theme_Settings Menus
 */
class Admin_Menus
{
	const MAIN_MENU_SLUG = 'wpts';

	/**
	 * Sub menu list for WP_Theme_Settings (API)
	 *
	 * @var array
	 */
	public static $submenu = array();

	/**
	 * Admin_Menus constructor.
	 */
	public function __construct()
	{
		// Add menu
		add_action('admin_menu', array( $this, 'admin_menu' ), 9);

//		add_action( 'admin_head', array( $this, '' ) );
//		add_action( 'admin_bar_menu', array( $this, '' ) );
	}

	/**
	 * Add menu items.
	 */
	public function admin_menu()
	{
		// Get Sub Menu list (API)
		self::$submenu = (array) apply_filters('wpts_submenu', array());

		// Main menu
		add_menu_page(
			__('General Theme Settings', WPTS_PLUGIN_SLUG),
			__('Theme Settings', WPTS_PLUGIN_SLUG),
			'manage_options',
			self::MAIN_MENU_SLUG,
			null,
			null,
			'25.7'
		);

		// Main sub menu
		self::$submenu[ self::MAIN_MENU_SLUG ] = array(
			'page_title' => __('General Theme Settings', WPTS_PLUGIN_SLUG),
			'menu_title' => __('General Settings', WPTS_PLUGIN_SLUG),
			'capability' => 'manage_options',
		);

		// Add all sub menu
		$this->sub_menu();
	}

	/**
	 * Add Sub Menu list
	 */
	private function sub_menu()
	{
		// Main sub menu
		add_submenu_page(
			self::MAIN_MENU_SLUG,
			self::$submenu[ self::MAIN_MENU_SLUG ]['page_title'],
			self::$submenu[ self::MAIN_MENU_SLUG ]['menu_title'],
			self::$submenu[ self::MAIN_MENU_SLUG ]['capability'],
			self::MAIN_MENU_SLUG,
			array( 'WPTS\admin\Admin_Menu_Pages', 'admin_menu_pages' )
		);

		// Other all sub menu
		foreach ( self::$submenu as $sKey => $sVal )
		{
			if ( ! preg_match('/[\w-]+/', $sKey ) || ! trim($sVal['page_title']) || $sKey === self::MAIN_MENU_SLUG )
				continue;

			if ( ! trim($sVal['capability']) )
				self::$submenu[ $sKey ]['capability'] = $sVal['capability'] = 'manage_options';
			if ( ! current_user_can( $sVal['capability'] ) )
				continue;

			if ( ! trim($sVal['menu_title']) )
				$sVal['menu_title'] = $sVal['page_title'];

			add_submenu_page(
				self::MAIN_MENU_SLUG,
				$sVal['page_title'],
				$sVal['menu_title'],
				$sVal['capability'],
				self::MAIN_MENU_SLUG.'-'.$sKey,
				array( 'WPTS\admin\Admin_Menu_Pages', 'admin_menu_pages' )
			);
		}
	}
}

new Admin_Menus();
