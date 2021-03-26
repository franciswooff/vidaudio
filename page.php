<?php
$editme = fopen('EDITME.txt', 'r') or die('<p>Unable to open your EDITME.txt file</p>');
$vidnum = fgets($editme);
$trxnum = fgets($editme);
fgets($editme);
$csv = fgetcsv($editme,300);
fclose('EDITME.txt');

session_set_cookie_params(3000,"/");
session_start();

$cntr=$_SESSION["vidcount"];
if(is_null($cntr)){
  $cntr = 1;
  $_SESSION["vidcount"]=$cntr;
}

$trxshufl = $_SESSION["tshuf"];

$vidnoforres = $cntr-1;
if (isset($_POST['page'])) {
  for ($f = 1; $f <= $trxnum; $f++){
    $addr = $vidnoforres.'_'.$trxshufl[$f-1];
    $res = $_POST["fdr".$f];
    if(is_numeric($res)){
      $comp = $addr.'_'.$res;
      $_SESSION[$addr] = $comp;
    } else {
      exit('<h1>Something nasty here, try the test again</h1>');
    }
  }
}

if ($cntr > $vidnum){
  header("location:end.php");
}

if (isset($_POST['start'])) {
  $ptno = $_POST["partno"];
  if(is_numeric($ptno)){
    $_SESSION["subno"]=$ptno;
  } else if ($ptno==""){
    $ptno="not set";
    $_SESSION["subno"]=$ptno;
  } else {
    exit('<h1>Something nasty here, go back &amp; try again</h1>');
  }
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

<p>Click on the number below each slider to select a different audio condition<br>
Adjust the slider to comparatively rate the condition<br>
Once you are happy with your slider settings comparison click "submit" to move to the next video</p>
<p>'.file_get_contents('extras/'.$cntr.'.txt').'</p>

<video src="videofiles/'.$cntr.'.mp4" type="video/mp4" muted loop></video>
';

$trxshufl = range(1,$trxnum);
$serus = array_search($cntr,$csv);

if (!is_int($serus)) {
  shuffle($trxshufl);
}

$_SESSION["tshuf"]=$trxshufl;

for ($a = 1; $a <= $trxnum; $a++){
  echo '<audio muted loop><source src="audiofiles/'.$cntr.'_'.$trxshufl[$a-1].'.wav" type="audio/mpeg"></audio>
';
}

echo '<form action="page.php" method="post">
  <div class="centr">
    <img src="images/ply.png" alt="play icon"><img src="images/pse.png" alt="pause icon">
  </div>
  ';

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
';

$cntr ++;
$_SESSION["vidcount"]=$cntr;

?>
  <input type="submit" value="Submit" name="page">
</form>

</main>
</body>
</html>
