<?php

class Coche{
    private $marca;
    private $modelo;
    private $matricula;
    private $kms;

    // Get/Set marca
    public function getMarca(){
        return $this->marca;
    }
    public function setMarca($marca): self{
        $this->marca = $marca;

        return $this;
    }
    // Get/Set modelo
    public function getModelo(){
        return $this->modelo;
    }
    public function setModelo($modelo): self{
        $this->modelo = $modelo;

        return $this;
    }
    // Get/Set matricula
    public function getMatricula(){
        return $this->matricula;
    }
    public function setMatricula($matricula): self{
        $this->matricula = $matricula;

        return $this;
    }

    // Get/Set kms
    public function getKms(){
        return $this->kms;
    }
    public function setKms($kms): self{
        $this->kms = $kms;

        return $this;
    }
}


$coche1 = new Coche();
$coche1 -> setKms(100000); 
$coche1 -> setMarca("Seat"); 
$coche1 -> setModelo("Ibiza"); 
$coche1 -> setMatricula("111AAA"); 

//encadenar llamadas (:self)
//$coche1->setKms(100000)->setMarca("Seat")->setModelo("Ibiza")->setMatricula("111AAA"); 

echo "Coche 1: " . $coche1->getKms() . ", " . $coche1->getMarca() . ", " . $coche1->getModelo() . ", " . $coche1->getMatricula() .". <br>"; 

?>