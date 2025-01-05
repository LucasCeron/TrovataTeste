<?php

namespace App\Models;

class Empresa {

    private $idEmpresa;
    private $nomeFantasia;
    private $razaoSocial;
    private $endereco;
    private $bairro;
    private $cep;
    private $cidade;    
    private $telefone;
    private $fax;
    private $cnpj;
    private $ie;

    public function __construct(
        $idEmpresa = null,
        $nomeFantasia = null,
        $razaoSocial = null,
        $endereco = null,
        $bairro = null,
        $cep = null,
        $cidade = null,
        $telefone = null,
        $fax = null,
        $cnpj = null,
        $ie = null
    ) {
        $this->idEmpresa = $idEmpresa;
        $this->nomeFantasia = $nomeFantasia;
        $this->razaoSocial = $razaoSocial;
        $this->endereco = $endereco;
        $this->bairro = $bairro;
        $this->cep = $cep;
        $this->cidade = $cidade;
        $this->telefone = $telefone;
        $this->fax = $fax;
        $this->cnpj = $cnpj;
        $this->ie = $ie;
    }

    public function getIdEmpresa() {
        return $this->idEmpresa;
    }

    public function setIdEmpresa($idEmpresa) {
        $this->idEmpresa = $idEmpresa;
    }

    public function getNomeFantasia() {
        return $this->nomeFantasia;
    }

    public function setNomeFantasia($nomeFantasia) {
        $this->nomeFantasia = $nomeFantasia;
    }

    public function getRazaoSocial() {
        return $this->razaoSocial;
    }

    public function setRazaoSocial($razaoSocial) {
        $this->razaoSocial = $razaoSocial;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getFax() {
        return $this->fax;
    }

    public function setFax($fax) {
        $this->fax = $fax;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function getIe() {
        return $this->ie;
    }

    public function setIe($ie) {
        $this->ie = $ie;
    }

    public static function buscarTodas() {
        
        require_once __DIR__ . "/../utils/dbConnect.php";

        
        $sql = "SELECT 
                    EMPRESA.*, 
                    CIDADE.DESCRICAO_CIDADE
                FROM 
                    EMPRESA
                JOIN 
                    CIDADE 
                ON 
                    EMPRESA.CIDADE = CIDADE.CIDADE 
                AND 
                    EMPRESA.EMPRESA = CIDADE.EMPRESA;
                    ";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        
        $empresas = [];
        while ($empresa = $result->fetch_assoc()) {
            $empresas[] = $empresa;
        }

        return $empresas; 
    }


    public function ConsultarDados($coluna){

        require_once __DIR__ . "/../utils/dbConnect.php";

       $valor = ($coluna == 'EMPRESA') ? $this->idEmpresa :
       (($coluna == 'RAZAO_SOCIAL') ? $this->razaoSocial : null);


        if($valor != null) {

            $sql = "SELECT * FROM EMPRESA WHERE $coluna = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $valor);
            $stmt->execute();
            $result = $stmt->get_result();
            $dados = $result->fetch_assoc();

            if($dados !=null){
                return new Empresa($dados['EMPRESA'], $dados['NOME_FANTASIA'], $dados['RAZAO_SOCIAL'], $dados['ENDERECO'], $dados['BAIRRO'], $dados['CEP'], $dados['CIDADE'], $dados['TELEFONE'], $dados['FAX'], $dados['CNPJ'], $dados['IE']);

            }
        }

        return null;

    }

}

?>
