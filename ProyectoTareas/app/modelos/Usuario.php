<?php 

class Usuario {
    private $id;
    private $email;
    private $password;
    private $sid;
    private $nombre;
    

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
     * Get the value of email
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self{
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self{
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of sid
     */
    public function getSid(){
        return $this->sid;
    }

    /**
     * Set the value of sid
     */
    public function setSid($sid): self{
        $this->sid = $sid;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre): self{
        $this->nombre = $nombre;

        return $this;
    }
}