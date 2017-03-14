<?php
include ("vzhled/zahlavi.php");
  if ($_GET['kat']==1)  {
    $nazev_kat=$nazev_kat1;
  }
  if ($_GET['kat']==2)  {
    $nazev_kat=$nazev_kat2;
  }
  if ($_GET['kat']==3)  {
    $nazev_kat=$nazev_kat3;
  }
  if ($_GET['kat']==4)  {
    $nazev_kat=$nazev_kat4;
  }
  if ($_GET['kat']==5)  {
    $nazev_kat=$nazev_kat5;
  }
  if ($_GET['kat']==6)  {
    $nazev_kat=$nazev_kat6;
  }
  if ($_GET['kat']==7)  {
    $nazev_kat=$nazev_kat7;
  }
  if ($_GET['kat']==8)  {
    $nazev_kat=$nazev_kat8;
  }
  if ($_GET['kat']==9)  {
    $nazev_kat=$nazev_kat9;
  }                                
  if ($_GET['kat']==10)  {
    $nazev_kat=$nazev_kat10;
  }                                

  otevri_panel($nazev_kat);

  $dotaz=mysqli_query($pripojeni, "SELECT * FROM produkty where kategorie='".$_GET['kat']."' order by pridano");
       while ($produkt = mysqli_fetch_assoc($dotaz)) {
         ?>
         <script>
         $(document).ready(function(){
           $("#dokosiku<?php echo $produkt['id']; ?>").click(function(){
             $("#kosik_pocet").load("/jadro.php?id=<?php echo $produkt["id"]; ?>&uziv=<?php echo $_SESSION['SESS_ID']; ?>");
           });
         });

         </script>
         <?php
         $produkt['popis_kratky']=substr($produkt['popis_kratky'], 0, 220);
echo '  <div class="polozka_prodej">
          <div class="polozka_obr">
            <img src="'.$produkt['obr'].'" width="100%" alt="Nazev" title="Nazev">
          </div>
           <div class="polozka_nazev">
            '.$produkt['nazev'].'
          </div>
          <div class="polozka_popis">
          '.$produkt['popis_kratky'].' ...
          <div class="polozka_cena">
            '.number_format($produkt['cena'], 2).' '.$kc.'
          </div>
          <a id="dokosiku'.$produkt['id'].'" class="polozka_kup" alt="'.$kat_pridat_kosik.'" title="'.$kat_pridat_kosik.'">'.$kat_pridat_kosik.'</a>
       </div>
       </div>
';
  }

  $pocet=mysqli_query($pripojeni, "SELECT * FROM produkty where kategorie='".$_GET['kat']."' order by pridano");
  $pocet = mysqli_num_rows($pocet);
   if ($pocet<1) {
   echo $kat_prazdno;
   }


  zavri_panel();

include ("vzhled/zapati.php");
?>
