<?php
class minecraft{
    public function ParseMessage($text="",$SoN="n"){
        require_once("Color.class.php");
        if($text==""){$text=$this->Status()["motd_raw"];}
        $color= new MinecraftColors();
        $motd=$text;
        $pmotd=$color->convertToHTML($motd);
        if($SoN=="n"){
        $spmotd=str_replace("�","&nbsp",$pmotd);
        $sspmotd=str_replace("  ","&nbsp&nbsp",$spmotd);
        return $sspmotd;
        }elseif($SoN=="s"){
        $spmotd=str_replace("�"," ",$pmotd);
        return $spmotd;
        }else{
        return "Parse error second variable accept only s or n . s for space, n for &nbsp";
        }
    }
    public function Status($server="pvp24.com"){
    require_once("Status.class.php");
    $status = new MinecraftServerStatus();
    $response = $status->getStatus($server);
    return $response;
    }
    }
?>