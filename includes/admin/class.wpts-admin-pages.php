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
			$page_slug = str_replace(WPTS_Admin_Menus::MAIN_MENU_SLUG.'-', '', $_GET['page']);
		else
			$page_slug = $_GET['page'];

		if ( ! isset(WPTS()->submenu[ $page_slug ]) )
			return;

		if ( ! current_user_can( WPTS()->submenu[ $page_slug ]['capability'] ) )
			return;

		self::menu_page( WPTS_Admin_Menus::MAIN_MENU_SLUG, $page_slug );
	}

	/**
	 * Menu Page
	 *
	 * @static
	 * @param  string $main_page_slug  - Main Page slug
	 * @param  string $sub_page_slug   - Sub Page slug
	 */
	private static function menu_page( $main_page_slug, $sub_page_slug )
	{
		// Add Script And Style
		self::add_styles();

		// echo get_admin_page_title()

		//glyphicon glyphicon-envelope
		?>
		<div class="wrap">
			<h2 class="nav-tab-wrapper wpts-top-menu">
				<a href="?page=wpts&amp;tab=01" class="nav-tab nav-tab-active"><i class="fa fa-gear"></i>01</a>
				<a href="?page=wpts&amp;tab=02" class="nav-tab"><i class="fa fa-key"></i>02</a>
				<a href="?page=wpts&amp;tab=03" class="nav-tab"><i class="fa fa-info-circle"></i>03</a>
			</h2>
			<div class="wpts-settings-block">
				<?php
				// settings_errors() не срабатывает автоматом на страницах отличных от опций
				if( get_current_screen()->parent_base !== 'options-general' )
					settings_errors('название_опции');
				?>

				<form action="options.php" method="POST">
					<?php
					settings_fields("opt_group");     // скрытые защитные поля
					do_settings_sections("opt_page"); // секции с настройками (опциями).
					submit_button();
					?>
				</form>
			</div>
		</div>
		<?
	}

	/**
	 * Add Scripts
	 *
	 * @static
	 */
	private static function add_scripts(){}

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
