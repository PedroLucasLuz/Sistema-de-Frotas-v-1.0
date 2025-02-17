<?php
class Database {
    private static ?PDO $instance = null;

    private function __construct() {}
    public static function getConnection(): PDO {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO("mysql:host=localhost;dbname=sistema_de_frotas", username: "root", password: "", options: [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]);
            } catch (PDOException $e) {
                die("Erro na conexão com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
