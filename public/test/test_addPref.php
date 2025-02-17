<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Prefeitura</title>
</head>
<body>
    <h1>Cadastrar Prefeitura</h1>
    <form action="test_processarPref.php" method="POST">
        <label for="cod_prefeitura">Código Prefeitura:</label>
        <input type="text" id="cod_prefeitura" name="cod_prefeitura" required><br><br>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required><br><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="site">Site:</label>
        <input type="text" id="site" name="site" required><br><br>

        <label for="cnpj">CNPJ:</label>
        <input type="text" id="cnpj" name="cnpj" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
