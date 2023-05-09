<?php
// Start the session
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="lv">
<head>
  <title>Pieteikties | Sagatave</title>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<h2>Pieteikties</h2>

<?php
  if (isset($_GET["pasutit"])) {
    echo "<p>Lai pasūtītu preces, nepieciešams pieteikties!</p>";
  }
?>

<form action="" method="post">
<input type="text" name="lietotajs" placeholder="Ievadiet e-pasta adresi" required><br><br>
<input type="password" name="parole" placeholder="Ievadiet paroli" required><br><br>

<?php 
if(isset($_GET["pasutit"])) {
  echo "<input type='hidden' name='pasutit' value='true'>";
}
?>

<input type="checkbox" id="atcereties" name="atcereties">
<label for="atcereties">atcerēties mani</label><br><br>

<input type="submit" value="Pieteikties">&nbsp;
<a href="register.php">Reģistrēties</a>
</form>
<p><a href="index.php">Atpakaļ uz mājaslapu</a></p>

<?php
if (isset($_POST["lietotajs"])) {
  //ja ir pieejams lietotajs, tad arī parole, jo formā izmantots required parametrs

  $sql = "SELECT id, e_pasts, parole FROM lietotaji WHERE e_pasts='$_POST[lietotajs]'";
  //echo $sql;
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
  // ja atrada lietotāju pēc e_pasta
    $row = $result->fetch_assoc();


    if (password_verify($_POST["parole"], $row["parole"])) {
    //ja lietotājs un parole ir pareizi, tad ielogojam lietotāju mājaslapā
  
      $_SESSION["pieteicies"] = true;
      $_SESSION["lietotajs"] = $row["id"];
      //šo mainīgo eksistence apliecinās, ka lietotājs ir pieteicies

      //pārbaudām, vai lietotājs grib, lai viņu atceras ilgāku laiku, ka viņš ir pieteicies
      if (isset($_POST["atcereties"])) {
       //ja grib, tad izveidojam cookie poieteicies, kur saglabājam viņa lietotājvārdu
       setcookie("pieteicies", $_SESSION["lietotajs"], time() + (86400 * 30), "/");
      }

      if (isset($_POST["pasutit"])) {
        header("Location: index.php?atvert=grozs");
      } else {
        header("Location: admin/index.php");
      }
      exit;
      //sūtām pieteikušos lietotāju uz admin paneli
    } else {
      echo "<p>Ievadītā e-pasta adrese vai parole nav pareiza!</p>";
    }
  } else {
    echo "<p>Ievadītā e-pasta adrese vai parole nav pareiza!</p>";
  }

}
?>
  
</body>
</html>