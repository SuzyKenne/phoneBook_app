<?php


class Model{
   private $servername = "localhost";
   private $username = "root";
   private $password = "";
   private $dbname = "phoneBook";
   private $conn;

   function __construct()
   {
    $this->conn = new mysqli($this->servername, $this->username,$this->password, $this->dbname);

    if($this->conn->connect_error){
       die("Connection Failed" . mysqli_connect_error()); 
    } else {
      //   echo "connected successfully";
        return true;
    }
   }

   public function getConnection(){
    return $this->conn;
   }
}

 
?>
