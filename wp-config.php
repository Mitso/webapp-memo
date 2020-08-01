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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'webapp' );

/** MySQL database username */
define( 'DB_USER', 'wp_admin' );

/** MySQL database password */
define( 'DB_PASSWORD', '80zFKerfnkZFmewc' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'n`ob8:dm%aZm:D/?>8*J~a3[?HaRGBRf7E=KhsVoK^WEks6cI7{p&.3+ThR)||aS' );
define( 'SECURE_AUTH_KEY',  '8,j >;.}peJDH;T SoG7mjW.:,%m M.%=vP:$^+qwZA,rjR.tk:xTbr|Bx=pnLn~' );
define( 'LOGGED_IN_KEY',    '8Z,A|a80RRluM@NrB]z Aq jCU!!S}sMPv6LHbLypaoiR5y]3+b4At=6usqgfZcc' );
define( 'NONCE_KEY',        '@Qb*UGI~H3LYW}2R]W~jG6K4|_ ;{BD_ansh{+koU@`yAg{>4<0Sk&,`5sOT0,)c' );
define( 'AUTH_SALT',        'W8.{hKQ0WUuyQ_7d|Ya%72Er3}e]?-DGPUCC_0_V70$<{=8,s!:Ov+K.L.(9<jY$' );
define( 'SECURE_AUTH_SALT', ',gx2k2H+3H^F`xQ$Tg;Pa37)RvqK*R }VHB^JI #-c3``_{v!~|7) f)WY_EM@9V' );
define( 'LOGGED_IN_SALT',   'G4E_sS26Alh<5(i;?]{4*u*D5mq;f*7R:2N2dzX}`cOc+y7ej?xW/ btZp/xsbH&' );
define( 'NONCE_SALT',       'SD:0)3QZ](N?Lrz8J{-_I<B!IUW,+k5XGhF~]p;V.^>dOetj<SFcW(oAh+18t:tK' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
