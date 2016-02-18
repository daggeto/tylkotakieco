<?php
ob_start();
require_once('../connect.php');
require_once('../include/module/admin/conf.class.php');
require_once('../include/module/admin/user.class.php');

	$conf = new conf();
	$conf->query(mysqli_query($db, "SELECT * FROM `conf` WHERE `id`='1'"));
	$user = new user($db);
	
	$user->sessionName('login','password');
	$user->sessionSet('login','password', 'submit');
	if($user->verifyLogin()) {
		$ranga = $user->userInfo('ranga');
		if($ranga) {	
			$msg = 'Poprawnie zalogowano.';
			header("LOCATION: index.php?msg=".$msg); // redirecting
			}
		else $display_error = 1;
	}
	else $display_error = 1;
	
require_once('../themes/admin/header.php'); //LOAD header
echo '<div id="content">';
	require_once('../themes/admin/login.php'); //LOAD content
echo '</div>';
require_once('../themes/admin/footer.php'); //LOAD footer
ob_end_flush();
?>


