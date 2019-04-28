<?php
require_once('../include.php');


$params =  ['name', 'password'];


try {
	if(isset($_GET['token'])) {
		$tokenuser = SQLf('SELECT * FROM remember WHERE token = ?', [$_GET['token']]);
		if(!$tokenuser) {
			throw new Exception('Invalid token supplied...');
		}		
		$_POST['name'] = $tokenuser['id'];
		$_POST['password'] = ' ';
	}
	
	foreach($params as $param) {
		if(!isset($_POST[$param])) {
			throw new Exception('Missing param: '. $param);
		}
	}
	
	if(!User::exists($_POST['name'])) {
		throw new Exception('No such user...');
	}
	
	$user = new User($_POST['name']);
	
	// Skip password check if token/auto-login
	if(!isset($_GET['token'])) {
		if(!Password::Check($_POST['password'], $user->hash)) {
			throw new Exception('Invalid combination...');
		}
	}
	
	if(isset($_POST['remember'])) {
		_log('Generating new login token for autologin...');
		$token = RandomString(32);
		setcookie('token', $token, time() + (7 * 24 * 60 * 60), '/');
		if(!SQLf('SELECT * FROM remember WHERE id = ?', [$user->id])) {
			SQLe('INSERT INTO remember (`id`, `token`) VALUES (?, ?)', [$user->id, $token]);
		} else {
			SQLe('UPDATE remember SET token = ? WHERE id = ?', [$token, $user->id]);
		}
			
		_log('Done...');
	}
	
	// All good
	
	Session::Set('user', $user);
	Location('/Home');
	Status('You\'re logged in successfully!', true);
	Back();
	
} catch(Exception $e) {
	// reset login remembers
	setcookie('token', null, -1, '/');
	// Purge previous login remembers
	SQLe('DELETE FROM remember WHERE id = ?', [$user->id]);
	_log('Previous logins have been purged...');
	
	Status($e->GetMessage(), false);
	echo $e->GetMessage();
	Back();
}