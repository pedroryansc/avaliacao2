<?php
    require_once("../autoload.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;
    
    if($acao == "excluir"){
        try{
            $prof = new Professor($id, 1, 1, 1);
            $prof->excluir();
            header("location:../index/professor.php");
        } catch(Exception $e){
            echo "Erro ao excluir os dados do professor <br>".
                "<br>".
                $e->getMessage();
        }
    }

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";

    if($acao == "salvar"){
        $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
        $sobrenome = isset($_POST["sobrenome"]) ? $_POST["sobrenome"] : "";
        $disciplina = isset($_POST["disciplina"]) ? $_POST["disciplina"] : "";
        $prof = new Professor($id, $nome, $sobrenome, $disciplina);
        if($id == 0){
            try{
                $prof->insere();
            } catch(Exception $e){
                echo "Erro ao cadastrar professor <br>".
                    "<br>".
                    $e->getMessage();
            }
        } else{
            try{
                $prof->editar();
            } catch(Exception $e){
                echo "Erro ao editar os dados do professor <br>".
                    "<br>".
                    $e->getMessage();
            }
        }
        header("location:../index/professor.php");
    }
?>