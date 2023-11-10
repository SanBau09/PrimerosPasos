<?php 

    class Usuario {
        private $id;
        private $email;
        private $password;
        private $foto;
        private $sid;

    // Métodos para acceder a los atributos
        public function getId()
        {
            return $this->id;
        }

        public function setId($id): self
        {
            $this->id = $id;

            return $this;
        }


        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email): self
        {
            $this->email = $email;

            return $this;
        }


        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword($password): self
        {
            $this->password = $password;

            return $this;
        }

 
        public function getFoto()
        {
            return $this->foto;
        }

        public function setFoto($foto): self
        {
            $this->foto = $foto;

            return $this;
        }

        public function getSid()
        {
            return $this->sid;
        }

        public function setSid($sid): self
        {
            $this->sid = $sid;

            return $this;
        }
    }

?>