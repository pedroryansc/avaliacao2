<!DOCTYPE html>
<?php
    require("../utils.php");
    
    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : 0;
    $info = isset($_POST["info"]) ? $_POST["info"] : "";

    $vetor = listaProfessor(1, $id);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor</title>
</head>
<body>
    <?php
        include_once("../menu.html");
    ?>
    <br>
    <form action="../ctrl/ctrl_professor.php?id=<?php echo $id; ?>" method="post">
        Nome: <input type="text" name="nome" value="<?php if($acao == "editar") echo $vetor[0]["nome"]; ?>"><br>
        <br>
        Sobrenome: <input type="text" name="sobrenome" value="<?php if($acao == "editar") echo $vetor[0]["sobrenome"]; ?>"><br>
        <br>
        Disciplina: <input type="text" name="disciplina" value="<?php if($acao == "editar") echo $vetor[0]["disciplina"] ?>"><br>
        <br>
        <button type="submit" name="acao" value="salvar">Cadastrar Professor</button>
    </form>
    <br><br>
    <form method="post">
        Pesquisar por: <br>
        <br>
        <input type="radio" name="tipo" value="1" <?php if($tipo == 1) echo "checked"; ?>> ID <br>
        <input type="radio" name="tipo" value="2" <?php if($tipo == 2) echo "checked"; ?>> Nome <br>
        <input type="radio" name="tipo" value="3" <?php if($tipo == 3) echo "checked"; ?>> Sobrenome <br>
        <input type="radio" name="tipo" value="4" <?php if($tipo == 4) echo "checked"; ?>> Disciplina <br>
        <br>
        <input type="search" name="info" placeholder="Pesquisa" value="<?php echo $info; ?>"><br>
        <br>
        <button type="submit">Pesquisar</button>
    </form>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Disciplina</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <?php
            $lista = listaProfessor($tipo, $info);
            foreach($lista as $linha){
        ?>
        <tr>
            <th><?php echo $linha["idprofessor"]; ?></th>
            <td><?php echo $linha["nome"]; ?></td>
            <td><?php echo $linha["sobrenome"]; ?></td>
            <td><?php echo $linha["disciplina"]; ?></td>
            <td><a href="professor.php?acao=editar&id=<?php echo $linha["idprofessor"]; ?>">Editar</a></td>
            <td><a href="javascript:excluirRegistro('../ctrl/ctrl_professor.php?acao=excluir&id=<?php echo $linha["idprofessor"]; ?>')">Excluir</a></td>
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