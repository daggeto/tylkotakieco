<h1><?php $content->getValue("global","profil") ?></h1>
<?php 
if ($user->verifyLogin())
{
	echo $content->getValue("global", "witam") . ' <b>'.$user->userInfo('login').'</b>';
	echo '<br /><br />';
	echo '
	<img src="img/star.png" style="position:relative;top:2px;"/> <b>' . $content->getValue("profil", "iloscWiedzIndex") . ':</b> '.$tentego_glowna.'<br />';
        if($conf->pobierz("waitingRoom") == 1){
            echo '<img src="img/stop.png" style="position:relative;top:2px;"/> <b>' . $content->getValue("profil", "iloscWiedzWait") . ':</b> '.$tentego_poczekalnia.'<br />';
	}
        echo '<img src="img/newspaper.png" style="position:relative;top:2px;"/> <b>' . $content->getValue("profil", "ostatnia") . ':</b> ';
		if($tentego_glowna+$tentego_poczekalnia != 0) {
			echo '<a href="obrazek.php?'.$tentego_last_uploaded['id'].'">'.$tentego_last_uploaded['title'].'</a>.';
		}
		else {
			echo $content->getValue("profil", "niemaWiedz");
		}
	echo '<h1>' . $content->getValue("profil", "zmianaHasla") . '</h1>';
	if(isset($_POST['zmien'])) {
		echo '<div style="padding:10px; text-align:center; color:#FFA500; font-weight:bold;">'.$info.'</div>';
	}
?>
	<form action="" method="post">
	<table>
		<tr>
			<td><?php echo $content->getValue("profil", "stareHaslo"); ?>:</td>
			<td>
				<input class="pole" type="password" name="stare_haslo">
			</td>
		</tr> 
		<tr>
			<td><?php echo $content->getValue("profil", "noweHaslo"); ?>:</td>
			<td>
				<input class="pole" type="password" name="nowe_haslo">
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="zmien" class="button" value="<?php echo $content->getValue("profil", "zmien"); ?>" />
			</td>
		</tr>
	</table>
	</form>
<?php
}
?>
