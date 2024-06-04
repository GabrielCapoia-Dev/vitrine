<h1 class="text-center"> Todas as categorias</h1>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome da categoria</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `categoria`";

                $consulta = $pdo->prepare($sql);
                $consulta->execute();
                while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                ?>
                    <tr>
                        <td><?= $dados->id ?></td>
                        <td><?= $dados->nome ?></td>
                        <td>
                            <a href="cadastros/categorias/<?= $dados->id ?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
                            <a href="javascript:excluir(<?=$dados->id?>)" onclick="excluir(<?=$dados->id?>)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function excluir(id) {
        if (confirm("Deseja realmente excluir essa Categoria?")) {
            location.href="excluir/categorias"
        } else {
            
        }
    }
</script>