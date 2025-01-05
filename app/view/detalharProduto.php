<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2 class="mb-4">Detalhes do Produto</h2>

        <!-- Lista de Detalhes do Produto -->
        <div class="list-group">
            <!-- Exemplo de item de lista com detalhes do produto -->
            <div class="list-group-item">
                <h5 class="mb-1"><strong>Produto:</strong> <?= htmlspecialchars($detalhes['PRODUTO']) ?></h5>
                <p class="mb-1"><strong>Descrição:</strong> <?= htmlspecialchars($detalhes['DESCRICAO_PRODUTO']) ?></p>
                <p class="mb-1"><strong>Apelido:</strong> <?= htmlspecialchars($detalhes['APELIDO_PRODUTO']) ?></p>
                <p class="mb-1"><strong>Grupo Produto:</strong> <?= htmlspecialchars($detalhes['GRUPO_PRODUTO']) ?> - <?= htmlspecialchars($detalhes['DESCRICAO_GRUPO_PRODUTO']) ?></p>
                <p class="mb-1"><strong>Subgrupo Produto:</strong> <?= htmlspecialchars($detalhes['SUBGRUPO_PRODUTO']) ?></p>
                <p class="mb-1"><strong>Situação:</strong> <?= htmlspecialchars($detalhes['SITUACAO']) ?></p>
                <p class="mb-1"><strong>Peso Líquido:</strong> <?= empty($detalhes['PESO_LIQUIDO']) ? "Não Informado" : htmlspecialchars($detalhes['PESO_LIQUIDO']) . " kg" ?></p>
                <p class="mb-1"><strong>Classificação Fiscal:</strong> <?= htmlspecialchars($detalhes['CLASSIFICACAO_FISCAL']) ?></p>
                <p class="mb-1"><strong>Código de Barras:</strong> <?= htmlspecialchars($detalhes['CODIGO_BARRAS']) ?></p>
                <p class="mb-1"><strong>Coleção:</strong> <?= htmlspecialchars($detalhes['COLECAO']) ?></p>
                <p class="mb-1"><strong>Tipo de Complemento:</strong> <?= htmlspecialchars($detalhes['DESCRICAO_TIPO_COMPLEMENTO']) ?></p>
            </div>
        </div>

        <!-- Botão de Voltar -->
        <div class="mt-4">
            <a href="listarProdutos" class="btn btn-secondary">Voltar para a Lista de Produtos</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
