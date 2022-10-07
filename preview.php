<?php
$editme = fopen('EDITME.txt', 'r') or die('<p>Unable to open EDITME.txt file</p>');
$numpages = fgets($editme);
$numpages = str_replace(["\r","\n"],"",$numpages);
$trxnum = fgets($editme);
$trxnum = str_replace(["\r","\n"],"",$trxnum);
$mail = fgets($editme);
fgets($editme);
$reftrk = fgetcsv($editme,300);
$pgsNoRdm = fgetcsv($editme,300);
$rndon = fgets($editme);
$autoply = fgets($editme);
$loops = fgets($editme);
$opacty = fgets($editme);
$reflvl = fgets($editme);
fclose($editme);

$noreftrx = count($reftrk);
$aflsno = ((int)$numpages*(int)$trxnum)+$noreftrx;
$mail = str_replace(["\r","\n"],"",$mail);
$varry = scandir("videofiles");
$vnox = count($varry);
$vno = $vnox-2;
$aarry = scandir("audiofiles");
$anox = count($aarry);
$ano = $anox-2;

echo '<!doctype html>
<html lang="en">
<head>
<title>Vidaudio v3.1 preview</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="main.css">
<link rel="stylesheet" type="text/css" href="preview.css">
<style>span{opacity:'.str_replace(["\r","\n"],"",$opacty).'}</style>
</head>
<body>
<main>
<h2>Vidaudio test preview</h2>
<h3>Preview page used only by you (the researcher) to preview your files &amp; your test sequence</h3>

<p>Use this page in conjunction with the instructions for the project (the <a href="https://github.com/franciswooff/vidaudio-3#readme" target="_blank">GitHub README</a>). Start by getting your video &amp; audio files correctly named &amp; in place &amp; editing the first 3 lines (only) of your "EDITME.txt" file (steps 1-7 on GitHub). Then check this page &amp; have a run through of your test. Only after you are happy with those look at additional optional steps like adding custom instructions or labels to pages, altering the opacity or initial level of sliders, looping &amp; autoplay.</p>

<p>Your EDITME.txt file specifies you will use <b>'.$numpages.'</b> videos/test pages for your test.<br>
Your &quot;videofiles&quot; folder currently contains <b>'.(string)$vno.'</b> files.</p>

<p>Each video is set (via EDITME.txt) to have <b>'.$trxnum.'</b> audio tracks for subjects to rate (i.e. not including reference tracks). You have additionally set <b>'.(string)$noreftrx.'</b> pages test to use reference tracks. Therefore you will need <b>'.(string)$aflsno.'</b> ('.$numpages.' x '.$trxnum.' + '.(string)$noreftrx.') audio files.<br>
Your &quot;audiofiles&quot; folder currently contains <b>'.(string)$ano.'</b> files.</p>

<p>As well as being present in the relevant folders your audio &amp; video files need to be correctly named to appear in the test &amp; in previews below, see the GitHub README for naming convention.</p>

<p>n.b. your videos shouldn&apos;t show here much more than half the width of the page (on a landscape desktop PC monitor, on a phone held in portrait about twice the screen width). If wider that&apos;s probably too large for (our) use over the net. Something in the range 360 (e.g. 640x360) to 540 (e.g. 960x540) should be enough. No bigger than necessary, on videos especially, is crucially good net etiquette.</p>
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

<p>If you are using a reference track(s) you can control the opacity of the slider for this from a setting of 0 (fully transparent &amp; so invisible) to 1 (fully opaque). The default setting is 0.5. The setting in your EDITME.txt is <b>'.str_replace(["\r","\n"],"",$opacty).'</b> <span>resulting in the opacity in which this text shows</span>.</p>

<p>You can alter the initial setting of all rating sliders (including the reference track slider) from the default of mid-position. this is set via a number in your EDITME.txt between 0 &amp; 100. The default setting is 50. The setting in your EDITME.txt is <b>'.str_replace(["\r","\n"],"",$reflvl).'</b>.</p>

<p>At the end of the test send the results to this e-mail address: <b>'.$mail.'</b></p>
';

for ($v = 1; $v <= (int)$numpages; $v++){

echo '<video src="videofiles/'.(string)$v.'.mp4" controls></video>
<label>Video '.$v.'</label>

<p>The following audio tracks will be available to be rated with this video:</p>
';
for ($a = 1; $a <= (int)$trxnum; $a++){
  echo '<audio src="audiofiles/'.(string)$v.'_'.(string)$a.'.wav" controls></audio>
<label>Audio '.(string)$v.'_'.(string)$a.'</label>
';}

$refRslt = array_search($v,$reftrk);
if (is_int($refRslt)){
  echo '<p>You have also selected to use this additional reference track with this video:</p>
  <audio src="audiofiles/'.(string)$v.'_R.wav" controls></audio>
<label>Audio '.(string)$v.'_R</label>
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

if (file_exists('extras/'.(string)$v.'.txt')) {
  echo '<p>The following additional paragraph(s) will appear below the standard instructions on this test page (though not in dark red, that is to make it clear what is extra text here):</p>
  <p><b>'.file_get_contents('extras/'.(string)$v.'.txt').'</b></p>
';} else {echo '<p>No additional paragraph is set to appear below the standard instructions on this test page.</p>
';}

if (file_exists('labels/'.(string)$v.'.txt')) {
  echo '<p>The following scale label will appear against the sliders on this test page (black vertical lines are shown to the right so you can see how the labels are mapped against the 5 available positions):</p>
  <table>
  ';
  $tblc = fopen('labels/'.(string)$v.'.txt','r');
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