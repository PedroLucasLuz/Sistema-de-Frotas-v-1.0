<?php
require_once __DIR__ . "/../models/Prefeitura.php";

print_r(value: $_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cod_prefeitura'])) {
    $cod_prefeitura = $_POST['cod_prefeitura'];

    $prefeitura = new Prefeitura();
    $resultado = $prefeitura->excluirPrefeitura(cod_prefeitura: $cod_prefeitura);

    if ($resultado) {
        header(header: "Location: ../../public/index.php");
        exit();
    } else {
        echo "Erro ao excluir a prefeitura. Tente novamente.";
    }
} else {
    echo "ID da prefeitura não fornecido.";
}
?>
