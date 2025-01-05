<?php

namespace App\Models;

class Produto {
    private $id_produto;
    private $id_empresa;
    private $descricao_produto;
    private $apelido_produto;
    private $grupo_produto;
    private $subgrupo_produto;
    private $situacao;
    private $peso_liquido;
    private $classificacao_fiscal;
    private $codigo_barras;
    private $colecao;

  
    public function __construct(
        $id_produto = null,
        $id_empresa = null,
        $descricao_produto = null,
        $apelido_produto = null,
        $grupo_produto = null,
        $subgrupo_produto = null,
        $situacao = null,
        $peso_liquido = null,
        $classificacao_fiscal = null,
        $codigo_barras = null,
        $colecao = null
    ) {
        $this->id_produto = $id_produto;
        $this->id_empresa = $id_empresa;
        $this->descricao_produto = $descricao_produto;
        $this->apelido_produto = $apelido_produto;
        $this->grupo_produto = $grupo_produto;
        $this->subgrupo_produto = $subgrupo_produto;
        $this->situacao = $situacao;
        $this->peso_liquido = $peso_liquido;
        $this->classificacao_fiscal = $classificacao_fiscal;
        $this->codigo_barras = $codigo_barras;
        $this->colecao = $colecao;
    }


    public function getIdEmpresa() {
        return $this->empresa;
    }

    public function setIdEmpresa($id_empresa) {
        $this->empresa = $id_empresa;
    }

    public function getIdProduto() {
        return $this->produto;
    }

    public function setIdProduto($id_produto) {
        $this->produto = $id_produto;
    }

    public function getDescricaoProduto() {
        return $this->descricao_produto;
    }

    public function setDescricaoProduto($descricao_produto) {
        $this->descricao_produto = $descricao_produto;
    }

    public function getApelidoProduto() {
        return $this->apelido_produto;
    }

    public function setApelidoProduto($apelido_produto) {
        $this->apelido_produto = $apelido_produto;
    }

    public function getGrupoProduto() {
        return $this->grupo_produto;
    }

    public function setGrupoProduto($grupo_produto) {
        $this->grupo_produto = $grupo_produto;
    }

    public function getSubgrupoProduto() {
        return $this->subgrupo_produto;
    }

    public function setSubgrupoProduto($subgrupo_produto) {
        $this->subgrupo_produto = $subgrupo_produto;
    }

    public function getSituacao() {
        return $this->situacao;
    }

    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    public function getPesoLiquido() {
        return $this->peso_liquido;
    }

    public function setPesoLiquido($peso_liquido) {
        $this->peso_liquido = $peso_liquido;
    }

    public function getClassificacaoFiscal() {
        return $this->classificacao_fiscal;
    }

    public function setClassificacaoFiscal($classificacao_fiscal) {
        $this->classificacao_fiscal = $classificacao_fiscal;
    }

    public function getCodigoBarras() {
        return $this->codigo_barras;
    }

    public function setCodigoBarras($codigo_barras) {
        $this->codigo_barras = $codigo_barras;
    }

    public function getColecao() {
        return $this->colecao;
    }

    public function setColecao($colecao) {
        $this->colecao = $colecao;
    }



    public static function buscarProdutos($id_empresa, $currentPage) {
        
        require __DIR__."/../utils/dbConnect.php";
        
        $limit = 15;
        $offset = 15 * ($currentPage - 1);
        $order_by = 'PRODUTO';

        $sql = "SELECT 
                    p.*, 
                    g.DESCRICAO_GRUPO_PRODUTO, 
                    t.DESCRICAO_TIPO_COMPLEMENTO
                FROM 
                    PRODUTO p
                JOIN 
                    GRUPO_PRODUTO g ON p.GRUPO_PRODUTO = g.GRUPO_PRODUTO AND p.EMPRESA = g.EMPRESA
                JOIN 
                    TIPO_COMPLEMENTO t ON g.TIPO_COMPLEMENTO = t.TIPO_COMPLEMENTO AND g.EMPRESA = t.EMPRESA
                WHERE 
                    p.EMPRESA = ? 
                LIMIT ? OFFSET ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $id_empresa, $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $produtos = [];
        while ($produto = $result->fetch_assoc()) {
            $produtos[] = $produto;
        }

        return $produtos;
    }

