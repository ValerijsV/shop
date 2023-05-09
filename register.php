<?php
// Start the session
session_start();
include 'functions.php';
include 'config.php';
?>

<h2>Reģistrēties</h2>
<?php
$r = false;
//rediģēšanas režīms būs true, ja saitē parādīsies parametrs rediget (lietotājs nospieda uz pogas rediget)

$e = 0; //kļūdas kods sākumā ir nulle, t.i., pieņemam, ka kļūdu nav

//================== DUBLIKĀTA PĀRBAUDE ==========================
if (isset($_POST["e_pasts"])) {
//ja formu iesniedz jebkādā režīmā, tad pārbaudām dublikātus
 
$id = 0;

$sql = "SELECT e_pasts FROM lietotaji WHERE e_pasts='$_POST[e_pasts]' AND id != $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $e = 1; //kļūda - e_pasts dublējas
}

$sql = "SELECT segvards FROM lietotaji WHERE segvards='$_POST[segvards]' AND id != $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $e += 2; //kļūda - segvards dublējas
}

}
//================== BEIDZAS DUBLIKĀTA PĀRBAUDE ==========================

if ($e>0) {
  //ja bijusi kļūda, tad formā atprintēsim datus no iepriekš iesniegtajiem
  $e_pasts = $_POST["e_pasts"];
  $parole = $_POST["parole"];
  $segvards = $_POST["segvards"];
  $foto = $_POST["foto"];
  $apraksts = $_POST["apraksts"];
}

?>

<form action="" method="post">

<input type="hidden" name="atvert" value="lietotaji">

<input type="text" name="e_pasts" placeholder="Jūsu e-pasts" value="<?php if($r || $e>0) {echo $e_pasts;} ?>" required><br><br>
<?php if($e==1 || $e==3) {echo "Tāds e-pasts jau eksistē!<br><br>";} ?>

<input type="password" name="parole" placeholder="Jūsu parole" value="<?php if($r || $e>0) {echo $parole;} ?>" required><br><br>

<input type="text" name="segvards" placeholder="Jūsu segvārds" value="<?php if($r || $e>0) {echo $segvards;} ?>" required><br><br>
<?php if($e==2 || $e==3) {echo "Tāds segvārds jau eksistē!<br><br>";} ?>

<input type="text" name="foto" placeholder="Jūsu attēla adrese" value="<?php if($r || $e>0) {echo $foto;} ?>"><br><br>

<textarea name="apraksts" placeholder="Apraksts par Jums..." rows=5 cols=40><?php if($r || $e>0) {echo $apraksts;} ?></textarea><br><br>

<input type="submit" value="<?php if($r) {echo "Saglabāt izmaiņas";} else {echo "Pievienot lietotāju";} ?>" name="<?php if($r) {echo "saglabat";} else {echo "pievienot";} ?>">
<?php if ($r) {
  echo "<a href='index.php?atvert=lietotaji'>Atcelt rediģēšanu</a>";
 } ?>
</form>
<a href="index.php">Uz sākumu</a>
<a href="login.php">Pieteikties</a>

<?php 
//================== LIETOTĀJU PIEVIENOŠANA ==========================
if (isset($_POST["pievienot"]) && $e==0) {
  //ja forma ir iesniegta, tad liekam datus datubāzē

  $hashed_password = password_hash($_POST["parole"], PASSWORD_DEFAULT);

  $sql = "INSERT INTO lietotaji (e_pasts, parole, segvards, loma, foto, apraksts)
  VALUES ('$_POST[e_pasts]', '$hashed_password', '$_POST[segvards]', 'user', '$_POST[foto]', '$_POST[apraksts]')";

  if ($conn->query($sql) === TRUE) {
    echo "<p>Lietotājs veiksmīgi pievienots!</p>";
    echo "<script>setTimeout(\"location.href = 'login.php';\", 2000);</script>";
  } else {
    echo "<p>Kļūda pievienojot lietotāju: " . $sql . "<br>" . $conn->error . "</p>";
  }
}
//================== BEIDZAS LIETOTĀJU PIEVIENOŠANA ==========================

?>