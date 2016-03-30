<?php
/**
 * @package   Slack Notifications
 * @since     1.0.0
 * @version   1.0.1
 * @author    Dor Zuberi <me@dorzki.co.il>
 * @link      https://www.dorzki.co.il
 * 
 * 
 * WORDPRESS CLASS
 */
if ( ! class_exists( wpSlack ) ) {

	class wpSlack {

		/**
		 * Registerd Post Types.
		 *
		 * @var     array
		 * @since   1.0.1
		 */
		public $postTypes = array();



		/**
		 * Notifications class handler.
		 * 
		 * @var 	  wpNotifications
		 * @since   1.0.1
		 */
		private $notifs;



		/**
		 * Register all the functions to their related WordPress Hooks & Filters.
		 *
		 * @since   1.0.0
		 */
		public function __construct() {

			// Initiate the Notifications Class.
			$this->notifs = new wpNotifications();

			add_action( 'admin_init', array( &$this, 'plugin_init' ) );
			add_action( 'init', array( &$this, 'plugin_translate' ) );
			add_action( 'admin_menu', array( &$this, 'plugin_menu' ) );
			add_action( 'admin_enqueue_scripts', array( &$this, 'plugin_register_assets' ) );
			add_action( 'registered_post_type', array( &$this, 'get_registered_post_types' ) );

			$this->get_registered_post_types();
			$this->register_notifs_hooks();

		}




		/**
		 * Perform one-time operations on plugin activation.
		 *
		 * @since   1.0.0
		 */
		public function plugin_activate() {

			// Setup version check twice a day.
			if ( ! wp_next_scheduled( 'slack_notif_check_versions' ) ) {
				wp_schedule_event( time(), 'twicedaily', 'slack_notif_check_versions' );
			}

		}



		/**
		 * Perform one-time operations on plugin deactivation.
		 *
		 * @since   1.0.0
		 */
		public function plugin_deactivate() {

			// Remove version check.
			wp_unschedule_event( wp_next_scheduled( 'slack_notif_check_versions' ), 'slack_notif_check_versions' );

			// Remove settings from database.
			delete_option( 'slack_webhook_endpoint' );
			delete_option( 'slack_channel_name' );
			delete_option( 'slack_bot_username' );
			delete_option( 'slack_bot_image' );
			delete_option( 'slack_notif_core_update' );
			delete_option( 'slack_notif_theme_update' );
			delete_option( 'slack_notif_plugin_update' );
			delete_option( 'slack_notif_new_post' );
			delete_option( 'slack_notif_new_page' );
			delete_option( 'slack_notif_new_comment' );
			delete_option( 'slack_notif_new_user' );
			delete_option( 'slack_notif_admin_logged' );
			delete_option( 'slack_notif_core_version' );
			delete_option( 'slack_notif_theme_version' );
			delete_option( 'slack_notif_plugins_version' );

			// Delte custom post types settings.
			foreach( $this->postTypes as $postType ) {

				delete_option( 'slack_notif_new_' . $postType->name );

			}

		}



		/**
		 * Register plugin settings to the database.
		 *
		 * @since   1.0.0
		 */
		public function plugin_init() {

			register_setting( 'dorzki-slack', 'slack_webhook_endpoint' );
			register_setting( 'dorzki-slack', 'slack_channel_name' );
			register_setting( 'dorzki-slack', 'slack_bot_username' );
			register_setting( 'dorzki-slack', 'slack_bot_image' );
			register_setting( 'dorzki-slack', 'slack_notif_core_update' );
			register_setting( 'dorzki-slack', 'slack_notif_theme_update' );
			register_setting( 'dorzki-slack', 'slack_notif_plugin_update' );
			register_setting( 'dorzki-slack', 'slack_notif_new_post' );
			register_setting( 'dorzki-slack', 'slack_notif_new_page' );
			register_setting( 'dorzki-slack', 'slack_notif_new_comment' );
			register_setting( 'dorzki-slack', 'slack_notif_new_user' );
			register_setting( 'dorzki-slack', 'slack_notif_admin_logged' );
			register_setting( 'dorzki-slack', 'slack_notif_core_version' );
			register_setting( 'dorzki-slack', 'slack_notif_theme_version' );
			register_setting( 'dorzki-slack', 'slack_notif_plugins_version' );

		}



		/**
		 * Enable i18n & l10n to the plugin.
		 *
		 * @since   1.0.0
		 */
		public function plugin_translate() {

			load_plugin_textdomain( 'dorzki-slack', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

		}



		/**
		 * Add plugin settings page to the administration menu.
		 *
		 * @since   1.0.0
		 */
		public function plugin_menu() {

			add_options_page( __( 'Slack Notifications', 'dorzki-slack' ), __( 'Slack Notifications Integration', 'dorzki-slack' ), 'manage_options', 'slack_notifications', array( &$this, 'plugin_settings_page' ) );

		}



		/**
		 * Displays the plugin settings page if the user has the required permission level.
		 *
		 * @since   1.0.0
		 */
		public function plugin_settings_page() {

			global $postTypes;

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'Oops... It\'s seems like you don\'t meet the required level of permissions', 'dorzki-slack' ) );
			}

			$postTypes = $this->postTypes;

			include_once( PLUGIN_ROOT_DIR . '/templates/settings-page.php' );

		}



		/**
		 * Register the plugin CSS and JavaScript files.
		 *
		 * @since   1.0.0
		 */
		public function plugin_register_assets() {

			wp_register_script( 'dorzki-slack-media-upload', PLUGIN_ROOT_URL . 'assets/js/admin-scripts.js' );
			wp_register_style( 'dorzki-slack-settings-css', PLUGIN_ROOT_URL . 'assets/css/admin-styles.css' );

			if ( get_current_screen()->id == 'settings_page_slack_notifications' ) {

				wp_enqueue_script( 'jquery' );
				wp_enqueue_script( 'thickbox' );
				wp_enqueue_script( 'media_upload' );
				wp_enqueue_script( 'dorzki-slack-media-upload' );

				wp_enqueue_style( 'thickbox' );
				wp_enqueue_style( 'dorzki-slack-settings-css' );

			}

		}



		/**
		 * Register user desired notifications to the related WordPress hooks.
		 *
		 * @since   1.0.0
		 */
		public function register_notifs_hooks() {

			$notifs = $this->notifs;

			// Get the selected user notifications.
			$core_update = get_option( 'slack_notif_core_update' );
			$theme_update = get_option( 'slack_notif_theme_update' );
			$plugin_update = get_option( 'slack_notif_plugin_update' );
			$new_post = get_option( 'slack_notif_new_post' );
			$new_page = get_option( 'slack_notif_new_page' );
			$new_comment = get_option( 'slack_notif_new_comment' );
			$new_user = get_option( 'slack_notif_new_user' );
			$admin_logged = get_option( 'slack_notif_admin_logged' );



			// Register Hooks
			if ( $core_update == 1 ) {
				add_action( 'slack_notif_check_versions', array( &$notifs, 'coreUpdateNotif' ) );
			}

			if ( $theme_update == 1 ) {
				add_action( 'slack_notif_check_versions', array( &$notifs, 'themeUpdateNotif' ) );
			}

			if ( $plugin_update == 1 ) {
				add_action( 'slack_notif_check_versions', array( &$notifs, 'pluginUpdateNotif' ) );
			}

			if ( $new_post == 1 ) {
				add_action( 'publish_post', array( &$notifs, 'postPublishNotif' ), 10, 2 );
			}

			if ( $new_page == 1 ) {
				add_action( 'publish_page', array( &$notifs, 'pagePublishNotif' ), 10, 2 );
			}

			if ( $new_comment == 1 ) {
				add_action( 'comment_post', array( &$notifs, 'commentAddedNotif' ), 10, 2 );
			}

			if ( $new_user == 1 ) {
				add_action( 'user_register', array( &$notifs, 'userRegisteredNotif' ), 10, 1 );
			}

			if ( $admin_logged == 1 ) {
				add_action( 'wp_login', array( &$notifs, 'adminLoggedInNotif' ), 10, 2 );
			}

		}



		/**
		 * Get WordPress registered custom post types.
		 *
		 * @since   1.0.1
		 */
		public function get_registered_post_types() {

			// Retrieve custom post types.
			$this->postTypes = get_post_types( array(
				'public' => true,
				'_builtin' => false
				), 'objects' );

			add_action( 'admin_init', array( &$this, 'register_post_types_settings' ) );

		}



		/**
		 * Register plugin settings for custom post types.
		 *
		 * @since   1.0.1
		 */
		public function register_post_types_settings() {

			foreach( $this->postTypes as $postType ) {

				register_setting( 'dorzki-slack', 'slack_notif_new_' . $postType->name );

			}

			$this->register_post_types_notifs_hooks();

		}



		/**
		 * Register custom post types notifications hooks.
		 * 
		 * @since   1.0.1
		 */
		public function register_post_types_notifs_hooks() {

			$notifs = $this->notifs;

			// Get selected settings for custom post types.
			foreach( $this->postTypes as $postType ) {

				if ( get_option( 'slack_notif_new_' . $postType->name ) == 1 ) {

					if ( has_action( 'publish_' . $postType->name, array( &$notifs, 'cptPublishNotif' ) ) === false ) {
						add_action( 'publish_' . $postType->name, array( &$notifs, 'cptPublishNotif' ), 10, 2 );
					}

				}

			}

		}
	}

}
