
<?php
ob_start();
require_once('connect.php');
require_once('include/module/index.class.php');
require_once('include/module/conf.class.php');
require_once('include/module/user.class.php');
require_once('include/module/upload.func.php');
require_once('include/module/simpleimage.class.php');
require_once('include/module/Content.class.php');
require_once('include/module/dett.php');

	$conf = new conf();
	$conf->query(mysqli_query($db, "SELECT * FROM `".TB_CONF."` WHERE `id`='1'"));
	$user = new user($db);
	$user->sessionName('login','password');

        $obj = new glowna($db);

	$theme = $conf->pobierz("theme");

        $lang = 'lt';
        $contentFileName = 'themes/' . $theme . '/content_' . $lang .'.ini';
        $content = new Content($contentFileName, $lang); 
		
		if (isset($_POST['submit_tresc'])) {
		
			if(($error = $obj->genericValidation($_POST)) != 0){
				switch($error){
					case 1 : 
						echo '<b>' . $content->getValue("dodaj","niewypelniono") . '</b><br/><a href="dodaj.php">&laquo; ' . $content->getValue("global","powrot") . '</a>';
						exit;					
						break;
				}
			}

            $tresc = @htmlspecialchars(mysqli_real_escape_string($db, $_POST['tresc']));
            $tytul = @htmlspecialchars(mysqli_real_escape_string($db, $_POST['tytul']));
            $zrodlo = @htmlspecialchars(mysqli_real_escape_string($db, $_POST['zrodlo']));
            $autor = $user->userInfo("id");
            $data = date('Y-m-d H:i:s');

            $image = new SimpleImage();
			
			switch($_POST['type']){
				case 'tekst':
					if(!$image->create($tresc)){
						echo '<b>' . $content->getValue("dodaj","zadlugiText") . '</b><br/><a href="dodaj.php">&laquo; ' . $content->getValue("global","powrot") . '</a>';
						exit;
					}
					
					break;
				case 'tekst_obrazek':					
					$data_img = date("YmdHis");
					$sp1 = pathinfo($_FILES['obrazek']['name']);
					$tmp_file = 'img/upload/tmp/'.$data_img.'.'.$sp1['extension'];

					if((filesize($_FILES['obrazek']['tmp_name']) /1024) >= $conf->pobierz('max_file_size')) {
							echo '<b>' 
								. sprintf($content->getValue("dodaj","obrazekZaduzy"), $conf->pobierz('max_file_size')) . "KB"
								. '</b><br/><a href="dodaj.php">&laquo; ' . $content->getValue("global","powrot") . '</a>';
							exit;
					}
					
					switch(uploadFile('obrazek','img/upload/tmp/', array(1=>'jpg','jpeg','gif','png','JPG','JPEG','GIF','PNG'), 0, $data_img)) {
						case 0: echo '<b>'. $content->getValue("dodaj","niewybrano"). '</b><br/><a href="dodaj.php">&laquo; ' . $content->getValue("global","powrot") . '</a>'; exit;break; 
						case 1: echo '<b>'. $content->getValue("dodaj","niepowiodlo"). '</b><br/><a href="dodaj.php">&laquo; ' . $content->getValue("global","powrot") . '</a>'; exit;break; 
						case 3: echo '<b>'. $content->getValue("dodaj","niedozwolono"). '</b><br/><a href="dodaj.php">&laquo; ' . $content->getValue("global","powrot") . '</a>'; exit;break; 
						case 4: echo '<b>'. $content->getValue("dodaj","istnieje"). '</b><br/><a href="dodaj.php">&laquo; ' . $content->getValue("global","powrot") . '</a>'; exit;break; 
						case 5: echo '<b>'.sprintf($content->getValue("dodaj","obrazekZaduzy"), $conf->pobierz('max_file_size')) . "KB"
									. '</b><br/><a href="dodaj.php">&laquo; ' . $content->getValue("global","powrot") . '</a>';	exit;break;
					}
					

					
					
					
					echo 'no error';exit;
					break;
			}

			$data_img = date("YmdHis");
			$uploaddir = 'img/upload/'. $_POST['type'].'/' . $tytul . '_' . $data_img . '.png';
			
			//$image->save($uploaddir,IMAGETYPE_PNG);


			//$wykonaj = mysqli_query($db, "INSERT INTO `shity` ( `content`, `title` , `img`, `source`, `author`, `data`, `type`) VALUES ('$tresc', '$tytul' , '$uploaddir', '$zrodlo', '$autor', '$data', 'wiedz')");
			echo $content->getValue("dodaj", "dodano");
			echo '<br /><a href="index.php">&laquo; ' . $content->getValue("global", "glowna") . '</a>';

        }
		
		
		?>
<html>
<head>
	<script type="text/javascript" src="js/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="themes/<?php echo $theme; ?>/js/functions.js"></script>
</head>
<body>
            <form action="testImage.php" method="post" enctype="multipart/form-data">
                <table>
                    <colgroup>
                        <col width="120px;">
                        <col>
                    </colgroup>
                    <tbody>
                        <tr name="typ">
							<td> Tipas: </td> 
							<td> <input type="radio" name="type" value="tekst" checked onClick="showHideFileUpload(this)">Tekstas</input> 
							<input type="radio" name="type" value="tekst_obrazek" onClick="showHideFileUpload(this)" >Nuotrauka</input></td>
						</tr>
						<tr>
						
                            <td><?php echo $content->getValue("dodaj","tytul"); ?>:</td>
                            <td>
                                <input class="pole" type="text" name="tytul">
                            </td>
                        </tr>
					<tr name="obrazekTr" style="display:none">
						<td>Obrazek:</td>
						<td>
							<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $conf->pobierz('max_file_size')*1024; ?>" /> <!--maksymalna wielkość pliku w bajtach-->
                            <input name="obrazek" type="file" /> <span style="color:#595959">(max. <?php echo $conf->pobierz('max_file_size'); ?>KB)</span>
						</td>
					</tr>
                        <tr>
                            <td><?php echo $content->getValue("dodaj","trescWiedzy"); ?> :</td>
                            <td>
                                <textArea name="tresc"></textArea>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $content->getValue("dodaj","zrodlo"); ?>:</td>
                            <td><input class="pole" type="tekst" name="zrodlo"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit_tresc" class="button" value="<?php echo $content->getValue("global","dodaj");?>" />
                            </td>
                        </tr>
                    </tbody></table>
            </form>
</body>
				</html>