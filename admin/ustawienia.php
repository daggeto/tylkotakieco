<?php
ob_start();
require_once('../connect.php');
require_once('../include/module/admin/conf.class.php');
require_once('../include/module/admin/user.class.php');
require_once('../include/module/admin/ustawienia.class.php');

	//Nazwa strony
	$title = 'Ustawienia';
	
	$conf = new conf();
	$conf->query(mysqli_query($db, "SELECT * FROM `conf` WHERE `id`='1'"));
	$ustawienia = new ustawienia();
	$user = new user($db);
	$user->sessionName('login','password');
	
	if($user->verifyLogin()) {
		$ranga = $user->userInfo('ranga');
		if($ranga!=2) header("Location: login.php");
		else {	
			if(isset($_POST['save'])) { 
				if($_POST['token'] == $_SESSION['token']) {
					$query = mysqli_query($db, "UPDATE `conf` SET `tytul` = '".$_POST['tytul_strony']."', `slogan` = '".$_POST['slogan']."',
					`logo` = '".$_POST['kod_logo']."', `description` = '".$_POST['opis']."', `tags` = '".$_POST['tagi']."',
					`img_na_strone` = '".$_POST['na_jednej_stronie']."', `regulamin` = '".$_POST['regulamin']."', `email` = '".$_POST['email']."',
					`max_file_size`='".$_POST['file_size']."', `img_title`='".$_POST['img_title']."', `req_code`='".$_POST['req_code']."',
					`komentarze` = '".$_POST['komentarze']."', `theme` = '".$_POST['theme']."', `waitingRoom` = '".$_POST['waitingRoom']."' WHERE id='1'") or die(mysql_error());
					if($query) {
						$msg = 'Ustawienia zostały zapisne.';
						header('Location:ustawienia.php?msg='.$msg);	
						}
					else {
						$msg = 'Wystąpił błąd podczas zapisywania danych.';
						header('Location:ustawienia.php?msg='.$msg);	
						}
				} else 	header('Location:ustawienia.php?msg=Błędny token!');	
			}
				
		}
	} else header("Location: login.php");
	

	$_SESSION['token'] = $user->token(16);


require_once('../themes/admin/header.php'); //LOAD header
echo '<div id="content">';
	require_once('../themes/admin/ustawienia.php'); //LOAD content
echo '</div>';
require_once('../themes/admin/footer.php'); //LOAD footer
ob_end_flush();
?>