<?php

	include_once("adb.php");
	
	class query_functions extends adb{
		function query_functions(){
			adb::adb();
		}
		/**
		*@return if successful true else false
		*/

		//Login Query
		function login_user($username, $password){
		
			$query="SELECT * FROM ge_users WHERE username='$username' AND password=MD5('$password')";

			 if(!$this->query($query)){
				return false;
			}
			return $this->fetch();
		}
		
	}
?>