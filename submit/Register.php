<?php
require_once('../include.php');


$params =  ['name', 'password1', 'password2', 'key', 'discord'];

$userRegex = '/^[A-Za-z][A-Za-z0-9]{2,15}$/';
$discordRegex = '/^(.*#[0-9]{4})$/';

try {
	foreach($params as $param) {
		if(!isset($_POST[$param])) {
			throw new Exception('Missing param: '. $param);
		}
	}
	if(!preg_match($userRegex, $_POST['name'])) {
		throw new Exception('Username may only contain a-Z, 0-9 - and _ and must be 3-15 characters long');
	}
	
	if($_POST['password1'] != $_POST['password2']) {
		throw new Exception('Your passwords seem to be different...');
	}
	
	if(strlen($_POST['password1']) > 20) {
		throw new Exception('Your password is too long... (max 20)');
	}
	
	if(!preg_match($discordRegex, $_POST['discord'])) {
		throw new Exception('Invalid Discord tag supplied... (Example: <i>username#1234</i>)');
	}
	
	$invitekey = SQLf('SELECT user.invites,user.key FROM user WHERE user.key = ?', [$_POST['key']]);
	if(!$invitekey) {
		throw new Exception('Invalid key supplied... It might\'ve been used already :/');
	}
	if($invitekey['invites'] <= 0) {
		throw new Exception('The user who invited you has currently no invites left...');
	}
	
	
	// Update original user's key
	$key = RandomString(20);
	
	while(SQLf('SELECT * FROM user WHERE user.key = ?', [$key])) {
		$key = RandomString(20);
	}
	
	_log('Updating key of original user...');
	SQLe('UPDATE user SET invites = invites - 1, invite_success = invite_success + 1, user.key = ? WHERE user.key = ?', [$key, $_POST['key']]);
	
	Location('/Login');
	User::Create($_POST['name'], Password::CreateFromPlain($_POST['password1']), $_POST['discord']);
	Back();
}
catch(Exception $e) {
	Status($e->GetMessage(), false);
	echo $e->GetMessage();
	Back();
}