<h2>Lista de Veiculos</h2>

<?php if (!empty($veiculos)): ?>
    <table border="1" cellpadding="10" style="width:100%; border-collapse: collapse;">
        <tr><th>Código</th><th>Placa</th><th>Tipo</th><th>Modelo</th><th>Ano</th><th>Status</th><th>Secretaria</th><th>Prefeitura</th><th>Ação</th></tr>

        <?php foreach ($veiculos as $veiculo): ?>
            <tr>
                <td><?= $veiculo['cod_veiculo'] ?></td>
                <td><?= $veiculo['placa'] ?></td>
                <td><?= $veiculo['tipo'] ?></td>
                <td><?= $veiculo['modelo'] ?></td>
                <td><?= $veiculo['ano'] ?></td>
                <td><?= $veiculo['status'] ?></td>
                <td><?= $secretariaNomes[$veiculo['cod_secretaria']] ?? 'Desconhecida' ?></td> 
                <td><?= $prefeituraNomes[$veiculo['cod_prefeitura']] ?? 'Desconhecida' ?></td> 
                <td>
                    <form action="../app/views/veiculos/delete.php" method="POST" style="display:inline;">
                        <input type="hidden" name="cod_veiculo" value="<?= $veiculo['cod_veiculo'] ?>">
                        <button type="submit" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                    </form>
                    <a href="../app/views/veiculos/addedit.php?cod_veiculo=<?= $veiculo['cod_veiculo'] ?>" class="btn btn-edit" style="margin-left:10px;">Editar</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
<?php else: ?>
    <p>Nenhum veículo encontrado.</p>
<?php endif; ?>