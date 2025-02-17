<?php
require_once __DIR__ . "/../../core/Database.php";
require_once __DIR__ . "/../../models/Prefeitura.php";

$prefeitura = new Prefeitura();
$prefeituraEditada = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dados = [
        'cod_prefeitura' => $_POST['cod_prefeitura'],
        'nome'           => $_POST['nome'],
        'endereco'       => $_POST['endereco'],
        'telefone'       => $_POST['telefone'],
        'email'          => $_POST['email'],
        'site'           => $_POST['site'],
        'cnpj'           => $_POST['cnpj']
    ];

    if (isset($_POST['editar'])) {
        $resultado = $prefeitura->editarPrefeitura(dados: $dados);

        if ($resultado) {
            header(header: "Location: ../../../public/index.php");
            exit();
        } else {
            echo "Erro ao editar prefeitura. A prefeitura não foi encontrada.";
        }
    } else {
        $resultado = $prefeitura->cadastrarPrefeitura(dados: $dados);

        if ($resultado) {
            header(header: "Location: ../../../public/index.php");
            exit();
        } else {
            echo "Erro ao cadastrar a prefeitura.";
        }
    }
} else {
    if (isset($_GET['cod_prefeitura'])) {
        $cod_prefeitura = $_GET['cod_prefeitura'];
        $prefeituraEditada = $prefeitura->buscarPrefeitura(cod_prefeitura: $cod_prefeitura);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo $prefeituraEditada ? "Editar Prefeitura" : "Cadastrar Prefeitura"; ?></title>
    <link rel="stylesheet" href="/Sistema-de-Frotas-v-1.0/public/css/Addedit.css">
</head>
<body>
    <div class="container">
        <h1 class="form-title"><?php echo $prefeituraEditada ? "Editar Prefeitura" : "Cadastrar Prefeitura"; ?></h1>

        <form action="addedit.php" method="POST" class="form">
            <?php if ($prefeituraEditada): ?>
                <input type="hidden" name="cod_prefeitura" value="<?= $prefeituraEditada['cod_prefeitura'] ?>">
            <?php else: ?>
                <div class="form-group">
                    <label for="cod_prefeitura">Código da Prefeitura:</label>
                    <input type="text" name="cod_prefeitura" required class="form-control">
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" value="<?= $prefeituraEditada['nome'] ?? '' ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" name="endereco" value="<?= $prefeituraEditada['endereco'] ?? '' ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" value="<?= $prefeituraEditada['telefone'] ?? '' ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?= $prefeituraEditada['email'] ?? '' ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="site">Site:</label>
                <input type="text" name="site" value="<?= $prefeituraEditada['site'] ?? '' ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="cnpj">CNPJ:</label>
                <input type="text" name="cnpj" value="<?= $prefeituraEditada['cnpj'] ?? '' ?>" required class="form-control">
            </div>

            <button type="submit" name="<?php echo $prefeituraEditada ? 'editar' : 'cadastrar'; ?>" class="btn btn-primary">
                <?php echo $prefeituraEditada ? 'Salvar Alterações' : 'Cadastrar Prefeitura'; ?>
            </button>
        </form>
    </div>
</body>
</html>
