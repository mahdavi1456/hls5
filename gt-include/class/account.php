<?php

class account
{
	public function create_database($dbname)
	{
		$db = new database();
		
		$sql = "CREATE DATABASE '$dbname'";
		$db->ex_query($sql);
	}
	
	public function create_user($dbname, $user)
	{
		$db = new database();
		$sec = new security();
		
		$pass = $sec->create_password();
		$sql = "CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass'";
		$db->ex_query($sql);
		
		$sql2 = "GRANT ALL PRIVILEGES ON '$dbname' TO '$user'@'localhost'";
		$db->ex_query($sql2);

	}
	
}