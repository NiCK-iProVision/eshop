<?php
include ("vzhled/zahlavi.php");
$cislo_obj=$_SESSION['SESS_ID']."".rand(0, 9999)."".$_SESSION['SESS_ID']."".rand(0, 999)."";
otevri_panel("$nazev_obj $cislo_obj");
echo '<form action="'.$url.'objednavka/2/" method="post">';
echo "<input type='hidden' name='cislo_obj' value='$cislo_obj'>";
echo "<div class='obj'>$info_obj</div><hr>";
$vypsat_info=mysqli_query($pripojeni, "SELECT * FROM uzivatele where id='".$_SESSION['SESS_ID']."'");
while ($vypis = mysqli_fetch_assoc($vypsat_info)) {
echo "<div class='obj'>$kont</div>
<table width='100%'>
  <tr>
    <td width='50%'>
      <input type='text' class='b_box' placeholder='$reg_jmeno' name='jmeno' value='".$vypis['jmeno']."'><br>
      <input type='text' class='b_box' placeholder='$reg_prijmeni' name='prijmeni' value='".$vypis['prijmeni']."'><br>
      <input type='text' class='b_box' placeholder='$reg_tel' name='tel' value='".$vypis['tel']."'><br>
      <input type='text' class='b_box' placeholder='$reg_mail1' name='mail' value='".$vypis['mail']."'><br>
    </td><td>
      <input type='text' class='b_box' placeholder='$reg_ulice' name='ulice1' value='".$vypis['ulice']."'><br>
      <input type='text' class='b_box' placeholder='$reg_obec' name='obec1' value='".$vypis['obec']."'><br>
      <input type='text' class='b_box' placeholder='$reg_psc' name='psc1' value='".$vypis['psc']."'><br>
      <input type='text' class='b_box' placeholder='$reg_stat' name='stat1' value='".$vypis['stat']."'><br>
    </td>
  </tr>
</table>
";
}
echo "<hr><div class='obj'>$objz</div>";
echo "<table width='750' cellspacing='0' cellpadding='0'>";
echo '<tr class="kosik_radek"><td width="50" class="k_cena">-</td>  <td width="550" class="k_cena">'.$nazev_pr.'</td><td width="150" class="k_cena">'.$cena_o.'</td><td width="30" class="k_cena">'.$kus.'</td></tr>';

$dotaz=mysqli_query($pripojeni, "SELECT * FROM kosik where uzivatel='".$_SESSION['SESS_ID']."'");
     while ($polozka = mysqli_fetch_assoc($dotaz)) {
       $dotaz_2=mysqli_query($pripojeni, "SELECT * FROM produkty where id='".$polozka['produkt']."'");
            while ($produkt = mysqli_fetch_assoc($dotaz_2)) {
              echo '<tr class="kosik_radek" id="produkt'.$polozka['id'].'">
                      <td width="50"><img src="'.$produkt['obr'].'" width="40" height="40"></td>
                      <td width="550"><a href="'.$url.'produkt/'.$produkt['id'].'/" title="'.$produkt['nazev'].'" class="k_nazev" alt="'.$produkt['nazev'].'">'.$produkt['nazev'].'</a></td>
                      <td width="150" class="k_cena">'.number_format($produkt['cena'], 2).' Kč</td>
                      <td width="30" id="mn'.$polozka['id'].'">'.$polozka['mnozstvi'].' </td>
                  </tr>';
            }}
              echo "</table>";
              echo "<hr>";


echo "<table width='100%'>
  <tr>
    <td width='50%'>
    <div class='obj'>$doruc</div>
    <input type='text' class='b_box' placeholder='$reg_ulice' name='ulice2'><br>
    <input type='text' class='b_box' placeholder='$reg_obec' name='obec2'><br>
    <input type='text' class='b_box' placeholder='$reg_psc' name='psc2'><br>
    <input type='text' class='b_box' placeholder='$reg_stat' name='stat2'><br>
    </td><td>
    <div class='obj'>$firma</div>
    <input type='text' class='b_box' placeholder='$ic' name='ic'><br>
    <input type='text' class='b_box' placeholder='$dic' name='dic'><br>
    <input type='text' class='b_box' placeholder='$obch_jm' name='obch_jm'><br>
    </td>
  </tr>
</table>";


              echo "<hr>";

              echo "<table width='100%'>
                <tr>
                  <td width='35%'>
                  <div class='obj'>$zp</div>
                  <select name='platba'>
                    <option value='1'>$dob</option>
                    <option value='2'>$pred</option>
                  </select>
                  </td><td width='35%'>
                  <div class='obj'>$zpd</div>
                  <select name='doprava'>
                    <option value='1'>$cp</option>
                    <option value='2'>$ppl</option>
                    <option value='3'>$dpd</option>
                    <option value='4'>$osob</option>
                  </select>
                  </td>
                  <td width='25%'>";
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
                  echo "<div class='obj'>$cekl_cena:</div> <strong>".number_format($cena_vysl, 2)." $kc</strong>";
                  echo "</td>
                  <td width='100'><br>
                  <input type='submit' class='potvrdit' value='$pot_ob'>
                  </td>
                </tr>
              </table></form>";



zavri_panel();
include ("vzhled/zapati.php");
?>
