<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contato') }}
        </h2>
    </x-slot>

    <div class="py-7 md:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ url()->previous() }}"
            class="items-center flex gap-1 mb-4">
                <svg class="size-4" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#000000" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"></path><path fill="#000000" d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"></path></g></svg>
                Voltar
            </a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between ">
                        <div class=" gap-1 items-center">
                            <h2 class="flex font-semibold md:font-bold  md:text-xl">
                                Entrar em contato
                            </h2>
                            <div>
                                <dl class="grid grid-cols-2 space-x-2">

                                    <dt>Animal: </dt>
                                    <dd>{{ $animal->tipo }}</dd>

                                    <dt>Nome:</dt>
                                    <dd>{{ $animal->nome }}</dd>

                                    <dt>Sexo: </dt>
                                    <dd>{{ $animal->sexo }}</dd>

                                    <dt>Idade: </dt>
                                    <dd>{{ $animal->idade }}</dd>

                                    <dt>Raça: </dt>
                                    <dd>{{ $animal->raca }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@push('scripts')
    @vite('resources/js/contato.js')
@endpush

</x-app-layout>


