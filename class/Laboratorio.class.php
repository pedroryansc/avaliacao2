<?php
    require_once("../autoload.php");

    class Laboratorio extends Geral{
        private $curso;
        public function __construct($id, $curso){
            parent::__construct($id);
            $this->setCurso($curso);
        }

        public function setCurso($curso){
            if($curso <> "")
                $this->curso = $curso;
            else
                throw new Exception("Insira o curso");
        }

        public function getCurso(){ return $this->curso; }

        public static function listar($tipo = 0, $info = ""){
            $sql = "SELECT * FROM laboratorio";
            $par = array();
            return parent::buscar($sql, $par);
        }
    }
?>