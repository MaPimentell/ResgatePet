import $ from 'jquery';
import 'select2';
import 'leaflet';
import Swal from 'sweetalert2';

    // Variáveis globais para armazenar latitude e longitude
   var latitude;
   var longitude;
   var map;

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
       map = L.map('map').setView([latitude, longitude], 16 ); // Coordenadas de São Paulo

       // Adicionando uma camada de mapa
       var googleStreets = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });

        googleStreets.addTo(map);

        //customização do marcador de posição atual do usuároio.
        var customMarker = L.divIcon({
            className: 'custom-marker', // Classe editada no app.css
            iconSize: [15, 15], // Tamanho do ícone
        });

       // Exemplo de como adicionar um marcador.
       var marker = L.marker([latitude, longitude], { icon: customMarker }).addTo(map).openPopup();



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

                exibirAlertas();

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

   var customMarkerAlert = L.icon({
        iconUrl: 'pinPata.png',
        iconSize: [52, 52],
        iconAnchor: [22, 38],
        popupAnchor: [-3, -38]
    });

    //Função para conseguir clicar no marcador
    function onClick(e) {
        var marker = e.target;
    }

   function exibirAlertas(){
        $.ajax({
            url: '/mapa',
            method: 'GET',
            success: function(response) {
                // Adicionar um marcador no mapa para cada alerta
                response.forEach(function(alerta) {
                    var marker = L.marker([alerta.latitude, alerta.longitude],{ icon: customMarkerAlert }).addTo(map);
                    marker.bindPopup(`
                        <div class="max-w-xs grid justify-stretch">
                            <div class="justify-center mb-2">
                                <h3 class="font-semibold text-center text-lg">${alerta.nome}</h3>
                            </div>
                            <div class="flex justify-center mb-2">
                                <img src="/storage/${alerta.foto}" alt="Foto do animal"
                                    class="object-cover w-24 h-24 rounded-full border-4 border-white drop-shadow-md ">
                            </div>
                            <div class="">
                                <dl class="grid grid-cols-2 my-3 pl-2 space-y-1 justify-between items-center">
                                    <dt class="font-bold self-start pt-1p">Animal:</dt>
                                    <dd class="self-start">${alerta.tipo}</dd>

                                    <dt class="font-bold">Sexo:</dt>
                                    <dd>${alerta.sexo === 'M' ? 'Macho' : alerta.sexo === 'F' ? 'Fêmea' : 'Outro'}</dd>

                                    <dt class="font-bold">Idade:</dt>
                                    <dd>${alerta.idade} Ano(s)</dd>

                                    <dt class="font-bold self-start">Raça:</dt>
                                    <dd>${alerta.raca}</dd>
                                </dl>
                            </div>
                            <div class="w-full">
                                <button class="rounded-lg w-full py-1 text-red font-medium text-white  bg-blue-600 border border-blue-600 hover:bg-transparent hover:text-blue-600"
                                onclick="window.location.href='/contato/${alerta.animal_id}'">
                                    Contatar
                                 </button>
                            </div>
                        </div>


                    `);
                    marker.on('click', onClick);

                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Erro exibir alertas:', textStatus, errorThrown);
            }
        });
   }



    $('#btnAdicionarAlerta').on('click', function(){

         // Fazer uma requisição AJAX para obter os dados dos animais
        $.ajax({
            url: '/alerta/getAnimais',
            method: 'GET',
            dataType: 'json',
            success: function(animais) {
                if (Array.isArray(animais)) {
                    Swal.fire({
                        title: 'Escolha um Animal',
                        html: `
                            <div class="grid justify-center">

                                <p class="text-sm w-[300px] text-center">
                                    Perdeu seu pet? Selecione qual deles e crie um alerta para que os usuários da região possam ajudar na busca.
                                </p>
                                <select id="customSelect" class="w-[300px] p-2 mt-5 text-sm rounded-md border">
                                    <option selected disabled>Escolha um animal...</option>
                                        ${animais.length === 0 ?
                                            '<option disabled>Sem animais disponíveis</option>' :
                                            animais.map(animal => `
                                                <option value="${animal.id}">${animal.nome}</option>
                                            `).join('')
                                        }
                                </select>
                            </div>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Confirmar',
                        cancelButtonText: 'Cancelar',
                        reverseButtons: true,
                        customClass: {
                            confirmButton: 'swal-confirmar',
                            cancelButton: 'swal-cancelar',
                            popup: 'swal-popup',
                            htmlContainer: 'swal-container'
                        },
                        preConfirm: () => {
                            const selectedOption = document.getElementById('customSelect').value;
                            return selectedOption;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {

                            const selectedAnimalId = result.value;
                            obterLocalizacao();


                            $.ajax({
                                url: '/alerta/storeAlerta',
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                                },
                                data: {
                                    animal_id: selectedAnimalId,
                                    latitude: latitude,
                                    longitude: longitude
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: 'Sucesso!',
                                        text: 'O alerta foi criado com sucesso!',
                                        icon: 'success',
                                        confirmButtonText: 'Ok',
                                        customClass: {
                                          confirmButton: 'swal-btn-sucesso',
                                          popup: 'swal-popup-sucesso'
                                        }
                                      }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Recarrega a página após clicar em OK
                                            window.location.reload();
                                        }
                                    });
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.error('Erro ao criar alerta:', textStatus, errorThrown);
                                    Swal.fire({
                                        title: 'Erro!',
                                        text: 'Não foi possível criar o alerta.',
                                        icon: 'error',
                                        confirmButtonText: 'Ok',
                                        customClass: {
                                          confirmButton: 'swal-btn-erro',
                                          popup: 'swal-popup-erro'
                                        }
                                      });
                                }
                            });
                        }
                    });
                } else {
                    console.error('Dados retornados não são um array:', animais);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Erro na requisição:', textStatus, errorThrown);
                Swal.fire({
                    title: 'Erro!',
                    text: 'Não foi possível carregar os animais.',
                    icon: 'error',
                    confirmButtonText: 'Ok',
                    customClass: {
                        confirmButton: 'swal-btn-erro',
                        popup: 'swal-popup-erro'
                    }
                });
            }
        });
    });
