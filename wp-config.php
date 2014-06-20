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
define('DB_NAME', 'lam_wp');

/** MySQL database username */
define('DB_USER', 'LAM-14');

/** MySQL database password */
define('DB_PASSWORD', 'Bagu3tt314');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '=?dI,H9`=?A3`B-tiZ~<tGBomDrVh=~cnBF}Q-oNUa<(_Ff3#x->%#3v|LDifh:<');
define('SECURE_AUTH_KEY',  '4ttvID76lVEn3!Vw%j4gorZAM=*tL(u1$p$[hx)n6qVt&x&s_+y2Z~xBucAs`]@w');
define('LOGGED_IN_KEY',    'd&Hx=5HX<4:-%:g48s:$G+@UoBTDs>Eaeg&3+eE6cH^%-]jO=uvfLL}#~s~BVE_T');
define('NONCE_KEY',        'e%MP_mxpRg/]X2%wRGZ}JAANK/OsH~XH/ChvC?,K%(C1qSzEuJ+*e-+A92JcXU&3');
define('AUTH_SALT',        'ud.yJ;_v=8|:7!X:H(bQuC9 S[0Tw EL?h|46B3uz(f33<]AI=e),_j1Tj l+5@t');
define('SECURE_AUTH_SALT', ':7}1(]opQ`wIka4{|2sP-.2D %aG C7_45oDC+bPD-l/-|%Jz&-(]]kHh]M|h054');
define('LOGGED_IN_SALT',   'p8Xe?SbX*oFRF,G?eBu`t0%5nis,=N>I+M^e{%JUxX<-xJ]8D_DV,!5Jf_r<V!4,');
define('NONCE_SALT',       'DUD}%RPk/i76N0mzF!S9L+WzodH@Z >63=M  pho@>>=R=nlj` Nt^ s*MAf5$.y');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
