document.addEventListener('DOMContentLoaded', function () {
    var pesquisaInput = document.getElementById('pesquisa');
    var dropdown = document.getElementById('dropdown');
    var options = document.querySelectorAll('#dropdown .option');
    var valorSelecionado = document.getElementById('empresa');

    // Mostrar o dropdown quando o input for focado
    pesquisaInput.addEventListener('focus', function() {
        dropdown.style.display = 'block';
    });

    // Filtrar as opções enquanto o usuário digita
    pesquisaInput.addEventListener('keyup', function() {
        var searchValue = pesquisaInput.value.toLowerCase();

        options.forEach(function(option) {
            var optionText = option.textContent.toLowerCase();
            if (optionText.includes(searchValue)) {
                option.style.display = 'block'; 
            } else {
                option.style.display = 'none'; 
            }
        });
    });

    // Selecionar a opção ao clicar
    options.forEach(function(option) {
        option.addEventListener('click', function() {
            var selectedValue = option.getAttribute('data-value');  
            var selectedText = option.textContent;  

            pesquisaInput.value = selectedText;  
            valorSelecionado.value = selectedValue;  
            dropdown.style.display = 'none';  
        });
    });

    // Fechar o dropdown se o usuário clicar fora do campo de pesquisa
    document.addEventListener('click', function(event) {
        if (!event.target.closest('#pesquisa')) {
            dropdown.style.display = 'none';
        }
    });
});