<h2>Lista de Secretarias</h2>

<?php if (!empty($secretarias)): ?>
    <table border="1" cellpadding="10" style="width:100%; border-collapse: collapse;">
        <tr><th>Código</th><th>Nome</th><th>Telefone</th><th>Email</th><th>Prefeitura</th><th>Ação</th></tr>

        <?php foreach ($secretarias as $sec): ?>
            <tr>
                <td><?= $sec['cod_secretaria'] ?></td>
                <td><?= $sec['nome'] ?></td>
                <td><?= $sec['telefone'] ?></td>
                <td><?= $sec['email'] ?></td>
                <td><?= $prefeituraNomes[$sec['cod_prefeitura']] ?? 'Desconhecida' ?></td> 
                <td>
                    <form action="../app/views/secretarias/delete.php" method="POST" style="display:inline;">
                        <input type="hidden" name="cod_secretaria" value="<?= $sec['cod_secretaria'] ?>">
                        <button type="submit" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                    </form>
                    <a href="../app/views/secretarias/addedit.php?cod_secretaria=<?= $sec['cod_secretaria'] ?>" class="btn btn-edit" style="margin-left:10px;">Editar</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
<?php else: ?>
    <p>Nenhuma secretaria encontrada.</p>
<?php endif; ?>
