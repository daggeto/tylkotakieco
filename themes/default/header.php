<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
	<meta name="description" content="<?php echo $conf->pobierz("description"); ?>" />
	<meta name="keywords" content="<?php echo $conf->pobierz("tags"); ?>" />
	<?php
		$ex = explode("/",$_SERVER['SCRIPT_NAME']);
		if($ex[1]='obrazek.php' || $ex[2]='obrazek.php') {
			if($img['type']=='obrazek') { echo '<meta property="og:image" content="http://'.$conf->host().'/'.$img['img'].'" />'."\n"; }
			elseif($img['type']=='film') { 
			$id_filmu=str_replace("http://www.youtube.com/watch?v=", "", $img['img']);
			echo '<meta property="og:image" content="http://i.ytimg.com/vi/'.$id_filmu.'/default.jpg" />'."\n"; 
			}
		}
	?>
	<link rel="stylesheet" href="themes/<?php echo $theme; ?>/style.css" type="text/css" />
	<title><?php echo $conf->pobierz("tytul").@$title; ?></title>
	<!-- Theme `default` by Wojciech Król -->
</head>

<body>
	<div id="header">
			<div class="nazwa">
				<?php echo $conf->pobierz("logo"); ?>
			</div>
			<div class="like">
				<div id="fb-root"></div>
				<script type="text/javascript" src="http://connect.facebook.net/pl_PL/all.js#xfbml=1"></script>
				<div class="fb-like" data-href="http://<?php echo $conf->host(); ?>/" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false" data-colorscheme="light" data-font="arial"></div>
			</div>
			<div class="slogan"><?php echo $conf->pobierz("slogan"); ?></div>
	</div>
	<div id="menu">
		<ul>
			<li><a href="index.php">Główna</a></li>
			<li><a href="poczekalnia.php">Poczekalnia</a></li>
			<li><a href="losuj.php">Losuj</a></li>
			<li><a href="dodaj.php">Dodaj</a></li>
			<?php
			if ($user->verifyLogin()) echo'<li><a href="profil.php">Mój Profil</a></li><li><a href="wyloguj.php">Wyloguj się</a></li>';
			else echo'<li><a href="rejestracja.php">Rejestracja</a></li><li><a href="login.php">Logowanie</a></li>';
			?>
		</ul>
	</div>
