const fileInput = document.getElementById('fileInput');
const previewImage = document.getElementById('previewImage');

// Ativa o input de arquivo ao clicar na imagem
previewImage.addEventListener('click', () => {
    fileInput.click();
});

// Pré-visualiza a imagem selecionada e simula o envio
fileInput.addEventListener('change', () => {
    const file = fileInput.files[0];
    if (file) {
        // Verifica se o arquivo é uma imagem
        if (!file.type.startsWith('image/')) {
            uploadStatus.textContent = 'Por favor, selecione uma imagem válida.';
            return;
        }

        // Pré-visualiza a imagem
        const reader = new FileReader(); // Criando um novo leitor de arquivo
        reader.onload = (e) => { // quando o arquivo foi lido e carregado
            previewImage.src = e.target.result; // virá a source do img 
            uploadStatus.textContent = 'Imagem selecionada: ' + file.name; // Nome atualizado para subir para o "servidor"

            // Simula o envio da imagem para o servidor
            simulateUpload(file);
        };
        reader.readAsDataURL(file); // leitor se como uma base de dados em URL o arquivo
    }
});
