<?php
    require_once("autoload.php");

    function listaProfessor($tipo, $info){
        $prof = new Professor(1, 1, 1, 1);
        $lista = $prof->listar($tipo, $info);
        return $lista;
    }

    function listaLaboratorio($tipo, $info){
        $lab = new Laboratorio(1, 1);
        $lista = $lab->listar($tipo, $info);
        return $lista;
    }

    function listaReserva($tipo, $info){
        $res = new Reserva(1, 1, 1, 1);
        $lista = $res->listar($tipo, $info);
        return $lista;
    }
?>