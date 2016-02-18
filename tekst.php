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

        $obj = new glowna($db);

        $user = new user($db);
	$user->sessionName('login','password');

	$theme = $conf->pobierz("theme");

        $lang = 'pl';
        $contentFileName = 'themes/' . $theme . '/content_' . $lang .'.ini';
        $content = new Content($contentFileName, $lang);

	$ex = explode("?",$_SERVER['REQUEST_URI']);
	$ex = explode("&", $ex[1]);
	$id = preg_replace("/[^0-9]/", "", htmlspecialchars($ex[0]));
	@$query = mysqli_query($db, "SELECT * FROM `shity` WHERE `id`='".$id."'");
	if(mysqli_num_rows($query) == 1) {
		$item = mysqli_fetch_array($query);
	}

	$title = ' - '.@$item['title'];

require_once('themes/'.$theme.'/header.php'); //LOAD header
echo '<div id="content">';
	require_once('themes/'.$theme.'/tekst.php'); //LOAD content
echo '</div>';
require_once('themes/'.$theme.'/footer.php'); //LOAD footer
ob_end_flush();
?>