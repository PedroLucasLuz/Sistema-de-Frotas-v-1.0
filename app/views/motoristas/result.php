<h2>Lista de motoristas</h2>

<?php if (!empty($motoristas)): ?>
    <table border="1" cellpadding="10" style="width:100%; border-collapse: collapse;">
        <tr>
            <th>Nome</th>
            <th>CNH</th>
            <th>Categoria CNH</th>
            <th>Data de Validade</th>
            <th>Veículo</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($motoristas as $motorista): ?>
            <tr>
                <td><?= $motorista['nome'] ?></td>
                <td><?= $motorista['cnh'] ?></td>
                <td><?= $motorista['categoria_cnh'] ?></td>
                <td><?= $motorista['data_validade_cnh'] ?></td>
                <td><?= $veiculoNomes[$motorista['cod_veiculo']] ?? 'Desconhecida' ?></td>
                <td>
                    <form action="../app/core/delete_motorista.php" method="POST" style="display:inline;">
                        <input type="hidden" name="cod_motorista" value="<?php echo $motorista['cod_motorista']; ?>">
                        <button class="btn-delete" type="submit" onclick="return confirm('Tem certeza que deseja excluir este veículo?');">
                            Excluir
                        </button>
                    </form>
                    <a href="../app/views/motoristas/addedit.php?cod_motorista=<?= $motorista['cod_motorista'] ?>" class="btn btn-edit" style="margin-left:10px;">Editar</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
<?php else: ?>
    <p>Nenhum veículo encontrado.</p>
<?php endif; ?>