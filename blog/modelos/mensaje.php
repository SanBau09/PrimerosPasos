<?php
class Mensaje{
    private $id;
    private $titulo;
    private $texto;
    private $idUsuario;
    private $fecha;

    // Métodos para acceder a los atributos
    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getFecha() {
        return $this->fecha;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    
    public function setTexto($texto) {
        $this->texto = $texto;
    }
    
    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }
    
    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
}
?>