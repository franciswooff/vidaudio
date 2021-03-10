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
<?php
$editme = fopen("EDITME.txt", "r") or die('<p>Unable to open your EDITME.txt file</p>');
$vidnum = fgets($editme);
$trxnum = fgets($editme);
$mail = fgets($editme);
fclose("EDITME.txt");
$aflsno = $vidnum*$trxnum;

$varry = scandir(videofiles);
$vnox = count($varry);
$vno = $vnox-2;
$aarry = scandir(audiofiles);
$anox = count($aarry);
$ano = $anox-2;

echo "<p>Your EDITME text file specifies you will use <b>".$vidnum."</b> videos for your test &amp; each video will have <b>".$trxnum."</b> audio tracks for subjects to rate (you will need <b>".$aflsno."</b> audio files)</p>
<p>Your videofiles folder currently contains <b>".$vno."</b> files &amp; your audiofiles folder <b>".$ano."</b> files (your test is set up using the figures from your EDITME.txt file, the numbers of files you have uploaded currently is shown for checking)</p>
<p>n.b. your videos shouldn't show here much more than half the width of the page (on a landscape desktop PC monitor). If wider that's probably too large for (our) use over the net. Something in the range 360 (e.g. 640x360) to 540 (e.g. 960x540) should be enough. No bigger than necessary, on videos especially, is crucially good net etiquette.</p>";

for ($v = 1; $v <= $vidnum; $v++){
  echo '<video src="videofiles/'.$v.'.mp4" type="video/mp4" controls></video>
  <label>Video '.$v.'</label>
  <p>The following audio tracks will be appear with this video</p>
  <p class="sml">(functionality to be added later) These tracks will appear randomly distributed on the ABC etc sliders against that video. Tick this box for an additional "training" page to appear before the test page, where (?the same audio files or alternative set?) appear with the same video, but no randomisation (first audio file on fader A etc) <input type="checkbox"></p>';
  for ($a = 1; $a <= $trxnum; $a++){
    echo '<audio controls><source src="audiofiles/'.$v.'_'.$a.'.wav" type="audio/mpeg"></audio>
    <label>Audio '.$v.'_'.$a.'</label>';
  }
}
echo '<p>At the end of the test send the results to this e-mail address: <b>'.$mail.'</b></p>';
?>

<p><a href="index.html" target="_blank">Open the test start page</a> (in a new tab)</p>
<p>SORT OUT VID TYPE NOT ALLOWED VALIDATION ERROR. Make more responsive?</p>
</main>
</body>
</html>