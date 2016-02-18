<h1>Ustawienia</h1>
<form action="?" method="post">
<table>
					<colgroup>
						<col width="180px;">
						<col>
					</colgroup>
					<tbody><tr>
						<td>Tytuł strony:</td>
						<td>
							<input class="pole" type="text" name="tytul_strony" value="<?php echo $conf->pobierz("tytul"); ?>">
						</td>
					</tr> 
					<tr>
						<td>Slogan:</td>
						<td>
							<input class="pole" type="text" name="slogan" value="<?php echo $conf->pobierz("slogan"); ?>">
						</td>
					</tr>
					<tr>
					<tr>
						<td>Kod logo:</td>
						<td>
							<textarea style="height:70px;"  name="kod_logo"><?php echo $conf->pobierz("logo"); ?></textarea>
						</td>
					</tr>
					<tr>
						<td>Opis strony:</td>
						<td>
							<input class="pole" type="text" name="opis" value="<?php echo $conf->pobierz("description"); ?>">
						</td>
					</tr>
					<tr>
						<td>Słowa kluczowe:</td>
						<td>
							<input class="pole" type="text" name="tagi" value="<?php echo $conf->pobierz("tags"); ?>">
						</td>
					</tr>
					<tr>
						<td>Szablon:</td>
						<td>
						<?php
						echo '<select name="theme">';
						$ustawienia->cat_list('themes');
						for( $x = 0, $cnt = count($katalogi); $x < $cnt; $x++ ) {
						if($katalogi[$x]!='admin') {
							echo '<option';
								if($conf->pobierz('theme')==$katalogi[$x]) { echo ' selected'; }
							echo '>'.$katalogi[$x];
							echo '</option>';
							}
						}
						echo '</select>';
						?>	
						</td>
					</tr>
					<tr>
						<td>Obiektów na jednej stronie:</td>
						<td>
							<input class="pole" style="width:22px;" type="text" name="na_jednej_stronie" value="<?php echo $conf->pobierz("img_na_strone"); ?>">
						</td>
					</tr>
					<tr>
						<td>Maksymalny rozmiar pliku (w KB):</td>
						<td>
							<input class="pole" type="text" name="file_size" value="<?php echo $conf->pobierz("max_file_size"); ?>">
						</td>
					</tr>
					<tr>
						<td>Tytuł nad obiektem:</td>
						<td>
							<select name="img_title">
								<option value="1"<?php if($conf->pobierz("img_title")) { echo "selected"; } ?>>Tak</option>
								<option value="0"<?php if(!$conf->pobierz("img_title")) { echo "selected"; } ?>>Nie</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Regulamin:</td>
						<td>
							<textarea name="regulamin"><?php echo $conf->pobierz("regulamin"); ?></textarea>
						</td>
					</tr>
					<tr>
					<tr>
						<td>Email kontaktowy:</td>
						<td>
							<input class="pole" type="text" name="email" value="<?php echo $conf->pobierz("email"); ?>">
						</td>
					</tr>
					<tr>
					<tr>
						<td>Włączyć komentarze?</td>
						<td>
							<select name="komentarze">
								<option value="1"<?php if($conf->pobierz("komentarze")) { echo "selected"; } ?>>Tak</option>
								<option value="0"<?php if(!$conf->pobierz("komentarze")) { echo "selected"; } ?>>Nie</option>
							</select>
							</td>
					</tr>
					<tr>
						<td>Aktywacja konta przez email:</td>
						<td>
							<select name="req_code">
								<option value="1"<?php if($conf->pobierz("req_code")) { echo "selected"; } ?>>Tak</option>
								<option value="0"<?php if(!$conf->pobierz("req_code")) { echo "selected"; } ?>>Nie</option>
							</select>
						</td>
					</tr>
                                        <tr>
						<td>Poczekalnia:</td>
						<td>
                                                    <select name="waitingRoom">
                                                            <option value="1"<?php if($conf->pobierz("waitingRoom")) { echo "selected"; } ?>>Wlącz</option>
                                                            <option value="0"<?php if(!$conf->pobierz("waitingRoom")) { echo "selected"; } ?>>Wyłącz</option>
                                                    </select>
						</td>
					</tr>
					<tr>
						<td><input type="hidden" name="token" value="<?php echo @$_SESSION['token']; ?>" /></td>
						<td>
							<input type="submit" name="save" value="Zapisz" class="button_mini" />
						</td>
					</tr>
	</tbody></table>
</form>