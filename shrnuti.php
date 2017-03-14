<?php
include ("vzhled/zahlavi.php");
otevri_panel("Dokončení objednávky č.".$_POST['cislo_obj']."");


if (!empty($_POST['jmeno']) and !empty($_POST['prijmeni']) and !empty($_POST['tel']) and !empty($_POST['mail']) and !empty($_POST['ulice1']) and !empty($_POST['obec1']) and !empty($_POST['psc1']) and !empty($_POST['stat1']) and !empty($_POST['platba']) and !empty($_POST['doprava'])) {
  $dotaz=mysqli_query($pripojeni, "SELECT * FROM kosik where uzivatel='".$_SESSION['SESS_ID']."'");
       while ($polozka = mysqli_fetch_assoc($dotaz)) {
         $dotaz_2=mysqli_query($pripojeni, "SELECT * FROM produkty where id='".$polozka['produkt']."'");
              while ($produkt = mysqli_fetch_assoc($dotaz_2)) {
                mysqli_query($pripojeni, "INSERT INTO objednane_produkty(produkt, id_o, ks) VALUES('".$produkt['id']."','".$_POST['cislo_obj']."','".$polozka['mnozstvi']."')");
              }}
  $cas=Time();
  $lol=mysqli_query($pripojeni, "INSERT INTO objednavky(id_o, uzivatel, cas, jmeno_f, prijmeni_f, tel_f, mail_f, ulice_f, obec_f, psc_f, stat_f, ulice_d, obec_d, psc_d, stat_d, ic, dic, obch_jm, platba, doprava)
  VALUES('".$_POST['cislo_obj']."','".$_SESSION['SESS_ID']."','".$cas."','".$_POST['jmeno']."','".$_POST['prijmeni']."','".$_POST['tel']."','".$_POST['mail']."','".$_POST['ulice1']."','".$_POST['obec1']."','".$_POST['psc1']."','".$_POST['stat1']."','".$_POST['ulice2']."','".$_POST['obec2']."','".$_POST['psc2']."','".$_POST['stat2']."','".$_POST['ic']."','".$_POST['dic']."','".$_POST['obch_jm']."','".$_POST['platba']."','".$_POST['doprava']."')");
echo "<h2><p align='center'>$ok_kup</p></h2>";
?>
<table align="center" width="750" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" width="275" style="border: 1px solid black;">
      <strong><?php echo $dodavatel; ?></strong><br><br>
      OpenElectro s.r.o.<br>
      Vavřinecká 254/14<br>
      Litoměřice 412 01<br>
      Czech Republic
    </td>
    <td valign="top" width="200" style="border-bottom: 1px solid black;">
      <h2><p align="center"><?php echo $dodaci_list; ?></p></h2><br>
      <?php echo $cislo_objed; ?>: <?php echo $_POST['cislo_obj']; ?><br>
      <?php echo $ze_dne; ?>: <?php echo StrFTime("%d/%m/%Y %H:%M", Time()); ?>
    </td>
    <td valign="top" width="275" style="border: 1px solid black;">
      <strong><?php echo $odberatel; ?></strong><br><br>
      <strong><?php echo $f_adr; ?>:</strong><br>
      <?php echo $_POST['jmeno']." ".$_POST['prijmeni']."<br>";
      echo $_POST['ulice1']."<br>";
      echo $_POST['obec1']." ".$_POST['psc1']."<br>";
      echo $_POST['stat1']."<br>";

      if (!empty($_POST['ulice2'])) {
        echo "<br><br><strong>$doruc_adr:</strong><br>";
        echo $_POST['ulice2']."<br>";
        echo $_POST['obec2']." ".$_POST['psc2']."<br>";
        echo $_POST['stat2'];
      }
       if (!empty($_POST['ic'])) {
        echo "<br><br>";
        echo "IČ: ".$_POST['ic']."<br>";
        echo "DIČ: ".$_POST['dic'];
      }?>
    </td>
  </tr>
</table>
<table align="center" width="750" cellpadding="0" cellspacing="0">
  <tr>
    <td class="td_k">
      <?php echo $id_p; ?>
    </td>
    <td class="td_k">
      <?php echo $nazev_p; ?>
    </td>
    <td class="td_k">
      <?php echo $ks_p; ?>
    </td >
    <td class="td_k">
      <?php echo $cena_p; ?>
    </td>
  </tr>
<?php
$dotaz=mysqli_query($pripojeni, "SELECT * FROM kosik where uzivatel='".$_SESSION['SESS_ID']."'");
     while ($polozka = mysqli_fetch_assoc($dotaz)) {
       $dotaz_2=mysqli_query($pripojeni, "SELECT * FROM produkty where id='".$polozka['produkt']."'");
            while ($produkt = mysqli_fetch_assoc($dotaz_2)) {
                  echo '
                  <tr>
                    <td class="td_k">
                      '.$produkt['id'].'
                    </td>
                    <td class="td_k">
                      '.$produkt['nazev'].'
                    </td>
                    <td class="td_k">
                    '.$polozka['mnozstvi'].'
                    </td>
                    <td class="td_k">
                    '.number_format($produkt['cena'], 2).' Kč
                    </td>
                  </tr>';
            }}
            $cena_vysl=0;
            $cena_p=mysqli_query($pripojeni, "SELECT * FROM kosik where uzivatel='".$_SESSION['SESS_ID']."'");
            while ($cena = mysqli_fetch_assoc($cena_p)) {
              $mnozstvi=$cena['mnozstvi'];
                $cena_a=mysqli_query($pripojeni, "SELECT * FROM produkty where id='".$cena['produkt']."'");
                while ($cena2 = mysqli_fetch_assoc($cena_a)) {
                    $cena_x=$cena2['cena'] * $mnozstvi;
                    $cena_vysl=$cena_vysl + $cena_x;
                  }
              }
              if ($_POST['doprava'] == 1) {
                echo '
                <tr>
                  <td class="td_k">
                    #
                  </td>
                  <td class="td_k">
                    '.$cp.'
                  </td>
                  <td class="td_k">
                  1
                  </td>
                  <td class="td_k">
                  '.number_format("60", 2).' Kč
                  </td>
                </tr>';
                $cena_vysl=$cena_vysl+60;
              }
              if ($_POST['doprava'] == 2) {
                echo '
                <tr>
                  <td class="td_k">
                    #
                  </td>
                  <td class="td_k">
                    '.$ppl.'
                  </td>
                  <td class="td_k">
                  1
                  </td>
                  <td class="td_k">
                  '.number_format("80", 2).' Kč
                  </td>
                </tr>';
                $cena_vysl=$cena_vysl+80;
              }
              if ($_POST['doprava'] == 3) {
                echo '
                <tr>
                  <td class="td_k">
                    #
                  </td>
                  <td class="td_k">
                  '.$dpd.'
                  </td>
                  <td class="td_k">
                  1
                  </td>
                  <td class="td_k">
                  '.number_format("70", 2).' Kč
                  </td>
                </tr>';
                $cena_vysl=$cena_vysl+70;
              }
              if ($_POST['doprava'] == 4) {
                echo '
                <tr>
                  <td class="td_k">
                    #
                  </td>
                  <td class="td_k">
                    '.$osob.'
                  </td>
                  <td class="td_k">
                  1
                  </td>
                  <td class="td_k">
                  '.number_format("0", 2).' Kč
                  </td>
                </tr>';
              }
              if ($_POST['platba'] == 1) {
                echo '
                <tr>
                  <td class="td_k">
                    #
                  </td>
                  <td class="td_k">
                  '.$dob.'
                  </td>
                  <td class="td_k">
                  1
                  </td>
                  <td class="td_k">
                  '.number_format("45", 2).' Kč
                  </td>
                </tr>';
                $cena_vysl=$cena_vysl+45;
              }
              if ($_POST['platba'] == 2) {
                echo '
                <tr>
                  <td class="td_k">
                    #
                  </td>
                  <td class="td_k">
                  '.$pred.'
                  </td>
                  <td class="td_k">
                  1
                  </td>
                  <td class="td_k">
                  '.number_format("0", 2).' Kč
                  </td>
                </tr>';
              }
              echo '
              <tr>
                <td class="td_k">
                  #
                </td>
                <td class="td_k">
                  '.$celkem.'
                </td>
                <td class="td_k">

                </td>
                <td class="td_k">
                '.number_format($cena_vysl, 2).' '.$kc.'
                </td>
              </tr>';

?>
</table>
<?php
 mysqli_query($pripojeni, "DELETE FROM kosik WHERE uzivatel = '".$_SESSION['SESS_ID']."'");
} else {
echo "<h2><p align='center'>$chyba_kup</p></h2>";
}

zavri_panel();
include ("vzhled/zapati.php");
 ?>
