<div class="border-b border-dashed pb-3">
    <div class="md:flex w-full items-center">
        <div class="flex-1">
            <h1 class=" text-2xl font-medium text-center md:text-left">
                {{ $title }}
            </h1>
        </div>
        <div class="flex w-full md:w-auto justify-center gap-4">
            {{ $actions }}
        </div>
    </div>
    <div class="text-sm mt-1 text-slate-400">
        {{ $description }} 
    </div>
</div>