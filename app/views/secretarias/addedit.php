<?php
require_once __DIR__ . "/../../core/Database.php";
require_once __DIR__ . "/../../models/Secretaria.php";
require_once __DIR__ . "/../../models/Prefeitura.php";

$secretaria = new Secretaria();
$prefeitura = new Prefeitura();
$secretariaEditada = null;
$prefeituras = $prefeitura->listarPrefeituras();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dados = [
        'cod_prefeitura' => $_POST['cod_prefeitura'],
        'cod_secretaria' => $_POST['cod_prefeitura'],
        'nome'           => $_POST['nome'],
        'telefone'       => $_POST['telefone'],
        'email'          => $_POST['email']
    ];

    if (isset($_POST['editar'])) {
        $resultado = $secretaria->editarSecretaria(dados: $dados);

        if ($resultado) {
            header(header: "Location: ../../../public/index.php");
            exit();
        } else {
            echo "Erro ao editar secretaria. A secretaria não foi encontrada.";
        }
    } else {
        $resultado = $secretaria->cadastrarSecretaria(dados: $dados);

        if ($resultado) {
            header(header: "Location: ../../../public/index.php");
            exit();
        } else {
            echo "Erro ao cadastrar a secretaria.";
        }
    }
} else {
    if (isset($_GET['cod_secretaria'])) {
        $cod_secretaria = $_GET['cod_secretaria'];
        $secretariaEditada = $secretaria->buscarSecretaria(cod_secretaria: $cod_secretaria);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title><?php echo $secretariaEditada ? "Editar Secretaria" : "Cadastrar secretaria"; ?></title>
    <link rel="stylesheet" href="/Sistema-de-Frotas-v-1.0/public/css/Addedit.css">
</head>

<body>
    <div class="container">
        <h1 class="form-title"><?php echo $secretariaEditada ? "Editar secretaria" : "Cadastrar secretaria"; ?></h1>

        <form action="addedit.php" method="POST" class="form">
            <?php if ($secretariaEditada): ?>
                <input type="hidden" name="cod_secretaria" value="<?= $secretariaEditada['cod_secretaria'] ?>">
            <?php else: ?>
                <div class="form-group">
                    <label for="cod_secretaria">Código da secretaria:</label>
                    <input type="text" name="cod_secretaria" required class="form-control">
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" value="<?= $secretariaEditada['nome'] ?? '' ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" value="<?= $secretariaEditada['telefone'] ?? '' ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?= $secretariaEditada['email'] ?? '' ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="cod_prefeitura">Prefeitura:</label>
                <select name="cod_prefeitura" required class="form-control">
                    <option value="">Selecione uma prefeitura</option>
                    <?php foreach ($prefeituras as $prefeitura): ?>
                        <option value="<?= $prefeitura['cod_prefeitura'] ?>"
                            <?= ($secretariaEditada && $secretariaEditada['cod_prefeitura'] == $prefeitura['cod_prefeitura']) ? 'selected' : '' ?>>
                            <?= $prefeitura['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>


            <button type="submit" name="<?php echo $secretariaEditada ? 'editar' : 'cadastrar'; ?>" class="btn btn-primary">
                <?php echo $secretariaEditada ? 'Salvar Alterações' : 'Cadastrar secretaria'; ?>
            </button>
        </form>
    </div>
</body>

</html>