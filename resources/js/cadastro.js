import $ from 'jquery';
import 'jquery-mask-plugin';

//Mascára para o número de celular
$('#telefone').mask('(00) 00000-0000');

$('#formRegister').on('submit', function() {
    var telefone = $('#telefone').val();
    var telefoneNumeros = telefone.replace(/\D/g, ''); 
    $('#telefone').val(telefoneNumeros); 
});

$('#abreModal').on('click', function(){
    const modalTermos = $('#modal-termos');
    modalTermos.addClass('flex').removeClass('hidden');
});

$('.fechaModal').on('click', function(){
    const modalTermos = $('#modal-termos');
    modalTermos.addClass('hidden').removeClass('flex');
});

$('#aceitaTermos').on('click', function(){
    const chechBoxTermos = $('#checkTermos')
    const modalTermos = $('#modal-termos');
    
    chechBoxTermos.prop('checked', true);
    modalTermos.addClass('hidden');
});
