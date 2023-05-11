<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex justify-center items-center p-[20px] bg-[#EEBC42] text-[#FFFFFF] rounded-[5px] font-semibold text-xs uppercase tracking-widest']) }}>
    {{ $slot }}
</button>
