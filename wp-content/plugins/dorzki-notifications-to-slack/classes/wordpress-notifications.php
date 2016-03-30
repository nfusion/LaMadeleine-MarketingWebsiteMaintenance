<?php
/**
 * @package   Slack Notifications
 * @since     1.0.0
 * @version   1.0.1
 * @author    Dor Zuberi <me@dorzki.co.il>
 * @link      https://www.dorzki.co.il
 * 
 * 
 * NOTIFICATIONS CLASS
 */
if ( ! class_exists( wpNotifications ) ) {

	class wpNotifications {

		/**
		 * Slack class handler.
		 * 
		 * @var 	  slackBot
		 * @since   1.0.0
		 */
		private $slack;



		/**
		 * Register the SlackBot for internal use.
		 *
     * @since   1.0.0
		 */
		public function __construct() {

			$this->slack = new slackBot();

		}



		/**
		 * Core update check & send notification.
		 *
		 * @since   1.0.0
		 */
		public function coreUpdateNotif() {

			global $wp_version;

			// Force version check.
			do_action( 'wp_version_check' );

			$versionCheck = get_site_transient( 'update_core' );

			// Is there a new version of WordPress?
			if ( $versionCheck->updates[0]->response == 'upgrade' ) {

				$newVersion = $versionCheck->updates[0]->current;

				// Did we already notified the admin?
				if ( get_option( 'slack_notif_core_version' ) != $newVersion ) {

					update_option( 'slack_notif_core_version', $newVersion );

					$this->slack->sendMessage( sprintf( __( ':information_source: There is a new WordPress version available - v%s (current version is v%s).' ), $newVersion, $wp_version ) );

				}
			}

		}



		/**
		 * Theme udpate check & send notification.
		 *
		 * @since   1.0.0
		 */
		public function themeUpdateNotif() {

			// Force version check.
			do_action( 'wp_update_themes' );

			$versionCheck   = get_site_transient( 'update_themes' );
			$currentVersion = wp_get_theme()->get( 'Version' );
			$currentTheme   = get_option( 'template' );

			if ( $versionCheck->response[ $currentTheme ]['new_version'] != $currentVersion ) {

				$newVersion = $versionCheck->response[ $currentTheme ]['new_version'];

				// Did we already notified the admin?
				if ( get_option( 'slack_notif_theme_version' ) != $newVersion ) {

					update_option( 'slack_notif_theme_version', $newVersion );

					$this->slack->sendMessage( sprintf( __( ':information_source: Theme is a new version of the theme *%s* - v%s (current version is v%s).' ), $currentTheme, $newVersion, $currentVersion ) );

				}
			}

		}



		/**
		 * Plugins update check & send notification.
		 *
		 * @since   1.0.0
		 */
		public function pluginUpdateNotif() {

			// Force version check.
			do_action( 'wp_update_plugins' );

			$versionCheck  = get_site_transient( 'update_plugins' );
			$activePlugins = get_option( 'active_plugins' );

			$needsUpdate = array_intersect_key( $versionCheck->response, array_flip( $activePlugins ) );

			if ( count( $needsUpdate ) > 0 ) {

				$notifiedPlugins = get_option( 'slack_notif_plugins_version' );

				$theMessage = '';

				foreach ( $needsUpdate as $plugin => $updateData ) {

					$pluginMeta = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin, true, false );

					// Did we already notified the admin?
					if ( ! array_key_exists( $plugin, $notifiedPlugins ) && $notifiedPlugins[ $plugin ] != $updateData->new_version ) {

						$notifiedPlugins[ $plugin ] = $updateData->new_version;

						$theMessage .= sprintf( __( '• *%s* - v%s (current version is v%s)', 'dorzki-slack' ) . "\n", $pluginMeta['Name'], $updateData->new_version, $pluginMeta['Version'] );

					}
				}

				update_option( 'slack_notif_plugins_version', $notifiedPlugins );

				// Do we still need to notify?
				if ( $theMessage != '' ) {

					$theMessage = __( ':information_source: The following plugins have a new version:', 'dorzki-slack' ) . "\n" . $theMessage;

					$this->slack->sendMessage( $theMessage );

				}
			}

		}



		/**
		 * Send notification on published post.
		 * 
		 * @param   integer  $postID  the post id number.
		 * @param   object   $post    post details object.
		 * @since   1.0.0
		 */
		public function postPublishNotif( $postID, $post ) {

			$title  = $post->post_title;
			$url    = get_permalink( $postID );
			$author = get_the_author_meta( 'display_name', $post->post_author );

			$template = sprintf( __( ':metal: The post *<%s|%s>* was published by *%s* right now!', 'dorzki-slack' ), $url, $title, $author );

			$this->slack->sendMessage( $template );

		}



		/**
		 * Send notification on published page.
		 * 
		 * @param   integer  $postID  the page id number.
		 * @param   object   $post    page details object.
		 * @since   1.0.0
		 */
		public function pagePublishNotif( $postID, $post ) {

			$title  = $post->post_title;
			$url    = get_permalink( $postID );
			$author = get_the_author_meta( 'display_name', $post->post_author );

			$template = sprintf( __( ':metal: The page *<%s|%s>* was published by *%s* right now!', 'dorzki-slack' ), $url, $title, $author );

			$this->slack->sendMessage( $template );

		}



		/**
		 * Send notification when comment has been submitted.
		 * 
		 * @param   integer  $commentID    the comment id number.
		 * @param   integer  $isApproved   has the comment approved?
		 * @since   1.0.0
		 */
		public function commentAddedNotif( $commentID, $isApproved ) {

			$commentData = get_comment( $commentID );

			$author  = $commentData->comment_author;
			$post    = get_the_title( $commentData->comment_post_ID );
			$url     = get_permalink( $commentData->comment_post_ID );
			$comment = $commentData->comment_content;

			$template = sprintf( __( ':metal: A new comment by *%s* on *<%s|%s>*:', 'dorzki-slack' ) . "\n>>>%s", $author, $url, $post, $comment );

			$this->slack->sendMessage( $template );

		}



		/**
		 * Send notification on user registration.
		 * 
		 * @param   integer  $userID  the registered user id number.
		 * @since   1.0.0
		 */
		public function userRegisteredNotif( $userID ) {

			$user = get_userdata( $userID );

			$template = sprintf( __( ':dancer: A new user just registered - *%s* (%s).', 'dorzki-slack' ), $user->user_login, $user->user_email );

			$this->slack->sendMessage( $template );

		}



		/**
		 * Send notification on administrator login.
		 * 
		 * @param   string  $username  the username.
		 * @param   object  $user      the user details.
		 * @since   1.0.0
		 */
		public function adminLoggedInNotif( $username, $user ) {

			if ( in_array( 'administrator', $user->roles ) ) {

				$template = sprintf( __( ':bowtie: Administrator login: *%s*.', 'dorzki-slack' ), $username );

				$this->slack->sendMessage( $template );

			}

		}



		/**
		 * Send notification on published custom post type.
		 * 
		 * @param   integer  $postID  the post id number.
		 * @param   object   $post    page details object.
		 * @since   1.0.1
		 */
		public function cptPublishNotif( $postID, $post ) {

			$title  = $post->post_title;
			$url    = get_permalink( $postID );
			$author = get_the_author_meta( 'display_name', $post->post_author );

			$template = sprintf( __( ':metal: The post *<%s|%s>* was published by *%s* right now!', 'dorzki-slack' ), $url, $title, $author );

			$this->slack->sendMessage( $template );

		}
	}

}
