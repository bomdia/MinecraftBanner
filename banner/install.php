<html>
<head>
<title>Installa Banner Minecraft</title>
<link href="css/install.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
</head>
<body>
<div id="barra">
<div class="sx"> Installa Banner Minecraft</div>
</div>
<?php
if(isset($_GET['remove'])and$_GET['remove']=="yes"){
unlink("install.php");
}
require("lib/md.php");
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'pc');
if($deviceType=="phone"){
echo "<div id=\"sottobarra\" style=\"height:50px\">";
echo "<center><script async src=\"http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
<!-- huhu -->
<ins class=\"adsbygoogle\"
     style=\"display:inline-block;width:320px;height:50px\"
     data-ad-client=\"ca-pub-2182748633353227\"
     data-ad-slot=\"4247839628\"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script></center>";
}elseif($deviceType=="tablet"){
echo "<div id=\"sottobarra\" style=\"height:90px\">";
echo "<center><script async src=\"http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
<!-- hu -->
<ins class=\"adsbygoogle\"
     style=\"display:inline-block;width:728px;height:90px\"
     data-ad-client=\"ca-pub-2182748633353227\"
     data-ad-slot=\"2771106421\"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script></center>";
}elseif($deviceType=="pc"){
echo "<div id=\"sottobarra\" style=\"height:90px\">";
echo "<center><script async src=\"http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
<!-- hu -->
<ins class=\"adsbygoogle\"
     style=\"display:inline-block;width:728px;height:90px\"
     data-ad-client=\"ca-pub-2182748633353227\"
     data-ad-slot=\"2771106421\"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script></center>";
}
echo "</div>";
if(isset($_GET['install'])and$_GET['install']=="2"){
if(isset($_POST['host'],$_POST['port'],$_POST['colore'],$_POST['stile'])){
$file=fopen("setting.php","w");
if($_POST['stile']=="random"){
    fwrite($file, '<?php
$host="'.$_POST['host'].'";
$port="'.$_POST['port'].'";
$colore="'.$_POST['colore'].'";
$arra[1]="img/banner.png";
$arra[2]="img/banner2.png";
$arra[3]="img/banner3.png";
$arra[4]="img/banner4.png";
$arra[5]="img/banner5.png";
$rand=rand(1,3);
$fn="font/segoeui.ttf";
$fb="font/segoeuib.ttf";
?>');
}else{
    fwrite($file, '<?php
$host="'.$_POST['host'].'";
$port="'.$_POST['port'].'";
$colore="'.$_POST['colore'].'";
$stile="'.$_POST['stile'].'";
$arra[1]="img/banner.png";
$arra[2]="img/banner2.png";
$arra[3]="img/banner3.png";
$arra[4]="img/banner4.png";
$arra[5]="img/banner5.png";
$rand=rand(1,3);
$fn="font/segoeui.ttf";
$fb="font/segoeuib.ttf";
?>');
    }
echo "<div id=\"hu\">Impostazioni scritte Correttamente. <br> <a href=\"?remove=yes\">Elimina</a> Install.php per attivare il banner.</div>";
}else{echo "<div id=\"hu\">NON TUTTI I CAMPI SONO STATI IMMESSI</div>";}
}else{
echo "<div id=\"install\">";
echo "<form id=\"finst\" method=\"post\" action=\"?install=2\">";
echo "Host: <input type=\"text\" name=\"host\"><br>";
echo "Port: <input type=\"text\" name=\"port\"><br>";
echo "Colore Font: <select name=\"colore\">
  <option value=\"bianco\">bianco</option>
  <option value=\"nero\">nero</option>
      </select><br>";
echo "Stile: <select name=\"stile\">
  <option value=\"random\">random</option>
  <option value=\"1\">1</option>
  <option value=\"2\">2</option>
  <option value=\"3\">3</option>
  <option value=\"4\">4</option>
  <option value=\"5\">5</option>
      </select>";
echo "<input type=\"submit\" value=\"Fase 2\">
</form>";
}
?>
</body>
</html>