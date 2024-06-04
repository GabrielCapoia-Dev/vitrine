<h2 style="text-align:center;"> Conheça os eleitores do João Gaybriel</h2>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead class="cabecalho">
                <tr style="text-align:center;">
                    <td><strong>ID</strong></td>
                    <td><strong>ELEITOR</strong></td>
                    <td><strong>IDADE</strong></td>
                    <td><strong>DATA VOTO</strong></td>
                    <td><strong>NÚMERO DE TELEFONE</strong></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM campanha_joao";
                $consulta = $pdo->prepare($sql);
                $consulta->execute();
                while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                ?>
                <tr style="text-align:center;">
                    <td><?= $dados->id?></td>
                    <td><?= $dados->eleitor?></td>
                    <td><?= $dados->idade?></td>
                    <td><?= date( 'd-m-Y' , strtotime($dados->data_voto))?></td>
                    <td><?= Mask("(##)#####-####",$dados->numero_tel)?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>