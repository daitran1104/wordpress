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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '~~)+_+xG%D?Y85nu+|DJaBy]%U+6z--!mYLTfmT^!ASFu@M;`2.Q3akv[&qqhI++');
define('SECURE_AUTH_KEY',  'lib0OZ9qwk=hYMKA?^ A1mQzuBDr6l}i*.eBN|+Zps!t&*yt*B(pc}DlMAT01rP^');
define('LOGGED_IN_KEY',    '^X#mBuzE(:5TNDEQ}K|x3D280YIw.#=Xpx ,z4f_<>hHgdLzXl/0JmsU#<fl:LE|');
define('NONCE_KEY',        '8N9rwA_&*#^`bLP-I7[+smp[Y#wg~Fgt=MTdktemtnBXoo+9SWk<p+HAwo!k,yyd');
define('AUTH_SALT',        'mm{{^M~K{f6X8ZT[b#2Z$?<)7WFR9L4^Ab0Ee>|4Eo4X-2bw7%q#w1./t$~pf%?P');
define('SECURE_AUTH_SALT', 'H:9Gz}oD|vDh#L9#ukrN:,-cqW@=G<b%)OwqI^0lI>ncm:zA2Tr!#I*dPO)<p!N[');
define('LOGGED_IN_SALT',   'S-C y<<!VJu>,|]IW.He84Z]MyL_<_xp06%i#]m<&=Jz6O5xn}aJKt? Pr`xGKG<');
define('NONCE_SALT',       '?+$yA]:bhpIUDXb4{C``wqNOWl,0$zGtKJ#$2-%PeiuJIEIEuyw(tsg-aUSRHx6b');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_trandai';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
