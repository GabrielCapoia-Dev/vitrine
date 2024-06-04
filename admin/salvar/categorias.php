<?php
$nome = $_POST["nome"] ?? NULL;
$id = $_POST["id"] ?? NULL;

if (empty($nome)) {
    mensagemErro("Nome não pode ser vazio !");
}

$sql = "SELECT id,nome FROM categoria WHERE nome = :nome";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(":nome", $nomeCategoria);
$consulta->execute();
$dados = $consulta->fetch(PDO::FETCH_OBJ);

if (empty($id)) {
    if (empty($dados->id) && ($nome != $dados->nome)) {
        $sql = "INSERT INTO categoria(nome) VALUES (:nome)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $nome);
        $consulta->execute();
    } else {
        mensagemErro("Não insira um nome já existente !");
    }
} else {
    $sql2 = "UPDATE categoria set nome = :nome WHERE id = :id";
    $consulta2 = $pdo->prepare($sql2);
    $consulta2->bindParam(":nome", $nome);
    $consulta2->bindParam(":id", $id);
    $consulta2->execute();
}
echo "<script>location.href='listar/categorias'</script>";
