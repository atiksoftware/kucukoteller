@props([
    'label' => '',
    'name' => '',
    'value' => '',
    'required' => false, 
])

 
<div {{$attributes}}>
    <input 
        class="rounded-full appearance-none h-4 w-4 border border-gray-300 bg-white checked:bg-white checked:border-blue-600 checked:border-4 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" 
        type="checkbox" 
        id="{{$name}}"
        name="{{$name}}"
        value="{{$value}}"
        {{$required ? 'required' : ''}}
    >
    <label 
        class="inline-block text-gray-800 cursor-pointer"
        for="{{$name}}"
    >
        {{$label}}
    </label>
</div>