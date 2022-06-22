@props([
    'object' => null,
])

<div class="grid gap-4 md:grid-cols-2"> 
    <x-textbox name="meta_title" :label="__('dashboard.meta_title')" :placeholder="__('dashboard.meta_title_placeholder')" :value="Request::old('meta_title') ?? $object->meta_title" />
    <x-textbox name="meta_description" :label="__('dashboard.meta_description')" :placeholder="__('dashboard.meta_description_placeholder')" :value="Request::old('meta_description') ?? $object->meta_description" />
</div>