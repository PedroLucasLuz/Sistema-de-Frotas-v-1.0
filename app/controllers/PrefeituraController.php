<?php
require_once __DIR__ . "/../models/Prefeitura.php";

class PrefeituraController {
    
    private $prefeituraModel;

    public function __construct() {
        $this->prefeituraModel = new Prefeitura();
    }

    public function listarPrefeituras(): void {
        $prefeituras = $this->prefeituraModel->listarPrefeituras();
        require_once __DIR__ . "/../views/prefeituras/result.php";
    }
}
