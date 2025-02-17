<?php
require_once __DIR__ . "/../../app/models/Prefeitura.php";

$prefeitura = new Prefeitura();
$prefeituras = $prefeitura->listarPrefeituras();

if (!empty($prefeituras)) {
    echo "<h2>Lista de Prefeituras</h2>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Código</th><th>Nome</th><th>Endereço</th><th>Telefone</th><th>Email</th><th>Site</th><th>CNPJ</th><th>Ação</th></tr>";

    foreach ($prefeituras as $pref) {
        echo "<tr>";
        echo "<td>{$pref['cod_prefeitura']}</td>";
        echo "<td>{$pref['nome']}</td>";
        echo "<td>{$pref['endereco']}</td>";
        echo "<td>{$pref['telefone']}</td>";
        echo "<td>{$pref['email']}</td>";
        echo "<td>{$pref['site']}</td>";
        echo "<td>{$pref['cnpj']}</td>";
        echo "<td>
                <form action='test_deletePref.php' method='POST'>
                    <input type='hidden' name='cod_prefeitura' value='{$pref['cod_prefeitura']}'>
                    <button type='submit' onclick='return confirm(\"Tem certeza que deseja excluir?\");'>Excluir</button>
                </form>
              </td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Nenhuma prefeitura encontrada.</p>";
}
?>
