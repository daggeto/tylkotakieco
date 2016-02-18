<?php
	$obj->tabela("shity", "1");
	$obj->getName('page');
	$obj->ileNaStrone($conf->pobierz('img_na_strone'));
	$query = $obj->pobierz();
	
	$img_name = 'obrazek';
	$flash_name = 'film';
	if(mysqli_num_rows($query)) {
		while($img = mysqli_fetch_array($query)) {
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
			if($conf->pobierz('reklama')) adModule($db);
		}
	}
	else {
		echo '<div style="text-align:center;">Brak TenTegowców.</div>';
	}
?>
<div class="strony">
<?php
	if($obj->getName() != NULL)  $page = $obj->getName();
	else $page = 1;
	if($obj->prevStrona()) echo '<a href="?page='.($page-1).'">&lt; Poprzednia</a> ';
	$obj->strony();
	if($obj->nextStrona()) echo ' <a href="?page='.($page+1).'">Następna &gt;</a>';
?>
</div>