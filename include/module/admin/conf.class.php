<?php

	class conf {
		
		var $pobierz;
		
		function query($q) {
			$this->pobierz = mysqli_fetch_array($q);
		}
		function pobierz($row) {
			return $this->pobierz[$row];
		}
		function host() {
			return $_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		}
				
	}
	
?>
