<?php

class ustawienia {


	function cat_list($katalog) {
		global $katalogi;
	 
		$dir = opendir('../'.$katalog);
		while ($file = readdir($dir)) {
			if ($file != "." && $file != "..") {
				$katalogi[] = $file;
			}
		}

	}

	
}

?>