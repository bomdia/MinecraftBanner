<?php
    /**
     * Bomdia Generic Tools
     * @author Bomdia <bomdia.the.troll@gmail.com> https://github.com/bomdia
     * @license Free to use but dont remove the author, license and copyright
     * @copyright © 2014 Bomdia
     */
class Setting{
    
    private $u;//user
    private $p;//password
    private $h;//host
    private $d;//database
    
    public function __construct($u="root";$p="12345";$h="localhost";$d="Banner";) {
    $this->u=$u;
    $this->p=$p;
    $this->h=$h;
    $this->d=$d;
    }
    //connection function using mysqli
    private function dbconn(){
    $u=$this->u;$p=$this->p;$h=$this->h;$d=$this->d;
    $mysqli = new mysqli($h,$u,$p,$d);
    return $mysqli;
    }
    //close the given connection
    private function dbclose($mysqli){
    return $mysqli->close();
    }
    //query automatically open and close db connection to save resource
    private function dbquery($query){
    $mydb=$this->dbconn();
    $this->dbclose($mydb);
    return $queryresult;
    }
    //return a setting using the impostation for the query
    public function retriveASetting($table,$name,$where){
    
    }
    //return an associative array of setting
    public function retriveAllSetting(){
    
    }
}
?>