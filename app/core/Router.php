<?php

namespace App\Core;

Class Router {

	public function run($routesGet, $routesPost){

		$routerFound = false;//variavel para verificar se uma rota foi achada

		//definindo um variavel para armazenar as urls e passando como valor inicial '/

		$url='/';
		($url != '/') ? rtrim($url, '/'): $url;
		isset($_GET['url']) ? $url .= $_GET['url'] : '';


		// configurando em qual array de rotas se´ra feita a busca com base no tipo de método utilizado (GET ou POST) 

		$method = $_SERVER['REQUEST_METHOD'];
		$routes = ($method == 'GET') ? $routesGet : (($method == 'POST') ? $routesPost : null); 

		 
		 foreach ($routes as $path => $controller) {

			// definindo um expressão regular
		 	 $pattern = "#^" . preg_replace('/{id}/', '(\w+)', $path) . '$#';

		 	//Usando o preg_match para verificar se a url corresponde ao padrão de rotas

		 	if (preg_match($pattern, $url, $matches)) {
		 	 	array_shift($matches);


				// dividindo o valor passado em controller em outras duas váriaveis $currentControler para o controlador que deve ser acessado e $action para a função que deve ser utilizada nesse controlador 

		 		[$currentController, $action] = explode('@', $controller);

		 	 	require_once __DIR__ . '/../controllers/' . $currentController . '.php';
		 	 	$newController = new $currentController();
                $newController->$action($matches);

                // definindo uma variável para indiacar que uma rota foi encontrada
                $routerFound = true;
                break;

		 	 }
		}

		//verificando se nenhuma rota foi encontrada com base no valor de $routerFound
		if(!$routerFound){

			echo "<h1>404</h1>";
			echo "<p>Página não Encontrada</p>";

		}
	}
}

?>






