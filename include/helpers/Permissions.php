<?php

class Permissions {
	public static function Text($permissions) {
		switch($permissions) {
			case 0:
				$txt = 'User';
			break;
			
			case 2:
				$txt = 'Donor';
			break;
			
			case 4:
				$txt = 'BAT';
			break;
			
			case 8:
				$txt = 'Admin';
			break;
			
			case 16:
				$txt = 'Part of the Holy trinity';
			break;
		}
		
		return $txt;
	}
	
}