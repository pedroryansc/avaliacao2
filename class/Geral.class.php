<?php
    require_once("../autoload.php");

    abstract class Geral extends Database{
        private $id;
        public function __construct($id){
            $this->setId($id);
        }

        public function setId($id){ $this->id = $id; }

        public function getId(){ return $this->id; }

        public abstract static function listar($tipo = 0, $info = "");
    }
?>