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
            $favicon="tmp-img/favicon/".$host."-".$port."-favicon.png";
            if(file_exists($favicon)){
                $imag=imagecreatefrompng($favicon);
                imagecopyresampled($img,$imag,18,18,0,0,64,64,64,64);
            }
            imagettftext($img,15,0,100,35,$color,$fn,$host.":".$port);
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
            imagepng($imag,"tmp-img/favicon/".$host."-".$port."-favicon.png");
        }
        $dir='tmp-img/'.$host.'-'.$port.'.png';
        imagepng($img, $dir);
        return $dir;
    }
    public function Image($host,$port,$version="1.7.*"){
        $dir="tmp-img/".$host."-".$port.".png";
        $ctime=time();
        $ftime=@filemtime($dir) or 0;
        $difftime=$ctime-$ftime;
        $time=floor($difftime/60);
        if($time>=1){
            $response=$this->Status($host,$version,$port);
            $this->CreateImage($response,$host,$port);
        }
        if(file_exists($dir)){return "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/".$dir;}else{return null;}
    }
    public function Ini($host,$port,$version="1.7.*"){
        $dir="tmp-ini/".$host."-".$port.".ini";
        $ctime=time();
        $ftime=@filemtime($dir) or 0;
        $difftime=$ctime-$ftime;
        $time=floor($difftime/60);
        if($time>=1){
            $response=$this->Status($host,$version,$port);
            if(!$response){
				$status="offline";
				$response['status']=$status;
				$response['hostname']=$host;
				$response['port']=$port;
			}else{
				$status="online";
				$response['status']=$status;
			}
            $response["img-link"]=$this->Image($host,$port,$version);
            $favicon="http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/"."tmp-img/favicon/".$host."-".$port."-favicon.png";
            if(file_exists($favicon)){$response["favicon-link"]=$favicon;}
            if(isset($response["favicon"])){unset($response["favicon"]);}
            if(isset($response["html-favicon"]) and isset($response["favicon-link"])){$response["html-favicon"]="<img src=\"".$response["favicon-link"]."\">";}
            $responsepart=array_keys($response);
            $lenght=count($response);
            $ini="";
            for($i=0;;$i++){
                if($i==$lenght){break;}
                $ini=$ini.$responsepart[$i]."='".$response[$responsepart[$i]]."'\n";
            }
			file_put_contents($dir,$ini);
        }
		if(file_exists($dir)){return "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/".$dir;}else{return null;}
    }
	public function Svg($host,$port,$version = "1.7.*"){
		$dir="tmp-svg/".$host."-".$port.".svg";
        $ctime=time();
        $ftime=@filemtime($dir) or 0;
        $difftime=$ctime-$ftime;
        $time=floor($difftime/60);
		$favicon="http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/"."tmp-img/favicon/".$host."-".$port."-favicon.png";
        if($time>=1){
			$response=$this->Status($host,$version,$port);
			$svg="";
			$svg=$svg.'<?xml version="1.0" encoding="iso-8859-1" standalone="no"?>';
			$svg=$svg.'<!DOCTYPE svg PUBLIC "-//W3C//Dtd SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/Dtd/svg11.dtd">';
			$svg=$svg.'<svg height="100" width="680" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">';
			$svg=$svg.'<defs><style>@font-face {font-family: "Segoe UI";src: url("../segoeui.ttf");}@font-face {font-family: "Segoe UI Bold";src: url("../segoeuib.ttf");}</style></defs>';
			if(!$response){
				$svg=$svg.'<rect height="100" width="680"  style="fill:rgb(255,0,0);stroke-width:0;" />';
				$svg=$svg.'<image x="18" y="18" width="64" height="64" xlink:href="'.$favicon.'" />';
				$svg=$svg.'<text x="100" y="36" fill="#000" style="font-size:20px;font-family:\'Segoe UI\'">'.$host.':'.$port.'</text>';
			}else{
				$svg=$svg.'<rect height="100" width="680"  style="fill:rgb(0,255,0);stroke-width:0;" />';
				$svg=$svg.'<image x="18" y="18" width="64" height="64" xlink:href="'.$favicon.'" />';
				$svg=$svg.'<text x="100" y="36" fill="#000" style="font-size:20px;font-family:\'Segoe UI\'">'.$host.':'.$port.'</text>';
				$svg=$svg.'<text x="100" y="65" fill="#000" style="font-size:20px;font-family:\'Segoe UI\'">Giocatori '.$response['players'].'/'.$response['maxplayers'].'</text>';
				$svg=$svg.'<text x="270" y="65" fill="#000" style="font-size:20px;font-family:\'Segoe UI\'">Minecraft '.$response['version'].'</text>';
				$svg=$svg.'<text x="100" y="85" fill="#000" style="font-size:11px;font-family:\'Segoe UI\'">'.$response['motd'].'</text>';
			}
			$svg=$svg.'</svg>';
			file_put_contents($dir,$svg);
		}
		if(file_exists($dir)){return "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/".$dir;}else{return null;}
	}
}
?>