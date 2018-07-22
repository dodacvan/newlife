<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'newlife');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'nmj#E.sE-yq1t<m7ajndy6[Oa.IZ]Lx*5VEC]CuzCoxsZuz`=Y>J#oUh]Z4y]u7=');
define('SECURE_AUTH_KEY',  '`yH4%J&gQrR+i[98<BU=gZx1uz/<us$uD !L{eildmOxZ-2WX@iqhc19bbWTar{j');
define('LOGGED_IN_KEY',    'X&FmNuLLPxcw1/*I+GxVR`1UIe;0d!(>JI>g{yd2tW}?_K((Odu&/SM6|`AJvj!4');
define('NONCE_KEY',        '*DW83hlHMt_6fX>ngx2i.6qiKw4.$RDO/J2Ax8e1P7QsU[xa;d6.#:l.U3e7ol>F');
define('AUTH_SALT',        'a);@%d:K2r+WgQsT?=B)7.XFxBAv06ztdP:^RkdJ:0A:(7BL$_=VFXMrGw!u*4+{');
define('SECURE_AUTH_SALT', 'adAIv,2=I+-MXhgN;cX:AG<C@$eO4L.&zp-_,9mCF.U%l:8pP7hdyDZWahm,|8UW');
define('LOGGED_IN_SALT',   'N1BO9qh5<j0-Z?-NgE+t<bs2pg[@%sFALQk,;U>}1CauN9b.+t0q,Xj>p[t}{f*p');
define('NONCE_SALT',       'e`DlZrQaUruD`Zt6JpvTtEd=sF65^DyE4fUsW0inAt]d`<SRU~o6A9ss]mK4]#;[');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

// Disable display of errors and warnings 
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define( 'SCRIPT_DEBUG', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
