<?php
//adModule.php
function adModule($db) {
	global $int_i;
	if(!isset($int_i)) $int_i = 1;
	$query = mysqli_query($db, "SELECT * FROM `reklama` WHERE `pod_obrazkiem`='".$int_i."'");
	if(mysqli_num_rows($query) > 0) {
		while($ad = mysqli_fetch_array($query)) {
			echo '<div class="shit">'.$ad['kod'].'</div>';
		}
	}
	$int_i++;
}

?>
