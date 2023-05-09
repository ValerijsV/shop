<h2>Mans profils</h2>
<?php
$r = true;
//rediģēšanas režīms būs true, ja saitē parādīsies parametrs rediget (lietotājs nospieda uz pogas rediget)

$e = 0; //kļūdas kods sākumā ir nulle, t.i., pieņemam, ka kļūdu nav

//================== DUBLIKĀTA PĀRBAUDE ==========================
if (isset($_GET["e_pasts"])) {
//ja formu iesniedz jebkādā režīmā, tad pārbaudām dublikātus
 
$id = 0;
if ($r) {$id = $_SESSION["lietotajs"];}

$sql = "SELECT e_pasts FROM lietotaji WHERE e_pasts='$_GET[e_pasts]' AND id != $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $e = 1; //kļūda - e_pasts dublējas
}

$sql = "SELECT segvards FROM lietotaji WHERE segvards='$_GET[segvards]' AND id != $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $e += 2; //kļūda - segvards dublējas
}

}
//================== BEIDZAS DUBLIKĀTA PĀRBAUDE ==========================

//================== LIETOTĀJU ATJAUNINĀŠANA ==========================
if (isset($_GET["saglabat"]) && $e==0) {
  //ja forma ir iesniegta, tad liekam datus datubāzē

  $sql = "UPDATE lietotaji SET e_pasts='$_GET[e_pasts]', parole='$_GET[parole]', segvards='$_GET[segvards]', foto='$_GET[foto]', apraksts='$_GET[apraksts]' WHERE id=$_SESSION[lietotajs]";

  if ($conn->query($sql) === TRUE) {
    echo "<p>Lietotāja dati veiksmīgi atjaunināti!</p>";
  } else {
    echo "<p>Kļūda atjauninot lietotāja datus: " . $sql . "<br>" . $conn->error . "</p>";
  }
}
//================== BEIDZAS LIETOTĀJU ATJAUNINĀŠANA ==========================


if($r) {
  //ja ir rediģēšanas režīms, tad nolasām no datubāzes rediģējamā lietotāja

  $sql = "SELECT * FROM lietotaji WHERE id=$_SESSION[lietotajs]";
  $result = $conn->query($sql);

if ($result->num_rows == 1) {
  // ja ir atrasta rediģējamā sadaļa
  $row = $result->fetch_assoc();
  
  $e_pasts = $row["e_pasts"];
  $parole = $row["parole"];
  $segvards = $row["segvards"];
  $foto = $row["foto"];
  $apraksts = $row["apraksts"];
} else {
  echo "Kļūda rediģējot!";
  $r = false;
}

} //beidzas pārbaude, vai ir rediģēšanas režīms


if ($e>0) {
  //ja bijusi kļūda, tad formā atprintēsim datus no iepriekš iesniegtajiem
  $e_pasts = $_GET["e_pasts"];
  $parole = $_GET["parole"];
  $segvards = $_GET["segvards"];
  $foto = $_GET["foto"];
  $apraksts = $_GET["apraksts"];
}

?>
<h4><?php if($r) {echo "Rediģēt";} else {echo "Pievienot";} ?> lietotāju</h4>
<form action="" method="get">

<input type="hidden" name="atvert" value="profils">

<input type="text" name="e_pasts" placeholder="Lietotāja e-pasts" value="<?php if($r || $e>0) {echo $e_pasts;} ?>" required><br><br>
<?php if($e==1 || $e==3) {echo "Tāds e-pasts jau eksistē!<br><br>";} ?>

<input type="password" name="parole" placeholder="Lietotāja parole" value="<?php if($r || $e>0) {echo $parole;} ?>" required><br><br>

<input type="text" name="segvards" placeholder="Lietotāja segvārds" value="<?php if($r || $e>0) {echo $segvards;} ?>" required><br><br>
<?php if($e==2 || $e==3) {echo "Tāds segvārds jau eksistē!<br><br>";} ?>

<input type="text" name="foto" placeholder="Profila attēla adrese" value="<?php if($r || $e>0) {echo $foto;} ?>"><br><br>

<textarea name="apraksts" placeholder="Lietotāja apraksts..." rows=5 cols=40><?php if($r || $e>0) {echo $apraksts;} ?></textarea><br><br>

<input type="submit" value="<?php if($r) {echo "Saglabāt izmaiņas";} else {echo "Pievienot lietotāju";} ?>" name="<?php if($r) {echo "saglabat";} else {echo "pievienot";} ?>">
</form><br>

<?php 

//================== LIETOTĀJU DZEŠANA ==========================
if (isset($_GET["dzest"])) {
  echo "Vai tiešām vēlaties neatgriezeniski dzēst lietotāju id=$_GET[dzest]?<br>";
  echo "<a href='index.php?atvert=lietotaji&tiesamdzest=$_GET[dzest]'>JĀ</a> ";
  echo "<a href='index.php?atvert=lietotaji'>NĒ</a>";
}

if (isset($_GET["tiesamdzest"])) {
  $sql = "DELETE FROM lietotaji WHERE id=$_GET[tiesamdzest]";
  if ($conn->query($sql) === TRUE) {
    echo "<p>Lietotājs (id=$_GET[tiesamdzest]) veiksmīgi izdzēsts!</p>";
  } else {
    echo "<p>Kļūda dzēšot ietotāju: " . $conn->error . "</p>";
  }
}
//================== BEIDZAS LIETOTĀJU DZEŠANA ====================

?>