<?php
/**
 *
 */
class Database
{
  //Database Params
  private $host = 'localhost';
  private $database = 'mccdb';
  private $user = 'root';
  private $pass = '';
  private $conn;

  public function connect(){
    $this->conn = null;

    try {
      $this->conn = new PDO('mysql:host=localhost;dbname=mccdb', $this->user,$this->pass);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOExeption $ex) {
        echo 'Connecton Error: '. $ex.getMessage();
    }

    return $this->conn;

  }
}

?>
