<?php
require_once __DIR__ . '/../core/Database.php';

class Prefeitura {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function cadastrarPrefeitura(array $dados): bool {
        $sql = "INSERT INTO prefeitura (cod_prefeitura, nome, endereco, telefone, email, site, cnpj) 
                VALUES (:cod_prefeitura, :nome, :endereco, :telefone, :email, :site, :cnpj)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':cod_prefeitura' => $dados['cod_prefeitura'],
            ':nome'           => $dados['nome'],
            ':endereco'       => $dados['endereco'],
            ':telefone'       => $dados['telefone'],
            ':email'          => $dados['email'],
            ':site'           => $dados['site'],
            ':cnpj'           => $dados['cnpj']
        ]);
    }

    public function editarPrefeitura(array $dados): bool {
        $sql = "SELECT COUNT(*) FROM prefeitura WHERE cod_prefeitura = :cod_prefeitura";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":cod_prefeitura" => $dados['cod_prefeitura']]);
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            return false; 
        }

        $sql = "UPDATE prefeitura 
                SET nome = :nome, endereco = :endereco, telefone = :telefone, 
                    email = :email, site = :site, cnpj = :cnpj 
                WHERE cod_prefeitura = :cod_prefeitura";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':cod_prefeitura' => $dados['cod_prefeitura'],
            ':nome'           => $dados['nome'],
            ':endereco'       => $dados['endereco'],
            ':telefone'       => $dados['telefone'],
            ':email'          => $dados['email'],
            ':site'           => $dados['site'],
            ':cnpj'           => $dados['cnpj']
        ]);
    }

    public function buscarPrefeitura(int $cod_prefeitura): ?array {
        $sql = "SELECT * FROM prefeitura WHERE cod_prefeitura = :cod_prefeitura";
        $stmt = $this->db->prepare(query: $sql);
        $stmt->execute(params: [":cod_prefeitura" => $cod_prefeitura]);
        $resultado = $stmt->fetch(mode: PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    public function listarPrefeituras(): array {
        $sql = "SELECT * FROM prefeitura";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluirPrefeitura(int $cod_prefeitura): bool {
        $sql = "DELETE FROM prefeitura WHERE cod_prefeitura = :cod_prefeitura";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([":cod_prefeitura" => $cod_prefeitura]);
    }
}
