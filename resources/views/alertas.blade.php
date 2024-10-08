<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alertas') }}
        </h2>
    </x-slot>

    <div class="py-7 md:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        <div class="flex gap-1 items-center">
                            <h2 class="flex font-semibold md:font-bold md:text-xl">
                                Seus alertas
                            </h2>
                        </div>
                        <div class="md:grid grid-cols-2 gap-4">
                        @foreach ($alertas as $alerta)
                            <div class="flex justify-between border-b-4 border-blue-600 mt-10 p-5 min-w-full rounded-lg" style="box-shadow: 0 5px 17px -5px rgba(0, 0, 0, 0.2);">
                                <h2 class="font-semibold text-lg">{{ $alerta->nome }}</h2>
                                <span class="text-gray-500 text-sm">Criado em: {{ \Carbon\Carbon::parse($alerta->created_at)->format('d/m/Y') }}</span>
                            </div>
                        @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@push('scripts')
    @vite('resources/js/alertas.js')
@endpush

</x-app-layout>
