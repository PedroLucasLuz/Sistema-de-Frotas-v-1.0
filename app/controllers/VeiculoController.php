<?php
require_once __DIR__ . "/../models/Prefeitura.php";
require_once __DIR__ . "/../models/Secretaria.php";
require_once __DIR__ . "/../models/Veiculo.php";

class VeiculoController {

    private $prefeituraModel;
    private $secretariaModel;
    private $veiculoModel;

    public function __construct() {
        $this->prefeituraModel = new Prefeitura();
        $this->secretariaModel = new Secretaria();
        $this->veiculoModel    = new Veiculo();
    }

    public function listarVeiculos(): void {
        $prefeituras = $this->prefeituraModel->listarPrefeituras();
        
        $secretarias = $this->secretariaModel->listarSecretarias();

        $veiculos = $this->veiculoModel->listarVeiculos();
        
        $prefeituraNomes = [];
        foreach ($prefeituras as $pref) {
            $prefeituraNomes[$pref['cod_prefeitura']] = $pref['nome'];
        }

        $secretariaNomes = [];
        foreach ($secretarias as $sec) {
            $secretariaNomes[$sec['cod_secretaria']] = $sec['nome'];
        }

        require_once __DIR__ . "/../views/veiculos/result.php";
    }

}