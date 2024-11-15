import $ from 'jquery';
import Toastify from 'toastify-js'
// import Swal from 'sweetalert2';
// import 'select2';
// import 'leaflet';

// Escuta a mudança no campo de input com o id #fotoAnimal (quando um novo arquivo é selecionado)
$(document).on('change', '#fotoAnimal', function(){
    var input = $(this)[0];
    console.log(input);  

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image').attr('src', e.target.result).addClass('rounded-full');  
            $("#svgPlus").addClass("hidden");  
        }
        reader.readAsDataURL(input.files[0]);  
    }
});
