<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contato') }}
        </h2>
    </x-slot>

    <div class="py-7 md:py-12">
        <div class="md:max-w-6xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ url()->previous() }}"
            class="items-center flex gap-1 mb-4 mx-4 md:mx-0 md:text-normal text-sm">
                <svg class="size-4" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#000000" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"></path><path fill="#000000" d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"></path></g></svg>
                Voltar
            </a>
            <div class="bg-white m-4 overflow-hidden shadow-sm rounded-lg border-t-4 border-green-600">
                <div class="p-6 text-gray-900 ">
                    <div class="justify-between ">
                        <h2 class="flex font-bold text-xl mb-10 justify-center md:font-bold md:text-2xl md:justify-normal">
                            Entrar em contato
                        </h2>
                        <div class="md:flex">
                            <div  class="md:hidden flex justify-center mb-4">
                                <img id="imagemAnimalMobile" src="{{ asset('storage/animal_photo_01_03.jpg') }}" alt="Foto do animal"
                                    class="object-cover w-40 h-40 rounded-full border-8 border-white drop-shadow-md ">
                            </div>
                            <div class="md:w-1/3 md:mb-0 mb-8">
                                <p class="text-center font-medium text-xl mb-5">{{ $infoContato->nome }}</p>
                                <dl class="grid grid-cols-2 md:px-9 px-5">

                                    <dt class="font-medium md:text-lg md:justify-self-auto">Animal: </dt>
                                    <dd class="md:text-lg justify-self-end">{{ $infoContato->tipo }}</dd>

                                    <dt class="font-medium md:text-lg md:justify-self-auto">Sexo: </dt>
                                    <dd class="md:text-lg justify-self-end">@if ($infoContato->sexo === 'M') Macho @elseif ($infoContato->sexo === 'F') Fêmea @else Outro @endif</dd>

                                    <dt class="font-medium md:text-lg md:justify-self-auto">Idade: </dt>
                                    <dd class="md:text-lg justify-self-end">{{ $infoContato->idade }} ano(s)</dd>

                                    <dt class="font-medium md:text-lg md:justify-self-auto">Raça: </dt>
                                    <dd class="md:text-lg justify-self-end">{{ $infoContato->raca }}</dd>

                                </dl>
                            </div>
                            <div class="w-0.5 bg-gray-300 mx-6"></div>
                            <div class="md:w-1/3">
                                <p class="text-center font-medium text-xl mb-5">Informações de contato</p>
                                <dl class="grid grid-cols-2 mb-5 justify-center md:px-6 px-5">
                                    <dt class="font-medium  md:text-lg ">Resposável: </dt>
                                    <dd class="md:text-lg justify-self-end"> {{ implode(' ', array_slice(explode(' ', $infoContato->name), 0, 2)) }} </dd>
                                    <dt class="font-medium md:text-lg ">Telefone:</dt>
                                    <dd id="celular" class="md:text-lg justify-self-end">{{ $infoContato->telefone }}</dd>
                                </dl>
                                <a  target="_blank" href="https://api.whatsapp.com/send?phone={{ urlencode($infoContato->telefone) }}"
                                    class="flex justify-center  gap-3 mx-4 text-white bg-[#25d366] hover:bg-[#2ab45c] px-2 py-2 font-semibold rounded-md items-center md:w-full">
                                    <span>Chamar no WhatsApp</span>

                                    <svg class="size-5" fill="#ffff" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#ffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>whatsapp</title> <path d="M26.576 5.363c-2.69-2.69-6.406-4.354-10.511-4.354-8.209 0-14.865 6.655-14.865 14.865 0 2.732 0.737 5.291 2.022 7.491l-0.038-0.070-2.109 7.702 7.879-2.067c2.051 1.139 4.498 1.809 7.102 1.809h0.006c8.209-0.003 14.862-6.659 14.862-14.868 0-4.103-1.662-7.817-4.349-10.507l0 0zM16.062 28.228h-0.005c-0 0-0.001 0-0.001 0-2.319 0-4.489-0.64-6.342-1.753l0.056 0.031-0.451-0.267-4.675 1.227 1.247-4.559-0.294-0.467c-1.185-1.862-1.889-4.131-1.889-6.565 0-6.822 5.531-12.353 12.353-12.353s12.353 5.531 12.353 12.353c0 6.822-5.53 12.353-12.353 12.353h-0zM22.838 18.977c-0.371-0.186-2.197-1.083-2.537-1.208-0.341-0.124-0.589-0.185-0.837 0.187-0.246 0.371-0.958 1.207-1.175 1.455-0.216 0.249-0.434 0.279-0.805 0.094-1.15-0.466-2.138-1.087-2.997-1.852l0.010 0.009c-0.799-0.74-1.484-1.587-2.037-2.521l-0.028-0.052c-0.216-0.371-0.023-0.572 0.162-0.757 0.167-0.166 0.372-0.434 0.557-0.65 0.146-0.179 0.271-0.384 0.366-0.604l0.006-0.017c0.043-0.087 0.068-0.188 0.068-0.296 0-0.131-0.037-0.253-0.101-0.357l0.002 0.003c-0.094-0.186-0.836-2.014-1.145-2.758-0.302-0.724-0.609-0.625-0.836-0.637-0.216-0.010-0.464-0.012-0.712-0.012-0.395 0.010-0.746 0.188-0.988 0.463l-0.001 0.002c-0.802 0.761-1.3 1.834-1.3 3.023 0 0.026 0 0.053 0.001 0.079l-0-0.004c0.131 1.467 0.681 2.784 1.527 3.857l-0.012-0.015c1.604 2.379 3.742 4.282 6.251 5.564l0.094 0.043c0.548 0.248 1.25 0.513 1.968 0.74l0.149 0.041c0.442 0.14 0.951 0.221 1.479 0.221 0.303 0 0.601-0.027 0.889-0.078l-0.031 0.004c1.069-0.223 1.956-0.868 2.497-1.749l0.009-0.017c0.165-0.366 0.261-0.793 0.261-1.242 0-0.185-0.016-0.366-0.047-0.542l0.003 0.019c-0.092-0.155-0.34-0.247-0.712-0.434z"></path> </g></svg>
                                </a>
                            </div>
                            <div class=" hidden md:flex md:w-1/3 justify-center mb-2">
                                <div class="relative group w-48 h-56 rounded overflow-hidden">
                                    <img id="foto" src="{{ asset('storage/animal_photo_01_03.jpg') }}" alt="Foto do animal"
                                         class="object-cover w-full h-full transition-opacity duration-300 ease-in-out">

                                    <div id="imagemAnimal" class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex justify-center items-center transition-opacity duration-300 ease-in-out">
                                        <svg class="size-10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="Interface / Magnifying_Glass_Plus"> <path id="Vector" d="M7 10H10M10 10H13M10 10V7M10 10V13M15 15L21 21M10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10C17 13.866 13.866 17 10 17Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g> </g></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="animalModal" class="fixed inset-0 bg-black bg-opacity-75 items-center justify-center hidden z-50">
        <span class="absolute top-4 right-4 text-white text-3xl cursor-pointer"id="fecharModal">&times;</span>
        <img id="fotoAnimal" class="max-w-[80vw] max-h-[80vh] w-auto h-auto rounded">
    </div>

@push('scripts')
    @vite('resources/js/contato.js')
@endpush

</x-app-layout>


