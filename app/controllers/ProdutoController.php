<?php

use App\Models\Produto;

class ProdutoController {

    public function list() {
       
        session_start();

        if (!isset($_SESSION['EmpresaConectada'])){
            header('location: listarEmpresas');
        }

        $id_empresa = $_SESSION['EmpresaConectada'];
        $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        if (isset($_GET['filter']) || isset($_GET['orderBy'])) {

            $orderBy = $_GET['orderBy'] ?? null;  
            $filter = $_GET['filter'] ?? '';      

            $total_produtos = Produto::totalProdutosPorBusca($id_empresa, $filter);
            $produtos = Produto::buscarProdutosPorFiltragem($id_empresa, $current_page, $orderBy, $filter);
            $total_pages = ceil($total_produtos/15);

        } else {

            $total_produtos = Produto::totalProdutosPorBusca($id_empresa);
            $produtos = Produto::buscarProdutos($id_empresa, $current_page);
            $total_pages = ceil($total_produtos/15);
        }

        
        view("listagemProdutos", ['produtos' => $produtos,
    							  'current_page' => $current_page,
    							  'total_pages' => $total_pages
    							  
    							 ]);

    }


    public function detalhar(){
    
        session_start();

        if (!isset($_SESSION['EmpresaConectada'])) {
            header('location: listarEmpresas');
        }

        $id_empresa = $_SESSION['EmpresaConectada'];
        $id_produto = $_GET['id'];

        $produto = new produto($id_produto, $id_empresa);
        $detalhes = $produto->detalhar();


        view('detalharProduto', ['detalhes' => $detalhes ]);


    }


    public function telaCadastro(){

        session_start();

        if (!isset($_SESSION['EmpresaConectada'])) {
            header('location: listarEmpresas');
        }

        $id_empresa = $_SESSION['EmpresaConectada'];

        $grupos = Produto::buscarGrupos($id_empresa);

        
        view('cadastrarProduto', ['grupos' => $grupos]);

    }


    public function cadastrarProduto(){


        session_start();

        if (!isset($_SESSION['EmpresaConectada'])) {
            header('location: listarEmpresas');
        }

        $id_empresa = $_SESSION['EmpresaConectada'];

        $descricao_produto = isset($_POST['descricao_produto']) ? $_POST['descricao_produto'] : '';
        $apelido_produto = isset($_POST['apelido_produto']) ? $_POST['apelido_produto'] : '';
        $grupo_produto = isset($_POST['grupo_produto']) ? $_POST['grupo_produto'] : '';
        $subgrupo_produto = isset($_POST['subgrupo_produto']) ? $_POST['subgrupo_produto'] : '';
        $situacao = isset($_POST['situacao']) ? $_POST['situacao'] : '';
        $peso_liquido = isset($_POST['peso_liquido']) ? $_POST['peso_liquido'] : '';
        $classificacao_fiscal = isset($_POST['classificacao_fiscal']) ? $_POST['classificacao_fiscal'] : '';
        $codigo_barras = isset($_POST['codigo_barras']) ? $_POST['codigo_barras'] : '';
        $colecao = isset($_POST['colecao']) ? $_POST['colecao'] : '';

        $produto = new Produto(
        $id_empresa, 
        $descricao_produto, 
        $apelido_produto, 
        $grupo_produto, 
        $subgrupo_produto, 
        $situacao, 
        $peso_liquido, 
        $classificacao_fiscal, 
        $codigo_barras, 
        $colecao
    );


        $produto->cadastrar();

    }


    public function telaEdicao(){

        session_start();

        if (!isset($_SESSION['EmpresaConectada'])) {
            header('location: listarEmpresas');
        }


        $id_empresa = $_SESSION['EmpresaConectada'];
        $id_produto = $_GET['id'];

        $grupos = Produto::buscarGrupos($id_empresa);

        $produto = new produto($id_produto, $id_empresa);
        $detalhes = $produto->detalhar();


        view('editarProduto', ['grupos' => $grupos,
                               'detalhes' => $detalhes

        ]);
    }



    public function editarProduto() {

        session_start();

        if (!isset($_SESSION['EmpresaConectada'])) {
            header('location: listarEmpresas');
        }
        
        $id_empresa = $_SESSION['EmpresaConectada'];
        $id_produto = $_POST['PRODUTO'];



        $descricao_produto = isset($_POST['descricao_produto']) ? $_POST['descricao_produto'] : '';
        $apelido_produto = isset($_POST['apelido_produto']) ? $_POST['apelido_produto'] : '';
        $grupo_produto = isset($_POST['grupo_produto']) ? $_POST['grupo_produto'] : '';
        $subgrupo_produto = isset($_POST['subgrupo_produto']) ? $_POST['subgrupo_produto'] : '';
        $situacao = isset($_POST['situacao']) ? $_POST['situacao'] : '';
        $peso_liquido = isset($_POST['peso_liquido']) ? $_POST['peso_liquido'] : '';
        $codigo_barras = isset($_POST['codigo_barras']) ? $_POST['codigo_barras'] : '';
        $colecao = isset($_POST['colecao']) ? $_POST['colecao'] : '';


        $produto = new produto($id_produto, $id_empresa);


        $produto->setDescricaoProduto($descricao_produto);
        $produto->setApelidoProduto($apelido_produto);
        $produto->setGrupoProduto($grupo_produto);
        $produto->setSubgrupoProduto($subgrupo_produto);
        $produto->setSituacao($situacao);
        $produto->setPesoLiquido($peso_liquido);
        $produto->setCodigoBarras($codigo_barras);
        $produto->setColecao($colecao);

        
        $produto->atualizar();
    }


    public function excluirProduto($id){

        session_start();

        if (!isset($_SESSION['EmpresaConectada'])) {
            header('location: listarEmpresas');
        }

        $id_empresa = $_SESSION['EmpresaConectada'];
        $id_produto = $id[0];

        $produto = new produto($id_produto, $id_empresa);
        $produto->excluir();
        

    }
}


?>