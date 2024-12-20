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
        iconUrl: 'pinPata_2.png',
        iconSize: [52, 52],
        iconAnchor: [22, 38],
        popupAnchor: [-3, -38]
    });

    //Função para conseguir clicar no marcador
    function onClick(e) {
        var marker = e.target;
    }

    // Exibe os alertas no mapa com base nos dados recebidos via AJAX
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
                                <h3 class="font-semibold text-center md:text-lg">${alerta.nome}</h3>
                            </div>
                            <div class="flex justify-center mb-2">
                                <img src="${alerta.foto ? '/storage/' + alerta.foto : '/images/default_pet.png'}" alt="Foto do animal"
                                    class="object-cover md:w-24 md:h-24 w-20 h-20 rounded-full border-4 border-white drop-shadow-md ">
                            </div>
                            <div class="">
                                <dl class="grid grid-cols-2 my-3 pl-2 space-y-1 justify-between items-center">
                                    <dt class="md:font-bold font-semibold self-start pt-1p">Animal:</dt>
                                    <dd class="self-start">${alerta.tipo}</dd>

                                    <dt class="md:font-bold font-semibold">Sexo:</dt>
                                    <dd>${alerta.sexo === 'M' ? 'Macho' : alerta.sexo === 'F' ? 'Fêmea' : 'Outro'}</dd>

                                    <dt class="md:font-bold font-semibold">Idade:</dt>
                                    <dd>${alerta.idade} Ano(s)</dd>

                                    <dt class="md:font-bold font-semibold self-start">Raça:</dt>
                                    <dd>${alerta.raca}</dd>

                                    <dt class="md:font-bold font-semibold self-start">Perdido:</dt>
                                    <dd>${new Date(alerta.data_perdido).toLocaleDateString('pt-BR')}</dd>

                                </dl>
                            </div>
                            <div class="w-full">
                                <button class="rounded-lg w-full py-1 text-red font-medium text-white  bg-green-600 border border-green-600 hover:bg-transparent hover:text-green-600"
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


    // Função para adicionar um alerta através de um modal
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

                                <div>
                                    <p class="text-sm w-[300px] text-center">
                                        Perdeu seu pet? Selecione qual deles, a data que foi perdido e crie um alerta para que os usuários da região possam ajudar na busca.
                                    </p>
                                </div>
                                <div class="mb-1">
                                    <select id="customSelect" class="w-[300px] p-2 mt-5 text-sm rounded-md border">
                                        <option selected disabled>Escolha um animal...</option>
                                            ${animais.length === 0 ?
                                                '<option disabled>Sem animais cadastrados</option>' :
                                                animais.map(animal => `
                                                    <option value="${animal.id}">${animal.nome}</option>
                                                `).join('')
                                            }
                                    </select>
                                </div>
                                <div>
                                    <input type="date" id="data_perdido" name="data_perdido" class="w-[300px] p-2 mt-5 text-sm rounded-md border">
                                </div>
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
                            const data_perdido = document.getElementById('data_perdido').value;
                            if (!selectedOption || selectedOption === "Escolha um animal...") {
                                Swal.showValidationMessage('Por favor, selecione um animal cadastrado.');
                                return null; 
                            }

                            if (!data_perdido || data_perdido === null) {
                                Swal.showValidationMessage('Por favor, selecione a data que o animal foi perdido.');
                                return null; 
                            }

                            // Validar se a data não é no futuro e não é muito no passado
                            const hoje = new Date();
                            const dataSelecionada = new Date(data_perdido);

                            // Verificar se a data selecionada é maior que a data de hoje
                            if (dataSelecionada > hoje) {
                                Swal.showValidationMessage('A data não pode ser no futuro.');
                                return null; 
                            }

                            // Verificar se a data selecionada não é muito no passado (por exemplo, mais de 10 anos atrás)
                            const umAnoAtras = new Date();
                            umAnoAtras.setFullYear(hoje.getFullYear() - 1);

                            if (dataSelecionada < umAnoAtras) {
                                Swal.showValidationMessage('A data não pode ser mais de 1 ano atrás.');
                                return null; 
                            }

                            const btnConfirmar = $(Swal.getConfirmButton());
                            btnConfirmar.html('<div class="transition ease-in-out duration-800 spinner-border animate-spin inline-block w-4 h-4 border-2 border-t-2 border-transparent border-t-white rounded-full"></div>');

                             // Retorna uma Promise que será resolvida ou rejeitada com o resultado do AJAX
                            return new Promise((resolve, reject) => {
                                obterLocalizacao();

                                $.ajax({
                                    url: '/alerta/storeAlerta',
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                                    },
                                    data: {
                                        animal_id: selectedOption,
                                        latitude: latitude,
                                        longitude: longitude,
                                        data_perdido: data_perdido,
                                    },
                                    success: function(response) {
                                        // Resolve a Promise para fechar o modal
                                        resolve(response);
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        // Rejeita a Promise para exibir uma mensagem de erro no modal
                                        Swal.fire({
                                            title: 'Erro!',
                                            text: 'Erro ao adicionar o alerta, tente novamente ou entre em contato conosco!',
                                            icon: 'error',
                                            confirmButtonText: 'Ok',
                                            customClass: {
                                                confirmButton: 'swal-btn-erro',
                                                popup: 'swal-popup-erro'
                                            }
                                        });
                                        reject(new Error('Erro no AJAX'));
                                    }
                                });
                            });
                            
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {

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
                        }
                    });
                } else {
                    console.error('Dados retornados não são um array:', animais);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
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
