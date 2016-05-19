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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'worduser');

/** MySQL database password */
define('DB_PASSWORD', 'wordP@ssword');

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
define('AUTH_KEY',         '8?D_>L&B2Pc2^c*(b5VDM};::6VwGa+UyI&Jjv2vvC{1{M1hk!=StiLBrB}aHhpy');
define('SECURE_AUTH_KEY',  'xM9FQ:x)VF2q?)J^?vQ(K_0.eib;9h7%-i>O!!46Ep&2#ryUVU>Q%mRW.r=Kj6fu');
define('LOGGED_IN_KEY',    'lCPIz<OIM)NPZ6K|hDa7)7xI]6t0z^MAj.h;2K2c;nfl{]tMd)8Ejfg{M5&dh>7n');
define('NONCE_KEY',        '@iXN}(?*:NlbU8}`2S} tZbFQs.BO~5{HZh1;[sZ,5Enx6tX&EsmIn{L:#F:/Of(');
define('AUTH_SALT',        'X|{UHA1-BXnP(Y)TzL>2>(ChGjJR6u&3+`~a[(2[^9M0c[CVKF7c6a>fr/$b;sNb');
define('SECURE_AUTH_SALT', '$q5zpe?s9On*k;f`s0OLvo~[M0jc3`3[i4LC>LsWq^<EPZqZEO,]Kf&/=KVV!b>V');
define('LOGGED_IN_SALT',   '90Fd_k1X`ahNc1KPG3JYOi@oDe)vf+zH6|t5&475/pJ+s!3Yds{z#kX(=IYw}@be');
define('NONCE_SALT',       ')rL0a,0tvi]uS&))fyzjl~8Kpaj]bsklN#,-3|KlMU-*Cl+`k}6uOoGlE7tdP9;b');

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

