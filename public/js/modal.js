document.addEventListener('DOMContentLoaded', function () {
    var excluirBtns = document.querySelectorAll('[data-bs-target="#modalExcluir"]');
    var confirmExcluirBtn = document.getElementById('confirmExcluir');

    excluirBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var produtoId = this.getAttribute('data-produto-id');
            
            // Ao clicar no botão de excluir, preenche o produtoId no botão de confirmação
            confirmExcluirBtn.addEventListener('click', function() {
                // Cria o formulário dinamicamente
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'excluirProduto/' + produtoId; // URL dinâmica para excluir o produto
                
                // Cria o campo de input para o produtoId
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'produtoId'; // Nome do campo
                input.value = produtoId; // Valor do campo (produtoId)
                form.appendChild(input);
                
                // Adiciona o formulário ao body e envia
                document.body.appendChild(form);
                form.submit(); // Envia o formulário
            });
        });
    });

});