<?php 

class Tarea {
    private $id;
    private $texto;
    private $fecha;

    public function __construct($id, $texto, $fecha) {
        $this->id = $id;
        $this->texto = $texto;
        $this->fecha = $fecha;
    }

    public function getId() {
        return $this->id;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setId($id): self{
        $this->id = $id;
        return $this;
    }

    public function setTexto($texto): self{
        $this->texto = $texto;
        return $this;
    }

    public function setFecha($fecha): self{
        $this->fecha = $fecha;
        return $this;
    }

    public function toJSON(){
        return json_encode(
            ['id' => $this->getId(),
            'texto' => $this->getTexto(),
            'fecha' => $this->getFecha()]
        );
    }
}
