<x-guest-layout>
    <div class="">
        <div class="mt-4">
            <h2 class="font-semibold text-center text-lg"> Cadastro de Animal </h2>
        </div>
        <form method="POST" action="{{ route('animais.store') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Foto -->
            <div class="mt-4 flex justify-center">
                <input id="fotoAnimal" name="fotoAnimal" type="file" class="hidden">
                <label for="fotoAnimal" class="relative inline-block cursor-pointer">
              
                        <img id="image"  src="{{ asset('images/default_pet.jpg') }}" alt="Foto do animal"
                            class=" mt-2 ml-4 w-20 rounded-full border-2">
                        <div id="svgPlus" class="absolute top-5  right-0 -mt-1 mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                </label>
            </div>

            <!-- Animal -->
            <div class="mt-4">
                <x-input-label for="animal" :value="__('Animal')" />
                <select class="mt-1 w-full rounded border-slate-300 p-2 disabled:bg-gray-300"
                        name="animal" required>
                        <option selected disabled>Selecione um animal </option>
                        <option {{ in_array('Cabra', old('tipo', $tipo ?? [])) ? 'selected' : '' }} value="Cabra">Cabra</option>
                        <option {{ in_array('Cachorro', old('tipo', $tipo ?? [])) ? 'selected' : '' }} value="Cachorro">Cachorro</option>
                        <option {{ in_array('Cavalo', old('tipo', $tipo ?? [])) ? 'selected' : '' }} value="Cavalo">Cavalo</option>
                        <option {{ in_array('Coelho', old('tipo', $tipo ?? [])) ? 'selected' : '' }} value="Coelho">Coelho</option>
                        <option {{ in_array('Cobra', old('tipo', $tipo ?? [])) ? 'selected' : '' }} value="Cobra">Cobra</option>
                        <option {{ in_array('Furão', old('tipo', $tipo ?? [])) ? 'selected' : '' }} value="Furão">Furão</option>
                        <option {{ in_array('Galinha', old('tipo', $tipo ?? [])) ? 'selected' : '' }} value="Galinha">Galinha</option>
                        <option {{ in_array('Gato', old('tipo', $tipo ?? [])) ? 'selected' : '' }} value="Gato">Gato</option>
                        <option {{ in_array('Hamster', old('tipo', $tipo ?? [])) ? 'selected' : '' }} value="Hamster">Hamster</option>
                        <option {{ in_array('Pássaro', old('tipo', $tipo ?? [])) ? 'selected' : '' }} value="Pássaro">Pássaro</option>
                        <option {{ in_array('Porco', old('tipo', $tipo ?? [])) ? 'selected' : '' }} value="Porco">Porco</option>
                        <option {{ in_array('Porquinho-da-índia', old('tipo', $tipo ?? [])) ? 'selected' : '' }} value="Porquinho-da-índia">Porquinho-da-índia</option>
                        <option {{ in_array('Rato doméstico', old('tipo', $tipo ?? [])) ? 'selected' : '' }} value="Rato doméstico">Rato doméstico</option>
                        <option {{ in_array('Tartaruga', old('tipo', $tipo ?? [])) ? 'selected' : '' }} value="Tartaruga">Tartaruga</option>
                </select>
                <x-input-error :messages="$errors->get('animal')" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-input-label for="nome" :value="__('Nome')" />
                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus autocomplete="nome" />
                <x-input-error :messages="$errors->get('nome')" class="mt-2" />
            </div>

            <!-- Raça -->
            <div class="mt-4">
                <x-input-label for="raca" :value="__('Raça')" />
                <x-text-input id="raca" class="block mt-1 w-full" type="text" name="raca" :value="old('raca')" required autofocus autocomplete="raca" />
                <x-input-error :messages="$errors->get('raca')" class="mt-2" />
            </div>

            <!-- Idade -->
            <div class="mt-4">
                <x-input-label for="idade" :value="__('Idade')" />
                <x-text-input id="idade" class="block mt-1 w-full" type="number" name="idade" :value="old('idade')" required autocomplete="idade" max="999" min="0" />
                <x-input-error :messages="$errors->get('idade')" class="mt-2" />
            </div>

            <!-- Sexo -->
            <div class="mt-4">
                <x-input-label for="sexo" :value="__('Sexo')" />
                <label><input type="radio" name="sexo" value="M" {{ old('sexo', $sexo ?? '') == 'M' ? 'checked' : '' }} required> Macho</label>
                <label class="mx-5"><input type="radio" name="sexo" value="F" {{ old('sexo', $sexo ?? '') == 'F' ? 'checked' : '' }} required> Fêmea</label>
                <label><input type="radio" name="sexo" value="N" {{ old('sexo', $sexo ?? '') == 'N' ? 'checked' : '' }} required> Outros</label>
                <x-input-error :messages="$errors->get('sexo')" class="mt-2" />
            </div>


            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="mt-6">
                    {{ __('Salvar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
{{-- @push('scripts')
    @vite('resources/js/cadastro.js')
@endpush --}}
</x-guest-layout>

