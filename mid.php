<?php
$resa = $resb = $resc = "";

$editme = fopen("EDITME.txt", "r") or die('<p>Unable to open your EDITME.txt file</p>');
$vidnum=fgets($editme);
$trxnum=fgets($editme);
fclose("EDITME.txt");

session_start();
$cntr=$_SESSION["vidcount"];

for ($f = 1; $f <= $trxnum; $f++){
  $addr = $cntr.'_'.$f;
  $res = $_POST["fdr".$f];
  $comp = $addr.'_'.$res;
  $_SESSION[$addr]=$comp;
  }

if ($cntr < $vidnum){
  $cntr ++;
  $_SESSION["vidcount"]=$cntr;
  header("location:page.php");
} else {
  header("location:end.php");
}
?>