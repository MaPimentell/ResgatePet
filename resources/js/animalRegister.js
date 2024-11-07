import $ from 'jquery';
// import Swal from 'sweetalert2';
// import 'select2';
// import 'leaflet';

$(document).on('change', '#fotoAnimal', function(){
    var input = $(this)[0];
    console.log(input);  // For debugging purposes, you can see the input element.

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image').attr('src', e.target.result).addClass('rounded-full');  // Setting the image source
            $("#svgPlus").addClass("hidden");  // Hiding the placeholder
        }
        reader.readAsDataURL(input.files[0]);  // Reading the file as a Data URL
    }
});
