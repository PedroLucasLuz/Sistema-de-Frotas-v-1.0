<?php
require_once __DIR__ . "/../models/Prefeitura.php";
require_once __DIR__ . "/../models/Secretaria.php";

class SecretariaController {

    private $prefeituraModel;
    private $secretariaModel;

    public function __construct() {
        $this->prefeituraModel = new Prefeitura();
        $this->secretariaModel = new Secretaria();
    }

    public function listarSecretarias(): void {
        $prefeituras = $this->prefeituraModel->listarPrefeituras();
        
        $secretarias = $this->secretariaModel->listarsecretarias();
        
        $prefeituraNomes = [];
        foreach ($prefeituras as $pref) {
            $prefeituraNomes[$pref['cod_prefeitura']] = $pref['nome'];
        }

        require_once __DIR__ . "/../views/secretarias/result.php";
    }
}
