<?php
class Newsletter{
    public $edicion;
    public $fecha;
    public $foto;
    public $url;

    public function __construct(String $edicion, String $fecha, String $foto, String $url) {
        $this->edicion = $edicion;
        $this->fecha = $fecha;
        $this->foto = $foto;
        $this->url = $url;
    }
}

class Respuesta {

    public $result;
    public $revistas;

    public function __construct(int $result, array $revistas) {
        $this->result = $result;
        $this->revistas = $revistas;

    }

}

?>
