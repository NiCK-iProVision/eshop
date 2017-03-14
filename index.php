<?php
include ("vzhled/zahlavi.php");
  otevri_panel($novinky);
  $dotaz=mysqli_query($pripojeni, "SELECT * FROM produkty order by pridano desc limit 12");
       while ($produkt = mysqli_fetch_assoc($dotaz)) {
         ?>
         <script>
         $(document).ready(function(){
           $("#dokosiku<?php echo $produkt['id']; ?>").click(function(){
             $("#kosik_pocet").load("jadro.php?id=<?php echo $produkt["id"]; ?>&uziv=<?php echo $_SESSION['SESS_ID']; ?>");
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
  zavri_panel();
include ("vzhled/zapati.php");
?>
