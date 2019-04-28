<?php
require_once('include.php');
_log('Check for login token...');
if(!isset($_SESSION['user']) && isset($_COOKIE['token'])) {
	Redirect(WEB . '/submit/Login.php?token='. $_COOKIE['token']);
}
//die(var_dump($_COOKIE));

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
	<meta property="og:url" content="'. WEB . '/' . $_GET['p'] .'">
	<meta property="og:image" content="'. MIRROR . '/vatican.png' .'">
	
	
	
	<link rel="icon" href="favicon.ico" type="image/png" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	<!--	Additional Requirements   -->
	';
	
	_log('Checking for additional css/js requirements...');
	$pagename = GetPageName($_GET['p']);
	
	_log('Page: '. $pagename);
	
	foreach(Session::Get('required') as $requirement) {
		$ext = pathinfo($requirement, PATHINFO_EXTENSION);
		if($ext == 'css') {
			echo '<link href="'. MIRROR . $requirement .'" rel="stylesheet">
			';
		}
		if($ext == 'js') {
			echo '<script src="'. MIRROR . $requirement .'"></script>
			';
		}
		unset($_SESSION['required']);
	}
	
echo 
'
	<!-- Skin -->
	<link href="'. MIRROR . '/css/themes/praysu.css" rel="stylesheet">
	
	<!-- Main JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://use.fontawesome.com/9d90b2c158.js"></script>

</head>
<body>
<!-- Unused
<video autoplay muted loop id="bgVideo">
		<source src="'. MIRROR .'/video/Plexus.mp4" type="video/mp4">
</video>
-->';
Page::NavBar();
echo '
<main class="container bg-dark" role="main">';


// Main page printing and logic
try {
	switch($pagename) {
		default:
			Page::Home();
		break;
		
		case 'register':
			Page::Register();
		break;
		
		case 'login':
			Page::Login();
		break;
		
		case 'invite':
			Page::Invite();
		break;
	}
	
} catch(Exception $e) {
	echo '<b>Unexpected Error: ' . $e->GetMessage() . '</b>';
}




if(strlen(Session::Get('status')) > 1)
{
	
	_log('Status: ' . Session::Get('status'));

	echo
	'<div class="alert alert-'. (Session::Get('success') ? 'success' : 'danger') .'">' . Session::Get('status') . '</div>';
	
	Status(NULL); // reset status
}
echo
'
</main>
<footer class="footer">
	<div class="container">
		&copy; AECX + Ilyt 2019
	</div>
</footer>
</body>
</html>';


// Finally close the logfile
fclose($GLOBALS['logfile']);