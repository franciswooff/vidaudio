<?php
session_start();
$ptno = $_POST["partno"];

if(is_numeric($ptno)){
  $_SESSION["subno"]=$ptno;
} else if ($ptno==""){
  $ptno="not set";
} else {
  exit('<h1>Something nasty here, go back to the previous page &amp; try again</h1>');
}

$cntr=$_SESSION["vidcount"];
if(is_null($cntr)){
  $cntr = 1;
  $_SESSION["vidcount"]=$cntr;
}

echo '<!doctype html>
<html lang="en">
<head>
<title>Vidaudio test v3</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="main.css">
<link rel="stylesheet" type="text/css" href="page.css">
<script src="vidaud.js" defer></script>
</head>
<body>
<main>
<h1>Vidaudio test page '.$cntr.'</h1>

<p>Click on the number below each slider to select a different audio variation(?)<br>
Adjust the slider to comparatively rate the variation<br>
Once you are happy with your slider settings comparison click "submit" to move to the next video</p>
<p>';

echo file_get_contents('extras/'.$cntr.'.txt');

echo '</p>
<video src="videofiles/'.$cntr.'.mp4" type="video/mp4" muted loop></video>

<form action="mid.php" method="post">
  <div class="cntr">
    <img src="images/ply.png" alt="play icon"><img src="images/pse.png" alt="pause icon">
  </div>
  ';

$editme = fopen('EDITME.txt', 'r') or die('<p>Unable to open your EDITME.txt file</p>');
fgets($editme);
$trxnum=fgets($editme);
fclose('EDITME.txt');

for ($f = 1; $f <= $trxnum; $f++){
  echo '<div class="channel">
    <input type="range" min="1" max="100" value="50" orient="vertical" name="fdr'.$f.'">
    <span>50</span>
  </div>
  ';
}

$tblc = fopen('labels/'.$cntr.'.txt', 'r');
$t1 = fgets($tblc);
$t2 = fgets($tblc);
$t3 = fgets($tblc);
$t4 = fgets($tblc);
$t5 = fgets($tblc);
fclose('labels/'.$cntr.'.txt');

echo '  <table>
    <tr><td>'.$t1.'</td></tr>
    <tr><td>'.$t2.'</td></tr>
    <tr><td>'.$t3.'</td></tr>
    <tr><td>'.$t4.'</td></tr>
    <tr><td>'.$t5.'</td></tr>
  </table>
<input type="submit" value="Submit">
</form>

';

for ($a = 1; $a <= $trxnum; $a++){
  echo '<audio muted loop><source src="audiofiles/'.$cntr.'_'.$a.'.wav" type="audio/mpeg"></audio>
';
}
?>

</main>
</body>
</html>
