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
                                   class="flex justify-center gap-3 mx-4 text-white bg-[#27c461] hover:bg-[#2ab45c] px-2 py-2 font-semibold rounded-md items-center md:w-full">
                                    <span>Chamar no WhatsApp</span>
                                    <!-- Ícone do WhatsApp -->
                                    <svg  class="size-6" fill="#fff" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.014 8.00613C6.12827 7.1024 7.30277 5.87414 8.23488 6.01043L8.23339 6.00894C9.14051 6.18132 9.85859 7.74261 10.2635 8.44465C10.5504 8.95402 10.3641 9.4701 10.0965 9.68787C9.7355 9.97883 9.17099 10.3803 9.28943 10.7834C9.5 11.5 12 14 13.2296 14.7107C13.695 14.9797 14.0325 14.2702 14.3207 13.9067C14.5301 13.6271 15.0466 13.46 15.5548 13.736C16.3138 14.178 17.0288 14.6917 17.69 15.27C18.0202 15.546 18.0977 15.9539 17.8689 16.385C17.4659 17.1443 16.3003 18.1456 15.4542 17.9421C13.9764 17.5868 8 15.27 6.08033 8.55801C5.97237 8.24048 5.99955 8.12044 6.014 8.00613Z" fill="#fff"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 23C10.7764 23 10.0994 22.8687 9 22.5L6.89443 23.5528C5.56462 24.2177 4 23.2507 4 21.7639V19.5C1.84655 17.492 1 15.1767 1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12C23 18.0751 18.0751 23 12 23ZM6 18.6303L5.36395 18.0372C3.69087 16.4772 3 14.7331 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C11.0143 21 10.552 20.911 9.63595 20.6038L8.84847 20.3397L6 21.7639V18.6303Z" fill="#fff"></path> </g></svg>
                                    
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
