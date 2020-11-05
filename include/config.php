<?php
class config{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbName = "resturant";
    public $mySQLLink;
    public function __construct(){
        $this->mySQLLink = mysqli_connect($this->host,$this->username,$this->password);
        mysqli_select_db($this->mySQLLink,$this->dbName);
    }
}
require_once("model.php");
?>