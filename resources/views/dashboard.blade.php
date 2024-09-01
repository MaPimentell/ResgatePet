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
                    <div>
                        <h2 class="font-semibold text-xl">Sua localização</h2>
                    </div>
                    <div id="map" class="mt-5 h-96 w-full"></div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
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
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // Exemplo de como adicionar um marcador
                var marker = L.marker([latitude, longitude]).addTo(map)
                    .bindPopup('São Paulo')
                    .openPopup();

                // Adicionando mais marcadores usando jQuery
                var locations = [
                    {lat: latitude, lng: longitude, name: 'Rio de Janeiro'},
                    {lat: latitude, lng: longitude, name: 'Santos'}
                ];


                $.each(locations, function(index, location) {
                    L.marker([location.lat, location.lng]).addTo(map)
                        .bindPopup(location.name);
                });


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


