<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-3 lg:px-8">
            <div class="bg-white overflow-hidden border-t-4 border-blue-600 shadow-sm rounded-lg mb-10">
                <div class="p-6 text-gray-900">
                    <div class="flex gap-1 items-center md:justify-between">
                        <h2 class="flex font-medium md:font-bold text-xl text-gray-900">
                            Animais cadastrados
                        </h2>
                        <a href="{{ route('animais.cadastro')}}">Cadastrar novo animal</a>
                    </div>
                    <div class="md:grid grid-cols-2 gap-4 p-3">
                        @if($animais->isEmpty()) 
                            <div class="my-5 ml-3">
                                <h2 class="text-lg font-medium text-gray-600">Não há animais cadastrados.</h2>
                            </div>
                         @else
                            @foreach ($animais as $animal)
                                <div class="flex md:flex-row md:border-l-4 md:p-0   mt-10 flex-col-reverse  rounded-lg border-blue-600" style="box-shadow: 0 5px 17px -5px rgba(0, 0, 0, 0.4);">
                                    <div class="p-5 md:w-2/3" >                                  
                                        <div class="">
                                            <h2 class="font-medium md:mb-2 text-xl mb-3">{{ $animal->nome }}</h2>
                                        </div>
                                        <div class="md:text-gray-500 font-medium md:mb-0 mb-1">{{ $animal->tipo }}  {{ $animal->sexo === 'F' ? 'Fêmea' : ($animal->sexo === 'M' ? 'Macho' : 'Desconhecido') }} | {{ $animal->idade }} ano(s) </div>
                                        <div class="text-gray-500 md:mb-0 mb-5">Raça:&nbsp;{{ $animal->raca }}</div>
                                        <div class="text-gray-500 md:mb-0 mb-6"></div>
                                        <div class="flex md:justify-normal justify-between space-x-4 mt-5">
                                            <div class="md:flex md:gap-0 mb-2 md:mb-0  md:space-x-4">
                                                <button data-id="{{ $animal->id }}" class="btn-deletaAnimal md:text-sm text-xs  px-6 py-2 border-2 font-semibold border-red-600 hover:bg-red-600 hover:text-white text-red-600 bg-transparent rounded-md">
                                                    Excluir
                                                </button>
                                            </div>
                                            <div class="">
                                                <a href="" class="flex justify-center   px-6 py-2 border-2 md:text-sm text-xs font-semibold border-blue-600 hover:bg-blue-600 hover:text-white text-blue-600 bg-transparent rounded-md ">
                                                    Editar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md:w-1/3  w-full">
                                        <img id="foto" src="{{ asset('storage/' . $animal->foto) }}" alt="Foto do animal"
                                         class=" md:rounded-r-lg md:rounded-tl-none rounded-t-lg object-cover w-full h-full ">
                                    </div>
                                </div>
                            @endforeach 
                        @endif 
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
    @vite('resources/js/perfilAnimais.js')
@endpush
</x-app-layout>