<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
	<meta name="description" content="<?php echo $conf->pobierz("description"); ?>" />
	<meta name="keywords" content="<?php echo $conf->pobierz("tags"); ?>" />
	<link rel="stylesheet" href="../themes/admin/style.css" type="text/css" />
	<link rel="stylesheet" href="../style.css" type="text/css" /> 
	<link rel="stylesheet" href="../js/lytebox.css" type="text/css" media="screen" />
	<script type="text/javascript" language="javascript" src="../js/lytebox.js"></script>
	<title>TylkoTakieCo.pl - Panel Administracyjny :: <?php echo $title; ?></title>
</head>

<body>
	<div id="header">
		<div id="logo">
			<span class="nazwa"><img src="../img/logo.png" alt="logo"/></span>
			<span class="slogan">Panel Administracyjny</span>
		</div>
	</div>
	<div id="menu">
		<ul>
			<?php
			if($user->verifyLogin()) {
				if($user->userInfo('ranga')==2) {
				echo '<li><a href="index.php">Przegląd</a></li>
				<li><a href="glowna.php">Główna</a></li>
				<li><a href="poczekalnia.php">Poczekalnia</a></li>
				<li><a href="users.php">Użytkownicy</a></li>
				<li><a href="reklama.php">Reklama</a></li>		
				<li><a href="ustawienia.php">Ustawienia</a></li>
				<li><a href="wyloguj.php">Wyloguj się</a></li>';
				}
				elseif($user->userInfo('ranga')==1) {
				echo '<li><a href="index.php">Przegląd</a></li>
				<li><a href="glowna.php">Główna</a></li>
				<li><a href="poczekalnia.php">Poczekalnia</a></li>
				<li><a href="wyloguj.php">Wyloguj się</a></li>';
				}
				echo'<li style="display: block;float:right;background:#efcb01;margin-right:6px;color: #fff;-webkit-border-bottom-right-radius: 6px;-moz-border-radius-bottomright: 6px;border-bottom-right-radius: 6px;"><a href="../index.php">Powrót do Serwisu</a></li>';
			}
			else { 
			echo'<li><a href="../index.php">&laquo; Powrót do Serwisu</a></li>';
			}
			?>
		</ul>
	</div>
	
	<?php
		//Wiadomości systemowe
		if(!empty($_GET['msg'])) {
			$msg = @htmlspecialchars($_GET['msg']);
			if($msg) {
				echo '<div class="msg">'.$msg.'</div>';
			}
		}
	?>