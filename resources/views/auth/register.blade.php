<x-guest-layout>
    <form id="formRegister" method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mt-3">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" placeholder="Digite seu nome" class="block mt-1 w-full placeholder-slate-400 bg-slate-50" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-6">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" placeholder="Digite seu email" class="block mt-1 w-full placeholder-slate-400 bg-slate-50" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

         <!-- Phone Address -->
         <div class="mt-6">
            <x-input-label for="telefone" :value="__('Celular')" />
            <x-text-input id="telefone" placeholder="Digite seu celular" class="block mt-1 w-full placeholder-slate-400 bg-slate-50" type="text" name="telefone" :value="old('telefone')" required autocomplete="telefone" maxlength="15" />
            <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" placeholder="Digite sua senha" class="block mt-1 w-full placeholder-slate-400 bg-slate-50" 
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-6">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" placeholder="Confirme sua senha" class="block mt-1 w-full placeholder-slate-400 bg-slate-50"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <label class="flex items-center gap-3">
                <input required name="termos" id="checkTermos" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded"/>
                <span>Concordo com os Termos de Uso</span>
            </label>
            <a id="abreModal" class="text-blue-600 hover:underline">
               Ler os Termos de Uso
            </a>
        </div>

        <div class="flex items-center justify-end mt-6 mb-3">
            <a class="hover:underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
  
  <!-- Modal termos de uso -->
  <div id="modal-termos" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 justify-center items-start  bg-black/50">
    <div class="">
        <div class="relative p-4 w-full max-w-4xl min-h-2 max-h-16">
            <div class="relative bg-white rounded-lg shadow ">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                    <h3 class="text-xl font-semibold text-gray-900 ">
                        Termos de uso
                    </h3>
                    <button type="button" class="fechaModal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="modal-termos">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal conteúdo -->
                <div class="p-4 md:p-5 space-y-4 max-h-[75vh] overflow-y-auto">
                    <p>Bem-vindo(a) ao nosso site! Antes de utilizar nossos serviços, leia atentamente os Termos de Uso descritos abaixo. Ao acessar e utilizar nosso site, você concorda com as condições estabelecidas. Caso não concorde com estes Termos, por favor, não utilize o site.</p>

                    <h2 class="font-semibold">1. Aceitação dos Termos</h2>
                    <p class="px-3">Ao criar uma conta em nosso site, você concorda com os Termos de Uso e nossa Política de Privacidade. Estes documentos regem o uso do site e de suas funcionalidades.</p>
                
                    <h2 class="font-semibold">2. Cadastro</h2>
                    <p class="px-3">Para utilizar nosso site, você precisará fornecer informações pessoais, incluindo:</p>
                    <ul class="px-5">
                        <li>- Nome</li>
                        <li>- E-mail</li>
                        <li>- Telefone</li>
                        <li>- Senha</li>
                    </ul>
                    <p class="px-3">Você se compromete a fornecer informações verdadeiras, completas e atualizadas. É sua responsabilidade manter seus dados cadastrais atualizados para que possamos garantir a funcionalidade do serviço.</p>
                
                    <h2 class="font-semibold">3. Finalidade do Serviço</h2>
                    <p class="px-3">Nosso site foi desenvolvido para auxiliar donos de animais a encontrarem seus pets desaparecidos. Através da plataforma:</p>
                    <ul class="px-3">
                        <li>Os usuários poderão adicionar alertas no mapa informando sobre o desaparecimento de seus animais.</li>
                        <li>Outros usuários terão acesso ao <strong>nome e telefone</strong> do responsável pelo alerta para entrar em contato e ajudar no resgate.</li>
                    </ul>
                    <p class="px-3">Ao utilizar esta funcionalidade, você concorda em compartilhar seu nome e telefone com outros usuários exclusivamente para fins relacionados à localização do animal desaparecido.</p>
                
                    <h2 class="font-semibold">4. Responsabilidades do Usuário</h2>
                    <ul class="px-3">
                        <li><strong>Informações Verídicas:</strong> Você é o único responsável pelas informações inseridas no site. Não nos responsabilizamos por dados incorretos ou desatualizados que possam impactar a eficiência do serviço.</li>
                        <li><strong>Uso Adequado:</strong> O compartilhamento de informações pessoais (nome e telefone) deve ser utilizado exclusivamente para os fins previstos nesta plataforma. O uso inadequado das informações obtidas, como para spam ou atividades mal-intencionadas, poderá resultar no banimento do usuário e em medidas legais cabíveis.</li>
                        <li><strong>Segurança da Conta:</strong> É sua responsabilidade manter a confidencialidade de sua senha e de suas credenciais de acesso.</li>
                    </ul>
                
                    <h2 class="font-semibold">5. Limitação de Responsabilidade</h2>
                    <p class="px-3">Nos esforçamos para oferecer um serviço eficiente e funcional, mas não garantimos que o uso da plataforma resultará sempre na localização dos animais desaparecidos. Além disso:</p>
                    <ul class="px-3">
                        <li>Não nos responsabilizamos por eventuais problemas de conexão, falhas técnicas ou indisponibilidade do serviço.</li>
                        <li>Não garantimos a conduta de outros usuários que obtiverem acesso às suas informações.</li>
                    </ul>
                
                    <h2 class="font-semibold">6. Privacidade e Proteção de Dados</h2>
                    <p class="px-3">Seu nome, e-mail, telefone e demais dados pessoais serão armazenados de forma segura, em conformidade com as leis de proteção de dados aplicáveis (como a LGPD). As informações compartilhadas no mapa (nome e telefone) serão exibidas apenas para facilitar o contato entre os usuários e exclusivamente para ajudar na localização do animal.</p>
                
                    <h2 class="font-semibold">7. Proibições</h2>
                    <p class="px-3">É expressamente proibido:</p>
                    <ul class="px-3">
                        <li>Inserir informações falsas ou enganosas no sistema.</li>
                        <li>Utilizar as informações de contato de outros usuários para fins não autorizados, como spam, assédio ou publicidade.</li>
                        <li>Praticar qualquer ação que possa prejudicar o funcionamento do site ou a segurança dos usuários.</li>
                    </ul>
                
                    <h2 class="font-semibold">8. Alterações nos Termos de Uso</h2>
                    <p class="px-3">Reservamo-nos o direito de alterar estes Termos de Uso a qualquer momento. Sempre que houver mudanças, informaremos os usuários através do site ou e-mail cadastrado. O uso contínuo da plataforma após as alterações será considerado como aceitação dos novos termos.</p>
                
                    <h2 class="font-semibold">9. Legislação Aplicável</h2>
                    <p class="px-3">Este Termo de Uso está sujeito à legislação vigente no Brasil, incluindo as disposições da Lei Geral de Proteção de Dados (LGPD).</p>
                
                    <p class="px-3">Ao clicar em "Aceito os Termos de Uso" durante o cadastro, você confirma que leu, compreendeu e concorda com todas as cláusulas acima.</p>
                
                    <p class="px-3">Obrigado por utilizar nosso site! Juntos, podemos ajudar na localização de animais desaparecidos.</p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b ">
                    <button id="aceitaTermos" data-modal-hide="modal-termos" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Aceito os termos</button>
                    <button data-modal-hide="modal-termos" type="button" class="fechaModal py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Fechar</button>
                </div>
            </div>
        </div>
    </div>
  </div>
      
@push('scripts')
    @vite('resources/js/cadastro.js')
@endpush
</x-guest-layout>

