<x-app-layout>
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="sm:max-w-md sm:rounded-lg md:w-full md:mt-6 md:px-6 md:py-4 md:mb-20 mb-12 w-11/12 px-5 py-4 rounded-lg border-t-2 border-red-600 bg-white shadow-md overflow-hidden ">
        <div class="">
            <div class="mt-4">
                @if($animal)
                <h2 class="font-semibold text-center text-lg"> Editar perfil </h2>    
                @else
                <h2 class="font-semibold text-center text-lg"> Dados do Animal </h2>
                @endif
            </div>
            <form method="POST" action="{{ route('animais.store') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Foto -->
                <div class="mt-4 flex justify-center">
                    <input id="fotoAnimal" name="fotoAnimal" type="file" class="hidden">
                    <label for="fotoAnimal" class="relative inline-block cursor-pointer">
                        <img id="image" src="{{ $animal && $animal->foto ? asset('storage/' . $animal->foto) : asset('images/default_pet.png') }}" alt="Foto do animal"
                        class=" mt-2 ml-4 w-20 h-20 object-cover rounded-full border-2 opacity-70 hover:opacity-100 transition duration-200">
                        <div id="svgPlus" class="absolute top-5  right-0 -mt-1 mr-1 text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                    </label>
                </div>
                <div class="flex justify-center text-center">
                    <x-input-error :messages="$errors->get('fotoAnimal')" class="mt-2" />
                </div>

                <!-- Animal -->
                <div class="mt-4">
                    <x-input-label for="animal" :value="__('Animal')" />
                    <select class="mt-1 w-full rounded border-slate-300 p-2 disabled:bg-gray-300 bg-slate-50"
                            name="animal" required>
                            <option selected disabled value="" class="text-slate-400">Selecione um animal </option>
                            <option {{ old('modalidade', $animal->tipo ?? '') == 'Cabra' ? 'selected' : '' }} value="Cabra">Cabra</option>
                            <option {{ old('modalidade', $animal->tipo ?? '') == 'Cachorro' ? 'selected' : '' }} value="Cachorro">Cachorro</option>
                            <option {{ old('modalidade', $animal->tipo ?? '') == 'Cavalo' ? 'selected' : '' }} value="Cavalo">Cavalo</option>
                            <option {{ old('modalidade', $animal->tipo ?? '') == 'Coelho' ? 'selected' : '' }} value="Coelho">Coelho</option>
                            <option {{ old('modalidade', $animal->tipo ?? '') == 'Cobra' ? 'selected' : '' }} value="Cobra">Cobra</option>
                            <option {{ old('modalidade', $animal->tipo ?? '') == 'Furão' ? 'selected' : '' }} value="Furão">Furão</option>
                            <option {{ old('modalidade', $animal->tipo ?? '') == 'Galinha' ? 'selected' : '' }} value="Galinha">Galinha</option>
                            <option {{ old('modalidade', $animal->tipo ?? '') == 'Gato' ? 'selected' : '' }} value="Gato">Gato</option>
                            <option {{ old('modalidade', $animal->tipo ?? '') == 'Hamster' ? 'selected' : '' }} value="Hamster">Hamster</option>
                            <option {{ old('modalidade', $animal->tipo ?? '') == 'Pássaro' ? 'selected' : '' }} value="Pássaro">Pássaro</option>
                            <option {{ old('modalidade', $animal->tipo ?? '') == 'Porco' ? 'selected' : '' }} value="Porco">Porco</option>
                            <option {{ old('modalidade', $animal->tipo ?? '') == 'Porquinho-da-índia' ? 'selected' : '' }} value="Porquinho-da-índia">Porquinho-da-índia</option>
                            <option {{ old('modalidade', $animal->tipo ?? '') == 'Rato doméstico' ? 'selected' : '' }} value="Rato doméstico">Rato doméstico</option>
                            <option {{ old('modalidade', $animal->tipo ?? '') == 'Tartaruga' ? 'selected' : '' }} value="Tartaruga">Tartaruga</option>
                    </select>
                    <x-input-error :messages="$errors->get('animal')" class="mt-2" />
                </div>
                


                <!-- Name -->
                <div class="mt-4">
                    <x-input-label for="nome" :value="__('Nome')" />
                    <x-text-input placeholder="Digite nome do animal" id="nome" class="block mt-1 w-full placeholder-slate-400 bg-slate-50" type="text" name="nome" value="{{ old('nome', $animal->nome ?? '') }}" required autofocus autocomplete="nome" />
                    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                </div>

                <!-- Raça -->
                <div class="mt-4">
                    <x-input-label for="raca" :value="__('Raça')" />
                    <x-text-input placeholder="Digite a Raça" id="raca" class="block mt-1 w-full placeholder-slate-400 bg-slate-50" type="text" name="raca" value="{{ old('raca', $animal->raca ?? '') }}" required autofocus autocomplete="raca" />
                    <x-input-error :messages="$errors->get('raca')" class="mt-2" />
                </div>

                <!-- Idade -->
                <div class="mt-4">
                    <x-input-label for="idade" :value="__('Idade')" />
                    <x-text-input placeholder="Digite a idade" id="idade" class="block mt-1 w-full placeholder-slate-400 bg-slate-50" type="number" name="idade" value="{{ old('idade', $animal->idade ?? '') }}" required autocomplete="idade" max="999" min="0" />
                    <x-input-error :messages="$errors->get('idade')" class="mt-2" />
                </div>

                <!-- Sexo -->
                <div class="mt-4">
                    <x-input-label for="sexo" :value="__('Sexo')" />
                    <label><input type="radio" name="sexo" value="M" {{ old('sexo', $animal->sexo ?? '') == 'M' ? 'checked' : '' }} required> Macho</label>
                    <label class="mx-5"><input type="radio" name="sexo" value="F" {{ old('sexo', $animal->sexo ?? '') == 'F' ? 'checked' : '' }} required> Fêmea</label>
                    <label><input type="radio" name="sexo" value="N" {{ old('sexo', $animal->sexo ?? '') == 'N' ? 'checked' : '' }} required> Não definido</label>
                    <x-input-error :messages="$errors->get('sexo')" class="mt-2" />
                </div>

                @if ($animal != null && $animal->id != null)
                    <input id="animal_id" name="animal_id" class="hidden" type="text" value="{{ $animal->id }}"
                required />
                @else
                    <input id="animal_id" name="animal_id" class="hidden" type="text" value="0" required />
                @endif

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="mt-6">
                        {{ __('Salvar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    @vite('resources/js/animalRegister.js')
@endpush
</x-app-layout>

