<x-app-layout>
    <!-- Cabeçalho da página com o título "Alertas" -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alertas') }}
        </h2>
    </x-slot>

    <!-- Conteúdo principal da página -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-3 lg:px-8">
            <!-- Seção de status ativos de alertas -->
            <div class="bg-white overflow-hidden border-t-2 border-green-600 shadow-sm rounded-lg mb-10">
                <div class="p-6 text-gray-900">
                    <!-- Título para a seção de status ativos -->
                    <div>
                        <div class="flex gap-1 items-center">
                            <h2 class="flex font-medium md:font-bold md:text-xl text-gray-900">
                                Status ativos
                            </h2>
                        </div>
                        <span class="text-sm text-gray-600">Os alertas abaixo estão ativos no mapa e podem ser visualizados por outros usuários. Lembre-se de que os alertas serão <b>desativados automaticamente após 3 dias</b>.</span>
                    </div>
                    <!-- Layout em grade para exibir os alertas ativos -->
                    <div class="md:grid grid-cols-2 gap-4">
                        <!-- Verifica se há alertas ativos -->
                        @if($alertas_ativos->isEmpty())
                            <!-- Mensagem exibida quando não há alertas ativos -->
                            <div class="my-5 ml-3">
                                <h2 class="text-lg font-medium text-gray-600">Não há alertas ativos.</h2>
                            </div>
                        @else
                            <!-- Loop para cada alerta -->
                            @foreach ($alertas as $alerta)
                                <!-- Exibe apenas alertas ativos (onde 'exibir' é 1) -->
                                @if($alerta->exibir == 1)
                                    <!-- Card para cada alerta ativo -->
                                    <div class="border-l-4 border-green-600 mt-10 p-5 min-w-full rounded-lg" style="box-shadow: 0 5px 17px -5px rgba(0, 0, 0, 0.4);">
                                        <!-- Título do alerta e ícone de status ativo -->
                                        <div class="flex justify-between">
                                            <h2 class="font-semibold text-lg">{{ $alerta->nome }}</h2>
                                            <div class="flex font-medium items-center gap-3">Ativo 
                                                <span class="relative flex h-3 w-3">
                                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Exibe a data de criação do alerta -->
                                        <div>
                                            <span class="text-gray-500 text-sm">Criado {{ $alerta->created_at->DiffForHumans() }}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500 text-sm">{{ \Str::limit($alerta->endereco, 80) }}</span>
                                        </div>
                                        <!-- Botões de ações para cada alerta ativo -->
                                        <div class="md:flex md:justify-between md:flex-row md:space-x-4 flex-col mt-5">
                                            <!-- Formulário para desativar o alerta -->
                                            <div class="md:flex md:gap-0 mb-2 md:mb-0 md:w-full md:space-x-4 grid grid-cols-2 gap-2">
                                                <form action="{{ route('desativaAlerta', ['alerta_id' => $alerta->id]) }}" method="POST" class="w-full">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="md:text-sm text-xs w-full px-2 py-2 border font-semibold border-red-500 hover:bg-red-500 hover:text-white text-red-500 bg-transparent rounded-2xl transition ease-in-out duration-300">
                                                        Desativar
                                                    </button>
                                                </form>
                                                <!-- Link para a página de contato -->
                                                <a href="{{ route('contato', ['animal_id' => $alerta->animal_id]) }}" class="flex justify-center w-full px-2 py-2 border md:text-sm text-xs font-semibold border-green-600 hover:bg-green-600 hover:text-white text-green-600 bg-transparent rounded-2xl transition ease-in-out duration-300">
                                                    Página de Contato
                                                </a>
                                            </div>
                                            <!-- Botão para marcar o animal como resgatado -->
                                            <div class="md:w-1/3">
                                                <form action="{{ route('alertasUsuario.animalResgatado', ['alerta_id' => $alerta->id]) }}" method="POST" class="md:justify-center flex justify-start w-full">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="md:whitespace-nowrap md:text-sm w-full px-2 py-2 border text-xs font-semibold border-green-600 bg-green-600 text-white hover:text-green-600 hover:bg-transparent rounded-2xl transition ease-in-out duration-300">
                                                        Meu pet foi resgatado
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Seção de histórico de alertas desativados -->
            <div class="bg-white overflow-hidden border-t-2 border-red-600 shadow-sm rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <!-- Título para a seção de histórico de alertas -->
                        <div>
                            <div class="flex gap-1 items-center">
                                <h2 class="flex font-semibold md:font-bold md:text-xl">
                                    Histórico de alertas
                                </h2>
                            </div>
                            <span class="text-sm text-gray-600">Outros usuários não conseguirão visualizar os alertas abaixo. Se você conseguiu resgatar seu animal, clique no botão <i>Meu pet foi resgatado</i>. Ficaríamos contentes em saber que conseguimos ajudar!</span>
                        </div>
                        <!-- Layout em grade para exibir alertas desativados -->
                        <div class="md:grid grid-cols-2 gap-4">
                            <!-- Verifica se há alertas desativados -->
                            @if($alertas_desativados->isEmpty())
                                <!-- Mensagem exibida quando não há alertas desativados -->
                                <div class="my-5 ml-3">
                                    <h2 class="text-lg font-medium text-gray-600">Não há registros de alertas.</h2>
                                </div>
                            @else
                                <!-- Loop para cada alerta desativado -->
                                @foreach ($alertas as $alerta)
                                    <!-- Exibe apenas alertas desativados (onde 'exibir' é 0) -->
                                    @if($alerta->exibir == 0)
                                        <!-- Card para cada alerta desativado -->
                                        <div class="border-l-4 border-gray-500 mt-10 p-5 rounded-lg" style="box-shadow: 0 5px 17px -5px rgba(0, 0, 0, 0.4);">
                                            <div class="flex justify-between md:mb-0 mb-2">
                                                <h2 class="font-semibold text-lg">{{ $alerta->nome }}</h2>
                                                <div class="flex font-medium items-center gap-3">Inativo <div class="w-3 h-3 bg-gray-400 rounded-full shadow-lg"></div></div>
                                            </div>
                                            <div>
                                                <span class="text-gray-500 text-sm">Criado {{ $alerta->created_at->DiffForHumans() }}</span>
                                            </div>
                                            <div>
                                                <span class="text-gray-500 text-sm">{{ \Str::limit($alerta->endereco, 80) }}</span>
                                            </div>
                                            <!-- Ações para alertas desativados -->
                                            <div class="md:flex justify-between items-center pt-5">
                                                @if($alerta->resgatado == 0 && $alerta->exibir == 0)
                                                    <!-- Status de alerta desativado -->
                                                    <div class="md:w-full md:mb-0 mb-2">
                                                        <span class="md:text-lg md:font-medium">Alerta desativado</span>
                                                    </div>
                                                    <!-- Botão para marcar como "Meu pet foi resgatado" -->
                                                    <div class="md:flex justify-center w-full">
                                                        <form action="{{ route('alertasUsuario.animalResgatado', ['alerta_id' => $alerta->id]) }}" method="POST" class="md:flex justify-center w-full">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="md:text-sm text-xs w-full px-8 py-2 whitespace-nowrap border font-semibold border-green-600 hover:bg-green-600 hover:text-white text-green-600 bg-transparent rounded-2xl transition ease-in-out duration-300">
                                                                Meu pet foi resgatado
                                                            </button>
                                                        </form>
                                                    </div>
                                                @elseif ($alerta->resgatado == 1 && $alerta->exibir == 0)
                                                    <!-- Indicação de que o animal foi resgatado -->
                                                    <div class="mt-5">
                                                        <span class="font-medium md:text-lg">Animal Resgatado!</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para exibir notificação de sucesso após o resgate do animal -->
    @if(session('resgatado'))
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script>
        Toastify({
            text: "Animal Resgatado!",
            duration: 3000,
            newWindow: true,
            gravity: "bottom", // `top` or `bottom`
            positionLeft: false, // `true` or `false`
            backgroundColor: "#0d4fd4",
        }).showToast();
    </script>
    @endif

    @if(session('desativado'))
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
    Toastify({
        text: "Alerta desativado!",
        duration: 3000,
        newWindow: true,
        gravity: "bottom", // `top` or `bottom`
        positionLeft: false, // `true` or `false`
        backgroundColor: "#EF4444",
    }).showToast();
    </script>
    @endif
</x-app-layout>

