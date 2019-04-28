<?php
/*
 * SQLf -> fetch() wrapper
*/
function SQLf($query, $vars = null)
{
	return $GLOBALS['db']->fetch($query, $vars);
}

/*
 * SQLfa -> fetchAll() wrapper
*/
function SQLfa($query, $vars = null)
{
	return $GLOBALS['db']->fetchAll($query, $vars);
}

/*
 * SQLe -> execute() wrapper
*/
function SQLe($query, $vars = null)
{
	return (bool) $GLOBALS['db']->execute($query, $vars);
}

/*
 * Absolute overwrites a pre-defined base
*/
function Redirect($location)
{
	Header('Location: ' . $location);
	exit();
}

function Location($path)
{
	if($path[0] != '/') {
		$path = '/' . $path;
	}
	Session::Set('location', $path);
}

function Status($status, $success = TRUE)
{
	Session::Set('success', $success);
	Session::Set('status', $status);
}

/*
 * 
*/
function Back()
{
	if(isset($_SESSION['location'])) {
		Redirect(WEB . Session::Get('location'));
	}
	else {
		Status('You weren\'t meant to be here... We\'ll put you back home just in case...', false);
		Redirect(WEB);
	}
}

/*
 * Self explaining
*/ 
function RandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/*
 * Get Name of a given page id or name
*/
function GetPageName($identifier)
{
	$pagearray = 	['Home', 'Register', 'Login', 'Invite'];
	$required = array(null, 
						['/css/addons/register.css'],
						['/css/addons/register.css'],
						null);
	$page = 'Error';
	if(!is_numeric($identifier)) {
		for($i = 0; $i < count($pagearray); $i++) {
			if(strtolower($pagearray[$i]) == strtolower($identifier)) {
				$page = strtolower($identifier);
				Session::Set('required', $required[$i]);
			}
		}
	}
	else if(intval($identifier) < count($pagearray)) {
		$page = $pagearray[intval($identifier)];
		Session::Set('required', $required[intval($identifier)]);
	}
	
	return $page;
}

_log('Functions.php Loaded...');