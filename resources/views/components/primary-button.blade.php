<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center p-[16px] bg-custom-button rounded-[5px] font-semibold text-xs uppercase tracking-widest']) }}>
    {{ $slot }}
</button>
