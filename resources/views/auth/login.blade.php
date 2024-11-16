<style>
    .titulo-logo{
        font-family: "Titan One", sans-serif;
        font-weight: 800;
        font-style: normal;
    }
</style>
<x-guest-layout>
    <div class="flex justify-center mt-4">
        <h1 id="titulo-logo" class="titulo-logo md:text-3xl tracking-tight">Resgata </h1> <h1 class="titulo-logo md:text-3xl tracking-tight text-red-600">Pet</h1>
    </div>
    <div class="flex flex-col justify-start mt-7">
        <h2 class="md:text-2xl font-black tracking-tight">Acesse sua conta</h2>
        <span class="mt-4 text-gray-500 text-sm tracking-tight">Perdeu seu pet ou quer ajudar animais que estão perdidos? Entre ou cadastre-se em nossa plataforma e contribua para a busca!</span>
    </div>
    <div class="mt-5 mx-2">
        <hr>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-0" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-6">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input placeholder="Digite seu email" id="email" class="block mt-1 w-full placeholder-slate-400 bg-slate-50" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full placeholder-slate-400 bg-slate-50" placeholder="Digite sua senha"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        
        <x-primary-button class="w-full justify-center mt-6 ">
            {{ __('Log in') }}
        </x-primary-button>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class=" text-sm text-gray-600 hover:text-gray-900  hover:underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            <a href="{{ route('register')}}" class="ms-3 align-center flex  rounded-2xl justify-center px-4 py-2 border border-red-600  bg-transparent text-red-600  hover:bg-red-600 hover:text-white  font-semibold text-xs  uppercase tracking-widest   transition ease-in-out duration-300">
                Cadastre-se
            </a>
        </div>
    </form>
    
    
</x-guest-layout>
