﻿<?php
require("Tools.class.php");
$tool=new Tool();
$tool->mrequire(["Setting.class.php","Extended.class.php"]);
$mine=new minecraft();
if(isset($_GET["host"])){$host=$_GET["host"];}else{$host="192.168.0.2";}
if(isset($_GET["port"])){$port=$_GET["port"];}else{$port=25565;}
$response=$mine->Status($host,"1.7.*",$port);
print('<meta charset="utf-8">');

echo $mine->CreateImage($response,$host,$port);
?>