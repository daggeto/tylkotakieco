<h1><?php echo $content->getValue("kontakt", "kontakt"); ?></h1>
<?php
if(isset($_POST['submit'])) {
	echo $info;
}
else {
?>
<form action="kontakt.php" method="post">
    <table>
        <tr>
            <td>
                <label><?php echo $content->getValue("kontakt", "imie"); ?> <strong>*</strong></label>
            </td>
            <td>
                <input type="text" class="pole" name="imie" />
            </td>
        </tr>
        <tr>
            <td>
                <label><?php echo $content->getValue("rejestracja", "email"); ?> <strong>*</strong></label>
            </td>
            <td>
                <input type="text" class="pole"  name="email" />
            </td>
        </tr>
        <tr>
            <td>
                <label><?php echo $content->getValue("kontakt", "wiadomosc"); ?> <strong>*</strong></label>
            </td>
            <td>
                <textarea name="tresc" rows="5" cols="20"></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                 <input type="submit" name="submit" value="<?php echo $content->getValue("kontakt", "wyslij"); ?>" class="button" />
            </td>
        </tr>
    </table>
</form>
<?php
}
?>
