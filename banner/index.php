<?php
$install="install.php";
if(file_exists($install)){header("location: install.php");}
?>
<html>
<head>
<title>Visualizza Banner</title>
<link href="css/install.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
 <script language="javascript">  
    window.setInterval("refreshDiv()", 10000);  
    function refreshDiv(){
    if (document.getElementById("hu").innerHTML=="<img style=\"width:100%\" src=\"banner.php\">"){    
        document.getElementById("hu").innerHTML="<img style=\"width:100%\" src=\"banner.php\">";
        }else{
        document.getElementById("hu").innerHTML="<img src=\"banner.php\">";
        }
    }
    </script>
</head>
<body>
<div id="barra">
<div class="sx">Visualizza Banner Creato</div>
</div>
<?php
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
echo "</div>";
echo "<div id=\"hu\"><img style=\"width:100%\" src=\"banner.php\"></div>";
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
echo "</div>";
echo "<div id=\"hu\"><img style=\"width:100%\" src=\"banner.php\"></div>";
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
echo "</div>";
echo "<div id=\"hu\"><img src=\"banner.php\"></div>";
}

?>
</body>
</html>