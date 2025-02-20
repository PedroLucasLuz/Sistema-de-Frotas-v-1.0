<?php
require_once __DIR__ . "/../models/Veiculo.php";

print_r(value: $_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cod_veiculo'])) {
    $cod_veiculo = $_POST['cod_veiculo'];

    $veiculo = new Veiculo();
    $resultado = $veiculo->excluirVeiculo(cod_veiculo: $cod_veiculo);

    if ($resultado) {
        header(header: "Location: ../../public/index.php");
        exit();
    } else {
        echo "Erro ao excluir a secretar veiculo. Tente novamente.";
    }
} else {
    echo "ID da secretar veiculo não fornecido.";
}
?>