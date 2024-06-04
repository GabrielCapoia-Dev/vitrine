<div>
    <form action="" method="post">

        <label for="buscarCep">CEP</label>
        <input class="form-control form-control-lg" type="text" name="buscarCep" required placeholder="Insira seu CEP" aria-label=".form-control-lg">
        <div style="display: flex;justify-content:center;margin-top:15px;"><button type="submit" class="btn btn-outline-success">Buscar</button></div>

    </form>
</div>



<?php
if ($_POST) {

    $cep = $_POST["buscarCep"] ?? NULL;
    $cepformato = preg_replace("/[^0-9]/", "", $cep);

    if (!empty($cepformato) && !is_numeric($cepformato) && strlen($cepformato) == 8) {



        $sql = "Select * From endereco where cep = :cep";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":cep", $cepformato); //substituição de valores
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);





        if (empty($dados)) {

            $url = "http://viacep.com.br/ws/$cepformato/json/";
            $json = file_get_contents($url);
            $decode = json_decode($json, true);

            $sql = "INSERT INTO endereco( cep, logradouro, complemento, bairro, localidade)
            VALUES (:cep, :logradouro, :complemento, :bairro, :localidade)";



            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":cep", $cepformato);
            $consulta->bindParam(":logradouro", $decode['logradouro']);
            $consulta->bindParam(":complemento", $decode['complemento']);
            $consulta->bindParam(":bairro", $decode['bairro']);
            $consulta->bindParam(":localidade", $decode['localidade']); //substituição de valores
            $consulta->execute();
            $dados = $decode;
        }



        //Termina PHP e começa HTML
?>
        <h2 class="text-center">Resultado da Pesquisa</h2>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <td>CEP</td>
                            <td>logradouro</td>
                            <td>complemento</td>
                            <td>Bairro</td>
                            <td>Localidade</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $dados['cep'] ?></td>
                            <td><?= $dados['logradouro'] ?></td>
                            <td><?= $dados['complemento'] ?></td>
                            <td><?= $dados['bairro'] ?></td>
                            <td><?= $dados['localidade'] ?></td>
                        </tr>



                    </tbody>
                </table>
            </div>
        </div>
<?php
    }
}

require "footer.php";
?>