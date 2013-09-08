<?php 
include_once 'lib/query.php';
include_once 'setting.php';
include_once 'lib/get.php';
$install="install.php";
if(file_exists($install)){header("location: install.php");}else{header("Content-Type: image/png");}
$status = new MinecraftServerStatus();
$response = $status->getStatus($host, $port); 
if(isset($stile)){
    if($stile=='colore'){
        $img = imagecreatetruecolor(700,120);
        if(isset($r,$g,$b))
        {
            $bg = imagecolorallocate($img,$r,$g,$b);
        }else{
            $bg = imagecolorallocate($img,145,145,145);
        }
        imagefill($img,0,0,$bg);
    }elseif($stile=="custom"){
        if(isset($url)){
            $banner=$url;
        $img = imagecreatefrompng($banner);
    }}else{
            $banner=$arra[$stile];
            $img = imagecreatefrompng($banner);
            }
    }else{
        $banner="$arra[$rand]";
        $img = imagecreatefrompng($banner);
    }
if(isset($colore)){if($colore=="bianco"){$color = imagecolorallocate($img,255,255,255);}elseif($colore=="nero"){$color = imagecolorallocate($img,0,0,0);}}else{$color = imagecolorallocate($img,0,0,0);}
$cverde = imagecolorallocate($img,0,255,0);
$crosso = imagecolorallocate($img,255,0,0);
if(!$response) {
imagettftext($img,15,0,20,40,$color,$fn,$host.":".$port);
imagettftext($img,20,0,20,70,$crosso,$fb,"Spento");
} else {
$v=$response['version'];
$pl=$response['players'];
$mpl=$response['maxplayers'];
$motd=$response['motd'];
$ping=$response['ping'];
imagettftext($img,15,0,20,40,$color,$fn,$host.":".$port);
imagettftext($img,15,0,20,100,$color,$fn,"Versione Minecraft: ".$v);
imagettftext($img,15,0,400,100,$color,$fn,"Giocatori ".$pl."/".$mpl);
imagettftext($img,15,0,400,40,$color,$fn,$motd);
imagettftext($img,15,0,400,70,$color,$fn,"Ping: ".$ping);
imagettftext($img,20,0,20,70,$cverde,$fb,"Acceso");
} 
imagepng($img); 
imagedestroy($img); 
?>