@props([
    'static_actions' => false,
])
<div class="pb-3 border-b border-dashed">
    <div class="items-center w-full md:flex">
        <div class="flex-1">
            <h1 class="text-2xl font-medium text-center md:text-left">
                {{ $title }}
            </h1>
        </div>
        @if ($static_actions)
        <div class="flex justify-center w-full gap-4 py-2 md:w-auto md:py-0">
            {{ $actions }}
        </div>
        @else
        <div class="justify-center hidden w-full gap-4 md:flex md:w-auto">
            {{ $actions }}
        </div>
        @endif
    </div>
    <div class="mt-1 text-sm text-center text-slate-400 md:text-left">
        {{ $description }} 
    </div>
</div>