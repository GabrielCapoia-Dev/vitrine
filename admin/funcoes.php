<?php
//função para mostrar a janela de erro
function mensagemErro($msg)
{
?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?= $msg ?>',
        }).then((result) => {
            history.back();
        })
    </script>
<?php
    exit;
} //fim da função

function Mask($mask, $str)
{

    $str = str_replace(" ", "", $str);

    for ($i = 0; $i < strlen($str); $i++) {
        $mask[strpos($mask, "#")] = $str[$i];
    }

    return $mask;
}
