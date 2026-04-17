<?php
class News{
    public $categoria;
    public $titulo;
    public $descripcion;
    public $fecha;
    public $foto;
    public $url;

    public function __construct(String $categoria, String $titulo, String $descripcion, String $fecha, String $foto, String $url) {
        $this->categoria = $categoria;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->fecha = $fecha;
        $this->foto = $foto;
        $this->url = $url;
    }
}

class Respuesta {

    public $result;
    public $count;
    public $noticias;

    public function __construct( int $result, array $noticias, int $count) {
        $this->result = $result;
        $this->noticias = $noticias;
	$this->count = $count;
}
}
?>
