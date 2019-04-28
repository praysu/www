<?php
require_once('../include.php');


$params =  [];


try {
	// Don't even check for anything
	
	Session::Destroy();
	
	setcookie('token', null, -1, '/');
	
	Location('/Home');
	Status('You\'re no longer logged in!', true);
	Back();
} catch(Exception $e) {
	Status($e->GetMessage(), false);
	echo $e->GetMessage();
	Back();
}