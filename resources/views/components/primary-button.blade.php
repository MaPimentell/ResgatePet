<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-blue-600 border-2 border-blue-600 rounded-2xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-transparent hover:text-blue-600  transition ease-in-out duration-300']) }}>
    {{ $slot }}
</button>
