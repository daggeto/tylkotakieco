<?php
	$ex = explode("?",$_SERVER['REQUEST_URI']);
	$ex = explode("&", $ex[1]);
	$id = preg_replace("/[^0-9]/", "", htmlspecialchars($ex[0]));
	$tekst = $content->getValue("tekst", "tekst_" . $id);


        echo'<div class="shit">';
            echo $tekst;
        echo '</div>'
?>
