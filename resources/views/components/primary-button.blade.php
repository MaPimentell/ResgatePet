<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-600 border border-red-600 rounded-2xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-transparent hover:text-red-600  transition ease-in-out duration-300']) }}>
    {{ $slot }}
</button>
