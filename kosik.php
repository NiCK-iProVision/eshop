<?php
include ("vzhled/zahlavi.php");
otevri_panel($kosik);
echo "<table width='750' cellspacing='0' cellpadding='0'>";
echo '<tr class="kosik_radek"><td width="50" class="k_cena">-</td>  <td width="550" class="k_cena">Název produktu</td><td width="150" class="k_cena">Cena</td><td width="30" class="k_cena">Ks</td><td width="50" class="k_cena">-</td><td width="20" class="k_cena">-</td></tr>';
  $dotaz=mysqli_query($pripojeni, "SELECT * FROM kosik where uzivatel='".$_SESSION['SESS_ID']."'");
       while ($polozka = mysqli_fetch_assoc($dotaz)) {
         $dotaz_2=mysqli_query($pripojeni, "SELECT * FROM produkty where id='".$polozka['produkt']."'");
              while ($produkt = mysqli_fetch_assoc($dotaz_2)) {
                ?>
                <script>
                $(document).ready(function(){
                  function obnov(){
                    $("#vysl_cena").load("jadro.php?obnovit_cenu=1");
                  }
                  function kontrola(){
                  $("#k_prazdny").load("jadro.php?kontrola=1");
                  }
                  function kosik_p(){
                    $("#kosik_pocet").load("jadro.php?pocet=1");
                  }
                  $("#smazat<?php echo $polozka['id']; ?>").click(function(){
                    $("#produkt<?php echo $polozka['id']; ?>").load("jadro.php?smazat=<?php echo $polozka["id"]; ?>");
                      setTimeout(kosik_p, 400);
                      setTimeout(kontrola, 300);
                      setTimeout(obnov, 200);
                  });
                  $("#plus<?php echo $polozka['id']; ?>").click(function(){
                    $("#mn<?php echo $polozka['id']; ?>").load("jadro.php?plus=<?php echo $polozka["id"]; ?>");
                    setTimeout(obnov, 200);
                  });
                  $("#minus<?php echo $polozka['id']; ?>").click(function(){
                    $("#mn<?php echo $polozka['id']; ?>").load("jadro.php?minus=<?php echo $polozka["id"]; ?>");
                    setTimeout(obnov, 200);
                  });
                });
                </script>
                <?php
                echo '<tr class="kosik_radek" id="produkt'.$polozka['id'].'">
                        <td width="50"><img src="'.$produkt['obr'].'" width="40" height="40"></td>
                        <td width="550"><a href="'.$url.'produkt/'.$produkt['id'].'/" title="'.$produkt['nazev'].'" class="k_nazev" alt="'.$produkt['nazev'].'">'.$produkt['nazev'].'</a></td>
                        <td width="150" class="k_cena">'.number_format($produkt['cena'], 2).' Kč</td>
                        <td width="30" id="mn'.$polozka['id'].'">'.$polozka['mnozstvi'].' </td>
                        <td width="50"><div class="plus" id="plus'.$polozka['id'].'">+</div> <div class="minus" id="minus'.$polozka['id'].'">-</div> </td>
                        <td width="20"><a href="#" class="k_smaz" id="smazat'.$polozka['id'].'">'.$kosik_odstranit.'</a></td>
                    </tr>';
                      ?>
                      <script>
                      $("#smazat<?php echo $polozka['id']; ?>").click(function () {
                        $("#produkt<?php echo $polozka['id']; ?>").css("display","none")
                      });
                      </script>
                      <?php
              }}
              echo "</table>";
            $pocet=mysqli_query($pripojeni, "SELECT * FROM kosik where  uzivatel='".$_SESSION['SESS_ID']."'");
            $pocet2 = mysqli_num_rows($pocet);
          if ($pocet2 == 0) {
            echo "<div class='k_prazdny'>".$kosik_prazdny."</div>";
          }
          echo "<div class='k_prazdny' id='k_prazdny'></div>";

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

      echo "<br><div class='k_cena_style2'>$kosik_cena</div> <div class='k_cena_style' id='vysl_cena'>".number_format($cena_vysl, 2)." Kč</div>";
      if ($pocet2 > 0) {
        echo "<div id='pokr'><a href='".$url."objednavka/1/' class='pokracuj'>Pokračovat v nákupu</a></div>";
  }
zavri_panel();
include ("vzhled/zapati.php");
?>
