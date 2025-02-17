<?php
require_once __DIR__ . '/../core/Database.php';

class Veiculo {
    private PDO $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function cadastrarVeiculo(array $dados): bool {
        $sql = "INSERT INTO veiculo (cod_veiculo, placa, tipo, modelo, ano, status, cod_secretaria, cod_prefeitura) 
                VALUES (:cod_veiculo, :placa, :tipo, :modelo, :ano, :status, :cod_secretaria, :cod_prefeitura)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':cod_secretaria' => $dados['cod_secretaria'],
            ':cod_prefeitura' => $dados['cod_prefeitura'],
            'placa'           => $dados['placa'],
            'tipo'            => $dados['tipo'],
            'modelo'          => $dados['modelo'],
            'ano'             => $dados['ano'],
            'status'          => $dados['status'],
        ]);
    }

    public function editarVeiculo(array $dados): bool {
        $sql = "SELECT COUNT(*) FROM veiculo WHERE cod_veiculo = :cod_veiculo";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":cod_veiculo" => $dados['cod_veiculo']]);
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            return false;
        }

        $sql = "UPDATE veiculo 
                SET placa = :placa, tipo = :tipo, modelo = :modelo, ano = :ano, status = :status, cod_secretaria = :cod_secretaria, cod_prefeitura = :cod_prefeitura
                WHERE cod_veiculo = :cod_veiculo";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':cod_secretaria' => $dados['cod_secretaria'],
            ':cod_prefeitura' => $dados['cod_prefeitura'],
            'cod_veiculo'     => $dados['cod_veiculo'],
            'placa'           => $dados['placa'],
            'tipo'            => $dados['tipo'],
            'modelo'          => $dados['modelo'],
            'ano'             => $dados['ano'],
            'status'          => $dados['status'],
        ]);
    }

    public function buscarVeiculo(int $cod_veiculo): ?array {
        $sql = "SELECT * FROM veiculo WHERE cod_veiculo = :cod_veiculo";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":cod_veiculo" => $cod_veiculo]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    public function listarVeiculos(): array {
        $sql = "SELECT * FROM veiculo";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluirPrefeitura(int $cod_veiculo): bool {
        $sql = "DELETE FROM veiculo WHERE cod_veiculo = :cod_veiculo";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([":cod_veiculo" => $cod_veiculo]);
    }

}