<?php
class Favorito{
    private $id;
    private $idMensaje;
    private $idUsuario;

    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getIdMensaje()
    {
        return $this->idMensaje;
    }

 
    public function setIdMensaje($idMensaje): self
    {
        $this->idMensaje = $idMensaje;

        return $this;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }


    public function setIdUsuario($idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }
}