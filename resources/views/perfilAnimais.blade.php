<x-app-layout>
    <!-- Define um slot para o cabeçalho da página -->
    <x-slot name="header">
        <!-- Cabeçalho principal com o título "Perfil" -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-3 lg:px-8">
            <!-- Caixa de conteúdo com estilo de borda e sombra -->
            <div class="bg-white overflow-hidden border-t-2 border-red-600 shadow-sm rounded-lg mb-10">
                <div class="p-6 text-gray-900">
                    <div class="md:flex gap-1 items-center md:justify-between">
                        <!-- Título da seção "Animais cadastrados" -->
                        <div>
                            <h2 class="md:mb-0 mb-4 font-medium md:font-bold text-xl text-gray-900">
                                Animais cadastrados
                            </h2>
                            <span class="text-sm text-gray-600">Para adicionar alertas no mapa, primeiro é necessário cadastrar um animal. Clique em <i>Cadastrar Novo Animal</i> caso ainda não tenha feito.</span>
                        </div>
                        
                        <div class="md:p-0 md:mt-0 p-3 mt-7">
                            <!-- Link para a rota de cadastro de animais -->
                            <a href="{{ route('animais.cadastro', 0)}}" class="w-full">
                                <!-- Botão para cadastrar um novo animal -->
                                <button class="w-full px-3 py-2 rounded-md border border-red-600 bg-red-600 hover:bg-transparent hover:text-red-600 text-white font-medium space-x-1 transition ease-in-out duration-300">
                                    <span>Cadastrar novo animal</span> <span class="font-semibold text-xl">+</span>
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- Grid para exibir a lista de animais -->
                    <div class="md:grid grid-cols-2 gap-4 p-3">
                        <!-- Condição para exibir mensagem se não houver animais cadastrados -->
                        @if($animais->isEmpty())
                            <div class="my-5 ml-3">
                                <h2 class="text-lg font-medium text-gray-600">Não há animais cadastrados.</h2>
                            </div>
                         @else
                            <!-- Loop para cada animal cadastrado -->
                            @foreach ($animais as $animal)
                                <div class="flex md:flex-row md:border-l-4 md:p-0 md:mb-4 mb-6 mt-2 flex-col-reverse rounded-lg border-gray-500" style="box-shadow: 0 5px 17px -5px rgba(0, 0, 0, 0.4);">
                                    <!-- Div com as informações do animal -->
                                    <div class="p-5 md:w-2/3">
                                        <div>
                                            <!-- Nome do animal -->
                                            <h2 class="font-medium md:mb-2 text-xl mb-3">{{ $animal->nome }}</h2>
                                        </div>
                                        <!-- Tipo, sexo e idade do animal -->
                                        <div class="md:text-gray-500 font-medium md:mb-0 mb-1">{{ $animal->tipo }}  {{ $animal->sexo === 'F' ? 'Fêmea' : ($animal->sexo === 'M' ? 'Macho' : '') }} | {{ $animal->idade }} ano(s)</div>
                                        <!-- Raça do animal -->
                                        <div class="text-gray-500 md:mb-0 mb-5">Raça:&nbsp;{{ $animal->raca }}</div>
                                        <div class="flex md:justify-normal justify-between space-x-4 mt-5">
                                            <!-- Botão para excluir o animal -->
                                            <div class="md:flex md:gap-0 mb-2 md:mb-0 md:space-x-4">
                                                <button data-id="{{ $animal->id }}" class="btn-deletaAnimal md:text-sm text-xs px-6 py-2 border font-semibold border-red-500 hover:bg-red-500 hover:text-white text-red-500 bg-transparent rounded-md transition ease-in-out duration-300">
                                                    Excluir
                                                </button>
                                            </div>
                                            <!-- Link para editar o animal -->
                                            <div>
                                                <a href="{{ route('animais.cadastro', $animal->id) }}" class="flex justify-center px-6 py-2 border md:text-sm text-xs font-semibold border-blue-600 hover:bg-blue-600 hover:text-white text-blue-600 bg-transparent rounded-md transition ease-in-out duration-300">
                                                    Editar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Imagem do animal -->
                                    <div class="md:w-1/3 w-full">
                                        <img id="foto" src="{{ asset('storage/' . $animal->foto) }}" alt="Foto do animal"
                                         class="md:rounded-r-lg md:rounded-tl-none rounded-t-lg object-cover w-full h-full">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Adiciona um script específico para a página -->
    @push('scripts')
        @vite('resources/js/perfilAnimais.js')
    @endpush
    @if(session('animalEditado'))
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script>
            Toastify({
                text: "Animal Editado com sucesso!",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "bottom", // `top` or `bottom`
                positionLeft: false, // `true` or `false`
                backgroundColor: "#0d4fd4",
            }).showToast();
        </script>
    @endif
    @if(session('animalCadastrado'))
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script>
            Toastify({
                text: "Animal cadastrado com sucesso!",
                duration: 3000,
                newWindow: true,
                gravity: "bottom", // `top` or `bottom`
                positionLeft: false, // `true` or `false`
                backgroundColor: "#0d4fd4",
            }).showToast();
        </script>
    @endif
</x-app-layout>


