<!doctype html>
<html lang="en">
<head>
<title>Vidaudio v3.1 preview</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="main.css">
<link rel="stylesheet" type="text/css" href="preview.css">
</head>
<body>
<main>
<h1>Vidaudio test preview</h1>
<h2>Preview page used only by you (the researcher) to preview your files &amp; your test sequence</h2>

<p>Use this page in conjunction with the instructions for the project (the <a href="https://github.com/franciswooff/vidaudio-3#readme" target="_blank">GitHub README</a>). Start by getting your video &amp; audio files correctly named &amp; in place &amp; editing 'EDITME.txt' (steps 1-7 on GitHub). Then check this page &amp; have a run through of your test. Only after you are happy with those look at additional optional steps like adding custom instructions or labels to pages.</p>

<?php
$editme = fopen('EDITME.txt', 'r') or die('<p>Unable to open EDITME.txt file</p>');
$numpages = fgets($editme);
$trxnum = fgets($editme);
$mail = fgets($editme);
fgets($editme);
$reftrk = fgetcsv($editme,300);
$pgsNoRdm = fgetcsv($editme,300);
$rndon = fgets($editme);
$autoply = fgets($editme);
$loops = fgets($editme);
fclose($editme);

$noreftrx = count($reftrk);
$aflsno = ((int)$numpages*(int)$trxnum)+(int)$noreftrx;
$mail = str_replace(["\r","\n"],"",$mail);

$varry = scandir("videofiles");
$vnox = count($varry);
$vno = $vnox-2;
$aarry = scandir("audiofiles");
$anox = count($aarry);
$ano = $anox-2;

echo '<p>Your EDITME text file specifies you will use <b>'.$numpages.'</b> videos/test pages for your test.<br>
Your &quot;videofiles&quot; folder currently contains <b>'.$vno.'</b> files.</p>

<p>Each video is set (via EDITME) to have <b>'.$trxnum.'</b> audio tracks for subjects to rate (i.e. not including reference tracks). You have additionally set <b>'.$noreftrx.'</b> pages test to use reference tracks. Therefore you will need <b>'.$aflsno.'</b> ('.$numpages.' x '.$trxnum.' + '.$noreftrx.') audio files.<br>
Your &quot;audiofiles&quot; folder currently contains <b>'.$ano.'</b> files.</p>

<p>As well as being present in the relevant folders your audio &amp; video files need to be correctly named to appear in the test &amp; in previews below, see the GitHub README for naming convention.</p>

<p>n.b. your videos shouldn&apos;t show here much more than half the width of the page (on a landscape desktop PC monitor). If wider that&apos;s probably too large for (our) use over the net. Something in the range 360 (e.g. 640x360) to 540 (e.g. 960x540) should be enough. No bigger than necessary, on videos especially, is crucially good net etiquette.</p>
';

if ($rndon > chr(32)) {
  echo '<p>You have selected to randomise the order in which the test pages are presented to the test subject.</p>';
} else {
  echo '<p>You have selected to turn off randomisation of the order in which the test pages are presented to the test subject.</p>';
}

if ($autoply > chr(32)) {
    $ap='ON';
  } else {
    $ap='OFF';
  }
  if ($loops > chr(32)) {
    $lp='ON';
  } else {
    $lp='OFF';
  }

echo '<p>Looping of your video &amp; audio tracks is turned '.$lp.' &amp; autoplay is turned '.$ap.'</p>

<p>At the end of the test send the results to this e-mail address: <b>'.$mail.'</b></p>
';

for ($v = 1; $v <= (int)$numpages; $v++){

echo '<video src="videofiles/'.$v.'.mp4" controls></video>
<label>Video '.$v.'</label>

<p>The following audio tracks will be available to be rated with this video:</p>
';
for ($a = 1; $a <= (int)$trxnum; $a++){
  echo '<audio src="audiofiles/'.$v.'_'.$a.'.wav" controls></audio>
<label>Audio '.$v.'_'.$a.'</label>
';}

$refRslt = array_search($v,$reftrk);
if (is_int($refRslt)){
  echo '<p>You have also selected to use this additional reference track with this video:</p>
  <audio src="audiofiles/'.$v.'_R.wav" controls></audio>
<label>Audio '.$v.'_R</label>
  ';
} else {
  echo '<p>No additional reference track is selected for this video.</p>
';}

$schRslt = array_search($v,$pgsNoRdm);
if (is_int($schRslt)){
  echo '<p>You have selected to turn off randomisation of mapping of audio tracks to rating sliders for this test page.</p>
';
} else {
  echo '<p>You have selected for these audio tracks to be randomly mapped to the rating sliders on the test page.</p>
';}

if (file_exists('extras/'.$v.'.txt')) {
  echo '<p>The following additional paragraph(s) will appear below the standard instructions on this test page (though not in bold, that is to make it clear what is extra text here):<br><b>'.file_get_contents('extras/'.$v.'.txt').'</b></p>
';} else {echo '<p>No additional paragraph(s) is set by you to appear below the standard instructions on this test page.</p>
';}

if (file_exists('labels/'.$v.'.txt')) {
  echo '<p>The following scale label will appear against the sliders on this test page (a border is shown here so you can see the labels are correctly mapped against the 5 available lines):</p>
  <table>
  ';
  $tblc = fopen('labels/'.$v.'.txt','r');
  for ($i = 1; $i <= 5; $i++){
    $t = fgets($tblc);
    $t = str_replace(["\r","\n"],"",$t);
    echo '  <tr><td>'.$t.'</td></tr>
  ';}
  fclose($tblc);
  echo '</table>';
} else {
  echo '<p>No scale label is set by you to appear against the sliders on this test page.</p>
';}
}
?>

<p><a href="index.html" target="_blank">Open the test start page</a> (in a new tab)</p>
</main>
</body>
</html>
