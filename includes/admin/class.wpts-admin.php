<?php
/**
 * WP Admin_Panel
 *
 * @class    Admin_Panel
 * @author   DevDiamond <me@devdiamond.com>
 * @package  WP_Theme_Settings/Admin
 * @version  1.0.0
 */

namespace WPTS\admin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Admin_Panel - Admin Panel set.
 */
class Admin
{
	/**
	 * Admin_Panel constructor.
	 */
	public function __construct()
	{
		add_action( 'init', array( $this, 'includes_init' ) );
		add_action( 'admin_init', array( $this, 'includes_admin_init' ) );
	}

	/**
	 * Include the necessary classes for the Admin Panel.
	 */
	public function includes_init()
	{
		require_once('class.wpts-admin-action-settings.php');
		require_once('class.wpts-admin-menus.php');
		require_once('class.wpts-admin-pages.php');
	}

	/**
	 * Include the necessary classes for the Admin Panel.
	 */
	public function includes_admin_init()
	{
		//
	}
}

new Admin();
