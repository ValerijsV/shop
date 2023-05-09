<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();

//nodzēšam cookie, uzliekot negatīvu derīguma termiņu
setcookie("pieteicies", "", time() - 1, "/");

//kad lietotājs izlogots, tad aizūtām viņu uz publisko daļu
header("Location: index.php");
exit;
?>

</body>
</html>