<h1>Logowanie</h1>
<?php
	if($display_error == 1 && isset($_POST['submit'])) {
		echo '<p>Podano nieprawidłowe dane. Albo pomyliłeś się przy podawaniu prawidłowych danych, albo Twoje konto nie zostało jeszcze aktywowane.</p><a href="login.php">&laquo; Wróć</a>';
	}
	else {
?>
<form action="login.php" method="post">
	<p style="font-size:14px;">Witaj użytkowniku. Zanim się zalogujesz, zapoznaj się z treścią regulaminu obowiązującego na tej stronie. Nagminne łamanie jego punktów powoduje zawieszenie, bądź zablokowanie konta co jest równoznaczne z brakiem możliwości dostępu do treści dostępnych dla zalogowanych użytkoników.</p>
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
