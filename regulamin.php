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
	
require_once('themes/'.$theme.'/header.php'); //LOAD header
echo '<div id="content" class="background">';
	require_once('themes/'.$theme.'/regulamin.php'); //LOAD content
echo '</div>';
require_once('themes/'.$theme.'/footer.php'); //LOAD footer
ob_end_flush();
?>


