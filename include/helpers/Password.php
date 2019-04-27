<?php
class Password {
	public static function CreateFromPlain($plaintext) {
		return password_hash(md5($plaintext), PASSWORD_DEFAULT);
	}
	
	public static function CreateFromMD5($md5hash) {
		return password_hash($md5hash);
	}
	
	public static function Check($plainOrMD5, $salt) {
		$md5 = $plainOrMD5;
		if(strlen($plainOrMD5) < 32)
		{
			// It's not the md5 hash (passwords of length 32 are not possible (limit 20 chars)
			$md5 = md5($plainOrMD5);
		}
		
		return (bool) password_verify($md5, $salt);
	}
	
}
_log('Password.php Loaded...');
?>