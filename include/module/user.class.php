<?php
	class user {

		var $db;
		var $s_login;
		var $s_pass;

		function __construct($db) {
			$this->db = $db;
		}

		function sessionName($login, $pass) {
				$this->s_login = $login;
				$this->s_pass = $pass;
		}
		
		function sessionSet($login, $pass, $submit) {
			if(isset($_POST[$submit])) {
				$_SESSION[$this->s_login] = mysqli_real_escape_string($this->db, $_POST[$login]);
				$_SESSION[$this->s_pass] = md5(mysqli_real_escape_string($this->db, $_POST[$pass]));
			}
		}
			
		function verifyLogin() {
			if(isset($_SESSION[$this->s_login]) && isset($_SESSION[$this->s_pass])) {
				$query = mysqli_query($this->db, "SELECT * FROM `user` WHERE `login`='".$_SESSION[$this->s_login]."' AND `haslo`='".$_SESSION[$this->s_pass]."' AND `code`='0'");
					if(mysqli_num_rows($query) == 0) {
						unset($_SESSION[$this->s_login]);
						unset($_SESSION[$this->s_pass]);
						return 0;
					}
					else if(mysqli_num_rows($query) == 1) return 1;
			}
		}
		function userInfo($col) {
			if(isset($_SESSION[$this->s_login]) && isset($_SESSION[$this->s_pass])) {
				$query = mysqli_fetch_array(mysqli_query($this->db, "SELECT * FROM `user` WHERE `login`='".$_SESSION[$this->s_login]."' AND `haslo`='".$_SESSION[$this->s_pass]."'"));
				return $query[$col];
			}
		}
		function sessionRelog($login, $pass) {
				$_SESSION[$this->s_login] = mysqli_real_escape_string($this->db, $login);
				$_SESSION[$this->s_pass] = md5(mysqli_real_escape_string($this->db, $pass));
		}
	}
?>
