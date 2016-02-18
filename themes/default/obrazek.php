<?php
	$ex = explode("?",$_SERVER['REQUEST_URI']);
	$id = preg_replace("/[^0-9]/", "", htmlspecialchars($ex[1]));
	@$query = mysqli_query($db, "SELECT * FROM `shity` WHERE `id`='".$id."'");
	if(mysqli_num_rows($query) == 1) {
		$img = mysqli_fetch_array($query);
		
		$img_name = 'obrazek';
		$flash_name = 'film';
		$author = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` WHERE `id`='".$img['author']."'"));
			if($img['type'] == $img_name) {
				if($conf->pobierz('img_title')) echo'<div class="img_title"><a href="#">'.$img['title'].'</a></div>';
				echo'<div class="shit">
				<img src="'.$img['img'].'" alt="'.$img['title'].'" />		
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
			if($conf->pobierz('komentarze')==1) {
				echo '<div style="margin-bottom:-40px;">
				<div id="fb-root"></div><script src="http://connect.facebook.net/pl_PL/all.js#xfbml=1"></script><fb:comments href="http://'.$conf->host().'/obrazek.php?'.$img['id'].'" num_posts="4" width="700" colorscheme="dark"></fb:comments>
				</div>';
			}
	}
	else {
		echo'<div class="img_title"><a href="#">TenTegowiec nie istnieje</a></div>';
		echo '<div class="shit">
				<img src="img/img404.jpg" alt="TenTegowiec nie istnieje" /></a>
			</div>';
	}
?>