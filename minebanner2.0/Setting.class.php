<?php
    /**
     * Bomdia Generic Tools
     * @author Bomdia <bomdia.the.troll@gmail.com> https://github.com/bomdia
     * @license Free to use but dont remove the author, license and copyright
     * @copyright © 2014 Bomdia
     */
class Setting{
    
    public $u;//user
    public $p;//password
    public $h;//host
    public $d;//database
    
    public function __construct($u="root",$p="12345",$h="localhost",$d="Banner") {
    $this->u=$u;
    $this->p=$p;
    $this->h=$h;
    $this->d=$d;
    }
    //connection function using mysqli
    private function dbconn(){
    $u=$this->u;$p=$this->p;$h=$this->h;$d=$this->d;
    $mysqli = new mysqli($h,$u,$p,$d);
    if($mysqli->connect_error){return false;}else{return $mysqli;}
    }
    //close the given connection
    private function dbclose($mysqli){
    return $mysqli->close();
    }
    //query automatically open and close db connection to save resource
    private function dbquery($query){
    $mydb=$this->dbconn();
    if($mydb==false){return false;}else{
    $myquery=$mydb->query($query);
    $this->dbclose($mydb);
    return $myquery;
    }
    }
    //return a setting using the impostation for the query
    public function retriveASetting($name,$table,$where){
    $query="SELECT ".$name." FROM ".$table." WHERE ".$where[0].$where[1].'"'.$where[2].'"';
    $result=$this->dbquery($query);
    return $result->fetch_assoc();
    }
    //return an associative array of setting
    public function retriveAllSetting(){
    
    }
    public function updateASetting($set,$table,$where){
    $query="UPDATE ".$table." SET ".$set[0].'="'.$set[1].'"'." WHERE ".$where[0].$where[1].'"'.$where[2].'"';
    $result=$this->dbquery($query);
    return $result;
    }
}
?>