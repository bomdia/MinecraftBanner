<?php
require("Tools.class.php");
$tool=new Tool();
$tool->mrequire(["Setting.class.php","Extended.class.php"]);
$mine=new minecraft();
if(isset($_GET["host"])){$host=$_GET["host"];}else{$host="192.168.0.2";}
if(isset($_GET["port"])){$port=$_GET["port"];}else{$port=25565;}
print('<meta charset="utf-8">');

$dir="tmp/".$host."-".$port.".png";
$ctime=time();
$ftime=@filemtime($dir) or 0;
$difftime=$ctime-$ftime;
$time=floor($difftime/60);
if($time>=1){
$response=$mine->Status($host,"1.7.*",$port);
echo $mine->CreateImage($response,$host,$port);
}else{
echo "<img src=\"$dir\">";
}
?>