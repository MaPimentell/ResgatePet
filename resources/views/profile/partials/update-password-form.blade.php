<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Alterar senha') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Certifique-se de que sua conta esteja usando uma senha longa para se manter segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Senha atual')" />
            <x-text-input placeholder="Digite sua senha atual" id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full placeholder-slate-400 bg-slate-50" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Nova senha')" />
            <x-text-input placeholder="Digite sua senha nova" id="update_password_password" name="password" type="password" class="mt-1 block w-full placeholder-slate-400 bg-slate-50" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('confirmar senha')" />
            <x-text-input placeholder="Confirme sua nova senha" id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full placeholder-slate-400 bg-slate-50" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

@if(session('senha_atulizada'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            text: '{{ session('senha_atulizada') }}',
            icon: 'success',
            confirmButtonText: 'Confirmar',
            customClass: {
                confirmButton: 'swal-btn-sucesso',
                popup: 'swal-popup-sucesso'
            }
        });
    </script>
@endif
