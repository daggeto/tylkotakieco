<?php
	$obj->tabela("shity", "0");
	$obj->getName('page');
	$obj->ileNaStrone($conf->pobierz('img_na_strone'));
	$query = $obj->pobierz();

	if(mysqli_num_rows($query)) {
		while($img = mysqli_fetch_array($query)) {
                    $author = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` WHERE `id`='".$img['author']."'"));
                    if($conf->pobierz('img_title')) echo'<div class="img_title"><a href="obrazek.php?'.$img['id'].'">'.$img['title'].'</a></div>';
                    echo'<div class="shit">';

                        if($obj->isImage($img['type'])){
                            echo  '<a href="obrazek.php?'.$img['id'].'"><img src="'.$img['img'].'" alt="'.$img['title'].'" /></a>';
                        }

                        if($obj->isFlash($img['type'])){
                            $yt_width = 480;
                            $yt_height = 390;

                            $id_filmu=str_replace("http://www.youtube.com/watch?v=", "", $img['img']);

                            echo '<object width="'.$yt_width.'" height="'.$yt_height.'"><param name="movie" value="http://www.youtube.com/v/'.$id_filmu.'?version=3&amp;hl=pl_PL"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$id_filmu.'?version=3&amp;hl=pl_PL" type="application/x-shockwave-flash" width="'.$yt_width.'" height="'.$yt_height.'" allowscriptaccess="always" allowfullscreen="true"></embed></object>';
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

                if($conf->pobierz('reklama')) adModule($db);
	}
	else {
		echo '<div  class="shit">' . $content->getValue("global","brakWiadomosci") . '</div>';
	}
?>
<div class="strony">
<?php
	if($obj->getName() != NULL)  $page = $obj->getName();
	else $page = 1;
	if($obj->prevStrona()) echo '<a href="?page='.($page-1).'">&lt; ' . $content->getValue("global","poprzedni") . '</a> ';
	$obj->strony();
	if($obj->nextStrona()) echo ' <a href="?page='.($page+1).'">' . $content->getValue("global","nastepny") . ' &gt;</a>';
?>
</div>
