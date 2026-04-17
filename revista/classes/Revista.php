<?php
class Revista{
  public $id_revista;
  public $edicion;
  public $date;
  public $foto;
  public $url;

  public function __construct($args = []) {
    setlocale(LC_TIME, "spanish");
    date_default_timezone_set("America/Bogota");    
    $this->id_revista = $args['id_revista'];
    $this->edicion = $args['edicion'];
    $this->date = strftime("%B de %Y", strtotime($args['date']));
    $this->foto = "https://".$_SERVER['HTTP_HOST']."/revista/".$args['foto'];
    $this->url = $args['url'];
  }

}

?>
