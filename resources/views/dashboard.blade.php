<x-app-layout>
    <!-- Cabeçalho da página com o título "Mapa de alertas" -->
   <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mapa de alertas') }}
        </h2>
    </x-slot>

    <div class="py-7 md:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden border-t-4 border-red-600 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-14">
                        <div class="flex items-start justify-between md:mb-10">
                            <div class="md:w-2/3">
                                <div class="flex gap-1 items-center md:mb-4">
                                    <h2 class="flex font-semibold md:font-bold  md:text-xl">
                                        Sua localização
                                    </h2>
                                    <svg class="size-5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>pin_fill_sharp_circle [#634]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-223.000000, -5399.000000)" fill="#000000"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M174,5248.219 C172.895,5248.219 172,5247.324 172,5246.219 C172,5245.114 172.895,5244.219 174,5244.219 C175.105,5244.219 176,5245.114 176,5246.219 C176,5247.324 175.105,5248.219 174,5248.219 M174,5239 C170.134,5239 167,5242.134 167,5246 C167,5249.866 174,5259 174,5259 C174,5259 181,5249.866 181,5246 C181,5242.134 177.866,5239 174,5239" id="pin_fill_sharp_circle-[#634]"> </path> </g> </g> </g> </g></svg>
                                </div>
                                <span class="hidden md:block text-sm text-gray-600 ">O mapa abaixo mostra os seus alertas e os de outros donos que perderam seus animais. Se você tiver alguma informação, clique no ícone da pata para entrar mais informações do animal.</span>
                            </div>
                            <button id="btnAdicionarAlerta"
                                class="flex gap-3 px-2 py-3 md:px-4 md:py-3 text-xs md:text-base font-semibold text-white bg-red-600 hover:bg-red-500 rounded-lg ">
                                Adicionar alerta
                                <svg class="size-4 md:size-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke=""><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g clip-path="url(#ffffclip0_949_22799)"> <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82664 2.22902C10.7938 0.590326 13.2063 0.590325 14.1735 2.22902L23.6599 18.3024C24.6578 19.9933 23.3638 22 21.4865 22H2.51362C0.63634 22 -0.657696 19.9933 0.340215 18.3024L9.82664 2.22902ZM10.0586 7.05547C10.0268 6.48227 10.483 6 11.0571 6H12.9429C13.517 6 13.9732 6.48227 13.9414 7.05547L13.5525 14.0555C13.523 14.5854 13.0847 15 12.554 15H11.446C10.9153 15 10.477 14.5854 10.4475 14.0555L10.0586 7.05547ZM14 18C14 19.1046 13.1046 20 12 20C10.8954 20 10 19.1046 10 18C10 16.8954 10.8954 16 12 16C13.1046 16 14 16.8954 14 18Z" fill="#ffff"></path> </g> <defs> <clipPath id="clip0_949_22799"> <rect width="24" height="24" fill="white"></rect> </clipPath> </defs> </g></svg>
                            </button>
                        </div>
                        <span class=" md:hidden block text-sm text-gray-500 font-medium mt-4">O mapa abaixo mostra os seus alertas e os de outros donos que perderam seus animais.</span>
                        <!-- Div onde o mapa será exibido -->
                        <div id="map" class="mt-6 rounded-md h-80 md:h-[450px] w-full"></div>
                    </div>
                    <div class="mb-12">
                        <div class="mb-8">
                            <div class="flex gap-1 items-center ">
                                <h2 class="flex font-semibold md:font-bold text-xl">Como funciona</h2>
                                <svg class="size-6 md:size-6"  viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M0.877075 7.49972C0.877075 3.84204 3.84222 0.876892 7.49991 0.876892C11.1576 0.876892 14.1227 3.84204 14.1227 7.49972C14.1227 11.1574 11.1576 14.1226 7.49991 14.1226C3.84222 14.1226 0.877075 11.1574 0.877075 7.49972ZM7.49991 1.82689C4.36689 1.82689 1.82708 4.36671 1.82708 7.49972C1.82708 10.6327 4.36689 13.1726 7.49991 13.1726C10.6329 13.1726 13.1727 10.6327 13.1727 7.49972C13.1727 4.36671 10.6329 1.82689 7.49991 1.82689ZM8.24993 10.5C8.24993 10.9142 7.91414 11.25 7.49993 11.25C7.08571 11.25 6.74993 10.9142 6.74993 10.5C6.74993 10.0858 7.08571 9.75 7.49993 9.75C7.91414 9.75 8.24993 10.0858 8.24993 10.5ZM6.05003 6.25C6.05003 5.57211 6.63511 4.925 7.50003 4.925C8.36496 4.925 8.95003 5.57211 8.95003 6.25C8.95003 6.74118 8.68002 6.99212 8.21447 7.27494C8.16251 7.30651 8.10258 7.34131 8.03847 7.37854L8.03841 7.37858C7.85521 7.48497 7.63788 7.61119 7.47449 7.73849C7.23214 7.92732 6.95003 8.23198 6.95003 8.7C6.95004 9.00376 7.19628 9.25 7.50004 9.25C7.8024 9.25 8.04778 9.00601 8.05002 8.70417L8.05056 8.7033C8.05924 8.6896 8.08493 8.65735 8.15058 8.6062C8.25207 8.52712 8.36508 8.46163 8.51567 8.37436L8.51571 8.37433C8.59422 8.32883 8.68296 8.27741 8.78559 8.21506C9.32004 7.89038 10.05 7.35382 10.05 6.25C10.05 4.92789 8.93511 3.825 7.50003 3.825C6.06496 3.825 4.95003 4.92789 4.95003 6.25C4.95003 6.55376 5.19628 6.8 5.50003 6.8C5.80379 6.8 6.05003 6.55376 6.05003 6.25Z" fill="#000000"></path> </g></svg>
                            </div>
                            <span class="text-sm text-gray-600">Se o seu animal fugiu de casa, mantenha a calma e siga as instruções abaixo:</span>
                        </div>
                        <div class="md:flex mb-3">
                            <div class="flex flex-col justify-start items-center md:px-3 md:w-1/3">
                                <svg class="size-5 md:size-6 mb-4" fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M256,0C114.609,0,0,114.609,0,256c0,141.391,114.609,256,256,256c141.391,0,256-114.609,256-256 C512,114.609,397.391,0,256,0z M256,472c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z"></path> <g> <path d="M249.703,201.25H188v-25h19.312c6.859,0,13.422-1.219,19.5-3.594c6.172-2.375,11.438-5.641,15.797-9.797 c4.358-4.203,7.922-9.25,10.547-15.234c2.734-5.906,4.047-12.5,4.047-19.625H284v256h-34.297V201.25z"></path> </g> </g></svg>
                                <span class="md:text-base text-sm text-center text-gray-800">Cadastre o seu animal na página <i> Perfil Animal</i> ou clique <a  class="text-blue-500 hover:underline" href="{{ route('animais.cadastro', 0)}}">Aqui</a>. Não se esqueça de adicionar uma foto para que seja mais fácil para outras pessoas reconhecê-lo!</span>
                            </div>
                            <div class="flex items-center md:mb-0 mb-6">
                                <svg class="hidden md:block size-5 md:size-6 mx-3" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16.3153 16.6681C15.9247 17.0587 15.9247 17.6918 16.3153 18.0824C16.7058 18.4729 17.339 18.4729 17.7295 18.0824L22.3951 13.4168C23.1761 12.6357 23.1761 11.3694 22.3951 10.5883L17.7266 5.9199C17.3361 5.52938 16.703 5.52938 16.3124 5.91991C15.9219 6.31043 15.9219 6.9436 16.3124 7.33412L19.9785 11.0002L2 11.0002C1.44772 11.0002 1 11.4479 1 12.0002C1 12.5524 1.44772 13.0002 2 13.0002L19.9832 13.0002L16.3153 16.6681Z" fill="#0F0F0F"></path> </g></svg>
                            </div>
                            <div class="flex flex-col justify-start items-center md:px-3 md:w-1/3">
                                <svg class="size-5 md:size-6 mb-4" fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M256,0C114.609,0,0,114.609,0,256s114.609,256,256,256s256-114.609,256-256S397.391,0,256,0z M256,472 c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z"></path> <g> <path d="M176,209.75c2.531-24.406,10.969-44.141,25.375-59.219c14.344-15.031,34-22.531,58.859-22.531 c12.234,0,23.172,2.141,32.594,6.484c9.422,4.297,17.375,10.141,23.719,17.484c6.328,7.281,11.219,15.547,14.516,24.797 c3.281,9.266,4.938,18.844,4.938,28.703c0,8.625-0.984,16.391-3.062,23.266c-2.094,6.875-4.953,12.984-8.688,18.297 c-3.75,5.438-8.031,10.375-13.109,15c-4.922,4.688-10.328,9.078-16.188,13.234c-10.844,8.406-22.125,16.453-33.672,24.203 c-11.594,7.75-22.719,16.531-33.375,26.328c-3.875,3.672-7.062,7.438-9.594,11.453c-2.5,4.016-4.594,9.031-6.266,15.016h117.375 V384H178.531v-24.203c0-10.047,3.188-20,9.625-29.578c6.438-9.734,14.438-19.188,24.125-28.219 c9.625-9.031,20.188-17.828,31.781-26.359c11.609-8.516,22.531-16.766,32.891-24.781c7.844-5.984,14.031-12.359,18.672-19.234 c4.516-6.859,6.859-15.625,6.859-26.344c0-15.172-3.812-27.031-11.734-35.531c-7.781-8.484-17.938-12.734-30.516-12.734 c-15.359,0-27.531,4.703-36.453,14.109c-9,9.375-13.438,22.25-13.438,38.625H176z"></path> </g> </g></svg>
                                <span class="md:text-base text-sm text-center text-gray-800">No mapa acima, clique no botão <i>Adicionar Alerta</i>, escolha o animal perdido e confirme. Em seguida, um ícone de pata aparecerá no mapa, marcando a sua localização e indicando que o alerta está ativo.</span>
                            </div>
                            <div class="flex items-center md:mb-0 mb-6">
                                <svg class="hidden md:block size-4 md:size-6 mx-3" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16.3153 16.6681C15.9247 17.0587 15.9247 17.6918 16.3153 18.0824C16.7058 18.4729 17.339 18.4729 17.7295 18.0824L22.3951 13.4168C23.1761 12.6357 23.1761 11.3694 22.3951 10.5883L17.7266 5.9199C17.3361 5.52938 16.703 5.52938 16.3124 5.91991C15.9219 6.31043 15.9219 6.9436 16.3124 7.33412L19.9785 11.0002L2 11.0002C1.44772 11.0002 1 11.4479 1 12.0002C1 12.5524 1.44772 13.0002 2 13.0002L19.9832 13.0002L16.3153 16.6681Z" fill="#0F0F0F"></path> </g></svg>
                            </div>
                            <div class="flex flex-col justify-start items-center md:px-3 md:w-1/3">
                                <svg class="size-5 md:size-6 mb-4"fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M256,0C114.609,0,0,114.609,0,256s114.609,256,256,256s256-114.609,256-256S397.391,0,256,0z M256,472 c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z"></path> <g> <path d="M182.828,204.781c2.688-24.062,9.672-42.922,20.938-56.5C215.031,134.766,232.812,128,257.25,128 c21.156,0,37.938,5.969,50.25,17.875s18.469,27.75,18.469,47.469c0,14.125-2.562,25.375-7.781,33.781 c-5.234,8.375-13.453,14.906-24.781,19.625c5.422,1.75,10.641,4.25,15.688,7.5c5.188,3.25,9.734,7.406,13.672,12.594 c4.062,5.156,7.266,11.234,9.734,18.344c2.344,7.047,3.5,15.359,3.5,25.094c0,12.172-2.078,22.688-6.234,31.75 c-4.281,9.188-9.984,16.906-17.078,22.984c-7.234,6.219-15.641,10.938-25.047,14.188c-9.531,3.234-19.672,4.797-30.391,4.797 c-21.969,0-40.156-6.984-54.5-20.984c-14.344-13.984-23.25-34.547-26.75-62h32.562c3.188,20,8.734,34.047,16.5,42.203 c7.75,8.031,18.531,12.062,32.188,12.062c6.156,0,12.094-1.016,17.703-3.047c5.641-2.016,10.516-5.016,14.812-9.016 c4.312-4,7.734-8.734,10.391-14.281c2.5-5.688,3.703-11.906,3.703-18.656c0-13.516-4.125-25.016-12.5-34.438 c-8.25-9.375-19.641-14.094-34.109-14.094h-18.516v-28.719h18.516c6.719,0,12.422-1.062,17.109-3.281 c4.656-2.234,8.484-5.094,11.453-8.625c2.953-3.5,5.031-7.5,6.219-11.875c1.297-4.469,1.797-8.875,1.797-13.25 c0-12.375-3.406-22.109-10.25-29.156c-6.828-7.078-15.922-10.594-27.188-10.594c-6.953,0-12.797,1.281-17.656,3.984 c-4.812,2.641-8.875,6.156-12.078,10.547c-3.188,4.453-5.719,9.594-7.625,15.484c-1.859,5.875-3.219,12.109-4,18.516H182.828z"></path> </g> </g></svg>
                                <span class="md:text-base text-sm text-center text-gray-800">Pronto! Agora outros usuários podem visualizar seu alerta no mapa e entrar em contato com você caso tenham alguma informação. Se quiser desativar o alerta, basta acessar a página <i>Meus Alertas</i>.</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-8">
                        <hr>
                    </div>
                    <div>
                        <div class="mb-6">
                            <div class="flex gap-2 items-center mb-6">
                                <h2 class="flex font-semibold md:font-bold  text-xl ">Apoie a causa</h2>
                                <svg class="size-6 md:size-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6.00019C10.2006 3.90317 7.19377 3.2551 4.93923 5.17534C2.68468 7.09558 2.36727 10.3061 4.13778 12.5772C5.60984 14.4654 10.0648 18.4479 11.5249 19.7369C11.6882 19.8811 11.7699 19.9532 11.8652 19.9815C11.9483 20.0062 12.0393 20.0062 12.1225 19.9815C12.2178 19.9532 12.2994 19.8811 12.4628 19.7369C13.9229 18.4479 18.3778 14.4654 19.8499 12.5772C21.6204 10.3061 21.3417 7.07538 19.0484 5.17534C16.7551 3.2753 13.7994 3.90317 12 6.00019Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            </div>
                            <p class="text-gray-800 mb-4">Nosso projeto independente tem como missão ajudar animais perdidos a se reencontrarem com seus donos. Com a sua doação, podemos manter a plataforma ativa, conectando pessoas e promovendo a segurança dos animais. Cada contribuição faz a diferença e nos aproxima de salvar mais vidas. Junte-se a nós nessa causa e ajude a transformar histórias!</p>
                            <div class="md:flex justify-start">
                                <div class="md:w-5/6 md:mb-0 mb-4 self-center">
                                    <span class="text-gray-800">Deseja nos apoiar? Você pode fazer uma doação via Pix! Basta escanear o QR Code com o seu aplicativo. Sua contribuição é essencial para que possamos continuar nosso trabalho em prol dos animais!</span>                                                                    </div>
                                <div class="md:w-1/6 md:flex justify-center">
                                    <img src="{{ asset('images/qr_code.jpeg') }}" alt="QR Code" class="w-28">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@push('scripts')
    @vite('resources/js/dashboard.js')
@endpush

</x-app-layout>
