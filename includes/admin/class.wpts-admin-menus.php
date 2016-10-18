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
			'wpts',
			null,
			null,
			'25.7'
		);

		// Sub menu
		add_submenu_page(
			'wpts',
			__('General Theme Settings', WPTS_PLUGIN_SLUG),
			__('General Settings', WPTS_PLUGIN_SLUG),
			'manage_options',
			'wpts',
			array( $this, 'page_theme_settings' )
		);
	}

	/**
	 * Page Menu - General Theme Settings
	 */
	public function page_theme_settings()
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
