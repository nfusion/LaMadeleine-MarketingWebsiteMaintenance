<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('DB_NAME', 'lam_wp');

/*** We are going to use up Environments Vars to identify Configurations **/
//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/private/var/www/nfusion/lam/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
$env = isset($_SERVER['APPLICATION_ENVIRONMENT'])?$_SERVER['APPLICATION_ENVIRONMENT']:'production';
define('ENV',$env);

switch($env){
    case "kwhite":
    	define('SITE_URL', 'local.lamadeleine.nfusion.com');
        define('DB_NAME', 'lam_wp');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'root');
        define('DB_HOST', '127.0.0.1');
        define('WP_DEBUG', true);
        break;
    case "mdavis":
    	define('SITE_URL', 'local.lamadeleine.nfusion.com');
        define('DB_NAME', 'lam_wp');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'root');
        define('DB_HOST', '127.0.0.1');
        define('WP_DEBUG', true);
        break;
    case "roger":
    	define('SITE_URL', 'local.lamadeleine.nfusion.com');
        define('DB_NAME', 'lam_wp');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'root');
        define('DB_HOST', '127.0.0.1');
        define('WP_DEBUG', true);
        break;
    case "test":
    	define('SITE_URL', 'test.lamadeleine.nfusion.com');
        define('DB_NAME', 'lam_wp');
        define('DB_USER', 'LAM-14');
        define('DB_PASSWORD', 'Bagu3tt314');
        define('DB_HOST', 'localhost');
        define('WP_DEBUG', false);
        break;
    case "staging":
    	define('SITE_URL', 'staging.lamadeleine.nfusion.com');
        define('DB_NAME', 'lam_wp_staging');
        define('DB_USER', 'LAM-14');
        define('DB_PASSWORD', 'Bagu3tt314');
        define('DB_HOST', 'localhost');
        define('WP_DEBUG', false);
        break;
    default: /* production */
    	define('SITE_URL', 'lamadeleine.com');
        define('DB_NAME', 'lam_wp');
        define('DB_USER', 'LAM-14');
        define('DB_PASSWORD', 'Bagu3tt314');
        define('DB_HOST', 'localhost');
        define('WP_DEBUG', false);

}


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'jx297Rkg5Lnprkk');
define('SECURE_AUTH_KEY',  '352AmYUAkrWLXKF');
define('LOGGED_IN_KEY',    'aMWDjH2X7PsN2CK');
define('NONCE_KEY',        'ykyLSd8yuLBpPHb');
define('AUTH_SALT',        'awz4YgwLaHSjnvc');
define('SECURE_AUTH_SALT', 'a8cnmVGNWyNnNXm');
define('LOGGED_IN_SALT',   '5ru7bM38c9eTXjd');
define('NONCE_SALT',       'n8RWbN6Vq8q6qHt');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'lwp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
//define('WP_DEBUG', false);

/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
define('DOMAIN_CURRENT_SITE', $SITE_URL);
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('FS_METHOD', 'direct');
