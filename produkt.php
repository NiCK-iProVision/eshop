<?php
include ("vzhled/zahlavi.php");




  $dotaz=mysqli_query($pripojeni, "SELECT * FROM produkty where id='".$_GET['id']."'");
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

           otevri_panel($produkt['nazev']);
echo '

            <img src="'.$produkt['obr'].'" width="100%" alt="Nazev" title="Nazev">

            '.$produkt['nazev'].'

          '.$produkt['popis'].'

            '.$produkt['cena'].' Kč

          <a id="dokosiku'.$produkt['id'].'" class="polozka_kup" alt="Do košíku" title="Do košíku">Do košíku</a>

';
  }





  zavri_panel();

include ("vzhled/zapati.php");
?>
