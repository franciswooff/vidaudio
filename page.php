<?php
$editme = fopen('EDITME.txt', 'r') or die('<p>Unable to open your EDITME.txt file</p>');
$vidnum = fgets($editme);
$trxnum = fgets($editme);
fgets($editme);
fgets($editme);
$reftrk = fgetcsv($editme,300);
$pgsNoRdm = fgetcsv($editme,300);
$rndon = fgets($editme);
$autoply = fgets($editme);
$loops = fgets($editme);
fclose($editme);

$highlttr = chr($trxnum+64);
$lttr_ary = range('A',$highlttr);

session_set_cookie_params(3000,"/");
session_start();

$cntr=$_SESSION["pagecount"]??1;

if (isset($_POST['page'])) {
  $trxary = $_SESSION["trx_ary"];
  for ($f = 0; $f < $trxnum; $f++){
    $addr = ($cntr-1).'_'.$trxary[$f];
    $res = $_POST["sldr".$f];
    if(is_numeric($res)){
      $comp = $addr.' , '.$res.' , '.$lttr_ary[$f];
      $_SESSION[$addr] = $comp;
    } else {
      exit('<h1>Something nasty here, try the test again</h1>');
    }
  }
}

if ($cntr > $vidnum){
  header("location:end.php");
  exit();
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

$trxary = range(1,$trxnum);
$schRslt = array_search($cntr,$pgsNoRdm);
if (!is_int($schRslt)) {
  shuffle($trxary);
}
$_SESSION["trx_ary"]=$trxary;

if ($autoply > chr(32)) {
  $ap='autoplay';
} else {
  $ap='';
}
if ($loops > chr(32)) {
  $lp='loop';
} else {
  $lp='';
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
$refRslt = array_search($cntr,$reftrk);
if (is_int($refRslt)) {
  echo '<audio '.$ap.' '.$lp.' src="audiofiles/'.$cntr.'_R.wav" preload muted loop></audio>
';
}
for ($a = 0; $a < $trxnum; $a++){
  echo '<audio '.$ap.' '.$lp.' src="audiofiles/'.$cntr.'_'.$trxary[$a].'.wav" preload muted loop></audio>
';
}
echo '
<form action="page.php" method="post">
  <div class="centr">
    <img src="images/ply.png" alt="play icon"><img src="images/pse.png" alt="pause icon">
  </div>
  ';
if (is_int($refRslt)) {
  echo '<div class="channel">
    <input type="range" min="1" max="100" value="50" orient="vertical" class="R">
    <span>R</span>
  </div>
  ';
}
for ($f = 0; $f < $trxnum; $f++){
  echo '<div class="channel">
    <input type="range" min="1" max="100" value="50" orient="vertical" name="sldr'.$f.'">
    <span>'.$lttr_ary[$f].'</span>
  </div>
  ';
}
echo '<table>
  ';
$tblc = fopen('labels/'.$cntr.'.txt','r');
if ($tblc) {
  for ($i = 1; $i <= 5; $i++){
    $t = fgets($tblc);
    $t = str_replace(["\r","\n"],"",$t);
    echo '  <tr><td>'.$t.'</td></tr>
  ';}
  fclose($tblc);
}
echo '</table>';

$cntr ++;
$_SESSION["pagecount"]=$cntr
?>
  <input type="submit" value="Submit" name="page">

</form>

</main>
</body>
</html>
