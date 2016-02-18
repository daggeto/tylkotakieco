<?php

class users {

	var $db;
	var $db_query;
	var $ile;
	var $table;
	var $get;

	function __construct($db) {
		$this->db = $db;
	}

		function getName($name = NULL) {
			if($name == NULL) {
				return $this->get;
			}
			else {
				if(isset($_GET[$name])) $this->get = $_GET[$name];
			}
		}
		function tabela($db_name) {
			$this->table = $db_name;
			$this->db_query = mysqli_query($this->db, "SELECT * FROM `".$db_name."`");
		}	
		function ileNaStrone($num) {
			$this->ile = $num;
		}
		function pobierz() {
			$a = $this->ile;
			if(isset($this->get)) {
				if($this->get == 1) {
					$query = mysqli_query($this->db, "SELECT * FROM `".$this->table."` ORDER BY `id` DESC LIMIT 0, ".$this->ile);
					return $query;
				}
				else {
					$l_start = ($this->get-1)*$this->ile;
					$l_stop = $this->ile;
					$query = mysqli_query($this->db, "SELECT * FROM `".$this->table."` ORDER BY `id` DESC LIMIT ".$l_start.", ".$l_stop);
					return $query;
				}
			}
			else {
				$query = mysqli_query($this->db, "SELECT * FROM `".$this->table."` ORDER BY `id` DESC LIMIT 0, ".$this->ile);
					return $query;
			}
		}
		function strony() {
			$ile_stron = ceil(mysqli_num_rows($this->db_query)/$this->ile);
			for($i = 1; $i<=$ile_stron; $i++) {
					if(isset($this->get)) {
						if($this->get == $i) echo '['.$i.']';
						else echo '<a href="?page='.$i.'">['.$i.']</a>';
					}
					else {
						if($i == 1) echo '['.$i.']';
						else echo '<a href="?page='.$i.'">['.$i.']</a>';
					}
				if($i < $ile_stron) echo ' ';
			}
		}
		function nextStrona() {
			if(isset($this->get)) $l_start = ($this->get)*$this->ile;
			else $l_start = $this->ile;
			$l_stop = $this->ile;
			$query = mysqli_query($this->db, "SELECT * FROM `".$this->table."` ORDER BY `id` DESC LIMIT ".$l_start.", ".$l_stop);
				if(mysqli_num_rows($query) > 0) return 1;
				else return 0;
		}
		function prevStrona() {
			if(isset($this->get)) {
				$l_start = ($this->get-2)*$this->ile;
				if($l_start < 0) return 0;
				$l_stop = $this->ile;
				$query = mysqli_query($this->db, "SELECT * FROM `".$this->table."` ORDER BY `id` DESC LIMIT ".$l_start.", ".$l_stop);
					if(mysqli_num_rows($query) > 0) return 1;
					else return 0;
			}
			else return 0;
		}
}

?>
