<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Atualizar Produto</h1>
        
        <form action="editarProduto" method="POST">
            <!-- Mostra o Produto -->
            <div class="mb-3">
                <h5 class="mb-1"><strong>Produto:</strong> <?= htmlspecialchars($detalhes['PRODUTO']) ?></h5>
            </div>

            <input type="hidden" name='PRODUTO' value="<?= htmlspecialchars($detalhes['PRODUTO']) ?>"></input>

            <!-- Descrição do Produto -->
            <div class="mb-3">
                <p class="mb-1"><strong>Descrição Atual:</strong> <?= htmlspecialchars($detalhes['DESCRICAO_PRODUTO']) ?></p>
                <label for="descricaoProduto" class="form-label">Nova Descrição</label>
                <textarea class="form-control" id="descricaoProduto" name="descricao_produto" rows="3" required><?= htmlspecialchars($detalhes['DESCRICAO_PRODUTO']) ?></textarea>
            </div>

            <!-- Apelido do Produto -->
            <div class="mb-3">
                <p class="mb-1"><strong>Apelido Atual:</strong> <?= htmlspecialchars($detalhes['APELIDO_PRODUTO']) ?></p>
                <label for="apelidoProduto" class="form-label">Novo Apelido</label>
                <input type="text" class="form-control" id="apelidoProduto" name="apelido_produto" value="<?= htmlspecialchars($detalhes['APELIDO_PRODUTO']) ?>">
            </div>

            <!-- Grupo do Produto -->
            <div class="mb-3">
                <p class="mb-1"><strong>Grupo Atual:</strong> <?= htmlspecialchars($detalhes['GRUPO_PRODUTO']) ?> - <?= htmlspecialchars($detalhes['DESCRICAO_GRUPO_PRODUTO']) ?></p>
                <label for="grupoProduto" class="form-label">Novo Grupo</label>
                <select class="form-select" id="grupoProduto" name="grupo_produto">
                    <?php
                    if (!empty($grupos)) {
                        echo '<option value="">Selecione</option>';
                        foreach ($grupos as $grupo) {
                            $selected = $grupo['GRUPO_PRODUTO'] == $detalhes['GRUPO_PRODUTO'] ? "selected" : "";
                            echo "<option value='" . htmlspecialchars($grupo['GRUPO_PRODUTO']) . "' $selected>" 
                                 . htmlspecialchars($grupo['DESCRICAO_GRUPO_PRODUTO']) 
                                 . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <!-- Subgrupo do Produto -->
            <div class="mb-3">
                <p class="mb-1"><strong>Subgrupo Atual:</strong> <?= htmlspecialchars($detalhes['SUBGRUPO_PRODUTO']) ?></p>
                <label for="subgrupoProduto" class="form-label">Novo Subgrupo</label>
                <input type="text" class="form-control" id="subgrupoProduto" name="subgrupo_produto" value="<?= htmlspecialchars($detalhes['SUBGRUPO_PRODUTO']) ?>">
            </div>

            <!-- Situação -->
            <div class="mb-3">
                <p class="mb-1"><strong>Situação Atual:</strong> <?= htmlspecialchars($detalhes['SITUACAO'] == 'A' ? 'Ativo' : 'Inativo') ?></p>
                <label for="situacao" class="form-label">Nova Situação</label>
                <select class="form-select" id="situacao" name="situacao" required>
                    <option value="A" <?= $detalhes['SITUACAO'] == 'A' ? "selected" : "" ?>>Ativo</option>
                    <option value="I" <?= $detalhes['SITUACAO'] == 'I' ? "selected" : "" ?>>Inativo</option>
                </select>
            </div>

            <!-- Peso Líquido -->
            <div class="mb-3">
                <p class="mb-1"><strong>Peso Líquido Atual:</strong> <?= empty($detalhes['PESO_LIQUIDO']) ? "Não Informado" : htmlspecialchars($detalhes['PESO_LIQUIDO']) . " kg" ?></p>
                <label for="pesoLiquido" class="form-label">Novo Peso Líquido (kg)</label>
                <input type="number" step="0.01" class="form-control" id="pesoLiquido" name="peso_liquido" value="<?= htmlspecialchars($detalhes['PESO_LIQUIDO']) ?>">
            </div>

            <!-- Código de Barras -->
            <div class="mb-3">
                <p class="mb-1"><strong>Código de Barras Atual:</strong> <?= htmlspecialchars($detalhes['CODIGO_BARRAS']) ?></p>
                <label for="codigoBarras" class="form-label">Novo Código de Barras</label>
                <input type="text" class="form-control" id="codigoBarras" name="codigo_barras" value="<?= htmlspecialchars($detalhes['CODIGO_BARRAS']) ?>">
            </div>

            <!-- Coleção -->
            <div class="mb-3">
                <p class="mb-1"><strong>Coleção Atual:</strong> <?= htmlspecialchars($detalhes['COLECAO']) ?></p>
                <label for="colecao" class="form-label">Nova Coleção</label>
                <input type="text" class="form-control" id="colecao" name="colecao" value="<?= htmlspecialchars($detalhes['COLECAO']) ?>">
            </div>

            <!-- Botão de envio -->
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>

        <!-- Botão de voltar -->
        <div class="mt-4">
            <a href="listarProdutos" class="btn btn-secondary">Voltar para a Lista de Produtos</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
