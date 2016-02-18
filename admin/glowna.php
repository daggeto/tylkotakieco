<?php
ob_start();
require_once('../connect.php');
require_once('../include/module/admin/conf.class.php');
require_once('../include/module/admin/user.class.php');
require_once('../include/module/admin/glowna.class.php');

	//Nazwa strony
	$title = 'Główna';

	$conf = new conf();
	$conf->query(mysqli_query($db, "SELECT * FROM `conf` WHERE `id`='1'"));
	$obj = new glowna($db);
	$user = new user($db);
	$user->sessionName('login','password');
	
	if($user->verifyLogin()) {
		$ranga = $user->userInfo('ranga');
		if(!$ranga) {
			header("Location: login.php");
			}
		else {
			if(!empty($_GET['action']) && !empty($_GET['id']) && !empty($_GET['t'])) {
			//USUWANIE OBIEKTU TYPU OBRAZEK
			if($_GET['action']=='delete' && is_numeric($_GET['id']) && $_GET['t'] === $_SESSION['token']) {
			$filename = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `".$img_table."` WHERE id='".$_GET['id']."'"));
			$query_action = mysqli_query($db, "DELETE FROM `".$img_table."` WHERE id=".$_GET['id']) or die(mysql_error());
				if($query_action) {
					unlink('../'.$filename['img']);
					$msg = 'Obrazek został poprawnie usunięty.';
					header('Location:glowna.php?msg='.$msg);
				}
				else {
					$msg = 'Wystąpił błąd podczas usuwania obrazka.';
					header('Location:glowna.php?msg='.$msg);
				}
			}
			
			//USUWANIE OBIEKTU TYPU FLASH
			if($_GET['action']=='delete_flash' && is_numeric($_GET['id']) && $_GET['t'] === $_SESSION['token']) {
			$query_action = mysqli_query($db, "DELETE FROM `".$img_table."` WHERE id=".$_GET['id']) or die(mysql_error());
				if($query_action) {
					$msg = 'Obiekt flash został poprawnie usunięty.';
					header('Location:glowna.php?msg='.$msg);
				}
				else {
					$msg = 'Wystąpił błąd podczas usuwania obiektu flash.';
					header('Location:glowna.php?msg='.$msg);
				}
			}
		
			//WRZUCENIE OBIEKTU DO POCZEKALNI
			if($_GET['action']=='waiting' && is_numeric($_GET['id']) && $_GET['t'] === $_SESSION['token']) {
			$query_action = mysqli_query($db, "UPDATE `".$img_table."` SET `is_waiting`='1' WHERE id=".$_GET['id']) or die(mysql_error());
				if($query_action) {
					$msg = 'Obiekt został przeniesiony do poczekalni.';
					header('Location:glowna.php?msg='.$msg);
				}
				else {
					$msg = 'Nie udało się przenieść obiektu do poczekalni.';
					header('Location:glowna.php?msg='.$msg);
				}
			}
			
			}
			}
		}
	else header("Location: login.php");
																			  
	$_SESSION['token'] = $user->token(16);
	
require_once('../themes/admin/header.php'); //LOAD header
echo '<div id="content">';
	require_once('../themes/admin/glowna.php'); //LOAD content
echo '</div>';
require_once('../themes/admin/footer.php'); //LOAD footer
ob_end_flush();
?>