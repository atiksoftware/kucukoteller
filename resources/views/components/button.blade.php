@props([
    'submit' => false,
    'outline' => false, 
    'text' => false,
    'color' => 'primary', 
    'disabled' => false,
    'block' => false,
    'rounded' => true,
    'pill' => false,
    'sm' => false,
    'lg' => false,
    'href' => '',
    'class' => '',
    'bold' => false,
])

@php
    $type = $submit ? 'submit' : 'button';
     
    $px = 'px-4';
    $py = 'py-2'; 

    if($sm){
        $px = 'px-2';
        $py = 'py-1';
    }
    elseif ($lg) {
        $px = 'px-6';
        $py = 'py-3';
    } 

    $bg_styles = '';
    $border_styles = 'border-0';
    $text_styles = '';
    switch ($color) { 
        case 'primary':
            $bg_styles = 'bg-primary';
            $text_styles = 'text-white';
            if(!$disabled){ 
                $bg_styles .= ' hover:bg-primarydark'; 
            }
            if($text){
                $bg_styles = 'bg-transparent'; 
                $text_styles = 'text-primary';
                if(!$disabled){
                    $bg_styles .= ' hover:bg-primary hover:bg-opacity-5 hover:text-primarydark';  
                }
            }
            break; 
    }

    // $btn_classes = implode(' ',[
    //     $px,
    //     $py,
    //     $bg,
    //     $border, 
    //     $text, 
    // ]); 
    $classes = [
        $class,
        'text-center',
        'transition-colors',
        $px,
        $py,
        $bg_styles,
        $border_styles, 
        $text_styles, 
    ];

    if($block){
        $classes[] = 'w-full';
    }

    if($disabled){ 
        $classes[] = 'cursor-not-allowed';
    }else{ 
        $classes[] = 'cursor-pointer';
    }

    if($pill){
        $classes[] = 'rounded-full';
    }
    else if($rounded){
        $classes[] = 'rounded';
    }

    if($href != ''){
        $classes[] = 'inline-block';
    }
    if($bold ){
        $classes[] = 'font-bold';
    }

@endphp

@if ($href)
    <a href="{{ $href }}" class="{{ implode(' ', $classes) }}">{{ $slot }}</a>
@else
<button
    type="{{ $type }}"
    class="{{ implode(' ', $classes) }}"
>
    {{ $slot }}
</button>
@endif