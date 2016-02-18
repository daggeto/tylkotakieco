<?php
ob_start();
require_once('../connect.php');
require_once('../include/module/admin/conf.class.php');
require_once('../include/module/admin/user.class.php');
require_once('../include/module/admin/users.class.php');

	//Nazwa strony
	$title = 'Użytkownicy';

	$conf = new conf();
	$conf->query(mysqli_query($db, "SELECT * FROM `conf` WHERE `id`='1'"));
	$users = new users($db);
	$user = new user($db);
	$user->sessionName('login','password');
	
	if($user->verifyLogin()) {
		$ranga = $user->userInfo('ranga');
		if($ranga!=2) {
			header("Location: login.php");
			}
		else {
		
			if(!empty($_GET['action']) && !empty($_GET['id']) && !empty($_GET['t'])) {
				//MIANOWANIE MODERATOREM
				if($_GET['action']=='moder_on' && is_numeric($_GET['id']) && $_GET['t']===$_SESSION['token']) {
				   mysqli_query($db, "UPDATE user SET ranga='1' WHERE id='".$_GET['id']."'") or die(mysql_error());
					$msg = 'Użytkownik został mianowany Moderatorem.';
					header('Location:users.php?msg='.$msg);
				}
				//ODEBRANIE MODERATORA
				if($_GET['action']=='moder_off' && is_numeric($_GET['id']) && $_GET['t']===$_SESSION['token']) {
				   mysqli_query($db, "UPDATE user SET ranga='0' WHERE id='".$_GET['id']."'") or die(mysql_error());
					$msg = 'Użytkownikowi została odebrana funkcja Moderatora.';
					header('Location:users.php?msg='.$msg);
				}
				//USUNIĘCIE UŻYTKOWNIKA
				if($_GET['action']=='delete' && is_numeric($_GET['id']) && $_GET['t']===$_SESSION['token']) {
				   mysqli_query($db, "DELETE FROM user WHERE id='".$_GET['id']."';") or die(mysql_error());
					$msg = 'Użytkownik został usunięty.';
					header('Location:users.php?msg='.$msg);
				}
				//AKTYWOWANIE UŻYTKOWNIKA
				if($_GET['action']=='active' && is_numeric($_GET['id']) && $_GET['t']===$_SESSION['token']) {
					mysqli_query($db, "UPDATE user SET code='0' WHERE `id`='".$_GET['id']."'") or die(mysql_error());
					$msg = 'Użytkownik został aktywowany.';
					header('Location:users.php?msg='.$msg);
				}
				//DEZAKTYWOWNIE UŻYTKOWNIKA
				if($_GET['action']=='deactive' && is_numeric($_GET['id']) && $_GET['t']===$_SESSION['token']) {
					mysqli_query($db, "UPDATE user SET code='1' WHERE `id`='".$_GET['id']."'") or die(mysql_error());
					$msg = 'Użytkownik został dezaktywowany.';
					header('Location:users.php?msg='.$msg);
				}
			}
			
			}
		}
	else header("Location: login.php");
	
	$_SESSION['token'] = $user->token(16);

require_once('../themes/admin/header.php'); //LOAD header
echo '<div id="content">';
	require_once('../themes/admin/users.php'); //LOAD content
echo '</div>';
require_once('../themes/admin/footer.php'); //LOAD footer
ob_end_flush();
?>