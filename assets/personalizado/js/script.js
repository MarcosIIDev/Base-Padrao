//Função de preview de imagem
function previewImagem(){
    var imagem = document.querySelector('input[name=edfile]').files[0];
    var preview = document.querySelector('img[name=edfoto]');

    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if(imagem) {
        reader.readAsDataURL(imagem);
    }else {
        preview.src = "";
    }
}
