const input = document.querySelector('#arquivo');
const preview = document.querySelector('#preview');
const pdfContainer = document.getElementById('pdfContainer');
const nomeDocumentoTexto = document.getElementById('nomeDocumentoTexto');
const leitor = new FileReader();

input.addEventListener('change', function(){
    const arquivo = this.files[0];
    

    leitor.addEventListener('load', function(){
        console.log(leitor.result);
        
    });
    

    if(arquivo) {
        leitor.readAsText(arquivo);
    }

    if (arquivo) {
        const objectURL = URL.createObjectURL(arquivo);

        // Crie um elemento <embed> para incorporar o PDF
        const pdfEmbed = document.createElement('embed');
        pdfEmbed.src = objectURL;
        pdfEmbed.width = '100%';
        pdfEmbed.height = '100%';

        // Limpe qualquer conteúdo anterior no contêiner PDF
        pdfContainer.innerHTML = '';

        // Adicione o elemento <embed> ao contêiner PDF
        pdfContainer.appendChild(pdfEmbed);
    } else {
        // Lidar com o caso em que nenhum arquivo foi selecionado
        console.log('Nenhum arquivo selecionado');
    }

    if (arquivo) {
        // Atualize o texto do nome do documento
        nomeDocumentoTexto.textContent = arquivo.name;
    } else {
        // Lidar com o caso em que nenhum arquivo foi selecionado
        nomeDocumentoTexto.textContent = '';
    }

})
