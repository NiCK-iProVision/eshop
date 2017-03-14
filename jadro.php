<?php
session_start();
//iProVisionCMS v3.0 Release 1419 | GNU LGPL v3 Open-Source
//RS.Štricz.eu ,build 16020615/47
//RS Napsal Štěpán Štricz © 2016| www.stricz.eu
//CMS Writed by Štěpán Štricz © 2016| www.stricz.eu
//Výpis chyb
error_reporting(E_ALL);

//Nastavení MySQLi a jazyka
$jazyk = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
switch ($jazyk){
    case "cs":
        include 'jazyk/czech.php';
        break;
    case "en":
        include 'jazyk/english.php';
        break;
    default:
				include 'jazyk/czech.php';
        break;
}

$pripojeni = mysqli_connect('localhost', 'stricz', '524136kk', 'oe');
if(!$pripojeni) {
die("<div style='text-align: center;font-family: arial;'><h1>:( Upss...</h1> <h2>$db_chyba1</h2> $db_chyba2</div>");
}
//Kódovnání MySQL UTF-8 - Neměnit bezdůvodně!!!
mysqli_set_charset($pripojeni,"utf8");
//Přidat množství
if (isset($_GET['plus'])) {
  $polozka=mysqli_query($pripojeni, "SELECT * FROM kosik where id='".$_GET['plus']."'");
   while ($mnozstvi = mysqli_fetch_assoc($polozka)) {
      $mnozstvi1=$mnozstvi['mnozstvi'] +1;
      mysqli_query($pripojeni, "UPDATE kosik SET mnozstvi='$mnozstvi1' where id='".$_GET['plus']."' AND  uzivatel='".$_SESSION['SESS_ID']."'");
      echo $mnozstvi['mnozstvi'] +1;
   }
   exit();
}
//Výsledná cena
if ($_GET['obnovit_cenu']==1) {
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

              echo number_format($cena_vysl ,2)." Kč";
    exit();
}
//Ubrat množství
if (isset($_GET['minus'])) {
  $polozka=mysqli_query($pripojeni, "SELECT * FROM kosik where id='".$_GET['minus']."'");
   while ($mnozstvi = mysqli_fetch_assoc($polozka)) {
     if ($mnozstvi['mnozstvi']!=1) {
      $mnozstvi1=$mnozstvi['mnozstvi'] -1;
      mysqli_query($pripojeni, "UPDATE kosik SET mnozstvi='$mnozstvi1' where id='".$_GET['minus']."' AND  uzivatel='".$_SESSION['SESS_ID']."'");
      echo $mnozstvi['mnozstvi']-1;
   } else {
     echo $mnozstvi['mnozstvi'];
   }}
   exit();
}

