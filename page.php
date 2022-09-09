<?php
$editme = fopen('EDITME.txt', 'r') or die('<p>Unable to open EDITME.txt file</p>');
$numpages = fgets($editme);
$trxnum = fgets($editme);
fgets($editme);
fgets($editme);
$reftrk = fgetcsv($editme,300);
$pgsNoRdm = fgetcsv($editme,300);
$rndon = fgets($editme);
$autoply = fgets($editme);
$loops = fgets($editme);
fclose($editme);

$numpages = (int)$numpages;
$trxnum = (int)$trxnum;

session_set_cookie_params(3000,'/');
session_start();
$cntr = $_SESSION['pagecount'] ?? 0;

if ($cntr == 0) {
  $pageary = range(1,$numpages );
  $_SESSION['pagearray'] = $pageary;
  $_SESSION['subno'] = 'INTRO PAGE SKIPPED';
}

if (isset($_POST['page'])) {
  $trxary = $_SESSION['trx_ary'];
  $pageary = $_SESSION['pagearray'];
  for ($f = 0; $f < $trxnum; $f++){
    $addr = $pageary[$cntr-1].'_'.$trxary[$f];
    $res = $_POST['sldr'.$f];
    if(is_numeric($res)){
      $comp = $addr.' , '.$res.' , '.chr($f+65).' , '.$cntr;
      $_SESSION[$addr] = $comp;
    } else {
      exit('<h2>Something nasty here, try the test again</h2>');
    }
  }
}

if ($cntr >= $numpages){
  header('location:end.php');
  exit();
}

if (isset($_POST['start'])) {
  $ptno = $_POST['partno'];
  if(is_numeric($ptno)){
    $_SESSION['subno']=$ptno;
  } else if ($ptno==''){
    $ptno='not set';
    $_SESSION['subno']=$ptno;
  } else {
    exit('<h2>Something nasty here, go back &amp; try again</h2>');
  }
}

if ($rndon > chr(32) && $cntr == 0) {
  shuffle($pageary);
  $_SESSION['pagearray'] = $pageary;
}

$trxary = range(1,$trxnum);

$schRslt = array_search($pageary[$cntr],$pgsNoRdm);
if (!is_int($schRslt)) {
  shuffle($trxary);
}
$_SESSION['trx_ary']=$trxary;

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
<h2>Vidaudio test page '.((string)$cntr+1).'</h2>

<p>Click on the letter below each slider to select a different audio condition<br>
Adjust the slider to comparatively rate the condition<br>
Once you are happy with your slider settings click "submit" to move to the next video</p>
<p>';

if (file_exists('extras/'.(string)$pageary[$cntr].'.txt')) {
  echo file_get_contents('extras/'.(string)$pageary[$cntr].'.txt');
}
echo '</p>

<video src="videofiles/'.(string)$pageary[$cntr].'.mp4" preload muted loop></video>
';
$refRslt = array_search($pageary[$cntr],$reftrk);

if (is_int($refRslt)) {

  echo '<audio '.$ap.' '.$lp.' src="audiofiles/'.(string)$pageary[$cntr].'_R.wav" preload muted loop></audio>
';
}
for ($a = 0; $a < $trxnum; $a++){
  echo '<audio '.$ap.' '.$lp.' src="audiofiles/'.(string)$pageary[$cntr].'_'.$trxary[$a].'.wav" preload muted loop></audio>
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
    <span>'.chr($f+65).'</span>
  </div>
  ';
}

echo '<table>
  ';
if (file_exists('labels/'.(string)$pageary[$cntr].'.txt')) {
  $tblc = fopen('labels/'.(string)$pageary[$cntr].'.txt','r');
  for ($i = 1; $i <= 5; $i++){
    $t = fgets($tblc);
    $t = str_replace(['\r','\n'],'',$t);
    echo '  <tr><td>'.$t.'</td></tr>
  ';}
  fclose($tblc);
}
echo '</table>';

$cntr ++;
$_SESSION['pagecount']=$cntr
?>
  <input type='submit' value='Submit' name='page'>

</form>

</main>
</body>
</html>