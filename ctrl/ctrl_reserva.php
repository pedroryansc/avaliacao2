<?php
    require_once("../autoload.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;
    
    if($acao == "excluir"){
        try{
            $res = new Reserva($id, 1, 1, 1);
            $res->excluir();
            header("location:../index/reservaLab.php");
        } catch(Exception $e){
            echo "Erro ao excluir reserva <br>".
                "<br>".
                $e->getMessage();
        }
    }

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";

    if($acao == "salvar"){
        $laboratorio = isset($_POST["laboratorio"]) ? $_POST["laboratorio"] : 0;
        $data = isset($_POST["data"]) ? $_POST["data"] : "";
        $professor = isset($_POST["professor"]) ? $_POST["professor"] : 0;
        $res = new Reserva($id, $laboratorio, $data, $professor);
        $validade = $res->verificaReserva();
        if($validade == 1){
            if($id == 0){
                try{
                    $res->insere();
                } catch(Exception $e){
                    echo "Erro ao cadastrar reserva <br>".
                        "<br>".
                        $e->getMessage();
                }
            } else{
                try{
                    $res->editar();
                } catch(Exception $e){
                    echo "Erro ao editar os dados da reserva <br>".
                        "<br>".
                        $e->getMessage();
                }
            }
            header("location:../index/reservaLab.php");
        } else
            echo $validade;
    }
?>