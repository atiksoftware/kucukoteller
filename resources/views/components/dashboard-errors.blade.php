@if($errors->any()) 
<div class="flex p-4 mt-4 border border-dashed rounded bg-red-50 border-rose-300">
    <div class="hidden md:block">
        <svg class="w-6 h-6 fill-current text-rose-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M0 0h24v24H0V0z" fill="none" />
            <path d="M12 5.99L19.53 19H4.47L12 5.99M12 2L1 21h22L12 2zm1 14h-2v2h2v-2zm0-6h-2v4h2v-4z" /></svg>
    </div>
    <div class="md:ml-3">
        <h2 class="mb-2 font-medium text-gray-800 left">{{__('validation.errors')}}</h2>
        @foreach ($errors->all() as $error)
        <p class="text-sm leading-relaxed text-rose-600">{{ $error }}</p>
        @endforeach

    </div>
</div>
@endif
