<?php 

class Tarea {
    private $id;
    private $texto;
    private $fecha;
    private $foto;
    private $realizada;


    /**
     * Get the value of id
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self{
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of texto
     */
    public function getTexto(){
        return $this->texto;
    }

    /**
     * Set the value of texto
     */
    public function setTexto($texto): self{
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha(){
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     */
    public function setFecha($fecha): self{
        $this->fecha = $fecha;

        return $this;
    }

       /**
     * Get the value of foto
     */
    public function getFoto(){
        return $this->foto;
    }

    /**
     * Set the value of foto
     */
    public function setFoto($foto): self{
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get the value of realizada
     */
    public function getRealizada(){
        return $this->realizada;
    }

    /**
     * Set the value of realizada
     */
    public function setRealizada($realizada): self{
        $this->realizada = $realizada;

        return $this;
    }

    public function toJSON(){
        return json_encode(
                ['id'=>$this->getId(),
                'texto' => $this->getTexto(),
                'fecha' => $this->getFecha(),
                'foto' => $this->getFoto(),
                'realizada' => $this->getRealizada()]
        );
    }
}
