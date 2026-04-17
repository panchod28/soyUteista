<?php
class Conexion{

  public $conexion = null;
  private $username = "soyuteista";
  private $password = "Ha0&%qWgi9Rx";
  private $dbname = "soyuteista";
  private $servername = "172.16.4.47";

  public function __construct() {
    $this->conexion = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    $this->conexion->set_charset('utf8');
    date_default_timezone_set("America/Bogota");
  }

  public function getConnection()
  {
    return $this->conexion;
  }
?>
