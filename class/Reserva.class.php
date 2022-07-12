<?php
    require_once("../autoload.php");

    class Reserva extends Geral{
        private $laboratorio;
        private $data;
        private $professor;
        public function __construct($id, $laboratorio, $data, $professor){
            parent::__construct($id);
            $this->setLaboratorio($laboratorio);
            $this->setData($data);
            $this->setProfessor($professor);
        }

        public function setLaboratorio($laboratorio){
            if($laboratorio > 0)
                $this->laboratorio = $laboratorio;
            else
                throw new Exception("Laboratório inválido: $laboratorio");
        }
        public function setData($data){
            if($data <> "")
                $this->data = $data;
            else
                throw new Exception("Insira a data da reserva");
        }
        public function setProfessor($professor){
            if($professor > 0)
                $this->professor = $professor;
            else
                throw new Exception("Professor inválido: $professor");
        }

        public function getLaboratorio(){ return $this->laboratorio; }
        public function getData(){ return $this->data; }
        public function getProfessor(){ return $this->professor; }

        public function insere(){
            $sql = "INSERT INTO reserva (laboratorio_idlaboratorio, data, professor_idprofessor)
                                        VALUES(:laboratorio, :data, :professor)";
            $par = array(":laboratorio"=>$this->getLaboratorio(), ":data"=>$this->getData(), ":professor"=>$this->getProfessor());
            return parent::executaComando($sql, $par);
        }

        public static function listar($tipo = 0, $info = ""){
            $sql = "SELECT * FROM reserva";
            if($tipo > 0 && $info <> ""){
                switch($tipo){
                    case(1): $sql .= " WHERE idreserva = :info"; break;
                }
                $par = array(":info"=>$info);
            } else
                $par = array();
            return parent::buscar($sql, $par);
        }

        public function editar(){
            $sql = "UPDATE reserva
                    SET laboratorio = :laboratorio, data = :data, professor = :professor
                    WHERE idreserva = :id";
            $par = array(":laboratorio"=>$this->getLaboratorio(),
                        ":data"=>$this->getData(),
                        ":professor"=>$this->getProfessor(),
                        ":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }
        
        public function excluir(){
            $sql = "DELETE FROM reserva WHERE idreserva = :id";
            $par = array(":id"=>$this->getId());
            return parent::executaComando($sql, $par);
        }

        public function verificaReserva(){
            require_once("../utils.php");
            $lista = listaReserva(0, 0);
            foreach($lista as $linha){
                if($linha["laboratorio_idlaboratorio"] == $this->getLaboratorio() && $linha["data"] == $this->getData()){
                        return "<a href='../index/reservaLab.php'>Voltar ao cadastro de reserva</a><br>
                        <br>
                        O laboratório escolhido, ".$this->getLaboratorio().", já está reservado para este dia, ".$this->getData().".";
                    } else{
                        return 1;
                    }
            }
        }
    }
?>