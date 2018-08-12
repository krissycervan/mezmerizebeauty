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
define('DB_NAME', 'mezmerizedb');

/** MySQL database username */
define('DB_USER', 'mezmerize');

/** MySQL database password */
define('DB_PASSWORD', 'koochi');

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
define('AUTH_KEY',         'Sq6(dSF7J(>AJ-,)~Ye!z<~~!d+,+k+`4oU<[Pl)Y(N_E:}.GykJTe26LApwQ}lO');
define('SECURE_AUTH_KEY',  'WgYIjb@f|NDb%|f;XC@Tz/5v:Z~xW{V9!71FGR=`W_CxHZvhPI@>2Zb9}AuIeOV<');
define('LOGGED_IN_KEY',    'd3uz[{z15OH*b<:VV(!ZAy%T^ANnn]J3f}6)80vc=r}u]P=hdrG}}Oh,mbt|P3Np');
define('NONCE_KEY',        'tY4<mq~Q[3Pq_}mrDP?b%uavotV5k%v0:R[2|iMl~bghE~a(xH8a 2)HFQhtn7`&');
define('AUTH_SALT',        'uOtCunCqD@Qx=9KIsdPMdK25ndCT:n]yvTL6sx`j9bFw9y.TF-:2(l$Ph$42 q@}');
define('SECURE_AUTH_SALT', '&(z2N50KKp4:#WQne|VJ]Y[GiF~Hk Mv2^G,5<1GZ5u0{}o;AhmNQh4;3lBG^aB6');
define('LOGGED_IN_SALT',   '@G^`J#pXN`8X=]RlHxbf=%DNGP|(rh@VtdqwZMv k>yC#fbQ)Gce/kX~9(@4Tm^K');
define('NONCE_SALT',       'R4[x|+Ti~^+M`cWPfCP+g>=l)ZIPUZ; %D&j0~hxZUx05-bhVC?;!hqS36+`c]`$');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
