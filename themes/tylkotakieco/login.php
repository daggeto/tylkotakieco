<h1><?php echo $content->getValue("global", "loguj"); ?></h1>
<?php
	if($display_error == 1 && isset($_POST['submit'])) {
		echo '<p>' . $content->getValue("loguj", "nieprawidlowo") . '</p><a href="login.php">&laquo; ' . $content->getValue("global", "powrot") . '</a>';
	}
	else {
?>
<form action="login.php" method="post">
	<p><?php echo $content->getValue("loguj", "witaj"); ?></p>
<table style="margin:0 auto; margin-top:20px;">
	<tr>
		<td><?php echo $content->getValue("rejestracja", "login"); ?>:</td>
		<td>
			<input class="pole" type="text" name="login">
		</td>
	</tr> 
	<tr>
		<td><?php echo $content->getValue("rejestracja", "haslo"); ?>:</td>
		<td>
			<input class="pole" type="password" name="password">
		</td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align:right;">
			<input type="submit" name="submit" class="button" value="<?php echo $content->getValue("global", "loguj"); ?>" />
		</td>
	</tr>
</table>
</form>
<?php
	}
?>
