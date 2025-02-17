<?php
require_once __DIR__ . '/../../app/core/Database.php';

try {
    $db = Database::getConnection();
    echo "Conexão bem-sucedida!";
} catch (Exception $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
