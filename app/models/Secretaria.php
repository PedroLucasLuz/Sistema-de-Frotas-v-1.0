<?php
require_once __DIR__ . '/../core/Database.php';

class Secretaria {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function cadastrarSecretaria(array $dados): bool {
        $sql = "INSERT INTO secretaria (nome, telefone, email, cod_prefeitura) 
                VALUES ( :nome, :telefone, :email, :cod_prefeitura)";
        $stmt = $this->db->prepare(query: $sql);
        return $stmt->execute(params: [
            ':nome'           => $dados['nome'],
            ':telefone'       => $dados['telefone'],
            ':email'          => $dados['email'],
            ':cod_prefeitura' => $dados['cod_prefeitura']
        ]);
    }
    
    public function editarSecretaria(array $dados): bool {
        $sql = "SELECT COUNT(*) FROM secretaria WHERE cod_secretaria = :cod_secretaria";
        $stmt = $this->db->prepare(query: $sql);
        $stmt->execute(params: [":cod_secretaria" => $dados['cod_secretaria']]);
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            return false;
        }

        $sql = "UPDATE secretaria 
                SET nome = :nome, telefone = :telefone, email = :email, cod_prefeitura = :cod_prefeitura
                WHERE cod_secretaria = :cod_secretaria";
        $stmt = $this->db->prepare(query: $sql);
        return $stmt->execute(params: [
            ':cod_prefeitura' => $dados['cod_prefeitura'],
            ':cod_secretaria' => $dados['cod_secretaria'],
            ':nome'           => $dados['nome'],
            ':telefone'       => $dados['telefone'],
            ':email'          => $dados['email']
        ]);
    }

    public function buscarSecretaria(int $cod_secretaria): array | false {
        $sql = "SELECT * FROM secretaria WHERE cod_secretaria = :cod_secretaria";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":cod_secretaria" => $cod_secretaria]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarSecretarias(): array {
        $sql = "SELECT * FROM secretaria";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluirSecretaria(int $cod_secretaria): bool {
        $sql = "DELETE FROM secretaria WHERE cod_secretaria = :cod_secretaria";
        $stmt = $this->db->prepare(query: $sql);
        return $stmt->execute(params: [":cod_secretaria" => $cod_secretaria]);
    }
}
