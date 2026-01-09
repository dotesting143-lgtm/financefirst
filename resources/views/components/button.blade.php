<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center bg-pos-gradient hover:bg-pos-gradient-hover focus:bg-pos-gradient-hover active:bg-pos-gradient-hover text-white font-medium py-2.5 px-5 rounded text-sm xl:text-base disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
