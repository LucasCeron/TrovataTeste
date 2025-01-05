<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="public/css/listagemEmpresa.css">
    <title>Selecionar Empresa</title>
</head>

<body class="d-flex align-items-center justify-content-center py-4">
  <div class="dropdown-menu position-static d-flex flex-column flex-row align-items-center p-3 rounded-3 shadow-lg" data-bs-theme="light" id="container"> 

    <h1 class="h3 mb-3 fw-normal">Selecione uma empresa para continuar</h1>

    <form id="empresaForm" action="acessar" method="POST">
        <div class="form-group position-relative" id="content">
        <input type="text" class="form-control" id="pesquisa" placeholder="Digite para filtrar..." name="pesquisa">
        
        <!-- Dropdown com as opções -->
        <div id="dropdown">
           <?php      
            if (!empty($empresas)) {
                foreach ($empresas as $empresa) {
                     echo "<div class= 'option' data-value= '" . htmlspecialchars($empresa['RAZAO_SOCIAL']) . "'>" . htmlspecialchars($empresa['RAZAO_SOCIAL']) . " - " . htmlspecialchars($empresa['DESCRICAO_CIDADE']) . "</div>";
                }
            }
            ?>
        </div>
        
            <input type="hidden" id="empresa" name="empresa">
        </div>

          <button type="submit" class="btn btn-primary" id="Enviar" name ="Enviar">Enviar</button>
          <?php echo (isset($_GET['msgErro'])) ? $_GET['msgErro'] : ''; ?>
    </form>

  </div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="public/js/listagemEmpresa.js"></script>

</body>
</html>
