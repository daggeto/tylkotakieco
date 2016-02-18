<?php
if ($user->verifyLogin()) {
    if (isset($_POST['submit_tresc'])) {

        if(($error = $obj->genericValidation($_POST)) != 0){
            switch($error){
                case 1 :
                    echo '<b>' . $content->getValue("dodaj","niewypelniono") . '</b><br/><a href="dodaj.php">&laquo; ' . $content->getValue("global","powrot") . '</a>';
                    exit;
                    break;
                case 2 :
                    echo '<b>' . $content->getValue("dodaj","niemaTytulObrazek") . '</b><br/><a href="dodaj.php">&laquo;  ' . $content->getValue("global","powrot") . '</a>';
                    exit;
                    break;
                case 3 :
                    echo '<b>' . $content->getValue("dodaj","niemaAdresu") . '</b><br/><a href="dodaj.php">&laquo;  ' . $content->getValue("global","powrot") . '</a>';
                    exit;
                    break;
                case 4 :
                    echo '<b>' . $content->getValue("dodaj","zakrotki") . '</b><br/><a href="dodaj.php">&laquo;  ' . $content->getValue("global","powrot") . '</a>';
                    exit;
                    break;
            }
        }

        $tresc = @htmlspecialchars(mysqli_real_escape_string($db, $_POST['tresc']));
        $tytul = @htmlspecialchars(mysqli_real_escape_string($db, $_POST['tytul']));
        $zrodlo = @htmlspecialchars(mysqli_real_escape_string($db, $_POST['zrodlo']));
        $type = @htmlspecialchars(mysqli_real_escape_string($db, $_POST['type']));
        $autor = $user->userInfo("id");
        $data = date('Y-m-d H:i:s');

        $image = new SimpleImage();
        $imageType  = "";
        switch($_POST['type']){
                case 'obrazek':
                    $data_img = date("YmdHis");
                    $sp1 = pathinfo($_FILES['obrazek']['name']);
                    $uploaddir = 'img/upload/' . $type . '/'.$data_img.'.'.$sp1['extension'];

                    switch(uploadFile('obrazek','img/upload/'. $type . '/', array(1=>'jpg','jpeg','gif','png','JPG','JPEG','GIF','PNG'), 0, $data_img)) {
                        case 0: echo '<b>'. $content->getValue("dodaj","niewybrano"). '</b><br/><a href="dodaj.php">&laquo; ' . $content->getValue("global","powrot") . '</a>'; exit;break;
                        case 1: echo '<b>'. $content->getValue("dodaj","niepowiodlo"). '</b><br/><a href="dodaj.php">&laquo; ' . $content->getValue("global","powrot") . '</a>'; exit;break;
                        case 3: echo '<b>'. $content->getValue("dodaj","niedozwolono"). '</b><br/><a href="dodaj.php">&laquo; ' . $content->getValue("global","powrot") . '</a>'; exit;break;
                        case 4: echo '<b>'. $content->getValue("dodaj","istnieje"). '</b><br/><a href="dodaj.php">&laquo; ' . $content->getValue("global","powrot") . '</a>'; exit;break;
                        case 5: echo '<b>'.sprintf($content->getValue("dodaj","obrazekZaduzy"), $conf->pobierz('max_file_size')) . "KB"
                                                . '</b><br/><a href="dodaj.php">&laquo; ' . $content->getValue("global","powrot") . '</a>';	exit;break;
                    }

                    if($sp1['extension'] != "gif" && $sp1['extension']!= "GIF") {
                            $image->createSmpleImage($uploaddir);
                            $image->save($uploaddir);
                    }

                    $imageType = "obrazek";

                    break;
                case 'wideo' :
                    $adres_filmu = @htmlspecialchars(mysqli_real_escape_string($db, trim($_POST['adres'])));

                    if(!preg_match('/youtube\.com\/(v\/|watch\?v=)([\w\-]+)/', $adres_filmu)){
                        echo '<b>' . $content->getValue("dodaj","niepoprawny") . '</b><br/><a href="dodaj.php">&laquo;  ' . $content->getValue("global","powrot") . '</a>';
                        exit;
                    }

                    $uploaddir = preg_replace('#&feature=.*#', '',$adres_filmu);

                    $zrodlo = "YouTube";
                    $imageType = "wideo";
                    break;
                case 'tekst':
                        if(!$image->create($_POST['tresc'])){
                            echo '<b>' . $content->getValue("dodaj","zadlugiText") . '</b><br/><a href="dodaj.php">&laquo; ' . $content->getValue("global","powrot") . '</a>';
                            exit;
                        }

                        $data_img = date("YmdHis");
                        $uploaddir = 'img/upload/'. $type .'/' . $data_img . '.png';
                        $image->save($uploaddir,IMAGETYPE_PNG);

                        $imageType = "wiedza";

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

                        if(!$image->createWithImage($tmp_file, $_POST['tresc'])){
                            echo '<b>' . $content->getValue("dodaj","zadlugiText") . '</b><br/><a href="dodaj.php">&laquo; ' . $content->getValue("global","powrot") . '</a>';
                            unlink($tmp_file);
                            exit;
                        }
                        unlink($tmp_file);

                        $data_img = date("YmdHis");
                        $uploaddir = 'img/upload/'. $type .'/' . $data_img . '.png';
                        $image->save($uploaddir,IMAGETYPE_PNG);
                        
                        $imageType = "obrazekWiedza";

                        break;
        }

        $waiting = 0;

        if($conf->pobierz("waitingRoom") == 1){
            $waiting = 1;
        }

        $wykonaj = mysqli_query($db, "INSERT INTO `shity` ( `content`, `title` , `img`, `source`, `author`, `data`, `type`, `is_waiting`) VALUES ('$tresc', '$tytul' , '$uploaddir', '$zrodlo', '$autor', '$data', '$imageType', $waiting)");
        echo $content->getValue("dodaj", "dodano");
        echo '<br /><a href="index.php">&laquo; ' . $content->getValue("global", "glowna") . '</a>';

        }
    else {
?>
            <form name="dodaj"  action="dodaj.php" method="post" enctype="multipart/form-data">
                <table class="dodajTable">
                    <colgroup >
                        <col align="right"/>
                        <col/>
                    </colgroup>
                        <tr name="typ">
                            <td> </td>
                            <td id="typeDiv">
                                <ul>
                                    <li>
                                        <label for="tekst">
                                            <img src="img/tekst.png" alt="<?php echo $content->getValue("dodaj","tekst"); ?>" />
                                        </label>
                                        <input type="radio" name="type" value="tekst" id="tekst" checked onClick="showFieldsFor(this)" class="input_hidden"/>
                                    </li>
                                    <li>
                                        <label for="tekst_obrazek">
                                                <img src="img/tekst_obrazek.png" alt="<?php echo $content->getValue("dodaj","tekstObrazek"); ?>" />
                                        </label>
                                        <input type="radio" name="type" value="tekst_obrazek" id="tekst_obrazek" onClick="showFieldsFor(this)" class="input_hidden"/>
                                    </li>
                                    <li>
                                        <label for="obrazek">
                                                <img src="img/image.png" alt="<?php echo $content->getValue("dodaj","obrazek"); ?>" />
                                        </label>
                                        <input id="obrazek" type="radio" name="type" value="obrazek" onClick="showFieldsFor(this)" class="input_hidden"/>
                                    </li>
                                    <li>
                                        <label for="wideo">
                                                <img src="img/youtube.png" alt="<?php echo $content->getValue("dodaj","wideo"); ?>" />
                                        </label>
                                        <input id="wideo" type="radio" name="type" value="wideo" onClick="showFieldsFor(this)" class="input_hidden"/>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr name="tytul">
                            <td class="tdLeft"><?php echo $content->getValue("dodaj","tytul"); ?>:</td>
                            <td class="tdRight">
                                <input class="pole" type="text" name="tytul" style="width : 395px" maxlength="255">
                                <?php echo $content->getValue("dodaj","maxlength"); ?>
                            </td>
                        </tr>
                        <tr name="obrazek" style="display:none">
                                <td class="tdLeft"><?php echo $content->getValue("dodaj","obrazek"); ?>:</td>
                                <td class="tdRight">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $conf->pobierz('max_file_size')*1024; ?>" /> <!--maksymalna wielkość pliku w bajtach-->
                                    <input name="obrazek" type="file" /> <span >(max. <?php echo $conf->pobierz('max_file_size'); ?>KB)</span>
                                </td>
                        </tr>
                        <tr name="adres" style="display:none">
                            <td class="tdLeft"><?php echo $content->getValue("dodaj","adresFilmu"); ?>:</td>
                            <td class="tdRight">
                                    <input class="pole" type="text" name="adres">  <span >np. http://www.youtube.com/watch?v=wZZ7oFKsKzY</span>
                            </td>
                        </tr>
                        <tr name="wiedza">
                            <td class="tdLeft"><?php echo $content->getValue("dodaj","trescWiedzy"); ?> :</td>
                            <td class="tdRight">
                                <textArea name="tresc"></textArea>
                            </td>
                        </tr>
                        <tr name="zrodlo">
                            <td class="tdLeft"><?php echo $content->getValue("dodaj","zrodlo"); ?>:</td>
                            <td class="tdRight"><input class="pole" type="tekst" name="zrodlo"></td>
                        </tr>
                        <tr name="submit">
                            <td class="tdLeft"></td>
                            <td class="tdRight">
                                <input type="submit" name="submit_tresc" class="button" value="<?php echo $content->getValue("global","dodaj");?>" />
                            </td>
                        </tr>
                    </table>
            </form>
<?php
    }
} else {
    echo $content->getValue("dodaj", "musiszZalogowac") . '<br/><br/>
	<a href="login.php" class="button" style="float:left;">' . $content->getValue("global", "loguj") . '</a>
	<a href="rejestracja.php" class="button" style="margin-left:10px;float:left;">' . $content->getValue("global", "rejestracja") . '</a>
	<div style="clear:left;"></div>';
}
?>