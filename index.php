<?php
require_once('include.php');
_log('Starting to build website...');
echo
'<!DOCTYPE html>
<html lang="en-GB">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Praysu!</title>
	
		<meta name="description" content="A Holy osu! Server">
		<meta property="og:title" content="Circle Clicking & Praying">
		<meta property="og:description" content="The holy osu! Server! Catholic circle clicking!">
		<meta property="og:site_name" content="Praysu!">
		<meta property="og:locale" content="en_GB">
		<meta property="og:type" content="website">
		<meta property="og:url" content="'. WEB .'">
		<meta property="og:image" content="'. MIRROR . '/vatican.png' .'">
	
	<link rel="icon" href="favicon.ico" type="image/png" />

	<link href="'. CSS .'" rel="stylesheet">
	<!--	Additional Requirements   -->
	';
	
	_log('Checking for additional css/js requirements...');
	$pagename = GetPageName($_GET['p']);
	
	_log('Page: '. $pagename);
	
	foreach($_SESSION['required'] as $requirement) {
		$ext = pathinfo($requirement, PATHINFO_EXTENSION);
		if($ext == 'css') {
			echo '<link href="'. MIRROR . $requirement .'" rel="stylesheet">
			';
		}
		if($ext == 'js') {
			echo '<script src="'. MIRROR . $requirement .'"></script>
			';
		}
	
	}
	
echo 
'
	<!-- Main JS -->
	<script src="'. JS .'"></script>
</head>
<body>
	';


// Main page printing and logic
try {
	
	
	
} catch(Exception $e) {
	echo '<b>Unexpected Error: ' . $e->GetMessage() . '</b>';
}


if(strlen($_SESSION['status']) > 1)
{
	
	_log('Status: ' . $_SESSION['status']);

	echo
	'<div class="'. ($_SESSION['success'] ? 'success' : 'alert') .'">' . $_SESSION['status'] . '</div>';
	
	Status(NULL); // reset status
}

echo
'
<footer>
	<a href="'. str_replace(WWW, NULL, LOGFILE) .'" target="_blank">Debug</a>
</footer>
</body>
</html>';


// Finally close the logfile
fclose($GLOBALS['logfile']);