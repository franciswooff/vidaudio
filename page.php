<?php
$editme = fopen('EDITME.txt', 'r') or die('<p>Unable to open your EDITME.txt file</p>');
$vidnum = fgets($editme);
$trxnum = fgets($editme);
fgets($editme);
$csv = fgetcsv($editme,300);
fclose($editme);

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

<video src="videofiles/'.$cntr.'.mp4" preload muted loop></video>
';

$trxshufl = range(1,$trxnum);
$serus = array_search($cntr,$csv);

if (!is_int($serus)) {
  shuffle($trxshufl);
}

$_SESSION["tshuf"]=$trxshufl;

for ($a = 1; $a <= $trxnum; $a++){
echo '<audio src="audiofiles/'.$cntr.'_'.$trxshufl[$a-1].'.wav" preload muted loop></audio>
';
}

echo '
<form action="page.php" method="post">
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

echo '<table>
';
$tblc = fopen('labels/'.$cntr.'.txt', 'r');
if ($tblc) {
  for ($i = 1; $i <= 5; $i++){
    $t = fgets($tblc);
    echo '  <tr><td>'.$t.'</td></tr>
  ';}
  fclose($tblc);
}
echo '</table>
';

$cntr ++;
$_SESSION["vidcount"]=$cntr;

?>
  
  <input type="submit" value="Submit" name="page">
</form>

</main>
</body>
</html>
