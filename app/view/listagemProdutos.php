<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listagem de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container my-5">
        <h2 class="mb-4 text-center">Lista de Produtos</h2>

        <!-- Selecionar uma nova empresa -->
        <div class="row mb-3">
            <div class="col-md-12 text-start">
                <a href="sair" class="btn btn-info btn-sm">Selecionar uma nova empresa</a>
            </div>
        </div>

        <!-- Botão Adicionar Novo Produto -->

        <div class="row mb-3">
            <div class="col-md-12 text-end">
                <a href="cadastrarProduto" class="btn btn-success">Adicionar Novo Produto</a>
            </div>
        </div>

        <!-- Filtro -->

        <form method="get" action="" class="row mb-3">
            <div class="col-md-6">
                <input type="text" name="filter" class="form-control" placeholder="Buscar por...">
            </div>
            <div class="col-md-3">
                <select name="orderBy" class="form-select">
                    <option value="" disabled <?= empty($_GET['orderBy']) ? 'selected' : '' ?>>Ordenar Por:</option>
                    <option value="descricao" <?= (($_GET['orderBy'] ?? '') === 'descricao') ? 'selected' : '' ?>>Ordenar por Descrição</option>
                    <option value="codigo" <?= (($_GET['orderBy'] ?? '') === 'codigo') ? 'selected' : '' ?>>Ordenar por Código</option>
                </select>
            </div>
            <div class="col-md-3 text-end">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <!-- Tabela -->

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Produto</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Apelido</th>
                        <th scope="col">Grupo</th>
                        <th scope="col">Complemento</th>
                        <th scope="col">Peso Líquido</th>
                        <th scope="col">Ações</th>
                        <th scope="col">Detalhes</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php      
                    if (!empty($produtos)) {
                        foreach ($produtos as $produto) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($produto['PRODUTO']) . "</td>";
                            echo "<td>" . htmlspecialchars($produto['DESCRICAO_PRODUTO']) . "</td>";
                            echo "<td>" . htmlspecialchars($produto['APELIDO_PRODUTO']) . "</td>";
                            echo "<td>" . htmlspecialchars($produto['GRUPO_PRODUTO']) . "</td>";
                            echo "<td>" . htmlspecialchars($produto['DESCRICAO_TIPO_COMPLEMENTO']) . "</td>";
                            echo "<td>" . (empty($produto['PESO_LIQUIDO']) ? "Não Informado" : htmlspecialchars($produto['PESO_LIQUIDO']) . " kg") . "</td>";
                            echo "<td>";
                            echo "<div class='d-flex justify-content-center mt-2'>"; 
                            echo "<a href='editarProduto?id=" . htmlspecialchars($produto['PRODUTO']) . "' class='btn btn-sm btn-warning me-2'>Editar</a>"; // me-2 para margem à direita
                            echo "<button class='btn btn-sm btn-danger me-2' data-bs-toggle='modal' data-bs-target='#modalExcluir' data-produto-id='" . htmlspecialchars($produto['PRODUTO']) . "'>Excluir</button>"; // me-2 para margem à direita
                            echo "</div>";
                            echo "</td>";
                            echo "<td>";
                            echo "<div class='d-flex justify-content-center mt-2'>"; 
                            echo "<a href='detalharProduto?id=" . htmlspecialchars($produto['PRODUTO']) . "' class='btn btn-sm btn-info'>Detalhar</a>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Modal de exclusão -->

        <div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="modalExcluirLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalExcluirLabel">Confirmar Exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Você tem certeza que deseja excluir este produto? Esta ação não pode ser desfeita.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <a href="#" id="confirmExcluir" class="btn btn-danger">Excluir</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navegção -->
        
        <div class="row">
            <nav aria-label="Navegação">
              <ul class="pagination">

                <!-- Página Anterior -->
                <li class="page-item <?= ($current_page == 1) ? 'disabled' : '' ?>">
                  <a class="page-link" href="?page=<?= $current_page - 1 ?>&filter=<?= urlencode($_GET['filter'] ?? '') ?>&orderBy=<?= urlencode($_GET['orderBy'] ?? '') ?>" tabindex="-1" aria-disabled="true">Previous</a>
                </li>

                <!-- Páginas -->
                <?php
                for ($page = 1; $page <= $total_pages; $page++) {
                    echo "<li class='page-item " . ($current_page == $page ? 'active' : '') . "'>";
                    echo "<a class='page-link' href='?page=$page&filter=" . urlencode($_GET['filter'] ?? '') . "&orderBy=" . urlencode($_GET['orderBy'] ?? '') . "'>$page</a>";
                    echo "</li>";
                }
                ?>

                <!-- Próxima Página -->
                <li class="page-item <?= ($current_page == $total_pages) ? 'disabled' : '' ?>">
                  <a class="page-link" href="?page=<?= $current_page + 1 ?>&filter=<?= urlencode($_GET['filter'] ?? '') ?>&orderBy=<?= urlencode($_GET['orderBy'] ?? '') ?>">Next</a>
                </li>
              </ul>
            </nav>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="public/js/modal.js"></script>  
</body>
</html>
