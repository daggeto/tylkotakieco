<h1>Logowanie</h1>
<?php
	if($display_error == 1 && isset($_POST['submit'])) {
		echo '<p>Podano nieprawidłowe dane. Albo pomyliłeś się przy podawaniu prawidłowych danych, albo Twoje konto nie ma odpowiednich uprawnień.</p><a href="login.php">&laquo; Wróć</a>';
	}
	else {
?>
<form action="login.php" method="post">
<table style="margin:0 auto; margin-top:20px;">
	<tr>
		<td>Login:</td>
		<td>
			<input class="pole" type="text" name="login">
		</td>
	</tr> 
	<tr>
		<td>Hasło:</td>
		<td>
			<input class="pole" type="password" name="password">
		</td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align:right;">
			<input type="submit" name="submit" class="button" value="Zaloguj" />
		</td>
	</tr>
</table>
</form>
<?php
	}
?>
