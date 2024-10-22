<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seus alertas') }}
        </h2>
    </x-slot>

    <div class="py-7 md:py-12">
        <div class="max-w-7xl mx-auto px-3 lg:px-8">
            <div class="bg-white overflow-hidden border-t-4 border-blue-600 shadow-sm rounded-lg mb-10">
                <div class="p-6 text-gray-900">
                    <div class="flex gap-1 items-center">
                        <h2 class="flex font-semibold md:font-bold md:text-xl">
                            Alertas ativos
                        </h2>
                    </div>
                    <div class="md:grid grid-cols-2 gap-4">
                        @if($alertas_ativos->isEmpty())
                            <div class="my-5 ml-3">
                                <h2 class="text-lg font-medium text-gray-600">Não há alertas ativos.</h2>
                            </div>
                        @else
                            @foreach ($alertas as $alerta)
                                @if($alerta->exibir == 1)
                                    <div class="border-l-4 border-blue-600 mt-10 p-5 min-w-full rounded-lg" style="box-shadow: 0 5px 17px -5px rgba(0, 0, 0, 0.4);">
                                        <div class="flex justify-between">
                                            <h2 class="font-semibold text-lg">{{ $alerta->nome }}</h2>
                                            <div class="flex font-medium items-center gap-3">Status: ativo <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse shadow-lg"></div></div>
                                        </div>
                                        <span class="text-gray-500 text-sm">Criado {{ $alerta->created_at->DiffForHumans() }}</span>
                                        <div class="flex justify-between mt-5 space-x-4">
                                            <form action="{{ route('desativaAlerta', ['alerta_id' => $alerta->id]) }}" method="POST" class="w-1/3">
                                                @csrf
                                                @method('PUT')
                                                <button class="px-2 py-2 border-2 text-sm font-semibold border-blue-600 hover:bg-blue-600 hover:text-white text-blue-600 bg-transparent rounded-md w-full">
                                                    Desativar
                                                </button>
                                            </form>
                                            <a href="{{ route('contato', ['animal_id' => $alerta->animal_id]) }}" class="flex justify-center w-1/3 px-2 py-2 border-2 text-sm font-semibold border-blue-600 hover:bg-blue-600 hover:text-white text-blue-600 bg-transparent rounded-md">
                                                Página de Contato
                                            </a>
                                            <form action="{{ route('alertasUsuario.animalResgatado', ['alerta_id' => $alerta->id]) }}" method="POST" class="flex justify-center w-1/3">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="px-2 py-2 border-2 text-sm font-semibold border-blue-600 bg-blue-600 text-white hover:text-blue-600 hover:bg-transparent rounded-md">
                                                    Meu pet foi resgatado
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden border-t-4 border-blue-600 shadow-sm rounded-lg ">
                <div class="p-6 text-gray-900">
                    <div>
                        <div class="flex gap-1 items-center">
                            <h2 class="flex font-semibold md:font-bold md:text-xl">
                                Histórico de alertas
                            </h2>
                        </div>
                        <div class="md:grid grid-cols-2 gap-4">
                            @if($alertas_desativados->isEmpty())
                                <div class="my-5 ml-3">
                                    <h2 class="text-lg font-medium text-gray-600">Não há registros de alertas.</h2>
                                </div>
                            @else
                                @foreach ($alertas as $alerta)
                                    @if($alerta->exibir == 0)
                                        <div class="border-l-4 border-blue-600 mt-10 p-5 rounded-lg" style="box-shadow: 0 5px 17px -5px rgba(0, 0, 0, 0.4);">
                                            <div class="flex justify-between md:mb-0 mb-2">
                                                <h2 class="font-semibold text-lg">{{ $alerta->nome }}</h2>
                                                <div class="flex font-medium items-center gap-3">Status: Inativo <div class="w-3 h-3 bg-gray-400 rounded-full shadow-lg"></div></div>
                                            </div>
                                            <span class="text-gray-500 text-sm">Criado {{ $alerta->created_at->DiffForHumans() }}</span>
                                            <div class="flex justify-between pt-5">
                                                @if($alerta->resgatado == 0 && $alerta->exibir == 0)
                                                    <div>
                                                        <span class="font-medium md:text-lg">Alerta desativado</span>
                                                    </div>
                                                    <div class="flex justify-center">
                                                        <form action="{{ route('alertasUsuario.animalResgatado', ['alerta_id' => $alerta->id]) }}" method="POST" class="flex justify-center w-1/3">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="px-8 py-2 whitespace-nowrap border-2 text-sm font-semibold border-blue-600 bg-blue-600 text-white hover:text-blue-600 hover:bg-transparent rounded-md">
                                                                Meu pet foi resgatado
                                                            </button>
                                                        </form>
                                                    </div>
                                                @elseif ($alerta->resgatado == 1 && $alerta->exibir == 0)
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
{{-- @push('scripts')
    @vite('resources/js/alertas.js')
@endpush --}}
</x-app-layout>

@if(session('resgatado'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: '🐶',
            text: '{{ session('resgatado') }}',
            icon: 'success',
            confirmButtonText: 'Confirmar',
            customClass: {
                confirmButton: 'swal-btn-sucesso',
                popup: 'swal-popup-sucesso'
            }
        });
    </script>
@endif

@if(session('desativado'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            text: '{{ session('desativado') }}',
            icon: 'success',
            confirmButtonText: 'Ok',
            customClass: {
                confirmButton: 'swal-btn-sucesso',
                popup: 'swal-popup-sucesso'
            }
        });
    </script>
@endif
