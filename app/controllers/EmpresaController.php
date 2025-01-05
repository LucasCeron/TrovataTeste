<?php

use App\Models\Empresa;

class EmpresaController{

	public function list(){

		 session_start();

        if (isset($_SESSION['EmpresaConectada'])) {
            header('location: listarProdutos');
        }

		$empresas = Empresa::BuscarTodas();

	 	view("listagemEmpresas", ['empresas' => $empresas]);

	}

	public function acessar(){

		if (isset($_POST['Enviar'])) {

			var_dump($_POST['empresa']);
			$razaoSocial = $_POST['empresa'];
			$empresa = new empresa();
			$empresa->setRazaoSocial($razaoSocial);

			$coluna = 'RAZAO_SOCIAL';
			$empresa = $empresa->consultarDados($coluna);

			if ($empresa === null) {
				$msgErro = urlencode("Erro ao tentar acessar essa Empresa...");
				header("Location: listarEmpresas?msgErro=$msgErro");
				exit();
			}


			session_start();
			$_SESSION['EmpresaConectada'] = $empresa->getIdEmpresa();

			header('location: listarProdutos');
		}
	}


	public function sair(){

		session_start();
		session_unset();
		session_destroy();

		header('location: listarEmpresas');
	}

}

?>