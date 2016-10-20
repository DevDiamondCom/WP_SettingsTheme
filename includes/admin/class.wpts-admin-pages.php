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
	 * @var array
	 */
	private static $page_data = array();

	/**
	 * Active Tab
	 *
	 * @var string
	 */
	private static $active_tab;

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
	 * @param  string $tab_slug  - args tab slug
	 */
	private static function menu_page( $tab_slug )
	{
		// Add Script And Style
		self::add_styles();

		// echo get_admin_page_title()

		?>
		<div class="wrap">

			<?php self::echo_top_menu( $tab_slug ); ?>

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
		<?php
	}

	/**
	 * Add Info page
	 */
	private static function info_page()
	{
		WPTS()->tabs[ WPTS_Admin_Menus::MAIN_MENU_SLUG ]['info'] = array(
			'args' => array(
				'title'   => __("Info", WPTS_PLUGIN_SLUG),
				'id'      => 'wpts-info',
				'fa-icon' => 'fa-info-circle',
			),
			'groups' => array(
				'set_1' => array(
					'args' => array(
						'title' => __("Website Title", WPTS_PLUGIN_SLUG),
						'id'    => 'site-name',
						'class' => '',
						'desc'  => __("Enter your website title.", WPTS_PLUGIN_SLUG),
					),
					'fields' => array(
						array(
							'type'  => 'text', // switch,
							'title' => __("Website Title", WPTS_PLUGIN_SLUG),
							'name'  => 'blogname',
							'id'    => 'blogname',
							'class' => 'option-item bg-grey-input ',
							'placeholder' => 'placeholder TEXT',
							'default' => 100,
							'min' => 0,
							'max' => 200,
							'data' => array(),
						),
					),
				),
			),
		);
	}

	/**
	 * Echo top menu
	 *
	 * @param string $tab_slug  - args tab slug
	 */
	private static function echo_top_menu( $tab_slug )
	{
		echo '<h2 class="nav-tab-wrapper wpts-top-menu">';
		foreach ( WPTS()->tabs[ $tab_slug ] as $tKey => $tVal )
		{
			echo '<a href="?page='. $_GET['page'] .'&tab='. $tKey .'" id="'. (@$tVal['args']['id'] ?: '') .'" class="nav-tab ';
			if ( $tKey === self::$active_tab )
			{
				self::$page_data = $tVal['groups'];
				echo 'nav-tab-active ';
			}
			echo (@$tVal['args']['class'] ?: '') .'">';
			echo (isset($tVal['args']['fa-icon']) ? '<i class="fa '. $tVal['args']['fa-icon'] .'"></i>' : '');
			echo (@$tVal['args']['title'] ?: '') .'</a>';
		}
		echo '</h2>';
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
