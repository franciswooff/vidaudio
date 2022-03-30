<!doctype html>
<html lang="en">
<head>
<title>Vidaudio v3 preview</title>
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
$editme = fopen("EDITME.txt", "r") or die('<p>Unable to open your EDITME.txt file</p>');
$vidnum = fgets($editme);
$trxnum = fgets($editme);
$mail = fgets($editme);
$csv = fgetcsv($editme,300);
fclose($editme);
$aflsno = $vidnum*$trxnum;

$varry = scandir("videofiles");
$vnox = count($varry);
$vno = $vnox-2;
$aarry = scandir("audiofiles");
$anox = count($aarry);
$ano = $anox-2;

echo '<p>Your EDITME text file specifies you will use <b>'.$vidnum.'</b> videos for your test &amp; each video will have <b>'.$trxnum.'</b> audio tracks for subjects to rate (you will need <b>'.$aflsno.'</b> audio files). See the GitHub README for how to name these to appear below.</p>
<p>Your &quot;videofiles&quot; folder currently contains <b>'.$vno.'</b> files &amp; your &quot;audiofiles&quot; folder <b>'.$ano.'</b> files (your test is set up using the figures from your EDITME.txt file, the numbers of files you have uploaded currently is shown for checking).</p>
<p>n.b. your videos shouldn&apos;t show here much more than half the width of the page (on a landscape desktop PC monitor). If wider that&apos;s probably too large for (our) use over the net. Something in the range 360 (e.g. 640x360) to 540 (e.g. 960x540) should be enough. No bigger than necessary, on videos especially, is crucially good net etiquette.</p>

';

for ($v = 1; $v <= $vidnum; $v++){

echo '<video src="videofiles/'.$v.'.mp4" controls></video>
<label>Video '.$v.'</label>

<p>The following audio tracks will be available with this video</p>
';
for ($a = 1; $a <= $trxnum; $a++){
  echo '<audio src="audiofiles/'.$v.'_'.$a.'.wav" controls></audio>
<label>Audio '.$v.'_'.$a.'</label>
';}

$serus = array_search($v,$csv);

if (is_int($serus)){
  echo '
<p>You have selected to turn off randomisation of mapping of audio tracks to rating sliders for this test page via line 4 of EDITME.txt</p>
';
} else {
  echo '
<p>These audio tracks will be randomly mapped to the rating sliders on the test page (if you wish to turn this randomisation off for this page see step 11. GitHub README or examples in EDITME.txt)</p>
';
}

echo '<p>The following additional paragraph(s) will appear below the standard instructions on this test page (though not in bold, that is to make it clear what is extra text here):<br><b>'.file_get_contents("extras/".$v.".txt").'</b></p>
<p>The following scale label will appear against the faders on this test page (a border is shown here so you can see the labels are correctly mapped against the 5 available lines):</p>
';
$tblc = fopen('labels/'.$v.'.txt', 'r');
$t1 = fgets($tblc);
$t2 = fgets($tblc);
$t3 = fgets($tblc);
$t4 = fgets($tblc);
$t5 = fgets($tblc);
fclose($tblc);

echo '<table>
  <tr><td>'.$t1.'</td></tr>
  <tr><td>'.$t2.'</td></tr>
  <tr><td>'.$t3.'</td></tr>
  <tr><td>'.$t4.'</td></tr>
  <tr><td>'.$t5.'</td></tr>
</table>

';

}

echo '<p>At the end of the test send the results to this e-mail address: <b>'.$mail.'</b></p>';
?>
<p><a href="index.html" target="_blank">Open the test start page</a> (in a new tab)</p>
</main>
</body>
</html>
