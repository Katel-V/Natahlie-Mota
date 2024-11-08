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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'saZS-u8]I07&mkC%Xm8!&VWrP]KKHv2sFV5Pq9vM]$vpn)_$0Y(xJ.J1Q9b,{BP8' );
define( 'SECURE_AUTH_KEY',   ']zp9mI8?GKu-FzS#rm>nWl3!^![[5t%Gm0hE-1W=$_C{&mg.#Rl=eRRN5.$E},[5' );
define( 'LOGGED_IN_KEY',     'U$,yrn;N]=bV>2Z#7,Gl1]9:yOP*B-:#R[nevx^n+V`Hh~b/zE9qcskUR?Zn`/nl' );
define( 'NONCE_KEY',         'np6}S~~xe{80tXEx#XXpHw!j@BLAz j}mjQ{BRswFt=H.)6=O<X*6Q6E4|!$6+x;' );
define( 'AUTH_SALT',         'G%c TA71zi~-bl8BI#BGBBHzJQ8SoCR|3?CuvlI%CGEIy2(~mZ}BIGQ04U.=-W|l' );
define( 'SECURE_AUTH_SALT',  'S?_[<zJj}Qr%!Qgd$Gfk)nhWc[ES>9jvh@(Re6*8F/o$&YlM3Ei+@cI%S.iG^>cg' );
define( 'LOGGED_IN_SALT',    '].b*bh,YaV35kbl*zi%U/FJt=vS xy=&%~TycPCr|&#5F_s=fY),,3~xvwn;*,&y' );
define( 'NONCE_SALT',        '_T&2kt ?1p[N%pjNZ=KlIs$)A:uY[iH~Gtm.~qJ+#US|jJb`A<Y|_T?s2K<CVPh{' );
define( 'WP_CACHE_KEY_SALT', 'NSFD sNh~fj=/3+4+lU$}7mn{^+BkHA/eiWOXZx08@8Ik>||I.s 6ATDH_Osdbk0' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
