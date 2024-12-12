import $ from 'jquery';
import 'jquery-mask-plugin';



//Mascára para o número de celular
$('#celular').mask('(00) 00000-0000');
$('#data_perdido').mask('00/00/0000');


// Função para abrir o modal de imagem do animal ao clicar na imagem principal
$('#imagemAnimal').on('click', function() {
    const imgSrc = $('#foto').attr('src');
    $('#fotoAnimal').attr('src', imgSrc);
    $('#animalModal').removeClass('hidden').addClass('flex');
});


// Função para abrir o modal de imagem do animal ao clicar na imagem na versão mobile
$('#imagemAnimalMobile').on('click', function() {
    const imgSrc = $('#foto').attr('src');
    $('#fotoAnimal').attr('src', imgSrc);
    $('#animalModal').removeClass('hidden').addClass('flex');
});


// Função para fechar o modal de imagem do animal quando o botão de fechar for clicado
$('#fecharModal').on('click', function() {
    $('#animalModal').addClass('hidden');
});


// Função para fechar o modal de imagem do animal se o usuário clicar fora da área do modal
$('#animalModal').on('click', function(e) {
    if (e.target.id === 'animalModal') {
        $('#animalModal').addClass('hidden');
    }
});
