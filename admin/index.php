<?php
ob_start();
require_once('../connect.php');
require_once('../include/module/admin/conf.class.php');
require_once('../include/module/admin/user.class.php');

	//Nazwa strony
	$title = 'Przegląd';

	$conf = new conf();
	$conf->query(mysqli_query($db, "SELECT * FROM `conf` WHERE `id`='1'"));
	$user = new user($db);
	$user->sessionName('login','password');
	
	if($user->verifyLogin()) {
		$ranga = $user->userInfo('ranga');
		if(!$ranga) {
			header("Location: login.php");
			}
		else {
			$tentego_glowna = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `$img_table` WHERE `is_waiting`='0'"));
			$tentego_poczekalnia = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `$img_table` WHERE `is_waiting`='1'"));
			$tentego_users = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `user`"));
			$tentego_last_user = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` ORDER BY `id` DESC LIMIT 1"));
			}
		}
	else header("Location: login.php");
	
require_once('../themes/admin/header.php'); //LOAD header
echo '<div id="content">';
	require_once('../themes/admin/index.php'); //LOAD content
echo '</div>';
require_once('../themes/admin/footer.php'); //LOAD footer
ob_end_flush();
?>
