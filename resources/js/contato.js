import $ from 'jquery';
import 'jquery-mask-plugin';
// import 'select2';
// import 'leaflet';
// import Swal from 'sweetalert2';


//Mascára para o número de celular
$('#celular').mask('(00) 00000-0000');


$('#imagemAnimal').on('click', function() {
    const imgSrc = $('#foto').attr('src');
    $('#fotoAnimal').attr('src', imgSrc);
    $('#animalModal').removeClass('hidden').addClass('flex');
});

$('#imagemAnimalMobile').on('click', function() {
    const imgSrc = $('#foto').attr('src');
    $('#fotoAnimal').attr('src', imgSrc);
    $('#animalModal').removeClass('hidden').addClass('flex');
});

$('#fecharModal').on('click', function() {
    $('#animalModal').addClass('hidden');
});

$('#animalModal').on('click', function(e) {
    if (e.target.id === 'animalModal') {
        $('#animalModal').addClass('hidden');
    }
});
