<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-900 border-2 border-red-900 rounded-2xl font-semibold text-xs text-red-500 uppercase tracking-widest hover:bg-transparent hover:text-red-600 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
