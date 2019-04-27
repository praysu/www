<?php
// General config

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('WWW', dirname(__FILE__));	// Web Root folder /var/www/osu/www

define('LOGFILE', WWW . '/log/' . $_SERVER['REMOTE_ADDR']);

$GLOBALS['logfile'] = fopen(LOGFILE, "w");

define('PROTOCOL', 'http://');
define('WEB', PROTOCOL . 'osu.ppy.sh');		// Web Root
define('AVATAR', PROTOCOL . 'a.ppy.sh');		// Avatar server
define('MIRROR', PROTOCOL . 's.ppy.sh');		// Static url (for css, js, img, etc)

define('CSS', MIRROR . '/css/bootstrap.min.css');
define('JS', MIRROR . '/js/bootstrap.min.js');

// Database config
define('DATABASE_HOST', 'localhost');		// MySQL host. usually localhost
define('DATABASE_USER', 'god');				// MySQL username
define('DATABASE_PASS', 'p@55w0rd');	// MySQL password
define('DATABASE_NAME', 'praysu');				// Database name
define('DATABASE_WHAT', 'host');			// "host" or unix socket path


// Internal config
define('GAMEMODES', array('ctb', 'mania', 'std', 'taiko')); // used for leaderboard, stats, ... iterations etc.

function _log($message)
{
	fwrite($GLOBALS['logfile'], date("Y-m-d H:i:s :: ", time()) . $message . "\n");
}
?>