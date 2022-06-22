@props([ 
    'type' => 'text',
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '', 
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="text-sm font-medium">{{ $label }}</label> 
    @endif  
    <textarea 
    name="{{ $name }}"
    placeholder="{{ $placeholder }}"  
    class="hidden textarea"
    >{{ $value }}</textarea>
    <div class="text-sm italic text-slate-400">
        {{__('dashboard.textarea_loading')}}
    </div>
</div>



