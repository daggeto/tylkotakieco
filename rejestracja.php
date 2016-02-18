<?php
ob_start();
require_once('connect.php');
require_once('include/module/index.class.php');
require_once('include/module/conf.class.php');
require_once('include/module/user.class.php');
require_once('include/module/Content.class.php');
require_once('include/module/dett.php');

	$conf = new conf();
	$conf->query(mysqli_query($db, "SELECT * FROM `".TB_CONF."` WHERE `id`='1'"));

        $obj = new glowna($db);

        $user = new user($db);
	$user->sessionName('login','password');

        $theme = $conf->pobierz("theme");
	
        $lang = 'pl';
        $contentFileName = 'themes/' . $theme . '/content_' . $lang .'.ini';
        $content = new Content($contentFileName, $lang);
	
if (isset($_POST['submit'])) {
	$info = NULL;
	if(!$_POST['login'] || !$_POST['password'] || !$_POST['password2'] || !$_POST['email'])
		$info = $content->getValue("global", "niewypelniono") . '<br/><a href="rejestracja.php">' . $content->getValue("global", "powrot") . ' &laquo; </a>';
	else {
		if($_SESSION['security_code'] == $_POST['security_code']) {
			if(isset($_POST['regulamin'])) {
				if($_POST['password']==$_POST['password2']) {
					$account =  htmlspecialchars(mysqli_real_escape_string($db, $_POST['login']));
					$password = md5($_POST['password']);
					$email = htmlspecialchars(mysqli_real_escape_string($db, ($_POST['email'])));
					if($conf->pobierz('req_code')) $code = rand(10000000,99999999);
					else $code = 0;
					$is_exists = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `user` WHERE login = '$account'"));
					if($is_exists == 0) {
						$to = $email;
						$subject = sprintf($content->getValue("rejestracja", "aktywacja"), $conf->pobierz('tytul'));
						$message = sprintf($content->getValue("rejestracja","aktywacjaMsg"),$account)
                                                        . "\n\n" . $content->getValue("rejestracja","aktywacjaMsg2")
                                                        . "\n\n http://" . $conf->host() ."/activate.php?code=" . $code . "\n\n"
                                                        . sprintf($content->getValue("rejestracja","aktywacjaMsg3"),$conf->pobierz('tytul'));
						$headers = "FROM: " . sprintf($content->getValue("rejestracja", "aktywacja"), $conf->pobierz('tytul')) . " <no-reply@".$_SERVER['SERVER_NAME'].">";
						if(!mysqli_query($db, "INSERT INTO `user` (`login`,`email`,`haslo`,`code`) VALUES('".$account."','".$email."','".$password."','".$code."')"))
                                                {
                                                    echo '<p style="color:red;">' . $content->getValue("rejestracja","blad") .'</p>';
                                                }
						else
                                                {
                                                    $info = sprintf($content->getValue("rejestracja","kontoStwozone"), '<b><i>' . $account . '</i></b>');
                                                }
						if($conf->pobierz('req_code')) {
							if(!mail($to, $subject, $message, $headers)) $info .= "<b>" . $content->getValue("rejestracja","nieudaloSieWyslac") . "</b>";
							else $info .= " " .$content->getValue("rejestracja","wyslano");
							$info .= '<br /><a href="index.php">' . $content->getValue("rejestracja","przejdz") . ' &raquo;</a>';
						}
						else $info .= $content->getValue("rejestracja","terazMozesz") . '<a href="login.php">' . $content->getValue("rejestracja","terazMozesz2") . ' &raquo;</a>';
					}
					else {
                                            $info = $content->getValue("rejestracja","egzystuje")
                                                    . '<br/><a href="rejestracja.php">&laquo;'
                                                    . $content->getValue("global","powrot")
                                                    . '</a>';
					}
				}
				else $info = $content->getValue("rejestracja","zleHasla") 
                                        . '<br/><a href="rejestracja.php">&laquo;'
                                        . $content->getValue("global","powrot")
                                        . '</a>';
			}
			else $info = $content->getValue("rejestracja","akceptujRegulamin")
                                        . '<br/><a href="rejestracja.php">&laquo;'
                                        . $content->getValue("global","powrot")
                                        . '</a>';
		}
		else $info = $content->getValue("rejestracja","kodNieprawidlowy")
                                        . '<br/><a href="rejestracja.php">&laquo;'
                                        . $content->getValue("global","powrot")
                                        . '</a>';
	}
}
	
	


require_once('themes/'.$theme.'/header.php'); //LOAD header
echo '<div id="content"  class="background">';
require_once('themes/'.$theme.'/rejestracja.php'); //LOAD content
echo '</div>';
require_once('themes/'.$theme.'/footer.php'); //LOAD footer
ob_end_flush();
?>