<h1>Kontakt</h1>
<?php
if(isset($_POST['submit'])) { 
	echo $info;
}
else {
?>
<div id="boxform">
<form action="kontakt.php" method="post"> 
            <div> 
                <label>Imię / Login <strong>*</strong></label> 
                <input type="text" class="pole" name="imie" /> 
            </div> 
            <div> 
                <label>E-mail <strong>*</strong></label> 
                <input type="text" class="pole"  name="email" /> 
            </div>             
            <div> 
                <label>Treść wiadomości <strong>*</strong></label> 
                <textarea name="tresc" rows="5" cols="20"></textarea> 
            </div> 
            <div style="margin-left:160px;"> 
                <input type="submit" name="submit" value="Wyślij" class="button" /> 
            </div> 
    </form> 
</div>
<?php
}
?>
