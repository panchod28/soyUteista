<?php

class Notification{

  public $uniqid;
  public $title;
  public $body;
  public $link;
  public $date_created;
  public $created_by;

  public function __construct($args = []) {
    $this->uniqid = $args['uniq_id'];
    $this->title = $args['titulo'];
    $this->body = $args['cuerpo'];
    $this->link = $args['link'];
    $this->date_created = $args['fecha_creacion'];
    $this->created_by = $args['usuario'];
  }

}

?>
