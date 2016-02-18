<h1><?php echo $content->getValue("global", "rejestracja"); ?></h1>
<?php
if(isset($_POST['submit'])) {
	echo $info;
}
else {
?>
<form action="rejestracja.php" method="post">
	<p>
            <?php 
                echo $content->getValue("rejestracja", "zapoznajRegulamin")
                        . ' <a href="regulamin.php">'
                        . $content->getValue("rejestracja", "zapoznajRegulamin2")
                        . '</a>.';
            ?>
	</p>
<table>
	<tr>
		<td><?php echo $content->getValue("rejestracja", "login"); ?>:</td>
		<td>
			<input class="pole" type="text" name="login" value="">
		</td>
	</tr> 
	<tr>
		<td><?php echo $content->getValue("rejestracja", "email"); ?>:</td>
		<td>
			<input class="pole" type="text" name="email" value="">
		</td>
	</tr>
	<tr>
		<td><?php echo $content->getValue("rejestracja", "haslo"); ?>:</td>
		<td><input class="pole" type="password" name="password" value=""></td>
	</tr>
	<tr>
		<td><?php echo $content->getValue("rejestracja", "powtozHaslo"); ?>:</td>
		<td>
			<input class="pole" type="password" name="password2" value="">
		</td>
	</tr>
	<tr>
		<td><img src="security_image.php" /></td>
		<td>
			<input class="pole" type="text" name="security_code" />
			<?php echo $content->getValue("rejestracja", "kodObrazka"); ?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td><input type="checkbox" name="regulamin" /> 
                        <?php
                            echo $content->getValue("rejestracja", "akceptuje")
                                    . ' <a href="regulamin.php">' 
                                    . $content->getValue("rejestracja", "akceptuje2")
                                    . '</a>.';
                        ?>
                </td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type="submit" name="submit" class="button" value="<?php echo $content->getValue("rejestracja", "zarejestruj"); ?>" />
		</td>
	</tr>
</table>
</form>
<?php
}
?>
