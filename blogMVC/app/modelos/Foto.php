<?php
class Foto{
    private $id;
    private $nombreArchivo;
    private $idMensaje;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNombreArchivo()
    {
        return $this->nombreArchivo;
    }

    public function setNombreArchivo($nombreArchivo): self
    {
        $this->nombreArchivo = $nombreArchivo;

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
}

