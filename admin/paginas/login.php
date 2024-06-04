<?php

if ($_POST) {
    // Salvar dados do POST em variaveis
    $login = $_POST['login'] ?? NULL;
    $senha = $_POST['senha'] ?? NULL;
    print_r($login);
    print_r($senha);

    // Montar consulta
    $sql = "SELECT id, nome, login, senha FROM usuario WHERE login = :login AND ativo = 'S'";
    // Driver PDO
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":login", $login); //substituição de valores
    $consulta->execute();   // executando a consulta e retornando os dados

    // Colocando os dados em formato de objeto
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    var_dump($dados);

    $idNaoEncontrado = !isset($dados->id);
    $senhaIncorreta = !password_verify($senha, $dados->senha);

    if ($idNaoEncontrado) {
        mensagemErro('Usuario Não Encontrado ou Inativo');
    } else if ($senhaIncorreta) {
        mensagemErro('Senha Incorreta');
    } // Conferencia e retornos ao user

    $_SESSION['user'] = [
        'id' => $dados->id,
        'nome' => $dados->nome,
        'login' => $dados->login
    ]; // Salvando dados do usuario em uma sessão

    echo "<script>location.href='paginas/home'</script>";
    exit;
}
?>

<div class="login">
    <h1 style="text-align: center;">Login</h1>
    <form method="POST">
        <label for="login">Usuário</label>
        <input class="form-control form-control-lg" type="text" name="login" required placeholder="insira seu login" aria-label=".form-control-lg">
        <label for="senha">Senha</label>
        <input class="form-control form-control-lg" type="password" name="senha" required placeholder="insira sua senha" aria-label=".form-control-lg">
        <div style="display: flex;justify-content:center;margin-top:15px;"><button type="submit" class="btn btn-outline-success">Enviar</button></div>
    </form>
</div>