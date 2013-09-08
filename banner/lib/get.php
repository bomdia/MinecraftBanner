<?php
//sostituisce le impostazioni con le variabili get
if(isset($_GET['host'])){$host=$_GET['host'];}
if(isset($_GET['port'])){$port=$_GET['port'];}
if(isset($_GET['stile'])){$stile=$_GET['stile'];}
if(isset($_GET['url'])){$url=$_GET['url'];}
if(isset($_GET['colore'])){$colore=$_GET['colore'];}
if(isset($_GET['r'],$_GET['g'],$_GET['b'])){$r=$_GET['r'];$g=$_GET['g'];$b=$_GET['b'];if($r=='o'){$r=0;}if($g=='o'){$g=0;}if($b=='o'){$b=0;}}
?>
