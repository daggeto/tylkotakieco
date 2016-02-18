<h1>Przegląd</h1>
Witaj, <b><?php echo $user->userInfo('login'); ?></b>! [<?php if($ranga==1) {echo 'Moderator';} if($ranga==2) {echo 'Administrator';} ?>]<br/><br/>
<img src="img/star.png" style="position:relative;top:2px;"/> <b>TenTegowców na głównej:</b> <?php echo $tentego_glowna; ?><br/>
<img src="img/stop.png" style="position:relative;top:2px;"/> <b>TenTegowców w poczekalni:</b> <?php echo $tentego_poczekalnia; ?><br/>
<img src="img/user.png" style="position:relative;top:2px;"/> <b>Zarejestrowanych użytkowników:</b> <?php echo $tentego_users; ?><br/>
<img src="img/user_green.png" style="position:relative;top:2px;"/> <b>Najnowszy użytkownik:</b> <?php echo $tentego_last_user['login']; ?>
<br/><br/>
<img src="img/information.png" style="position:relative;top:2px;"/> <b>Wersja skryptu:</b> <?php echo $version;?>