    public static function buscarProdutosPorFiltragem($id_empresa, $currentPage, $order_by = "null", $filter = '') {

        require __DIR__."/../utils/dbConnect.php";

        $limit = 15;
        $offset = 15 * ($currentPage - 1);

        $order_by = ($order_by === 'codigo') ? 'CAST(p.PRODUTO AS UNSIGNED)' :
               (($order_by === 'descricao') ? 'DESCRICAO_PRODUTO' : "null");

        $filter ="%$filter%";

        $sql = "SELECT 
                    p.*, 
                    g.DESCRICAO_GRUPO_PRODUTO, 
                    t.DESCRICAO_TIPO_COMPLEMENTO
                FROM 
                    PRODUTO p
                JOIN 
                    GRUPO_PRODUTO g ON p.GRUPO_PRODUTO = g.GRUPO_PRODUTO AND p.EMPRESA = g.EMPRESA
                JOIN 
                    TIPO_COMPLEMENTO t ON g.TIPO_COMPLEMENTO = t.TIPO_COMPLEMENTO AND g.EMPRESA = t.EMPRESA
                WHERE 
                    p.EMPRESA = ? 
                    AND (g.DESCRICAO_GRUPO_PRODUTO LIKE ? 
                         OR p.DESCRICAO_PRODUTO LIKE ? 
                         OR p.PRODUTO LIKE ?
                         OR p.APELIDO_PRODUTO LIKE ?)
                ORDER BY  
                    $order_by 
                LIMIT 
                    ? 
                OFFSET 
                    ?;";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssii", $id_empresa, $filter, $filter, $filter, $filter, $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $produtos = [];
        while ($produto = $result->fetch_assoc()) {
            $produtos[] = $produto;
        }

        return $produtos;
    }

    public static function totalProdutosPorBusca($id_empresa, $filter = '') {

        require __DIR__."/../utils/dbConnect.php";

        $filter = "%$filter%";

        $sql = "SELECT 
                    COUNT(*) AS total
                FROM 
                    PRODUTO p
                JOIN 
                    GRUPO_PRODUTO g ON p.GRUPO_PRODUTO = g.GRUPO_PRODUTO AND p.EMPRESA = g.EMPRESA
                JOIN 
                    TIPO_COMPLEMENTO t ON g.TIPO_COMPLEMENTO = t.TIPO_COMPLEMENTO AND g.EMPRESA = t.EMPRESA
                WHERE 
                    p.EMPRESA = ? 
                    AND (g.DESCRICAO_GRUPO_PRODUTO LIKE ? 
                         OR p.DESCRICAO_PRODUTO LIKE ? 
                         OR p.PRODUTO LIKE ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $id_empresa, $filter, $filter, $filter);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        return $row['total'];
    }


    public function detalhar(){

        require __DIR__."/../utils/dbConnect.php";

        $sql= "SELECT 
                    p.*, 
                    g.DESCRICAO_GRUPO_PRODUTO, 
                    t.DESCRICAO_TIPO_COMPLEMENTO
                FROM 
                    PRODUTO p
                JOIN 
                    GRUPO_PRODUTO g ON p.GRUPO_PRODUTO = g.GRUPO_PRODUTO AND p.EMPRESA = g.EMPRESA
                JOIN 
                    TIPO_COMPLEMENTO t ON g.TIPO_COMPLEMENTO = t.TIPO_COMPLEMENTO AND g.EMPRESA = t.EMPRESA
                WHERE 
                    p.PRODUTO = ? 
                    AND p.EMPRESA = ?; ";

       
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $this->id_produto, $this->id_empresa);
        $stmt->execute();
        $result = $stmt->get_result();
        $produto = $result->fetch_assoc();

