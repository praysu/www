<?php
session_start();

class Session {
	
	public static function Get($key) {
		return $_SESSION[$key];
	}
	
	public static function Set($key, $val) {
		$_SESSION[$key] = $val;
		return $_SESSION[$key] == $val;
	}
	
	public static function Destroy() {
		session_destroy();
	}
	
}
_log('Session.php Loaded...');
?>