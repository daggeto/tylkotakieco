<?php
	$ex = explode("?",$_SERVER['REQUEST_URI']);
	$ex = explode("&", $ex[1]);
	$id = preg_replace("/[^0-9]/", "", htmlspecialchars($ex[0]));
	@$query = mysqli_query($db, "SELECT * FROM `shity` WHERE `id`='".$id."'");
	if(mysqli_num_rows($query) == 1) {
		$img = mysqli_fetch_array($query);

		$author = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` WHERE `id`='".$img['author']."'"));
                        if($conf->pobierz('img_title')) echo'<div class="img_title"><a href="#">'.$img['title'].'</a></div>';
                        echo'<div class="shit">';

                        if($obj->isImage($img['type'])){
                            echo '<img src="'.$img['img'].'" alt="'.$img['title'].'" />';
                        }
                        
                        if($obj->isFlash($img['type'])){
                            $yt_width = 480;
                            $yt_height = 390;

                            $id_filmu=str_replace("https://www.youtube.com/watch?v=", "", $img['img']);

                          echo '<iframe width="'.$yt_width.'" height="'.$yt_height.'"' .
                            'src="http://www.youtube.com/embed/' . $id_filmu .'">' .
                            '</iframe>';
                        }

                        echo '<div id="info">'
                                            .'<div class="social-info table-row to-left">'
                                                .'<div class="fb-like" data-href="http://'.$conf->host().'/obrazek.php?'.$img['id'].'" data-send="true" data-layout="box_count" data-width="100%" data-show-faces="false" data-colorscheme="light" data-font="verdana"></div>'
                                            .'</div>'
                                            .'<div class="table-row">'
                                                .'<div class="to-left">' . $content->getValue("global","dodano") . ': ' . $obj->getDateFromDateTime($img['data']) . '</div>'
                                                .'<div class="to-right">' . $content->getValue("obrazek","dodanoPrzez") . ': ' . $author['login'] . '</div>'
                                            .'</div>'
                                        .'</div>'
                        .'</div>';
			if($conf->pobierz('komentarze')==1) {
				echo '<div class="social-comments">

                                        <div id="fb-root"></div>
                                        <script src="http://connect.facebook.net/lt_LT/all.js#xfbml=1"></script>
                                        <fb:comments href="http://'.$conf->host().'/obrazek.php?'.$img['id'].'" num_posts="4" width="700" colorscheme="dark"></fb:comments>
                                    </div>';
			}
	}
	else {
		echo'<div class="img_title"><a href="#">' . $content->getValue("obrazek", "nieistnieje") . '</a></div>';
		echo '<div class="shit">
				<img src="img/img404.jpg" alt="' . $content->getValue("obrazek", "nieistnieje") . '" /></a>
			</div>';
	}
?>
