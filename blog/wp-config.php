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
define('DB_NAME', 'teach_code');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '|L.c-lNn-PY|mTh8 =8%tOHy/)xZ)g=j$%kf77%^VP=WZ-fR1~D]3GY]a+OuPpJ3');
define('SECURE_AUTH_KEY',  'v{KRryaS*(CJ!u!VJX*,HP:f/a`!1^K9iwuJi,$UYMSzs/;L]2/O5j@2h|@zT#fY');
define('LOGGED_IN_KEY',    '`kBe@b{)DU)r,{vHHg^1:%o,hMZqaw[^pS=W^PK};TGYmp{ 39fC<+U@XeWXL>xa');
define('NONCE_KEY',        '[P|:AcRw:9uzz0k(~5[ ex,U)GU%BUX!7b?R3irD)~eMJuZ*F%dh;%%?vvAu-)_(');
define('AUTH_SALT',        '. B~%%FSIS%^51r?XI{nH; ,;~yQSJv3TevF:n =9]wu#d5Dnf{{_$Mw Sgta~G=');
define('SECURE_AUTH_SALT', 'ouXywb|1&wi07<h5e0h(+5n?tf}`0}7iZK4IVZGn)Pzw15`CY+HGsq`Iv*QYgX^m');
define('LOGGED_IN_SALT',   'Rsg{q_1I}E0x[veA>_]Rw2j, |j>q+J)//qjHA4zjm o^1Bd?uxb8<?jyYAn!`)]');
define('NONCE_SALT',       '`a2qqpj1/MxwOPrNNDS,G0TKyG8rv,L}d`HIUU|MMOJYz8^^z;ZRMjfT},;`[Lz*');

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
