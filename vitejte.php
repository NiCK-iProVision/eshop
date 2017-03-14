<?php
include ("vzhled/zahlavi.php");

  if ($_GET['e']==1) { ?>
    <div id="zprava" class="reg_err"><?php echo $prvni_login4; ?>
  <script src='<?php echo $url; ?>vzhled/js.js'></script>
    </div>
<?php }
if ($_GET['e']==2) { ?>
  <div id="zprava" class="reg_err"><?php echo $prvni_login5; ?>
<script src='<?php echo $url; ?>vzhled/js.js'></script>
  </div>
<?php }
  otevri_panel($prvni_login);
  echo "<h3>$prvni_login2</h3></p>";
  echo '<form name="loginform" method="post" action="/">';
  echo $jazyk_zmena." &quot;<b>$jazyk</b>&quot;. $jazyk_zmena2. <br> <br>";
  echo $prvni_login3." <br><br>
  <hr><br>
  <table width='100%'>
    <tr>
      <td width='50%'>
        <input type='text' class='b_box' placeholder='$reg_jmeno' name='jmeno'><br>
        <input type='text' class='b_box' placeholder='$reg_prijmeni' name='prijmeni'><br>
        <input type='text' class='b_box' placeholder='$reg_tel' name='tel'><br>
        <input type='text' class='b_box' placeholder='$reg_neco' name='neco'><br>
      </td><td>
        <input type='text' class='b_box' placeholder='$reg_ulice' name='ulice'><br>
        <input type='text' class='b_box' placeholder='$reg_obec' name='obec'><br>
        <input type='text' class='b_box' placeholder='$reg_psc' name='psc'><br>
        <input type='text' class='b_box' placeholder='$reg_stat' name='stat'><br>
      </td>
    </tr>
  </table>
<input type='hidden' name='ipv_dokonci' value='1'>";
  echo '<p align="center"><input type="submit" name="Submit" class="a_box" value="'.$reg_dok.'" /></p>';
  echo "<p class='nepov'>(Nepovinné)</p></form><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
  zavri_panel();

include ("vzhled/zapati.php");
?>
