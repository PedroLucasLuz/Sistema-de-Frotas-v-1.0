<?php
require_once __DIR__ . "/../../core/Database.php";
require_once __DIR__ . "/../../models/Secretaria.php";
require_once __DIR__ . "/../../models/Prefeitura.php";
require_once __DIR__ . "/../../models/Veiculo.php";


$veiculo    = new Veiculo();
$secretaria = new Secretaria();
$prefeitura = new Prefeitura();

$veiculoEditado = null;

$prefeituras = $prefeitura->listarPrefeituras();
$secretarias  = $secretaria->listarSecretarias();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dados = [
        'cod_veiculo'    => $_POST['cod_veiculo'],
        'placa'          => $_POST['placa'],
        'tipo'           => $_POST['tipo'],
        'modelo'         => $_POST['modelo'],
        'ano'            => $_POST['ano'],
        'status'         => $_POST['status'],
        'cod_secretaria' => $_POST['cod_secretaria'],
        'cod_prefeitura' => $_POST['cod_prefeitura']
    ];

    if (isset($_POST['editar'])) {
        $resultado = $veiculo->editarVeiculo(dados: $dados);

        if ($resultado) {
            header(header: "Location: ../../../public/index.php");
            exit();
        } else {
            echo "Erro ao editar veículo. O veículo não foi encontrado.";
        }
    } else {
        $resultado = $veiculo->cadastrarVeiculo(dados: $dados);

        if ($resultado) {
            header(header: "Location: ../../../public/index.php");
            exit();
        } else {
            echo "Erro ao cadastrar o veículo.";
        }
    }
} else {
    if (isset($_GET['cod_veiculo'])) {
        $cod_veiculo = $_GET['cod_veiculo'];
        $veiculoEditado = $veiculo->buscarVeiculo(cod_veiculo: $cod_veiculo);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title><?php echo $veiculoEditado ? "Editar veículo" : "Cadastrar veículo"; ?></title>
    <link rel="stylesheet" href="/Sistema-de-Frotas-v-1.0/public/css/Addedit.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1 class="form-title text-center">
            <?= $veiculoEditado ? "Editar veículo" : "Cadastrar veículo"; ?>
        </h1>

        <form action="addedit.php" method="POST" class="form">
            <input type="hidden" name="cod_veiculo" value="<?= $veiculoEditado['cod_veiculo'] ?>">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tipo" class="form-label">Tipo:</label>
                    <input type="text" name="tipo" value="<?= $veiculoEditado['tipo'] ?? '' ?>" required class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="placa" class="form-label">Placa:</label>
                    <input type="text" name="placa" value="<?= $veiculoEditado['placa'] ?? '' ?>" required class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="ano" class="form-label">Ano:</label>
                    <input type="text" name="ano" value="<?= $veiculoEditado['ano'] ?? '' ?>" required class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="modelo" class="form-label">Modelo:</label>
                    <input type="text" name="modelo" value="<?= $veiculoEditado['modelo'] ?? '' ?>" required class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="status" class="form-label">Status:</label>
                    <select name="status" required class="form-control">
                        <option value="Ativo" <?= (isset($veiculoEditado['status']) && $veiculoEditado['status'] == 'Ativo') ? 'selected' : '' ?>>Ativo</option>
                        <option value="Manutenção" <?= (isset($veiculoEditado['status']) && $veiculoEditado['status'] == 'Manutenção') ? 'selected' : '' ?>>Manutenção</option>
                        <option value="Sucateado" <?= (isset($veiculoEditado['status']) && $veiculoEditado['status'] == 'Sucateado') ? 'selected' : '' ?>>Sucateado</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="cod_prefeitura" class="form-label">Prefeitura 1:</label>
                    <select name="cod_prefeitura" required class="form-select">
                        <option value="">Selecione uma prefeitura</option>
                        <?php foreach ($prefeituras as $prefeitura): ?>
                            <option value="<?= $prefeitura['cod_prefeitura'] ?>"
                                <?= ($veiculoEditado && $veiculoEditado['cod_prefeitura'] == $prefeitura['cod_prefeitura']) ? 'selected' : '' ?>>
                                <?= $prefeitura['nome'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="cod_secretaria" class="form-label">Secretaria</label>
                    <select name="cod_secretaria" required class="form-select">
                        <option value="">Selecione uma Secretaria</option>
                        <?php foreach ($secretarias as $secretaria): ?>
                            <option value="<?= $secretaria['cod_secretaria'] ?>"
                                <?= ($veiculoEditado && $veiculoEditado['cod_secretaria'] == $secretaria['cod_secretaria']) ? 'selected' : '' ?>>
                                <?= $secretaria['nome'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" name="<?= $veiculoEditado ? 'editar' : 'cadastrar'; ?>" class="btn btn-primary">
                    <?= $veiculoEditado ? 'Salvar Alterações' : 'Cadastrar Veículo'; ?>
                </button>
            </div>
        </form>
    </div>

</body>

</html>