//Přidat do košíku (Přihlášen)
if (isset($_GET['id']) and isset($_GET['uziv']))
{
 if(!isset($_SESSION['SESS_ID']) || (trim($_SESSION['SESS_ID']) == '')) {
?>
<script>
alert("<?php echo $kosik_chyba3; ?>");
</script>
<?php
} else {
  $cas=Time();
  $uziv=$_SESSION['SESS_ID'];
  $produkt=$_GET['id'];
  $existuje=mysqli_query($pripojeni, "SELECT * FROM kosik where produkt='$produkt' AND  uzivatel='$uziv'");
  $pocet = mysqli_num_rows($existuje);
   while ($pocet2 = mysqli_fetch_assoc($existuje)) {
      $pocet3=$pocet2['mnozstvi'];
   }
  if ($pocet==1) {
    $pridat=$pocet3 + 1;
    mysqli_query($pripojeni, "UPDATE kosik SET mnozstvi='$pridat' where produkt='$produkt' AND  uzivatel='$uziv'");
    $dotaz=mysqli_query($pripojeni, "SELECT * FROM kosik WHERE uzivatel='".$uziv."'");
    $pocet = mysqli_num_rows($dotaz);
    echo 'Košík ('.$pocet.')</a>';
  } else {
    if (!isset($mnozstvi)) {
      $mnozstvi="1";
    }
    $vlozit_do_kosiku = mysqli_query($pripojeni, "INSERT INTO kosik(produkt, uzivatel, mnozstvi, cas) VALUES('$produkt','$uziv','$mnozstvi','$cas')");
  if($vlozit_do_kosiku) {
      $dotaz=mysqli_query($pripojeni, "SELECT * FROM kosik WHERE uzivatel='".$uziv."'");
      $pocet = mysqli_num_rows($dotaz);
      echo 'Košík ('.$pocet.')';
  }else {
      $dotaz=mysqli_query($pripojeni, "SELECT * FROM kosik WHERE uzivatel='".$uziv."'");
      $pocet = mysqli_num_rows($dotaz);
      echo 'Košík ('.$pocet.')</a>';
      ?>
      <script>
      alert("<?php echo $kosik_chyba; ?>");
      </script>
      <?php
  }}
  ?>
  <script>
$(document).ready(function(){
  $( "#pridano_do_kosiku" ).toggle( "400", function() {
  });
function skryt(){
  $( "#pridano_do_kosiku" ).toggle( "400", function() {
  });
}
setTimeout(skryt, 500);
});
  </script>
<?php
}
exit();
}
//Košík počet
if ($_GET['pocet']==1) {
  $dotaz=mysqli_query($pripojeni, "SELECT * FROM kosik WHERE uzivatel='".$_SESSION['SESS_ID']."'");
  $pocet = mysqli_num_rows($dotaz);
  echo 'Košík ('.$pocet.')</a>';
  exit();
}
//Smazat z košíku
if (isset($_GET['smazat']))
{
  $uziv=$_SESSION['SESS_ID'];
  $produkt=$_GET['smazat'];

  $dotaz=mysqli_query($pripojeni, "SELECT * FROM kosik where id='".$_GET['smazat']."'");
       while ($polozka = mysqli_fetch_assoc($dotaz)) {
         if ($polozka['uzivatel']==$uziv) {
              $smazat_z_kosiku = mysqli_query($pripojeni, "DELETE FROM kosik WHERE id = $produkt");
                if($smazat_z_kosiku) {

                  } else {
                    ?>
                      <script>
                      alert("<?php echo $kosik_chyba; ?>");
                      </script>
                    <?php
                  }
                  } else {
  ?>
  <script>
  alert("<?php echo $kosik_chyba2; ?>");
  </script>
  <?php
}
}
exit();
}
//Prazdný košík
if ($_GET['kontrola']==1) {
  $pocet=mysqli_query($pripojeni, "SELECT * FROM kosik where  uzivatel='".$_SESSION['SESS_ID']."'");
  $pocet2 = mysqli_num_rows($pocet);
  if ($pocet2 == 0) {
  echo $kosik_prazdny;
  ?>
  <script>
  $('#pokr').hide();
  </script>
  <?php
  }
  exit();
}
//Nastavení webu
$url="http://openelectro.8u.cz/";
$nazev="OpenElectro";
$popis="Jednička v elektronice";
$autor="Štěpán Štricz";
$info_pro_roboty="index,follow"; //Bez nutnosti neměnit
$klicova_slova="elektronika, eshop, shop, levne, rychle, doprava, zdarma"; //Klíčová slova pro vyhledáváč, oddělovat čárkou
$url_shortcut_ikonka="http://localhost/vzhled/ikonka.ico";  //přípona .ico nebo .png
//Nastavení CMS
$kodovani="utf-8";
$clanku_na_stranu="6";
//Prihlaseni
if($_POST['ipv_prihlas']==1) {
	$errmsg_arr = array();
	$errflag = false;
$mail=mysqli_real_escape_string ($pripojeni , $_POST['login']);
$heslo=mysqli_real_escape_string ($pripojeni , $_POST['heslo']);
	if($mail == '') {
		$errmsg_arr[] =   $reg_ch5;
		$errflag = true;
	}
	if($heslo == '') {
		$errmsg_arr[] =  $reg_ch1;
		$errflag = true;
	}
		if($errflag) {
		session_write_close();
			$chyba=1;
	} else {
	$result=mysqli_query($pripojeni, "SELECT * FROM uzivatele WHERE heslo='".md5($_POST['heslo'])."' AND mail='".$mail."'");
  if($result) {
		if(mysqli_num_rows($result) == 1) {
			session_regenerate_id();
			$member = mysqli_fetch_assoc($result);
			$_SESSION['SESS_ID'] = $member['id'];
			$_SESSION['SESS_ADMIN'] = $member['admin'];
if (empty($member['jmeno'])) {
	?>
	<script>
	window.location.href="<?php echo $url; ?>vitejte.php";
	</script>
	<?php
}
			session_write_close();

			$ok=1;
		}else {
			$chyba=1;
		}
	}else {
			$chyba=1;
	}}}
