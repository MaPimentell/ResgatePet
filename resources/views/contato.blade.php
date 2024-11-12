<x-app-layout>
    <!-- Header com título da página -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contato') }}
        </h2>
    </x-slot>

    <!-- Conteúdo principal com padding ajustado para telas pequenas e grandes -->
    <div class="py-7 md:py-12">
        <div class="md:max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Link para voltar à página anterior -->
            <a href="{{ url()->previous() }}"
               class="items-center flex gap-1 mb-4 mx-4 md:mx-0 md:text-normal text-sm hover:text-gray-400">
                <!-- Ícone de seta para indicar retorno -->
                <svg class="size-4" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                    <!-- Caminhos do ícone -->
                    <path fill="#000000" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"></path>
                    <path fill="#000000" d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"></path>
                </svg>
                Voltar
            </a>
            <!-- Card principal contendo informações de contato -->
            <div class="bg-white m-4 overflow-hidden shadow-sm rounded-lg border-t-4 border-green-600">
                <div class="p-6 text-gray-900">
                    <div class="justify-between">
                        <!-- Título centralizado com responsividade para telas menores -->
                        <h2 class="flex font-bold text-xl mb-10 justify-center md:font-bold md:text-2xl md:justify-normal">
                            Entrar em contato
                        </h2>
                        <div class="md:flex">
                            <!-- Exibir imagem do animal apenas em telas menores -->
                            <div class="md:hidden flex justify-center mb-4">
                                <img id="imagemAnimalMobile" src="{{ asset('storage/animal_photo_01_03.jpg') }}" alt="Foto do animal"
                                     class="object-cover w-40 h-40 rounded-full border-8 border-white drop-shadow-md">
                            </div>
                            <!-- Informações do animal -->
                            <div class="md:w-1/3 md:mb-0 mb-8">
                                <p class="text-center font-medium text-xl mb-5">{{ $infoContato->nome }}</p>
                                <dl class="grid grid-cols-2 md:px-9 px-5">
                                    <dt class="font-medium md:text-lg md:justify-self-auto">Animal: </dt>
                                    <dd class="md:text-lg justify-self-end">{{ $infoContato->tipo }}</dd>

                                    <dt class="font-medium md:text-lg md:justify-self-auto">Sexo: </dt>
                                    <dd class="md:text-lg justify-self-end">
                                        @if ($infoContato->sexo === 'M') Macho 
                                        @elseif ($infoContato->sexo === 'F') Fêmea 
                                        @else Outro 
                                        @endif
                                    </dd>

                                    <dt class="font-medium md:text-lg md:justify-self-auto">Idade: </dt>
                                    <dd class="md:text-lg justify-self-end">{{ $infoContato->idade }} ano(s)</dd>

                                    <dt class="font-medium md:text-lg md:justify-self-auto">Raça: </dt>
                                    <dd class="md:text-lg justify-self-end">{{ $infoContato->raca }}</dd>
                                </dl>
                            </div>
                            <!-- Divisória entre informações do animal e de contato -->
                            <div class="w-0.5 bg-gray-300 mx-6"></div>
                            <!-- Informações de contato -->
                            <div class="md:w-1/3">
                                <p class="text-center font-medium text-xl mb-5">Informações de contato</p>
                                <dl class="grid grid-cols-2 mb-5 justify-center md:px-6 px-5">
                                    <dt class="font-medium md:text-lg">Responsável: </dt>
                                    <dd class="md:text-lg justify-self-end">{{ implode(' ', array_slice(explode(' ', $infoContato->name), 0, 2)) }}</dd>
                                    <dt class="font-medium md:text-lg">Telefone:</dt>
                                    <dd id="celular" class="md:text-lg justify-self-end">{{ $infoContato->telefone }}</dd>
                                </dl>
                                <!-- Botão para iniciar conversa no WhatsApp -->
                                <a target="_blank" href="https://api.whatsapp.com/send?phone={{ urlencode($infoContato->telefone) }}"
                                   class="flex justify-center gap-3 mx-4 text-white bg-[#25d366] hover:bg-[#2ab45c] px-2 py-2 font-semibold rounded-md items-center md:w-full">
                                    <span>Chamar no WhatsApp</span>
                                    <!-- Ícone do WhatsApp -->
                                    <svg class="size-5" fill="#ffff" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" stroke="#ffff">
                                        <path d="M26.576 5.363c-2.69-2.69..."></path>
                                    </svg>
                                </a>
                            </div>
                            <!-- Exibir imagem do animal com efeito de hover em telas grandes -->
                            <div class="hidden md:flex md:w-1/3 justify-center mb-2">
                                <div class="relative group w-48 h-56 rounded overflow-hidden">
                                    <img id="foto" src="{{ asset('storage/' . $infoContato->foto) }}" alt="Foto do animal"
                                         class="object-cover w-full h-full transition-opacity duration-300 ease-in-out">
                                    <!-- Efeito de hover para ampliar imagem -->
                                    <div id="imagemAnimal" class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex justify-center items-center transition-opacity duration-300 ease-in-out">
                                        <svg class="size-10" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                            <path d="M7 10H10M10 10H13M10..."></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para exibir a imagem em tela cheia -->
    <div id="animalModal" class="fixed inset-0 bg-black bg-opacity-75 items-center justify-center hidden z-50">
        <!-- Botão de fechar modal -->
        <span class="absolute top-4 right-4 text-white text-3xl cursor-pointer" id="fecharModal">&times;</span>
        <!-- Imagem em tela cheia no modal -->
        <img id="fotoAnimal" class="max-w-[80vw] max-h-[80vh] w-auto h-auto rounded">
    </div>

    <!-- Importa o script para funcionalidade do contato -->
    @push('scripts')
        @vite('resources/js/contato.js')
    @endpush
</x-app-layout>
