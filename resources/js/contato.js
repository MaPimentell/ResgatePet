import $ from 'jquery';
import 'jquery-mask-plugin';
// import 'select2';
// import 'leaflet';
// import Swal from 'sweetalert2';


//Mascára para o número de celular
$('#celular').mask('(00) 00000-0000');


// Função para abrir o modal e exibir a imagem clicada
$('#imagemAnimal').on('click', function() {
    const imgSrc = $('#foto').attr('src');
    $('#fotoAnimal').attr('src', imgSrc);
    $('#animalModal').removeClass('hidden').addClass('flex');
});

// Função para fechar o modal
$('#fecharModal').on('click', function() {
    $('#animalModal').addClass('hidden'); // Esconde o modal
});

// Fechar o modal ao clicar fora da imagem no modal
$('#animalModal').on('click', function(e) {
    if (e.target.id === 'animalModal') { 
        $('#animalModal').addClass('hidden');
    }
});
