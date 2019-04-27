<?php
session_start();

class Session {
	
	public static function get($key) {
		return $_SESSION[$key];
	}
	
	public static function set($key, $val) {
		$_SESSION[$key] = $val;
		return $_SESSION[$key] == $val;
	}
	
	public static function destroy() {
		session_destroy();
	}
	
}

?>