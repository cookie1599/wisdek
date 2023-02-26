<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'trisa' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'P )6271n)o!KRkw2|)TOG[qwLbM_j[;g5a}E$jNo::2F&|!z,IE-M#%#Mg>(xArt' );
define( 'SECURE_AUTH_KEY',  'Vm+ZFK<Y4bS#pS)kHpEReC67X+`PLM]YiL.%9|l7X+Hvf{1$Hdi<.h8--|:a8JY@' );
define( 'LOGGED_IN_KEY',    'E(jKg*nPD7o/i?(n)?qA]eT,/J0Nfbrdh3&MDAUnWY*p-;r7mB[{u6,?(#YnVm>e' );
define( 'NONCE_KEY',        'z(,tyRg vwLS8D;Sl<;=9H1IOrhMFRXaTFVro49ZcNZAe;srE^)!)`+GuJY]2]r_' );
define( 'AUTH_SALT',        'TZ_rvSSwc>1~$[/j^#0k.1I-8D3-qYT[+M})D4XQFY4W0t!<LZNc4UE~ud53b} T' );
define( 'SECURE_AUTH_SALT', 'ximsHZb%LVTO-nU?uFMO,xEo-1dIqV[w?~p[;3?EM7R0yu424=M)[M<rU,J3WMXM' );
define( 'LOGGED_IN_SALT',   '!pKO Y$i,Op2MtE2!GQh+?/-ZM58Z+8:c]^jiN](!csH8rw; e?I0]`Z+aLrYcs/' );
define( 'NONCE_SALT',       'B+pM@]VGudeo3wy{a`R$S2#gsely7Q0[h;T;?_h@ZPCK=~l=-?5r[_}l/DwwKUG>' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
