@props([ 
    'type' => 'text',
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'autofocus' => false,
    'disabled' => false,
    'readonly' => false,
    'min' => null,
    'max' => null,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="text-sm">{{ $label }}</label> 
    @endif 
    <input 
    type="{{ $type }}" 
    name="{{ $name }}" 
    value="{{ $value }}" 
    class="w-full block rounded border border-slate-400 px-4 py-3 bg-white focus:outline-primarydark"
    placeholder="{{ $placeholder }}" 
    @if ($required) required @endif
    @if ($autofocus) autofocus @endif
    @if ($disabled) disabled @endif
    @if ($readonly) readonly @endif
    @if ($min) min="{{ $min }}" @endif
    @if ($max) max="{{ $max }}" @endif
    > 
</div>