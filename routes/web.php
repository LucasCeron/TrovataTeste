<?php

$routesGet = [

	'/' => 'EmpresaController@list',
	'/listarEmpresas' => 'EmpresaController@list',
	'/listarProdutos' => 'ProdutoController@list',
	'/detalharProduto' => 'ProdutoController@detalhar',
	'/cadastrarProduto' => 'ProdutoController@telaCadastro',
	'/editarProduto' => 'ProdutoController@telaEdicao',
	'/sair' => 'EmpresaController@sair'
];

$routesPost = [
	
	'/acessar' => "EmpresaController@acessar",
	'/cadastrarProduto' => 'ProdutoController@cadastrarProduto',
	'/editarProduto' => 'ProdutoController@editarProduto',
	'/excluirProduto/{id}' => 'ProdutoController@excluirProduto'

];

?>