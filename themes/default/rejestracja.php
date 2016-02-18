<h1>Rejestracja</h1>
<?php
if(isset($_POST['submit'])) {
	echo $info;
}
else {
?>
<form action="rejestracja.php" method="post">
	<p>
		Zanim rozpoczniesz proces rejestracji zapoznaj się z treścią regulaminu dostępnego <a href="regulamin.php">tutaj</a>.
	</p>
<table>
	<tr>
		<td>Login:</td>
		<td>
			<input class="pole" type="text" name="login" value="">
		</td>
	</tr> 
	<tr>
		<td>E-mail:</td>
		<td>
			<input class="pole" type="text" name="email" value="">
		</td>
	</tr>
	<tr>
		<td>Hasło:</td>
		<td><input class="pole" type="password" name="password" value=""></td>
	</tr>
	<tr>
		<td>Powtórz hasło:</td>
		<td>
			<input class="pole" type="password" name="password2" value="">
		</td>
	</tr>
	<tr>
		<td><img src="security_image.php" /></td>
		<td>
			<input class="pole" type="text" name="security_code" />
			Przepisz kod z obrazka
		</td>
	</tr>
	<tr>
		<td></td>
		<td><input type="checkbox" name="regulamin" /> Akceptuję <a href="regulamin.php">regulamin</a>.</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type="submit" name="submit" class="button" value="Zarejestruj" />
		</td>
	</tr>
</table>
</form>
<?php
}
?>
