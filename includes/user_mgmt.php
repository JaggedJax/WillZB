<?php

  /*****************************************************************
  *                      |                 |                       *
  *                      \-----------------/                       *
  * Script: user_mgmt.php                                          *
  * Author: William Wynn                                           *
  * Date: 08/12/11                                                 *
  *                                                                *
  * Functions for user management                                  *
  *                                                                *
  * Sign Date     Change                                           *
  * xxxx xx/xx/xx xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx *
  *****************************************************************/

class user_mgmt
{
	//*************************************************************************
	// Object constructor
	//*************************************************************************
	function __construct()
	{
	
	}
	
	//*************************************************************************
	// Authenticate and return info for user (login)
	//*************************************************************************
	public function authenticate($username, $password){
		$username = strtolower(trim($username));
		$file = "configs/users/$username.user";
		if (file_exists($file))
			list($salt, $encryptedPW, $id, $level, $name) = explode("\n", file_get_contents($file));
		else
			return false;
		if ($encryptedPW == $this->pw_hash($password, $salt)){
			return array("id" => $id, "name" => $name, "user_level" => $level);
		}
		else
			return false;
	}
	
	//*************************************************************************
	// Create new user if one doesn't already exist
	//*************************************************************************
	public function new_user($username, $password, $level){
		$name = trim($username);
		$username = strtolower(trim($username));
		$file = "configs/users/$username.user";
		if (!file_exists($file)){
			$salt = $this->salt();
			$pw = $this->pw_hash($password, $salt);
			$id = $this->rand_string(5);
			try{
				$fh = fopen($file, 'w');
				fwrite($fh, $salt."\n".$pw."\n".$id."\n".$level."\n".$name);
				fclose($fh);
			}catch (Exception $e){
				return "Couldn't create user. Bad permissions.";
			}
			return true;
		}
		else
			return "Username already exists";
	}
	
	//*************************************************************************
	// Delete specified user
	//*************************************************************************
	public function delete_user($username){
		if (unlink("configs/users/$username.user"))
			return true;
		else
			return false;
	}
	
	//*************************************************************************
	// Get details for specified user
	//*************************************************************************
	public function user_details($username){
		$username = strtolower(trim($username));
		$file = "configs/users/$username.user";
		list($salt, $encryptedPW, $id, $level, $name) = explode("\n", file_get_contents($file));
		return array("id" => $id, "name" => $name, "user_level" => $level);
	}
	
	//*************************************************************************
	// Change user's password
	//*************************************************************************
	public function change_password($username, $newPW){
		$username = strtolower(trim($username));
		$file = "configs/users/$username.user";
		list($salt, $encryptedPW, $id, $level, $name) = explode('\n', file_get_contents($file));
		$salt = $this->salt();
		$pw = $this->pw_hash($password, $salt);
		try{
			$fh = fopen($file, 'w');
			fwrite($fh, $salt."\n".$pw."\n".$id."\n".$level."\n".$name);
			fclose($fh);
		}catch (Exception $e){
			return "Couldn't change password.";
		}
		return true;
	}
	
	//*************************************************************************
	// Change user's level
	//*************************************************************************
	public function change_level($username, $newLevel){
		$username = strtolower(trim($username));
		$file = "configs/users/$username.user";
		list($salt, $encryptedPW, $id, $level, $name) = explode('\n', file_get_contents($file));
		$level = $newLevel;
		try{
			$fh = fopen($file, 'w');
			fwrite($fh, $salt."\n".$encryptedPW."\n".$id."\n".$level."\n".$name);
			fclose($fh);
		}catch (Exception $e){
			return "Couldn't change user's level.";
		}
		return true;
	}
	
	//*************************************************************************
	// List all users
	//*************************************************************************
	public function list_users(){
		$users = array();
		$handler = opendir("configs/users/");
		while ($file = readdir($handler)) {
			if ($file != "." && $file != "..")
				$users[] = substr($file, 0, -5);
		}
		return $users;
	}

	//*************************************************************************
	// Generate random alpha-numeric string of specified length
	//*************************************************************************
	public function rand_string($length) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$string = '';
		mt_srand($this->make_seed());
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}
		return $string;
	}
	
	//*************************************************************************
	// Generate salt of length 12
	//*************************************************************************
	public function salt() {
		$length = 12;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-+[]{}.,?~';
		$string = '';    
		mt_srand($this->make_seed());
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}
		return $string;
	}
	
	//*************************************************************************
	// Generate password hash
	//*************************************************************************
	public function pw_hash($string, $salt){
		return md5($string.$salt);
	}
	
	//*************************************************************************
	// Generate a seed based of the time
	//*************************************************************************
	private function make_seed() {
		list($usec, $sec) = explode(' ', microtime());
		return (float) $sec + ((float) $usec * 100000);
	}
	
}
?>