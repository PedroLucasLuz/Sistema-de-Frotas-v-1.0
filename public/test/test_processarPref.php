<?php
require_once __DIR__ . '/../../app/core/Database.php';
require_once __DIR__ . "/../../app/models/Prefeitura.php";

// Verificando se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Pegando os dados do formulário
    $dados = [
        'cod_prefeitura' => $_POST['cod_prefeitura'],
        'nome' => $_POST['nome'],
        'endereco' => $_POST['endereco'],
        'telefone' => $_POST['telefone'],
        'email' => $_POST['email'],
        'site' => $_POST['site'],
        'cnpj' => $_POST['cnpj']
    ];

    // Criando uma instância da classe Prefeitura
    $prefeitura = new Prefeitura();

    // Cadastrando a prefeitura
    $resultado = $prefeitura->cadastrarPrefeitura($dados);

    // Exibindo o feedback ao usuário
    if ($resultado) {
        echo "Prefeitura cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar prefeitura. Tente novamente.";
    }
}
?>
