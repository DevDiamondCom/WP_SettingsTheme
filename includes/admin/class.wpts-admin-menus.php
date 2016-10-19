<?php
/**
 * Setup menus in WP admin
 *
 * @class    WPTS_Admin_Menus
 * @author   DevDiamond <me@devdiamond.com>
 * @package  WP_ThemeSettings/Admin
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class WPTS_Admin_Menus - Create WP_ThemeSettings Menu
 */
class WPTS_Admin_Menus
{
	const MAIN_MENU_SLUG = 'wpts';

	/**
	 * WPTS_Admin_Menus constructor.
	 */
	public function __construct()
	{
		// Add menu
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 );

//		add_action( 'admin_head', array( $this, '' ) );
//		add_action( 'admin_bar_menu', array( $this, '' ) );
	}

	/**
	 * Add menu items.
	 */
	public function admin_menu()
	{
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
		WPTS()->submenu[ self::MAIN_MENU_SLUG ] = array(
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
		$main_sub_menu = WPTS()->submenu[ self::MAIN_MENU_SLUG ];
		add_submenu_page(
			self::MAIN_MENU_SLUG,
			$main_sub_menu['page_title'],
			$main_sub_menu['menu_title'],
			$main_sub_menu['capability'],
			self::MAIN_MENU_SLUG,
			array( $this, 'sub_menu_page' )
		);

		// Other all sub menu
		foreach ( WPTS()->submenu as $sKey => $sVal )
		{
			if ( ! preg_match('/[\w-]+/', $sKey ) || ! trim($sVal['page_title']) || $sKey === self::MAIN_MENU_SLUG )
				continue;

			if ( ! trim($sVal['capability']) )
				WPTS()->submenu[ $sKey ]['capability'] = $sVal['capability'] = 'manage_options';
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
				array( $this, 'sub_menu_page' )
			);
		}
	}

	/**
	 * Sub Menu Page
	 */
	public function sub_menu_page()
	{
		if ( ! isset($_GET['page']) )
			return;

		if ( $_GET['page'] !== self::MAIN_MENU_SLUG )
			$page_slug = str_replace(self::MAIN_MENU_SLUG.'-', '', $_GET['page']);
		else
			$page_slug = $_GET['page'];

		if ( ! isset(WPTS()->submenu[ $page_slug ]) )
			return;

		if ( ! current_user_can( WPTS()->submenu[ $page_slug ]['capability'] ) )
			return;

		$this->menu_pages( $page_slug );
	}

	/**
	 * Menu Pages
	 *
	 * @param string $page_slug  - Page slug
	 */
	private function menu_pages( $page_slug )
	{
		?>
		<div class="wrap">
			<h2><?php echo get_admin_page_title() ?></h2>

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
		<?
	}
}

new WPTS_Admin_Menus();
