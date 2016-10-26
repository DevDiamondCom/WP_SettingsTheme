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
	const ASSETS_FRONT_CSS = 'assets/css/';
	const ASSETS_ADMIN_CSS = 'assets/admin/css/';

	const ASSETS_FRONT_JS  = 'assets/js/';
	const ASSETS_ADMIN_JS  = 'assets/admin/js/';

	const ASSETS_ADMIN_IMG = 'assets/admin/img/';

	const MAIN_MENU_SLUG   = 'wpts';

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
			'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABJdJREFUeNqUk2tsU2UYx3/n9LKWje7iLrCObd2N7OIEuY8sMHAuLpmCGEOCmBA1U0hEURNiiFmCGj7AFyMfjGKUaCY3M9nYQNBxyUBHYGNu3cZoIbSbvdGua7te1+PpPpBBgtEneXJycp73d57n//4fQZKkCuCQnJVyinJK4WiEJJWa/xhC4oycJjn3IgPPS3Pi3K8XpOfffl/a9skByWKzS/8zritlanmioxvGEebPT+Vw/wSuKR99ZiuT/gCf7dxBlaGA89d6KSlYREme/t+6XSTIVOuJjk79txeuEpgKMF24FKXdhON2Hz6Xk9RkDaUlRQxMeEiZl8KBXTvYXF/3JKBNvD9uk47/fJKo3SyPH0YY7cEx0IO7txtFIEpcV8StO3bSQ5MIfhcHv/tRrntyiwopy7Cn17Bad984yjyPFbUuDSYdVOXnkrswA2/Ah1CyBN3aTSytLMA7dguz1U7tyuUoRPFxnl/Y//mnln5RnefOWYKv7QcC3gm2bNrM/t07iYaDjBr/ouvsWe4pkhnPX0lGkkDkyilESUllRQVbGxso0Oc+HFnR1dGxJyfq1Y22H2OopxttahpTUYktDRvRaLRkL9SztnYd1QvSUU8MYBUzyKqpx3ypjaNtXfzRN8D6VctJT02d7VBMkg9trH+R5ZVPs2jZCpKzchkZG6P9t4uPXl9xOdtf3sorKQ+43XsVW9FzFOXlYxwe5vLlKw/rZkUwTTg4fa2PaCjI9HQIUdbmS1n8CbvjEahSrWXDunqKrX2EZyRSVzVhkK1UW7N6DlCKc/DIUYINr6MS46gjbggFMBoH2Lb7Q0yW8Uegak0yH3/wEXWZAiFRi/VBiK9aT8ztUGCB5Mc7Pkb2rhaIRPHeM/NshQHPhImXdjRzUTb13MjMzmGNIRfLpXays7Jp7TzHa7vf467VgqKlpWVPTtZTupHOowyZndy/2U9+US7z1rxKdZGeoNPMNyfaicRnqCgtQavRzEK1SpFjx39C0CgRY1Gu37yBw+nxJzbFIn/Puz06RNvJ45SWV2Gx3WVQ3gxnWjX6pABnvv8ad2iGssJ8GupqWVFdTVyWat+hw0z5fShSsvHf6eOZ8sW2h8DHHXrh9046/+znl9MXiYW9CfFkX4YIBYMQjyAKEtrkNNncSuKVdZTmpNPSuNQmxmIxvF4vDocDu92OyWRi2DhMSXElTuMQUx43GRoFsSkXCqVSHlUed8rJfFFNqhgmFo8TudnJmzVl1K7fgNLtdjMm+258fJxwOEwkEkGtVlNkKJTf46Rv3YVPHk/ZdoSQXRZdiKFSaSl8Zx9ZcRvmU60Mmj0MDQ3CpiaUOp1OzMzMxOVyzcI0sugKhYLpYIiqyjLuXGklsuoFfHXbWebs542mdTgfWOm29+NtepcFf7tIV1+lcf06PB6PmNCwRwbVBAIBEuMnIvH0+XzyrTkZunWD810dBEimufktFhcbmJZru7vPcNbiJzmqpLlxNXkFBvR6/WACmLD5F4ntevxigtPB2a5jM/KPZNsoVSpEhRJBEJic9HJ3bISS0jJ06RkJmewqlWrvPwIMALcYShChgLoxAAAAAElFTkSuQmCC',
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

		// Add Style and Script
		if ( self::check_current_page() !== false )
		{
			$this->add_styles();
			$this->add_scripts();
		}
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

	/**
	 * Check Current Page
	 *
	 * @static
	 * @return bool|string - false or page_slug
	 */
	public static function check_current_page()
	{
		if ( ! isset($_GET['page']) )
			return false;

		if ( $_GET['page'] !== self::MAIN_MENU_SLUG )
			$page_slug = str_replace(self::MAIN_MENU_SLUG.'-', '', $_GET['page']);
		else
			$page_slug = $_GET['page'];

		if ( ! isset( self::$submenu[ $page_slug ] ) )
			return false;

		if ( ! current_user_can( self::$submenu[ $page_slug ]['capability'] ) )
			return false;

		return $page_slug;
	}

	/**
	 * Add Scripts
	 */
	private function add_scripts()
	{
		// Toggle JS
		wp_enqueue_script(
			'toggle-min',
			WPTS_PLUGIN_URL . self::ASSETS_FRONT_JS . 'toggles.min.js',
			array('jquery')
		);

		// DD JS Script
		wp_enqueue_script(
			'dd-script',
			WPTS_PLUGIN_URL . self::ASSETS_ADMIN_JS . 'dd-script.js',
			array('jquery')
		);

		// Main JS
		wp_enqueue_script(
			'wpts-main',
			WPTS_PLUGIN_URL . self::ASSETS_ADMIN_JS . 'admin-main.js',
			array('jquery')
		);
	}

	/**
	 * Add Styles
	 */
	private function add_styles()
	{
		// FontAwesome Styles
		wp_enqueue_style(
			'fontawesome',
			WPTS_PLUGIN_URL . self::ASSETS_FRONT_CSS . 'font-awesome.min.css'
		);

		// DD Style
		wp_enqueue_style(
			'dd-style',
			WPTS_PLUGIN_URL . self::ASSETS_ADMIN_CSS . 'dd-style.css'
		);

		// Main CSS
		wp_enqueue_style(
			'wpts-main',
			WPTS_PLUGIN_URL . self::ASSETS_ADMIN_CSS . 'admin-main.css'
		);
	}
}

new Admin_Menus();
