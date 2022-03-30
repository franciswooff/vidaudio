<!doctype html>
<html lang="en">
<head>
<title>Vidaudio test end</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="main.css">
<link rel="stylesheet" type="text/css" href="page.css">
<script src="vidaud.js" defer></script>
</head>

<body>
<main>

<h1>Vidaudio test end</h1>
<p>Thanks for taking part in the test. Your results have been submitted.</p>

<?php
$editme = fopen("EDITME.txt", "r") or die('<p>Unable to open your EDITME.txt file</p>');
$vidnum=fgets($editme);
$trxnum=fgets($editme);
$mail=fgets($editme);
fclose($editme);

session_start();
$subno = $_SESSION["subno"];
//echo "participant no ".$subno."<br>";

for ($evc = 1; $evc <= $vidnum; $evc++){
  for ($f = 1; $f <= $trxnum; $f++){
    $addr = $evc.'_'.$f;  
    $res = $_SESSION[$addr];
    $allres .= "\r\n".$res;
    }
}
//echo $allres;

mail($mail, "Vidaudio test results for participant number ".$subno, $allres);

session_unset();
?>

<footer>"Vidaudio" test tool by <a href="https://github.com/franciswooff" target="_blank">FrancisWooff</a></footer>
</main>
</body>
</html>
