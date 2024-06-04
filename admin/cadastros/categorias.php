<?php 
    $nome = NULL;
    if (!empty($id)) {
        $sql = "SELECT * FROM categoria WHERE id = :id";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':id', $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        $id = $dados->id ?? NULL;
        $nome = $dados->nome ?? NULL;
    }
?>

<div class="container" style="width: 90%;">
    <div class="card">
        <div class="card-header">
            <h2 style="text-align:center;"> Cadastro de Categorias</h2>
            <div class="float-right">
                <a href="listar/categorias" class="btn btn-success">Listar Categorias</a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="salvar/categorias">
                <label for="id">ID da categoria</label>
                <input class="form-control form-control-sm" type="text" name="id"
                value="<?=$id?>"
                readonly
                >

                <label for="nome">Digite o nome da categoria:</label>
                <input class="form-control form-control-md" aria-label=".form-control-lg"
                id="nome" 
                type="text" 
                name="nome" 
                placeholder="insira a categoria" 
                required
                value="<?=$nome?>"
                >
                <div style="display: flex;justify-content:center;margin-top:15px;"><button type="submit" class="btn btn-outline-success">Salvar Dados</button></div>
            </form>
        </div>
    </div>
</div>