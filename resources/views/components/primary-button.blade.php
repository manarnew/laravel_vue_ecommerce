<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center text-white bg-emerald-600 py-2 px-3 rounded shadow-md hover:bg-emerald-700 active:bg-emerald-800 transition-colors mx-5']) }}>
    {{ $slot }}
</button>
