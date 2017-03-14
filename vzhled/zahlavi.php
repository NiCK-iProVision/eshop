<?php
include_once(dirname(__FILE__).'/../jadro.php');
echo "<!DOCTYPE html>\n";
  echo "<html>\n";
    echo "<head>\n";
      echo "\t<title>".$nazev."</title>\n";
      echo "\t<meta http-equiv='Content-Type' content='text/html; charset=".$kodovani."' />\n";
      echo "\t<meta name='description' content='".$popis."' />\n";
      echo "\t<meta name='keywords' content='".$klicova_slova."' />\n";
      echo "\t<meta name='author' content='".$autor."' />\n";
      echo "\t<meta name='robots' content='".$info_pro_roboty."' />\n";
      echo "\t<link rel='stylesheet' href='".$url."vzhled/css.css' type='text/css' />\n";
      echo "\t<link rel='shortcut icon' href='".$url_shortcut_ikonka."' type='image/x-icon' />\n";
      echo "\t<script src='//code.jquery.com/jquery-1.10.2.js'></script>\n";
      echo "\t<script src='//code.jquery.com/ui/1.11.3/jquery-ui.js'></script>\n";
     //Funkce
     function otevri_panel($nazev) {
       echo "<div class='n_panel'>$nazev</div><div class='o_panel'>";
     }
     function zavri_panel() {
       echo "</div>";
     }
      ?>
  </head>
  <body>



    <div class="zahlavi">
       <span class="logo">
        OpenElectro
       </span>
       <span class="podnadpis">
       Internetový obchod
       </span>

<div class="pridano_do_kosiku" id="pridano_do_kosiku">+</div>
       <?php
       if(!isset($_SESSION['SESS_ID']) || (trim($_SESSION['SESS_ID']) == '')) {
       ?>
            <div id="prihlaseni1" class="prihlaseni">
               <div id="prihlaseni2" class="prihl_tab">
                 <a href="#" id="login2" alt="Zavřít" title="Zavřít">X</a>
                 <span class="prihl">Přihlášení</span>
                 <form id="loginForm" name="loginForm" method="post" action="">
                   <input name="ipv_prihlas" type="hidden" value="1" />
                   <input name="login" type="text" placeholder="Váš email" class="box1">
                   <input name="heslo" type="password" placeholder="Váše heslo" class="box2">
                   <input type="submit" value="Přihlásit" name="Submit" class="box3">
                 </form>
               </div>
            </div>
       <a href="#" id="login" alt="Přihlášení" title="Přihlášení">Přihlášení</a>
       <a href="<?php echo $url; ?>registrace/" id="registrace" alt="Registrace" title="Registrace">Registrace</a>
       <a href="<?php echo $url; ?>kosik/" alt="Košík" title="Košík" class="kosik" style="display:none;" id="kosik_pocet">Košík (<?php echo $pocet; ?>)</a>
       <?php
       } else {
       $uzivatel=mysqli_query($pripojeni, "SELECT * FROM uzivatele where id=".$_SESSION["SESS_ID"]."");
       while ($uzivatel=mysqli_fetch_assoc($uzivatel))
       {
echo "<table style='position:absolute; top: 5px; right: 4px;'><tr><td>";
}
echo "<p class='jmeno'>".$jm."</p>";
$uziv=$_SESSION['SESS_ID'];
$dotaz=mysqli_query($pripojeni, "SELECT * FROM kosik WHERE uzivatel='".$uziv."'");
$pocet = mysqli_num_rows($dotaz);
?>

<a href="#" id="login" alt="Nastavení uživatele" title="Nastavení uživatele">profil</a>
<a href="<?php echo $url; ?>kosik/" alt="Košík" title="Košík" class="kosik" id="kosik_pocet">Košík (<?php echo $pocet; ?>)</a>
       <form method="post" action="/">
       <input name="ipv_odhlas" type="hidden" value="1" />
       <input type="submit" value="<?php echo $log_odh; ?>" class="odhlasit"/>
       </form>
       <?php
       echo "</td></tr></table>";
       }
       ?>



    </div>
    <div class="telo">
      <div class="menu">
        <form method="POST" action="hledat.php" class="hledat">
          <input type="hledat" placeholder="Vyhledat ..." class="hledat_input">
          <input type="submit" value="" class="hledat_submit">
        </form>
        <a href="<?php echo $url; ?>" alt="#" title="#" class="polozka"><?php echo $domu; ?></a>
        <a alt="#" title="#" class="polozka"></a>
        <a href="<?php echo $url; ?>akce/" alt="Akce" title="Akce" class="polozka"><?php echo $akce; ?></a>
        <a href="<?php echo $url; ?>kategorie/1" alt="<?php echo $nazev_kat1; ?>" title="<?php echo $nazev_kat1; ?>" class="polozka"><?php echo $nazev_kat1; ?></a>
        <a href="<?php echo $url; ?>kategorie/2" alt="<?php echo $nazev_kat2; ?>" title="<?php echo $nazev_kat2; ?>" class="polozka"><?php echo $nazev_kat2; ?></a>
        <a href="<?php echo $url; ?>kategorie/3" alt="<?php echo $nazev_kat3; ?>" title="<?php echo $nazev_kat3; ?>" class="polozka"><?php echo $nazev_kat3; ?></a>
        <a href="<?php echo $url; ?>kategorie/4" alt="<?php echo $nazev_kat4; ?>" title="<?php echo $nazev_kat4; ?>" class="polozka"><?php echo $nazev_kat4; ?></a>
        <a href="<?php echo $url; ?>kategorie/5" alt="<?php echo $nazev_kat5; ?>" title="<?php echo $nazev_kat5; ?>" class="polozka"><?php echo $nazev_kat5; ?></a>
        <a href="<?php echo $url; ?>kategorie/6" alt="<?php echo $nazev_kat6; ?>" title="<?php echo $nazev_kat6; ?>" class="polozka"><?php echo $nazev_kat6; ?></a>
        <a href="<?php echo $url; ?>kategorie/7" alt="<?php echo $nazev_kat7; ?>" title="<?php echo $nazev_kat7; ?>" class="polozka"><?php echo $nazev_kat7; ?></a>
        <a href="<?php echo $url; ?>kategorie/8" alt="<?php echo $nazev_kat8; ?>" title="<?php echo $nazev_kat8; ?>" class="polozka"><?php echo $nazev_kat8; ?></a>
        <a href="<?php echo $url; ?>kategorie/9" alt="<?php echo $nazev_kat9; ?>" title="<?php echo $nazev_kat9; ?>" class="polozka"><?php echo $nazev_kat9; ?></a>
        <a href="<?php echo $url; ?>kategorie/10" alt="<?php echo $nazev_kat10; ?>" title="<?php echo $nazev_kat10; ?>" class="polozka"><?php echo $nazev_kat10; ?></a>
        <img src="<?php echo $url; ?>vzhled/obr/b.gif" alt="Reklama" title="Reklama">
      </div>
      <div class="obsah">
        <?php
            if ($_POST['ipv_odhlas']==1) { ?>
            <div id="zprava" class="reg_err">
              <?php echo $log_odhl; ?>
        <script src='<?php echo $url; ?>vzhled/js.js'></script>
            </div>
            <?php
          } if ($chyba==1) { ?>
            <div id="zprava" class="reg_err"><?php echo $log_chyba; ?>
          <script src='<?php echo $url; ?>vzhled/js.js'></script>
            </div>
            <?php } ?>
