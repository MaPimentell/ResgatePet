import $ from 'jquery';
import Swal from 'sweetalert2';
// import 'select2';
// import 'leaflet';



$('.btn-deletaAnimal').on('click', function(){

    var animal_id = $(this).data('id');
    
    Swal.fire({
        title: 'Tem certeza?',
        text: "Você realmente deseja deletar este animal?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, deletar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/deletaAnimais/${animal_id}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                success: function(response) {
                    Swal.fire(
                        'Deletado!',
                        'O animal foi deletado com sucesso.',
                        'success'
                    );
                    location.reload();
                },
                error: function() {
                    Swal.fire(
                        'Erro!',
                        'Houve um problema ao deletar o animal.',
                        'error'
                    );
                }
            });
        }
    });

});


