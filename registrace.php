<?php
include ("vzhled/zahlavi.php");


if ($ok2==1) { ?>
  		<div id="zprava" class="reg_ok">
  			<?php echo $reg_ok; ?>
        <script src='<?php echo $url; ?>vzhled/js.js'></script>
  		</div>
  		<?php
  	} if ($err==1) { ?>
   		<div id="zprava" class="reg_err">
  			<?php echo $reg_chyba; ?>
        <script src='<?php echo $url; ?>vzhled/js.js'></script>
  		</div>
<?php }
?>
<script language="JavaScript" type="text/javascript">
function validateForm() {
    if (loginform.heslo.value.length < 6) {
    alert("<?php echo $reg_znak; ?>");
       return false;
    }
    if (loginform.heslo2.value.length < 6) {
    alert("<?php echo $reg_znak; ?>");
       return false;
    }
    if(!document.getElementById('check').checked) {
        alert("<?php echo $reg_podm; ?>");
       return false;
    }

}
</script>
<?php
  otevri_panel($reg);
if($errflag) {  echo $reg_chyba2."<br>";
foreach($errmsg_arr as $msg) {
      echo $msg.'<br />';
    }}
    ?>
<form id="loginForm" name="loginform" method="post" action="/registrace.php" onsubmit="return validateForm()">
<input name="ipv_registruj" type="hidden" value="1" />
  <table widtd="300" border="0" align="center" cellpadding="2" cellspacing="20">
    <tr>
      <td><input class="log_box" name="mail" maxlengtd="50" type="text" placeholder="<?php echo $reg_mail1; ?>" id="mail" /></td>
    </tr>
    <tr>
      <td><input class="log_box" name="mail2" maxlengtd="50" type="text" placeholder="<?php echo $reg_mail2; ?>" id="mail2" /></td>
    </tr>
    <tr>
      <td><input class="log_box" name="heslo" maxlengtd="15" type="password" placeholder="<?php echo $reg_heslo1; ?>" id="heslo" /></td>
    </tr>
    <tr>
      <td><input class="log_box" name="heslo2" maxlengtd="15" type="password" placeholder="<?php echo $reg_heslo2; ?>" id="heslo2" /></td>
    </tr>
    <tr>
      <td><div class="l_podm"><input type="checkbox" id="check"><?php echo $reg_podm2; ?> <a href='<?php echo $url; ?>podminky.txt' target='_blank'><span style="color: #1c1c1c; font-decoration:underline;"><?php echo $reg_podm3; ?></span></a>.</div></td>
    </tr>
        <tr>
      <td><input class="r_box" type="submit" name="Submit" value="<?php echo $reg_pot; ?>" /></td>
    </tr>
  </table>
</form>
<?php
  zavri_panel();
include ("vzhled/zapati.php");
?>
