@props([
    'error' => false,
    'success' => false,
    'warning' => false,
    'info' => false,
    'value' => null,
    'class' => null,
])

@php
    $classes = [];
    $bg_styles = '';
    $border_styles = '';
    $text_styles = '';

    if($error){
        $bg_styles = 'bg-rose-500 bg-opacity-10';
        $text_styles = 'text-rose-500 font-semibold';
    }
    elseif($success){
        $bg_styles = 'bg-teal-100';
        $text_styles = 'text-teal-700 font-semibold';
    }
    elseif($warning){
        $bg_styles = 'bg-orange-100';
        $text_styles = 'text-orange-700';
    }
    elseif($info){
        $bg_styles = 'bg-blue-100';
        $text_styles = 'text-blue-700';
    }
    else{
        $bg_styles = 'bg-gray-100';
        $text_styles = 'text-gray-700';
    }

    $classes[] =  $class;
    $classes[] = 'rounded';
    $classes[] = 'p-3';

    $classes[] = $bg_styles;
    $classes[] = $border_styles;
    $classes[] = $text_styles;
 
@endphp

@if ($value != null)
    <div class="{{ implode(' ',$classes) }}">
        @if (is_array($value)) 
            <ul class="list-none">
                @foreach ($value as $item)
                <li>{{ $item }}</li>
                @endforeach 
            </ul> 
        @elseif (is_string($value))
            <div>{{ $value }}</div>
        @endif
    </div>
@endif

