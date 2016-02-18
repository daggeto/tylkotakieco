<h1>Użytkownicy</h1>
<?php	
	$users->tabela("user");
	$users->getName('page');
	$users->ileNaStrone(30);
	$query = $users->pobierz();

//SZUKAJKA
echo '<form action="" method="post">
<table>
	<colgroup>
	<col>
	<col>
	</colgroup>
	<tbody><tr>
		<td>Nazwa użytkownika:</td>
		<td><input type="text" class="pole" name="login" style="height:20px;"></td>
		<td><input type="submit" name="szukaj" value="Szukaj" class="button_mini" /></td>
		</tr> 
	</tbody></table>
</form>';

if (isset($_POST['szukaj'])) {
	$login = @htmlspecialchars(mysqli_real_escape_string($db, $_POST['login']));
	$query_search = mysqli_query($db, "SELECT * FROM `user` WHERE `login`='".$login."'");
	$uzytkownik = mysqli_fetch_array($query_search);
	if($uzytkownik['ranga']==0) {$ranga='Użytkownik';} elseif($uzytkownik['ranga']==1) {$ranga='Moderator';} elseif($uzytkownik['ranga']==2) {$ranga='Administrator';}
       if(mysqli_num_rows($query_search) < 1){
		echo '<span class="wynik_wyszukiwania">Wynik wyszukiwania:</span><br/>Nie znaleziono takiego użytkownika.<br/><br/>';
		}
		else {
	echo '<span class="wynik_wyszukiwania">Wynik wyszukiwania:</span> <table width="100%" CELLPADDING="2px" class="tabela">
<tr class="tytul">
<td width="280px">Nazwa użytkownika</td> <td>Email</td> <td width="90px">Ranga</td> <td width="55px">Akcje</td>
</tr>
<tr>
	<td>'.$uzytkownik['login'].'</td> <td>'.$uzytkownik['email'].'</td> <td>'.$ranga.'</td>
	<td>';
	if($uzytkownik['ranga']==0) {
		if($uzytkownik['code'] == 0) {
			echo '<a href="?action=deactive&id='.$uzytkownik['id'].'&amp;t='.$_SESSION['token'].'"><img src="../img/active.png" alt="Aktywowany" /></a>';
		}
		else {
			echo '<a href="?ction=active&id='.$uzytkownik['id'].'&amp;t='.$_SESSION['token'].'"><img src="../img/deactive.png" alt="Nieaktywny" /></a>';
		}
	echo '<a href="?action=moder_on&id='.$uzytkownik['id'].'&amp;t='.$_SESSION['token'].'"><img src="img/award_star_add.png" title="Mianuj Moderatorem"></a>
		  <a href="?action=delete&id='.$uzytkownik['id'].'&amp;t='.$_SESSION['token'].'" onclick="return confirm(\'Czy na pewno chcesz usunąć użytkownika '.$uzytkownik['login'].'?\')"><img src="img/cancel.png" title="Usuń"></a>';	 
	}
	if($uzytkownik['ranga']==1) {
		if($uzytkownik['code'] == 0) {
			echo '<a href="?action=deactive&id='.$uzytkownik['id'].'"><img src="../img/active.png" alt="Aktywowany" /></a>';
		}
		else {
			echo '<a href="?action=active&id='.$uzytkownik['id'].'"><img src="../img/deactive.png" alt="Nieaktywny" /></a>';
		}
	echo '<a href="?action=moder_off&id='.$uzytkownik['id'].'"><img src="img/award_star_delete.png" title="Odbierz Moderatora"></a>
		  <a href="?action=delete&id='.$uzytkownik['id'].'" onclick="return confirm(\'Czy na pewno chcesz usunąć użytkownika '.$uzytkownik['login'].'?\')"><img src="img/cancel.png" title="Usuń"></a>';	 
	}
	if($uzytkownik['ranga']==2) { echo '- - - -'; }
	echo '</td>
	</tr>
	</table><br/><br/>';
  }
}
//KONIEC SZUKAJKI

echo '<table width="100%" CELLPADDING="2px" class="tabela">
<tr class="tytul">
<td width="280px">Nazwa użytkownika</td> <td>Email</td> <td width="90px">Ranga</td> <td width="55px">Akcje</td>
</tr>';

if(mysqli_num_rows($query)) {
	while ($uzytkownik = mysqli_fetch_array($query)) {
	if($uzytkownik['ranga']==0) {$ranga='Użytkownik';} if($uzytkownik['ranga']==1) {$ranga='Moderator';} if($uzytkownik['ranga']==2) {$ranga='Administrator';}
	echo '<tr>
	<td>'.$uzytkownik['login'].'</td> <td>'.$uzytkownik['email'].'</td> <td>'.$ranga.'</td>
	<td>';
	if($uzytkownik['ranga']==0) {
		if($uzytkownik['code'] == 0) {
			echo '<a href="?action=deactive&id='.$uzytkownik['id'].'&amp;t='.$_SESSION['token'].'"><img src="../img/active.png" alt="Aktywowany" title="Dezaktywuj" /></a>';
		}
		else {
			echo '<a href="?action=active&id='.$uzytkownik['id'].'&amp;t='.$_SESSION['token'].'"><img src="../img/deactive.png" alt="Nieaktywny" title="Aktywuj" /></a>';
		}
	echo '<a href="?action=moder_on&id='.$uzytkownik['id'].'&amp;t='.$_SESSION['token'].'"><img src="img/award_star_add.png" title="Mianuj Moderatorem"></a>
		  <a href="?action=delete&id='.$uzytkownik['id'].'&amp;t='.$_SESSION['token'].'" onclick="return confirm(\'Czy na pewno chcesz usunąć użytkownika '.$uzytkownik['login'].'?\')"><img src="img/cancel.png" title="Usuń"></a>';	 
	}
	elseif($uzytkownik['ranga']==1) {
		if($uzytkownik['code'] == 0) {
			echo '<a href="?action=deactive&id='.$uzytkownik['id'].'&amp;t='.$_SESSION['token'].'"><img src="../img/active.png" alt="Aktywowany" title="Dezaktywuj" /></a>';
		}
		else {
			echo '<a href="?action=active&id='.$uzytkownik['id'].'&amp;t='.$_SESSION['token'].'"><img src="../img/deactive.png" alt="Nieaktywny" title="Aktywuj" /></a>';
		}
	echo '<a href="?action=moder_off&id='.$uzytkownik['id'].'&amp;t='.$_SESSION['token'].'"><img src="img/award_star_delete.png" title="Odbierz Moderatora"></a>
		  <a href="?action=delete&id='.$uzytkownik['id'].'" onclick="return confirm(\'Czy na pewno chcesz usunąć użytkownika '.$uzytkownik['login'].'?\')"><img src="img/cancel.png" title="Usuń"></a>';	 
	}
	elseif($uzytkownik['ranga']==2) { echo '- - - -'; }
	echo '</td>
	</tr>';
	}
}

echo' </table>
<div class="strony">';
if($users->getName() != NULL)  $page = $users->getName();
else $page = 1;
if($users->prevStrona()) echo '<a href="?page='.($page-1).'">&lt; Poprzednia</a> ';
$users->strony();
if($users->nextStrona()) echo ' <a href="?page='.($page+1).'">Następna &gt;</a>';
echo '</div>';
?>