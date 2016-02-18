<?php
if ($user->verifyLogin()) {
	if(isset($_POST['submit_obrazek']) and $_GET['co']=='obrazek') {
		if(!$_POST['tytul'] || !$_FILES['obrazek']['name']) {
			echo '<b>Nie wypełniono pola z tytułem lub obrazkiem!</b><br/><a href="dodaj.php">&laquo; Powrót</a>';
		}
		else {
			//UPLOAD OBRAZKA
			if(filesize($_FILES['obrazek']['tmp_name']) >= $conf->pobierz('max_file_size')) {
				$data_img = date("YmdHis");
				$sp1 = pathinfo($_FILES['obrazek']['name']);
				$uploaddir = 'img/upload/'.$data_img.'.'.$sp1['extension'];
				switch(uploadFile('obrazek','img/upload/', array(1=>'jpg','jpeg','gif','png','JPG','JPEG','GIF','PNG'), 0, $data_img)) {
                                        case 0: echo "Nie wybrano pliku do załadowania!"; break;
                                        case 1: echo "Wgrywanie pliku nie powiodło się."; break;
                                        case 2:
                                                if($sp1['extension'] != "gif" && $sp1['extension']!= "GIF") {
                                                        $image = new SimpleImage();
                                                        $image->load($uploaddir);
                                                        if($image->getWidth() > 670) {
                                                                $image->resizeToWidth(670);
                                                                $image->save($uploaddir);
                                                        }
                                                        else { //jeżeli obrazek jest mniejszy niż limit szerokości to jest kompresowany żeby mniej ważył
                                                                $image->resizeToWidth($image->getWidth());
                                                                $image->save($uploaddir);
                                                        }
                                                }

                                                $tytul = @htmlspecialchars(mysqli_real_escape_string($db, $_POST['tytul']));
                                                $zrodlo = @htmlspecialchars(mysqli_real_escape_string($db, $_POST['zrodlo']));
                                                $autor = $user->userInfo("id");
                                                $data = date('Y-m-d H:i:s');
                                                $wykonaj = mysqli_query($db, "INSERT INTO `shity` (`title`, `img`, `source`, `author`, `data`, `type`) VALUES ('$tytul', '$uploaddir', '$zrodlo', '$autor', '$data', 'obrazek')");

                                                echo "Obiekt został dodany!";
                                                break;
                                        case 3: echo "Niedozwolone rozszerzenie lub typ pliku!"; break;
                                        case 4: echo "Taki plik już istnieje.";
                                }
			}
			else echo "Plik jest za duży.";
			echo '<br /><a href="index.php">&laquo; Strona Główna</a>'; 
		}
	}
else {
?>

<?php
if(@$_GET['co']=='obrazek' || !@$_GET['co'])
{
?>
<div id="tab">
<ul>
	<li id="selected"><a href="dodaj.php?co=obrazek"><img src="img/photo.png" style="position:relative;top:3px;"/> Dodaj Obrazek</a></li>
	<li><a href="dodaj.php?co=film"><img src="img/film.png" style="position:relative;top:3px;"/> Dodaj filmik z YouTube</a></li>
</ul>
</div>
<div id="tab_linia"></div>
<form action="dodaj.php?co=obrazek" method="post" enctype="multipart/form-data">
<table>
					<colgroup>
						<col width="120px;">
						<col>
					</colgroup>
					<tbody><tr>
						<td>Tytuł:</td>
						<td>
							<input class="pole" type="text" name="tytul">
						</td>
					</tr> 
					<tr>
						<td>Obrazek:</td>
						<td>
							<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $conf->pobierz('max_file_size')*1024; ?>" /> <!--maksymalna wielkość pliku w bajtach-->
                            <input name="obrazek" type="file" /> <span style="color:#595959">(max. <?php echo $conf->pobierz('max_file_size'); ?>KB)</span>
						</td>
					</tr>
					<tr>
						<td>Źródło:</td>
						<td><input class="pole" type="tekst" name="zrodlo"></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit_obrazek" class="button" value="Dodaj" />
						</td>
					</tr>
				</tbody></table>
				</form>
<?php
}
else
{
if(isset($_POST['submit_film']) and $_GET['co']=='film') 
{
if(!$_POST['tytul_filmu'] || !$_POST['adres_filmu']) {
	echo '<b>Nie wypełniono pola z tytułem lub adresem filmu!</b><br/><a href="dodaj.php?co=film">&laquo; Powrót</a>';
	}
	else {
	$adres_filmu = @htmlspecialchars(mysqli_real_escape_string($db, trim($_POST['adres_filmu'])));
	if(preg_match('/youtube\.com\/(v\/|watch\?v=)([\w\-]+)/', $adres_filmu))
	{
		$tytul = @htmlspecialchars(mysqli_real_escape_string($db, $_POST['tytul_filmu']));
		$adres_filmu = preg_replace('#&feature=.*#', '',$adres_filmu);
		$autor = $user->userInfo("id");
		$data = date('Y-m-d H:i:s');
	
		$zapytanie = "INSERT INTO `shity` (`title`, `img`, `source`, `author`, `data`, `type`) VALUES ('$tytul', '$adres_filmu', 'YouTube', '$autor', '$data', 'film')"; 
	    $wykonaj = mysqli_query($db, $zapytanie);
		echo '<b>Filmik został pomyślnie dodany!</b><br/>
		<a href="index.php">&laquo; Strona Główna</a>'; 
	} else {
    echo '<b>Link do filmu jest niepoprawny.</b><br/><a href="dodaj.php?co=film">&laquo; Powrót</a>';
}
		}
}
else {
?>
<div id="tab">
<ul>
	<li><a href="dodaj.php?co=obrazek"><img src="img/photo.png" style="position:relative;top:3px;"/> Dodaj Obrazek</a></li>
	<li id="selected"><a href="dodaj.php?co=film"><img src="img/film.png" style="position:relative;top:3px;"/> Dodaj filmik z YouTube</a></li>
</ul>
</div>
<div id="tab_linia"></div>
<form action="dodaj.php?co=film" method="post" enctype="multipart/form-data">
<table>
					<colgroup>
						<col width="120px;">
						<col>
					</colgroup>
					<tbody><tr>
						<td>Tytuł:</td>
						<td>
							<input class="pole" type="text" name="tytul_filmu">
						</td>
					</tr> 
					<tr>
						<td>Adres filmu:</td>
						<td>
							<input class="pole" type="text" name="adres_filmu">  <span style="color:#595959">np. http://www.youtube.com/watch?v=wZZ7oFKsKzY</span>
						</td>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit_film" class="button" value="Dodaj" />
						</td>
					</tr>
				</tbody></table>
				</form>
<?php
		}
	}
}
}
else {
	echo 'Aby dodać nowy obrazek musisz być zalogowany.<br/><br/>
	<a href="login.php" class="button" style="float:left;">Logowanie</a>
	<a href="rejestracja.php" class="button" style="margin-left:10px;float:left;">Rejestracja</a>
	<div style="clear:left;"></div>';
}
?>