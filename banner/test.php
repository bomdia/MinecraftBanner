<?php
require("Tools.class.php");
$tool=new Tool();
$tool->mrequire(["Setting.class.php","Extended.class.php"]);
$mine=new minecraft();
$host=(isset($_GET["host"]) ? $_GET["host"] : "192.168.0.2");
$port=(isset($_GET["port"]) ? $_GET["port"] : 25565);
$type=(isset($_GET["type"]) ? $_GET["type"] : "svg");

echo '<object id="svg1" data="'.$mine->Svg($host,$port).'" type="image/svg+xml"><img src="'.$mine->Image($host,$port).'" /></object>';
?>