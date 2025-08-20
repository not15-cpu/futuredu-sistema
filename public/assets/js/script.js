// Selecionando o formulário e a div de resposta
const form = document.getElementById('form-contato');
const responseDiv = document.getElementById('response');

// Adicionando o evento de envio do formulário
form.addEventListener('submit', function(e) {
    e.preventDefault(); // Evita o envio padrão do formulário

    // Criando um objeto FormData com os dados do formulário
    const formData = new FormData(form);
    formData.append('ajax', true); // Adiciona o parâmetro ajax para indicar uma requisição AJAX

    // Enviando a requisição via Fetch
    fetch('ContatoController.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Espera a resposta em formato JSON
    .then(data => {
        if (data.status === 'sucesso') {
            // Se a resposta for de sucesso, exibe a mensagem
            responseDiv.innerHTML = `<p style="color: green;">${data.mensagem}</p>`;
            form.reset(); // Limpa o formulário após o envio
        } else {
            // Se a resposta for de erro, exibe a mensagem de erro
            responseDiv.innerHTML = `<p style="color: red;">${data.mensagem}</p>`;
        }
    })
    .catch(error => {
        // Caso ocorra um erro na requisição
        responseDiv.innerHTML = `<p style="color: red;">Erro ao enviar a mensagem!</p>`;
    });
});
