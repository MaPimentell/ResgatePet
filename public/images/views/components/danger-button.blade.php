<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-600 border-2 border-red-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-transparent hover:text-red-600 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
