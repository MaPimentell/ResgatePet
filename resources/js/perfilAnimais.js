// Importa o jQuery e o SweetAlert2
import $ from 'jquery';
import Swal from 'sweetalert2';
// import 'select2';
// import 'leaflet';



// Evento de clique no botão para deletar o animal
$('.btn-deletaAnimal').on('click', function() {
    var animal_id = $(this).data('id'); // Obtém o ID do animal

    // Exibe a caixa de confirmação antes de deletar
    Swal.fire({
        title: 'Tem certeza?',
        text: "Você realmente deseja deletar este animal?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, deletar!'
    }).then((result) => { 
        if (result.isConfirmed) {
            // Realiza a requisição AJAX para deletar o animal
            $.ajax({
                url: `/deletaAnimais/${animal_id}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(), // CSRF Token para segurança
                },
                success: function(response) {
                    Swal.fire('Deletado!', 'O animal foi deletado com sucesso.', 'success');
                    location.reload(); // Recarrega a página após deletar
                },
                error: function() {
                    Swal.fire('Erro!', 'Houve um problema ao deletar o animal.', 'error');
                }
            });
        }
    });
});
