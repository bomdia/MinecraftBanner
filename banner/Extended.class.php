<?php
class minecraft{
    public function ParseMessage($text="",$SoN="n"){
        require_once("Color.class.php");
        if($text==""){$text=$this->Status()["motd_raw"];}
        $color= new MinecraftColors();
        $motd=$text;
        $pmotd=$color->convertToHTML($motd);
        if($SoN=="n"){
        $spmotd=str_replace("Â","&nbsp",$pmotd);
        $sspmotd=str_replace("  ","&nbsp&nbsp",$spmotd);
        return $sspmotd;
        }elseif($SoN=="s"){
        $spmotd=str_replace("Â"," ",$pmotd);
        return $spmotd;
        }else{
        return "Parse error second variable accept only s or n . s for space, n for &nbsp";
        }
    }
    public function Status($host = 'pvp24.com', $version = '1.7.*' , $port = 25565){
        require_once("Status.class.php");
        $status = new MinecraftServerStatus();
        $response = $status->getStatus($host , $version , $port);
        if(!$response) {
        return $response;
        }else{
        $response["html-favicon"]='<img src="'.$response["favicon"].'">';
        $response["html-motd"]=$this->ParseMessage($response["motd_raw"]);
        return $response;
        }
    }
    public function MotdSe($motd){
        for($i=0;;$i++){
            if(15==$i){break;}
            $motd=str_replace("  "," ",$motd);
        }
        $lmotd=strlen($motd);
        if($lmotd<30){$lchar=15;}elseif($lmotd<60){$lchar=12;}else{$lchar=8;}
        return array($motd,$lchar);
    }
    public function CreateImage($response,$host,$port){
        $img = imagecreatetruecolor(680,100);
        $color = imagecolorallocate($img,0,0,0);
        $cverde = imagecolorallocate($img,0,255,0);
        $crosso = imagecolorallocate($img,255,0,0);
        $fn="segoeui.ttf";
        $fb="segoeuib.ttf";
        if(!$response) {
            imagefill($img,0,0,$crosso);
            imagettftext($img,15,0,20,40,$color,$fn,$host.":".$port);
        }else {
            imagefill($img,0,0,$cverde);
            $v=$response['version'];
            $pl=$response['players'];
            $mpl=$response['maxplayers'];
            $motd=$this->MotdSe($response['motd'])[0];
            $lchar=$this->MotdSe($response['motd'])[1];
            $imag=imagecreatefrompng($response["favicon"]);
            imagecopyresampled($img,$imag,18,18,0,0,64,64,64,64);
            imagettftext($img,15,0,100,35,$color,$fn,$host.":".$port);
            imagettftext($img,15,0,100,58,$color,$fn,"Giocatori ".$pl."/".$mpl);
            imagettftext($img,$lchar,0,100,80,$color,$fn,$motd);
            imagettftext($img,15,0,270,58,$color,$fn,"Minecraft: ".$v);
            imagesavealpha($imag, TRUE);
            imagepng($imag,"tmp/".$host."-".$port."-favicon.png");
        }
        $dir='tmp/'.$host.'-'.$port.'.png';
        imagepng($img, $dir);
        return "<img src=\"$dir\">";
    }
    }
?>