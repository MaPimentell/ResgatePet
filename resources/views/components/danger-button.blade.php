<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-900 border border-red-900 rounded-2xl font-bold text-xs text-[#f52c2c] uppercase tracking-widest hover:bg-transparent hover:text-red-900 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
