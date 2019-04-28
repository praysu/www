<?php

class User
{
	public $id;
	
	public $name;
	
	public $hash;
	
	public $discord;
	
	public $registered;
	
	public $page;
	
	public $status;
	
	public $permissions;
	
	public $permissionsText;
	
	public $key;

	public $invites;
	
	public function __construct($identifier) {
		
		if(!self::Exists($identifier)) {
			throw new Exception('No such user: ' . $identifier);
		}
		
		
		$user = self::Get($identifier);
		
		$this->id = $user['id'];
		$this->name = $user['name'];
		$this->hash = $user['hash'];
		$this->discord = $user['discord'];
		$this->registered = $user['registered'];
		$this->page = $user['page'];
		$this->status = $user['status'];
		$this->permissions = $user['permissions'];
		$this->permissionsText = Permissions::Text($this->permissions);
		$this->key = $user['key'];
		$this->invites = $user['invites'];
		$this->invite_success = $user['invite_success'];
	}
	
	// Creates user using name, hash and discord
	// @return: FALSE or userid
	public static function Create($name, $hash, $discord)
	{
		try {
			// Check some things
			if(self::Exists($name)) {
				throw new Exception('User already registered...');
			}
			
			if(self::ExistsDiscord($discord)) {
				throw new Exception('Discord User already registered...');
			}
			
			$key = RandomString(20);
			
			while(SQLf('SELECT * FROM user WHERE key = ?', [$key])) {
				$key = RandomString(20);
			}
			
			// Try to insert user
			SQLe('INSERT INTO user (`name`, `hash`, `discord`, `key`) VALUES (?, ?, ?, ?)', [$name, $hash, $discord, $key]);
			
			$userid = $GLOBALS['db']->lastInsertId();
			
			$success = self::Exists($userid);
			
			if(!$success) {
				throw new Exception('User('. $name .','. $hash .','. $discord .') could not be created...');
			}
			
			_log('User ' . $userid . ' created...');
			
			foreach(GAMEMODES as $mode) {
				_log('  Creating stats_' . $mode . '...');
				SQLe('INSERT INTO stats_' . $mode . ' (`id`) VALUES (?)', [$userid]);
			}
			
			_log('Done!');
			
			Status('User created, you can now <a href="/Login">log in</a>!', true);
		} catch(Exception $e) {
			_log('Error creating user: '. $e->GetMessage());
			Status($e->GetMessage(), false);
		}
		
	}

	public static function Exists($identifier) {
		return (bool)SQLf('SELECT * FROM user WHERE id = ? OR LOWER(name) = LOWER(?)', [$identifier, $identifier]);
	}
	
	public static function ExistsDiscord($identifier) {
		return (bool) SQLf('SELECT * FROM user WHERE LOWER(discord) = LOWER(?)', [$identifier]);
	}
	
	public static function Get($identifier) {
		return SQLf('SELECT * FROM user WHERE id = ? OR LOWER(name) = LOWER(?)', [$identifier, $identifier]);
	}
}

_log('User.php Loaded...');