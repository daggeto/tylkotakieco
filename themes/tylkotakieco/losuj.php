<?php

	$img = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `shity` WHERE `is_waiting`='0' ORDER BY RAND() LIMIT 1"));
	$author = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` WHERE `id`='".$img['author']."'"));
	list($records) = $img;
	
	if($records>=1) {
		if($obj->isImage($img['type'])) {
			if($conf->pobierz('img_title')) echo'<div class="img_title"><a href="obrazek.php?'.$img['id'].'">'.$img['title'].'</a></div>';
			echo'<div class="shit">';

                        if($obj->isImage($img['type'])){
                            echo  '<a href="obrazek.php?'.$img['id'].'"><img src="'.$img['img'].'" alt="'.$img['title'].'" /></a>';
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
		}
	}
	else {
		echo '<div class="shit">' . $content->getValue("global","brakWiadomosci") . '</div>';
	}
		
?>
