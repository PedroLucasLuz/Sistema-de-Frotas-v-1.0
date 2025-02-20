<?php
    require_once __DIR__ . "/../app/controllers/SecretariaController.php";
    require_once __DIR__ . "/../app/controllers/PrefeituraController.php";
    require_once __DIR__ . "/../app/controllers/VeiculoController.php";
    require_once __DIR__ . "/../app/controllers/MotoristaController.php";

    $controllerSecretaria = new SecretariaController();
    $controllerPrefeitura = new PrefeituraController();
    $controllerVeiculo    = new VeiculoController();
    $controllerMotorista  = new MotoristaController();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Frotas</title>
    <link rel="stylesheet" href="./css/Result.css">
</head>

<body>

    <a href="../app/views/prefeituras/addedit.php" class="btn btn-add">Adicionar Prefeitura</a>
    <a href="../app/views/secretarias/addedit.php" class="btn btn-add">Adicionar Secretaria</a>
    <a href="../app/views/veiculos/addedit.php" class="btn btn-add">Adicionar Veículo</a>
    <a href="../app/views/motoristas/addedit.php" class="btn btn-add">Adicionar Motorista</a>

    <?php
        $controllerMotorista->listarMotoristas();
        $controllerVeiculo->listarVeiculos();
        $controllerSecretaria->listarSecretarias();
        $controllerPrefeitura->listarPrefeituras();
    ?>

</body>

</html>