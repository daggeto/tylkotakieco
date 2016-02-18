<h1>Mój Profil</h1>
<?php 
if ($user->verifyLogin())
{
	echo 'Witaj <b>'.$user->userInfo('login').'</b> w swoim profilu!';
	echo '<br /><br />';
	echo '
	<img src="img/star.png" style="position:relative;top:2px;"/> <b>Ilość TenTegowców na głównej:</b> '.$tentego_glowna.'<br />
	<img src="img/stop.png" style="position:relative;top:2px;"/> <b>Ilość TenTegowców w poczekalni:</b> '.$tentego_poczekalnia.'<br />
	<img src="img/newspaper.png" style="position:relative;top:2px;"/> <b>Twój ostatnio dodany TenTego:</b> ';
		if($tentego_glowna+$tentego_poczekalnia != 0) {
			echo '<a href="obrazek.php?'.$tentego_last_uploaded['id'].'">'.$tentego_last_uploaded['title'].'</a>.';
		}
		else {
			echo 'Nie masz jeszcze własnych TenTegowców.';
		}
	echo '<h1>Zmiana Hasła</h1>';
	if(isset($_POST['zmien'])) {
		echo '<div style="padding:10px; text-align:center; color:#FFA500; font-weight:bold;">'.$info.'</div>';
	}
?>
	<form action="" method="post">
	<table>
		<tr>
			<td>Stare hasło:</td>
			<td>
				<input class="pole" type="password" name="stare_haslo">
			</td>
		</tr> 
		<tr>
			<td>Nowe hasło:</td>
			<td>
				<input class="pole" type="password" name="nowe_haslo">
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="zmien" class="button" value="Zmień" />
			</td>
		</tr>
	</table>
	</form>
<?php
}
?>
