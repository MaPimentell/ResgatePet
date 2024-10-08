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
                        <div class="border-l-4 border-blue-600 mt-10 p-10 min-w-full shadow-xl shadow-slate-200 rounded-lg" style="box-shadow: 0 5px 20px -5px rgba(0, 0, 0, 0.2);">
                            teste
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
