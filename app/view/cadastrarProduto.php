<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Cadastro de Produtos</h1>
        <form action = "cadastrarProduto" method="POST">

            <!-- Descrição do Produto -->
            <div class="mb-3">
                <label for="descricaoProduto" class="form-label">Descrição do Produto</label>
                <textarea class="form-control" id="descricaoProduto" name="descricao_produto" rows="3" required></textarea>
            </div>

            <!-- Apelido do Produto -->
            <div class="mb-3">
                <label for="apelidoProduto" class="form-label">Apelido do Produto</label>
                <input type="text" class="form-control" id="apelidoProduto" name="apelido_produto">
            </div>

            <!-- Grupo do Produto -->
            <div class="mb-3">
                <label for="grupoProduto" class="form-label">Grupo do Produto</label>
                <select class="form-select" id="grupoProduto" name="grupo_produto">
                    <?php

                    if (!empty($grupos)) {
                        echo '<option value="">Selecione</option>';
                        foreach ($grupos as $grupo) {
                            echo "<option value='" . htmlspecialchars($grupo['GRUPO_PRODUTO']) . "'>" 
                                 . htmlspecialchars($grupo['DESCRICAO_GRUPO_PRODUTO']) 
                                 . "</option>";
                        }
                    }
                    
                    ?>
                </select>
            </div>

            <!-- Subgrupo do Produto -->
            <div class="mb-3">
                <label for="subgrupoProduto" class="form-label">Subgrupo do Produto</label>
                <input type="text" class="form-control" id="subgrupoProduto" name="subgrupo_produto">
            </div>

            <!-- Situação -->
            <div class="mb-3">
                <label for="situacao" class="form-label">Situação</label>
                <select class="form-select" id="situacao" name="situacao" required>
                    <option value="">Selecione</option>
                    <option value="A">Ativo</option>
                    <option value="I">Inativo</option>
                </select>
            </div>

            <!-- Peso Líquido -->
            <div class="mb-3">
                <label for="pesoLiquido" class="form-label">Peso Líquido (kg)</label>
                <input type="number" step="0.01" class="form-control" id="pesoLiquido" name="peso_liquido">
            </div>

            <!-- Código de Barras -->
            <div class="mb-3">
                <label for="codigoBarras" class="form-label">Código de Barras</label>
                <input type="text" class="form-control" id="codigoBarras" name="codigo_barras">
            </div>

            <!-- Coleção -->
            <div class="mb-3">
                <label for="colecao" class="form-label">Coleção</label>
                <input type="text" class="form-control" id="colecao" name="colecao">
            </div>

            <!-- Botão de envio -->
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
