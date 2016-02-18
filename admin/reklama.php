<?php
ob_start();
require_once('../connect.php');
require_once('../include/module/admin/conf.class.php');
require_once('../include/module/admin/user.class.php');

	//Nazwa strony
	$title = 'Reklama';

	$conf = new conf();
	$conf->query(mysqli_query($db, "SELECT * FROM `conf` WHERE `id`='1'"));
	$user = new user($db);
	$user->sessionName('login','password');
	
	if($user->verifyLogin()) {
		$ranga = $user->userInfo('ranga');
		if($ranga!=2) {
			header("Location: login.php");
			}
		else {
			if(isset($_POST['save']) && ($_POST['token'] == $_SESSION['token'])) { 
			$licz = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `reklama`"));
			for($l = 0; $l<$licz; $l++) {
			mysqli_query($db, "UPDATE `reklama` SET `kod` = '".$_POST['kod_reklamy_'.$l]."', `pod_obrazkiem` = '".$_POST['pod_obrazkiem_'.$l]."' WHERE `id`='".$_POST['id_'.$l]."'");
			}
			mysqli_query($db, "UPDATE `conf` SET `reklama`='".$_POST['reklama']."'");
			$msg = 'Reklama została zaktualizowana.';
			header('Location: reklama.php?msg='.$msg);
			}
			else if(isset($_GET['del'])) {
				mysqli_query($db, "DELETE FROM `reklama` WHERE `id`='".$_GET['del']."'");
				$msg = 'Reklama została usunięta.';
				header('Location: reklama.php?msg='.$msg);
			}
			else {
			if(isset($_POST['add_next'])) {
				mysqli_query($db, "INSERT INTO `reklama` (`kod`,`pod_obrazkiem`) VALUES ('',0)");
				$msg = 'Reklama została dodana.';
				header('Location: reklama.php?msg='.$msg);
			}
					
			}
			}
		}
	else header("Location: login.php");
	
require_once('../themes/admin/header.php'); //LOAD header
echo '<div id="content">';
	require_once('../themes/admin/reklama.php'); //LOAD content
echo '</div>';
require_once('../themes/admin/footer.php'); //LOAD footer
ob_end_flush();
?>