        return $produto;
        
    }


    public static function buscarGrupos($id_empresa){

        require __DIR__."/../utils/dbConnect.php";

        $sql = "SELECT * FROM GRUPO_PRODUTO WHERE EMPRESA = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_empresa);
        $stmt->execute();
        $result = $stmt->get_result();

        $grupos = [];
        while ($grupo = $result->fetch_assoc()) {
            $grupos[] = $grupo;
        }

        return $grupos;
    }


    public function cadastrar(){

        require __DIR__."/../utils/dbConnect.php";

        $id_produto = uniqid();
        $classificacao_fiscal = $id_produto;

        $sql = "INSERT INTO PRODUTO (
            EMPRESA, 
            PRODUTO, 
            DESCRICAO_PRODUTO, 
            APELIDO_PRODUTO, 
            GRUPO_PRODUTO, 
            SUBGRUPO_PRODUTO, 
            SITUACAO, 
            PESO_LIQUIDO, 
            CLASSIFICACAO_FISCAL, 
            CODIGO_BARRAS, 
            COLECAO
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        )";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "isssiisisss", 
            $this->id_empresa, 
            $id_produto,
            $this->descricao_produto, 
            $this->apelido_produto, 
            $this->grupo_produto, 
            $this->subgrupo_produto, 
            $this->situacao, 
            $this->peso_liquido, 
            $this->classificacao_fiscal, 
            $this->codigo_barras, 
            $this->colecao
        );


        if ($stmt->execute()) {
            echo "<script>
                    alert('Produto cadastrado com sucesso!');
                    window.location.href = 'listarProdutos'; // Redireciona para a página de listagem
                  </script>";

        } else {
            echo "<script>
                    alert('Falha ao cadastrar o Produto');
                    window.location.href = 'listarProdutos'; // Redireciona para a página de listagem
                </script>";
        }


    }



    public function atualizar() {

        require __DIR__ . "/../utils/dbConnect.php";

        $sql = "UPDATE PRODUTO SET 
                DESCRICAO_PRODUTO = ?, 
                APELIDO_PRODUTO = ?, 
                GRUPO_PRODUTO = ?, 
                SUBGRUPO_PRODUTO = ?, 
                SITUACAO = ?, 
                PESO_LIQUIDO = ?,  
                CODIGO_BARRAS = ?, 
                COLECAO = ? 
                WHERE PRODUTO = ? 
                      AND
                      EMPRESA = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssiisisssi",    
            $this->descricao_produto, 
            $this->apelido_produto, 
            $this->grupo_produto, 
            $this->subgrupo_produto, 
            $this->situacao, 
            $this->peso_liquido, 
            $this->codigo_barras, 
            $this->colecao, 
            $this->id_produto,
            $this->id_empresa
        );

        if ($stmt->execute()) {

            echo "<script>
                    alert('Produto atualizado com sucesso!');
                    window.location.href = 'listarProdutos'; 
                  </script>";
        } else {

            echo "<script>
                    alert('Falha ao atualizar o Produto');
                    window.location.href = 'listarProdutos';
                  </script>";
        }
    }


    public function excluir() {

        require __DIR__ . "/../utils/dbConnect.php";

        // Prepara a consulta DELETE
        $sql = "DELETE FROM PRODUTO 
                WHERE PRODUTO = ? 
                  AND EMPRESA = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $this->id_produto, $this->id_empresa);
        if ($stmt->execute()) {
            
            echo "<script>
                    alert('Produto excluído com sucesso!');
                    window.location.href = '../listarProdutos';
                  </script>";
        } else {
            
            echo "<script>
                    alert('Falha ao excluir o Produto');
                    window.location.href = '../listarProdutos';
                  </script>";
        }
    }


}


?>