//Ohlášení
	if($_POST['ipv_odhlas']==1)
	{
	unset($_SESSION['SESS_ID']);
	unset($_SESSION['SESS_LOGIN']);
	unset($_SESSION['SESS_ADMIN']);
	unset($_SESSION['SESS_MAIL']);
	}
//Registrace
	if($_POST['ipv_registruj']==1) {

	$errmsg_arr = array();
	$errflag = false;
$mail=mysqli_real_escape_string ($pripojeni , $_POST['mail']);
$mail2=mysqli_real_escape_string ($pripojeni , $_POST['mail2']);
$heslo=mysqli_real_escape_string ($pripojeni , $_POST['heslo']);
$heslo2=mysqli_real_escape_string ($pripojeni , $_POST['heslo2']);
	if($heslo == '') {
		$errmsg_arr[] =  $reg_ch1;
		$errflag = true;
	}
	if($heslo2 == '') {
		$errmsg_arr[] =  $reg_ch2;
		$errflag = true;
	}
	if( strcmp($heslo, $heslo2) != 0 ) {
		$errmsg_arr[] =  $reg_ch3;
		$errflag = true;
	}
	if( strcmp($mail, $mail2) != 0 ) {
		$errmsg_arr[] =  $reg_ch4;
		$errflag = true;
}
 	if($mail == '') {
		$errmsg_arr[] =  $reg_ch5;
		$errflag = true;
	}
  if (preg_match("#^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$#i", $mail)) {}
  else {
    $errmsg_arr[] =  $reg_ch6;
		$errflag = true;
  }
	if($mail != '') {
		$result = mysqli_query($pripojeni, "SELECT * FROM uzivatele WHERE mail='$mail'");
		if($result) {
			if(mysqli_num_rows($result) > 0) {
				$errmsg_arr[] =  $reg_ch7;
				$errflag = true;
			}
		}
    else {
			$err=1;
		}
	}
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();

		$err=1;
	} else {
    $cas2=Time();
	$result = mysqli_query($pripojeni, "INSERT INTO uzivatele(heslo, admin, mail, ip, datum_registrace) VALUES('".md5($_POST['heslo'])."','0','$mail','".$_SERVER['REMOTE_ADDR']."','".$cas2."')");
	if($result) {
			$ok2=1;
	}else {
		$err=1;
	}

	}}

	if($_POST['ipv_dokonci']==1)
	{
$id_clena=$_SESSION['SESS_ID'];
$jmeno=$_POST['jmeno'];
$prijmeni=$_POST['prijmeni'];
$neco=$_POST['neco'];
$tel=$_POST['tel'];
$ulice=$_POST['ulice'];
$obec=$_POST['obec'];
$psc=$_POST['psc'];
$tel=$_POST['tel'];
$stat=$_POST['stat'];
if (empty($jmeno) or empty($prijmeni) or empty($tel) or empty($ulice) or empty($obec) or empty($psc) or empty($tel) or empty($stat)) {
	?>
	<script>
	window.location.href="<?php echo $url; ?>vitejte.php?e=2";
	</script>
	<?php
} else {

		mysqli_query($pripojeni, "UPDATE uzivatele SET jmeno = '$jmeno', prijmeni = '$prijmeni', tel = '$tel', ulice = '$ulice', obec = '$obec', psc = '$psc', tel = '$tel', stat = '$stat', neco = '$neco' WHERE id = '$id_clena'");
		?>
		<script>
		window.location.href="<?php echo $url; ?>";
		</script>
		<?php

			}
	}
if($_SERVER["REQUEST_URI"]!="/vitejte.php" and $_SERVER["REQUEST_URI"]!="/vitejte.php?e=1" and $_SERVER["REQUEST_URI"]!="/vitejte.php?e=2") {
	if(isset($_SESSION['SESS_ID'])) {

	$id_clena=$_SESSION['SESS_ID'];
		$result=mysqli_query($pripojeni, "SELECT * FROM uzivatele WHERE id='$id_clena'");
	  if($result) {
			if(mysqli_num_rows($result) == 1) {
				session_regenerate_id();
				$member = mysqli_fetch_assoc($result);
	if (empty($member['stat'])) {
		?>
		<script>
		window.location.href="<?php echo $url; ?>vitejte.php";
		</script>
		<?php
	}}}

	}}


?>
