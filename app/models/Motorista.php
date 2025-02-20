<?php
require_once __DIR__ . '/../core/Database.php';

class Motorista {
    private PDO $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function cadastrarMotorista(array $dados): bool {
        $sql = "INSERT INTO motorista (nome, cnh, categoria_cnh, data_validade_cnh, cod_veiculo) 
                VALUES (:nome, :cnh, :categoria_cnh, :data_validade_cnh, :cod_veiculo)";
        $stmt = $this->db->prepare(query: $sql);
        return $stmt->execute(params: [
            'data_validade_cnh' => $dados['data_validade_cnh'],
            'categoria_cnh'     => $dados['categoria_cnh'],
            'cod_veiculo'       => $dados['cod_veiculo'],
            'nome'              => $dados['nome'],
            'cnh'               => $dados['cnh'],
            
        ]);
    }

    public function editarMotorista(array $dados): bool {
        $sql = "SELECT COUNT(*) FROM motorista WHERE cod_motorista = :cod_motorista";
        $stmt = $this->db->prepare(query: $sql);
        $stmt->execute(params: [":cod_motorista" => $dados['cod_motorista']]);
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            return false;
        }

        $sql = "UPDATE motorista 
                SET nome = :nome, cnh = :cnh, categoria_cnh = :categoria_cnh, data_validade_cnh = :data_validade_cnh, cod_veiculo = :cod_veiculo
                WHERE cod_motorista = :cod_motorista";
        $stmt = $this->db->prepare(query: $sql);
        return $stmt->execute(params: [      
            'data_validade_cnh' => $dados['data_validade_cnh'],
            'cod_motorista'     => $dados['cod_motorista'],
            'categoria_cnh'     => $dados['categoria_cnh'],
            'cod_veiculo'       => $dados['cod_veiculo'],
            'nome'              => $dados['nome'],
            'cnh'               => $dados['cnh'],
        ]);
    }

    public function buscarMotorista(int $cod_motorista): ?array {
        $sql = "SELECT * FROM motorista WHERE cod_motorista = :cod_motorista";
        $stmt = $this->db->prepare(query: $sql);
        $stmt->execute(params: [":cod_motorista" => $cod_motorista]);
        $resultado = $stmt->fetch(mode: PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    public function listarMotorista(): array {
        $sql = "SELECT * FROM motorista";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluirMotorista(int $cod_motorista): bool {
        $sql = "DELETE FROM motorista WHERE cod_motorista = :cod_motorista";
        $stmt = $this->db->prepare(query: $sql);
        return $stmt->execute(params: [":cod_motorista" => $cod_motorista]);
    }

}