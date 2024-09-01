<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex gap-2 items-center">
                        <h2 class="flex font-bold text-xl">
                            Sua localização
                        </h2>
                        <svg class="size-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier">
                                <path d="M12 6H12.01M9 20L3 17V4L5 5M9 20L15 17M9 20V14M15 17L21 20V7L19 6M15 17V14M15 6.2C15 7.96731 13.5 9.4 12 11C10.5 9.4 9 7.96731 9 6.2C9 4.43269 10.3431 3 12 3C13.6569 3 15 4.43269 15 6.2Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g>
                        </svg>
                    </div>
                    <div id="map" class="mt-5 rounded-md h-96 w-full"></div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
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
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 18,
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // Exemplo de como adicionar um marcador
                var marker = L.marker([latitude, longitude]).addTo(map)
                    .openPopup();


                $.ajax({
                    url: '{{ route('mapa.store') }}',
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

        });

    </script>
</x-app-layout>


