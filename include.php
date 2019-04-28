<?php
// Global Includes
require_once('config.php');

require_once(WWW . '/include/database.php');
$GLOBALS['db'] = new DBPDO();

_log('Database connected...');

require_once(WWW . '/include/Functions.php');

require_once(WWW . '/include/helpers/Permissions.php');

require_once(WWW . '/include/helpers/Page.php');

require_once(WWW . '/include/helpers/Password.php');


// Include objects
_log('Including objects...');
$files = scandir(WWW . '/include/objects');
foreach($files as $file) {
	if(pathinfo($file, PATHINFO_EXTENSION) == 'php') {
		_log('  ' . $file);
		require_once(WWW . '/include/objects/' . $file);		
	}
}

// Start the sesion
require_once(WWW . '/include/Session.php');