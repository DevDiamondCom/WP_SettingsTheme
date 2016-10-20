<?php
/**
 * Setup menu pages in WP admin
 *
 * @class    WPTS_Admin_Menu_Pages
 * @author   DevDiamond <me@devdiamond.com>
 * @package  WP_ThemeSettings/Admin
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class WPTS_Admin_Menu_Pages - Create WP_ThemeSettings Menu Pages
 */
class WPTS_Admin_Menu_Pages
{
	const ASSETS_CSS = 'assets/css/';
	const ASSETS_JS  = 'assets/js/';

	/**
	 * Page data
	 *
	 * @static
	 * @var array
	 */
	private static $page_data_group = array();

	/**
	 * Active Tab
	 *
	 * @static
	 * @var string
	 */
	private static $active_tab;

	/**
	 * Is Form block
	 *
	 * @static
	 * @var bool
	 */
	private static $is_form = false;

	/**
	 * WPTS_Admin_Menus constructor.
	 */
	private function __construct(){}

	/**
	 * Cloning is forbidden.
	 */
	private function __clone(){}

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	protected function __wakeup(){}

	/**
	 * Admin Menu Pages
	 *
	 * @static
	 */
	public static function admin_menu_pages()
	{
		if ( ! isset($_GET['page']) )
			return;

		if ( $_GET['page'] !== WPTS_Admin_Menus::MAIN_MENU_SLUG )
			$tab_slug = str_replace(WPTS_Admin_Menus::MAIN_MENU_SLUG.'-', '', $_GET['page']);
		else
			$tab_slug = $_GET['page'];

		if ( ! isset(WPTS()->submenu[ $tab_slug ]) )
			return;

		if ( ! current_user_can( WPTS()->submenu[ $tab_slug ]['capability'] ) )
			return;

		if ( WPTS_Admin_Menus::MAIN_MENU_SLUG === $tab_slug )
			self::info_page();

		if ( ! isset(WPTS()->tabs[ $tab_slug ]) )
			return;

		if ( isset($_GET['tab']) && isset(WPTS()->tabs[ $tab_slug ][ $_GET['tab'] ]) )
			self::$active_tab = $_GET['tab'];
		else
			self::$active_tab = key(WPTS()->tabs[ $tab_slug ]);

		self::menu_page( $tab_slug );
	}

	/**
	 * Menu Page
	 *
	 * @static
	 * @param  string $tab_slug  - TAB slug
	 */
	private static function menu_page( $tab_slug )
	{
		// Add Style and Script
		self::add_styles();
		self::add_scripts();

		// echo get_admin_page_title()

		echo '<div class="wrap">';

		self::echo_top_menu( $tab_slug );

		echo '<div class="wpts-settings-block"><br>';

		self::echo_body( $tab_slug );

		// END From block
		if ( self::$is_form )
		{
			echo '<div class="wpts-sb-btn">';
			settings_fields("opt_group");
			do_settings_sections("opt_page");
			echo '<p><input type="submit" name="bt_save_settings" class="button button-primary" value="'.__('Save changes', WPTS_PLUGIN_SLUG).'">';
			echo '&nbsp;&nbsp;<input type="submit" name="bt_reset_settings" class="button" value="'.__('Reset Settings', WPTS_PLUGIN_SLUG).'"></p>';
			echo '</div></form>';
		}

		echo '</div></div>';
	}

	/**
	 * Add Info page
	 *
	 * @static
	 */
	private static function info_page()
	{
		WPTS()->tabs[ WPTS_Admin_Menus::MAIN_MENU_SLUG ]['info'] = array(
			'title_args' => array(
				'title'   => __("Info", WPTS_PLUGIN_SLUG),
				'id'      => 'wpts-info',
				'fa-icon' => 'fa-info-circle',
			),
		);
	}

	/**
	 * Echo top menu
	 *
	 * @static
	 * @param string $tab_slug  - TAB slug
	 */
	private static function echo_top_menu( $tab_slug )
	{
		echo '<h2 class="nav-tab-wrapper wpts-top-menu">';
		foreach ( WPTS()->tabs[ $tab_slug ] as $tKey => $tVal )
		{
			if ( ! isset($tVal['title_args']) )
				continue;

			echo '<a href="?page='. $_GET['page'] .'&tab='. $tKey .'" id="'. (@$tVal['title_args']['id'] ?: '') .'" class="nav-tab ';
			if ( $tKey === self::$active_tab )
			{
				self::$page_data_group = @$tVal['groups'] ?: array();
				echo 'nav-tab-active ';
			}
			echo (@$tVal['title_args']['class'] ?: '') .'">';
			echo (isset($tVal['title_args']['fa-icon']) ? '<i class="fa '. $tVal['title_args']['fa-icon'] .'"></i>' : '');
			echo (@$tVal['title_args']['title'] ?: '') .'</a>';
		}
		echo '</h2>';
	}

	/**
	 * Echo body content
	 *
	 * @static
	 * @param string $tab_slug  - TAB slug
	 */
	private static function echo_body( $tab_slug )
	{
		// GROUP (set) data
		foreach ( self::$page_data_group as $gKey => $gVal )
		{
			if ( ! isset($gVal['group_args']) || ! isset($gVal['fields']) )
				continue;

			// BEGIN From block
			if ( ! self::$is_form )
			{
				self::$is_form = true;
				echo '<form action="" method="POST">';
			}

			?>
			<div id="wpts_effects_box" class="wpts_eb_block">
				<div class="wpts_eb_title">
					<h3><i class="fa fa-plus-square"></i>Gallery Image Transition Effects</h3>
				</div>
				<div class="wpts_eb_body">
					<div class="wpts_eb_desc"><?= (@$gVal['group_args']['desc'] ?: '') ?></div>
					<div class="wpts_eb_table"><?php self::echo_fields( $gVal['fields'] ); ?></div>
				</div>
			</div>
			<?
		}
	}

	private static function echo_fields( $fields_data )
	{
		// BEGIN Table
		echo '<table class="form-table"><tbody>';

		$x1 = 0;
		foreach ( $fields_data as $fVal )
		{
			$x1++;
			echo '<tr valign="top">';
			?>
				<th class="">
					<label for="">Auto Start</label>
				</th>
				<td class="">
					<div class="toggle toggle-light">
				</td>
			<?
			echo '</tr>';
		}

		// END Table
		echo '</tbody></table>';
	}

	/**
	 * Add Scripts
	 *
	 * @static
	 */
	private static function add_scripts()
	{
		// Toggle JS
		wp_enqueue_script(
			'toggle-min',
			WPTS_PLUGIN_URL . self::ASSETS_JS . 'toggles.min.js',
			array('jquery')
		);

		// Main JS
		wp_enqueue_script(
			'wpts-main',
			WPTS_PLUGIN_URL . self::ASSETS_JS . 'main.js',
			array('jquery')
		);
	}

	/**
	 * Add Styles
	 *
	 * @static
	 */
	private static function add_styles()
	{
		// FontAwesomeStyles
		wp_enqueue_style(
			'wpts-fontawesome',
			WPTS_PLUGIN_URL . self::ASSETS_CSS . 'font-awesome.min.css'
		);

		// Main CSS
		wp_enqueue_style(
			'wpts-main',
			WPTS_PLUGIN_URL . self::ASSETS_CSS . 'main.css'
		);
	}
}
