<?php
// Start the session
session_start();
include 'functions.php';
include 'config.php';
?>
<!DOCTYPE html>
<html lang="lv">
<head>
  <title>Publiskā daļa | Sagatave</title>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>

  <!-- Latest compiled and minified CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
   <!-- Bootstrap Font Icon CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>

  <div class="container-fluid p-5 bg-success text-white">
	<h1>Mājaslapas sagatave</h1>
  <?php
  if (pieteicies()) {
  //ja lietotājs ir pieteicies, izdrukājam sveiciena tekstu
    echo "Sveiki, ".segvards()."!<br>";
    echo "<a href='index.php?atvert=profils'>Mans profils</a><br>";
  }

  echo "<a href='index.php?atvert=grozs'>Grozs</a>";
  ?>
  </div>

  <!-- GALVENĀ IZVĒLNE -->
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark" id="mynavframe">
  <div class="container-fluid">
  
	<!-- mobilās versijas izvēlnes poga -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
	
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        
      <?php
        $sql = "SELECT id, nosaukums FROM lapas";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo "<li class='nav-item'>
              <a class='nav-link' href='index.php?id=$row[id]'>$row[nosaukums]</a>
            </li>";
          }
        }
      ?>
       
      </ul>
      

      <script>
      function meklet(atslegvards) {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("saturs").innerHTML = this.responseText;
              console.log("ssf");
            }
          };
          xmlhttp.open("GET", "shop.php?q=" + atslegvards, true);
          xmlhttp.send();
      }
      </script>

	      <form class="d-flex">
        <?php if (isset($_GET["atvert"]) && $_GET["atvert"] == "veikals") { ?>
          <input id="meklesanas_logs" class="form-control me-2" type="text" 
          <?php 
          //ja ir tikusi veikta meklēšana, iedrukājam atslēgvārdu meklēšanas lodziņā
          if (isset($_GET["q"])) {
            echo "value='$_GET[q]'";
          }
          ?> placeholder="Meklēt" 
          onkeyup="meklet(this.value)">
        <?php } ?>
        </form>

        <a class="poga" href="index.php?atvert=veikals"><button class="btn btn-warning" type="button">Veikals</button></a>

        <?php if(pieteicies()) { ?>
          <a class="poga" href="logout.php"><button class="btn btn-primary" type="button">Atteikties</button></a>
        
        <?php if (irAdministrators()) {?>
          <a class="poga" href="admin/index.php"><button class="btn btn-primary" type="button">Administrācijas panelis</button></a>

        <?php } 
          } else { ?>
          <a class="poga" href="login.php"><button class="btn btn-primary" type="button">Pieteikties</button></a>
        <?php } ?>


      
    </div>
  </div>
  </nav>
   <!-- BEIDZAS GALVENĀ IZVĒLNE -->
  <div class="container my-5">
    <div class="row">
	    <div class="col-md-12" id="saturs">

        <?php 
        if (isset($_GET["id"])) {
          $sql = "SELECT nosaukums, saturs FROM lapas WHERE id=" . $_GET["id"];
          $result = $conn->query($sql);

          if ($result->num_rows == 1) {
            $row = $result->fetch_assoc(); 
            echo $row["saturs"];
          
          }
        } elseif (isset($_GET["atvert"])) {

          if ($_GET["atvert"] == "profils") {
            include 'profile.php';
          } elseif ($_GET["atvert"] == "veikals") {
            include 'shop.php';
          } elseif ($_GET["atvert"] == "grozs") {
            include 'cart.php';
          }

        }
        ?>


      </div>
    </div>
  </div>


</body>
</html>