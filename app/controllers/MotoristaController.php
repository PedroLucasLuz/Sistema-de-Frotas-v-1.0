<?php
require_once __DIR__ . "/../models/Motorista.php";
require_once __DIR__ . "/../models/Veiculo.php";

class MotoristaController {

    private $motoristaModel;
    private $veiculoModel;

    public function __construct() {
        $this->motoristaModel = new Motorista();
        $this->veiculoModel    = new Veiculo();
    }

    public function listarMotoristas(): void {

        $veiculos = $this->veiculoModel->listarVeiculos();
        $motoristas = $this->motoristaModel->listarMotorista();

        $veiculoNomes = [];
        foreach ($veiculos as $veiculo) {
            $veiculoNomes[$veiculo['cod_veiculo']] = $veiculo['modelo'];
        }

        require_once __DIR__ . "/../views/motoristas/result.php";
    }

    //Em Manutenção
    public function excluirVeiculo(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cod_veiculo'])) {
            $cod_veiculo = $_POST['cod_veiculo'];
    
            // Tenta excluir o veículo
            $resultado = $this->veiculoModel->excluirVeiculo(cod_veiculo: $cod_veiculo);
    
            if ($resultado) {
                header(header: "Location: ../public/index.php?mensagem=sucesso");
                exit();
            } else {
                header(header: "Location: ../public/index.php?erro=nao_excluido");
                exit();
            }
        } else {
            echo "ID do veículo não foi fornecido.";
        }
    }
    

}