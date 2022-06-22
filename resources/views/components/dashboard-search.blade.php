@props([
    'records' => [],
])
<div class="py-4">
    <form action="" method="GET"> 
        <x-textbox name="search" :label="__('dashboard.type_here_to_search')" :placeholder="__('dashboard.type_here_to_search_placeholder')" :value="request()->get('search')" />
    </form>
</div>