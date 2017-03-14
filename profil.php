<?php
include ("vzhled/zahlavi.php");



  $dotaz=mysqli_query($pripojeni, "SELECT * FROM uzivatele where id='".$_GET['id']."'");
       while ($profil = mysqli_fetch_assoc($dotaz)) {
           otevri_panel($profil['jmeno']." ".$profil['prijmeni']);
echo '

            <img src="'.$profil['avatar'].'" width="200" alt="Nazev" title="Nazev">

            '.$produkt['nazev'].'

          '.$produkt['popis'].'

            '.$produkt['cena'].' Kč

          <a id="dokosiku'.$profil['id'].'" class="polozka_kup" alt="Do košíku" title="Do košíku">Do košíku</a>

';
  zavri_panel();
  }




include ("vzhled/zapati.php");
?>
