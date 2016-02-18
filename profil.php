<?php
ob_start();
require_once('connect.php');
require_once('include/module/index.class.php');
require_once('include/module/conf.class.php');
require_once('include/module/user.class.php');
require_once('include/module/Content.class.php');
require_once('include/module/dett.php');

	$conf = new conf();
	$conf->query(mysqli_query($db, "SELECT * FROM `".TB_CONF."` WHERE `id`='1'"));
	$user = new user($db);
	$user->sessionName('login','password');

        $obj = new glowna($db);

	$theme = $conf->pobierz("theme");
        $lang = 'pl';
        $contentFileName = 'themes/' . $theme . '/content_' . $lang .'.ini';
        $content = new Content($contentFileName, $lang);

	if($user->verifyLogin()) {
		$tentego_glowna = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `$img_table` WHERE `is_waiting`='0' AND `author`='".$user->userInfo('id')."'"));
		$tentego_poczekalnia = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `$img_table` WHERE `is_waiting`='1' AND `author`='".$user->userInfo('id')."'"));
		$tentego_last_uploaded = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `$img_table` WHERE `author`='".$user->userInfo('id')."' ORDER BY `id` DESC"));
		
		if(isset($_POST['zmien'])) {
			$info = NULL;
			if(empty($_POST['stare_haslo']) || empty($_POST['nowe_haslo'])) {
				$info = $content->getValue("global", "niewypelniono") . "</span>";
			}
			else {
				$old_pass = md5($_POST['stare_haslo']);
				if(!mysqli_num_rows(mysqli_query($db, "SELECT * FROM `user` WHERE `login`='".$user->userInfo('login')."' and `haslo`='".$old_pass."'"))) $info = $content->getValue("profil", "zleHaslo");
				else {
					$new_pass = md5($_POST['nowe_haslo']);
					$user_login = $user->userInfo('login');
					if(!mysqli_query($db, "UPDATE `user` SET `haslo` = '".$new_pass."' WHERE `login`='".$user_login."';")) $info = $content->getValue("profil", "nieudalosie");
					else {
						$user->sessionRelog($user_login, $_POST['nowe_haslo']);
						$info = $content->getValue("profil", "zmieniono");
					}
				}
			}
		}
	}
	else header("Location: login.php");
	
require_once('themes/'.$theme.'/header.php'); //LOAD header
echo '<div id="content"  class="background">';
	require_once('themes/'.$theme.'/profil.php'); //LOAD content
echo '</div>';
require_once('themes/'.$theme.'/footer.php'); //LOAD footer
ob_end_flush();
?>


