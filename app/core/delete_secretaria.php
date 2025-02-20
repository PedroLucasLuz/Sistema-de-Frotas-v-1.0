<?php
require_once __DIR__ . "/../models/Secretaria.php";

print_r(value: $_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cod_secretaria'])) {
    $cod_secretaria = $_POST['cod_secretaria'];

    $secretaria = new Secretaria();
    $resultado = $secretaria->excluirSecretaria(cod_secretaria: $cod_secretaria);

    if ($resultado) {
        header(header: "Location: ../../public/index.php");
        exit();
    } else {
        echo "Erro ao excluir a secretar secretaria. Tente novamente.";
    }
} else {
    echo "ID da secretar secretaria não fornecido.";
}
?>
