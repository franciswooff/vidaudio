<!doctype html>
<html lang="en">
<head>
<title>Vidaudio test end</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
<main>
<h2>Vidaudio test end</h2>
<p>Thanks for taking part in the test. Your results have been submitted.</p>

<?php
$editme = fopen('EDITME.txt', 'r') or die('<h2>Unable to open EDITME.txt file</h2>');
$vidnum = fgets($editme);
$trxnum = fgets($editme);
$mail = fgets($editme);
fclose($editme);

$allres = "Audio File , Rating , Slider Letter , Test Page \r\n";

session_start();
$subno = $_SESSION['subno'];

for ($evc = 1; $evc <= $vidnum; $evc++){
  for ($f = 1; $f <= $trxnum; $f++){
    $addr = $evc.'_'.$f;
    $res = $_SESSION[$addr];
    $allres .= "\r\n".$res;
    
  }
}

mail($mail, "Vidaudio test results for participant number ".$subno, $allres);

session_unset();
?>

<footer>"Vidaudio" test tool by <a href="https://github.com/franciswooff" target="_blank">FrancisWooff</a></footer>
</main>
</body>
</html>