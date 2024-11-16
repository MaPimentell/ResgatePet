import $ from 'jquery';

$('#btn-resetaSenha').on('click', function(){
    const btnResetaSenha = $(this);

    btnResetaSenha.html(`
        <div class="transition ease-in-out duration-800 spinner-border animate-spin inline-block w-4 h-4 border-2 border-t-2 border-transparent border-t-white group-hover:border-t-red-600 rounded-full mr-2"></div>
        ENVIAR LINK PARA REDEFINIR SENHA POR E-MAIL
    `);
});
