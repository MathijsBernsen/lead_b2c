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
define( 'DB_NAME', 'lead_b2c' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'UM(a*/usvlDT0pP?%=$pzE6,DdJFbSM~wE{$0^NGMAp&2S9?!6s<FNd/KwUQWC55' );
define( 'SECURE_AUTH_KEY',  'TmU{n3^/Zz6b*4Nev(Kfb01=|JW{$<oPFr*%Jhim<{%1MTb9q}<`&Nf].4TpOah<' );
define( 'LOGGED_IN_KEY',    'SK)g*s+Dz%C2RVxNv_R%{bXQP r,Xta!2<^?n2.6ea^>[h&+CLp!WB1}4DGfTcd%' );
define( 'NONCE_KEY',        '2OAO}9R/fv<viV4_pkW49XZg|ne`X3;-Nadx]FG(6w{Tj#o_y-p`#aaxq_Br9))4' );
define( 'AUTH_SALT',        ';$#;`q8u^:f?{%DYYk,?7OTw@T](;Xv!-yN`n(rJ]ljJ=1B ncx,v`g-t+0cR8uW' );
define( 'SECURE_AUTH_SALT', '@)6F9#-|KY^XY%mXO<v~O>Jmg]wD+HDgvC4`(|Ux)NkND&e,EybFS?es<7DqmfL|' );
define( 'LOGGED_IN_SALT',   '5,]<%{f$dJQ2P|T|;r?@<_ro_Ad;W&G#AbZ!bIL}&WL6TGs}P Gtq)h0Yi]?.*fy' );
define( 'NONCE_SALT',       'yd#FZD6Uq%rf$vO.RXo<9afM#}i[+Lr-IeZ(Hud/%z~Eu ylrkPv~&]--K$5*jy8' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
