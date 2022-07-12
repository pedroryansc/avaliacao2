<!DOCTYPE html>
<?php
    require("../utils.php");
    
    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : 0;
    $info = isset($_POST["info"]) ? $_POST["info"] : "";

    $vetor = listaReserva(1, $id);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Laboratório</title>
</head>
<body>
    <?php
        include_once("../menu.html");
    ?>
    <br>
    <form action="../ctrl/ctrl_reserva.php?id=<?php echo $id; ?>" method="post">
        Laboratório:
        <select name="laboratorio">
            <?php
                $lista = listaLaboratorio(0, 0);
                foreach($lista as $linha){
            ?>
                <option value="<?php echo $linha["idlaboratorio"]; ?>" <?php if($acao == "editar" && $linha["idlaboratorio"] == $vetor[0]["laboratorio_idlaboratorio"]) echo "selected"; ?>>
                    <?php echo $linha["idlaboratorio"]." (".$linha["curso"].")"; ?>
                </option>
            <?php
                }
            ?>
        </select><br>
        <br>
        Data: <input type="date" name="data" value="<?php if($acao == "editar") echo $vetor[0]["data"]; ?>"><br>
        <br>
        Professor:
        <select name="professor">
            <?php
                $lista = listaProfessor(0, 0);
                foreach($lista as $linha){
            ?>
                <option value="<?php echo $linha["idprofessor"]; ?>" <?php if($acao == "editar" && $linha["idprofessor"] == $vetor[0]["professor_idprofessor"]) echo "selected"; ?>>
                    <?php echo $linha["nome"]." ".$linha["sobrenome"]; ?>
                </option>
            <?php
                }
            ?>
        </select><br>
        <br>
        <button type="submit" name="acao" value="salvar">Cadastrar Reserva</button>
    </form>
    <br><br>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Laboratório</th>
                <th>Data</th>
                <th>Professor</th>
                <th></th>
            </tr>
        </thead>
        <?php
            $lista = listaReserva(0, 0);
            foreach($lista as $linha){
        ?>
        <tr>
            <th><?php echo $linha["idreserva"]; ?></th>
            <td><?php echo $linha["laboratorio_idlaboratorio"]; ?></td>
            <td><?php echo $linha["data"]; ?></td>
            <td>
                <?php
                    $profNome = listaProfessor(1, $linha["professor_idprofessor"]);
                    echo $profNome[0]["nome"]." ".$profNome[0]["sobrenome"]."";
                ?>
            </td>
            <td><a href="javascript:excluirRegistro('../ctrl/ctrl_reserva.php?acao=excluir&id=<?php echo $linha["idreserva"]; ?>')">Excluir</a></td>
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>
<script>
    function excluirRegistro(url){
        if(confirm("Este registro será excluído. Tem certeza?"))
            location.href = url;
    }    
</script>