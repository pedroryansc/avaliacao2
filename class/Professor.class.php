<?php
    require_once("../autoload.php");

    class Professor extends Geral{
        private $nome;
        private $sobrenome;
        private $disciplina;
        public function __construct($id, $nome, $sobrenome, $disciplina){
            parent::__construct($id);
            $this->setNome($nome);
            $this->setSobrenome($sobrenome);
            $this->setDisciplina($disciplina);
        }

        public function setNome($nome){
            if($nome <> "")
                $this->nome = $nome;
            else
                throw new Exception("Insira o nome");
        }
        public function setSobrenome($sobrenome){
            if($sobrenome <> "")
                $this->sobrenome = $sobrenome;
            else
                throw new Exception("Insira o sobrenome");
        }
        public function setDisciplina($disciplina){
            if($disciplina <> "")
                $this->disciplina = $disciplina;
            else
                throw new Exception("Insira a disciplina");
        }

        public function getNome(){ return $this->nome; }
        public function getSobrenome(){ return $this->sobrenome; }
        public function getDisciplina(){ return $this->disciplina; }

        public function insere(){
            $sql = "INSERT INTO professor (nome, sobrenome, disciplina) VALUES(:nome, :sobrenome, :disciplina)";
            $par = array(":nome"=>$this->getNome(), ":sobrenome"=>$this->getSobrenome(), ":disciplina"=>$this->getDisciplina());
            return parent::executaComando($sql, $par);
        }

        public static function listar($tipo = 0, $info = ""){
            $sql = "SELECT * FROM professor";
            if($tipo > 0 && $info <> ""){
                switch($tipo){
                    case(1): $sql .= " WHERE idprofessor = :info"; break;
                    case(2): $sql .= " WHERE nome LIKE :info"; $info = "%".$info."%"; break;
                    case(3): $sql .= " WHERE sobrenome LIKE :info"; $info = "%".$info."%"; break;
                    case(4): $sql .= " WHERE disciplina LIKE :info"; $info = "%".$info."%"; break;
                }
                $par = array(":info"=>$info);
            } else
                $par = array();
            return parent::buscar($sql, $par);
        }

        public function editar(){
            $sql = "UPDATE professor
                    SET nome = :nome, sobrenome = :sobrenome, disciplina = :disciplina
                    WHERE idprofessor = :id";
            $par = array(":nome"=>$this->getNome(),
                        ":sobrenome"=>$this->getSobrenome(),
                        ":disciplina"=>$this->getDisciplina(),
                        ":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }
        
        public function excluir(){
            $sql = "DELETE FROM professor WHERE idprofessor = :id";
            $par = array(":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }
    }
?>