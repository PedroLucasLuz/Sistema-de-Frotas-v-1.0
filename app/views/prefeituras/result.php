<h2>Lista de Prefeituras</h2>

<?php if (!empty($prefeituras)): ?>
    <table border="1" cellpadding="10" style="width:100%; border-collapse: collapse;">
        <tr><th>Código</th><th>Nome</th><th>Endereço</th><th>Telefone</th><th>Email</th><th>Site</th><th>CNPJ</th><th>Ação</th></tr>

        <?php foreach ($prefeituras as $pref): ?>
            <tr>
                <td><?= $pref['cod_prefeitura'] ?></td>
                <td><?= $pref['nome'] ?></td>
                <td><?= $pref['endereco'] ?></td>
                <td><?= $pref['telefone'] ?></td>
                <td><?= $pref['email'] ?></td>
                <td><?= $pref['site'] ?></td>
                <td><?= $pref['cnpj'] ?></td>
                <td>
                    <form action="../app/views/prefeituras/delete.php" method="POST" style="display:inline;">
                        <input type="hidden" name="cod_prefeitura" value="<?= $pref['cod_prefeitura'] ?>">
                        <button type="submit" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                    </form>
                    <a href="../app/views/prefeituras/addedit.php?cod_prefeitura=<?= $pref['cod_prefeitura'] ?>" class="btn btn-edit" style="margin-left:10px;">Editar</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
<?php else: ?>
    <p>Nenhuma prefeitura encontrada.</p>
<?php endif; ?>
