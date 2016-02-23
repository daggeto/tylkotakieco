<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
	<meta name="description" content="<?php echo $conf->pobierz("description"); ?>" />
	<meta name="keywords" content="<?php echo $conf->pobierz("tags"); ?>" />
	<?php
		$ex = explode("/",$_SERVER['SCRIPT_NAME']);
		if($ex[1]=='obrazek.php' || $ex[2]=='obrazek.php') {
                    
                    if($item['content'] == null || $item['content']==""){
                        echo '<meta property="og:title" content="' . $item['title'] . '" />';
                    }else{
                        echo '<meta property="og:title" content="' . $item['content'] . '" />';
                    }
                    echo '<meta property="og:type" content="website" />';
                    echo '<meta property="og:url" content="http://'.$conf->host().'/obrazek.php?'.$item['id'].'" />';
                    if($obj->isImage($item['type'])) {
                        echo '<meta property="og:image" content="http://'.$conf->host().'/'.$item['img'].'" />'."\n"; }
                    elseif($obj->isFlash($item['type'])) {
			$id_filmu=str_replace("https://www.youtube.com/watch?v=", "", $item['img']);
			echo '<meta property="og:image" content="http://i.ytimg.com/vi/'.$id_filmu.'/default.jpg" />'."\n"; 
                    }
                    echo '<meta property="og:description" content="' . $conf->pobierz("tytul") . '" />';
                    echo '<meta property="fb:admins" content="1717951888" />';
		}
	?>
	<link rel="stylesheet" href="themes/<?php echo $theme; ?>/style.css" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="themes/<?php echo $theme; ?>/js/functions.js"></script>

	<title><?php echo $conf->pobierz("tytul").@$title; ?></title>
</head>

<body>
	<div id="menu">
            <ul>
                <li id="logo">
                    <div  onclick="location.href='http://www.tylkotakieco.pl';"></div>
                </li>
           
                <li id="firstButton"><a class="<?php echo $obj->isSelectedPage('index'); ?>" href="index.php"><?php echo $content->getValue("global","glowna");?></a></li>
                 <li ><a class="<?php echo $obj->isSelectedPage('tekst'); ?>" href="tekst.php?1"><?php echo $content->getValue("header","onas");?></a></li>
                <?php if($conf->pobierz("waitingRoom") == 1){?>
                    <li ><a class="<?php echo $obj->isSelectedPage('poczekalnia'); ?>" href="poczekalnia.php"><?php echo $content->getValue("header","poczekalnia");?></a></li>
                <?php }?>
                <li ><a class="<?php echo $obj->isSelectedPage('losuj'); ?>" href="losuj.php"><?php echo $content->getValue("header","losowe");?></a></li>
                <li ><a class="<?php echo $obj->isSelectedPage('dodaj'); ?>" href="dodaj.php"><?php echo $content->getValue("global","dodaj");?></a></li>

                <?php
                if ($user->verifyLogin())
                {
                    echo'<li ><a class="' . $obj->isSelectedPage('profil') . '" href="profil.php">' . $content->getValue("global","profil") . '</a></li>'
                      . '<li id="lastButton" ><a class="' . $obj->isSelectedPage('wyloguj') . '" href="wyloguj.php">' . $content->getValue("header","wyloguj")  .'</a></li>';
                }
                else
                {
                    echo'<li ><a class="' . $obj->isSelectedPage('rejestracja') . '" href="rejestracja.php">' . $content->getValue("global","rejestracja") . '</a></li>'
                      . '<li id="lastButton" ><a class="' . $obj->isSelectedPage('login') . '" href="login.php">' . $content->getValue("global", "loguj") . '</a></li>';
                }
                ?>
		</ul>
	</div>
    <div id="slogan">
        <ul>
            <li>
                <div class="like" >
                    <script type="text/javascript" src="http://connect.facebook.net/pl_PL/all.js#xfbml=1"></script>
                    <div class="social-info table-row to-left">
                        <div class="fb-like" data-href="http://www.facebook.com/TylkoTakieCo?fref=ts" data-send="false" data-layout="button_count" data-width="100%" data-show-faces="false" data-colorscheme="light" data-font="verdana"></div>
                    </div>

                </div>
            </li>
            <li>
                <div class="slogan"> <?php echo $conf->pobierz("slogan"); ?></div>
            </li>
        </ul>
    </div>
    
        
