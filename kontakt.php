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

	if(isset($_POST['submit'])) {
		if (!empty($_POST['tresc']) && !empty($_POST['imie']) && !empty($_POST['email'])) {
			$message = "Wysłał: ".clean($_POST['imie'])."\ne-mail: ".clean($_POST['email'])."\n\n----------Treść wiadomości----------\n\n".clean($_POST['tresc']);
			$header = "From: ".clean($_POST['imie'])." <".clean($_POST['email']).">";
			if(!@mail($conf->pobierz("email"),"Wiadomosc z ".$conf->pobierz("tytul"),$message,$header))
				$info = $content->getValue("kontakt", "niewyslano");
			else
				$info = "<div align=\"center\"><strong>" . $content->getValue("kontakt", "wyslano") . "</strong></div>";
		}
		else $info = $content->getValue("global", "niewypelniono");
		$info .= '<br/><a href="kontakt.php">&laquo; ' . $content->getValue("global", "powrot") . '</a>';
	}

	function clean($str)
	{
        $injections = array('/(\n+)/i','/(\r+)/i','/(\t+)/i','/(%0A+)/i','/(%0D+)/i','/(%08+)/i','/(%09+)/i');
        $str= preg_replace($injections,'',$str);
        return $str;
	}

require_once('themes/'.$theme.'/header.php'); //LOAD header
echo '<div id="content" class="background">';
require_once('themes/'.$theme.'/kontakt.php'); //LOAD content
echo '</div>';
require_once('themes/'.$theme.'/footer.php'); //LOAD footer
ob_end_flush();
?>


