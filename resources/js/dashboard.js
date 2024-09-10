import $ from 'jquery';
import 'select2';
import 'leaflet';
import Swal from 'sweetalert2';

    // Variáveis globais para armazenar latitude e longitude
   var latitude;
   var longitude;

   //Obtém a localização do usuário logado
   function obterLocalizacao() {
       if (navigator.geolocation) {
           navigator.geolocation.getCurrentPosition(enviarLocalizacao, exibirErro);
       } else {
           console.error("Geolocalização não é suportada pelo navegador.");
       }
   }

   //Exibe o mapa de acordo com a localização do usuário
   function enviarLocalizacao(position){

       latitude = position.coords.latitude;
       longitude = position.coords.longitude;


       // Inicializando o mapa com jQuery
       var map = L.map('map').setView([latitude, longitude], 16    ); // Coordenadas de São Paulo

       // Adicionando uma camada de mapa
       var googleStreets = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });

        // Add the Google Streets layer to the map
        googleStreets.addTo(map);

       // Exemplo de como adicionar um marcador
       var marker = L.marker([latitude, longitude]).addTo(map)
           .openPopup();

       // Ajax para resgatar as informações de longitude e latitude do usuário.
       $.ajax({
           url: '/mapa',
           type: 'POST',
           headers: {
               'X-CSRF-TOKEN': $('input[name="_token"]').val()
           },
           data: {
               latitude: latitude,
               longitude: longitude
           },
           dataType: 'json',
           success: function(response) {
               console.log(longitude);
               console.log(latitude);
           },
           error: function(xhr, status, error) {
               console.error(error);
           }
       });
   }

   // Validação
   function exibirErro(error) {
       switch(error.code) {
           case error.PERMISSION_DENIED:
               console.error("Usuário negou a solicitação de Geolocalização.");
               alert("Você negou a permissão para acessar sua localização. Para usar esta funcionalidade, recarregue a página e permita o acesso à localização nas configurações do seu navegador.");
               break;
           case error.POSITION_UNAVAILABLE:
               console.error("Informação de localização indisponível.");
               alert("Não foi possível obter a informação de localização. Verifique se o seu dispositivo está conectado e tente novamente.");
               break;
           case error.TIMEOUT:
               console.error("O pedido de localização expirou.");
               alert("O pedido para obter sua localização expirou. Tente recarregara a página.");
               break;
           case error.UNKNOWN_ERROR:
               console.error("Ocorreu um erro desconhecido.");
               alert("Ocorreu um erro desconhecido ao tentar obter sua localização. Tente recarregara a página.");
               break;
       }
   }

   obterLocalizacao();

   $('#btnAdicionarAlerta').click(function(){
       Swal.fire({
           title: 'Seu pet sumiu?',
           html: `
               <div class='flex flex-col items-center'>
                   <p class='text-center text-sm md:w-[300px]'>
                       Crie um alerta no mapa e os usuários próximos irão ser notificados para entrar em contato.
                   </p>
                   <select id='myDropdown' class='swal-dropdown mt-5'>
                       <option value='opcao1'>Opção 1</option>
                       <option value='opcao2'>Opção 2</option>
                       <option value='opcao3'>Opção 3</option>
                   </select>
               </div>

           `,
           showCancelButton: true,
           confirmButtonText: 'Confirmar',
           cancelButtonText: 'Cancelar',
           reverseButtons: true,
           customClass: {
               confirmButton: 'swal-confirmar',
               cancelButton: 'swal-cancelar'
           },
           preConfirm: () => {
               const selectedOption = document.getElementById('myDropdown').value;
               return selectedOption;
           }
       }).then((result) => {
           if (result.isConfirmed) {
               const selectedOption = result.value;
               console.log(`Opção selecionada: ${selectedOption}`);
               // Adicione aqui o código para lidar com a opção selecionada
           }
       });
   });
