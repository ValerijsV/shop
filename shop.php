<h2>Veikals</h2>

<script>
function kategorija(kategorijasid) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("saturs").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","shop.php?cat="+kategorijasid,true);
    xmlhttp.send();
    document.getElementById("meklesanas_logs").value = "";

}
</script>

<?php

if (isset($_GET["q"]) || isset($_GET["cat"])) {
  include 'config.php';
}

if (!isset($_SESSION["grozs"])) {
  //ja grozs nav definēts, izveidojam to
  $_SESSION["grozs"] = [];
}

if (isset($_GET["ielikt"])) {
  $id = $_GET["ielikt"];
  $prece = array("id"=>"$id", "daudzums"=>"1");

  //$key = array_search($id, array_column($_SESSION["grozs"], 'id'));
  $preces_numurs = ""; //pieņemam, ka ievietoamā prece grozā nav
  foreach ($_SESSION["grozs"] as $indekss=>$tekosa_prece) {
    if ($tekosa_prece["id"] == $id) { 
      //ja tekošās groza preces id sakrīt ar ievietojamās preces id, tad piefiksējam tekošās preces indeksu
      $preces_numurs = $indekss;
    }
  }
  //noskaidrojam, vai šī prece jau ir grozā
  if ($preces_numurs == "") {
      //ja pievienojamā prece nav grozā, tad to ieliekam
      array_push($_SESSION["grozs"], $prece);
  } else {
      //ja prece jau ir grozā, palielinām tās daudzumu
      $_SESSION["grozs"][$preces_numurs]["daudzums"] += 1;
  }
  echo "<p>Prece pievienota grozam!<p>";
}

if (isset($_GET["prece"])) {
  //ja saitē ir parametrs prece, tad jādrukā viena prece (prece ir atvērta)
//========================= DRUKĀJAM VIENU PRECI ====================================
  $sql = "SELECT preces.id, preces.nosaukums, preces.cena, preces.foto, preces.apraksts, preces.noliktava, kategorijas.nosaukums AS kat_nosaukums FROM preces INNER JOIN kategorijas ON preces.kategorijas_id=kategorijas.id WHERE preces.id=" . $_GET["prece"];
  //echo $sql;
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    
    $id = $row["id"];
    $nosaukums = $row["nosaukums"];
    $cena = $row["cena"];
    $foto = $row["foto"];
    $apraksts = $row["apraksts"];
    $kategorija = $row["kat_nosaukums"];
    $noliktava = $row["noliktava"];

    echo "<p>VEIKALS -> <a href='#'>$kategorija</a></p>";
    echo "<h4>$nosaukums</h4>";
    echo "<p>Cena $cena EUR</p>";
    echo "<img src='$foto' width='300'><br>";
    echo $apraksts;
  }
//========================= BEIDZAS VIENAS PRECES DRUKĀŠANA ====================================

} else {
  //ja saitē nav paramters prece, tad drukājam visas preces

//====================== DRUKĀJAM VISAS PRECES =====================================
echo "<br><select onchange='kategorija(this.value)'>";
echo "<option value=''>Visas kategorijas</option>";

$sql = "SELECT * FROM kategorijas";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		  $id = $row["id"];
		  $nosaukums = $row["nosaukums"];
      echo "<option value='$id' ";
      if(isset($_GET["cat"]) && $_GET["cat"]==$id ){
        echo "selected";
      }  
      echo ">$nosaukums</option>";
    }
}
echo "</select><br><br>";

if (isset($_GET["q"])) {
  echo "<p>Meklēšanas rezultāti pēc atslēgvārda '$_GET[q]':</p>";
}

//$sql = "SELECT id FROM preces";

$sql = "SELECT * FROM preces";

if (isset($_GET["q"])) {
  $atslegvards = $_GET["q"];
  $sql .= " WHERE nosaukums LIKE '%$atslegvards%'";
}

if (isset($_GET["cat"]) && $_GET["cat"] != "") {
  $kategorijas_id = $_GET["cat"];
  $sql .= " WHERE kategorijas_id='$kategorijas_id'";
}

$result = $conn->query($sql);
$precu_skaits = mysqli_num_rows($result);
//echo "<h1>$precu_skaits</h1>";
$precu_skaits_lapa = 5;
$lapu_skaits = intdiv($precu_skaits, $precu_skaits_lapa);
if (($precu_skaits % $precu_skaits_lapa) > 0) {
  $lapu_skaits += 1;
}

$sql .= " LIMIT $precu_skaits_lapa";

if (isset($_GET["lapa"])) {
  $lapa = $_GET["lapa"];
  $nobide = ($lapa - 1) * $precu_skaits_lapa;
  $sql .= " OFFSET $nobide";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    
    $id = $row["id"];
    $nosaukums = $row["nosaukums"];
    $cena = $row["cena"];
    $foto = $row["foto"];
    $apraksts = $row["apraksts"];
    $kategorija = $row["kategorijas_id"];
    $noliktava = $row["noliktava"];

    echo "<a href='index.php?atvert=veikals&prece=$id'>";
    echo "<div class='gallery'>";
    echo "<div class='precuAttelaRamis'>";
    echo "<img src='$foto' alt='$nosaukums'>";
    echo "</div>";
    echo "<div class='desc'>$nosaukums<br>$cena EUR</div>";

    echo "<a href='index.php?atvert=veikals&ielikt=$id' class=''><button class='btn btn-primary ielikt_groza' type='button'>Ielikt grozā</button></a>";

    echo "</div>";
    echo "</a>";

  }
} else {
  echo "Nav atbilstošu preču!";
}

if ($precu_skaits > 0) {

echo "<div id='laposana'>";
echo "<nav aria-label='Page navigation example'>";
  echo "<ul class='pagination'>";
    echo "<li class='page-item'>";
    echo "<a class='page-link' href='#' aria-label='Iepriekšējā lapa'>";
      echo "<span aria-hidden='true'>&laquo;</span>";
      echo "<span class='sr-only'> iepriekšējā lapa</span>";
    echo "</a>";
    echo "</li>";
    //$lapu_skaits = 2;
    for ($i = 1; $i <= $lapu_skaits; $i++) {
      echo "<li class='page-item'><a class='page-link' href='index.php?atvert=veikals&lapa=$i";
      if (isset($_GET["cat"])) {
        echo "&cat=".$_GET["cat"];
      }
      if (isset($_GET["q"])) {
        echo "&q=".$_GET["q"];
      }
      echo "'>$i</a></li>";
    }

    echo "<li class='page-item'>";
    echo "<a class='page-link' href='#' aria-label='Nākamā lapa'>";
      echo "<span class='sr-only'>nākamā lapa </span>";
      echo "<span aria-hidden='true'>&raquo;</span>";
    echo "</a>";
    echo "</li>";
  echo "</ul>";
echo "</nav>";
echo "</div>";

}

}//========================= beidzas gadījums, kad jādrukā visas preces
?>