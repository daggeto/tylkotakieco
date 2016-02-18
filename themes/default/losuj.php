<?php

	$img = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `shity` WHERE `is_waiting`='0' ORDER BY RAND() LIMIT 1"));
	$author = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` WHERE `id`='".$img['author']."'"));
	$img_name = 'obrazek';
	$flash_name = 'film';
	list($records) = $img;
	
	if($records>=1) {
		if($img['type'] == $img_name) {
			if($conf->pobierz('img_title')) echo'<div class="img_title"><a href="obrazek.php?'.$img['id'].'">'.$img['title'].'</a></div>';
			echo'<div class="shit">
			<a href="obrazek.php?'.$img['id'].'"><img src="'.$img['img'].'" alt="'.$img['title'].'" /></a>	
			<div class="fb-like" data-href="http://'.$conf->host().'/obrazek.php?'.$img['id'].'" data-send="false" data-layout="button_count" data-width="100%" data-show-faces="false" data-colorscheme="dark" data-font="verdana"></div>
			</div>';
		}
			
		else if($img['type']==$flash_name) {
				$id_filmu=str_replace("http://www.youtube.com/watch?v=", "", $img['img']);
				if($conf->pobierz('img_title')) {
					echo '<div class="img_title"><a href="obrazek.php?'.$img['id'].'">'.$img['title'].'</a></div>';
				}
				$yt_width = 480;
				$yt_height = 390;
				echo '<div class="shit">
				<object width="'.$yt_width.'" height="'.$yt_height.'"><param name="movie" value="http://www.youtube.com/v/'.$id_filmu.'?version=3&amp;hl=pl_PL"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$id_filmu.'?version=3&amp;hl=pl_PL" type="application/x-shockwave-flash" width="'.$yt_width.'" height="'.$yt_height.'" allowscriptaccess="always" allowfullscreen="true"></embed></object>
				<div class="fb-like" data-href="http://'.$conf->host().'/obrazek.php?'.$img['id'].'" data-send="false" data-layout="button_count" data-width="100%" data-show-faces="false" data-colorscheme="dark" data-font="verdana"></div>
				</div>';
		}
		echo '<span style="display:block;font-size:11px;padding-bottom:10px;">Dodany przez: '.$author['login'].' | '.$img['data'].' | Źródło: '.$img['source'].'</span>';
	}
	else {
		echo '<div style="text-align:center;">Nie masz jeszcze żadnych TenTegowców. Zaloguj się do panelu administracyjnego i zacznij moderować!</div>';
	}
		
?>
