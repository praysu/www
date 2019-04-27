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
	if($path[0] == '/') {
		$path = substr($path, 1);
	}
	$_SESSION['location'] = $path;
}

function Status($status, $success = TRUE)
{
	$_SESSION['success'] = $success;
	$_SESSION['status'] = $status;
}

/*
 * 
*/
function Back()
{
	if(isset($_SESSION['location'])) {
		Redirect(WEB . $_SESSION['location']);
	}
	else {
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
	$pagearray = 	['Home', 'Login', 'Register'];
	$required = array(null, null, ['/css/addons/register.css']);
	$page = 'Error';
	if(!is_numeric($identifier)) {
		for($i = 0; $i < count($pagearray); $i++) {
			if(strtolower($pagearray[$i]) == strtolower($identifier)) {
				$page = strtolower($identifier);
				$_SESSION['required'] = $required[$i];
			}
		}
	}
	else if(intval($identifier) < count($pagearray)) {
		$page = $pagearray[intval($identifier)];
		$_SESSION['required'] = $required[intval($identifier)];
	}
	
	return $page;
}

_log('Functions.php Loaded...');