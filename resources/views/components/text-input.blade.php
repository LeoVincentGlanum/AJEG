 @props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-[5px] border-none focus:ring-0 focus:ring-offset-0']) !!}>
