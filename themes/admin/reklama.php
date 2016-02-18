<h1>Reklama</h1>
<form action="?" method="post">
<table>
					<tr>
						<td>Włączyć reklamy?</td>
						<td>
							<select name="reklama">
							<option value="1" <?php if($conf->pobierz('reklama')){echo 'selected';} ?> >Tak</option>
							<option value="0" <?php if(!$conf->pobierz('reklama')){echo 'selected';} ?> >Nie</option>
							</select>
						</td>
					</tr>
</table>
							<input type="submit" name="add_next" value="Dodaj następną" class="button_mini" />
<?php
$pob_rekl = mysqli_query($db, "SELECT * FROM `reklama`");
$i = 0;
while($rekl = mysqli_fetch_array($pob_rekl)) {
echo'
<table class="shit">
					<colgroup>
						<col width="120px;">
						<col>
					</colgroup>
					<tbody>
					<tr>
						<td>Kod reklamy:</td>
						<td>
							<input type="hidden" name="id_'.$i.'" value="'.$rekl['id'].'" />
							<textarea style="height:70px;"  name="kod_reklamy_'.$i.'">'.$rekl['kod'].'</textarea>
						</td>
					</tr>
					<tr>
						<td>Wyświetlana pod</td>
						<td>
							<input class="pole" style="width:22px;" type="text" name="pod_obrazkiem_'.$i.'" value="'.$rekl['pod_obrazkiem'].'"> obiektem
						</td>
					</tr>
					<tr>
						<td><a href="?del='.$rekl['id'].'" class="button_mini">Usuń</a></td>
						<td></td>
					</tr>
				</tbody></table><br />
';
$i++;
}
?>
			<table>				
					<tr>
						<td><input type="hidden" name="token" value="<?php echo @$_SESSION['token']; ?>" /></td>
						<td>
							<input type="submit" name="save" value="Zapisz" class="button_mini" />
						</td>
					</tr>
			</table>
				</form>