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
define( 'DB_NAME', 'test' );

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
define( 'AUTH_KEY',         'uazA2h[a=,&j?dmV1(lEF5,dU9m4]OhcY:f%P(LgvzFY:}Qfq>zwfi^S?Wt;fBxQ' );
define( 'SECURE_AUTH_KEY',  'ysDh-$:YOq5}X*7<ah0%i{nf$@A3(A` M>R87H`(?}_5-}#ygpT]k?U/tqF?pveQ' );
define( 'LOGGED_IN_KEY',    'ML#z6t7fm@DfdXP2{|=IfXmRA)aV_t7^q/YZa1SCK %.kYZDtz8E$.TXYz-I2(1H' );
define( 'NONCE_KEY',        'MCE?u297r<CbFBwvC;{Se,EO~%8%J?oi0.CJc|^`r8)jVErK}*-.%>w(`v/LNiwS' );
define( 'AUTH_SALT',        '_ 0MA0EqD*;-x<U^bZ{#|;egUaTIFzerL7Ix.1VY=k!,tf[K@V@v9U4$xo3&hl?]' );
define( 'SECURE_AUTH_SALT', '+W(ByYlphsOpPe]81^^%Q,mta|{tNj*)j%0IHb8M%l]eH|oNr0k~uN_8>cpB]mX?' );
define( 'LOGGED_IN_SALT',   'Tmm-.hGOnzW&9v9CO*TowkBPm)|^HlJdy>#8hKYYQLF03bt?:Ell1VT]po#g)eWl' );
define( 'NONCE_SALT',       'SuGO@NZ@R`%:ki=<yyvRW2pVn.8*=3vbW,S/^k/>5TF!cYru/yCKKItP-b6Nsu_n' );

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
